<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ translate('Password Reset') }}</title>
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

        .fashion-reset-container {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }

        .fashion-reset-header {
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

        .fashion-reset-icon {
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

        .fashion-reset-body {
            padding: 40px 30px;
            text-align: center;
        }

        .fashion-reset-message {
            color: #374151;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .fashion-security-note {
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 30px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 12px;
            border-left: 4px solid #dc267f;
        }

        .fashion-reset-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #dc267f 0%, #e91e63 100%);
            color: white !important;
            padding: 16px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(220, 38, 127, 0.4);
            margin-bottom: 30px;
        }

        .fashion-reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(220, 38, 127, 0.6);
            text-decoration: none;
            color: white !important;
        }

        .fashion-support-text {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }

        .fashion-reset-footer {
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
            .fashion-reset-container {
                margin: 10px;
                border-radius: 12px;
            }

            .fashion-reset-header,
            .fashion-reset-body {
                padding: 30px 20px;
            }

            .fashion-header-title {
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

<div class="fashion-reset-container">
    <div class="fashion-reset-header">
        <div class="fashion-brand-wrapper">
            <img src="{{ getStorageImages(path: $companyLogo, type: 'backend-logo') }}"
                 alt="{{ $companyName }}" class="fashion-logo">
            <div class="fashion-brand-name">{{ $companyName }}</div>
        </div>

        <div class="fashion-reset-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8V10H5C4.46957 10 3.96086 10.2107 3.58579 10.5858C3.21071 10.9609 3 11.4696 3 12V20C3 20.5304 3.21071 21.0391 3.58579 21.4142C3.96086 21.7893 4.46957 22 5 22H19C19.5304 22 20.0391 21.7893 20.4142 21.4142C20.7893 21.0391 21 20.5304 21 20V12C21 11.4696 20.7893 10.9609 20.4142 10.5858C20.0391 10.2107 19.5304 10 19 10H18V8ZM8 8C8 6.93913 8.42143 5.92172 9.17157 5.17157C9.92172 4.42143 10.9391 4 12 4C13.0609 4 14.0783 4.42143 14.8284 5.17157C15.5786 5.92172 16 6.93913 16 8V10H8V8Z" fill="white"/>
            </svg>
        </div>

        <h1 class="fashion-header-title">{{ translate('Reset Your password') }}</h1>
    </div>

    <div class="fashion-reset-body">
        <div class="fashion-reset-message">
            {{ translate('You have requested to reset your admin password. Click the button below to create a new password') }}.
        </div>

        <div class="fashion-security-note">
            <strong>{{ translate('Security Notice') }}:</strong> {{ translate('This link will expire in 60 minutes for security reasons. If you did not request this reset, please ignore this email') }}.
        </div>

        <a href="{{ $url }}" class="fashion-reset-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 12H9M12 9V15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ translate('Reset Password Now') }}
        </a>

        <div class="fashion-support-text">
            {{ translate('If you are having trouble clicking the button, copy and paste the URL below into your web browser') }}:
            <br><br>
            <span style="word-break: break-all; color: #dc267f;">{{ $url }}</span>
        </div>
    </div>

    <div class="fashion-reset-footer">
        <div class="fashion-footer-brand">
            © {{ date('Y') }} {{ $companyName }} {{ translate('Admin Panel') }}. {{ translate('All rights reserved') }}.
        </div>
    </div>
</div>

</body>
</html>

