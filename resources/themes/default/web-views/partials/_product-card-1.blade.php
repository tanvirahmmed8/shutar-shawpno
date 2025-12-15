@if(isset($product))
    @php($overallRating = getOverallRating($product->reviews))
    <div class="fashion-product-card card-modern product-card flash_deal_product get-view-by-onclick" data-link="{{ route('product',$product->slug) }}">
        {{-- Discount Badge --}}
        @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
            <div class="fashion-discount-badge for-discount-value badge-discount">
                <span class="direction-ltr">
                    -{{ getProductPriceByType(product: $product, type: 'discount', result: 'string') }}
                </span>
            </div>
        @endif

        {{-- Product Actions --}}
        <div class="fashion-product-actions action-group">
            <button class="fashion-product-action fashion-wishlist-btn action-btn" type="button"
                    data-product-id="{{ $product->id }}" title="{{ translate('add_to_wishlist') }}" aria-label="{{ translate('add_to_wishlist') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.84 4.61C20.3292 4.099 19.7228 3.69364 19.0554 3.41708C18.3879 3.14052 17.6725 2.99817 16.95 2.99817C16.2275 2.99817 15.5121 3.14052 14.8446 3.41708C14.1772 3.69364 13.5708 4.099 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.5783 8.5092 2.99872 7.05 2.99872C5.5908 2.99872 4.1917 3.5783 3.16 4.61C2.1283 5.6417 1.54872 7.0408 1.54872 8.5C1.54872 9.9592 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6053C22.3095 9.93789 22.4518 9.22248 22.4518 8.5C22.4518 7.77752 22.3095 7.06211 22.0329 6.39467C21.7563 5.72723 21.351 5.1208 20.84 4.61V4.61Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="fashion-product-action fashion-quickview-btn action-btn" type="button"
                    data-product-id="{{ $product->id }}" title="{{ translate('quick_view') }}" aria-label="{{ translate('quick_view') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 12S5 4 12 4S23 12 23 12S19 20 12 20S1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        {{-- Product Image --}}
        <div class="fashion-product-image d-flex">
            <div class="d-flex align-items-center justify-content-center p-12px w-100">
                <div class="flash-deals-background-image fashion-image-container pc-image">
                <img class="fashion-product-img" alt="{{ $product->name }}"
                    src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}" loading="lazy" decoding="async">
                </div>
            </div>
        </div>

        {{-- Product Info --}}
        <div class="fashion-product-info flash_deal_product_details pl-3 pr-3 pr-1 d-flex mt-3">
            <div class="w-100">
                {{-- Product Title --}}
                <div class="mb-2">
                    <a href="{{route('product', $product->slug)}}"
                       class="fashion-product-title flash-product-title text-capitalize fw-semibold">
                        <span class="title">{{ Str::limit($product['name'], 50) }}</span>
                    </a>
                </div>

                {{-- Rating --}}
                @if($overallRating[0] != 0 )
                    <div class="fashion-product-rating flash-product-review mb-2">
                        <div class="fashion-stars d-flex align-items-center gap-1">
                            @for($inc=1;$inc<=5;$inc++)
                                @if ($inc <= (int)$overallRating[0])
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" class="text-warning">
                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/>
                                    </svg>
                                @elseif ($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor" class="text-warning">
                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77V2Z"/>
                                    </svg>
                                @else
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="text-warning">
                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke-width="2"/>
                                    </svg>
                                @endif
                            @endfor
                            <span class="fashion-review-count badge-style2 text-xs text-gray-500 ml-1">
                                ({{ count($product->reviews) }})
                            </span>
                        </div>
                    </div>
                @endif

                {{-- Price --}}
                <div class="fashion-product-pricing price d-flex flex-wrap gap-8 align-items-center row-gap-0">
                    @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
                        <del class="fashion-product-price-original category-single-product-price original">
                            {{ webCurrencyConverter(amount: $product->unit_price)}}
                        </del>
                    @endif
                    <span class="fashion-product-price flash-product-price text-dark fw-semibold">
                        {{ getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Hover Overlay --}}
        <div class="fashion-product-overlay hover-cta">
            <button class="btn-modern fashion-add-to-cart"
                    data-product-id="{{ $product->id }}">
                {{ translate('add_to_cart') }}
            </button>
        </div>
    </div>
@endif
