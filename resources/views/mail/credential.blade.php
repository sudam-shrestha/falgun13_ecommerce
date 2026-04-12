<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dokan Account is Approved</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f1eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg, #1e3a5f, #2b5a7a);
            color: white;
            padding: 45px 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .header p {
            margin: 12px 0 0;
            font-size: 17px;
            opacity: 0.95;
        }

        .content {
            padding: 40px 35px;
            background-color: #ffffff;
        }

        .welcome {
            font-size: 22px;
            color: #1a1e24;
            margin-bottom: 25px;
            text-align: center;
        }

        .credential-box {
            background-color: #faf8f5;
            border: 2px solid #e0dbd2;
            border-radius: 12px;
            padding: 28px;
            margin: 25px 0;
        }

        .credential-item {
            margin-bottom: 20px;
        }

        .credential-label {
            font-size: 14px;
            color: #3e4756;
            font-weight: 600;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .credential-value {
            font-size: 18px;
            color: #1a1e24;
            background-color: #ffffff;
            padding: 14px 18px;
            border-radius: 8px;
            border: 1px solid #e0dbd2;
            font-family: monospace;
            word-break: break-all;
        }

        .password {
            background-color: #f8f1e3;
            border-color: #c28b4e;
            color: #1e3a5f;
            font-weight: 600;
        }

        .note {
            background-color: #fffaf0;
            border-left: 5px solid #c28b4e;
            padding: 18px 20px;
            margin: 25px 0;
            border-radius: 8px;
            color: #3e4756;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            background-color: #c28b4e;
            color: white;
            padding: 15px 32px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            margin: 10px 0;
        }

        .footer {
            background-color: #f8f5f0;
            padding: 35px 30px;
            text-align: center;
            color: #3e4756;
            font-size: 14px;
            border-top: 1px solid #e0dbd2;
        }

        .icon {
            font-size: 52px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <!-- Header -->
        <div class="header">
            <div class="icon">✅</div>
            <h1>Congratulations!</h1>
            <p>Your Dokan has been approved</p>
        </div>

        <!-- Content -->
        <div class="content">

            <div class="welcome">
                Welcome to <strong>SudamHub</strong>, {{ $data['name'] }}!
            </div>

            <p style="text-align: center; color: #3e4756; font-size: 16px; margin-bottom: 30px;">
                Your vendor account is now active. Here are your login credentials:
            </p>

            <!-- Credentials Box -->
            <div class="credential-box">

                <div class="credential-item">
                    <div class="credential-label">Email Address</div>
                    <div class="credential-value">{{ $data['email'] }}</div>
                </div>

                <div class="credential-item">
                    <div class="credential-label">Temporary Password</div>
                    <div class="credential-value password">{{ $password }}</div>
                </div>

            </div>

            <div class="note">
                <strong>Important:</strong><br>
                We recommend you change your password immediately after your first login for security reasons.
            </div>

            <div style="text-align: center; margin: 35px 0;">
                <a href="{{ url('/dokan/login') }}" class="btn">
                    Login to Your Dokan Dashboard →
                </a>
            </div>

            <p style="text-align: center; color: #3e4756; line-height: 1.7;">
                If you have any questions or need assistance, feel free to contact our support team.
            </p>

        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>SudamHub E-commerce Platform</strong></p>
            <p>This is an automated email. Please do not reply to this address.</p>
            <p style="margin-top: 15px; font-size: 13px;">
                © {{ date('Y') }} SudamHub • Bhadrapur, Koshi, Nepal
            </p>
        </div>

    </div>
</body>

</html>
