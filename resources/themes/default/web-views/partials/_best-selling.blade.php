<div class="fashion-best-selling-section col-lg-6 px-max-md-0">
    <div class="fashion-best-selling-card card __shadow h-100">
        <div class="fashion-best-selling-body card-body p-xl-35">
            <div class="fashion-best-selling-header row d-flex justify-content-between mx-1 mb-3">
                <div class="fashion-best-selling-title">
                    <div class="fashion-best-selling-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary">
                            <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="currentColor"/>
                            <path d="M19 15L20.09 18.26L24 19L20.09 19.74L19 23L17.91 19.74L14 19L17.91 18.26L19 15Z" fill="currentColor"/>
                            <path d="M5 15L6.09 18.26L10 19L6.09 19.74L5 23L3.91 19.74L0 19L3.91 18.26L5 15Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <span class="fashion-best-selling-text font-bold pl-1">{{ translate('best_sellings')}}</span>
                </div>
                <div class="fashion-best-selling-action">
                    <a class="btn-fashion btn-fashion-link view-all-text"
                       href="{{route('products',['data_from'=>'best-selling','page'=>1])}}">{{ translate('view_all')}}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="fashion-best-selling-grid row g-3">
                @foreach($bestSellProduct as $key=> $bestSellItem)
                    @if($bestSellItem && $key<6)
                        <div class="fashion-best-selling-item col-sm-6">
                            <a class="fashion-best-selling-link __best-selling" href="{{route('product',$bestSellItem->slug)}}">
                                @if(getProductPriceByType(product: $bestSellItem, type: 'discount', result: 'value') > 0)
                                    <div class="fashion-best-selling-discount d-flex">
                                        <span class="fashion-discount-badge for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                            <span class="direction-ltr d-block">
                                                -{{ getProductPriceByType(product: $bestSellItem, type: 'discount', result: 'string') }}
                                            </span>
                                        </span>
                                    </div>
                                @endif
                                <div class="fashion-best-selling-content d-flex flex-wrap">
                                    <div class="fashion-best-selling-image best-selleing-image">
                                        <img class="fashion-product-thumbnail rounded"
                                             src="{{ getStorageImages(path: $bestSellItem?->thumbnail_full_url, type: 'product') }}"
                                             alt="{{ translate('product') }}"/>
                                    </div>
                                    <div class="fashion-best-selling-details best-selling-details">
                                        <h6 class="fashion-product-title widget-product-title">
                                        <span class="ptr fw-semibold">
                                            {{ Str::limit($bestSellItem['name'],100) }}
                                        </span>
                                        </h6>
                                        @php($overallRating = getOverallRating($bestSellItem['reviews']))
                                        @if($overallRating[0] != 0 )
                                            <div class="fashion-product-rating rating-show">
                                            <span class="fashion-rating-stars d-inline-block font-size-sm text-body">
                                                @for($inc=1;$inc<=5;$inc++)
                                                    @if ($inc <= (int)$overallRating[0])
                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-star-filled">
                                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#ffc107"/>
                                                        </svg>
                                                    @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-star-half">
                                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="url(#halfStar)"/>
                                                            <defs>
                                                                <linearGradient id="halfStar" x1="0%" y1="0%" x2="100%" y2="0%">
                                                                    <stop offset="50%" style="stop-color:#ffc107;stop-opacity:1" />
                                                                    <stop offset="50%" style="stop-color:#e9ecef;stop-opacity:1" />
                                                                </linearGradient>
                                                            </defs>
                                                        </svg>
                                                    @else
                                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-star-empty">
                                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="#e9ecef" stroke-width="1" fill="none"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                                <span class="fashion-rating-count badge-style ms-1">( {{ count($bestSellItem['reviews']) }} )</span>
                                            </span>
                                            </div>
                                        @endif
                                        <div class="fashion-product-pricing widget-product-meta d-flex flex-wrap gap-8 align-items-center row-gap-0">
                                            <span class="fashion-original-price">
                                                @if(getProductPriceByType(product: $bestSellItem, type: 'discount', result: 'value') > 0)
                                                    <del class="__color-9B9B9B __text-12px">
                                                        {{ webCurrencyConverter(amount: $bestSellItem->unit_price) }}
                                                    </del>
                                                @endif
                                            </span>
                                            <span class="fashion-current-price text-accent text-dark">
                                                {{ getProductPriceByType(product: $bestSellItem, type: 'discounted_unit_price', result: 'string') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
