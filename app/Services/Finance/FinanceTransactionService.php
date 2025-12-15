<?php

namespace App\Services\Finance;

use App\Events\Finance\JournalRecorded;
use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceFiscalPeriod;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceJournalRow;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use InvalidArgumentException;

class FinanceTransactionService
{
    public function record(string $event, array $payload, array $context = []): FinanceJournal
    {
        $prepared = $this->prepare($event, $payload, $context);

        $journal = DB::transaction(function () use ($prepared) {
            $journal = FinanceJournal::create($prepared['journal']);
            $this->storeLines($journal, $prepared['lines']);

            return $journal->fresh('rows');
        });

        JournalRecorded::dispatch($journal, $event, $payload, $context);

        return $journal;
    }

    public function preview(string $event, array $payload, array $context = []): array
    {
        $prepared = $this->prepare($event, $payload, $context);

        return [
            'journal' => $prepared['journal'],
            'lines' => $prepared['lines']->toArray(),
        ];
    }

    public function reverse(FinanceJournal $journal, array $context = []): FinanceJournal
    {
        $lines = $journal->rows->map(function (FinanceJournalRow $row) {
            return [
                'account_id' => $row->account_id,
                'entry_type' => $row->entry_type === 'debit' ? 'credit' : 'debit',
                'amount' => $row->amount,
                'description' => $row->description ? 'Reversal: ' . $row->description : null,
            ];
        });

        $entryDate = Carbon::parse($context['entry_date'] ?? now());

        $payload = [
            'entry_date' => $entryDate->toDateString(),
        ];

        $prepared = $this->prepareJournalPayload([
            'event' => null,
            'config' => [
                'memo' => 'Reversal of ' . $journal->journal_number,
                'category' => $journal->category,
                'source_type' => $journal->source_type,
                'source_reference' => $journal->source_reference,
                'auto_post' => true,
            ],
            'payload' => $payload,
            'context' => $context,
            'entry_date' => $entryDate,
            'lines' => $lines,
        ]);

        $reversal = DB::transaction(function () use ($prepared) {
            $journal = FinanceJournal::create($prepared['journal']);
            $this->storeLines($journal, $prepared['lines']);

            return $journal->fresh('rows');
        });

        JournalRecorded::dispatch($reversal, 'finance.journal_reversal', $payload, $context);

        return $reversal;
    }

    private function prepare(string $event, array $payload, array $context): array
    {
        $config = $this->getEventConfig($event);
        $entryDate = $this->resolveEntryDate($payload, $context, $config);
        $lines = $this->buildLines($config['lines'] ?? [], $payload, $context);

        if ($lines->count() < 2) {
            throw new InvalidArgumentException('Finance journals require at least two lines.');
        }

        $this->assertBalanced($lines);

        return $this->prepareJournalPayload([
            'event' => $event,
            'config' => $config,
            'payload' => $payload,
            'context' => $context,
            'entry_date' => $entryDate,
            'lines' => $lines,
        ]);
    }

    private function prepareJournalPayload(array $data): array
    {
        $config = $data['config'];
        $payload = $data['payload'];
        $context = $data['context'];
        $entryDate = $data['entry_date'];
        $lines = $data['lines'];

        $autoPost = $config['auto_post'] ?? config('finance_mappings.auto_post', true);

        $journal = [
            'journal_number' => $this->generateJournalNumber($config),
            'fiscal_period_id' => $this->resolveFiscalPeriodId($entryDate, $context['fiscal_period_id'] ?? null),
            'entry_date' => $entryDate,
            'source_type' => $context['source_type'] ?? $config['source_type'] ?? null,
            'source_id' => $context['source_id'] ?? null,
            'source_reference' => $context['source_reference'] ?? $this->interpolate($config['source_reference'] ?? null, $payload),
            'currency' => strtoupper($context['currency'] ?? $config['currency'] ?? config('finance_mappings.default_currency', 'USD')),
            'exchange_rate' => $context['exchange_rate'] ?? $config['exchange_rate'] ?? 1,
            'status' => $autoPost ? 'posted' : 'draft',
            'category' => $context['category'] ?? $config['category'] ?? null,
            'memo' => $this->interpolate($context['memo'] ?? $config['memo'] ?? null, $payload),
            'line_count' => $lines->count(),
            'attachment_count' => 0,
            'posted_at' => $autoPost ? now() : null,
            'posted_by' => $context['posted_by'] ?? null,
            'created_by' => $context['created_by'] ?? null,
            'updated_by' => $context['updated_by'] ?? null,
        ];

        return [
            'journal' => $journal,
            'lines' => $lines,
        ];
    }

    private function buildLines(array $definitions, array $payload, array $context): Collection
    {
        $definitions = collect($definitions);
        $accounts = $this->resolveAccounts($definitions);

        return $definitions->map(function (array $definition) use ($payload, $context, $accounts) {
            $amount = $this->resolveAmount($definition['amount'] ?? null, $payload, $context);
            if (($definition['skip_zero'] ?? true) && abs($amount) < 0.00001) {
                return null;
            }

            $accountId = $this->resolveAccountId($definition, $payload, $context, $accounts);
            if (!$accountId) {
                throw new InvalidArgumentException('Unable to resolve finance account for journal line.');
            }

            $entryType = $definition['type'] ?? null;
            if (!in_array($entryType, ['debit', 'credit'], true)) {
                throw new InvalidArgumentException('Journal line type must be debit or credit.');
            }

            return [
                'account_id' => $accountId,
                'entry_type' => $entryType,
                'amount' => round($amount, 6),
                'description' => $this->interpolate($definition['description'] ?? null, $payload),
            ];
        })->filter()->values();
    }

    private function resolveAccountId(array $definition, array $payload, array $context, array $accounts): ?int
    {
        if (array_key_exists('account_id', $definition)) {
            $value = $definition['account_id'];

            if (is_array($value)) {
                $accountId = null;
                if (array_key_exists('path', $value)) {
                    $accountId = data_get($payload, $value['path']);
                }
                if (array_key_exists('context_path', $value)) {
                    $accountId = data_get($context, $value['context_path'], $accountId);
                }
                if (array_key_exists('default', $value)) {
                    $accountId = $accountId ?? $value['default'];
                }

                return $accountId ? (int) $accountId : null;
            }

            return $value ? (int) $value : null;
        }

        if ($code = $definition['account_code'] ?? null) {
            return $accounts[$code] ?? null;
        }

        return null;
    }
    private function resolveAccounts(Collection $definitions): array
    {
        $codes = $definitions
            ->pluck('account_code')
            ->filter()
            ->unique()
            ->values();

        if ($codes->isEmpty()) {
            return [];
        }

        return FinanceAccount::query()
            ->whereIn('code', $codes)
            ->pluck('id', 'code')
            ->toArray();
    }

    private function resolveAmount(mixed $definition, array $payload, array $context): float
    {
        if (is_null($definition)) {
            return 0.0;
        }

        if (is_numeric($definition)) {
            return (float) $definition;
        }

        if (is_string($definition)) {
            return (float) data_get($payload, $definition, data_get($context, $definition, 0));
        }

        if (is_array($definition)) {
            $value = 0.0;
            if (array_key_exists('path', $definition)) {
                $value = (float) data_get($payload, $definition['path'], 0);
            }
            if (array_key_exists('context_path', $definition)) {
                $value = (float) data_get($context, $definition['context_path'], $value);
            }
            if (array_key_exists('default', $definition)) {
                $value = $value ?: (float) $definition['default'];
            }
            if (array_key_exists('multiply', $definition)) {
                $value *= (float) $definition['multiply'];
            }
            if (!empty($definition['absolute'])) {
                $value = abs($value);
            }

            return $value;
        }

        throw new InvalidArgumentException('Unsupported amount definition for finance mapping.');
    }

    private function assertBalanced(Collection $lines): void
    {
        $debit = $lines->where('entry_type', 'debit')->sum('amount');
        $credit = $lines->where('entry_type', 'credit')->sum('amount');

        if (abs($debit - $credit) > 0.01) {
            throw new InvalidArgumentException('Finance journal lines are not balanced.');
        }
    }

    private function storeLines(FinanceJournal $journal, Collection $lines): void
    {
        foreach ($lines as $index => $line) {
            FinanceJournalRow::create([
                'journal_id' => $journal->id,
                'account_id' => $line['account_id'],
                'line_number' => $index + 1,
                'entry_type' => $line['entry_type'],
                'amount' => $line['amount'],
                'currency' => $journal->currency,
                'exchange_rate' => $journal->exchange_rate,
                'description' => $line['description'],
            ]);
        }
    }

    private function getEventConfig(?string $event): array
    {
        if (!$event) {
            throw new InvalidArgumentException('Finance event key is required.');
        }

        $config = config("finance_mappings.events.$event");
        if (!$config) {
            throw new InvalidArgumentException("Finance event [$event] is not configured.");
        }

        return $config;
    }

    private function resolveEntryDate(array $payload, array $context, array $config): Carbon
    {
        $date = $context['entry_date'] ?? $config['entry_date'] ?? $payload['entry_date'] ?? now()->toDateString();

        return Carbon::parse($date);
    }

    private function resolveFiscalPeriodId(Carbon $entryDate, ?int $override = null): ?int
    {
        if ($override) {
            return $override;
        }

        $period = FinanceFiscalPeriod::query()
            ->whereDate('start_date', '<=', $entryDate)
            ->whereDate('end_date', '>=', $entryDate)
            ->where('is_locked', false)
            ->orderByDesc('start_date')
            ->first();

        return $period?->id;
    }

    private function interpolate(?string $template, array $payload): ?string
    {
        if (!$template) {
            return null;
        }

        return preg_replace_callback('/:([A-Za-z0-9_\.]+)/', function ($matches) use ($payload) {
            return (string) data_get($payload, $matches[1], '') ?: '';
        }, $template);
    }

    private function generateJournalNumber(array $config): string
    {
        $prefix = $config['journal_prefix'] ?? config('finance_mappings.journal_prefix', 'FIN');
        $dateSegment = now()->format('Ymd');
        $base = $prefix . '-' . $dateSegment;

        $last = FinanceJournal::query()
            ->where('journal_number', 'like', $base . '-%')
            ->orderByDesc('journal_number')
            ->value('journal_number');

        $sequence = 1;
        if ($last && Str::contains($last, '-')) {
            $sequence = ((int) Str::afterLast($last, '-')) + 1;
        }

        return sprintf('%s-%04d', $base, $sequence);
    }
}
