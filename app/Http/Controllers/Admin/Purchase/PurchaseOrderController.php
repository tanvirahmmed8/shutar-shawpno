<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\BaseController;
use App\Models\Purchase\PurchaseApprovalRoute;
use App\Models\Purchase\PurchaseEvent;
use App\Models\Purchase\PurchaseOrder;
use App\Models\Purchase\PurchaseRequisition;
use App\Models\Purchase\PurchaseVendor;
use App\Services\Purchase\PurchaseOrderWorkflowService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

class PurchaseOrderController extends BaseController
{
    public function __construct(private PurchaseOrderWorkflowService $workflow)
    {
    }

    public function index(?Request $request = null, string $type = null): View
    {
        $request = $request ?? request();
        $this->authorize('viewAny', PurchaseOrder::class);

        $filters = [
            'search' => trim((string) $request->get('search')),
            'status' => $request->get('status'),
            'vendor_id' => $request->get('vendor_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        $orders = PurchaseOrder::with(['vendor.primaryContact', 'buyer'])
            ->when($filters['search'], function ($query, $search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('code', 'like', "%{$search}%")
                        ->orWhereHas('vendor', function ($vendorQuery) use ($search) {
                            $vendorQuery->where('display_name', 'like', "%{$search}%")
                                ->orWhere('primary_email', 'like', "%{$search}%");
                        });
                });
            })
            ->when($filters['status'], fn($query, $status) => $query->where('status', $status))
            ->when($filters['vendor_id'], fn($query, $vendorId) => $query->where('vendor_id', $vendorId))
            ->when($filters['date_from'], fn($query, $from) => $query->whereDate('created_at', '>=', $from))
            ->when($filters['date_to'], fn($query, $to) => $query->whereDate('created_at', '<=', $to))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->appends($request->query());

        $vendors = PurchaseVendor::orderBy('display_name')
            ->select('id', 'display_name')
            ->get();

        return view('admin-views.purchase.orders.index', [
            'orders' => $orders,
            'filters' => $filters,
            'statusOptions' => $this->statusOptions(),
            'vendors' => $vendors,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', PurchaseOrder::class);
        [$vendors, $approvalRoutes] = $this->formDependencies();

        return view('admin-views.purchase.orders.create', [
            'statusOptions' => $this->statusOptions(),
            'order' => null,
            'vendors' => $vendors,
            'approvalRoutes' => $approvalRoutes,
            'currencyOptions' => $this->currencyOptions(),
            'generatedCode' => $this->workflow->generateCode(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', PurchaseOrder::class);
        $validated = $this->validateOrder($request);

        try {
            $order = $this->workflow->create(
                $this->preparedPayload($validated),
                $validated['items']
            );
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        try {
            $this->handleSubmissionIntent(
                $request->input('submission_intent', 'save'),
                $order,
                $validated['approval_route_id'] ?? null
            );
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return redirect()->route('admin.purchase.orders.edit', $order->id);
    }

    public function show(PurchaseOrder $order): View
    {
        $this->authorize('view', $order);

        $order->load([
            'vendor.contacts',
            'items',
            'buyer',
            'requisition',
            'communications' => fn($query) => $query->latest(),
            'approvals.approver',
        ]);

        $events = PurchaseEvent::where('payload->order_id', $order->id)
            ->latest()
            ->limit(25)
            ->get();

        return view('admin-views.purchase.orders.show', [
            'order' => $order,
            'statusOptions' => $this->statusOptions(),
            'events' => $events,
        ]);
    }

    public function edit(PurchaseOrder $order): View
    {
        $this->authorize('update', $order);
        $order->load(['items.product', 'vendor']);
        [$vendors, $approvalRoutes] = $this->formDependencies();

        return view('admin-views.purchase.orders.edit', [
            'order' => $order,
            'statusOptions' => $this->statusOptions(),
            'vendors' => $vendors,
            'approvalRoutes' => $approvalRoutes,
            'currencyOptions' => $this->currencyOptions(),
        ]);
    }

    public function update(Request $request, PurchaseOrder $order): RedirectResponse
    {
        $this->authorize('update', $order);
        $validated = $this->validateOrder($request);

        try {
            $order = $this->workflow->update(
                $order,
                $this->preparedPayload($validated),
                $validated['items']
            );
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        try {
            $this->handleSubmissionIntent(
                $request->input('submission_intent', 'save'),
                $order,
                $validated['approval_route_id'] ?? null
            );
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return redirect()->route('admin.purchase.orders.edit', $order->id);
    }

    public function destroy(PurchaseOrder $order): RedirectResponse
    {
        $this->authorize('delete', $order);
        if (! in_array($order->status, [
            PurchaseOrderWorkflowService::STATUS_DRAFT,
            PurchaseOrderWorkflowService::STATUS_REJECTED,
        ], true)) {
            Toastr::warning(translate('purchase_order_delete_not_allowed'));
            return back();
        }

        $order->delete();
        Toastr::success(translate('purchase_order_deleted'));
        return redirect()->route('admin.purchase.orders.index');
    }

    public function storeFromRequisition(PurchaseRequisition $requisition, Request $request): RedirectResponse
    {
        $this->authorize('create', PurchaseOrder::class);
        $validated = $request->validate([
            'vendor_id' => ['required', 'exists:purchase_vendors,id'],
            'currency' => ['nullable', 'size:3'],
            'approval_route_id' => ['nullable', 'exists:purchase_approval_routes,id'],
        ]);

        try {
            $order = $this->workflow->convertFromRequisition($requisition, $validated);
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        Toastr::success(translate('purchase_order_created_from_requisition'));
        return redirect()->route('admin.purchase.orders.edit', $order->id);
    }

    public function send(PurchaseOrder $order, Request $request): RedirectResponse
    {
        $this->authorize('send', $order);
        $payload = $request->validate([
            'channel' => ['nullable', 'string', 'max:40'],
            'recipient' => ['nullable', 'email'],
            'subject' => ['nullable', 'string', 'max:191'],
            'message' => ['nullable', 'string'],
        ]);

        try {
            $this->workflow->sendToVendor($order, $payload);
            Toastr::success(translate('purchase_order_send_queued'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function approve(PurchaseOrder $order, Request $request): RedirectResponse
    {
        $this->authorize('approve', $order);
        $request->validate([
            'comments' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            $this->workflow->approve($order, $request->input('comments'));
            Toastr::success(translate('purchase_order_approved'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function reject(PurchaseOrder $order, Request $request): RedirectResponse
    {
        $this->authorize('reject', $order);
        $request->validate([
            'comments' => ['required', 'string', 'max:500'],
        ]);

        try {
            $this->workflow->reject($order, $request->input('comments'));
            Toastr::success(translate('purchase_order_rejected'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function acknowledge(PurchaseOrder $order): RedirectResponse
    {
        $this->authorize('approve', $order);

        try {
            $this->workflow->acknowledge($order);
            Toastr::success(translate('purchase_order_acknowledged'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function close(PurchaseOrder $order): RedirectResponse
    {
        $this->authorize('approve', $order);

        try {
            $this->workflow->close($order);
            Toastr::success(translate('purchase_order_closed'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    private function statusOptions(): array
    {
        return PurchaseOrderWorkflowService::STATUS_PIPELINE;
    }

    private function formDependencies(): array
    {
        $vendors = PurchaseVendor::orderBy('display_name')
            ->select('id', 'display_name', 'primary_email')
            ->get();

        $routes = PurchaseApprovalRoute::where('is_active', true)
            ->with('steps')
            ->orderBy('name')
            ->get();

        return [$vendors, $routes];
    }

    private function validateOrder(Request $request): array
    {
        $validated = $request->validate([
            'vendor_id' => ['required', 'exists:purchase_vendors,id'],
            'currency' => ['required', 'size:3'],
            'exchange_rate' => ['nullable', 'numeric', 'min:0.0001'],
            'payment_terms' => ['nullable', 'string', 'max:191'],
            'expected_delivery' => ['nullable', 'date'],
            'freight_cost' => ['nullable', 'numeric', 'min:0'],
            'tax_total' => ['nullable', 'numeric', 'min:0'],
            'discount_total' => ['nullable', 'numeric', 'min:0'],
            'notes_internal' => ['nullable', 'string'],
            'notes_vendor' => ['nullable', 'string'],
            'approval_route_id' => ['nullable', 'exists:purchase_approval_routes,id'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'items.*.product_snapshot' => ['nullable', 'array'],
            'items.*.product_snapshot.id' => ['nullable', 'integer'],
            'items.*.product_snapshot.sku' => ['nullable', 'string', 'max:191'],
            'items.*.product_snapshot.name' => ['nullable', 'string', 'max:191'],
            'items.*.product_snapshot.uom' => ['nullable', 'string', 'max:32'],
            'items.*.product_snapshot.purchase_price' => ['nullable', 'numeric'],
            'items.*.product_snapshot.label' => ['nullable', 'string', 'max:191'],
            'items.*.description' => ['required', 'string', 'max:191'],
            'items.*.uom' => ['required', 'string', 'max:32'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'items.*.delivery_date' => ['nullable', 'date'],
            'items.*.tax_percent' => ['nullable', 'numeric', 'min:0'],
            'items.*.tax_amount' => ['nullable', 'numeric', 'min:0'],
            'items.*.discount_percent' => ['nullable', 'numeric', 'min:0'],
            'items.*.discount_amount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $validated['items'] = collect($validated['items'])->map(function ($item) {
            if (! empty($item['product_snapshot']) && is_array($item['product_snapshot'])) {
                $item['product_snapshot'] = array_filter($item['product_snapshot'], static function ($value) {
                    return ! ($value === null || $value === '');
                });

                if (empty($item['product_snapshot'])) {
                    unset($item['product_snapshot']);
                }
            } else {
                unset($item['product_snapshot']);
            }

            return $item;
        })->values()->toArray();

        return $validated;
    }

    private function preparedPayload(array $validated): array
    {
        $attributes = Arr::except($validated, ['items']);
        $attributes['exchange_rate'] = $attributes['exchange_rate'] ?? 1;
        $attributes['freight_cost'] = $attributes['freight_cost'] ?? 0;
        $attributes['tax_total'] = $attributes['tax_total'] ?? 0;
        $attributes['discount_total'] = $attributes['discount_total'] ?? 0;

        return $attributes;
    }

    private function resolveApprovalRoute(?int $routeId, ?PurchaseOrder $order = null): ?PurchaseApprovalRoute
    {
        if ($routeId) {
            return PurchaseApprovalRoute::with('steps')->find($routeId);
        }

        if ($order?->approval_route_id) {
            return PurchaseApprovalRoute::with('steps')->find($order->approval_route_id);
        }

        if ($order?->requisition?->approval_route_id) {
            return PurchaseApprovalRoute::with('steps')->find($order->requisition->approval_route_id);
        }

        return PurchaseApprovalRoute::where('is_active', true)
            ->with('steps')
            ->orderByDesc('priority')
            ->first();
    }

    private function handleSubmissionIntent(string $intent, PurchaseOrder $order, ?int $routeId = null): void
    {
        if ($intent !== 'submit') {
            Toastr::success(translate('purchase_order_saved_draft'));
            return;
        }

        $route = $this->resolveApprovalRoute($routeId, $order);
        if (! $route) {
            throw ValidationException::withMessages([
                'approval_route_id' => [__('no_approval_steps_configured')],
            ]);
        }

        $this->workflow->submitForApproval($order, $route);
        Toastr::success(translate('purchase_order_submitted_for_approval'));
    }

    private function validationErrorResponse(ValidationException $exception): RedirectResponse
    {
        $message = collect($exception->errors())->flatten()->first();
        if ($message) {
            Toastr::error($message);
        }

        return back()->withErrors($exception->errors())->withInput();
    }

    private function currencyOptions(): array
    {
        return ['USD', 'EUR', 'GBP', 'BDT'];
    }
}
