@extends('layouts.front-end.app')

@section('title', translate('order_Complete'))

@section('content')
    <div class="container mt-5 mb-5 rtl __inline-53 text-align-direction fashion-order-complete-page">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-lg-10">
                <div class="card fashion-complete-card">
                    @if(auth('customer')->check() || session('guest_id'))
                        <div class="card-body fashion-complete-body">
                            <div class="mb-3 text-center fashion-success-icon-wrapper">
                                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-success-icon">
                                    <path d="M12 2C6.48 2 2 6.48 2 12S6.48 22 12 22S22 17.52 22 12S17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="currentColor"/>
                                </svg>
                            </div>

                            <h6 class="font-black fw-bold text-center fashion-success-title">
                                @if(isset($isNewCustomerInSession) && $isNewCustomerInSession)
                                    {{ translate('Order_Placed_&_Account_Created_Successfully') }}!
                                @else
                                    {{ translate('Order_Placed_Successfully') }}!
                                @endif
                            </h6>

                            @if (isset($order_ids) && count($order_ids) > 0)
                                <p class="text-center fs-12">
                                    {{ translate('your_payment_has_been_successfully_processed_and_your_order') }} -
                                    <span class="fw-bold text-primary">
                                        @foreach ($order_ids as $key => $order)
                                            {{ $order }}
                                        @endforeach
                                    </span>
                                    {{ translate('has_been_placed.') }}
                                </p>
                            @else
                                <p class="text-center fs-12">
                                    {{ translate('your_order_is_being_processed_and_will_be_completed.') }}
                                    {{ translate('You_will_receive_an_email_confirmation_when_your_order_is_placed.') }}
                                </p>
                            @endif

                            <div class="row mt-4 fashion-complete-actions">
                                <div class="col-12 text-center">
                                    <a href="{{ route('track-order.index') }}"
                                       class="btn btn--primary mb-3 text-center fashion-track-btn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-track-icon">
                                            <path d="M12 2L13.09 8.26L19 9L13.09 9.74L12 16L10.91 9.74L5 9L10.91 8.26L12 2ZM21 3V7L18 4L14 8L12.5 6.5L16.5 2.5L13 -1H17L21 3Z" fill="currentColor"/>
                                        </svg>
                                        {{ translate('track_Order')}}
                                    </a>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{route('home')}}" class="text-center fashion-continue-link">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-continue-icon">
                                            <path d="M19 7H18V6C18 3.79 16.21 2 14 2S10 3.79 10 6V7H9C7.9 7 7 7.9 7 9V20C7 21.1 7.9 22 9 22H19C20.1 22 21 21.1 21 20V9C21 7.9 20.1 7 19 7ZM14 16C13.45 16 13 15.55 13 15S13.45 14 14 14S15 14.45 15 15S14.55 16 14 16ZM16 7H12V6C12 4.9 12.9 4 14 4S16 5.1 16 6V7Z" fill="currentColor"/>
                                        </svg>
                                        {{ translate('Continue_Shopping') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
