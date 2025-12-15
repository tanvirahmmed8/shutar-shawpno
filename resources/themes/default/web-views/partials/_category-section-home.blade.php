@if ($categories->count() > 0 )
    <section class="fashion-categories-showcase pb-4 rtl">
        <div class="fashion-container container">
            <div class="fashion-categories-wrapper">
                <div class="fashion-categories-card card __shadow h-100 max-md-shadow-0">
                    <div class="fashion-categories-body card-body">
                        <div class="fashion-categories-header d-flex justify-content-between align-items-end mb-4">
                            <div class="fashion-categories-info categories-title m-0">
                                <h2 class="fashion-section-title mb-2">{{ translate('categories')}}</h2>
                                <p class="fashion-section-subtitle mb-0">{{ translate('explore_our_collections') }}</p>
                            </div>
                            <div class="fashion-categories-action">
                                <a class="btn-fashion btn-fashion-secondary view-all-text"
                                   href="{{route('categories')}}">{{ translate('view_all')}}
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="fashion-categories-desktop d-none d-lg-block">
                            <div class="fashion-categories-grid row mt-3">
                                @foreach($categories as $key => $category)
                                    @if ($key < 8)
                                        <div class="fashion-category-item text-center __m-5px __cate-item">
                                            <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}" class="fashion-category-link d-flex flex-column align-items-center">
                                                <div class="fashion-category-icon __img">
                                                    <img alt="{{ $category->name }}"
                                                         src="{{ getStorageImages(path:$category->icon_full_url, type: 'category') }}">
                                                </div>
                                                <p class="fashion-category-name text-center fs-13 font-semibold mt-2">{{Str::limit($category->name, 15)}}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="fashion-categories-mobile d-lg-none">
                            <div class="fashion-categories-slider owl-theme owl-carousel categories--slider mt-3">
                                @foreach($categories as $key => $category)
                                    @if ($key<8)
                                        <div class="fashion-category-mobile-item text-center m-0 __cate-item w-100">
                                            <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}" class="fashion-category-mobile-link">
                                                <div class="fashion-category-mobile-icon __img mw-100 h-auto">
                                                    <img alt="{{ $category->name }}"
                                                         src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}">
                                                </div>
                                                <p class="fashion-category-mobile-name text-center line--limit-2 small mt-2">{{ $category->name }}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
