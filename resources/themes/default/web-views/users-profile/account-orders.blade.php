@extends('layouts.front-end.app')

@section('title', translate('my_Order_List'))

@section('content')

    <div class="container py-2 py-md-4 p-0 p-md-2 user-profile-container px-5px fashion-orders-page">
        <div class="row">
            @include('web-views.partials._profile-aside')

            <section class="col-lg-9 __customer-profile customer-profile-wishlist px-0">
                <div class="card __card d-none d-lg-flex web-direction customer-profile-orders h-100 fashion-orders-card">
                    <div class="card-body fashion-orders-body">
                        <div class="d-flex align-items-center justify-content-between gap-2 mb-0 mb-md-3 fashion-orders-header">
                            <div class="fashion-orders-title-wrapper">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-orders-icon">
                                    <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z" fill="currentColor"/>
                                </svg>
                                <h5 class="font-bold mb-0 fs-16 fashion-orders-title">{{ translate('my_Order') }}</h5>
                            </div>
                        </div>

                        @if($orders->count()>0)
                        <div class="table-responsive fashion-orders-table-wrapper">
                            <table class="table __table __table-2 text-center fashion-orders-table">
                                <thead class="thead-light fashion-orders-thead">
                                    <tr>
                                        <td class="tdBorder fashion-orders-th">
                                            <div class="fashion-th-wrapper">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-th-icon">
                                                    <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM19 19H5V8H19V19ZM7 10V12H9V10H7ZM11 10V12H17V10H11ZM7 14V16H9V14H7ZM11 14V16H17V14H11Z" fill="currentColor"/>
                                                </svg>
                                                <span class="d-block spandHeadO text-start text-capitalize fashion-th-text">
                                                    {{ translate('order_list') }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="tdBorder fashion-orders-th">
                                            <div class="fashion-th-wrapper">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-th-icon">
                                                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM19 12L17.74 6.82C17.66 6.47 17.35 6.25 17 6.25H7C6.65 6.25 6.34 6.47 6.26 6.82L5 12V14H7V20C7 21.1 7.9 22 9 22H15C16.1 22 17 21.1 17 20V14H19V12Z" fill="currentColor"/>
                                                </svg>
                                                <span class="d-block spandHeadO fashion-th-text">
                                                    {{ translate('status') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="tdBorder fashion-orders-th">
                                            <div class="fashion-th-wrapper">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-th-icon">
                                                    <path d="M11.8 10.9C9.53 10.31 8.8 9.7 8.8 8.75C8.8 7.66 9.81 6.9 11.5 6.9C13.28 6.9 13.94 7.75 14 9H16.21C16.14 7.28 15.09 5.7 13 5.19V3H10V5.16C8.06 5.58 6.5 6.84 6.5 8.77C6.5 11.08 8.41 12.23 11.2 12.9C13.7 13.5 14.2 14.38 14.2 15.31C14.2 16 13.71 17.1 11.5 17.1C9.44 17.1 8.63 16.18 8.5 15H6.32C6.44 17.19 8.08 18.42 10 18.83V21H13V18.85C14.95 18.5 16.5 17.35 16.5 15.3C16.5 12.46 14.07 11.5 11.8 10.9Z" fill="currentColor"/>
                                                </svg>
                                                <span class="d-block spandHeadO fashion-th-text">
                                                    {{ translate('total') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="tdBorder fashion-orders-th">
                                            <div class="fashion-th-wrapper">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-th-icon">
                                                    <path d="M19 9H15L13.5 7.5C13.1 7.1 12.6 6.9 12 6.9S10.9 7.1 10.5 7.5L9 9H5C3.9 9 3 9.9 3 11V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V11C21 9.9 20.1 9 19 9ZM19 18H5V11H7.17L9.88 8.29C9.96 8.21 10.05 8.17 10.17 8.17H13.83C13.95 8.17 14.04 8.21 14.12 8.29L16.83 11H19V18Z" fill="currentColor"/>
                                                </svg>
                                                <span class="d-block spandHeadO fashion-th-text">
                                                    {{ translate('action') }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="bodytr">
                                            <div class="media-order">
                                                <a href="{{ route('account-order-details', ['id'=>$order->id]) }}" class="d-block position-relative">
                                                @if($order->seller_is == 'seller')
                                                    <img alt="{{ translate('shop') }}"
                                                         src="{{ getStorageImages(path: $order?->seller?->shop->image_full_url, type: 'shop') }}">
                                                @elseif($order->seller_is == 'admin')
                                                    <img alt="{{ translate('shop') }}"
                                                         src="{{ getStorageImages(path: $web_config['fav_icon'], type: 'shop') }}">
                                                @endif
                                                </a>
                                                <div class="cont text-start">
                                                <h6 class="font-weight-bold m-0 mb-1">
                                                    <a href="{{ route('account-order-details', ['id'=>$order->id]) }}"
                                                        class="fs-14 font-semibold">
                                                        {{ translate('order') }}  #{{$order['id']}}
                                                    </a>
                                                </h6>
                                                    <span class="fs-12 font-weight-medium">
                                                        {{ $order->order_details_sum_qty }} {{ translate('items') }}
                                                    </span>
                                                    <div class="text-secondary-50 fs-12 font-semibold mt-1">
                                                        {{date('d M, Y h:i A',strtotime($order['created_at'])) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="bodytr">
                                            @if($order['order_status']=='failed' || $order['order_status']=='canceled')
                                                <span class="status-badge rounded-pill __badge badge-soft-danger fs-12 font-semibold text-capitalize">
                                                    {{ translate($order['order_status'] =='failed' ? 'failed_to_deliver' : $order['order_status']) }}
                                                </span>
                                            @elseif($order['order_status']=='confirmed' || $order['order_status']=='processing' || $order['order_status']=='delivered')
                                                <span class="status-badge rounded-pill __badge badge-soft-success fs-12 font-semibold text-capitalize">
                                                    {{ translate($order['order_status']=='processing' ? 'packaging' : $order['order_status']) }}
                                                </span>
                                            @else
                                                <span class="status-badge rounded-pill __badge badge-soft-primary fs-12 font-semibold text-capitalize">
                                                    {{ translate($order['order_status']) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="bodytr">
                                            <div class="text-dark fs-13 font-bold">
                                                @php($orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order))
                                                {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['totalAmount']) }}
                                            </div>
                                        </td>
                                        <td class="bodytr">
                                            <div class="__btn-grp-sm flex-nowrap">
                                                <a href="{{ route('account-order-details', ['id'=>$order->id]) }}"
                                                class="btn-outline--info text-base __action-btn btn-shadow rounded-full" title="{{ translate('view_order_details') }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route('generate-invoice',[$order->id]) }}" title="{{ translate('download_invoice') }}"
                                                    class="btn-outline-success text-success __action-btn btn-shadow rounded-full">
                                                        <i class="tio-download-to"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                    <img src="{{ theme_asset(path: 'public/assets/front-end/img/empty-icons/empty-orders.svg') }}" alt="" width="100">
                                    <h5 class="text-muted fs-14 font-semi-bold text-center">{{ translate('You_have_not_any_order_yet') }}!</h5>
                                </div>
                            </div>
                        @endif


                        <div class="card-footer border-0">
                            {{$orders->links() }}
                        </div>
                    </div>
                </div>

                <div class="bg-white d-lg-none web-direction">
                    <div class="card-body d-flex flex-column gap-3 customer-profile-orders py-0">

                        <div class="d-flex align-items-center justify-content-between gap-2 mb-0 mb-md-3">
                            <h5 class="font-bold mb-0 fs-16">{{ translate('my_Order') }}</h5>

                            <button class="profile-aside-btn btn btn--primary px-2 rounded px-2 py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 9.81219C7 9.41419 6.842 9.03269 6.5605 8.75169C6.2795 8.47019 5.898 8.31219 5.5 8.31219C4.507 8.31219 2.993 8.31219 2 8.31219C1.602 8.31219 1.2205 8.47019 0.939499 8.75169C0.657999 9.03269 0.5 9.41419 0.5 9.81219V13.3122C0.5 13.7102 0.657999 14.0917 0.939499 14.3727C1.2205 14.6542 1.602 14.8122 2 14.8122H5.5C5.898 14.8122 6.2795 14.6542 6.5605 14.3727C6.842 14.0917 7 13.7102 7 13.3122V9.81219ZM14.5 9.81219C14.5 9.41419 14.342 9.03269 14.0605 8.75169C13.7795 8.47019 13.398 8.31219 13 8.31219C12.007 8.31219 10.493 8.31219 9.5 8.31219C9.102 8.31219 8.7205 8.47019 8.4395 8.75169C8.158 9.03269 8 9.41419 8 9.81219V13.3122C8 13.7102 8.158 14.0917 8.4395 14.3727C8.7205 14.6542 9.102 14.8122 9.5 14.8122H13C13.398 14.8122 13.7795 14.6542 14.0605 14.3727C14.342 14.0917 14.5 13.7102 14.5 13.3122V9.81219ZM12.3105 7.20869L14.3965 5.12269C14.982 4.53719 14.982 3.58719 14.3965 3.00169L12.3105 0.915687C11.725 0.330188 10.775 0.330188 10.1895 0.915687L8.1035 3.00169C7.518 3.58719 7.518 4.53719 8.1035 5.12269L10.1895 7.20869C10.775 7.79419 11.725 7.79419 12.3105 7.20869ZM7 2.31219C7 1.91419 6.842 1.53269 6.5605 1.25169C6.2795 0.970186 5.898 0.812187 5.5 0.812187C4.507 0.812187 2.993 0.812187 2 0.812187C1.602 0.812187 1.2205 0.970186 0.939499 1.25169C0.657999 1.53269 0.5 1.91419 0.5 2.31219V5.81219C0.5 6.21019 0.657999 6.59169 0.939499 6.87269C1.2205 7.15419 1.602 7.31219 2 7.31219H5.5C5.898 7.31219 6.2795 7.15419 6.5605 6.87269C6.842 6.59169 7 6.21019 7 5.81219V2.31219Z" fill="white"/>
                                </svg>
                            </button>
                        </div>

                        @foreach($orders as $order)
                            <div class="d-flex border-lighter rounded p-2 justify-content-between gap-2">
                                <div class="">
                                    <div class="media-order">
                                        <a href="{{ route('account-order-details', ['id'=>$order->id]) }}" class="d-block position-relative">
                                            @if($order->seller_is == 'seller')
                                                <img class="border-lighter" alt="{{ translate('shop') }}"
                                                     src="{{ getStorageImages(path:  $order?->seller?->shop->image_full_url, type: 'shop') }}">
                                            @elseif($order->seller_is == 'admin')
                                                <img alt="{{ translate('shop') }}"
                                                     src="{{ getStorageImages(path:$web_config['fav_icon'], type: 'shop') }}">
                                            @endif
                                        </a>
                                        <div class="cont text-start">
                                            <h6 class="font-weight-bold mb-1 fs-14">
                                                <a class="fs-12 font-semibold" href="{{ route('account-order-details', ['id'=>$order->id]) }}">
                                                    {{ translate('order') }} #{{$order['id']}}
                                                </a>
                                            </h6>
                                            <div class="d-flex flex-column gap-1 fs-12">
                                                <span class="fs-12 font-weight-normal">{{ $order->order_details_sum_qty }} {{ translate('items') }}</span>
                                                <div class="fs-11 font-semibold text-secondary-50">{{date('d M, Y h:i A',strtotime($order['created_at'])) }}</div>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <div class="text-nowrap fs-11 font-semibold text-secondary-50">{{ translate('total') }} :</div>
                                                    <div class="text-dark fs-13 font-weight-bold">{{ webCurrencyConverter(amount: $order['order_amount']) }}</div>
                                                </div>
                                                <div class="my-2">
                                                    @if($order['order_status']=='failed' || $order['order_status']=='canceled')
                                                        <span class="status-badge __badge badge-soft-danger border-soft-danger text-capitalize">
                                                            {{ translate($order['order_status'] =='failed' ? 'failed_to_deliver' : $order['order_status']) }}
                                                        </span>
                                                                @elseif($order['order_status']=='confirmed' || $order['order_status']=='processing' || $order['order_status']=='delivered')
                                                                    <span class="status-badge __badge badge-soft-success border-soft-success text-capitalize">
                                                            {{ translate($order['order_status']=='processing' ? 'packaging' : $order['order_status']) }}
                                                        </span>
                                                                @else
                                                                    <span class="status-badge __badge badge-soft-primary border-soft-primary text-capitalize">
                                                            {{ translate($order['order_status']) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="__btn-grp-sm ">
                                    <a href="{{ route('account-order-details', ['id'=>$order->id]) }}"
                                       class="btn-outline--info text-base __action-btn btn-shadow rounded-full" title="{{ translate('view_order_details') }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{route('generate-invoice',[$order->id]) }}" title="{{ translate('download_invoice') }}"
                                       class="btn-outline-success text-success __action-btn btn-shadow rounded-full">
                                        <i class="tio-download-to"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        @if($orders->count()==0)
                            <div class="d-flex justify-content-center align-items-center h-100 pt-5">
                                <div class="d-flex flex-column justify-content-center align-items-center gap-3">
                                    <img src="{{ theme_asset(path: 'public/assets/front-end/img/empty-icons/empty-orders.svg') }}" alt="" width="100">
                                    <h5 class="text-muted fs-14 font-semi-bold text-center">{{ translate('You_have_not_any_order_yet') }}!</h5>
                                </div>
                            </div>
                        @endif

                        <div class="card-footer border-0">
                            {{$orders->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

@endsection
