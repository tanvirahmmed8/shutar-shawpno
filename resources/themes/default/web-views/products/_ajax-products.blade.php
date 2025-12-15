@if(count($products) > 0)
    @php($decimal_point_settings = getWebConfig(name: 'decimal_point_settings'))
    @foreach($products as $product)
        @if(!empty($product['product_id']))
            @php($product=$product->product)
        @endif
        <div class="fashion-product-grid-item {{Request::is('products*')?'col-lg-3 col-md-4 col-sm-4 col-6':'col-lg-2 col-md-3 col-sm-4 col-6'}} {{Request::is('shopView*')?'col-lg-3 col-md-4 col-sm-4 col-6':''}} p-2">
            @if(!empty($product))
                <div class="fashion-product-wrapper">
                    @include('web-views.partials._filter-single-product',['product'=>$product, 'decimal_point_settings'=>$decimal_point_settings])
                </div>
            @endif
        </div>
    @endforeach

    <div class="fashion-pagination-wrapper col-12">
        <nav class="fashion-pagination d-flex justify-content-between pt-2" aria-label="Page navigation"
             id="paginator-ajax">
            {!! $products->links() !!}
        </nav>
    </div>
@else
    <div class="fashion-no-products d-flex justify-content-center align-items-center w-100 py-5">
        <div class="fashion-no-products-content text-center">
            <div class="fashion-no-products-icon mb-3">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-muted">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
                </svg>
            </div>
            <h6 class="fashion-no-products-title text-muted">{{ translate('no_product_found') }}</h6>
            <p class="fashion-no-products-subtitle text-muted small">{{ translate('try_adjusting_your_filters_or_search_terms') }}</p>
        </div>
    </div>
@endif
