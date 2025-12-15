@extends('layouts.front-end.app')

@section('title', translate('Checkout'))

@section('content')

    <div class="container pb-5 mb-2 mb-md-4 rtl __inline-54 text-align-direction checkout-details-page fashion-checkout-page">
        <div class="row">
            <div class="col-md-12 mb-5 pt-5">
                <div class="feature_header __feature_header fashion-checkout-header">
                    <div class="fashion-checkout-title-wrapper">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-checkout-icon">
                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z" fill="currentColor"/>
                        </svg>
                        <span>{{ translate('sign_in')}}</span>
                    </div>
                </div>
            </div>
            <section class="col-lg-8">
                <div class="checkout_details fashion-checkout-details">
                    @include('web-views.partials._checkout-steps',['step'=>1])
                    <div class="fashion-checkout-section">
                        <h2 class="h4 pb-3 mb-2 mt-5 fashion-section-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-section-icon">
                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 7.5V9.5L21 9ZM3 9V7L9 7.5V9.5L3 9ZM12 7C13.86 7 15.46 8.27 15.88 10L15.88 10C15.96 10.33 16 10.66 16 11V12.5L20.5 14L19 16L12 13L5 16L3.5 14L8 12.5V11C8 10.66 8.04 10.33 8.12 10C8.54 8.27 10.14 7 12 7Z" fill="currentColor"/>
                            </svg>
                            {{translate('authentication')}}
                        </h2>
                    </div>
                    @if(auth('customer')->check())
                        <div class="card fashion-auth-card">
                            <div class="card-body fashion-auth-body">
                                <div class="fashion-welcome-message">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-welcome-icon">
                                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8ZM12 18C16.42 18 20 19.79 20 22H4C4 19.79 7.58 18 12 18Z" fill="currentColor"/>
                                    </svg>
                                    <div>
                                        <h4 class="fashion-welcome-title">{{auth('customer')->user()->f_name}}, {{translate('Hi')}}!</h4>
                                        <small class="fashion-welcome-text">{{translate('you_are_already_Sign_in_proceed')}}.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mt-2 d-flex justify-content-between fashion-auth-tabs" role="tablist">
                                    <li class="nav-item d-inline-block">
                                        <a class="nav-link active fashion-tab-link" href="#signin" data-toggle="tab" role="tab">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-tab-icon">
                                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8Z" fill="currentColor"/>
                                            </svg>
                                            {{translate('sign_in')}}
                                        </a>
                                    </li>
                                    <li class="nav-item d-inline-block">
                                        <a class="nav-link fashion-tab-link" href="#signup" data-toggle="tab" role="tab">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-tab-icon">
                                                <path d="M15 14C17.67 14 23 15.33 23 18V20H7V18C7 15.33 12.33 14 15 14ZM15 12C12.79 12 11 10.21 11 8C11 5.79 12.79 4 15 4C17.21 4 19 5.79 19 8C19 10.21 17.21 12 15 12ZM5 9.59L7.12 7.46L8.54 8.88L5 12.41L2.46 9.88L3.88 8.46L5 9.59Z" fill="currentColor"/>
                                            </svg>
                                            {{ translate('sign_up')}}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="tab-content fashion-tab-content">
                                    <div class="tab-pane fade show active" id="signin" role="tabpanel">
                                        <form class="needs-validation fashion-auth-form" autocomplete="off" id="login-form"
                                              action="{{route('customer.auth.login')}}" method="post" novalidate>
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group fashion-form-group">
                                                        <label for="si-email" class="fashion-form-label">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-input-icon">
                                                                <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                                                            </svg>
                                                            {{ translate('email_address')}}
                                                        </label>
                                                        <input class="form-control fashion-form-input" type="email" name="email"
                                                               id="si-email" value="{{old('email')}}"
                                                               placeholder="{{ translate('enter_your_email') }}" required>
                                                        <div class="invalid-feedback fashion-invalid-feedback">
                                                            {{ translate('please_provide_a_valid_email_address')}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group fashion-form-group">
                                                        <label for="si-password" class="fashion-form-label">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-input-icon">
                                                                <path d="M18 8H17V6C17 3.24 14.76 1 12 1S7 3.24 7 6V8H6C4.9 8 4 8.9 4 10V20C4 21.1 4.9 22 6 22H18C19.1 22 20 21.1 20 20V10C20 8.9 19.1 8 18 8ZM12 17C10.9 17 10 16.1 10 15S10.9 13 12 13S14 13.9 14 15S13.1 17 12 17ZM15 8H9V6C9 4.34 10.34 3 12 3S15 4.34 15 6V8Z" fill="currentColor"/>
                                                            </svg>
                                                            {{ translate('password')}}
                                                        </label>
                                                        <div class="password-toggle rtl fashion-password-toggle">
                                                            <input class="form-control fashion-form-input" name="password" type="password"
                                                                   id="si-password" required>
                                                            <label class="password-toggle-btn fashion-password-btn">
                                                                <input class="custom-control-input" type="checkbox">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-eye-icon">
                                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7S17 9.24 17 12S14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15S15 13.66 15 12S13.66 9 12 9Z" fill="currentColor"/>
                                                                </svg>
                                                                <span class="sr-only">{{ translate('show_password')}}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group d-flex flex-wrap justify-content-between fashion-form-options">
                                                        <div class="mb-2 fashion-checkbox-wrapper">
                                                            <input type="checkbox" name="remember"
                                                                   {{ old('remember') ? 'checked' : '' }}
                                                                   id="remember_me" class="fashion-checkbox">
                                                            <label for="remember_me" class="cursor-pointer fashion-checkbox-label">
                                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-checkbox-icon">
                                                                    <path d="M9 16.17L4.83 12L3.41 13.41L9 19L21 7L19.59 5.59L9 16.17Z" fill="currentColor"/>
                                                                </svg>
                                                                {{ translate('remember_me')}}
                                                            </label>

                                                            <a class="font-size-sm {{Session::get('direction') === "rtl" ? 'mr-5' : 'ml-5'}} fashion-forgot-link"
                                                               href="{{route('customer.auth.recover-password')}}">
                                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-link-icon">
                                                                    <path d="M11 18H13V16H11V18ZM12 2C6.48 2 2 6.48 2 12S6.48 22 12 22S22 17.52 22 12S17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12S7.59 4 12 4S20 7.59 20 12S16.41 20 12 20ZM12 6C9.79 6 8 7.79 8 10H10C10 8.9 10.9 8 12 8S14 8.9 14 10C14 12 11 11.75 11 15H13C13 12.75 16 12.5 16 10C16 7.79 14.21 6 12 6Z" fill="currentColor"/>
                                                                </svg>
                                                                {{ translate('forgot_password')}}?
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn--primary btn-block fashion-signin-btn" type="submit">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-btn-icon">
                                                            <path d="M10 17L15 12L10 7V10H2V14H10V17Z" fill="currentColor"/>
                                                        </svg>
                                                        {{ translate('sing_in')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="signup" role="tabpanel">
                                        <form class="needs-validation_ fashion-auth-form" autocomplete="off" novalidate id="sign-up-form"
                                              action="{{route('customer.auth.register')}}" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group fashion-form-group">
                                                        <label for="su-name" class="fashion-form-label">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-input-icon">
                                                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8Z" fill="currentColor"/>
                                                            </svg>
                                                            {{ translate('first_name')}}
                                                        </label>
                                                        <input class="form-control fashion-form-input" type="text" name="f_name"
                                                               placeholder="{{ translate('John') }}" required>
                                                        <div class="invalid-feedback fashion-invalid-feedback">
                                                            {{ translate('please_fill_in_your_first_name.')}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group fashion-form-group">
                                                        <label for="su-name" class="fashion-form-label">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-input-icon">
                                                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM12 8C14.21 8 16 9.79 16 12C16 14.21 14.21 16 12 16C9.79 16 8 14.21 8 12C8 9.79 9.79 8 12 8Z" fill="currentColor"/>
                                                            </svg>
                                                            {{ translate('last_name')}}
                                                        </label>
                                                        <input class="form-control fashion-form-input" type="text" name="l_name"
                                                               placeholder="{{ translate('Doe') }}" required>
                                                        <div class="invalid-feedback fashion-invalid-feedback">
                                                            {{ translate('please_fill_in_your_last_name.')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group fashion-form-group">
                                                        <label for="su-email" class="fashion-form-label">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-input-icon">
                                                                <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="currentColor"/>
                                                            </svg>
                                                            {{ translate('email_address')}}
                                                        </label>
                                                        <input class="form-control fashion-form-input" name="email" type="email"
                                                               id="su-email" placeholder="{{ translate('enter_your_email') }}"
                                                               required>
                                                        <div class="invalid-feedback fashion-invalid-feedback">
                                                            {{ translate('please_provide_a_valid_email_address.')}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group fashion-form-group">
                                                        <label for="su-phone" class="fashion-form-label">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="fashion-input-icon">
                                                                <path d="M6.62 10.79C8.06 13.62 10.38 15.94 13.21 17.38L15.41 15.18C15.69 14.9 16.08 14.82 16.43 14.93C17.55 15.3 18.75 15.5 20 15.5C20.55 15.5 21 15.95 21 16.5V20C21 20.55 20.55 21 20 21C10.61 21 3 13.39 3 4C3 3.45 3.45 3 4 3H7.5C8.05 3 8.5 3.45 8.5 4C8.5 5.25 8.7 6.45 9.07 7.57C9.18 7.92 9.1 8.31 8.82 8.59L6.62 10.79Z" fill="currentColor"/>
                                                            </svg>
                                                            {{ translate('phone')}}
                                                        </label>
                                                        <input class="form-control fashion-form-input" name="phone" type="number"
                                                               id="su-phone" placeholder="{{ translate('01700000000')}}"
                                                               required>
                                                        <div class="invalid-feedback fashion-invalid-feedback">
                                                            {{ translate('please_provide_a_valid_phone_number.')}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="su-password">{{ translate('password')}}</label>
                                                        <div class="password-toggle">
                                                            <input class="form-control" name="password" type="password"
                                                                   id="su-password" required>
                                                            <label class="password-toggle-btn">
                                                                <input class="custom-control-input" type="checkbox"><i
                                                                    class="czi-eye password-toggle-indicator"></i><span
                                                                    class="sr-only">{{ translate('show_password')}}</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="su-password-confirm">
                                                            {{ translate('confirm_password')}}
                                                        </label>
                                                        <div class="password-toggle rtl">
                                                            <input class="form-control" name="con_password"
                                                                   type="password" id="su-password-confirm"
                                                                   required>
                                                            <label class="password-toggle-btn">
                                                                <input class="custom-control-input" type="checkbox">
                                                                <i class="czi-eye password-toggle-indicator"></i>
                                                                <span class="sr-only">
                                                                    {{ translate('show_password')}}
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <button class="btn btn--primary btn-block" type="submit">
                                                        {{ translate('sign_up')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <br>
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-secondary btn-block" href="{{route('shop-cart')}}">
                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'right' : 'left'}} mt-sm-0 mx-1"></i>
                            <span
                                class="d-none d-sm-inline">{{ translate('back_to_cart')}} </span>
                            <span class="d-inline d-sm-none">{{ translate('back')}}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        @if(auth('customer')->check())
                            <a class="btn btn--primary btn-block" href="{{route('shop-cart')}}">
                                <span class="d-none d-sm-inline">{{ translate('shop_cart')}}</span>
                                <span class="d-inline d-sm-none">{{ translate('next')}}</span>
                                <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left' : 'right'}} mt-sm-0 mx-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </section>

            @include('web-views.partials._order-summary')
        </div>
    </div>

    <span id="route-action-checkout-function" data-route="checkout-details"></span>
@endsection

@push('script')

    <script>
        $('#login-form').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('customer.auth.login')}}',
                dataType: 'json',
                data: $('#login-form').serialize(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    toastr.success(data.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    location.reload();
                },
                complete: function () {
                    $('#loading').hide();
                },
                error: function () {
                    toastr.error('{{ translate("credential_not_matched")}}!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        $('#sign-up-form').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('customer.auth.register')}}',
                dataType: 'json',
                data: $('#sign-up-form').serialize(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setInterval(function () {
                            location.href = data.url;
                        }, 2000);
                    }
                },
                complete: function () {
                    $('#loading').hide();
                },
                error: function () {
                    toastr.error('{{ translate("something_went_wrong")}}!', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>

@endpush
