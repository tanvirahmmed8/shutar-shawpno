<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceJournalRow;
use App\Models\Finance\FinanceReconciliation;
use App\Models\Finance\FinanceReconciliationRow;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceReconciliationController extends BaseController
{
    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $status = $request->get('status');
        $accountId = $request->get('account_id');

        $reconciliations = FinanceReconciliation::with('account')
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->when($accountId, fn ($query, $value) => $query->where('account_id', $value))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->query());

        return view(AccountsFinance::RECONCILIATIONS_INDEX[VIEW], [
            'reconciliations' => $reconciliations,
            'accounts' => FinanceAccount::orderBy('code')->get(),
            'filters' => compact('status', 'accountId'),
        ]);
    }

    public function create(): View
    {
        return view(AccountsFinance::RECONCILIATIONS_CREATE[VIEW], [
            'accounts' => FinanceAccount::orderBy('code')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'account_id' => ['required', 'exists:finance_accounts,id'],
            'statement_name' => ['required', 'string', 'max:120'],
            'statement_date' => ['nullable', 'date'],
            'import_source' => ['nullable', 'string', 'max:120'],
            'opening_balance' => ['nullable', 'numeric'],
            'closing_balance' => ['nullable', 'numeric'],
            'notes' => ['nullable', 'string'],
            'rows' => ['nullable', 'array'],
            'rows.*.transaction_date' => ['nullable', 'date'],
            'rows.*.description' => ['nullable', 'string', 'max:191'],
            'rows.*.reference' => ['nullable', 'string', 'max:120'],
            'rows.*.amount' => ['required', 'numeric'],
        ]);

        DB::transaction(function () use ($validated) {
            $reconciliation = FinanceReconciliation::create([
                'account_id' => $validated['account_id'],
                'statement_name' => $validated['statement_name'],
                'statement_date' => $validated['statement_date'] ?? null,
                'import_source' => $validated['import_source'] ?? null,
                'opening_balance' => $validated['opening_balance'] ?? 0,
                'closing_balance' => $validated['closing_balance'] ?? 0,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
                'started_at' => now(),
                'created_by' => auth('admin')->id(),
                'updated_by' => auth('admin')->id(),
            ]);

            foreach ($validated['rows'] ?? [] as $row) {
                if (!isset($row['amount'])) {
                    continue;
                }

                $reconciliation->rows()->create([
                    'transaction_date' => $row['transaction_date'] ?? null,
                    'description' => $row['description'] ?? null,
                    'reference' => $row['reference'] ?? null,
                    'amount' => $row['amount'],
                    'match_status' => 'unmatched',
                ]);
            }
        });

        Toastr::success(translate('finance_reconciliation_created_successfully'));
        return redirect()->route('admin.accounts-finance.reconciliations.index');
    }

    public function show(FinanceReconciliation $reconciliation): View
    {
        $reconciliation->load(['account', 'rows.journalRow.journal']);

        return view(AccountsFinance::RECONCILIATIONS_SHOW[VIEW], [
            'reconciliation' => $reconciliation,
            'matchableRows' => optional($reconciliation->account)?->journalRows()->latest()->take(20)->get() ?? collect(),
        ]);
    }

    public function matchRow(FinanceReconciliation $reconciliation, FinanceReconciliationRow $row, Request $request): RedirectResponse
    {
        $this->ensureRowOwnership($reconciliation, $row);
        $data = $request->validate([
            'journal_row_id' => ['required', 'exists:finance_journal_rows,id'],
        ]);

        /** @var FinanceJournalRow $journalRow */
        $journalRow = FinanceJournalRow::findOrFail($data['journal_row_id']);
        $row->update([
            'journal_row_id' => $journalRow->id,
            'match_status' => 'matched',
        ]);

        $reconciliation->increment('matched_row_count');
        Toastr::success(translate('reconciliation_row_matched_successfully'));
        return back();
    }

    public function unmatchRow(FinanceReconciliation $reconciliation, FinanceReconciliationRow $row): RedirectResponse
    {
        $this->ensureRowOwnership($reconciliation, $row);
        if ($row->match_status === 'matched') {
            $reconciliation->decrement('matched_row_count');
        }

        $row->update([
            'journal_row_id' => null,
            'match_status' => 'unmatched',
        ]);

        Toastr::success(translate('reconciliation_row_unmatched_successfully'));
        return back();
    }

    public function destroy(FinanceReconciliation $reconciliation): RedirectResponse
    {
        $reconciliation->rows()->delete();
        $reconciliation->delete();

        Toastr::success(translate('finance_reconciliation_deleted_successfully'));
        return back();
    }

    private function ensureRowOwnership(FinanceReconciliation $reconciliation, FinanceReconciliationRow $row): void
    {
        if ($row->reconciliation_id !== $reconciliation->id) {
            abort(404);
        }
    }
}
