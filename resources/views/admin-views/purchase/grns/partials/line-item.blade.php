@php($prefix = "items[{$index}]")
<div class="card border" data-grn-line-card>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
            <div class="flex-grow-1">
                <label class="form-label text-capitalize">{{ translate('order_item') }}</label>
                <select name="{{ $prefix }}[order_item_id]" class="form-control" data-order-item-select data-selected-value="{{ $item['order_item_id'] }}" required></select>
                <small class="text-muted d-block mt-1">
                    {{ translate('ordered_qty') }}: <span data-ordered-qty>{{ $item['ordered_qty'] ?? '--' }}</span>
                    | {{ translate('outstanding_qty') }}: <span data-outstanding-qty>{{ $item['outstanding_qty'] ?? '--' }}</span>
                </small>
            </div>
            <button type="button" class="btn btn-link text-danger remove-grn-line">
                <i class="tio-delete"></i>
            </button>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('received_qty') }}</label>
                <input type="number" step="0.01" min="0.01" name="{{ $prefix }}[received_qty]" class="form-control" value="{{ $item['received_qty'] }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('accepted_qty') }}</label>
                <input type="number" step="0.01" min="0" name="{{ $prefix }}[accepted_qty]" class="form-control" value="{{ $item['accepted_qty'] }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('rejected_qty') }}</label>
                <input type="number" step="0.01" min="0" name="{{ $prefix }}[rejected_qty]" class="form-control" value="{{ $item['rejected_qty'] }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('uom') }}</label>
                <input type="text" name="{{ $prefix }}[uom]" class="form-control" value="{{ $item['uom'] }}" data-uom-input>
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('batch_number') }}</label>
                <input type="text" name="{{ $prefix }}[batch_number]" class="form-control" value="{{ $item['batch_number'] }}" placeholder="{{ translate('optional') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('lot_number') }}</label>
                <input type="text" name="{{ $prefix }}[lot_number]" class="form-control" value="{{ $item['lot_number'] }}" placeholder="{{ translate('optional') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('expiry_date') }}</label>
                <input type="date" name="{{ $prefix }}[expiry_date]" class="form-control" value="{{ $item['expiry_date'] }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('storage_location') }}</label>
                <input type="text" name="{{ $prefix }}[storage_location]" class="form-control" value="{{ $item['storage_location'] }}" placeholder="{{ translate('optional') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-capitalize">{{ translate('remarks') }}</label>
                <textarea name="{{ $prefix }}[remarks]" class="form-control" rows="2">{{ $item['remarks'] }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label text-capitalize">{{ translate('inspection_notes') }}</label>
                <textarea name="{{ $prefix }}[inspection_notes]" class="form-control" rows="2">{{ $item['inspection_notes'] }}</textarea>
            </div>
        </div>
    </div>
</div>
