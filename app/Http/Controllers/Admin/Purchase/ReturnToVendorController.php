<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\BaseController;
use App\Models\Purchase\PurchaseGrn;
use App\Models\Purchase\PurchaseGrnReturn;
use App\Services\Purchase\GoodsReceiptWorkflowService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;

class ReturnToVendorController extends BaseController
{
    public function __construct(private GoodsReceiptWorkflowService $workflow)
    {
    }

    public function index(?Request $request, string $type = null): View|EloquentCollection|LengthAwarePaginator|callable|RedirectResponse|null
    {
        abort(404);
    }

    public function store(PurchaseGrn $grn, Request $request): RedirectResponse
    {
        $this->authorize('initiateReturn', $grn);
        $validated = $this->validateReturnPayload($request);

        try {
            $this->workflow->createReturn($grn, $validated);
            Toastr::success(translate('purchase_grn_return_created'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function ship(PurchaseGrnReturn $return, Request $request): RedirectResponse
    {
        $grn = $return->grn;
        $this->authorize('updateReturn', $grn);

        $validated = $request->validate([
            'carrier' => ['nullable', 'string', 'max:120'],
            'tracking_number' => ['nullable', 'string', 'max:120'],
        ]);

        try {
            $this->workflow->markReturnShipped($return, $validated);
            Toastr::success(translate('purchase_grn_return_marked_shipped'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    public function close(PurchaseGrnReturn $return): RedirectResponse
    {
        $grn = $return->grn;
        $this->authorize('updateReturn', $grn);

        try {
            $this->workflow->closeReturn($return);
            Toastr::success(translate('purchase_grn_return_closed'));
        } catch (ValidationException $exception) {
            return $this->validationErrorResponse($exception);
        }

        return back();
    }

    private function validateReturnPayload(Request $request): array
    {
        $validated = $request->validate([
            'carrier' => ['nullable', 'string', 'max:120'],
            'tracking_number' => ['nullable', 'string', 'max:120'],
            'return_reason' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.grn_item_id' => ['required', 'exists:purchase_grn_items,id'],
            'items.*.return_qty' => ['required', 'numeric', 'min:0.01'],
            'items.*.disposition' => ['nullable', 'string', 'max:40'],
            'items.*.restock_decision' => ['nullable', 'string', 'max:40'],
            'items.*.remarks' => ['nullable', 'string'],
            'document' => ['nullable', 'file', 'max:10240'],
        ]);

        $validated['items'] = array_values($validated['items']);
        return $validated;
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
