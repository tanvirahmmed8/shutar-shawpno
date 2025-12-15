<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ translate('Email Verification') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .fashion-email-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .fashion-email-header {
            background: linear-gradient(135deg, #dc267f 0%, #e91e63 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .fashion-brand-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .fashion-logo {
            height: 50px;
            width: auto;
            filter: brightness(0) invert(1);
        }

        .fashion-brand-name {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .fashion-email-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .fashion-header-title {
            color: #ffffff;
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }

        .fashion-email-body {
            padding: 40px 30px;
            text-align: center;
        }

        .fashion-verification-message {
            color: #374151;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .fashion-token-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px dashed #dc267f;
            border-radius: 12px;
            padding: 30px 20px;
            margin: 30px 0;
        }

        .fashion-token-label {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fashion-token-code {
            color: #dc267f;
            font-size: 36px;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            margin: 0;
        }

        .fashion-footer-text {
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.5;
        }

        .fashion-email-footer {
            background: #f9fafb;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .fashion-footer-brand {
            color: #6b7280;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .fashion-email-container {
                margin: 10px;
                border-radius: 12px;
            }

            .fashion-email-header,
            .fashion-email-body {
                padding: 30px 20px;
            }

            .fashion-header-title {
                font-size: 24px;
            }

            .fashion-token-code {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
<?php
$companyPhone = getWebConfig(name: 'company_phone');
$companyEmail = getWebConfig(name: 'company_email');
$companyName = getWebConfig(name: 'company_name');
$companyLogo = getWebConfig(name: 'company_web_logo');
?>

<div class="fashion-email-container">
    <div class="fashion-email-header">
        <div class="fashion-brand-wrapper">
            <img src="{{ getStorageImages(path: $companyLogo, type: 'backend-logo') }}"
                 alt="{{ $companyName }}" class="fashion-logo">
            <div class="fashion-brand-name">{{ $companyName }}</div>
        </div>

        <div class="fashion-email-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 15L5.5 9L6.91 7.59L12 12.17L17.09 7.59L18.5 9L12 15Z" fill="white"/>
                <path d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z" fill="white"/>
            </svg>
        </div>

        <h1 class="fashion-header-title">{{ translate('Verify_your_email') }}</h1>
    </div>

    <div class="fashion-email-body">
        <p class="fashion-verification-message">
            {{ translate('Thank you for joining') }} {{ $companyName }}! {{ translate('Please use the verification code below to confirm your email address') }}.
        </p>

        <div class="fashion-token-container">
            <div class="fashion-token-label">{{ translate('Verification Code') }}</div>
            <div class="fashion-token-code">{{ $token }}</div>
        </div>

        <p class="fashion-footer-text">
            {{ translate('This code will expire in 10 minutes for security reasons') }}.
        </p>
    </div>

    <div class="fashion-email-footer">
        <div class="fashion-footer-brand">
            © {{ date('Y') }} {{ $companyName }}. {{ translate('All rights reserved') }}.
        </div>
    </div>
</div>

</body>
</html>


