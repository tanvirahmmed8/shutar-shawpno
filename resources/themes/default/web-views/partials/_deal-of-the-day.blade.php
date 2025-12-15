@if(isset($product))
    <div class="fashion-container container rtl">
        <div class="fashion-daily-deal-content row g-4 pt-2 mt-0 pb-2 __deal-of align-items-start">
            <div class="col-xl-3 col-md-4">
                <div class="fashion-deal-card deal_of_the_day h-100 bg--light">
                    @if(isset($dealOfTheDay->product))
                        <div class="fashion-deal-header d-flex justify-content-center align-items-center py-4">
                            <h4 class="fashion-deal-title font-bold fs-16 m-0 align-items-center text-uppercase text-center px-2 web-text-primary">
                                {{ translate('deal_of_the_day') }}
                            </h4>
                        </div>
                        <div class="fashion-deal-product-card recommended-product-card mt-0 min-height-auto">
                            <div class="fashion-deal-image d-flex justify-content-center align-items-center __pt-20 __m-20-r">
                                <div class="fashion-deal-image-container position-relative">
                                    <img class="fashion-deal-img __rounded-top aspect-1 h-auto" alt=""
                                         src="{{ getStorageImages(path: $dealOfTheDay?->product?->thumbnail_full_url, type: 'product') }}">
                                    @if(getProductPriceByType(product: $dealOfTheDay?->product, type: 'discount', result: 'value') > 0)
                                        <span class="fashion-deal-discount for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                            <span class="direction-ltr d-block">
                                                -{{ getProductPriceByType(product: $dealOfTheDay?->product, type: 'discount', result: 'string') }}
                                            </span>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="__i-1 bg-transparent text-center mb-0">
                                <div class="px-0">
                                    @php($overallRating = getOverallRating($dealOfTheDay->product['reviews']))
                                    @if($overallRating[0] != 0 )
                                        <div class="rating-show">
                                            <span class="d-inline-block font-size-sm text-body">
                                                @for($inc=1;$inc<=5;$inc++)
                                                    @if ($inc <= (int)$overallRating[0])
                                                        <i class="tio-star text-warning"></i>
                                                    @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1)
                                                        <i class="tio-star-half text-warning"></i>
                                                    @else
                                                        <i class="tio-star-outlined text-warning"></i>
                                                    @endif
                                                @endfor
                                                <label class="badge-style">( {{ count($dealOfTheDay->product['reviews']) }} )</label>
                                            </span>
                                        </div>
                                    @endif
                                    <h6 class="font-semibold pt-1">
                                        {{ Str::limit($dealOfTheDay->product['name'], 80) }}
                                    </h6>
                                    <div class="mb-4 pt-1 d-flex flex-wrap justify-content-center align-items-center text-center gap-8">

                                        @if(getProductPriceByType(product: $dealOfTheDay?->product, type: 'discount', result: 'value') > 0)
                                            <del class="fs-14 font-semibold __color-9B9B9B">
                                                {{ webCurrencyConverter(amount: $dealOfTheDay?->product?->unit_price) }}
                                            </del>
                                        @endif
                                        <span class="text-accent fs-18 font-bold text-dark">
                                            {{ getProductPriceByType(product: $dealOfTheDay?->product, type: 'discounted_unit_price', result: 'string') }}
                                        </span>
                                    </div>
                                    <button class="btn btn--primary font-bold px-4 rounded-10 text-uppercase get-view-by-onclick"
                                            data-link="{{ route('product',$dealOfTheDay->product->slug) }}">
                                            {{translate('buy_now')}}
                                    </button>

                                </div>
                            </div>
                        </div>
                    @else
                        @if(isset($recommendedProduct))
                            <div class="d-flex justify-content-center align-items-center py-4">
                                <h4 class="font-bold fs-16 m-0 align-items-center text-uppercase text-center px-2 web-text-primary">
                                    {{ translate('recommended_product') }}
                                </h4>
                            </div>
                            <div class="recommended-product-card mt-0">

                                <div class="d-flex justify-content-center align-items-center __pt-20 __m-20-r">
                                    <div class="position-relative">
                                        <img src="{{ getStorageImages(path: $recommendedProduct?->thumbnail_full_url, type: 'product') }}"
                                            alt="">
                                        @if($recommendedProduct->discount > 0)
                                            <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                                <span class="direction-ltr d-block">
                                                    @if ($recommendedProduct->discount_type == 'percent')
                                                        -{{ round($recommendedProduct->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}%
                                                    @elseif($recommendedProduct->discount_type =='flat')
                                                        -{{ webCurrencyConverter(amount: $recommendedProduct->discount) }}
                                                    @endif
                                                </span>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="__i-1 bg-transparent text-center mb-0 min-height-auto">
                                    <div class="px-0 pb-0">
                                        @php($overallRating = getOverallRating($recommendedProduct['reviews']))
                                        @if($overallRating[0] != 0 )
                                            <div class="rating-show">
                                                <span class="d-inline-block font-size-sm text-body">
                                                    @for($inc=0;$inc<5;$inc++)
                                                        @if ($inc <= (int)$overallRating[0])
                                                            <i class="tio-star text-warning"></i>
                                                        @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                            <i class="tio-star-half text-warning"></i>
                                                        @else
                                                            <i class="tio-star-outlined text-warning"></i>
                                                        @endif
                                                    @endfor
                                                    <label class="badge-style">( {{ count($recommendedProduct->reviews) }} )</label>
                                                </span>

                                            </div>
                                        @endif
                                        <h6 class="font-semibold pt-1">
                                            {{ Str::limit($recommendedProduct['name'],30) }}
                                        </h6>
                                        <div class="mb-4 pt-1 d-flex flex-wrap justify-content-center align-items-center text-center gap-8">
                                            @if($recommendedProduct->discount > 0)
                                                <del class="__text-12px __color-9B9B9B">
                                                    {{ webCurrencyConverter(amount: $recommendedProduct->unit_price) }}
                                                </del>
                                            @endif
                                            <span class="text-accent __text-22px text-dark">
                                                {{ webCurrencyConverter(amount:
                                                    $recommendedProduct->unit_price-(getProductDiscount(product: $recommendedProduct, price: $recommendedProduct->unit_price))
                                                ) }}
                                            </span>
                                        </div>
                                        <button class="btn btn--primary font-bold px-4 rounded-10 text-uppercase get-view-by-onclick"
                                                data-link="{{ route('product',$recommendedProduct->slug) }}">
                                            {{translate('buy_now')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class="col-xl-9 col-md-8">
                <div class="fashion-latest-products latest-product-margin">
                    <div class="fashion-latest-header d-flex justify-content-between align-items-end mb-4">
                        <div class="fashion-latest-info">
                            <h2 class="fashion-section-title for-feature-title __text-22px font-bold">
                                {{ translate('latest_products')}}
                            </h2>
                            <p class="fashion-section-subtitle mb-0">{{ translate('fresh_arrivals_just_in') }}</p>
                        </div>
                        <div class="fashion-latest-action mr-1">
                            <a class="btn-fashion btn-fashion-secondary view-all-text"
                               href="{{route('products',['data_from'=>'latest'])}}">
                                {{ translate('view_all')}}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="fashion-latest-grid row mt-0 g-2">
                        @foreach($latestProductsList as $product)
                            <div class="fashion-latest-item col-xl-3 col-sm-4 col-md-6 col-lg-4 col-6">
                                <div class="fashion-latest-product">
                                    @include('web-views.partials._inline-single-product',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
