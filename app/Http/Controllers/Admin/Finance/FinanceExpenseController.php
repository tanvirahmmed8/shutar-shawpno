<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceExpense;
use App\Models\Finance\FinanceJournal;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FinanceExpenseController extends BaseController
{
    private array $statuses = ['draft', 'submitted', 'approved', 'rejected'];

    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $status = $request->get('status');
        $search = trim((string) $request->get('search'));

        $expenses = FinanceExpense::with(['account', 'journal'])
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->when($search, function ($query, $value) {
                $query->where(function ($builder) use ($value) {
                    $builder->where('expense_number', 'like', "%{$value}%")
                        ->orWhere('purpose', 'like', "%{$value}%");
                });
            })
            ->orderByDesc('expense_date')
            ->paginate(20)
            ->appends($request->query());

        return view(AccountsFinance::EXPENSES_INDEX[VIEW], [
            'expenses' => $expenses,
            'statusFilter' => $status,
            'statuses' => $this->statuses,
        ]);
    }

    public function create(): View
    {
        return view(AccountsFinance::EXPENSES_CREATE[VIEW], [
            'accounts' => FinanceAccount::where('is_postable', true)->orderBy('code')->get(),
            'statuses' => $this->statuses,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);

        DB::transaction(function () use ($validated, $request) {
            FinanceExpense::create([
                'expense_number' => $validated['expense_number'],
                'account_id' => $validated['account_id'] ?? null,
                'category' => $validated['category'] ?? null,
                'payee_type' => $validated['payee_type'] ?? null,
                'payee_id' => $validated['payee_id'] ?? null,
                'amount' => $validated['amount'],
                'currency' => strtoupper($validated['currency']),
                'exchange_rate' => $validated['exchange_rate'] ?? 1,
                'expense_date' => $validated['expense_date'] ?? null,
                'status' => $validated['status'] ?? 'draft',
                'purpose' => $validated['purpose'] ?? null,
                'journal_id' => $validated['journal_id'] ?? null,
                'submitted_by' => auth('admin')->id(),
                'reviewed_by' => null,
                'approved_by' => null,
                'approved_at' => null,
                'attachment_count' => 0,
                'metadata' => $validated['metadata'] ?? null,
            ]);
        });

        Toastr::success(translate('finance_expense_created_successfully'));
        return redirect()->route('admin.accounts-finance.expenses.index');
    }

    public function show(FinanceExpense $expense): View
    {
        return view(AccountsFinance::EXPENSES_SHOW[VIEW], [
            'expense' => $expense->load(['account', 'journal']),
        ]);
    }

    public function edit(FinanceExpense $expense): View|RedirectResponse
    {
        if ($expense->status === 'approved') {
            Toastr::error(translate('approved_expense_cannot_be_edited'));
            return redirect()->route('admin.accounts-finance.expenses.index');
        }

        return view(AccountsFinance::EXPENSES_EDIT[VIEW], [
            'expense' => $expense,
            'accounts' => FinanceAccount::where('is_postable', true)->orderBy('code')->get(),
            'statuses' => $this->statuses,
        ]);
    }

    public function update(Request $request, FinanceExpense $expense): RedirectResponse
    {
        if ($expense->status === 'approved') {
            Toastr::error(translate('approved_expense_cannot_be_edited'));
            return back();
        }

        $validated = $this->validatePayload($request, $expense->id);
        $expense->update([
            'account_id' => $validated['account_id'] ?? null,
            'category' => $validated['category'] ?? null,
            'payee_type' => $validated['payee_type'] ?? null,
            'payee_id' => $validated['payee_id'] ?? null,
            'amount' => $validated['amount'],
            'currency' => strtoupper($validated['currency']),
            'exchange_rate' => $validated['exchange_rate'] ?? 1,
            'expense_date' => $validated['expense_date'] ?? null,
            'status' => $validated['status'] ?? $expense->status,
            'purpose' => $validated['purpose'] ?? null,
            'journal_id' => $validated['journal_id'] ?? null,
            'metadata' => $validated['metadata'] ?? null,
            'reviewed_by' => auth('admin')->id(),
        ]);

        Toastr::success(translate('finance_expense_updated_successfully'));
        return redirect()->route('admin.accounts-finance.expenses.index');
    }

    public function approve(FinanceExpense $expense, Request $request): RedirectResponse
    {
        if ($expense->status === 'approved') {
            Toastr::info(translate('expense_is_already_approved'));
            return back();
        }

        $request->validate([
            'journal_id' => ['nullable', 'exists:finance_journals,id'],
        ]);

        $expense->update([
            'status' => 'approved',
            'journal_id' => $request->get('journal_id', $expense->journal_id),
            'approved_by' => auth('admin')->id(),
            'approved_at' => now(),
        ]);

        Toastr::success(translate('finance_expense_approved_successfully'));
        return back();
    }

    public function destroy(FinanceExpense $expense): RedirectResponse
    {
        $expense->delete();
        Toastr::success(translate('finance_expense_deleted_successfully'));
        return back();
    }

    private function validatePayload(Request $request, ?int $expenseId = null): array
    {
        return $request->validate([
            'expense_number' => ['required', 'max:50', Rule::unique('finance_expenses', 'expense_number')->ignore($expenseId)],
            'account_id' => ['nullable', 'exists:finance_accounts,id'],
            'category' => ['nullable', 'string', 'max:80'],
            'payee_type' => ['nullable', 'string', 'max:120'],
            'payee_id' => ['nullable', 'integer'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'currency' => ['required', 'string', 'size:3'],
            'exchange_rate' => ['nullable', 'numeric', 'min:0'],
            'expense_date' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in($this->statuses)],
            'purpose' => ['nullable', 'string'],
            'journal_id' => ['nullable', 'exists:finance_journals,id'],
            'metadata' => ['nullable', 'array'],
        ]);
    }
}
