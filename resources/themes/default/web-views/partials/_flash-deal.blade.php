<section class="fashion-flash-deal-section overflow-hidden">
    <div class="fashion-container px-0 px-md-3">
        <div class="fashion-flash-deals-wrapper">
            <div class="fashion-flash-deal-header d-flex justify-content-between align-items-end mb-4">
                <div class="fashion-flash-deal-info">
                    <h2 class="fashion-section-title mb-2">{{ translate('flash_deals') }}</h2>
                    <p class="fashion-section-subtitle mb-0">{{ translate('limited_time_offers') }}</p>
                </div>
                @if ($web_config['flash_deals']->products_count > 0)
                    <div class="fashion-flash-deal-action d-none d-md-block">
                        <a class="btn-fashion btn-fashion-secondary view-all-text"
                        href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}">
                            {{ translate('view_all')}}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            <?php
                $startDate = \Carbon\Carbon::parse($web_config['flash_deals']['start_date']);
                $endDate = \Carbon\Carbon::parse($web_config['flash_deals']['end_date']);
                $now = \Carbon\Carbon::now();
                $totalDuration = $endDate->diffInSeconds($startDate);
                $elapsedDuration = $now->diffInSeconds($startDate);
                $flashDealsPercentage = ($elapsedDuration / $totalDuration) * 100;
            ?>

            <div class="fashion-flash-deal-content row g-3 mx-max-md-0">
                <div class="col-lg-4 px-max-md-0 flashdeal-responsive">
                    <a href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}" class="fashion-countdown-card countdown-card">
                        <div class="fashion-flash-deal-text flash-deal-text">
                            <div class="fashion-deal-title">
                                <span>{{$web_config['flash_deals']->title}}</span>
                            </div>
                            <small class="fashion-deal-subtitle">{{translate('hurry_Up')}} ! {{translate('the_offer_is_limited')}}. {{translate('grab_while_it_lasts')}}</small>
                        </div>
                        <div class="fashion-countdown-container text-center text-white">
                            <div class="fashion-countdown-background countdown-background">
                                <span class="fashion-countdown cz-countdown d-flex justify-content-center align-items-center flash-deal-countdown"
                                    data-countdown="{{$web_config['flash_deals']?date('m/d/Y',strtotime($web_config['flash_deals']['end_date'])):''}} 23:59:00 ">
                                    <span class="fashion-countdown-item cz-countdown-days">
                                        <span class="fashion-countdown-value cz-countdown-value"></span>
                                        <span class="fashion-countdown-label cz-countdown-text text-nowrap">{{ translate('days')}}</span>
                                    </span>
                                    <span class="fashion-countdown-separator cz-countdown-value p-1">:</span>
                                    <span class="fashion-countdown-item cz-countdown-hours">
                                        <span class="fashion-countdown-value cz-countdown-value"></span>
                                        <span class="fashion-countdown-label cz-countdown-text text-nowrap">{{ translate('hours')}}</span>
                                    </span>
                                    <span class="fashion-countdown-separator cz-countdown-value p-1">:</span>
                                    <span class="fashion-countdown-item cz-countdown-minutes">
                                        <span class="fashion-countdown-value cz-countdown-value"></span>
                                        <span class="fashion-countdown-label cz-countdown-text text-nowrap">{{ translate('minutes')}}</span>
                                    </span>
                                    <span class="fashion-countdown-separator cz-countdown-value p-1">:</span>
                                    <span class="fashion-countdown-item cz-countdown-seconds">
                                        <span class="fashion-countdown-value cz-countdown-value"></span>
                                        <span class="fashion-countdown-label cz-countdown-text text-nowrap">{{ translate('seconds')}}</span>
                                    </span>
                                </span>
                                <div class="fashion-progress progress __progress">
                                <div class="fashion-progress-bar progress-bar flash-deal-progress-bar" role="progressbar" style="width: {{ number_format($flashDealsPercentage, 2) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                @php($nullFilter = 0)
                @foreach($flashDeal['flashDealProducts'] as $key => $flashDealProduct)
                    @php($nullFilter = $nullFilter+1)
                @endforeach

                @if($nullFilter<=10)
                    <div class="col-lg-8 d-none d-md-block px-max-md-0">
                        <div class="fashion-flash-products">
                            <div class="owl-theme owl-carousel fashion-flash-deal-slider flash-deal-slider">
                                @foreach($flashDeal['flashDealProducts'] as $key => $flashDealProduct)
                                    <div class="fashion-carousel-item">
                                        @include('web-views.partials._feature-product',['product'=> $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    @php($index = 0)
                    @foreach($flashDeal['flashDealProducts'] as $key=>$flashDealProduct)
                        @if ($index<10)
                            @php($index = $index+1)
                            <div class="fashion-flash-product-item col-lg-2 col-6 col-sm-4 col-md-3 d-none d-md-block px-max-md-0">
                                @include('web-views.partials._feature-product',['product'=> $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                            </div>
                        @endif
                    @endforeach
                @endif

                <div class="col-12 pb-0 d-md-none px-max-md-0">
                    <div class="fashion-flash-mobile">
                        <div class="owl-theme owl-carousel fashion-flash-deal-mobile-slider flash-deal-slider-mobile">
                            @foreach($flashDeal['flashDealProducts'] as $key=>$flashDealProduct)
                                @if( $key<10)
                                    <div class="fashion-carousel-item">
                                        @include('web-views.partials._product-card-1',['product' => $flashDealProduct,'decimal_point_settings'=>$decimal_point_settings])
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @if (count($flashDeal['flashDealProducts']) > 0)
                    <div class="col-12 d-md-none text-center px-max-md-0 mt-4">
                        <a class="btn-fashion btn-fashion-secondary view-all-text"
                            href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}">
                            {{ translate('view_all')}}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>
