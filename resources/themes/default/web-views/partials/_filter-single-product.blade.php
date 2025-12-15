@php($overallRating = getOverallRating($product->reviews))

<div class="fashion-filter-product product-single-hover style--card h-100">
    <div class="fashion-product-container overflow-hidden position-relative">
        <div class="fashion-product-image inline_product clickable d-flex justify-content-center">
            @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
                <span class="fashion-discount-badge for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                    <span class="direction-ltr d-block">
                        -{{ getProductPriceByType(product: $product, type: 'discount', result: 'string') }}
                    </span>
                </span>
            @else
                <div class="fashion-no-discount d-flex justify-content-end">
                    <span class="for-discount-value-null"></span>
                </div>
            @endif
            <div class="fashion-image-wrapper p-10px pb-0">
                <a href="{{route('product',$product->slug)}}" class="fashion-image-link w-100">
                    <img class="fashion-product-img" alt="{{ $product->name }}" src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}">
                </a>
            </div>

            <div class="fashion-quick-view quick-view">
                <a class="fashion-quick-view-btn btn-circle stopPropagation action-product-quick-view" href="javascript:" data-product-id="{{ $product->id }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </a>
            </div>
            @if($product->product_type == 'physical' && $product->current_stock <= 0)
                <span class="fashion-out-of-stock out_fo_stock">{{translate('out_of_stock')}}</span>
            @endif
        </div>
        <div class="fashion-product-details single-product-details">
            @if($overallRating[0] != 0 )
            <div class="fashion-product-rating rating-show justify-content-between text-center">
                <span class="fashion-rating-stars d-inline-block font-size-sm text-body">
                    @for($inc=1;$inc<=5;$inc++)
                        @if ($inc <= (int)$overallRating[0])
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-star-filled">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="#ffc107"/>
                            </svg>
                        @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-star-half">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" fill="url(#halfStar)"/>
                                <defs>
                                    <linearGradient id="halfStar" x1="0%" y1="0%" x2="100%" y2="0%">
                                        <stop offset="50%" style="stop-color:#ffc107;stop-opacity:1" />
                                        <stop offset="50%" style="stop-color:#e9ecef;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        @else
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-star-empty">
                                <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="#e9ecef" stroke-width="1" fill="none"/>
                            </svg>
                        @endif
                    @endfor
                    <span class="fashion-rating-count badge-style ms-1">( {{ count($product->reviews) }} )</span>
                </span>
            </div>
            @endif
            <div class="fashion-product-title text-center">
                <a href="{{route('product',$product->slug)}}" class="fashion-product-name">
                    {{ $product['name'] }}
                </a>
            </div>
            <div class="fashion-product-pricing justify-content-between text-center mb-3">
                <div class="fashion-price-container product-price text-center d-flex flex-wrap justify-content-center align-items-center gap-8">
                    @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
                        <del class="fashion-original-price category-single-product-price">
                            {{ webCurrencyConverter(amount: $product->unit_price) }}
                        </del>
                        <br>
                    @endif
                    <span class="fashion-current-price text-accent text-dark">
                        {{ getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
