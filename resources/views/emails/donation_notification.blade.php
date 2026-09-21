<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Donation Received!</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f3f4f6; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .header { background-color: #0066A1; padding: 20px 30px; text-align: left; }
        .logo-box { display: inline-block; background-color: #0066A1; padding: 5px 10px; border-top-right-radius: 10px; border: 1px solid #ffffff; }
        .logo-text { color: #ffffff; font-weight: bold; font-size: 18px; line-height: 1; margin: 0; }
        .logo-subtext { color: #ffffff; font-size: 10px; margin-top: 1px; letter-spacing: 2px; text-transform: uppercase; }
        .content { padding: 30px; }
        .footer { background-color: #f9fafb; padding: 20px; text-align: center; font-size: 12px; color: #6b7280; border-top: 1px solid #e5e7eb; }
        .celebration { text-align: center; margin-bottom: 30px; }
        .celebration h1 { color: #0066A1; margin-bottom: 5px; font-size: 26px; }
        .amount-card { background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 20px; text-align: center; margin: 20px 0; }
        .amount-value { font-size: 32px; font-weight: 800; color: #166534; }
        .amount-label { font-size: 14px; color: #166534; text-transform: uppercase; letter-spacing: 1px; }
        .data-table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        .data-table th, .data-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        .data-table th { color: #6b7280; font-weight: 600; width: 35%; font-size: 13px; text-transform: uppercase; }
        .button { display: inline-block; padding: 12px 24px; background-color: #0066A1; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 25px; text-align: center; width: calc(100% - 48px); }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; background-color: #f0fdf4; color: #166534; }
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
            <div class="celebration">
                <span class="badge">Great News!</span>
                <h1>New Donation Received</h1>
                <p>A new contribution has been pledged to Initiative Manna.</p>
            </div>
            
            <div class="amount-card">
                <div class="amount-label">Donation Amount</div>
                <div class="amount-value">{{ number_format($data['target_amount'] ?? 0, 2) }} {{ $data['currency'] ?? 'BIF' }}</div>
                <div style="font-size: 13px; color: #15803d; margin-top: 5px;">{{ ucfirst($data['periodicity'] ?? 'one_time') }} Frequency</div>
            </div>
            
            <table class="data-table">
                <tr>
                    <th>Donor Name</th>
                    <td><strong>{{ $data['name'] ?? 'Anonymous' }}</strong></td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td>{{ $data['email'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td>{{ $data['phone'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date Received</th>
                    <td>{{ date('M d, Y H:i') }}</td>
                </tr>
            </table>
            
            <a href="{{ url('/admin/donators') }}" class="button">Manage Donors</a>
        </div>
        <div class="footer">
            Financial Notification &bull; Initiative Manna System<br>
            Together, we are making a lasting impact.
        </div>
    </div>
</body>
</html>
