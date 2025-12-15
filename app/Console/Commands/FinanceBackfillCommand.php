<?php

namespace App\Console\Commands;

use App\Services\Finance\FinanceTransactionService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Throwable;

class FinanceBackfillCommand extends Command
{
    protected $signature = <<<'SIGNATURE'
finance:backfill
    {event : Finance event key defined in finance_mappings.php}
    {payload : Path to a JSON file containing an array of payload rows}
    {--limit= : Optional limit of rows to process}
    {--dry-run : Validate payloads without creating journals}
    {--fail-fast : Stop on the first encountered error}
SIGNATURE;

    protected $description = 'Backfill finance journals based on structured payload data.';

    public function handle(FinanceTransactionService $transactionService): int
    {
        $event = $this->argument('event');
        $payloadFile = $this->argument('payload');

        if (!File::exists($payloadFile)) {
            $this->error("Payload file [$payloadFile] was not found.");
            return self::FAILURE;
        }

        $raw = File::get($payloadFile);
        $rows = json_decode($raw, true);
        if (!is_array($rows)) {
            $this->error('The payload file must contain a JSON array of payload objects.');
            return self::FAILURE;
        }

        $limit = $this->option('limit') ? (int) $this->option('limit') : null;
        $dryRun = (bool) $this->option('dry-run');
        $failFast = (bool) $this->option('fail-fast');

        $processed = 0;
        foreach ($rows as $index => $row) {
            if (!is_array($row)) {
                $this->warn("Skipping row #$index because it is not an object.");
                continue;
            }

            if ($limit && $processed >= $limit) {
                break;
            }

            $context = $row['_context'] ?? [];
            unset($row['_context']);

            try {
                if ($dryRun) {
                    $preview = $transactionService->preview($event, $row, $context);
                    $this->line(sprintf('[dry-run] %s (%d lines)', $preview['journal']['journal_number'], count($preview['lines'])));
                    $processed++;
                    continue;
                }

                $journal = $transactionService->record($event, $row, $context);
                $processed++;
                $this->info(sprintf('Journal %s created (%d lines)', $journal->journal_number, $journal->line_count));
            } catch (Throwable $exception) {
                $this->error(sprintf('Row #%d failed: %s', $index, $exception->getMessage()));
                if ($failFast) {
                    return self::FAILURE;
                }
            }
        }

        $message = $dryRun
            ? sprintf('Dry-run completed. %d payload(s) validated.', $processed)
            : sprintf('Backfill completed. %d journal(s) created.', $processed);

        $this->info($message);

        return self::SUCCESS;
    }
}
