<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\BaseController;
use App\Models\Purchase\PurchaseEvent;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnEvent;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Purchase\PurchaseVendor;
use App\Services\Purchase\GoodsReceiptWorkflowService;
use App\Services\Purchase\InventorySyncService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PurchaseGrnController extends BaseController
{
    public function __construct(
        private GoodsReceiptWorkflowService $workflow,
        private InventorySyncService $inventorySyncService
    ) {
    }

    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $this->authorize('viewAny', PurchaseGrn::class);

        $filters = [
            'search' => trim((string) $request->get('search')),
            'status' => $request->get('status'),
            'vendor_id' => $request->get('vendor_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
            'inventory_status' => $request->get('inventory_status'),
        ];

        $grns = PurchaseGrn::with(['order.vendor', 'receiver'])
            ->when($filters['search'], function ($query, $search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('code', 'like', "%{$search}%")
                        ->orWhereHas('order', function ($orderQuery) use ($search) {
                            $orderQuery->where('code', 'like', "%{$search}%")
                                ->orWhereHas('vendor', function ($vendorQuery) use ($search) {
                                    $vendorQuery->where('display_name', 'like', "%{$search}%")
                                        ->orWhere('primary_email', 'like', "%{$search}%");
                                });
                        });
                });
            })
            ->when($filters['status'], fn($query, $status) => $query->where('status', $status))
            ->when($filters['vendor_id'], function ($query, $vendorId) {
                $query->whereHas('order', fn($orderQuery) => $orderQuery->where('vendor_id', $vendorId));
            })
            ->when($filters['date_from'], fn($query, $from) => $query->whereDate('received_at', '>=', $from))
            ->when($filters['date_to'], fn($query, $to) => $query->whereDate('received_at', '<=', $to))
            ->when($filters['inventory_status'], fn($query, $status) => $query->where('inventory_sync_status', $status))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->appends($request->query());

        $vendors = PurchaseVendor::orderBy('display_name')
            ->select('id', 'display_name')
            ->get();

        return view('admin-views.purchase.grns.index', [
            'grns' => $grns,
            'filters' => $filters,
            'statusOptions' => $this->statusOptions(),
            'inventoryStatuses' => $this->inventoryStatuses(),
            'vendors' => $vendors,
        ]);
    }

    public function create(Request $request): RedirectResponse|View
    {
        $this->authorize('create', PurchaseGrn::class);
        $orderId = (int) $request->get('order_id', 0);
        if (! $orderId) {
            Toastr::warning(translate('purchase_grn_order_required'));
            return redirect()->route('admin.purchase.orders.index');
        }

        $order = PurchaseOrder::with(['vendor', 'items'])->findOrFail($orderId);

        return view('admin-views.purchase.grns.create', [
            'grn' => null,
            'order' => $order,
            'generatedCode' => $this->workflow->generateCode(),
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', PurchaseGrn::class);
        $validated = $this->validatePayload($request, true);
        $order = PurchaseOrder::with('items')->findOrFail($validated['order_id']);

        try {
            $grn = $this->workflow->create($order, $validated);
            Toastr::success(translate('purchase_grn_saved_draft'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return redirect()->route('admin.purchase.grns.edit', $grn->id);
    }

    public function show(PurchaseGrn $grn): View
    {
        $this->authorize('view', $grn);
        $grn->load([
            'order.vendor',
            'items.orderItem',
            'returns.items',
        ]);

        $events = PurchaseGrnEvent::where('grn_id', $grn->id)
            ->latest()
            ->limit(25)
            ->get();

        $globalEvents = PurchaseEvent::where('payload->grn_id', $grn->id)
            ->latest()
            ->limit(25)
            ->get();

        return view('admin-views.purchase.grns.show', [
            'grn' => $grn,
            'order' => $grn->order,
            'events' => $events,
            'globalEvents' => $globalEvents,
            'statusOptions' => $this->statusOptions(),
            'inventoryStatuses' => $this->inventoryStatuses(),
        ]);
    }

    public function edit(PurchaseGrn $grn): View
    {
        $this->authorize('update', $grn);
        $grn->load(['order.vendor', 'order.items', 'items.orderItem']);

        return view('admin-views.purchase.grns.edit', [
            'grn' => $grn,
            'order' => $grn->order,
            'statusOptions' => $this->statusOptions(),
        ]);
    }

    public function update(Request $request, PurchaseGrn $grn): RedirectResponse
    {
        $this->authorize('update', $grn);
        $validated = $this->validatePayload($request, false);
        $order = $grn->order()->with('items')->firstOrFail();

        try {
            $this->workflow->update($grn, $order, $validated);
            Toastr::success(translate('purchase_grn_saved_draft'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return redirect()->route('admin.purchase.grns.edit', $grn->id);
    }

    public function destroy(PurchaseGrn $grn): RedirectResponse
    {
        $this->authorize('delete', $grn);
        if ($grn->status !== GoodsReceiptWorkflowService::STATUS_DRAFT) {
            Toastr::warning(translate('purchase_grn_delete_not_allowed'));
            return back();
        }

        $grn->delete();
        Toastr::success(translate('purchase_grn_deleted'));
        return redirect()->route('admin.purchase.grns.index');
    }

    public function submit(PurchaseGrn $grn): RedirectResponse
    {
        $this->authorize('update', $grn);

        try {
            $this->workflow->submitForReview($grn);
            Toastr::success(translate('purchase_grn_submitted_for_review'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function approve(PurchaseGrn $grn): RedirectResponse
    {
        $this->authorize('approve', $grn);

        try {
            $this->workflow->approve($grn);
            Toastr::success(translate('purchase_grn_approved'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function reject(PurchaseGrn $grn, Request $request): RedirectResponse
    {
        $this->authorize('reject', $grn);
        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        try {
            $this->workflow->reject($grn, $validated['reason']);
            Toastr::success(translate('purchase_grn_rejected'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function markReturned(PurchaseGrn $grn, Request $request): RedirectResponse
    {
        $this->authorize('markReturned', $grn);
        $validated = $request->validate([
            'reference' => ['nullable', 'string', 'max:120'],
        ]);

        try {
            $this->workflow->markReturned($grn, $validated['reference'] ?? null);
            Toastr::success(translate('purchase_grn_marked_returned'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function retryInventorySync(PurchaseGrn $grn): RedirectResponse
    {
        $this->authorize('retryInventory', $grn);
        if ($grn->status !== GoodsReceiptWorkflowService::STATUS_APPROVED) {
            Toastr::warning(translate('purchase_grn_inventory_retry_not_allowed'));
            return back();
        }

        $grn->forceFill(['inventory_sync_status' => 'queued'])->save();
        $this->inventorySyncService->queue($grn->fresh('items.orderItem'));
        Toastr::success(translate('purchase_grn_inventory_retry_queued'));

        return back();
    }

    private function validatePayload(Request $request, bool $isStore): array
    {
        $rules = [
            'code' => ['nullable', 'string', 'max:191'],
            'warehouse_id' => ['nullable', 'integer'],
            'received_at' => ['required', 'date'],
            'remarks' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.order_item_id' => ['required', 'exists:purchase_order_items,id'],
            'items.*.uom' => ['nullable', 'string', 'max:32'],
            'items.*.received_qty' => ['required', 'numeric', 'min:0.01'],
            'items.*.accepted_qty' => ['nullable', 'numeric', 'min:0'],
            'items.*.rejected_qty' => ['nullable', 'numeric', 'min:0'],
            'items.*.batch_number' => ['nullable', 'string', 'max:120'],
            'items.*.lot_number' => ['nullable', 'string', 'max:120'],
            'items.*.expiry_date' => ['nullable', 'date'],
            'items.*.storage_location' => ['nullable', 'string', 'max:120'],
            'items.*.serial_numbers' => ['nullable', 'array'],
            'items.*.metadata' => ['nullable', 'array'],
            'items.*.remarks' => ['nullable', 'string'],
            'items.*.inspection_notes' => ['nullable', 'string'],
        ];

        if ($isStore) {
            $rules['order_id'] = ['required', 'exists:purchase_orders,id'];
        }

        $validated = $request->validate($rules);
        $validated['items'] = array_values($validated['items']);

        return $validated;
    }

    private function statusOptions(): array
    {
        return [
            GoodsReceiptWorkflowService::STATUS_DRAFT,
            GoodsReceiptWorkflowService::STATUS_PENDING_REVIEW,
            GoodsReceiptWorkflowService::STATUS_APPROVED,
            GoodsReceiptWorkflowService::STATUS_REJECTED,
            GoodsReceiptWorkflowService::STATUS_RETURNED,
        ];
    }

    private function inventoryStatuses(): array
    {
        return ['pending', 'queued', 'processing', 'synced', 'failed'];
    }

    private function validationErrorResponse(ValidationException $exception): RedirectResponse
    {
        $message = collect($exception->errors())->flatten()->first();
        if ($message) {
            Toastr::error($message);
        }

        return back()->withErrors($exception->errors())->withInput();
    }
}
