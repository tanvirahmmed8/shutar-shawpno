<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ translate('Order_Placed') }}</title>
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

        .fashion-order-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
        }

        .fashion-order-header {
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

        .fashion-order-icon {
            width: 80px;
            height: 80px;
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

        .fashion-order-body {
            padding: 40px 30px;
            text-align: center;
        }

        .fashion-order-message {
            color: #374151;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .fashion-order-status {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .fashion-order-id-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px solid #dc267f;
            border-radius: 12px;
            padding: 30px 20px;
            margin: 30px 0;
        }

        .fashion-order-id-label {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fashion-order-id {
            color: #dc267f;
            font-size: 32px;
            font-weight: 700;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
            margin: 0;
        }

        .fashion-cta-container {
            margin: 30px 0;
        }

        .fashion-track-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #dc267f 0%, #e91e63 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(220, 38, 127, 0.4);
        }

        .fashion-track-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 127, 0.6);
        }

        .fashion-support-text {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
            margin-top: 30px;
        }

        .fashion-order-footer {
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
            .fashion-order-container {
                margin: 10px;
                border-radius: 12px;
            }

            .fashion-order-header,
            .fashion-order-body {
                padding: 30px 20px;
            }

            .fashion-header-title {
                font-size: 24px;
            }

            .fashion-order-id {
                font-size: 24px;
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

<div class="fashion-order-container">
    <div class="fashion-order-header">
        <div class="fashion-brand-wrapper">
            <img src="{{ getStorageImages(path: $companyLogo, type: 'backend-logo') }}"
                 alt="{{ $companyName }}" class="fashion-logo">
            <div class="fashion-brand-name">{{ $companyName }}</div>
        </div>

        <div class="fashion-order-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 18C5.9 18 5.01 18.9 5.01 20S5.9 22 7 22S9 21.1 9 20S8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.25 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.28 15 7.17 14.89 7.17 14.75L7.2 14.63L8.1 13H15.55C16.3 13 16.96 12.59 17.3 11.97L20.88 5H5.21L4.27 3H1ZM17 18C15.9 18 15.01 18.9 15.01 20S15.9 22 17 22S19 21.1 19 20S18.1 18 17 18Z" fill="white"/>
            </svg>
        </div>

        <h1 class="fashion-header-title">{{ translate('Order Confirmed!') }}</h1>
    </div>

    <div class="fashion-order-body">
        <div class="fashion-order-message">
            <strong>{{ translate('Notification mail for order placed') }}</strong>
        </div>

        <div class="fashion-order-status">
            {{ translate('We have sent you this email in response to your order placed. You will be able to see your order status after login to your account') }}.
        </div>

        <div class="fashion-order-id-section">
            <div class="fashion-order-id-label">{{ translate('Your_order_ID') }}</div>
            <div class="fashion-order-id">{{ $id }}</div>
        </div>

        <div class="fashion-cta-container">
            <a href="{{ route('account-oder') }}" class="fashion-track-button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3 7L12 12L21 7L12 2Z" fill="white"/>
                    <path d="M3 17L12 22L21 17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 12L12 17L21 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ translate('Track Your Order') }}
            </a>
        </div>

        <div class="fashion-support-text">
            {{ translate('If you need help, or you have any other questions, feel free to email us') }}.
            <br><strong>{{ translate('From') }} {{ $companyName }}</strong>
        </div>
    </div>

    <div class="fashion-order-footer">
        <div class="fashion-footer-brand">
            © {{ date('Y') }} {{ $companyName }}. {{ translate('All rights reserved') }}.
        </div>
    </div>
</div>

</body>
</html>

