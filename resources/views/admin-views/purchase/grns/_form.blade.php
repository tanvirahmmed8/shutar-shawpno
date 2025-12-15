@php($isEdit = isset($grn) && $grn)
@php($lineItems = old('items'))
@if(empty($lineItems))
    @if($isEdit)
        @php($lineItems = $grn->items->map(fn($item) => [
            'order_item_id' => $item->order_item_id,
            'ordered_qty' => optional($item->orderItem)->quantity,
            'outstanding_qty' => max((optional($item->orderItem)->quantity ?? 0) - (optional($item->orderItem)->received_qty ?? 0), 0),
            'uom' => $item->uom,
            'received_qty' => $item->received_qty,
            'accepted_qty' => $item->accepted_qty,
            'rejected_qty' => $item->rejected_qty,
            'batch_number' => $item->batch_number,
            'lot_number' => $item->lot_number,
            @php($generatedCode = $generatedCode ?? '')
            'expiry_date' => optional($item->expiry_date)->format('Y-m-d'),
            'storage_location' => $item->storage_location,
            'remarks' => $item->remarks,
            'inspection_notes' => $item->inspection_notes,
        ])->toArray())
    @else
        @php($lineItems = $order->items->map(function ($item) {
            $outstanding = max($item->quantity - $item->received_qty, 0);
            return [
                'order_item_id' => $item->id,
                'ordered_qty' => $item->quantity,
                'outstanding_qty' => $outstanding,
                'uom' => $item->uom,
                'received_qty' => $outstanding ?: 1,
                'accepted_qty' => $outstanding ?: 1,
                'rejected_qty' => 0,
                'batch_number' => null,
                'lot_number' => null,
                'expiry_date' => null,
                'storage_location' => null,
                'remarks' => null,
                'inspection_notes' => null,
            ];
        })->values()->toArray())
    @endif
@endif
@if(empty($lineItems))
    @php($lineItems = [[
        'order_item_id' => null,
        'ordered_qty' => null,
        'outstanding_qty' => null,
        'uom' => null,
        'received_qty' => 1,
        'accepted_qty' => 1,
        'rejected_qty' => 0,
        'batch_number' => null,
        'lot_number' => null,
        'expiry_date' => null,
        'storage_location' => null,
        'remarks' => null,
        'inspection_notes' => null,
    ]])
@endif
@php($receivedValue = old('received_at', optional($grn->received_at ?? now())->format('Y-m-d\TH:i')))
<form action="{{ $isEdit ? route('admin.purchase.grns.update', $grn->id) : route('admin.purchase.grns.store') }}" method="post">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <div class="alert alert-soft-info d-flex flex-wrap justify-content-between gap-3 align-items-center">
        <div>
            <h5 class="mb-1 text-capitalize">{{ translate('purchase_order') }}: {{ $order->code }}</h5>
            <p class="mb-0 text-muted">{{ translate('vendor') }}: {{ optional($order->vendor)->display_name ?? translate('not_set') }}</p>
        </div>
        <a href="{{ route('admin.purchase.orders.show', $order->id) }}" class="btn btn-outline-secondary btn-sm">{{ translate('view_purchase_order') }}</a>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('grn_code') }}</label>
            <input type="text" name="code" class="form-control" value="{{ old('code', $grn->code ?? $generatedCode) }}" readonly>
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('warehouse_id') }}</label>
            <input type="number" name="warehouse_id" class="form-control" value="{{ old('warehouse_id', $grn->warehouse_id ?? '') }}" placeholder="{{ translate('optional') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('received_at') }}</label>
            <input type="datetime-local" name="received_at" class="form-control" value="{{ $receivedValue }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('remarks') }}</label>
            <input type="text" name="remarks" class="form-control" value="{{ old('remarks', $grn->remarks ?? '') }}" placeholder="{{ translate('optional') }}">
        </div>
    </div>

    <div class="card mt-4" data-grn-items data-order-items='@json($order->items->map(fn($item) => [
        'id' => $item->id,
        'label' => trim($item->description ?: ('SKU #' . $item->product_id)) ?: ('#' . $item->id),
        'uom' => $item->uom,
        'ordered_qty' => $item->quantity,
        'received_qty' => $item->received_qty,
        'outstanding_qty' => max($item->quantity - $item->received_qty, 0),
    ]))' data-next-index="{{ count($lineItems) }}">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0 text-capitalize">{{ translate('receipt_line_items') }}</h4>
                <button type="button" class="btn btn-outline--primary btn-sm" id="add-grn-line">
                    <i class="tio-add"></i>
                    <span class="ps-1">{{ translate('add_line') }}</span>
                </button>
            </div>
            <div id="grn-line-items" class="d-flex flex-column gap-3">
                @foreach($lineItems as $index => $item)
                    @include('admin-views.purchase.grns.partials.line-item', ['index' => $index, 'item' => $item])
                @endforeach
            </div>
            <template id="grn-line-item-template">
                @include('admin-views.purchase.grns.partials.line-item-template')
            </template>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap gap-3 mt-4">
        <a href="{{ route('admin.purchase.grns.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn--primary">{{ $isEdit ? translate('update_receipt') : translate('save_receipt') }}</button>
        </div>
    </div>
</form>

@push('script')
<script>
(function () {
    const wrapper = document.querySelector('[data-grn-items]');
    if (!wrapper) {
        return;
    }

    const orderItems = JSON.parse(wrapper.dataset.orderItems || '[]');
    const container = document.getElementById('grn-line-items');
    const template = document.getElementById('grn-line-item-template').innerHTML;
    let nextIndex = Number(wrapper.dataset.nextIndex || 0);

    function hydrateSelect(select, selectedValue) {
        select.innerHTML = '<option value="">' + @json(translate('select_order_item')) + '</option>';
        orderItems.forEach(function (item) {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.label + ' (' + item.uom + ')';
            option.dataset.orderedQty = item.ordered_qty;
            option.dataset.outstandingQty = item.outstanding_qty;
            option.dataset.uom = item.uom;
            option.selected = String(selectedValue || '') === String(item.id);
            select.appendChild(option);
        });
    }

    function syncCard(card) {
        const select = card.querySelector('[data-order-item-select]');
        const orderedEl = card.querySelector('[data-ordered-qty]');
        const outstandingEl = card.querySelector('[data-outstanding-qty]');
        const uomInput = card.querySelector('[data-uom-input]');
        const option = select.selectedOptions[0];
        if (!option) {
            orderedEl.textContent = '--';
            outstandingEl.textContent = '--';
            return;
        }
        orderedEl.textContent = option.dataset.orderedQty || '--';
        outstandingEl.textContent = option.dataset.outstandingQty || '--';
        if (uomInput && !uomInput.value) {
            uomInput.value = option.dataset.uom || '';
        }
    }

    document.getElementById('add-grn-line').addEventListener('click', function () {
        const html = template.replace(/__INDEX__/g, nextIndex);
        const fragment = document.createElement('div');
        fragment.innerHTML = html.trim();
        const card = fragment.firstElementChild;
        container.appendChild(card);
        const select = card.querySelector('[data-order-item-select]');
        hydrateSelect(select);
        syncCard(card);
        nextIndex += 1;
    });

    container.querySelectorAll('[data-order-item-select]').forEach(function (select) {
        hydrateSelect(select, select.dataset.selectedValue || null);
    });

    container.querySelectorAll('[data-grn-line-card]').forEach(syncCard);

    container.addEventListener('change', function (event) {
        if (event.target.matches('[data-order-item-select]')) {
            syncCard(event.target.closest('[data-grn-line-card]'));
        }
    });

    container.addEventListener('click', function (event) {
        if (event.target.closest('.remove-grn-line')) {
            const cards = container.querySelectorAll('[data-grn-line-card]');
            if (cards.length === 1) {
                return;
            }
            event.target.closest('[data-grn-line-card]').remove();
        }
    });
})();
</script>
@endpush
