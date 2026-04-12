<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Dokan Registration Request</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f1eb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        a{
            color: white;
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
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 35px;
            background-color: #ffffff;
        }

        .info-card {
            background-color: #faf8f5;
            border: 1px solid #faf8f5;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .info-row {
            display: flex;
            margin-bottom: 18px;
        }

        .info-label {
            width: 140px;
            font-weight: 600;
            color: #3e4756;
            font-size: 15px;
        }

        .info-value {
            flex: 1;
            color: #1a1e24;
            font-size: 16px;
            font-weight: 500;
        }

        .accent-badge {
            display: inline-block;
            background-color: #1a1e24;
            color: #c28b4e;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
        }

        .footer {
            background-color: #f8f5f0;
            padding: 30px;
            text-align: center;
            color: #3e4756;
            font-size: 14px;
            border-top: 1px solid #faf8f5;
        }

        .btn {
            display: inline-block;
            background-color: #c28b4e;
            color: white;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            margin-top: 20px;
            transition: all 0.3s;
        }

        .btn:hover {
            background-color: #b07a3f;
        }

        .icon {
            font-size: 50px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="email-container">

        <!-- Header -->
        <div class="header">
            <div class="icon">🛍️</div>
            <h1>New Dokan Registration</h1>
            <p>A new vendor has requested to join your platform</p>
        </div>

        <!-- Content -->
        <div class="content">

            <div class="info-card">
                <div class="info-row">
                    <div class="info-label">Vendor Name</div>
                    <div class="info-value">{{ $dokan->name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email Address</div>
                    <div class="info-value">{{ $dokan->email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Contact Number</div>
                    <div class="info-value">{{ $dokan->contact_no }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Submitted On</div>
                    <div class="info-value">{{ $dokan->created_at->format('d F, Y \a\t h:i A') }}</div>
                </div>
            </div>

            <div class="info-card">
                <div style="margin-bottom: 12px; font-weight: 600; color: #3e4756;">Message from Vendor:</div>
                <p style="margin: 0; line-height: 1.7; color: #1a1e24;">
                    "{{ $dokan->message }}"
                </p>
            </div>

            <div style="text-align: center;">
                <a href="{{ url('/admin/dokans') }}" class="btn">
                    Review Dokan Request →
                </a>
            </div>

            <div style="margin-top: 35px; text-align: center;">
                <span class="accent-badge">New Registration Request</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>SudamHub</strong> • E-commerce Platform</p>
            <p>This email was sent automatically when a new dokan requested registration.</p>
            <p style="margin-top: 15px; font-size: 12px;">
                © {{ date('Y') }} SudamHub. All rights reserved.
            </p>
        </div>
    </div>
</body>

</html>
