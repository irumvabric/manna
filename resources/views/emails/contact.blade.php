<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Manna Initiative</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #0066A1;
            padding: 30px;
            text-align: left;
        }
        .logo-box {
            display: inline-block;
            background-color: #0066A1;
            padding: 10px 15px;
            border-top-right-radius: 15px;
            border: 2px solid #ffffff;
        }
        .logo-text {
            color: #ffffff;
            font-weight: bold;
            font-size: 24px;
            line-height: 1;
            margin: 0;
            letter-spacing: 1px;
        }
        .logo-subtext {
            color: #ffffff;
            font-size: 12px;
            margin-top: 2px;
            letter-spacing: 4px;
            text-transform: uppercase;
        }
        .content {
            padding: 40px 30px;
        }
        .footer {
            background-color: #f3f4f6;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        h1 {
            color: #0066A1;
            margin-top: 0;
            font-size: 24px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0066A1;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .message-box {
            background-color: #f0f7ff;
            border-left: 4px solid #0066A1;
            padding: 15px;
            margin: 20px 0;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-box">
                <div class="logo-text">MANNA</div>
                <div class="logo-subtext">INITIATIVE</div>
            </div>
        </div>
        <div class="content">
            <h1>Thank You for Reaching Out!</h1>
            <p>Dear {{ $data['name'] ?? 'Value Member' }},</p>
            <p>We've received your message and want to thank you for contacting <strong>Manna Initiative</strong>. Your interest in our work means the world to us.</p>
            
            <p>Our team is currently reviewing your inquiry and we will get back to you as soon as possible. We strive to respond to all messages within 24-48 hours.</p>
            
            <div class="message-box">
                "{{ $data['message'] ?? '...Inquiry received...' }}"
            </div>
            
            <p>In the meantime, feel free to visit our website to learn more about our ongoing projects and how we're making a difference together.</p>
            
            <a href="{{ config('app.url') }}" class="button">Visit Our Website</a>
            
            <p style="margin-top: 30px;">Warm regards,<br>
            <strong>The Manna Initiative Team</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Manna Initiative. All rights reserved.<br>
            Working together for a better future.
        </div>
    </div>
</body>
</html>