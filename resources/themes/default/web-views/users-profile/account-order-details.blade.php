@extends('layouts.front-end.app')

@section('title', translate('order_Details'))

@section('content')
    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl __inline-47 text-align-direction fashion-order-details-page">
        <div class="row g-3">
            @include('web-views.partials._profile-aside')

            <section class="col-lg-9">
                @include('web-views.users-profile.account-details.partial')
                <div class="bg-white border-lg rounded mobile-full fashion-order-details-card">
                    <div class="p-lg-3 p-0 fashion-order-details-body">
                        <div class="d-flex justify-content-between gap-2 flex-wrap mb-3 fashion-order-details-header">
                            @if($order->order_type == 'default_type' && getWebConfig(name: 'order_verification'))
                                <div class="d-flex gap-3 flex-wrap">
                                    <div class="bg-light rounded py-2 px-3 d-flex align-items-center fashion-verification-badge">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-verification-icon">
                                            <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="fs-14 text-capitalize fashion-verification-text">
                                            {{translate('order_verification_code')}} : <strong
                                                class="text-base">{{$order['verification_code']}}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($order->order_type == 'POS')
                                <div>
                                    <span class="pos-btn hover-none">{{translate('POS_Order')}}</span>
                                </div>
                            @endif
                            <div class="d-flex align-items-start gap-2 fashion-order-actions">
                                <button type="button" class="btn btn-square d-none d-md-block get-view-by-onclick fashion-download-btn"
                                        data-link="{{route('generate-invoice',[$order->id])}}">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-download-icon">
                                        <path d="M14 2H6C4.9 2 4.01 2.9 4.01 4L4 20C4 21.1 4.89 22 6 22H18C19.1 22 20 21.1 20 20V8L14 2ZM18 20H6V4H13V9H18V20ZM12 19L8 15H10.5V12H13.5V15H16L12 19Z" fill="currentColor"/>
                                    </svg>
                                </button>
                                @if($order->order_status=='delivered')
                                    <button
                                        class="btn btn--primary btn-sm h-40px rounded text_capitalize d-none d-md-block get-order-again-function fashion-reorder-btn"
                                        data-id="{{ $order->id }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-reorder-icon">
                                            <path d="M17 17H22L18 21L14 17H19C19 14.24 16.76 12 14 12S9 14.24 9 17H7C7 13.13 10.13 10 14 10S21 13.13 21 17H17ZM12 7H7L11 3L15 7H10C10 9.76 12.24 12 15 12S20 9.76 20 7H22C22 10.87 18.87 14 15 14S8 10.87 8 7H12Z" fill="currentColor"/>
                                        </svg>
                                        {{ translate('reorder') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="card border-sm">
                            <div class="p-lg-3">
                                <div class="border-lg rounded payment mb-lg-3 table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <thead>
                                        <tr class="order_table_tr">
                                            <td class="order_table_td">
                                                <div class="">
                                                    <div
                                                        class="_1 py-2 d-flex justify-content-between align-items-center">
                                                        <h6 class="fs-13 font-bold text-capitalize">{{translate('payment_info')}}</h6>
                                                        <button type="button" class="btn btn-square d-sm-none get-view-by-onclick"
                                                                data-link="{{route('generate-invoice',[$order->id])}}">
                                                            <img src="{{theme_asset(path: 'public/assets/front-end/img/icons/downloads.png')}}" alt="">
                                                        </button>
                                                    </div>
                                                    <div class="fs-12">
                                                        <span
                                                            class="text-muted text-capitalize">{{translate('payment_status')}}</span>
                                                        :
                                                        <span
                                                            class="text-{{$order['payment_status'] == 'paid' ? 'success' : 'danger'}} text-capitalize">{{$order['payment_status']}}</span>
                                                    </div>
                                                    <div class="mt-2 fs-12">
                                                        <span
                                                            class="text-muted text-capitalize">{{translate('payment_method')}}</span>
                                                        :
                                                        <span
                                                            class="text-primary text-capitalize">{{translate($order['payment_method'])}}</span>
                                                    </div>
                                                    @if($order->payment_method == 'offline_payment' && isset($order->offlinePayments))
                                                        <button type="button"
                                                                class="btn bg--secondary border border-primary-light mt-3 rounded-pill btn-sm text-capitalize fs-10 font-semi-bold"
                                                                data-toggle="modal"
                                                                data-target="#verifyViewModal">{{translate('see_payment_details')}}</button>
                                                    @endif
                                                </div>
                                            </td>
                                            @if( $order->order_type == 'default_type')

                                                @php($shippingAddressShow = 0)
                                                @foreach($order->details as $details)
                                                    @if(isset($details->product_details) && isset(json_decode($details->product_details)?->product_type) && json_decode($details->product_details)?->product_type == "physical")
                                                        @php($shippingAddressShow = 1)
                                                    @endif
                                                @endforeach

                                                @php($shipping=$order['shipping_address_data'])
                                                @if($shipping && $shippingAddressShow)
                                                    <td class="order_table_td">
                                                        <div class="">
                                                            <div class=" py-2">
                                                                <h6 class="fs-13 font-bold text-capitalize">
                                                                    {{translate('shipping_address')}}:
                                                                </h6>
                                                            </div>
                                                            <div class="">
                                                                <span class="text-capitalize fs-12">
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px">{{translate('name')}}</span> :&nbsp; {{$shipping->contact_person_name}}
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px">{{translate('phone')}}</span> :&nbsp; {{$shipping->phone}},
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span class="min-w-60px">
                                                                            {{ translate('city') }} / {{translate('zip')}}
                                                                        </span> :&nbsp; {{$shipping->city}}, {{$shipping->zip}}
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span class="min-w-60px">
                                                                            {{ translate('address') }}
                                                                        </span> : {{$shipping->address}}
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                                <td class="order_table_td">
                                                    <div class="">
                                                        <div class="py-2">
                                                            <h6 class="fs-13 font-bold text-capitalize">
                                                                {{translate('billing_address')}}:
                                                            </h6>
                                                        </div>
                                                        <div class="">
                                                            @php($billing=$order['billing_address_data'])
                                                            <span class="text-capitalize fs-12">
                                                                @if($billing)
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px">{{translate('name')}}</span> : &nbsp;{{$billing->contact_person_name}}
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px">{{translate('phone')}}</span> : &nbsp;{{$billing->phone}},
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span class="min-w-60px">
                                                                            {{ translate('city') }} / {{translate('zip')}}
                                                                        </span> :&nbsp; {{$billing->city}}, {{$billing->zip}}
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span class="min-w-60px">
                                                                            {{translate('address')}}
                                                                        </span> :&nbsp; {{$billing->address}}
                                                                    </span>
                                                                @elseif($shipping)
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px">{{translate('name')}}</span> : &nbsp;{{$shipping->contact_person_name}}
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px">{{translate('phone')}}</span> :&nbsp; {{$shipping->phone}},
                                                                    </span>
                                                                    <br>
                                                                    <span class="text-capitalize">
                                                                        <span
                                                                            class="min-w-60px"> {{translate('address')}}</span> :&nbsp;
                                                                        {{$shipping->address}},
                                                                        {{$shipping->city}}
                                                                        , {{$shipping->zip}}
                                                                    </span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div class="payment mb-3 table-responsive d-none d-lg-block">
                                    <table class="table table-borderless min-width-600px">
                                        <thead class="thead-light text-capitalize">
                                        <tr class="fs-13 font-semi-bold">
                                            <th>{{translate('order_details')}}</th>
                                            <th>{{translate('qty')}}</th>
                                            <th class="text-right">{{translate('price')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($order->details as $key=>$detail)
                                            @php($product=json_decode($detail->product_details,true))
                                            @if($product)
                                                <tr>
                                                    <td class="for-tab-img">
                                                        <div class="media gap-3 align-items-center">
                                                            <div class="position-relative border rounded overflow-hidden">
                                                                @if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0)
                                                                    <span class="for-discount-value px-1 direction-ltr">
                                                                            -{{ getProductPriceByType(product: $product, type: 'discount', result: 'string') }}
                                                                        </span>
                                                                @endif
                                                                <img class="d-block get-view-by-onclick aspect-1 object-cover"
                                                                     data-link="{{ route('product',$product['slug']) }}"
                                                                     src="{{ getStorageImages(path: $detail?->productAllStatus?->thumbnail_full_url, type: 'product') }}"
                                                                     alt="{{ translate('product') }}" width="100">
                                                            </div>

                                                            <div class="media-body">
                                                                <a href="{{route('product',[$product['slug']])}}" class="fs-14 font-semi-bold">
                                                                    {{isset($product['name']) ? Str::limit($product['name'], 60) : ''}}
                                                                </a>
                                                                @if($detail->refund_request == 1)
                                                                    <small> ({{translate('refund_pending')}}) </small>
                                                                    <br>
                                                                @elseif($detail->refund_request == 2)
                                                                    <small> ({{translate('refund_approved')}}) </small>
                                                                    <br>
                                                                @elseif($detail->refund_request == 3)
                                                                    <small> ({{translate('refund_rejected')}}) </small>
                                                                    <br>
                                                                @elseif($detail->refund_request == 4)
                                                                    <small> ({{translate('refund_refunded')}}) </small>
                                                                    <br>
                                                                @endif

                                                                @if($detail->variant)
                                                                    <br>
                                                                    <small class="fs-12 text-secondary-50">
                                                                        <span class="font-bold">{{translate('variant')}} : </span>
                                                                        <span class="font-semi-bold">{{$detail->variant}}</span>
                                                                    </small>
                                                                @endif

                                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                                    @if($detail?->product && $order->payment_status == 'paid' && $detail?->product->digital_product_type == 'ready_product')
                                                                        <a class="btn btn-sm rounded btn--primary action-digital-product-download"
                                                                           data-link="{{ route('digital-product-download', $detail->id) }}"
                                                                           href="javascript:">{{translate('download')}}
                                                                            <i class="tio-download-from-cloud"></i></a>
                                                                    @elseif($detail?->product && $order->payment_status == 'paid' && $detail?->product->digital_product_type == 'ready_after_sell')
                                                                        @if($detail->digital_file_after_sell)
                                                                            <a class="btn btn-sm rounded btn--primary action-digital-product-download"
                                                                               data-link="{{ route('digital-product-download', $detail->id) }}"
                                                                               href="javascript:">{{translate('download')}}
                                                                                <i class="tio-download-from-cloud"></i></a>
                                                                        @else

                                                                            <span class="" data-toggle="tooltip"
                                                                                  data-placement="top"
                                                                                  title="{{translate('product_not_uploaded_yet')}}">
                                                                                    <a class="btn btn-sm rounded btn--primary disabled">{{translate('download')}} <i
                                                                                            class="tio-download-from-cloud"></i></a>
                                                                                </span>
                                                                        @endif
                                                                    @endif
                                                                        <?php
                                                                        $refund_day_limit = getWebConfig(name: 'refund_day_limit');
                                                                        $order_details_date = $detail->created_at;
                                                                        $current = \Carbon\Carbon::now();
                                                                        $length = $order_details_date->diffInDays($current);
                                                                        ?>

                                                                    @if($order->order_type == 'default_type')
                                                                        @if($order->order_status=='delivered')
                                                                            @if (isset($detail->product))
                                                                                <button type="button"
                                                                                        class="btn btn-sm rounded btn-warning"
                                                                                        data-toggle="modal"
                                                                                        data-target="#submitReviewModal{{$detail->id}}">
                                                                                    @if (isset($detail->reviewData))
                                                                                        <i class="tio-star-half"></i>{{translate('Update_Review')}}
                                                                                    @else
                                                                                        <i class="tio-star-half"></i>{{translate('review')}}
                                                                                    @endif
                                                                                </button>
                                                                            @endif

                                                                            @if($detail->refund_request !=0)
                                                                                <button type="button"
                                                                                        class="btn btn-sm rounded btn--primary action-get-refund-details"
                                                                                        data-route="{{ route('refund-details', ['id'=>$detail->id]) }}">
                                                                                    {{translate('refund_details')}}
                                                                                </button>
                                                                            @endif
                                                                            @if( $length <= $refund_day_limit && $detail->refund_request == 0)
                                                                                <button
                                                                                    class="btn btn-sm rounded btn--primary"
                                                                                    data-toggle="modal"
                                                                                    data-target="#refundModal{{$detail->id}}">{{translate('refund')}}</button>
                                                                            @endif
                                                                        @endif
                                                                    @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <div class="pl-2">
                                                            <span class="word-nobreak font-weight-bold">
                                                                {{$detail->qty}}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td class="text-right align-middle">
                                                        <span class="font-weight-bold amount">
                                                            {{ getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 d-flex flex-column gap-2 d-lg-none">
                            <hr>
                            @foreach ($order->details as $key=>$detail)
                                @php($product=json_decode($detail->product_details,true))
                                @if($product)
                                    <div class="bg-white border rounded p-3">
                                        <div class="d-flex justify-content-between gap-3">
                                            <div class="for-tab-img">
                                                <div class="media flex-wrap gap-2">
                                                    <div class="position-relative border rounded overflow-hidden">
                                                        @if($product['discount'] > 0)
                                                            <span class="for-discount-value px-1 direction-ltr">
                                                                @if ($product['discount_type'] == 'percent')
                                                                    -{{round($product['discount'],(!empty($decimal_point_settings) ? $decimal_point_settings: 0))}}
                                                                    %
                                                                @elseif($product['discount_type'] =='flat')
                                                                    -{{ webCurrencyConverter(amount: $product['discount']) }}
                                                                @endif
                                                            </span>
                                                        @endif
                                                        <img class="d-block get-view-by-onclick aspect-1 object-cover"
                                                             data-link="{{ route('product',$product['slug']) }}"
                                                             src="{{ getStorageImages(path: $detail?->productAllStatus?->thumbnail_full_url, type: 'product') }}"
                                                             alt="{{ translate('product') }}" width="80">
                                                    </div>

                                                    <div class="media-body">
                                                        <a href="{{route('product',[$product['slug']])}}" class="fs-14">
                                                            {{isset($product['name']) ? Str::limit($product['name'],40) : ''}}
                                                        </a>
                                                        @if($detail->refund_request == 1)
                                                            <small> ({{translate('refund_pending')}}) </small>
                                                        @elseif($detail->refund_request == 2)
                                                            <small> ({{translate('refund_approved')}}) </small>
                                                        @elseif($detail->refund_request == 3)
                                                            <small> ({{translate('refund_rejected')}}) </small>
                                                        @elseif($detail->refund_request == 4)
                                                            <small> ({{translate('refund_refunded')}}) </small>
                                                        @endif<br>
                                                        <span class="d-flex justify-content-between">
                                                            @if($detail->variant)
                                                                <small>
                                                                    <span
                                                                        class="text-muted">{{translate('variant')}} : </span>
                                                                    {{$detail->variant}}
                                                                </small>
                                                            @endif
                                                            <small>
                                                                <span class="text-muted">{{translate('qty')}} : </span>
                                                                {{$detail->qty}}
                                                            </small>
                                                        </span>

                                                        <small class="d-flex align-items-center gap-2">
                                                            <span class="text-nowrap text-muted">
                                                                {{translate('price')}} :
                                                            </span>
                                                            <span class="font-weight-bold amount">
                                                                {{ webCurrencyConverter(amount: $detail->price) }}
                                                            </span>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end flex-wrap gap-2 mt-2">
                                            @if($detail?->product && $order->payment_status == 'paid' && $detail?->product->digital_product_type == 'ready_product')
                                                <a class="btn btn-sm rounded btn--primary action-digital-product-download"
                                                   data-link="{{ route('digital-product-download', $detail->id) }}"
                                                   href="javascript:">{{translate('download')}} <i
                                                        class="tio-download-from-cloud"></i></a>
                                            @elseif($detail?->product && $order->payment_status == 'paid' && $detail?->product->digital_product_type == 'ready_after_sell')
                                                @if($detail->digital_file_after_sell)
                                                    <a class="btn btn-sm rounded btn--primary action-digital-product-download"
                                                       data-link="{{ route('digital-product-download', $detail->id) }}"
                                                       href="javascript:">{{translate('download')}} <i
                                                            class="tio-download-from-cloud"></i></a>
                                                @else

                                                    <span class="" data-toggle="tooltip" data-placement="top"
                                                          title="{{translate('product_not_uploaded_yet')}}">
                                                        <a class="btn btn-sm rounded btn--primary disabled">{{translate('download')}} <i
                                                                class="tio-download-from-cloud"></i></a>
                                                    </span>
                                                @endif
                                            @endif
                                                <?php
                                                $refund_day_limit = getWebConfig(name: 'refund_day_limit');
                                                $order_details_date = $detail->created_at;
                                                $current = \Carbon\Carbon::now();
                                                $length = $order_details_date->diffInDays($current);
                                                ?>

                                            @if($order->order_type == 'default_type')
                                                @if($order->order_status=='delivered')
                                                    @if (isset($detail->product))
                                                        <button type="button" class="btn btn-sm rounded btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#submitReviewModal{{$detail->id}}">
                                                            @if (isset($detail->reviewData))
                                                                <i class="tio-star-half"></i>{{translate('Update_Review')}}
                                                            @else
                                                                <i class="tio-star-half"></i>{{translate('review')}}
                                                            @endif
                                                        </button>
                                                    @endif
                                                    @if($detail->refund_request !=0)
                                                        <button type="button" class="btn btn-sm rounded btn--primary action-get-refund-details"
                                                                data-route="{{ route('refund-details',['id'=>$detail->id]) }}">
                                                            {{translate('refund_details')}}
                                                        </button>
                                                    @endif
                                                    @if( $length <= $refund_day_limit && $detail->refund_request == 0)
                                                        <button class="btn btn-sm rounded btn--primary"
                                                                data-toggle="modal" data-target="#refundModal{{$detail->id}}">
                                                            {{ translate('refund') }}
                                                        </button>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <hr>
                        </div>

                        @php($orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order))
                        <div class="row d-flex justify-content-end mt-2">
                            <div class="col-md-8 col-lg-5">
                                <div class="bg-white border-sm rounded">
                                    <div class="card-body">
                                        <table class="calculation-table table table-borderless mb-0">
                                            <tbody class="totals">
                                            <tr>
                                                <td>
                                                    <div class="text-start">
                                                        <span class="product-qty ">{{translate('Total_Item')}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="fs-15 font-semi-bold">
                                                            {{ $orderTotalPriceSummary['totalItemQuantity'] }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-start">
                                                        <span class="product-qty ">{{translate('item_price')}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="fs-15 font-semi-bold">
                                                            {{ webCurrencyConverter(amount: $orderTotalPriceSummary['itemPrice']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="text-start">
                                                        <span class="product-qty ">{{translate('item_discount')}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="fs-15 font-semi-bold">
                                                            {{ webCurrencyConverter(amount: $orderTotalPriceSummary['itemDiscount']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            @if($order->order_type != 'default_type')
                                                <tr>
                                                    <td>
                                                        <div class="text-start">
                                                            <span class="product-qty">
                                                                {{translate('extra_discount')}}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <span class="fs-15 font-semi-bold">
                                                                - {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['extraDiscount']) }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td>
                                                    <div class="text-start">
                                                        <span class="product-qty">{{translate('subtotal')}}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="fs-15 font-semi-bold">
                                                            {{ webCurrencyConverter(amount: $orderTotalPriceSummary['subTotal']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="text-start">
                                                        <span class="product-qty">
                                                            {{translate('coupon_discount')}}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="fs-15 font-semi-bold">
                                                            - {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['couponDiscount']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="text-start">
                                                        <span class="product-qty">
                                                            {{translate('tax_fee')}}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="fs-15 font-semi-bold">
                                                            {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['taxTotal']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            @if($order->order_type == 'default_type' && $order?->is_shipping_free == 0)
                                                <tr>
                                                    <td>
                                                        <div class="text-start">
                                                            <span class="product-qty">
                                                                {{translate('shipping_Fee')}}
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <span class="fs-15 font-semi-bold">
                                                                {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['shippingTotal']) }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr class="border-top">
                                                <td>
                                                    <div class="text-start">
                                                        <span class="font-weight-bold">
                                                            <strong>{{translate('total')}}</strong>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="font-weight-bold amount">
                                                            {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['totalAmount']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if ($order->order_type == 'POS' || $order->order_type == 'pos')
                                                <tr class="border-top">
                                                    <td>
                                                        <div class="text-start">
                                                            <span class="font-weight-bold">
                                                                <strong>{{translate('paid_amount')}}</strong>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-end">
                                                            <span class="font-weight-bold amount">
                                                                {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['paidAmount']) }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                <td>
                                                    <div class="text-start">
                                                        <span class="font-weight-bold">
                                                            <strong>{{translate('change_amount')}}</strong>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-end">
                                                        <span class="font-weight-bold amount">
                                                            {{ webCurrencyConverter(amount:  $orderTotalPriceSummary['changeAmount']) }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                            </tbody>
                                        </table>

                                        @if ($order['order_status']=='pending')
                                            <button class="btn btn-soft-danger btn-soft-border w-100 btn-sm text-danger font-semi-bold text-capitalize mt-3 call-route-alert"
                                                    data-route="{{ route('order-cancel',[$order->id]) }}"
                                                    data-message="{{translate('want_to_cancel_this_order?')}}">
                                                {{translate('cancel_order')}}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @foreach ($order->details as $key=>$detail)
        @php($product=json_decode($detail->product_details,true))
        @if($product)
            @include('layouts.front-end.partials.modal._review',['id'=>$detail->id,'order_details'=>$detail])
            @include('layouts.front-end.partials.modal._refund',['id'=>$detail->id,'order_details'=>$detail,'order'=>$order,'product'=>$product])
        @endif
    @endforeach

    @if($order->order_status=='delivered')
        <div class="bottom-sticky_offset"></div>
        <div class="bottom-sticky_ele bg-white d-md-none p-3 ">
            <button class="btn btn--primary w-100 text_capitalize get-order-again-function" data-id="{{ $order->id }}">
                {{ translate('reorder') }}
            </button>
        </div>
    @endif

    @if($order->payment_method == 'offline_payment' && isset($order->offlinePayments))
        <div class="modal fade" id="verifyViewModal" tabindex="-1" aria-labelledby="verifyViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rtl">
                    <div class="modal-header d-flex justify-content-end  border-0 pb-0">
                        <button type="button" class="close pe-0" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>

                    <div class="modal-body pt-0">
                        <h5 class="mb-3 text-center text-capitalize fs-16 font-semi-bold">
                            {{ translate('payment_verification') }}
                        </h5>

                        <div class="shadow-sm rounded p-3">
                            <h6 class="mb-3 text-capitalize fs-16 font-semi-bold">
                                {{translate('customer_information')}}
                            </h6>

                            <div class="d-flex flex-column gap-2 fs-12 mb-4">
                                <div class="d-flex align-items-center gap-2">
                                    <span class=" min-w-120">{{translate('name')}}</span>
                                    <span>:</span>
                                    <span class="text-dark">
                                        <a class="font-weight-medium fs-12 text-capitalize" href="Javascript:">
                                            {{$order->customer->f_name ?? translate('name_not_found') }}&nbsp;{{$order->customer->l_name ?? ''}}
                                        </a>
                                    </span>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <span class=" min-w-120">{{translate('phone')}}</span>
                                    <span>:</span>
                                    <span class="text-dark">
                                        <a class="font-weight-medium fs-12 text-capitalize" href="{{ $order?->customer?->phone ? 'tel:'.$order?->customer?->phone : 'javascript:' }}">
                                            {{ $order->customer->phone ?? translate('number_not_found') }}
                                        </a>
                                    </span>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-4">
                                <h6 class="mb-3 text-capitalize fs-16 font-semi-bold">
                                    {{ translate('payment_information') }}
                                </h6>

                                <div class="d-flex flex-column gap-2 fs-12">

                                    @foreach ($order->offlinePayments->payment_info as $key=>$value)
                                        @if ($key != 'method_id')
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-capitalize min-w-120">{{translate($key)}}</span>
                                                <span>:</span>
                                                <span class="font-weight-medium fs-12 ">
                                                    {{$value}}
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach

                                    @if($order->payment_note)
                                        <div class="d-flex align-items-start gap-2">
                                            <span class="text-capitalize min-w-120">{{ translate('payment_none') }}</span>
                                            <span>:</span>
                                            <span class="font-weight-medium fs-12 "> {{ $order->payment_note }}  </span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="refund_details_modal" tabindex="-1" aria-labelledby="refundRequestModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h6 class="text-center text-capitalize m-0 flex-grow-1">{{translate('refund_details')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body d-flex flex-column gap-3" id="refund_details_field">
                </div>
            </div>
        </div>
    </div>

    <span id="message-ratingContent"
          data-poor="{{ translate('poor') }}"
          data-average="{{ translate('average') }}"
          data-good="{{ translate('good') }}"
          data-good-message="{{ translate('the_delivery_service_is_good') }}"
          data-good2="{{ translate('very_Good') }}"
          data-good2-message="{{ translate('this_delivery_service_is_very_good_I_am_highly_impressed') }}"
          data-excellent="{{ translate('excellent') }}"
          data-excellent-message="{{ translate('best_delivery_service_highly_recommended') }}"
    ></span>
@endsection


@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/spartan-multi-image-picker.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/account-order-details.js') }}"></script>
@endpush
