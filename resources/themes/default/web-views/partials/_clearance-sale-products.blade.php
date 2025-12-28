@if (count($clearanceSaleProducts) > 0)
<section class="fashion-clearance-sale-section container rtl pb-4 px-max-sm-0">
    <div class="fashion-clearance-card __shadow-2">
        <div class="fashion-clearance-content __p-20px rounded bg-white overflow-hidden">
            <div class="fashion-clearance-header d-flex __gap-6px flex-between align-items-center mb-4">
                <div class="fashion-clearance-title-container">
                    <div class="fashion-clearance-title-bg clearance-sale-title-bg" data-bg-img="{{ theme_asset(path: 'public/site-assets/front-end/img/media/clearance-sale-title-bg.svg') }}">
                        <div class="fashion-clearance-subtitle sub-title">
                            <span>{{ translate('Save_More') }}</span>
                        </div>
                        <div class="fashion-clearance-title title">
                            <span>{{ translate('Clearance_Sale') }}</span>
                        </div>
                    </div>
                </div>
                <div class="fashion-clearance-action">
                    <a class="btn-fashion btn-fashion-secondary view-all-text text-nowrap"
                       href="{{ route('products', ['offer_type' => 'clearance_sale', 'page'=> 1]) }}">
                        {{ translate('view_all')}}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="fashion-clearance-products mt-2">
                <div class="fashion-clearance-desktop carousel-wrap-2 d-none d-sm-block">
                    <div class="fashion-clearance-slider owl-carousel owl-theme category-wise-product-slider clearance-sale-slider"
                         data-loop="{{ count($clearanceSaleProducts) >= 6 ? 'true' : 'false' }}">
                        @foreach($clearanceSaleProducts as $key => $product)
                            <div class="fashion-carousel-item">
                                @include('web-views.partials._filter-single-product', ['product'=> $product])
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="fashion-clearance-mobile d-sm-none">
                    <div class="fashion-clearance-grid row g-2 h-100">
                        @foreach($clearanceSaleProducts as $key => $product)
                            @if(count($clearanceSaleProducts) >= 4 ? ($key < 4) : ($key < 2))
                                <div class="fashion-clearance-item col-6">
                                    @include('web-views.partials._filter-single-product', ['product' => $product])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
