@php($announcement=getWebConfig(name: 'announcement'))

@if (isset($announcement) && $announcement['status']==1)
    <div class="fashion-announcement text-center position-relative px-4 py-2 d--none" id="announcement"
         style="background-color: {{ $announcement['color'] }};color:{{$announcement['text_color']}}">
        <span class="fashion-announcement-text font-medium">{{ $announcement['announcement'] }} </span>
    <button class="fashion-announcement-close __close-announcement web-announcement-slideUp"
        aria-label="{{ translate('Close announcement') }}"
        style="background: none; border: none; color: inherit; font-size: 18px; cursor: pointer; position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
            ×
        </button>
    </div>
@endif

<header class="fashion-header rtl __inline-10">
    <div class="fashion-topbar bg-black text-white">
        <div class="fashion-container">
            <div class="fashion-topbar-content d-flex justify-content-between align-items-center py-2">
                <div class="fashion-topbar-left">
                    <div class="topbar-text dropdown d-md-none ms-auto">
                        <a class="fashion-topbar-link direction-ltr text-white text-decoration-none" href="tel: {{ $web_config['phone'] }}">
                            <i class="fa fa-phone me-2"></i> {{ $web_config['phone'] }}
                        </a>
                    </div>
                    <div class="d-none d-md-block mr-2 text-nowrap">
                        <a class="fashion-topbar-link d-none d-md-inline-block direction-ltr text-white text-decoration-none" href="tel:{{ $web_config['phone'] }}">
                            <i class="fa fa-phone me-2"></i> {{ $web_config['phone'] }}
                        </a>
                    </div>
                </div>

                <div class="fashion-topbar-right d-flex align-items-center gap-4">
                    @php($currency_model = getWebConfig(name: 'currency_model'))
                    @if($currency_model=='multi_currency')
                        <div class="fashion-currency-selector dropdown disable-autohide">
                            <a class="fashion-topbar-link dropdown-toggle text-white text-decoration-none d-flex align-items-center" href="#" data-toggle="dropdown">
                                <span class="font-medium">{{session('currency_code')}} {{session('currency_symbol')}}</span>
                                <i class="fa fa-chevron-down ms-1" style="font-size: 10px;"></i>
                            </a>
                            <ul class="text-align-direction dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} min-width-160px fashion-dropdown">
                                @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                    <li class="dropdown-item cursor-pointer get-currency-change-function py-2"
                                        data-code="{{$currency['code']}}">
                                        {{ $currency->name }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="fashion-language-selector dropdown disable-autohide __language-bar text-capitalize">
                        <a class="fashion-topbar-link dropdown-toggle text-white text-decoration-none d-flex align-items-center" href="#" data-toggle="dropdown">
                            @foreach($web_config['language'] as $data)
                                @if($data['code'] == getDefaultLanguage())
                                    <img class="me-2 rounded" width="16" height="12"
                                         src="{{theme_asset(path: 'public/site-assets/front-end/img/flags/'.$data['code'].'.png')}}"
                                         alt="{{$data['name']}}">
                                    <span class="font-medium">{{$data['name']}}</span>
                                    <i class="fa fa-chevron-down ms-1" style="font-size: 10px;"></i>
                                @endif
                            @endforeach
                        </a>
                        <ul class="text-align-direction dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} fashion-dropdown">
                            @foreach($web_config['language'] as $key =>$data)
                                @if($data['status']==1)
                                    <li class="change-language py-1" data-action="{{route('change-language')}}" data-language-code="{{$data['code']}}">
                                        <a class="dropdown-item py-2 d-flex align-items-center" href="javascript:">
                                            <img class="me-2 rounded"
                                                 width="16" height="12"
                                                 src="{{theme_asset(path: 'public/site-assets/front-end/img/flags/'.$data['code'].'.png')}}"
                                                 alt="{{$data['name']}}"/>
                                            <span class="text-capitalize">{{$data['name']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fashion-navbar navbar-sticky bg-white mobile-head border-bottom">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="fashion-container d-flex align-items-center justify-content-between gap-3 flex-wrap flex-md-nowrap">
                <button class="navbar-toggler border-0 p-2" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="{{ translate('Toggle navigation') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <a class="fashion-logo navbar-brand d-none d-sm-block mr-4 flex-shrink-0 __min-w-7rem"
                   href="{{route('home')}}">
                    <img class="fashion-logo-img __inline-11"
                         src="{{ getStorageImages(path: $web_config['web_logo'], type: 'logo') }}"
                         alt="{{$web_config['company_name']}}"
                         style="max-height: 50px; width: auto;">
                </a>
                <a class="fashion-logo navbar-brand d-sm-none"
                   href="{{route('home')}}">
                    <img class="fashion-mobile-logo-img mobile-logo-img"
                         src="{{ getStorageImages(path: $web_config['mob_logo'], type: 'logo') }}"
                         alt="{{$web_config['company_name']}}"
                         style="max-height: 40px; width: auto;"/>
                </a>

                <div class="fashion-search-container input-group-overlay mx-lg-4 search-form-mobile text-align-direction flex-grow-1" style="min-width: 280px;">
                    <form action="{{route('products')}}" type="submit" class="search_form">
                        <div class="fashion-search-wrapper d-flex align-items-center">
                            <div class="fashion-search-input-group position-relative flex-grow-1">
                    <input class="fashion-form-input form-control appended-form-control search-bar-input"
                                       type="search"
                                       autocomplete="off"
                                       data-given-value=""
                                       placeholder="{{ translate("search_for_items")}}..."
                        aria-label="{{ translate('search_for_items') }}"
                                       name="name"
                                       value="{{ request('name') }}">

                                <button class="fashion-search-btn input-group-append-overlay search_button d-none d-md-block"
                                        type="submit">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>

                            <button class="fashion-search-cancel close-search-form-mobile d-md-none btn btn-link text-muted p-2" type="button" aria-label="{{ translate('Cancel search') }}">
                                {{ translate('cancel') }}
                            </button>
                        </div>

                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <div class="fashion-search-results card search-card mobile-search-card">
                            <div class="card-body">
                                <div class="search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="fashion-toolbar navbar-toolbar d-flex flex-shrink-0 align-items-center gap-3">
                    <a class="fashion-nav-toggle navbar-tool navbar-stuck-toggler d-none" href="#">
                        <span class="navbar-tool-tooltip">{{ translate('expand_Menu') }}</span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu open-icon"></i>
                            <i class="navbar-tool-icon czi-close close-icon"></i>
                        </div>
                    </a>

                    <div class="fashion-search-mobile navbar-tool open-search-form-mobile d-lg-none {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <button class="fashion-icon-btn navbar-tool-icon-box" type="button" aria-label="{{ translate('Open search') }}">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>

                    <div class="fashion-wishlist navbar-tool dropdown d-none d-md-block {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}">
                        <a class="fashion-icon-btn navbar-tool-icon-box position-relative" href="{{route('wishlists')}}">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.84 4.61C20.3292 4.099 19.7228 3.69364 19.0554 3.41708C18.3879 3.14052 17.6725 2.99817 16.95 2.99817C16.2275 2.99817 15.5121 3.14052 14.8446 3.41708C14.1772 3.69364 13.5708 4.099 13.06 4.61L12 5.67L10.94 4.61C9.9083 3.5783 8.5092 2.99872 7.05 2.99872C5.5908 2.99872 4.1917 3.5783 3.16 4.61C2.1283 5.6417 1.54872 7.0408 1.54872 8.5C1.54872 9.9592 2.1283 11.3583 3.16 12.39L4.22 13.45L12 21.23L19.78 13.45L20.84 12.39C21.351 11.8792 21.7563 11.2728 22.0329 10.6053C22.3095 9.93789 22.4518 9.22248 22.4518 8.5C22.4518 7.77752 22.3095 7.06211 22.0329 6.39467C21.7563 5.72723 21.351 5.1208 20.84 4.61V4.61Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="fashion-badge navbar-tool-label">
                                <span class="countWishlist">
                                    {{session()->has('wish_list')?count(session('wish_list')):0}}
                                </span>
                           </span>
                        </a>
                    </div>
                    @if(auth('customer')->check())
                        <div class="fashion-user-menu dropdown">
                            <a class="fashion-user-toggle navbar-tool d-flex align-items-center gap-2 text-decoration-none"
                               type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="fashion-avatar">
                                    <img class="fashion-avatar-img rounded-circle"
                                         width="36" height="36"
                                         alt="{{ auth('customer')->user()->f_name }}"
                                         src="{{ getStorageImages(path: auth('customer')->user()->image_full_url, type: 'avatar') }}">
                                </div>
                                <div class="fashion-user-info d-none d-lg-block">
                                    <div class="fashion-user-greeting text-xs text-gray-500">
                                        {{ translate('hello')}}, {{ Str::limit(auth('customer')->user()->f_name, 10) }}
                                    </div>
                                    <div class="fashion-user-action font-medium text-sm">
                                        {{ translate('dashboard')}}
                                    </div>
                                </div>
                                <svg class="d-none d-lg-block" width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <div class="fashion-dropdown dropdown-menu dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                 aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item py-2 d-flex align-items-center"
                                   href="{{route('account-oder')}}">
                                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 4H18C18.5304 4 19.0391 4.21071 19.4142 4.58579C19.7893 4.96086 20 5.46957 20 6V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22H6C5.46957 22 4.96086 21.7893 4.58579 21.4142C4.21071 21.0391 4 20.5304 4 20V6C4 5.46957 4.21071 4.96086 4.58579 4.58579C4.96086 4.21071 5.46957 4 6 4H8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 2H9C8.44772 2 8 2.44772 8 3V5C8 5.55228 8.44772 6 9 6H15C15.5523 6 16 5.55228 16 5V3C16 2.44772 15.5523 2 15 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ translate('my_Order')}}
                                </a>
                                <a class="dropdown-item py-2 d-flex align-items-center"
                                   href="{{route('user-account')}}">
                                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ translate('my_Profile')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 d-flex align-items-center text-danger"
                                   href="{{route('customer.auth.logout')}}">
                                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ translate('logout')}}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="fashion-auth-menu dropdown">
                            <button class="fashion-icon-btn navbar-tool {{Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'}}"
                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <div class="fashion-dropdown text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}"
                                 aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item py-2 d-flex align-items-center" href="{{route('customer.auth.login')}}">
                                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 17L15 12L10 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15 12H3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ translate('sign_in')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 d-flex align-items-center" href="{{route('customer.auth.sign-up')}}">
                                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M19 8V14M22 11H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    {{ translate('sign_up')}}
                                </a>
                            </div>
                        </div>
                    @endif
                    <div id="cart_items">
                        @include('layouts.front-end.partials._cart')
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar navbar-expand-md navbar-stuck-menu" role="navigation" aria-label="{{ translate('Primary') }}">
            <div class="container px-10px">
                <div class="collapse navbar-collapse text-align-direction" id="navbarCollapse">
                    <div class="w-100 d-md-none text-align-direction">
                        <button class="navbar-toggler p-0" type="button" data-toggle="collapse"
                                data-target="#navbarCollapse">
                            <i class="tio-clear __text-26px"></i>
                        </button>
                    </div>

                    <ul class="navbar-nav d-block d-md-none" role="menubar">
                        <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                            <a class="nav-link" href="{{route('home')}}">{{ translate('home')}}</a>
                        </li>
                    </ul>

                    @php($categories = \App\Utils\CategoryManager::getCategoriesWithCountingAndPriorityWiseSorting(dataLimit: 11))

                    <ul class="navbar-nav mega-nav pr-lg-2 pl-lg-2 mr-2 d-none d-md-block __mega-nav" role="menubar">
                        <li class="nav-item categories-chip {{!request()->is('/')?'dropdown':''}}">

                            <a class="nav-link dropdown-toggle category-menu-toggle-btn ps-0"
                               href="javascript:">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.875 12.9195C9.875 12.422 9.6775 11.9452 9.32563 11.5939C8.97438 11.242 8.4975 11.0445 8 11.0445C6.75875 11.0445 4.86625 11.0445 3.625 11.0445C3.1275 11.0445 2.65062 11.242 2.29937 11.5939C1.9475 11.9452 1.75 12.422 1.75 12.9195V17.2945C1.75 17.792 1.9475 18.2689 2.29937 18.6202C2.65062 18.972 3.1275 19.1695 3.625 19.1695H8C8.4975 19.1695 8.97438 18.972 9.32563 18.6202C9.6775 18.2689 9.875 17.792 9.875 17.2945V12.9195ZM19.25 12.9195C19.25 12.422 19.0525 11.9452 18.7006 11.5939C18.3494 11.242 17.8725 11.0445 17.375 11.0445C16.1337 11.0445 14.2413 11.0445 13 11.0445C12.5025 11.0445 12.0256 11.242 11.6744 11.5939C11.3225 11.9452 11.125 12.422 11.125 12.9195V17.2945C11.125 17.792 11.3225 18.2689 11.6744 18.6202C12.0256 18.972 12.5025 19.1695 13 19.1695H17.375C17.8725 19.1695 18.3494 18.972 18.7006 18.6202C19.0525 18.2689 19.25 17.792 19.25 17.2945V12.9195ZM16.5131 9.66516L19.1206 7.05766C19.8525 6.32578 19.8525 5.13828 19.1206 4.4064L16.5131 1.79891C15.7813 1.06703 14.5937 1.06703 13.8619 1.79891L11.2544 4.4064C10.5225 5.13828 10.5225 6.32578 11.2544 7.05766L13.8619 9.66516C14.5937 10.397 15.7813 10.397 16.5131 9.66516ZM9.875 3.54453C9.875 3.04703 9.6775 2.57015 9.32563 2.2189C8.97438 1.86703 8.4975 1.66953 8 1.66953C6.75875 1.66953 4.86625 1.66953 3.625 1.66953C3.1275 1.66953 2.65062 1.86703 2.29937 2.2189C1.9475 2.57015 1.75 3.04703 1.75 3.54453V7.91953C1.75 8.41703 1.9475 8.89391 2.29937 9.24516C2.65062 9.59703 3.1275 9.79453 3.625 9.79453H8C8.4975 9.79453 8.97438 9.59703 9.32563 9.24516C9.6775 8.89391 9.875 8.41703 9.875 7.91953V3.54453Z"
                                          fill="currentColor"/>
                                </svg>
                                <span class="category-menu-toggle-btn-text">
                                    {{ translate('categories')}}
                                </span>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-md-2 pl-md-2 d-block d-xl-none" role="menubar">
                        <li class="nav-item dropdown d-md-none">
                            <a class="nav-link dropdown-toggle ps-0"
                               href="javascript:" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="czi-menu align-middle mt-n1 me-2"></i>
                                <span class="me-4">
                                    {{ translate('categories')}}
                                </span>
                            </a>
                            <ul class="dropdown-menu __dropdown-menu-2 text-align-direction" role="menu" aria-hidden="true">
                                @php($categoryIndex=0)
                                @foreach($categories as $category)
                                    @php($categoryIndex++)
                                    @if($categoryIndex < 10)
                                        <li class="dropdown">

                                            <a <?php if ($category->childes->count() > 0) echo "" ?>
                                               href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                <span>{{$category['name']}}</span>

                                            </a>
                                            @if ($category->childes->count() > 0)
                                                <a data-toggle='dropdown' class='__ml-50px'>
                                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                                </a>
                                            @endif

                                            @if($category->childes->count()>0)
                                                <ul class="dropdown-menu text-align-direction" role="menu" aria-hidden="true">
                                                    @foreach($category['childes'] as $subCategory)
                                                        <li class="dropdown">
                                                            <a href="{{route('products',['sub_category_id'=> $subCategory['id'],'data_from'=>'category','page'=>1])}}">
                                                                <span>{{$subCategory['name']}}</span>
                                                            </a>

                                                            @if($subCategory->childes->count()>0)
                                                                <a class="header-subcategories-links"
                                                                   data-toggle='dropdown'>
                                                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} __inline-16"></i>
                                                                </a>
                                                                <ul class="dropdown-menu" role="menu" aria-hidden="true">
                                                                    @foreach($subCategory['childes'] as $subSubCategory)
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                               href="{{route('products',['sub_sub_category_id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])}}">{{$subSubCategory['name']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                                <li class="__inline-17">
                                    <div>
                                        <a class="dropdown-item web-text-primary" href="{{ route('categories') }}">
                                            {{ translate('view_more') }}
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav nav-modern" role="menubar">
                        <li class="nav-item dropdown d-none d-md-block {{request()->is('/')?'active':''}}">
                            <a class="nav-link" href="{{route('home')}}">{{ translate('home')}}</a>
                        </li>

                        @if(getWebConfig(name: 'product_brand'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ translate('brand') }}</a>
                                <ul class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} scroll-bar" role="menu" aria-hidden="true">
                                    @php($brandIndex=0)
                                    @foreach(\App\Utils\BrandManager::getActiveBrandWithCountingAndPriorityWiseSorting() as $brand)
                                        @php($brandIndex++)
                                        @if($brandIndex < 10)
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                       href="{{route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}">
                                                        {{$brand['name']}}
                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    @if($brand['brand_products_count'] > 0 )
                                                        <span class="count-value px-2">( {{ $brand['brand_products_count'] }} )</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary" href="{{route('brands')}}">
                                                {{ translate('view_more') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if(
                            count($web_config['featured_deals']) > 0 &&
                            !(($web_config['flash_deals'] || count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0))
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="{{ route('products',['data_from'=>'featured_deal']) }}">
                                    {{ translate('featured_Deal')}}
                                </a>
                            </li>
                        @elseif(
                            ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) &&
                            !(count($web_config['featured_deals']) > 0 || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0)
                            )
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="{{ route('flash-deals',[ $web_config['flash_deals']['id'] ?? 0]) }}">
                                    {{ translate('flash_deal')}}
                                </a>
                            </li>
                        @elseif(
                            ($web_config['discount_product'] > 0) &&
                            !(count($web_config['featured_deals']) > 0 || ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) || $web_config['clearance_sale_product_count'] > 0)
                            )
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}">
                                    {{ translate('discounted_products')}}
                                </a>
                            </li>
                        @elseif(
                            ($web_config['clearance_sale_product_count'] > 0) &&
                            !(count($web_config['featured_deals']) > 0 || ($web_config['flash_deals'] || count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0)
                            )
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="{{ route('products', ['offer_type' => 'clearance_sale', 'page' => 1]) }}">
                                    {{ translate('clearance_Sale')}}
                                </a>
                            </li>
                        @elseif(count($web_config['featured_deals']) > 0 || ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0)
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2"
                                            type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ translate('offers')}}
                                    </button>
                                    <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction" role="menu" aria-hidden="true"
                                         aria-labelledby="dropdownMenuButton">
                                        @if(count($web_config['featured_deals']) > 0)
                                            <a class="dropdown-item text-nowrap text-capitalize" href="{{ route('products',['data_from'=>'featured_deal']) }}">
                                                {{ translate('featured_Deal')}}
                                            </a>
                                        @endif

                                        @if($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0)
                                            @if(count($web_config['featured_deals']) > 0)
                                                <div class="dropdown-divider"></div>
                                            @endif
                                            <a class="dropdown-item text-nowrap text-capitalize" href="{{ route('flash-deals',[ $web_config['flash_deals']['id'] ?? 0]) }}">
                                                {{ translate('flash_deal')}}
                                            </a>
                                        @endif

                                        @if($web_config['discount_product'] > 0)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-nowrap text-capitalize" href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}">
                                                {{ translate('discounted_products')}}
                                            </a>
                                        @endif

                                        @if($web_config['clearance_sale_product_count'] > 0)
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-nowrap" href="{{ route('products', ['offer_type' => 'clearance_sale', 'page' => 1]) }}">
                                                {{ translate('clearance_Sale')}}
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </li>
                        @endif

                        @if ($web_config['digital_product_setting'] && count($web_config['publishing_houses']) == 1)
                            <li class="nav-item dropdown d-none d-md-block {{request()->is('/')?'active':''}}">
                                <a class="nav-link" href="{{ route('products',['publishing_house_id' => 0, 'product_type' => 'digital', 'page'=>1]) }}">
                                    {{ translate('Publication_House') }}
                                </a>
                            </li>
                        @elseif ($web_config['digital_product_setting'] && count($web_config['publishing_houses']) > 1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ translate('Publication_House') }}
                                </a>
                                <ul class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} scroll-bar" role="menu" aria-hidden="true">
                                    @php($publishingHousesIndex=0)
                                    @foreach($web_config['publishing_houses'] as $publishingHouseItem)
                                        @if($publishingHousesIndex < 10 && $publishingHouseItem['name'] != 'Unknown')
                                            @php($publishingHousesIndex++)
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                       href="{{ route('products',['publishing_house_id'=> $publishingHouseItem['id'], 'product_type' => 'digital', 'page'=>1]) }}">
                                                        {{ $publishingHouseItem['name'] }}
                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    @if($publishingHouseItem['publishing_house_products_count'] > 0 )
                                                        <span class="count-value px-2">( {{ $publishingHouseItem['publishing_house_products_count'] }} )</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary"
                                               href="{{ route('products', ['product_type' => 'digital', 'page' => 1]) }}">
                                                {{ translate('view_more') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @php($businessMode = getWebConfig(name: 'business_mode'))
                        @if ($businessMode == 'multi')
                            <li class="nav-item dropdown {{request()->is('/')?'active':''}}">
                                <a class="nav-link text-capitalize"
                                   href="{{route('vendors')}}">{{ translate('all_vendors')}}</a>
                            </li>
                        @endif

                        @if(auth('customer')->check())
                            <li class="nav-item d-md-none">
                                <a href="{{route('user-account')}}" class="nav-link text-capitalize">
                                    {{ translate('user_profile')}}
                                </a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a href="{{route('wishlists')}}" class="nav-link">
                                    {{ translate('Wishlist')}}
                                </a>
                            </li>
                        @else
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{route('customer.auth.login')}}">
                                    <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in')}}
                                </a>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{route('customer.auth.sign-up')}}">
                                    <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up')}}
                                </a>
                            </li>
                        @endif

                        @if ($businessMode == 'multi')
                            @if(getWebConfig(name: 'seller_registration'))
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2"
                                                type="button" id="dropdownMenuButtonVendor"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ translate('vendor_zone')}}
                                        </button>
                                        <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction" role="menu" aria-hidden="true"
                                             aria-labelledby="dropdownMenuButtonVendor">
                                            <a class="dropdown-item text-nowrap text-capitalize" href="{{route('vendor.auth.registration.index')}}">
                                                {{ translate('become_a_vendor')}}
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-nowrap" href="{{route('vendor.auth.login')}}">
                                                {{ translate('vendor_login')}}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    </ul>
                    @if(auth('customer')->check())
                        <div class="logout-btn mt-auto d-md-none">
                            <hr>
                            <a href="{{route('customer.auth.logout')}}" class="nav-link">
                                <strong class="text-base">{{ translate('logout')}}</strong>
                            </a>
                        </div>
                    @endif
{{--                    <button class="btn btn-sm font-weight-bolder btn-primary btn-clearance text-capitalize text-nowrap ml-auto">{{translate('clearance_Sale')}}</button>--}}
                </div>
            </div>
        </div>

        <div class="megamenu-wrap">
            <div class="container">
                <div class="category-menu-wrap">
                    <ul class="category-menu">
                        @foreach ($categories as $key=>$category)
                            <li>
                                <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category->name}}</a>
                                @if ($category->childes->count() > 0)
                                    <div class="mega_menu z-2">
                                        @foreach ($category->childes as $sub_category)
                                            <div class="mega_menu_inner">
                                                <h6>
                                                    <a href="{{route('products',['sub_category_id'=> $sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_category->name}}</a>
                                                </h6>
                                                @if ($sub_category->childes->count() >0)
                                                    @foreach ($sub_category->childes as $sub_sub_category)
                                                        <div>
                                                            <a href="{{route('products',['sub_sub_category_id'=> $sub_sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_sub_category->name}}</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="text-center">
                            <a href="{{route('categories')}}" class="text-primary font-weight-bold justify-content-center">
                                {{ translate('View_All') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

@push('script')
    <script>
        "use strict";

        $(".category-menu").find(".mega_menu").parents("li")
            .addClass("has-sub-item").find("> a")
            .append("<i class='czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}'></i>");

        // Accessibility & keyboard navigation for dropdowns (safe, non-intrusive)
        $(function () {
            // Assign roles/ARIA if missing
            $(".navbar-nav .dropdown-menu").attr({role: 'menu', 'aria-hidden': 'true'});
            $(".navbar-nav [data-toggle='dropdown']").attr({'aria-haspopup': 'true'}).attr('aria-expanded', 'false');
            $(".navbar-nav .dropdown-menu .dropdown-item").attr('role','menuitem');

            function openDropdown($toggle) {
                try { $toggle.dropdown('show'); } catch(e) {}
                $toggle.attr('aria-expanded','true');
                $toggle.next('.dropdown-menu').attr('aria-hidden','false');
            }
            function closeDropdown($toggle) {
                try { $toggle.dropdown('hide'); } catch(e) {}
                $toggle.attr('aria-expanded','false');
                $toggle.next('.dropdown-menu').attr('aria-hidden','true');
            }

            $(document).on('keydown', '.navbar-nav [data-toggle="dropdown"]', function (e) {
                const $toggle = $(this);
                const key = e.key;
                if (key === 'Enter' || key === ' ') {
                    e.preventDefault();
                    if ($toggle.attr('aria-expanded') === 'true') closeDropdown($toggle); else openDropdown($toggle);
                } else if (key === 'ArrowDown') {
                    e.preventDefault();
                    openDropdown($toggle);
                    $toggle.next('.dropdown-menu').find('.dropdown-item:visible').first().trigger('focus');
                } else if (key === 'ArrowUp') {
                    e.preventDefault();
                    openDropdown($toggle);
                    $toggle.next('.dropdown-menu').find('.dropdown-item:visible').last().trigger('focus');
                } else if (key === 'Escape') {
                    e.preventDefault();
                    closeDropdown($toggle);
                    $toggle.trigger('focus');
                } else if (key === 'ArrowRight' || key === 'ArrowLeft') {
                    // Move between top-level menu items
                    const $items = $toggle.closest('.navbar-nav').find('> li > a.nav-link, > li > .dropdown > .dropdown-toggle, > li > button.dropdown-toggle');
                    let idx = $items.index($toggle);
                    if (key === 'ArrowRight') idx = (idx + 1) % $items.length; else idx = (idx - 1 + $items.length) % $items.length;
                    $items.eq(idx).trigger('focus');
                }
            });

            $(document).on('keydown', '.navbar-nav .dropdown-menu .dropdown-item', function (e) {
                const $item = $(this);
                const $menu = $item.closest('.dropdown-menu');
                const $toggle = $menu.prev('[data-toggle="dropdown"], .dropdown-toggle');
                const items = $menu.find('.dropdown-item:visible');
                const idx = items.index($item);
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    items.eq((idx + 1) % items.length).trigger('focus');
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    items.eq((idx - 1 + items.length) % items.length).trigger('focus');
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    closeDropdown($toggle);
                    $toggle.trigger('focus');
                }
            });

            // Sync aria on show/hide (Bootstrap events)
            $(document).on('show.bs.dropdown', '.navbar-nav .dropdown', function () {
                const $toggle = $(this).find('[data-toggle="dropdown"], .dropdown-toggle').first();
                $toggle.attr('aria-expanded','true');
                $(this).find('.dropdown-menu').attr('aria-hidden','false');
            });
            $(document).on('hide.bs.dropdown', '.navbar-nav .dropdown', function () {
                const $toggle = $(this).find('[data-toggle="dropdown"], .dropdown-toggle').first();
                $toggle.attr('aria-expanded','false');
                $(this).find('.dropdown-menu').attr('aria-hidden','true');
            });

            // Sticky shadow enhancement
            const $sticky = $('.fashion-navbar.navbar-sticky');
            const onScroll = () => {
                if (window.scrollY > 0) $sticky.addClass('is-stuck'); else $sticky.removeClass('is-stuck');
            };
            onScroll();
            $(window).on('scroll', onScroll);
        });
    </script>
@endpush
