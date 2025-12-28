@extends('layouts.front-end.app')

@section('title', translate('all_Brands'))

@push('css_or_js')
    <meta property="og:image" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="og:title" content="Brands of {{$web_config['company_name']}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">

    <meta property="twitter:card" content="{{$web_config['web_logo']['path']}}"/>
    <meta property="twitter:title" content="Brands of {{$web_config['company_name']}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description"
          content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)),0,160) }}">
@endpush

@section('content')

    <div class="fashion-brands-page container pb-3 mb-2 mb-md-4 rtl text-align-direction">
        <div class="fashion-brands-hero bg-primary-light rounded-10 my-4 p-3 p-sm-4"
             data-bg-img="{{ theme_asset(path: 'public/site-assets/front-end/img/media/bg.png') }}">
             <div class="fashion-brands-hero-content d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="fashion-brands-intro d-flex flex-column gap-1">
                    <h1 class="fashion-brands-title mb-0 text-start fw-bold text-uppercase">
                        {{ translate('brands') }}
                    </h1>
                    <p class="fashion-brands-subtitle fs-14 fw-semibold mb-0">
                        {{translate('Find_your_favourite_brands_and_products')}}
                    </p>
                </div>
                <form action="{{ route('brands') }}" method="GET" class="fashion-brands-search">
                    <div class="fashion-search-group input-group">
                        <input type="text" class="fashion-search-input form-control rounded-10" placeholder="{{translate('Search_Brands')}}" name="search" value="{{ request('search') }}">
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

        @if(count($brands) > 0)
            <div class="fashion-brands-grid brand_div-wrap mb-4">
                @foreach($brands as $brand)
                    <a href="{{route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}" class="fashion-brand-card brand_div">
                        <div class="fashion-brand-image">
                            <img alt="{{$brand->image_alt_text ?? $brand->name}}" src="{{ getStorageImages(path: $brand->image_full_url, type: 'brand') }}">
                        </div>
                        <div class="fashion-brand-name">{{$brand->name}}</div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="fashion-no-brands d-flex justify-content-center align-items-center pt-3">
                <div class="fashion-no-brands-content d-flex flex-column justify-content-center align-items-center gap-3">
                    <div class="fashion-no-brands-icon">
                        <svg width="100" height="100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-muted">
                            <path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" stroke="currentColor" stroke-width="1.5"/>
                            <polyline points="3.27,6.96 12,12.01 20.73,6.96" stroke="currentColor" stroke-width="1.5"/>
                            <line x1="12" y1="22.08" x2="12" y2="12" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                    </div>
                    <h5 class="fashion-no-brands-text text-muted fs-14 font-semi-bold text-center">{{ translate('There_is_no_brands') }}</h5>
                </div>
            </div>
        @endif


        <div class="fashion-brands-pagination row mx-n2">
            <div class="col-md-12">
                <div class="fashion-pagination-wrapper text-center">
                    {!! $brands->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{theme_asset(path: 'public/site-assets/front-end/vendor/nouislider/distribute/nouislider.min.js')}}"></script>
@endpush
