<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Generosity!</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; background-color: #f9fafb; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
        .header { background-color: #0066A1; padding: 40px 30px; text-align: center; }
        .logo-box { display: inline-block; background-color: #0066A1; padding: 10px 15px; border-top-right-radius: 15px; border: 2px solid #ffffff; }
        .logo-text { color: #ffffff; font-weight: bold; font-size: 24px; line-height: 1; margin: 0; letter-spacing: 1px; }
        .logo-subtext { color: #ffffff; font-size: 12px; margin-top: 2px; letter-spacing: 4px; text-transform: uppercase; }
        .content { padding: 40px 35px; }
        .footer { background-color: #f3f4f6; padding: 25px; text-align: center; font-size: 12px; color: #6b7280; line-height: 1.8; }
        h1 { color: #0066A1; margin-top: 0; font-size: 28px; text-align: center; }
        .summary-card { background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 25px; margin: 30px 0; }
        .summary-title { font-weight: 700; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; text-align: center; }
        .amount-display { font-size: 36px; font-weight: 800; color: #0066A1; text-align: center; margin-bottom: 5px; }
        .frequency-tag { text-align: center; color: #64748b; font-size: 14px; }
        .thanks-message { font-size: 18px; color: #334155; line-height: 1.5; text-align: center; margin-bottom: 30px; }
        .impact-box { border-top: 1px solid #e2e8f0; padding-top: 25px; margin-top: 25px; }
        .impact-title { font-weight: 700; color: #0066A1; margin-bottom: 10px; }
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
            <h1>You're Making a Difference!</h1>
            
            <p class="thanks-message">Dear {{ $data['name'] ?? 'Donor' }}, we are deeply moved by your incredible generosity. Thank you for choosing to support Manna Initiative.</p>
            
            <div class="summary-card">
                <div class="summary-title">Donation Confirmation</div>
                <div class="amount-display">{{ number_format($data['target_amount'] ?? 0, 2) }} {{ $data['currency'] ?? 'BIF' }}</div>
                <div class="frequency-tag">{{ ucfirst($data['periodicity'] ?? 'one_time') }} Contribution</div>
            </div>
            
            <p>Your support allows us to continue our mission and reach more people in need. We've officially recorded your commitment, and it will be put to use where it's needed most.</p>
            
            <div class="impact-box">
                <div class="impact-title">Your Impact</div>
                <p style="font-size: 14px; color: #475569;">Every donation, regardless of size, helps us build sustainable solutions and provide essential support to our beneficiaries. We are honored to have you as part of our community.</p>
            </div>
            
            <p style="margin-top: 40px; text-align: center;">With heartfelt gratitude,<br>
            <strong style="font-size: 18px; color: #0066A1;">The Manna Initiative Team</strong></p>
        </div>
        <div class="footer">
            <strong>Manna Initiative</strong><br>
            Empowering communities through collective action.<br><br>
            &copy; {{ date('Y') }} Manna Initiative. All rights reserved.<br>
            <em>You received this email because you made a donation commitment on our website.</em>
        </div>
    </div>
</body>
</html>
