<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceFiscalPeriod;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceJournalRow;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FinanceJournalController extends BaseController
{
    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $search = trim((string) $request->get('search'));
        $status = $request->get('status');
        $period = $request->get('fiscal_period_id');

        $journals = FinanceJournal::with('fiscalPeriod')
            ->when($search, function ($query, $value) {
                $query->where(function ($builder) use ($value) {
                    $builder->where('journal_number', 'like', "%{$value}%")
                        ->orWhere('source_reference', 'like', "%{$value}%")
                        ->orWhere('memo', 'like', "%{$value}%");
                });
            })
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->when($period, fn ($query, $value) => $query->where('fiscal_period_id', $value))
            ->orderByDesc('entry_date')
            ->paginate(20)
            ->appends($request->query());

        return view(AccountsFinance::JOURNALS_INDEX[VIEW], [
            'journals' => $journals,
            'statusFilter' => $status,
            'periods' => FinanceFiscalPeriod::orderByDesc('start_date')->get(),
        ]);
    }

    public function create(): View
    {
        return view(AccountsFinance::JOURNALS_CREATE[VIEW], [
            'accounts' => FinanceAccount::where('is_postable', true)->orderBy('code')->get(),
            'periods' => FinanceFiscalPeriod::orderByDesc('start_date')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $lines = $this->collectLines($validated['lines']);
        $this->assertBalanced($lines);

        DB::transaction(function () use ($validated, $lines) {
            $journal = FinanceJournal::create([
                'journal_number' => $validated['journal_number'],
                'fiscal_period_id' => $validated['fiscal_period_id'] ?? null,
                'entry_date' => $validated['entry_date'],
                'source_type' => $validated['source_type'] ?? null,
                'source_id' => $validated['source_id'] ?? null,
                'source_reference' => $validated['source_reference'] ?? null,
                'currency' => strtoupper($validated['currency']),
                'exchange_rate' => $validated['exchange_rate'] ?? 1,
                'status' => 'draft',
                'category' => $validated['category'] ?? null,
                'memo' => $validated['memo'] ?? null,
                'line_count' => $lines->count(),
                'attachment_count' => 0,
                'created_by' => auth('admin')->id(),
                'updated_by' => auth('admin')->id(),
            ]);

            $this->storeLines($journal, $lines);
        });

        Toastr::success(translate('finance_journal_created_successfully'));
        return redirect()->route('admin.accounts-finance.journals.index');
    }

    public function show(FinanceJournal $journal): View
    {
        return view(AccountsFinance::JOURNALS_SHOW[VIEW], [
            'journal' => $journal->load(['rows.account', 'fiscalPeriod']),
        ]);
    }

    public function edit(FinanceJournal $journal): View|RedirectResponse
    {
        if ($journal->status === 'posted') {
            Toastr::error(translate('posted_journals_cannot_be_edited'));
            return redirect()->route('admin.accounts-finance.journals.index');
        }

        return view(AccountsFinance::JOURNALS_EDIT[VIEW], [
            'journal' => $journal->load('rows'),
            'accounts' => FinanceAccount::where('is_postable', true)->orderBy('code')->get(),
            'periods' => FinanceFiscalPeriod::orderByDesc('start_date')->get(),
        ]);
    }

    public function update(Request $request, FinanceJournal $journal): RedirectResponse
    {
        if ($journal->status === 'posted') {
            Toastr::error(translate('posted_journals_cannot_be_edited'));
            return back();
        }

        $validated = $this->validatePayload($request, $journal->id);
        $lines = $this->collectLines($validated['lines']);
        $this->assertBalanced($lines);

        DB::transaction(function () use ($journal, $validated, $lines) {
            $journal->update([
                'journal_number' => $validated['journal_number'],
                'fiscal_period_id' => $validated['fiscal_period_id'] ?? null,
                'entry_date' => $validated['entry_date'],
                'source_type' => $validated['source_type'] ?? null,
                'source_id' => $validated['source_id'] ?? null,
                'source_reference' => $validated['source_reference'] ?? null,
                'currency' => strtoupper($validated['currency']),
                'exchange_rate' => $validated['exchange_rate'] ?? 1,
                'category' => $validated['category'] ?? null,
                'memo' => $validated['memo'] ?? null,
                'line_count' => $lines->count(),
                'updated_by' => auth('admin')->id(),
            ]);

            $journal->rows()->delete();
            $this->storeLines($journal, $lines);
        });

        Toastr::success(translate('finance_journal_updated_successfully'));
        return redirect()->route('admin.accounts-finance.journals.index');
    }

    public function destroy(FinanceJournal $journal): RedirectResponse
    {
        if ($journal->status === 'posted') {
            Toastr::error(translate('posted_journals_cannot_be_deleted'));
            return back();
        }

        $journal->rows()->delete();
        $journal->delete();
        Toastr::success(translate('finance_journal_deleted_successfully'));
        return back();
    }

    public function post(FinanceJournal $journal): RedirectResponse
    {
        if ($journal->status === 'posted') {
            Toastr::info(translate('journal_is_already_posted'));
            return back();
        }

        $rows = $journal->rows()->get();
        $this->assertBalanced($rows->map(function ($row) {
            return [
                'account_id' => $row->account_id,
                'entry_type' => $row->entry_type,
                'amount' => $row->amount,
                'description' => $row->description,
            ];
        }));

        $journal->update([
            'status' => 'posted',
            'posted_at' => now(),
            'posted_by' => auth('admin')->id(),
        ]);

        Toastr::success(translate('finance_journal_posted_successfully'));
        return back();
    }

    private function validatePayload(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'journal_number' => ['required', 'max:50', Rule::unique('finance_journals', 'journal_number')->ignore($ignoreId)],
            'entry_date' => ['required', 'date'],
            'fiscal_period_id' => ['nullable', 'exists:finance_fiscal_periods,id'],
            'source_type' => ['nullable', 'string', 'max:120'],
            'source_id' => ['nullable', 'integer'],
            'source_reference' => ['nullable', 'string', 'max:120'],
            'currency' => ['required', 'string', 'size:3'],
            'exchange_rate' => ['nullable', 'numeric', 'min:0'],
            'category' => ['nullable', 'string', 'max:40'],
            'memo' => ['nullable', 'string'],
            'lines' => ['required', 'array', 'min:2'],
            'lines.*.account_id' => ['required', 'exists:finance_accounts,id'],
            'lines.*.entry_type' => ['required', Rule::in(['debit', 'credit'])],
            'lines.*.amount' => ['required', 'numeric', 'min:0.01'],
            'lines.*.currency' => ['nullable', 'string', 'size:3'],
            'lines.*.description' => ['nullable', 'string', 'max:191'],
        ]);
    }

    private function collectLines(array $lines): Collection
    {
        return collect($lines)->filter(function ($line) {
            return isset($line['account_id'], $line['entry_type'], $line['amount']);
        })->map(function ($line) {
            return [
                'account_id' => (int) $line['account_id'],
                'entry_type' => $line['entry_type'],
                'amount' => (float) $line['amount'],
                'currency' => $line['currency'] ?? null,
                'description' => $line['description'] ?? null,
            ];
        });
    }

    private function assertBalanced(Collection $lines): void
    {
        $debit = $lines->where('entry_type', 'debit')->sum('amount');
        $credit = $lines->where('entry_type', 'credit')->sum('amount');

        if (abs($debit - $credit) > 0.0001) {
            throw ValidationException::withMessages([
                'lines' => translate('journal_entries_must_balance'),
            ]);
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
                'currency' => $line['currency'] ?? $journal->currency,
                'exchange_rate' => $journal->exchange_rate,
                'description' => $line['description'],
            ]);
        }
    }
}
