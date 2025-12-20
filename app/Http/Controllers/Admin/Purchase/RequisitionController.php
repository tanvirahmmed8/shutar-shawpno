<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\BaseController;
use App\Models\Purchase\PurchaseApprovalRoute;
use App\Models\Purchase\PurchaseOrderApproval;
use App\Models\Purchase\PurchaseRequisition;
use App\Services\Purchase\ApprovalActionService;
use App\Services\Purchase\ApprovalRouteResolver;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RequisitionController extends BaseController
{
    private array $statusColors = [
        'draft' => 'secondary',
        'pending' => 'secondary',
        'pending_approval' => 'warning',
        'approved' => 'success',
        'rejected' => 'danger',
        'converted' => 'info',
    ];

    public function index(?Request $request, string $type = null): View
    {
        $request = $request ?? request();
        $this->authorize('viewAny', PurchaseRequisition::class);

        $filters = [
            'search' => trim((string) $request->get('search')),
            'status' => $request->get('status'),
            'priority' => $request->get('priority'),
        ];

        $requisitions = PurchaseRequisition::with('requester')
            ->when($filters['search'], function ($query, $search) {
                $query->where(function ($builder) use ($search) {
                    $builder->where('code', 'like', "%{$search}%")
                        ->orWhereHas('requester', function ($relation) use ($search) {
                            $relation->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->when($filters['status'], fn($query, $status) => $query->where('status', $status))
            ->when($filters['priority'], fn($query, $priority) => $query->where('priority', $priority))
            ->orderByDesc('created_at')
            ->paginate(15)
            ->appends(Arr::only($filters, array_keys($filters)));

        return view('admin-views.purchase.requisitions.index', [
            'requisitions' => $requisitions,
            'filters' => $filters,
            'statusOptions' => array_keys($this->statusColors),
            'priorityOptions' => $this->priorityOptions(),
            'statusColors' => $this->statusColors,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', PurchaseRequisition::class);

        return view('admin-views.purchase.requisitions.create', [
            'priorityOptions' => $this->priorityOptions(),
            'currencyOptions' => $this->currencyOptions(),
            'approvalRoutes' => $this->activeApprovalRoutes(),
            'generatedCode' => $this->generateCode(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', PurchaseRequisition::class);
        $validated = $this->validateRequisition($request);

        $requisition = DB::transaction(function () use ($validated) {
            $totals = $this->calculateTotals($validated['items']);
            $requisition = PurchaseRequisition::create([
                'code' => $this->generateCode(),
                'requester_id' => auth('admin')->id(),
                'cost_center_id' => $validated['cost_center_id'] ?? null,
                'priority' => $validated['priority'],
                'status' => 'draft',
                'needed_by' => $validated['needed_by'] ?? null,
                'justification' => $validated['justification'] ?? null,
                'currency' => $validated['currency'],
                'subtotal' => $totals['subtotal'],
                'tax_total' => $totals['tax_total'],
                'grand_total' => $totals['grand_total'],
                'approval_route_id' => $validated['approval_route_id'] ?? null,
                'created_by' => auth('admin')->id(),
                'updated_by' => auth('admin')->id(),
            ]);

            $this->syncItems($requisition, $validated['items']);

            return $requisition;
        });

        Toastr::success(translate('requisition_saved_draft'));
        return redirect()->route('admin.purchase.requisitions.edit', $requisition->id);
    }

    public function show(PurchaseRequisition $requisition): View
    {
        $this->authorize('view', $requisition);
        $requisition->load(['items', 'requester', 'approvals.approver', 'approvalRoute']);

        $pendingApproval = $requisition->approvals
            ->where('status', 'pending')
            ->first(function ($approval) {
                return $approval->approver_id === auth('admin')->id() || $approval->approver_id === null;
            });

        $user = auth('admin')->user();
        $canActOnApproval = (bool) $pendingApproval
            && $user
            && Gate::forUser($user)->allows('approve', $requisition);

        return view('admin-views.purchase.requisitions.show', [
            'requisition' => $requisition,
            'statusColors' => $this->statusColors,
            'canActOnApproval' => $canActOnApproval,
        ]);
    }

    public function edit(PurchaseRequisition $requisition): View
    {
        $this->authorize('update', $requisition);

        return view('admin-views.purchase.requisitions.edit', [
            'requisition' => $requisition->load('items.product'),
            'priorityOptions' => $this->priorityOptions(),
            'currencyOptions' => $this->currencyOptions(),
            'approvalRoutes' => $this->activeApprovalRoutes(),
            'statusColors' => $this->statusColors,
        ]);
    }

    public function update(Request $request, PurchaseRequisition $requisition): RedirectResponse
    {
        $this->authorize('update', $requisition);
        if ($requisition->status !== 'draft') {
            Toastr::warning(translate('requisition_status_invalid_for_action'));
            return back();
        }

        $validated = $this->validateRequisition($request);

        DB::transaction(function () use ($requisition, $validated) {
            $totals = $this->calculateTotals($validated['items']);
            $requisition->update([
                'cost_center_id' => $validated['cost_center_id'] ?? null,
                'priority' => $validated['priority'],
                'needed_by' => $validated['needed_by'] ?? null,
                'justification' => $validated['justification'] ?? null,
                'currency' => $validated['currency'],
                'subtotal' => $totals['subtotal'],
                'tax_total' => $totals['tax_total'],
                'grand_total' => $totals['grand_total'],
                'approval_route_id' => $validated['approval_route_id'] ?? null,
                'updated_by' => auth('admin')->id(),
            ]);

            $this->syncItems($requisition, $validated['items']);
        });

        Toastr::success(translate('requisition_updated_successfully'));
        return redirect()->route('admin.purchase.requisitions.edit', $requisition->id);
    }

    public function destroy(PurchaseRequisition $requisition): RedirectResponse
    {
        $this->authorize('delete', $requisition);
        if ($requisition->status !== 'draft') {
            Toastr::warning(translate('requisition_status_invalid_for_action'));
            return back();
        }

        $requisition->delete();
        Toastr::success(translate('requisition_deleted_successfully'));
        return redirect()->route('admin.purchase.requisitions.index');
    }

    public function submit(PurchaseRequisition $requisition, ApprovalRouteResolver $resolver, ApprovalActionService $approvalActionService): RedirectResponse
    {
        $this->authorize('submit', $requisition);
        if (! in_array($requisition->status, ['draft', 'rejected'], true)) {
            Toastr::warning(translate('requisition_status_invalid_for_action'));
            return back();
        }

        $route = $requisition->approvalRoute ?: $resolver->resolveForRequisition($requisition);
        if ($route) {
            $route->loadMissing('steps');
        }

        if (! $route || $route->steps->isEmpty()) {
            Toastr::error(translate('no_approval_steps_configured'));
            return back();
        }

        $approvalActionService->bootstrapApprovals($requisition, $route);
        Toastr::success(translate('requisition_submitted_for_approval'));
        return back();
    }

    public function approve(PurchaseRequisition $requisition, ApprovalActionService $approvalActionService, Request $request): RedirectResponse
    {
        $this->authorize('approve', $requisition);
        $approval = $this->resolvePendingApproval($requisition);
        if (! $approval) {
            Toastr::warning(translate('requisition_status_invalid_for_action'));
            return back();
        }

        $approvalActionService->approve($requisition, $approval, $request->get('comments'), auth('admin')->id());
        Toastr::success(translate('requisition_approved_successfully'));
        return back();
    }

    public function reject(PurchaseRequisition $requisition, ApprovalActionService $approvalActionService, Request $request): RedirectResponse
    {
        $this->authorize('reject', $requisition);
        $approval = $this->resolvePendingApproval($requisition);
        if (! $approval) {
            Toastr::warning(translate('requisition_status_invalid_for_action'));
            return back();
        }

        $request->validate([
            'comments' => ['required', 'string', 'max:500'],
        ]);

        $approvalActionService->reject($requisition, $approval, $request->get('comments'), auth('admin')->id());
        Toastr::success(translate('requisition_rejected_successfully'));
        return back();
    }

    private function resolvePendingApproval(PurchaseRequisition $requisition): ?PurchaseOrderApproval
    {
        $adminId = auth('admin')->id();

        return $requisition->approvals()
            ->where('status', 'pending')
            ->where(function ($query) use ($adminId) {
                $query->where('approver_id', $adminId)
                    ->orWhereNull('approver_id');
            })
            ->orderBy('step')
            ->first();
    }

    private function validateRequisition(Request $request): array
    {
        $items = $request->input('items', []);
        foreach ($items as $index => $item) {
            if (array_key_exists('product_id', $item) && ($item['product_id'] === '' || $item['product_id'] === null)) {
                $items[$index]['product_id'] = null;
            }
        }

        $request->merge([
            'items' => $items,
            'cost_center_id' => $request->filled('cost_center_id') ? $request->input('cost_center_id') : null,
        ]);

        $validated = $request->validate([
            'priority' => ['required', Rule::in($this->priorityOptions())],
            'needed_by' => ['nullable', 'date', 'after_or_equal:today'],
            'currency' => ['required', 'size:3'],
            'justification' => ['nullable', 'string'],
            'cost_center_id' => ['nullable', 'integer'],
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
            'items.*.delivery_date' => ['nullable', 'date', 'after_or_equal:today'],
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

    private function syncItems(PurchaseRequisition $requisition, array $items): void
    {
        $requisition->items()->delete();
        foreach ($items as $item) {
            $quantity = (float) $item['quantity'];
            $unitPrice = (float) $item['unit_price'];
            $catalogSnapshot = ! empty($item['product_snapshot']) && is_array($item['product_snapshot'])
                ? $item['product_snapshot']
                : null;
            $metadata = ['source' => 'manual_form'];
            if ($catalogSnapshot) {
                $metadata['catalog'] = $catalogSnapshot;
            }
            $requisition->items()->create([
                'product_id' => $item['product_id'] ?? null,
                'description' => $item['description'],
                'uom' => $item['uom'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'line_total' => $quantity * $unitPrice,
                'delivery_date' => $item['delivery_date'] ?? null,
                'metadata' => $metadata,
            ]);
        }
    }

    private function calculateTotals(array $items): array
    {
        $subtotal = collect($items)->sum(function ($item) {
            return (float) $item['quantity'] * (float) $item['unit_price'];
        });

        return [
            'subtotal' => $subtotal,
            'tax_total' => 0,
            'grand_total' => $subtotal,
        ];
    }

    private function generateCode(): string
    {
        do {
            $code = 'PRQ-' . now()->format('ymd') . '-' . Str::upper(Str::random(4));
        } while (PurchaseRequisition::where('code', $code)->exists());

        return $code;
    }

    private function priorityOptions(): array
    {
        return ['low', 'medium', 'high', 'urgent'];
    }

    private function currencyOptions(): array
    {
        return ['USD', 'EUR', 'GBP', 'BDT'];
    }

    private function activeApprovalRoutes()
    {
        return PurchaseApprovalRoute::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->with('steps')
            ->get();
    }
}
