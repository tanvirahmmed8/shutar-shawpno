<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceJournalRow;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FinanceAccountController extends BaseController
{
    private array $categories = ['asset', 'liability', 'equity', 'revenue', 'expense', 'other'];
    private array $types = ['control', 'posting', 'summary'];
    private array $balanceTypes = ['debit', 'credit'];

    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $search = trim((string) $request->get('search'));
        $category = $request->get('category');
        $status = $request->get('status');

        $accounts = FinanceAccount::with('parent')
            ->when($search, function ($query, $value) {
                $query->where(function ($builder) use ($value) {
                    $builder->where('code', 'like', "%{$value}%")
                        ->orWhere('name', 'like', "%{$value}%");
                });
            })
            ->when($category, fn ($query, $value) => $query->where('category', $value))
            ->when($status === 'inactive', fn ($query) => $query->where('is_active', false))
            ->when($status === 'active', fn ($query) => $query->where('is_active', true))
            ->orderBy('code')
            ->paginate(25);

        $accounts->appends($request->query());
        $this->attachAccountBalances($accounts);

        return view(AccountsFinance::ACCOUNTS_INDEX[VIEW], [
            'accounts' => $accounts,
            'categories' => $this->categories,
            'types' => $this->types,
            'filters' => compact('search', 'category', 'status'),
        ]);
    }

    public function create(): View
    {
        return view(AccountsFinance::ACCOUNTS_CREATE[VIEW], [
            'categories' => $this->categories,
            'types' => $this->types,
            'balanceTypes' => $this->balanceTypes,
            'parentOptions' => FinanceAccount::orderBy('code')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);

        DB::transaction(function () use ($validated, $request) {
            $parent = null;
            if (!empty($validated['parent_id'])) {
                $parent = FinanceAccount::find($validated['parent_id']);
            }

            $payload = $this->prepareAccountPayload($validated, $parent, $request->boolean('is_active', true));
            $account = FinanceAccount::create(array_merge($payload, [
                'created_by' => auth('admin')->id(),
                'updated_by' => auth('admin')->id(),
            ]));

            if ($parent && $parent->is_leaf) {
                $parent->update(['is_leaf' => false, 'is_postable' => false]);
            }
        });

        Toastr::success(translate('finance_account_created_successfully'));
        return redirect()->route('admin.accounts-finance.accounts.index');
    }

    public function edit(FinanceAccount $account): View
    {
        return view(AccountsFinance::ACCOUNTS_EDIT[VIEW], [
            'account' => $account,
            'categories' => $this->categories,
            'types' => $this->types,
            'balanceTypes' => $this->balanceTypes,
            'parentOptions' => FinanceAccount::where('id', '!=', $account->id)->orderBy('code')->get(),
        ]);
    }

    public function update(Request $request, FinanceAccount $account): RedirectResponse
    {
        $validated = $this->validatePayload($request, $account->id);

        DB::transaction(function () use ($validated, $account, $request) {
            $parent = null;
            if (!empty($validated['parent_id'])) {
                $parent = FinanceAccount::find($validated['parent_id']);
            }

            $payload = $this->prepareAccountPayload($validated, $parent, $request->boolean('is_active', true));
            $account->update(array_merge($payload, [
                'updated_by' => auth('admin')->id(),
            ]));

            if ($parent && $parent->is_leaf) {
                $parent->update(['is_leaf' => false, 'is_postable' => false]);
            }
        });

        Toastr::success(translate('finance_account_updated_successfully'));
        return redirect()->route('admin.accounts-finance.accounts.index');
    }

    public function destroy(FinanceAccount $account): RedirectResponse
    {
        if ($account->children()->exists() || $account->journalRows()->exists()) {
            Toastr::error(translate('unable_to_delete_account_with_dependencies'));
            return back();
        }

        $account->delete();
        Toastr::success(translate('finance_account_deleted_successfully'));
        return back();
    }

    public function export(Request $request): StreamedResponse
    {
        $fileName = 'finance-accounts-' . now()->format('Ymd_His') . '.csv';
        $query = FinanceAccount::orderBy('code');

        $search = trim((string) $request->get('search'));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'wb');
            fputcsv($handle, ['code', 'name', 'category', 'type', 'balance_type', 'currency', 'is_active']);

            $query->chunk(200, function ($accounts) use ($handle) {
                foreach ($accounts as $account) {
                    fputcsv($handle, [
                        $account->code,
                        $account->name,
                        $account->category,
                        $account->type,
                        $account->balance_type,
                        $account->currency,
                        $account->is_active ? '1' : '0',
                    ]);
                }
            });

            fclose($handle);
        }, $fileName);
    }

    public function import(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'accounts_csv' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $imported = 0;
        $path = $request->file('accounts_csv')->getRealPath();
        $rows = array_map('str_getcsv', file($path));

        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue;
            }

            $code = $row[0] ?? null;
            $name = $row[1] ?? null;
            if (!$code || !$name) {
                continue;
            }

            $account = FinanceAccount::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'category' => $row[2] ?? 'asset',
                    'type' => in_array($row[3] ?? 'posting', $this->types, true) ? $row[3] : 'posting',
                    'balance_type' => in_array($row[4] ?? 'debit', $this->balanceTypes, true) ? $row[4] : 'debit',
                    'currency' => $row[5] ?? config('app.currency', 'USD'),
                    'is_active' => ($row[6] ?? '1') === '1',
                    'is_postable' => ($row[3] ?? 'posting') === 'posting',
                    'level' => 1,
                    'is_leaf' => ($row[3] ?? 'posting') === 'posting',
                ]
            );

            $imported++;
        }

        Toastr::success(translate('finance_accounts_imported_successfully', ['count' => $imported]));
        return back();
    }

    /**
     * Attach calculated balances to the paginated account listing so the view can display live totals.
     */
    private function attachAccountBalances(LengthAwarePaginator $accounts): void
    {
        $collection = $accounts->getCollection();
        if ($collection->isEmpty()) {
            return;
        }

        $balances = $this->fetchAccountBalances($collection->pluck('id'));

        $collection->transform(function (FinanceAccount $account) use ($balances) {
            $account->current_balance = $balances[$account->id] ?? (float) $account->opening_balance;
            return $account;
        });

        $accounts->setCollection($collection);
    }

    private function fetchAccountBalances(Collection $accountIds): array
    {
        if ($accountIds->isEmpty()) {
            return [];
        }

        $rows = FinanceJournalRow::query()
            ->select([
                'finance_accounts.id as account_id',
                'finance_accounts.balance_type',
                'finance_accounts.opening_balance',
                DB::raw("SUM(CASE WHEN finance_journal_rows.entry_type = 'debit' THEN finance_journal_rows.amount ELSE 0 END) as debit_total"),
                DB::raw("SUM(CASE WHEN finance_journal_rows.entry_type = 'credit' THEN finance_journal_rows.amount ELSE 0 END) as credit_total"),
            ])
            ->join('finance_accounts', 'finance_accounts.id', '=', 'finance_journal_rows.account_id')
            ->join('finance_journals', 'finance_journals.id', '=', 'finance_journal_rows.journal_id')
            ->whereIn('finance_accounts.id', $accountIds)
            ->whereNull('finance_journals.deleted_at')
            ->where('finance_journals.status', 'posted')
            ->groupBy('finance_accounts.id', 'finance_accounts.balance_type', 'finance_accounts.opening_balance')
            ->get();

        $balances = [];

        foreach ($rows as $row) {
            $opening = (float) $row->opening_balance;
            $debit = (float) $row->debit_total;
            $credit = (float) $row->credit_total;

            $balances[$row->account_id] = $row->balance_type === 'credit'
                ? $opening + ($credit - $debit)
                : $opening + ($debit - $credit);
        }

        return $balances;
    }

    private function validatePayload(Request $request, ?int $accountId = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:64', Rule::unique('finance_accounts', 'code')->ignore($accountId)],
            'name' => ['required', 'string', 'max:191'],
            'category' => ['required', Rule::in($this->categories)],
            'type' => ['required', Rule::in($this->types)],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:finance_accounts,id'],
            'currency' => ['nullable', 'string', 'size:3'],
            'balance_type' => ['required', Rule::in($this->balanceTypes)],
            'opening_balance' => ['nullable', 'numeric', 'min:0'],
            'metadata' => ['nullable', 'array'],
        ]);
    }

    private function prepareAccountPayload(array $validated, ?FinanceAccount $parent, bool $active): array
    {
        $level = $parent ? $parent->level + 1 : 1;

        return [
            'code' => $validated['code'],
            'name' => $validated['name'],
            'category' => $validated['category'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
            'parent_id' => $parent?->id,
            'level' => $level,
            'is_leaf' => $validated['type'] === 'posting',
            'is_active' => $active,
            'is_postable' => $validated['type'] === 'posting',
            'currency' => strtoupper($validated['currency'] ?? config('app.currency', 'USD')),
            'balance_type' => $validated['balance_type'],
            'opening_balance' => $validated['opening_balance'] ?? 0,
            'metadata' => $validated['metadata'] ?? null,
        ];
    }
}
