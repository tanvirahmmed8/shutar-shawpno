@php($overallRating = getOverallRating($product->reviews))
<div class="fashion-product-card fashion-featured-card product-single-hover shadow-none rtl">
    <div class="fashion-product-container overflow-hidden position-relative">
        {{-- Discount Badge --}}
        @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
            <div class="fashion-discount-badge for-discount-value">
                <span class="direction-ltr">
                   -{{ getProductPriceByType(product: $product, type: 'discount', result: 'string') }}
                </span>
            </div>
        @endif

        {{-- Stock Status --}}
        @if($product->product_type == 'physical' && $product->current_stock <= 0)
            <div class="fashion-stock-badge out_fo_stock">
                {{translate('out_of_stock')}}
            </div>
        @endif

        {{-- Product Image --}}
        <div class="fashion-product-image inline_product clickable">
            <a href="{{route('product',$product->slug)}}" class="fashion-product-link">
                <img class="fashion-product-img"
                     src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}"
                     alt="{{ $product->name }}">
            </a>

            {{-- Quick View --}}
            <div class="fashion-product-actions quick-view">
                <button class="fashion-product-action fashion-quickview-btn btn-circle stopPropagation action-product-quick-view"
                        data-product-id="{{ $product->id }}" title="{{ translate('quick_view') }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 12S5 4 12 4S23 12 23 12S19 20 12 20S1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Product Info --}}
        <div class="fashion-product-info single-product-details">
            {{-- Rating --}}
            @if($overallRating[0] != 0 )
                <div class="fashion-product-rating rating-show mb-2">
                    <div class="fashion-stars d-flex align-items-center">
                        @for($inc=1;$inc<=5;$inc++)
                            @if ($inc <= (int)$overallRating[0])
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-warning">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                                </svg>
                            @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-warning">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77V2Z"/>
                                </svg>
                            @else
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-warning">
                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke-width="2"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="fashion-review-count badge-style text-xs ms-2">
                            ({{ count($product->reviews) }})
                        </span>
                    </div>
                </div>
            @endif

            {{-- Product Title --}}
            <div class="fashion-product-title-container mb-2">
                <a href="{{route('product',$product->slug)}}" class="fashion-product-title text-capitalize fw-semibold">
                    {{ $product['name'] }}
                </a>
            </div>

            {{-- Product Price --}}
            <div class="fashion-product-pricing justify-content-between">
                <div class="fashion-product-price-container product-price">
                    @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
                        <del class="category-single-product-price">
                            {{ webCurrencyConverter(amount: $product->unit_price) }}
                        </del>
                    @endif
                    <span class="text-accent text-dark">
                       {{ getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

