@php($isEdit = isset($order))
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
@php($lineItems = old('items', $isEdit ? $order->items->map(function ($item) use ($buildProductSnapshot) {
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
        'tax_percent' => $item->tax_percent,
        'discount_percent' => $item->discount_percent,
        'tax_amount' => $item->tax_amount,
        'discount_amount' => $item->discount_amount,
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
        'tax_percent' => 0,
        'discount_percent' => 0,
        'tax_amount' => 0,
        'discount_amount' => 0,
        'delivery_date' => null,
        'product_snapshot' => null,
    ]])
@endif
@include('admin-views.purchase.partials.catalog-fallback', ['catalogFallbackVendorId' => old('vendor_id', $order->vendor_id ?? null)])
<form action="{{ $isEdit ? route('admin.purchase.orders.update', $order->id) : route('admin.purchase.orders.store') }}" method="post">
    @csrf
    @if($isEdit)
        @method('put')
    @endif
    <div class="row g-4">
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('purchase_order_code') }}</label>
            <input type="text" class="form-control" value="{{ $isEdit ? $order->code : $generatedCode }}" readonly>
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('vendor') }}</label>
            <select name="vendor_id" id="purchase-order-vendor" class="form-control select2" required>
                <option value="">{{ translate('select_vendor') }}</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}" {{ (string) old('vendor_id', $order->vendor_id ?? '') === (string) $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->display_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('currency') }}</label>
            <select name="currency" class="form-control" required>
                @foreach($currencyOptions as $currency)
                    <option value="{{ $currency }}" {{ old('currency', $order->currency ?? 'USD') === $currency ? 'selected' : '' }}>{{ $currency }}</option>
                @endforeach
            </select>
        </div>
        @php($expectedDeliveryValue = old('expected_delivery', optional(optional($order)->expected_delivery)->format('Y-m-d')))
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('expected_delivery') }}</label>
            <input type="date" name="expected_delivery" class="form-control" value="{{ $expectedDeliveryValue }}">
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('payment_terms') }}</label>
            <input type="text" name="payment_terms" class="form-control" value="{{ old('payment_terms', $order->payment_terms ?? '') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label text-capitalize">{{ translate('exchange_rate') }}</label>
            <input type="number" step="0.0001" min="0" name="exchange_rate" class="form-control" value="{{ old('exchange_rate', $order->exchange_rate ?? 1) }}">
        </div>
        <div class="col-md-2">
            <label class="form-label text-capitalize">{{ translate('freight_cost') }}</label>
            <input type="number" step="0.01" min="0" name="freight_cost" class="form-control" value="{{ old('freight_cost', $order->freight_cost ?? 0) }}">
        </div>
        <div class="col-md-2">
            <label class="form-label text-capitalize">{{ translate('tax_total') }}</label>
            <input type="number" step="0.01" min="0" name="tax_total" class="form-control" value="{{ old('tax_total', $order->tax_total ?? 0) }}">
        </div>
        <div class="col-md-2">
            <label class="form-label text-capitalize">{{ translate('discount_total') }}</label>
            <input type="number" step="0.01" min="0" name="discount_total" class="form-control" value="{{ old('discount_total', $order->discount_total ?? 0) }}">
        </div>
        <div class="col-md-4">
            <label class="form-label text-capitalize">{{ translate('approval_route') }}</label>
            <select name="approval_route_id" class="form-control select2">
                <option value="">{{ translate('select_approval_route') }}</option>
                @foreach($approvalRoutes as $route)
                    <option value="{{ $route->id }}" {{ (string) old('approval_route_id', $order->approval_route_id ?? '') === (string) $route->id ? 'selected' : '' }}>
                        {{ $route->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label class="form-label text-capitalize">{{ translate('internal_notes') }}</label>
            <textarea name="notes_internal" rows="2" class="form-control">{{ old('notes_internal', $order->notes_internal ?? '') }}</textarea>
        </div>
        <div class="col-12">
            <label class="form-label text-capitalize">{{ translate('vendor_notes') }}</label>
            <textarea name="notes_vendor" rows="2" class="form-control">{{ old('notes_vendor', $order->notes_vendor ?? '') }}</textarea>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body" data-line-items data-product-search-endpoint="{{ route('admin.purchase.catalog-products.search') }}" data-next-index="{{ count($lineItems) }}" data-vendor-field="#purchase-order-vendor" data-vendor-id="{{ old('vendor_id', $order->vendor_id ?? '') }}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0 text-capitalize">{{ translate('line_items') }}</h5>
                <button class="btn btn-outline--primary btn-sm" type="button" id="add-po-line-item">
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
                        <th class="text-end">{{ translate('quantity') }}</th>
                        <th class="text-end">{{ translate('unit_price') }}</th>
                        <th class="text-end">{{ translate('tax_percent') }}</th>
                        <th class="text-end">{{ translate('discount_percent') }}</th>
                        <th class="text-end">{{ translate('line_total') }}</th>
                        <th class="text-end">{{ translate('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody id="po-line-items">
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
                                <input type="number" step="0.01" min="0.01" name="items[{{ $index }}][quantity]" class="form-control text-end" value="{{ $item['quantity'] }}" required data-quantity>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" name="items[{{ $index }}][unit_price]" class="form-control text-end" value="{{ $item['unit_price'] }}" data-product-unit-price required data-unit-price>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" name="items[{{ $index }}][tax_percent]" class="form-control text-end" value="{{ $item['tax_percent'] }}" data-tax-percent>
                            </td>
                            <td>
                                <input type="number" step="0.01" min="0" name="items[{{ $index }}][discount_percent]" class="form-control text-end" value="{{ $item['discount_percent'] }}" data-discount-percent>
                            </td>
                            <td class="text-end fw-semibold">
                                <span data-line-total>{{ number_format((float) $item['quantity'] * (float) $item['unit_price'], 2) }}</span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-link text-danger p-0 remove-line-item" type="button">
                                    <i class="tio-delete"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <template id="po-line-item-template">
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
                        <input type="number" step="0.01" min="0.01" name="items[__INDEX__][quantity]" class="form-control text-end" value="1" required data-quantity>
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="items[__INDEX__][unit_price]" class="form-control text-end" value="0" data-product-unit-price required data-unit-price>
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="items[__INDEX__][tax_percent]" class="form-control text-end" value="0" data-tax-percent>
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="items[__INDEX__][discount_percent]" class="form-control text-end" value="0" data-discount-percent>
                    </td>
                    <td class="text-end fw-semibold">
                        <span data-line-total>0.00</span>
                    </td>
                    <td class="text-end">
                        <button class="btn btn-link text-danger p-0 remove-line-item" type="button">
                            <i class="tio-delete"></i>
                        </button>
                    </td>
                </tr>
            </template>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap gap-3 mt-4">
        <a href="{{ route('admin.purchase.orders.index') }}" class="btn btn-secondary">{{ translate('cancel') }}</a>
        <div class="d-flex gap-2">
            <button type="submit" name="submission_intent" value="save" class="btn btn-outline-primary">{{ translate('save_draft') }}</button>
            <button type="submit" name="submission_intent" value="submit" class="btn btn--primary">{{ translate('submit_for_approval') }}</button>
        </div>
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

            const tbody = wrapper.querySelector('#po-line-items');
            const template = document.getElementById('po-line-item-template').innerHTML;
            let nextIndex = Number(wrapper.dataset.nextIndex || 0);
            const vendorSelect = document.getElementById('purchase-order-vendor');

            if (window.PurchaseProductPicker) {
                window.PurchaseProductPicker.init(wrapper);
            }

            if (vendorSelect) {
                vendorSelect.addEventListener('change', function () {
                    wrapper.dataset.vendorId = vendorSelect.value || '';
                    if (window.PurchaseProductPicker && typeof window.PurchaseProductPicker.clearCache === 'function') {
                        window.PurchaseProductPicker.clearCache();
                    }
                    const $ = window.jQuery;
                    if (!$) {
                        return;
                    }
                    wrapper.querySelectorAll('[data-product-picker]').forEach(function (select) {
                        $(select).val(null).trigger('change');
                    });
                });
            }

            document.getElementById('add-po-line-item').addEventListener('click', function () {
                const html = template.replaceAll('__INDEX__', nextIndex);
                const fragment = document.createElement('tbody');
                fragment.innerHTML = html.trim();
                const row = fragment.firstElementChild;
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

            tbody.addEventListener('input', function (event) {
                if (event.target.matches('[data-quantity], [data-unit-price], [data-tax-percent], [data-discount-percent]')) {
                    const row = event.target.closest('tr');
                    const quantity = parseFloat(row.querySelector('[data-quantity]')?.value || '0');
                    const unitPrice = parseFloat(row.querySelector('[data-unit-price]')?.value || '0');
                    const taxPercent = parseFloat(row.querySelector('[data-tax-percent]')?.value || '0');
                    const discountPercent = parseFloat(row.querySelector('[data-discount-percent]')?.value || '0');
                    const base = quantity * unitPrice;
                    const taxAmount = base * (taxPercent / 100);
                    const discountAmount = base * (discountPercent / 100);
                    row.querySelector('[data-line-total]').textContent = (base + taxAmount - discountAmount).toFixed(2);
                }
            });
        })();
    </script>
@endpush
