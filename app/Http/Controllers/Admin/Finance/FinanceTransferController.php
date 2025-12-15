<?php

namespace App\Http\Controllers\Admin\Finance;

use App\Enums\ViewPaths\Admin\AccountsFinance;
use App\Http\Controllers\BaseController;
use App\Models\Finance\FinanceAccount;
use App\Models\Finance\FinanceJournal;
use App\Models\Finance\FinanceTransfer;
use Brian2694\Toastr\Facades\Toastr;
use App\Services\Finance\FinancePostingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class FinanceTransferController extends BaseController
{
    private array $statuses = ['draft', 'pending', 'approved', 'rejected'];

    public function __construct(private readonly FinancePostingService $financePostingService)
    {
    }

    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $status = $request->get('status');

        $transfers = FinanceTransfer::with(['sourceAccount', 'destinationAccount', 'journal'])
            ->when($status, fn ($query, $value) => $query->where('status', $value))
            ->orderByDesc('created_at')
            ->paginate(20)
            ->appends($request->query());

        return view(AccountsFinance::TRANSFERS_INDEX[VIEW], [
            'transfers' => $transfers,
            'statusFilter' => $status,
            'statuses' => $this->statuses,
        ]);
    }

    public function create(): View
    {
        return view(AccountsFinance::TRANSFERS_CREATE[VIEW], [
            'accounts' => FinanceAccount::where('is_postable', true)->orderBy('code')->get(),
            'statuses' => $this->statuses,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePayload($request);
        $this->ensureDistinctAccounts($validated['source_account_id'], $validated['destination_account_id']);

        DB::transaction(function () use ($validated) {
            $transfer = FinanceTransfer::create([
                'transfer_number' => $validated['transfer_number'],
                'source_account_id' => $validated['source_account_id'],
                'destination_account_id' => $validated['destination_account_id'],
                'amount' => $validated['amount'],
                'currency' => strtoupper($validated['currency']),
                'exchange_rate' => $validated['exchange_rate'] ?? 1,
                'status' => $validated['status'] ?? 'draft',
                'memo' => $validated['memo'] ?? null,
                'journal_id' => $validated['journal_id'] ?? null,
                'initiated_by' => auth('admin')->id(),
                'initiated_at' => now(),
                'attachment_count' => 0,
                'metadata' => $validated['metadata'] ?? null,
            ]);

            if (($validated['status'] ?? 'draft') === 'approved' && empty($validated['journal_id'])) {
                $this->financePostingService->postFinanceTransfer($transfer->fresh());
            }
        });

        Toastr::success(translate('finance_transfer_created_successfully'));
        return redirect()->route('admin.accounts-finance.transfers.index');
    }

    public function show(FinanceTransfer $transfer): View
    {
        return view(AccountsFinance::TRANSFERS_SHOW[VIEW], [
            'transfer' => $transfer->load(['sourceAccount', 'destinationAccount', 'journal']),
        ]);
    }

    public function approve(FinanceTransfer $transfer, Request $request): RedirectResponse
    {
        if ($transfer->status === 'approved') {
            Toastr::info(translate('transfer_is_already_approved'));
            return back();
        }

        $request->validate([
            'journal_id' => ['nullable', 'exists:finance_journals,id'],
            'status' => ['nullable', Rule::in($this->statuses)],
        ]);

        $newStatus = $request->get('status', 'approved');
        $transfer->update([
            'status' => $newStatus,
            'journal_id' => $request->get('journal_id', $transfer->journal_id),
            'approved_by' => auth('admin')->id(),
            'approved_at' => now(),
        ]);

        $transfer->refresh();
        if ($newStatus === 'approved' && ! $transfer->journal_id) {
            $this->financePostingService->postFinanceTransfer($transfer);
        }

        Toastr::success(translate('finance_transfer_status_updated_successfully'));
        return back();
    }

    public function destroy(FinanceTransfer $transfer): RedirectResponse
    {
        if ($transfer->status === 'approved') {
            Toastr::error(translate('approved_transfer_cannot_be_deleted'));
            return back();
        }

        $transfer->delete();
        Toastr::success(translate('finance_transfer_deleted_successfully'));
        return back();
    }

    private function validatePayload(Request $request, ?int $transferId = null): array
    {
        return $request->validate([
            'transfer_number' => ['required', 'max:50', Rule::unique('finance_transfers', 'transfer_number')->ignore($transferId)],
            'source_account_id' => ['required', 'exists:finance_accounts,id'],
            'destination_account_id' => ['required', 'exists:finance_accounts,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'currency' => ['required', 'string', 'size:3'],
            'exchange_rate' => ['nullable', 'numeric', 'min:0'],
            'status' => ['nullable', Rule::in($this->statuses)],
            'memo' => ['nullable', 'string'],
            'journal_id' => ['nullable', 'exists:finance_journals,id'],
            'metadata' => ['nullable', 'array'],
        ]);
    }

    private function ensureDistinctAccounts(int $sourceAccountId, int $destinationAccountId): void
    {
        if ($sourceAccountId === $destinationAccountId) {
            throw ValidationException::withMessages([
                'destination_account_id' => translate('source_and_destination_accounts_must_differ'),
            ]);
        }
    }
}
