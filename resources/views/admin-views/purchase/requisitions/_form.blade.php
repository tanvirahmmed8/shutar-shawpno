@php($isEdit = isset($requisition))
@php($buildProductSnapshot = static function ($payload, ?int $fallbackId = null) {
    if ((empty($payload) || ! is_array($payload)) && ! $fallbackId) {
        return null;
    }

    if (! is_array($payload)) {
        $payload = [];
    }

    $sku = data_get($payload, 'sku') ?? data_get($payload, 'code');
    $name = data_get($payload, 'name');
    $uom = data_get($payload, 'uom') ?? data_get($payload, 'unit');
    $purchasePrice = data_get($payload, 'purchase_price');
    $label = trim(($sku ? '[' . $sku . '] ' : '') . ($name ?? ''));

    if ($label === '' && $fallbackId) {
        $label = '#' . $fallbackId;
    }

    return [
        'id' => data_get($payload, 'id', $fallbackId),
        'sku' => $sku,
        'name' => $name,
        'uom' => $uom,
        'purchase_price' => $purchasePrice,
        'label' => $label,
    ];
})
@php($lineItems = old('items', $isEdit ? $requisition->items->map(function ($item) use ($buildProductSnapshot) {
    $snapshot = $buildProductSnapshot(data_get($item->metadata, 'catalog'), $item->product_id);

    if (! $snapshot && $item->relationLoaded('product') && $item->product) {
        $snapshot = $buildProductSnapshot([
            'id' => $item->product->id,
            'sku' => $item->product->code,
            'name' => $item->product->name,
            'uom' => $item->product->unit,
            'purchase_price' => $item->product->purchase_price,
        ], $item->product_id);
    }

    return [
        'product_id' => $item->product_id,
        'description' => $item->description,
        'uom' => $item->uom,
        'quantity' => $item->quantity,
        'unit_price' => $item->unit_price,
        'delivery_date' => optional($item->delivery_date)->format('Y-m-d'),
        'product_snapshot' => $snapshot,
    ];
})->toArray() : []))
@if(empty($lineItems))
    @php($lineItems = [[
        'product_id' => null,
        'description' => '',
        'uom' => '',
        'quantity' => 1,
        'unit_price' => 0,
        'delivery_date' => null,
        'product_snapshot' => null,
    ]])
@endif
@include('admin-views.purchase.partials.catalog-fallback', ['catalogFallbackVendorId' => null])
<form action="{{ $isEdit ? route('admin.purchase.requisitions.update', $requisition->id) : route('admin.purchase.requisitions.store') }}" method="post">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <div class="row g-4">
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('requisition_code') }}</label>
            <input type="text" class="form-control" value="{{ $isEdit ? $requisition->code : $generatedCode }}" readonly>
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('priority') }}</label>
            <select name="priority" class="form-control" required>
                @foreach($priorityOptions as $option)
                    <option value="{{ $option }}" {{ old('priority', $requisition->priority ?? 'medium') === $option ? 'selected' : '' }}>
                        {{ ucfirst($option) }}
                    </option>
                @endforeach
            </select>
        </div>
        @php($neededByValue = old('needed_by', ($isEdit && $requisition->needed_by) ? $requisition->needed_by->format('Y-m-d') : ''))
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('needed_by') }}</label>
            <input type="date" name="needed_by" class="form-control" value="{{ $neededByValue }}">
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('currency') }}</label>
            <select name="currency" class="form-control" required>
                @foreach($currencyOptions as $currency)
                    <option value="{{ $currency }}" {{ old('currency', $requisition->currency ?? 'USD') === $currency ? 'selected' : '' }}>{{ $currency }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label text-capitalize">{{ translate('cost_center') }}</label>
            <input type="number" name="cost_center_id" class="form-control" value="{{ old('cost_center_id', $requisition->cost_center_id ?? '') }}">
        </div>
        <div class="col-md-4">
            <label class="form-label text-capitalize">{{ translate('approval_route') }}</label>
            <select name="approval_route_id" class="form-control select2">
                <option value="">{{ translate('select_approval_route') }}</option>
                @foreach($approvalRoutes as $route)
                    <option value="{{ $route->id }}" {{ (string) old('approval_route_id', $requisition->approval_route_id ?? '') === (string) $route->id ? 'selected' : '' }}>
                        {{ $route->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label class="form-label text-capitalize">{{ translate('justification') }}</label>
            <textarea name="justification" rows="3" class="form-control">{{ old('justification', $requisition->justification ?? '') }}</textarea>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body" data-line-items data-product-search-endpoint="{{ route('admin.purchase.catalog-products.search') }}" data-next-index="{{ count($lineItems) }}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 text-capitalize">{{ translate('line_items') }}</h5>
                <button class="btn btn-outline--primary btn-sm" type="button" id="add-line-item">
                    <i class="tio-add"></i>
                    <span class="ps-1">{{ translate('add_line_item') }}</span>
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-align-middle">
                    <thead>
                        <tr>
                            <th>{{ translate('product') }}</th>
                            <th>{{ translate('description') }}</th>
                            <th>{{ translate('uom') }}</th>
                            <th>{{ translate('quantity') }}</th>
                            <th>{{ translate('unit_price') }}</th>
                            <th>{{ translate('delivery_date') }}</th>
                            <th>{{ translate('line_total') }}</th>
                            <th class="text-end">{{ translate('actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="line-items-body">
                        @foreach($lineItems as $index => $item)
                            <tr data-index="{{ $index }}" data-product-row>
                                <td>
                                    @php($snapshot = data_get($item, 'product_snapshot'))
                                    @php($productLabel = data_get($snapshot, 'label'))
                                    @php($productLabel = $productLabel ?: ($item['product_id'] ? '#' . $item['product_id'] : ''))
                                    <select name="items[{{ $index }}][product_id]" class="form-control" data-product-picker data-placeholder="{{ translate('search_product') }}" data-initial-id="{{ $item['product_id'] }}" data-initial-label="{{ $productLabel }}" required>
                                        <option value="">{{ translate('select_product') }}</option>
                                        @if($item['product_id'] && $productLabel)
                                            <option value="{{ $item['product_id'] }}" selected>{{ $productLabel }}</option>
                                        @endif
                                    </select>
                                    <input type="hidden" name="items[{{ $index }}][product_snapshot][id]" value="{{ data_get($snapshot, 'id', $item['product_id']) }}" data-product-snapshot="id">
                                    <input type="hidden" name="items[{{ $index }}][product_snapshot][sku]" value="{{ data_get($snapshot, 'sku') }}" data-product-snapshot="sku">
                                    <input type="hidden" name="items[{{ $index }}][product_snapshot][name]" value="{{ data_get($snapshot, 'name') }}" data-product-snapshot="name">
                                    <input type="hidden" name="items[{{ $index }}][product_snapshot][uom]" value="{{ data_get($snapshot, 'uom') }}" data-product-snapshot="uom">
                                    <input type="hidden" name="items[{{ $index }}][product_snapshot][purchase_price]" value="{{ data_get($snapshot, 'purchase_price') }}" data-product-snapshot="purchase_price">
                                    <input type="hidden" name="items[{{ $index }}][product_snapshot][label]" value="{{ $productLabel }}" data-product-snapshot="label">
                                </td>
                                <td>
                                    <input type="text" name="items[{{ $index }}][description]" class="form-control" value="{{ $item['description'] }}" data-product-description required>
                                </td>
                                <td>
                                    <input type="text" name="items[{{ $index }}][uom]" class="form-control" value="{{ $item['uom'] }}" data-product-uom required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" min="0.01" name="items[{{ $index }}][quantity]" class="form-control" value="{{ $item['quantity'] }}" required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" min="0" name="items[{{ $index }}][unit_price]" class="form-control" value="{{ $item['unit_price'] }}" data-product-unit-price required>
                                </td>
                                <td>
                                    <input type="date" name="items[{{ $index }}][delivery_date]" class="form-control" value="{{ $item['delivery_date'] }}">
                                </td>
                                <td class="fw-semibold">
                                    <span data-line-total>{{ number_format((float) ($item['quantity'] * $item['unit_price']), 2) }}</span>
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-link text-danger p-0 remove-line-item" type="button">
                                        <i class="tio-delete"></i>
                                        <span class="visually-hidden">{{ translate('remove_line_item') }}</span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <template id="line-item-template">
                <tr data-index="__INDEX__" data-product-row>
                    <td>
                        <select name="items[__INDEX__][product_id]" class="form-control" data-product-picker data-placeholder="{{ translate('search_product') }}" data-initial-id="" data-initial-label="" required>
                            <option value="">{{ translate('select_product') }}</option>
                        </select>
                        <input type="hidden" name="items[__INDEX__][product_snapshot][id]" data-product-snapshot="id">
                        <input type="hidden" name="items[__INDEX__][product_snapshot][sku]" data-product-snapshot="sku">
                        <input type="hidden" name="items[__INDEX__][product_snapshot][name]" data-product-snapshot="name">
                        <input type="hidden" name="items[__INDEX__][product_snapshot][uom]" data-product-snapshot="uom">
                        <input type="hidden" name="items[__INDEX__][product_snapshot][purchase_price]" data-product-snapshot="purchase_price">
                        <input type="hidden" name="items[__INDEX__][product_snapshot][label]" data-product-snapshot="label">
                    </td>
                    <td>
                        <input type="text" name="items[__INDEX__][description]" class="form-control" data-product-description required>
                    </td>
                    <td>
                        <input type="text" name="items[__INDEX__][uom]" class="form-control" data-product-uom required>
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0.01" name="items[__INDEX__][quantity]" class="form-control" value="1" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="items[__INDEX__][unit_price]" class="form-control" value="0" data-product-unit-price required>
                    </td>
                    <td>
                        <input type="date" name="items[__INDEX__][delivery_date]" class="form-control">
                    </td>
                    <td class="fw-semibold">
                        <span data-line-total>0.00</span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-link text-danger p-0 remove-line-item" type="button">
                            <i class="tio-delete"></i>
                            <span class="visually-hidden">{{ translate('remove_line_item') }}</span>
                        </button>
                    </td>
                </tr>
            </template>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-3 mt-4">
        <a href="{{ route('admin.purchase.requisitions.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
        <button type="submit" class="btn btn--primary">{{ $isEdit ? translate('update') : translate('create') }}</button>
    </div>
</form>

@push('script')
    @once('purchase-product-picker-script')
        <script src="{{ asset('assets/back-end/js/purchase-product-picker.js') }}"></script>
    @endonce
    <script>
        (function () {
            const wrapper = document.querySelector('[data-line-items]');
            if (!wrapper) {
                return;
            }

            const tbody = wrapper.querySelector('#line-items-body');
            const template = document.getElementById('line-item-template').innerHTML;
            let nextIndex = Number(wrapper.dataset.nextIndex || 0);

            if (window.PurchaseProductPicker) {
                window.PurchaseProductPicker.init(wrapper);
            }

            document.getElementById('add-line-item').addEventListener('click', function () {
                const markup = template.replaceAll('__INDEX__', nextIndex);
                const container = document.createElement('tbody');
                container.innerHTML = markup.trim();
                const row = container.firstElementChild;
                tbody.appendChild(row);
                if (window.PurchaseProductPicker) {
                    window.PurchaseProductPicker.init(row);
                }
                nextIndex += 1;
            });

            tbody.addEventListener('click', function (event) {
                if (event.target.closest('.remove-line-item')) {
                    const rows = tbody.querySelectorAll('tr');
                    if (rows.length === 1) {
                        return;
                    }
                    event.target.closest('tr').remove();
                }
            });
        })();
    </script>
@endpush
