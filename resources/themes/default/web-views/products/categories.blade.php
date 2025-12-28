@extends('layouts.front-end.app')

@section('title', translate('all_Categories'))

@push('css_or_js')
    <meta property="og:image" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="og:title" content="Categories of {{$web_config['company_name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
    <meta property="twitter:card" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="twitter:title" content="Categories of {{$web_config['company_name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
@endpush

@section('content')
    <div class="fashion-categories-page container rtl __inline-52 text-align-direction">

        <div class="fashion-categories-hero bg-primary-light rounded-10 my-4 p-3 p-sm-4" data-bg-img="{{ theme_asset(path: 'public/site-assets/front-end/img/media/bg.png') }}">
             <div class="fashion-categories-hero-content d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="fashion-categories-intro d-flex flex-column gap-1">
                    <h1 class="fashion-categories-title mb-0 text-start fw-bold text-uppercase">
                        {{ translate('category') }}
                    </h1>
                    <p class="fashion-categories-subtitle fs-14 fw-semibold mb-0">
                        {{translate('Find_your_favourite_categories_and_products')}}
                    </p>
                </div>
                 <form action="{{ route('categories') }}" method="GET" class="fashion-categories-search">
                    <div class="fashion-search-group input-group">
                        <input type="text" class="fashion-search-input form-control rounded-10" placeholder="{{translate('Search_Categories')}}" name="search">
                        <div class="fashion-search-button input-group-append">
                            <button class="btn btn--primary rounded-10" type="submit">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                                    <path d="M21 21l-4.35-4.35" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="fashion-categories-grid brand_div-wrap mb-4">
            @foreach($categories as $categoryKey => $category)
            <a href="{{route('products', ['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}" class="fashion-category-card brand_div">
                <div class="fashion-category-image">
                    <img src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}" alt="{{ $category['name'] }}">
                </div>
                <div class="fashion-category-name">{{ $category['name'] }}</div>
            </a>
            @endforeach
        </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('public/site-assets/front-end/js/categories.js') }}"></script>
@endpush
