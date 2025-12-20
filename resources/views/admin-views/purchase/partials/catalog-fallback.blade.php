<div class="card mb-4">
    <div class="card-body d-flex flex-column flex-lg-row align-items-lg-center gap-3">
        <div class="flex-grow-1">
            <h5 class="mb-1 text-capitalize">{{ translate('manual_catalog_lookup') }}</h5>
            <p class="text-muted mb-0 small">{{ translate('paste_a_sku_and_open_the_result_in_a_new_tab_if_select2_is_unavailable') }}</p>
        </div>
        <form action="{{ route('admin.purchase.catalog-products.manual') }}" method="get" target="_blank" rel="noopener" class="row g-2 align-items-end flex-grow-1 flex-lg-grow-0" data-product-fallback-form>
            <div class="col-sm-7 col-md-8">
                <label class="form-label text-capitalize mb-0">{{ translate('sku_or_product_code') }}</label>
                <input type="text" name="sku" class="form-control form-control-sm" placeholder="{{ translate('enter_sku') }}" required>
            </div>
            @if(!empty($catalogFallbackVendorId))
                <input type="hidden" name="vendor_id" value="{{ $catalogFallbackVendorId }}">
            @endif
            <div class="col-sm-5 col-md-4 d-grid">
                <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                    <i class="tio-search"></i>
                    <span class="ps-1">{{ translate('lookup') }}</span>
                </button>
            </div>
        </form>
    </div>
</div>
