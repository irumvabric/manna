<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry Received</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f3f4f6; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .header { background-color: #0066A1; padding: 20px 30px; text-align: left; }
        .logo-box { display: inline-block; background-color: #0066A1; padding: 5px 10px; border-top-right-radius: 10px; border: 1px solid #ffffff; }
        .logo-text { color: #ffffff; font-weight: bold; font-size: 18px; line-height: 1; margin: 0; }
        .logo-subtext { color: #ffffff; font-size: 10px; margin-top: 1px; letter-spacing: 2px; text-transform: uppercase; }
        .content { padding: 30px; }
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; }
        h1 { color: #0066A1; margin-top: 0; font-size: 20px; border-bottom: 2px solid #0066A1; padding-bottom: 10px; }
        .data-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        .data-table th { color: #6b7280; font-weight: 600; width: 30%; font-size: 13px; text-transform: uppercase; }
        .message-content { background-color: #fcfcfc; border: 1px solid #e5e7eb; padding: 15px; border-radius: 4px; margin-top: 10px; white-space: pre-line; }
        .button { display: inline-block; padding: 12px 24px; background-color: #0066A1; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 25px; text-align: center; width: calc(100% - 48px); }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; background-color: #e0f2fe; color: #0369a1; }
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
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1>New Contact Inquiry</h1>
                <span class="badge">Inquiry</span>
            </div>
            
            <p>A new contact form submission has been received through the website. Here are the details:</p>
            
            <table class="data-table">
                <tr>
                    <th>Submitted By</th>
                    <td><strong>{{ $data['name'] ?? 'N/A' }}</strong></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $data['email'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ date('M d, Y H:i') }}</td>
                </tr>
            </table>
            
            <div style="font-weight: 600; color: #6b7280; font-size: 13px; text-transform: uppercase;">Message:</div>
            <div class="message-content">
                {{ $data['message'] ?? 'No message content provided.' }}
            </div>
            
            <a href="{{ url('/admin/dashboard') }}" class="button">View in Admin Panel</a>
        </div>
        <div class="footer">
            Admin Notification &bull; Manna Initiative System<br>
            Please do not reply directly to this automated email.
        </div>
    </div>
</body>
</html>
