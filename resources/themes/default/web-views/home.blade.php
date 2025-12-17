@extends('layouts.front-end.app')

@section('title', $web_config['company_name'] . ' ' . translate('online_Shopping') . ' | ' . $web_config['company_name']
    . ' ' . translate('ecommerce'))

    @push('css_or_js')
        <meta name="robots" content="index, follow">
        <meta property="og:image" content="{{ $web_config['web_logo']['path'] }}" />
        <meta property="og:title" content="Welcome To {{ $web_config['company_name'] }} Home" />
        <meta property="og:url" content="{{ env('APP_URL') }}">
        <meta name="description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
        <meta property="og:description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

        <meta property="twitter:card" content="{{ $web_config['web_logo']['path'] }}" />
        <meta property="twitter:title" content="Welcome To {{ $web_config['company_name'] }} Home" />
        <meta property="twitter:url" content="{{ env('APP_URL') }}">
        <meta property="twitter:description"
            content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/home.css') }}" />
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.theme.default.min.css') }}">
    @endpush

@section('content')
    <div class="fashion-homepage">
        @php($decimalPointSettings = !empty(getWebConfig(name: 'decimal_point_settings')) ? getWebConfig(name: 'decimal_point_settings') : 0)

        {{-- Hero Section with Categories --}}
        <section class="fashion-hero-section">
            @include('web-views.partials._home-top-slider', [
                'bannerTypeMainBanner' => $bannerTypeMainBanner,
            ])
        </section>

        {{-- Flash Deal Section --}}
        @if ($flashDeal['flashDeal'] && $flashDeal['flashDealProducts'] && count($flashDeal['flashDealProducts']) > 0)
            <section class="fashion-flash-deals py-5">
                @include('web-views.partials._flash-deal', [
                    'decimal_point_settings' => $decimalPointSettings,
                ])
            </section>
        @endif

        {{-- Featured Products Section --}}
        @if ($featuredProductsList->count() > 0)
            <section class="fashion-featured-section py-5">
                <div class="fashion-container">
                    <div class="fashion-section-header">
                        <h2 class="fashion-section-title">
                            {{ translate('featured_products') }}
                        </h2>
                        <p class="fashion-section-subtitle">
                            {{ translate('discover_our_handpicked_selection') }}
                        </p>
                    </div>

                    <div class="fashion-featured-products">
                        <div class="fashion-carousel-container">
                            <div class="owl-carousel owl-theme fashion-products-carousel" id="featured_products_list">
                                @foreach ($featuredProductsList as $product)
                                    <div class="fashion-carousel-item">
                                        @include('web-views.partials._feature-product', [
                                            'product' => $product,
                                            'decimal_point_settings' => $decimalPointSettings,
                                        ])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="fashion-section-footer">
                            <a class="btn-fashion btn-fashion-secondary"
                                href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                                {{ translate('view_all_featured') }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Categories Showcase --}}
        <section class="fashion-categories-section py-5 bg-gray-50">
            @include('web-views.partials._category-section-home')
        </section>

        {{-- Featured Deals Section --}}
        @if ($web_config['featured_deals'] && count($web_config['featured_deals']) > 0)
            <section class="fashion-deals-section py-5">
                <div class="fashion-container">
                    <div class="fashion-deals-header d-flex justify-content-between align-items-end mb-4">
                        <div class="fashion-deals-info">
                            <h2 class="fashion-section-title mb-2">{{ translate('featured_deal') }}</h2>
                            <p class="fashion-section-subtitle mb-0">
                                {{ translate('see_the_latest_deals_and_exciting_new_offers') }}!</p>
                        </div>
                        <div class="fashion-deals-action d-none d-md-block">
                            <a class="btn-fashion btn-fashion-secondary"
                                href="{{ route('products', ['data_from' => 'featured_deal']) }}">
                                {{ translate('view_all_deals') }}
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="fashion-deals-grid">
                        <div class="owl-carousel owl-theme fashion-deals-carousel">
                            @foreach ($web_config['featured_deals'] as $key => $product)
                                <div class="fashion-carousel-item">
                                    @include('web-views.partials._product-card-1', [
                                        'product' => $product,
                                        'decimal_point_settings' => $decimalPointSettings,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="fashion-deals-action-mobile text-center mt-4 d-md-none">
                        <a class="btn-fashion btn-fashion-secondary"
                            href="{{ route('products', ['data_from' => 'featured_deal']) }}">
                            {{ translate('view_all_deals') }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Clearance Sale Section --}}
        <section class="fashion-clearance-section py-5 bg-gray-50">
            @include('web-views.partials._clearance-sale-products', [
                'clearanceSaleProducts' => $clearanceSaleProducts,
            ])
        </section>

        {{-- Promotional Banner Section --}}
        @if (isset($bannerTypeMainSectionBanner))
            <section class="fashion-promo-banner py-5">
                <div class="fashion-container">
                    <div class="fashion-banner-container">
                        <a href="{{ $bannerTypeMainSectionBanner->url }}" target="_blank"
                            class="fashion-banner-link d-block">
                            <img class="fashion-banner-img w-100"
                                alt="{{ $bannerTypeMainSectionBanner->title ?? 'Promotional Banner' }}"
                                src="{{ getStorageImages(path: $bannerTypeMainSectionBanner->photo_full_url, type: 'wide-banner') }}">
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Top Sellers Section --}}
        @php($businessMode = getWebConfig(name: 'business_mode'))
        @if ($businessMode == 'multi' && count($topVendorsList) > 0)
            <section class="fashion-sellers-section py-5">
                @include('web-views.partials._top-sellers')
            </section>
        @endif

        {{-- Deal of the Day Section --}}
        <section class="fashion-daily-deals py-5 bg-gray-50">
            @include('web-views.partials._deal-of-the-day', [
                'decimal_point_settings' => $decimalPointSettings,
            ])
        </section>

        {{-- New Arrivals Section --}}
        @if ($newArrivalProducts->count() > 0)
            <section class="fashion-arrivals-section py-5">
                <div class="fashion-container">
                    <div class="fashion-section-header">
                        <h2 class="fashion-section-title">
                            {{ translate('new_arrivals') }}
                        </h2>
                        <p class="fashion-section-subtitle">
                            {{ translate('fresh_styles_just_in') }}
                        </p>
                    </div>

                    <div class="fashion-arrivals-grid">
                        <div class="owl-carousel owl-theme fashion-arrivals-carousel">
                            @foreach ($newArrivalProducts as $key => $product)
                                <div class="fashion-carousel-item">
                                    @include('web-views.partials._product-card-2', [
                                        'product' => $product,
                                        'decimal_point_settings' => $decimalPointSettings,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{-- Best Selling & Top Rated Section --}}
        <section class="fashion-trending-section py-5 bg-gray-50">
            <div class="fashion-container">
                <div class="fashion-trending-grid row g-4">
                    @if ($bestSellProduct->count() > 0)
                        @include('web-views.partials._best-selling')
                    @endif

                    @if ($topRatedProducts->count() > 0)
                        @include('web-views.partials._top-rated')
                    @endif
                </div>
            </div>
        </section>


        {{-- Footer Banners Section --}}
        @if (count($bannerTypeFooterBanner) > 0)
            <section class="fashion-footer-banners py-5">
                <div class="fashion-container">
                    @if (count($bannerTypeFooterBanner) > 1)
                        <div class="fashion-banner-slider">
                            <div class="owl-carousel owl-theme fashion-footer-carousel">
                                @foreach ($bannerTypeFooterBanner as $banner)
                                    <div class="fashion-banner-slide">
                                        <a href="{{ $banner['url'] }}" class="fashion-banner-link d-block"
                                            target="_blank">
                                            <img class="fashion-banner-img w-100" alt="{{ $banner->title ?? 'Banner' }}"
                                                src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="fashion-banner-grid row g-4">
                            @foreach ($bannerTypeFooterBanner as $banner)
                                <div class="col-md-6">
                                    <div class="fashion-banner-item">
                                        <a href="{{ $banner['url'] }}" class="fashion-banner-link d-block"
                                            target="_blank">
                                            <img class="fashion-banner-img w-100" alt="{{ $banner->title ?? 'Banner' }}"
                                                src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
        @endif

        {{-- Brands Section --}}
        @if ($web_config['brand_setting'] && $brands->count() > 0)
            <section class="fashion-brands-section py-5 bg-gray-50">
                <div class="fashion-container">
                    <div class="fashion-section-header">
                        <h2 class="fashion-section-title">
                            {{ translate('our_brands') }}
                        </h2>
                        <p class="fashion-section-subtitle">
                            {{ translate('discover_premium_fashion_brands') }}
                        </p>
                    </div>

                    <div class="fashion-brands-grid">
                        <div class="owl-carousel owl-theme fashion-brands-carousel">
                            @php($brandCount = 0)
                            @foreach ($brands as $brand)
                                @if ($brandCount < 15)
                                    <div class="fashion-brand-item">
                                        <a href="{{ route('products', ['brand_id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}"
                                            class="fashion-brand-link d-flex align-items-center justify-content-center">
                                            <img class="fashion-brand-logo"
                                                alt="{{ $brand->image_alt_text ?? $brand->name }}"
                                                src="{{ getStorageImages(path: $brand->image_full_url, type: 'brand') }}">
                                        </a>
                                    </div>
                                @endif
                                @php($brandCount++)
                            @endforeach
                        </div>
                    </div>

                    <div class="fashion-brands-footer text-center mt-4">
                        <a class="btn-fashion btn-fashion-secondary" href="{{ route('brands') }}">
                            {{ translate('view_all_brands') }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @endif

        {{-- Category Wise Products --}}
        @if ($homeCategories->count() > 0)
            <section class="fashion-category-products py-5">
                @foreach ($homeCategories as $category)
                    <div class="fashion-category-section mb-5">
                        @include('web-views.partials._category-wise-product', [
                            'decimal_point_settings' => $decimalPointSettings,
                        ])
                    </div>
                @endforeach
            </section>
        @endif

        {{-- Company Reliability Section --}}
        @php($companyReliability = getWebConfig(name: 'company_reliability'))
        @if ($companyReliability != null)
            <section class="fashion-reliability-section py-5 bg-gray-50">
                @include('web-views.partials._company-reliability')
            </section>
        @endif
    </div>

    <span id="direction-from-session" data-value="{{ session()->get('direction') }}"></span>
@endsection

@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/owl.carousel.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/home.js') }}"></script>
@endpush
