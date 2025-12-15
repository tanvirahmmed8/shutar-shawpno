<div class="card border" data-grn-line-card>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start gap-3 flex-wrap">
            <div class="flex-grow-1">
                <label class="form-label text-capitalize">{{ translate('order_item') }}</label>
                <select name="items[__INDEX__][order_item_id]" class="form-control" data-order-item-select required></select>
                <small class="text-muted d-block mt-1">
                    {{ translate('ordered_qty') }}: <span data-ordered-qty>--</span>
                    | {{ translate('outstanding_qty') }}: <span data-outstanding-qty>--</span>
                </small>
            </div>
            <button type="button" class="btn btn-link text-danger remove-grn-line">
                <i class="tio-delete"></i>
            </button>
        </div>
        <div class="row g-3 mt-1">
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('received_qty') }}</label>
                <input type="number" step="0.01" min="0.01" name="items[__INDEX__][received_qty]" class="form-control" value="1" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('accepted_qty') }}</label>
                <input type="number" step="0.01" min="0" name="items[__INDEX__][accepted_qty]" class="form-control" value="1" required>
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('rejected_qty') }}</label>
                <input type="number" step="0.01" min="0" name="items[__INDEX__][rejected_qty]" class="form-control" value="0">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('uom') }}</label>
                <input type="text" name="items[__INDEX__][uom]" class="form-control" data-uom-input>
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('batch_number') }}</label>
                <input type="text" name="items[__INDEX__][batch_number]" class="form-control" placeholder="{{ translate('optional') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('lot_number') }}</label>
                <input type="text" name="items[__INDEX__][lot_number]" class="form-control" placeholder="{{ translate('optional') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('expiry_date') }}</label>
                <input type="date" name="items[__INDEX__][expiry_date]" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label text-capitalize">{{ translate('storage_location') }}</label>
                <input type="text" name="items[__INDEX__][storage_location]" class="form-control" placeholder="{{ translate('optional') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label text-capitalize">{{ translate('remarks') }}</label>
                <textarea name="items[__INDEX__][remarks]" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label text-capitalize">{{ translate('inspection_notes') }}</label>
                <textarea name="items[__INDEX__][inspection_notes]" class="form-control" rows="2"></textarea>
            </div>
        </div>
    </div>
</div>
