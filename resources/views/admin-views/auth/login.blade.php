<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ translate($role) }} | {{ translate('login')}}</title>
    <link rel="shortcut icon" href="{{getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo')}}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/css/google-fonts.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset(path: 'public/site-assets/back-end/css/toastr.css') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        :root {
            --c1: {{ $web_config['primary_color'] }};
            --fashion-primary: #dc267f;
            --fashion-primary-dark: #be185d;
            --fashion-gray-50: #f9fafb;
            --fashion-gray-100: #f3f4f6;
            --fashion-gray-500: #6b7280;
            --fashion-gray-700: #374151;
            --fashion-gray-900: #111827;
            --fashion-white: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif !important;
        }

        .auth-wrapper {
            min-height: 100vh;
            display: flex;
        }

        .auth-wrapper-left {
            background: linear-gradient(135deg, var(--fashion-primary) 0%, var(--fashion-primary-dark) 100%) !important;
            position: relative;
            overflow: hidden;
        }

        .auth-wrapper-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .auth-left-cont {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
        }

        .auth-left-cont img {
            filter: brightness(0) invert(1);
            max-width: 280px;
            margin-bottom: 40px;
        }

        .auth-left-cont .title {
            color: var(--fashion-white);
            font-size: 32px;
            font-weight: 600;
            line-height: 1.2;
            margin: 0;
        }

        .auth-left-cont .title span {
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-wrapper-right {
            background: var(--fashion-gray-50);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
        }

        .auth-wrapper-form {
            background: var(--fashion-white);
            padding: 60px 50px;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 480px;
        }

        .display-4 {
            color: var(--fashion-gray-900);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .h4 {
            color: var(--fashion-gray-500);
            font-size: 1rem;
            font-weight: 400;
            margin-bottom: 40px;
        }

        .input-label {
            color: var(--fashion-gray-700);
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--fashion-primary);
            box-shadow: 0 0 0 3px rgba(220, 38, 127, 0.1);
            outline: none;
        }

        .form-control-lg {
            padding: 14px 18px;
            font-size: 16px;
        }

        .input-group-text {
            background: transparent;
            border: 2px solid #e5e7eb;
            border-left: none;
            border-radius: 0 12px 12px 0;
        }

        .custom-control-label::before {
            border-radius: 6px;
            border: 2px solid #d1d5db;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: var(--fashion-primary);
            border-color: var(--fashion-primary);
        }

        .btn--primary {
            background: linear-gradient(135deg, var(--fashion-primary) 0%, var(--fashion-primary-dark) 100%);
            border: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(220, 38, 127, 0.4);
        }

        .btn--primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 127, 0.6);
        }

        .badge-soft-success {
            background: rgba(34, 197, 94, 0.1);
            color: rgb(34, 197, 94);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .card-footer {
            background: var(--fashion-gray-50);
            border-radius: 12px;
            padding: 20px;
            margin-top: 30px;
            border: 1px solid #e5e7eb;
        }

        .card-footer span {
            font-size: 14px;
            color: var(--fashion-gray-700);
        }

        #copyLoginInfo {
            background: var(--fashion-primary);
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            color: white;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                flex-direction: column;
            }

            .auth-wrapper-left {
                min-height: 300px;
            }

            .auth-wrapper-form {
                padding: 40px 30px;
                margin: 20px;
            }

            .display-4 {
                font-size: 2rem;
            }
        }
    </style>

</head>

<body>
<main id="content" role="main" class="main">
    <div class="auth-wrapper">
        <div class="auth-wrapper-left" style="background: url('{{dynamicAsset('/public/site-assets/back-end/img/login-bg.png')}}') no-repeat center center / cover">
            <div class="auth-left-cont user-select-none">
                @php($eCommerceLogo = getWebConfig(name: 'company_web_logo'))
                <a class="d-inline-flex mb-5" href="{{ route('home') }}">
                    <img width="310" src="{{ getStorageImages(path: $eCommerceLogo, type:'backend-logo') }}" alt="Logo">
                </a>
                <h2 class="title">{{translate('Make Your Business')}} <span class="font-weight-bold c1 d-block text-capitalize">{{translate('Profitable...')}}</span></h2>
            </div>
        </div>
        <div class="auth-wrapper-right">
            @if(SOFTWARE_VERSION)
                <label class="badge badge-soft-success float-right __inline-2 user-select-none">
                    {{translate('software_version')}} : {{ SOFTWARE_VERSION }}
                </label>
            @endif
            <div class="auth-wrapper-form">
                <form id="form-id" action="{{route('login')}}" method="post" id="admin-login-form">
                    @csrf
                    <div>
                        <div class="mb-5 user-select-none">
                            <h1 class="display-4">{{translate('sign_in')}}</h1>
                            <h1 class="h4 text-gray-900 mb-4">
                                {{translate('welcome_back_to')}} {{ translate($role) }} {{translate('Login')}}
                            </h1>
                        </div>
                    </div>

                    <input type="hidden" class="form-control mb-3" name="role" id="role" value="{{ $role }}">

                    <div class="js-form-message form-group">
                        <label class="input-label user-select-none" for="signingAdminEmail">
                            {{ translate('your_email') }}
                        </label>

                        <input type="email" class="form-control form-control-lg" name="email" id="signingAdminEmail"
                                tabindex="1" placeholder="email@address.com" aria-label="email@address.com"
                                required data-msg="Please enter a valid email address.">
                    </div>
                    <div class="js-form-message form-group">
                        <label class="input-label user-select-none" for="signingAdminPassword" tabindex="0">
                            <span class="d-flex justify-content-between align-items-center">
                                {{translate('password')}}
                            </span>
                        </label>

                        <div class="input-group input-group-merge">
                            <input type="password" class="js-toggle-password form-control form-control-lg"
                                    name="password" id="signingAdminPassword"
                                    placeholder="{{ translate('8+_characters_required') }}"
                                    aria-label="8+ characters required" required
                                    data-msg="Your password is invalid. Please try again."
                                    data-hs-toggle-password-options='{
                                                "target": "#changePassTarget",
                                    "defaultClass": "tio-hidden-outlined",
                                    "showClass": "tio-visible-outlined",
                                    "classChangeTarget": "#changePassIcon"
                                    }'>
                            <div id="changePassTarget" class="input-group-append">
                                <a class="input-group-text" href="javascript:">
                                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                                    name="remember">
                            <label class="custom-control-label text-muted user-select-none" for="termsCheckbox">
                                {{translate('remember_me')}}
                            </label>
                        </div>
                    </div>
                    @if(isset($recaptcha) && $recaptcha['status'] == 1)
                        <div id="recaptcha_element" class="w-100;" data-type="image"></div>
                        <br/>
                    @else
                        <div class="row p-2">
                            <div class="col-6 pr-0">
                                <input type="text" class="form-control form-control-lg form-control-focus-none"
                                        id="admin-login-recaptcha-input"
                                        name="default_captcha_value" value="" required
                                        placeholder="{{translate('enter_captcha_value')}}">
                            </div>
                            <div class="col-6 input-icons bg-white rounded">
                                <a class="get-login-recaptcha-verify cursor-pointer get-session-recaptcha-auto-fill user-select-none"
                                    data-link="{{ URL('login/recaptcha/') }}"
                                    data-session="{{ 'adminRecaptchaSessionKey' }}"
                                    data-input="#admin-login-recaptcha-input"
                                >
                                    <img src="{{ URL('login/recaptcha/'.rand().'?captcha_session_id=default_recaptcha_id_'.$role.'_login') }}"
                                            class="input-field w-90 h-75 p-0 rounded" id="default_recaptcha_id" alt="">
                                    <i class="tio-refresh icon"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-lg btn-block btn--primary">
                        {{ translate('sign_in')}}
                    </button>
                </form>
                @if(env('APP_MODE')=='demo')
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-10">
                                <span id="admin-email" data-email="{{ \App\Enums\DemoConstant::ADMIN['email'] }}">{{translate('email')}} : {{ \App\Enums\DemoConstant::ADMIN['email'] }}</span><br>
                                <span id="admin-password" data-password="{{ \App\Enums\DemoConstant::ADMIN['password'] }}">{{translate('password')}} : {{ \App\Enums\DemoConstant::ADMIN['password'] }}</span>
                            </div>
                            <div class="col-2">
                                <button class="btn btn--primary" id="copyLoginInfo"><i class="tio-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>

<span id="message-please-check-recaptcha" data-text="{{ translate('please_check_the_recaptcha') }}"></span>
<span id="message-copied_success" data-text="{{ translate('copied_successfully') }}"></span>
<span id="route-get-session-recaptcha-code"
      data-route="{{ route('get-session-recaptcha-code') }}"
      data-mode="{{ env('APP_MODE') }}"
></span>

<script src="{{dynamicAsset(path: 'public/site-assets/back-end/js/vendor.min.js')}}"></script>

<script src="{{dynamicAsset(path: 'public/site-assets/back-end/js/theme.min.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/site-assets/back-end/js/toastr.js')}}"></script>
<script src="{{dynamicAsset(path: 'public/site-assets/back-end/js/admin/login.js')}}"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        "use strict";
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
@if(isset($recaptcha) && $recaptcha['status'] == 1)
    <script type="text/javascript">
        "use strict";
        var onloadCallback = function () {
            grecaptcha.render('recaptcha_element', {
                'sitekey': '{{ getWebConfig(name: 'recaptcha')['site_key'] }}'
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endif

</body>
</html>

