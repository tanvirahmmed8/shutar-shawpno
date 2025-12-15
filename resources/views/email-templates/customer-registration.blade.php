<!DOCTYPE html>
<?php
use Illuminate\Support\Facades\Session;
use App\Models\SocialMedia;
$companyPhone = getWebConfig(name: 'company_phone');
$companyEmail = getWebConfig(name: 'company_email');
$companyName = getWebConfig(name: 'company_name');
$companyLogo = getWebConfig(name: 'company_web_logo');
$lang = \App\Utils\Helpers::default_lang();
$direction = Session::get('direction');
?>
<html lang="{{ $lang }}" class="{{ $direction === 'rtl'?'active':'' }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Vendor_Registration') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap');

        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            line-height: 21px;
            color: #737883;
            background: #f7fbff;
            padding: 0;
            display: flex;align-items: center;justify-content: center;
            min-height: 100vh;
        }
        h1,h2,h3,h4,h5,h6 {
            color: #334257;
        }
        * {
            box-sizing: border-box
        }

        :root {
            --base: #006161
        }

        .main-table {
            width: 500px;
            background: #FFFFFF;
            margin: 0 auto;
            padding: 40px;
        }
        .main-table-td {
        }
        img {
            max-width: 100%;
        }
        .cmn-btn{
            background: var(--base);
            color: #fff;
            padding: 8px 20px;
            display: inline-block;
            text-decoration: none;
        }
        .mb-1 {
            margin-bottom: 5px;
        }
        .mb-2 {
            margin-bottom: 10px;
        }
        .mb-3 {
            margin-bottom: 15px;
        }
        .mb-4 {
            margin-bottom: 20px;
        }
        .mb-5 {
            margin-bottom: 25px;
        }
        hr {
            border-color : rgba(0, 170, 109, 0.3);
            margin: 16px 0
        }
        .border-top {
            border-top: 1px solid rgba(0, 170, 109, 0.3);
            padding: 15px 0 10px;
            display: block;
        }
        .d-block {
            display: block;
        }
        .privacy {
            text-align: center;
            display: block;
        }
        .privacy a {
            text-decoration: none;
            color: #334257;
        }
        .privacy a span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #334257;
            display: inline-block;
            margin: 0 7px;
        }
        .social {
            margin: 15px 0 8px;
            display: block;
        }
        .copyright{
            text-align: center;
            display: block;
        }
        div {
            display: block;
        }
        a {
            text-decoration: none;
        }
        .text-base {
            color: var(--base);
            font-weight: 700
        }
        .mail-img-1 {
            width: 100%;
            height: 136px;
            object-fit: contain
        }
        .mail-img-2 {
            width: 100%;
            height: 45px;
            object-fit: contain
        }
        .mail-img-3 {
            width: 100%;
            height: 172px;
            object-fit: cover
        }
        .social img {
            width: 24px;
        }
        .text-center{
            text-align: center;
        }
        .fashion-welcome-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
            margin: 0 auto;
        }

        .fashion-welcome-header {
            background: linear-gradient(135deg, #dc267f 0%, #e91e63 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .fashion-welcome-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .fashion-welcome-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 10px 0;
            color: white;
        }

        .fashion-welcome-subtitle {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }

        .fashion-welcome-body {
            padding: 40px 30px;
        }

        .fashion-greeting {
            font-size: 18px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 20px;
        }

        .fashion-message {
            color: #6b7280;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .fashion-cta-container {
            text-align: center;
            margin: 40px 0;
        }

        .fashion-cta-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #dc267f 0%, #e91e63 100%);
            color: white !important;
            padding: 15px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(220, 38, 127, 0.4);
        }

        .fashion-cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 127, 0.6);
        }

        .fashion-website-link {
            color: #dc267f;
            text-decoration: none;
            font-weight: 500;
        }

        .fashion-website-link:hover {
            text-decoration: underline;
        }

        .fashion-divider {
            border: none;
            height: 1px;
            background: linear-gradient(90deg, transparent, #dc267f, transparent);
            margin: 30px 0;
        }

        .fashion-support-text {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .fashion-support-link {
            color: #dc267f;
            text-decoration: none;
            font-weight: 500;
        }

        .fashion-signature {
            color: #374151;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .fashion-company-name {
            color: #dc267f;
            font-weight: 600;
        }
    </style>

</head>

<body style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); padding: 20px; margin: 0; font-family: 'Roboto', sans-serif;">

<div class="fashion-welcome-container">
    <div class="fashion-welcome-header">
        <div class="fashion-welcome-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z" fill="white"/>
            </svg>
        </div>
        <h1 class="fashion-welcome-title">{{ $data['title'] }}</h1>
        <p class="fashion-welcome-subtitle">{{ translate('Welcome to') }} {{ $companyName }}</p>
    </div>

    <div class="fashion-welcome-body">
        <div class="fashion-greeting">{{ translate('Hi') }} {{ $data['name'] }},</div>

        <div class="fashion-message">{{ $data['message'] }}</div>

        @if(isset($data['resetRoute']))
        <div class="fashion-cta-container">
            <a href="{{ $data['resetRoute'] }}" target="_blank" class="fashion-cta-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1L13.5 2.5L16.17 5.17C14.24 4.42 12.12 4.64 10.39 5.86L12 7.47L21 9ZM1 9L3 7.47L4.61 5.86C2.88 4.64 0.76 4.42 -1.17 5.17L1.5 2.5L0 1L-6 7V9H1Z" fill="white"/>
                </svg>
                {{ translate('reset_Password') }}
            </a>
        </div>
        @endif

        <div class="fashion-message">
            {{ translate('meanwhile_click_here_to_visit_') }}{{ $companyName }}{{ translate('_website') }}.
            <br><br>
            <a href="{{ route('home') }}" target="_blank" class="fashion-website-link">{{ url('/') }}</a>
        </div>

        <hr class="fashion-divider">

        <div class="fashion-support-text">
            {{ translate('please_') }}
            <a href="{{ route('contacts') }}" target="_blank" class="fashion-support-link">{{ translate('_contact_us') }}</a>
            {{ translate('_for_any_queries') }}, {{ translate('_we_are_always_happy_to_help') }}.
        </div>

        <div class="fashion-signature">{{ translate('Thanks_&_Regards') }},</div>
        <div class="fashion-company-name">{{ $companyName }}</div>
    </div>
    <tr>
        <td>
            <img class="mail-img-2"
                 src="{{ getValidImage(path: "storage/app/public/company/".$companyLogo, type:'backend-logo') }}"
                 id="logoViewer" alt="">
            <span class="privacy">
                    <a href="{{route('privacy-policy') }}" target="_blank"
                       id="privacy-check">{{ translate('Privacy_Policy') }}</a>
                    <a href="{{route('contacts') }}" target="_blank" id="contact-check"><span class="dot"></span>{{ translate('Contact_Us') }}</a>
                </span>
            <span class="social" style="text-align:center">
                    @php($social_media = SocialMedia::where('active_status', 1)->get())
                @if ($social_media)
                    @foreach ($social_media as $social)
                        <a href="{{ $social->link }}" target=”_blank” style="margin: 0 5px;text-decoration:none;">
                                <img src="{{dynamicAsset(path: 'public/assets/back-end/img/'.$social->name.'.png') }}"
                                     width="16" alt="">
                            </a>
                    @endforeach
                @endif
                </span>
            <span class="copyright">
                   {{ translate('All_copy_right_reserved').','.date('Y').' '.$companyName }}
                </span>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>
