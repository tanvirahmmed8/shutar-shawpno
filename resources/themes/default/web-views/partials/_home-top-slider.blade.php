@if(count($bannerTypeMainBanner) > 0)
<section class="fashion-hero-wrapper">
    <div class="fashion-container">
        <div class="fashion-hero-layout row no-gutters position-relative">
            @if ($categories->count() > 0 )
                <div class="col-xl-3 position-static d-none d-xl-block">
                    <div class="fashion-category-sidebar">
                        <div class="fashion-category-header">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                                <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="fashion-category-title">{{ translate('categories') }}</span>
                        </div>
                        <ul class="fashion-category-menu category-menu">
                            @foreach ($categories as $key=>$category)
                                <li class="fashion-category-item">
                                    <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}"
                                       class="fashion-category-link">
                                        <span>{{$category->name}}</span>
                                        @if ($category->childes->count() > 0)
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-category-arrow">
                                                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        @endif
                                    </a>
                                    @if ($category->childes->count() > 0)
                                        <div class="fashion-mega-menu mega_menu z-2">
                                            @foreach ($category->childes as $sub_category)
                                                <div class="fashion-mega-menu-column mega_menu_inner">
                                                    <h6 class="fashion-mega-menu-title">
                                                        <a href="{{route('products',['sub_category_id'=> $sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_category->name}}</a>
                                                    </h6>
                                                    @if ($sub_category->childes->count() >0)
                                                        <ul class="fashion-mega-menu-list">
                                                            @foreach ($sub_category->childes as $sub_sub_category)
                                                                <li><a href="{{route('products',['sub_sub_category_id'=> $sub_sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_sub_category->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                            <li class="fashion-category-item fashion-view-all">
                                <a href="{{route('categories')}}" class="fashion-category-link fashion-view-all-link">
                                    <span>{{translate('view_all_categories')}}</span>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            <div class="col-12 col-xl-9">
                <div class="fashion-hero-slider {{Session::get('direction') === "rtl" ? 'pr-xl-3' : 'pl-xl-3'}}">
                    <div class="owl-theme owl-carousel fashion-hero-carousel hero-slider">
                        @foreach($bannerTypeMainBanner as $key=>$banner)
                            <div class="fashion-hero-slide">
                                <a href="{{$banner['url']}}" class="fashion-hero-link d-block" target="_blank">
                                    <img class="fashion-hero-image w-100" alt="{{ $banner->title ?? 'Hero Banner' }}"
                                        src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}"
                                        loading="{{ $key === 0 ? 'eager' : 'lazy' }}" fetchpriority="{{ $key === 0 ? 'high' : 'auto' }}" decoding="async">
                                    <div class="fashion-hero-overlay">
                                        <div class="fashion-hero-content">
                                            @if(isset($banner->title))
                                                <h2 class="fashion-hero-title">{{ $banner->title }}</h2>
                                            @endif
                                            @if(isset($banner->subtitle))
                                                <p class="fashion-hero-subtitle">{{ $banner->subtitle }}</p>
                                            @endif
                                            <button class="btn-fashion btn-fashion-primary btn-fashion-lg fashion-hero-cta">
                                                {{ translate('shop_now') }}
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if(count($bannerTypeMainBanner) == 0)
    @php(
        $heroTitle = getWebConfig(name: 'home_hero_title') ?? ($web_config['company_name'].' '.translate('new_collection'))
    )
    @php(
        $heroSubtitle = getWebConfig(name: 'home_hero_subtitle') ?? translate('discover_fresh_styles_and_best_deals_today')
    )
    @php(
        $heroImage = getWebConfig(name: 'home_hero_image')
    )
    <section class="modern-hero" aria-label="{{ translate('Featured promotion') }}">
        <div class="fashion-container">
            <div class="modern-hero-grid">
                <div class="modern-hero-content">
                    <h1 class="modern-hero-title">{{ $heroTitle }}</h1>
                    <p class="modern-hero-subtitle">{{ $heroSubtitle }}</p>
                    <div class="modern-hero-cta">
                        <a href="{{ route('products') }}" class="btn-modern">
                            {{ translate('shop_now') }}
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @if($heroImage)
                    <div class="modern-hero-visual">
                        <img src="{{ getStorageImages(path: $heroImage, type: 'banner') }}" alt="{{ translate('Featured') }}" class="modern-hero-img" loading="eager" fetchpriority="high" decoding="async">
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
