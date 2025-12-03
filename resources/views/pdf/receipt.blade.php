<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>পেমেন্ট রসিদ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            padding: 30px;
        }
        .receipt-container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #2563eb;
            border-radius: 10px;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2563eb;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            color: #1e40af;
        }
        .header h2 {
            font-size: 20px;
            color: #059669;
            margin-top: 10px;
        }
        .receipt-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .receipt-info-row {
            display: table-row;
        }
        .receipt-info-label {
            display: table-cell;
            padding: 8px 0;
            font-weight: bold;
            width: 180px;
            color: #4b5563;
        }
        .receipt-info-value {
            display: table-cell;
            padding: 8px 0;
            color: #1f2937;
        }
        .member-section {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .member-section h3 {
            color: #1e40af;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .payment-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .payment-details th {
            background-color: #2563eb;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }
        .payment-details td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        .payment-details tr:last-child td {
            border-bottom: none;
        }
        .total-row {
            background-color: #f9fafb;
            font-weight: bold;
            font-size: 16px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 13px;
        }
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        .footer-note {
            background-color: #fef3c7;
            padding: 15px;
            border-left: 4px solid #f59e0b;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
        }
        .watermark {
            text-align: center;
            margin-top: 30px;
            color: #9ca3af;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="header">
            <h1>{{ config('app.name', 'প্রজন্ম উন্নয়ন মিশন') }}</h1>
            <h2>পেমেন্ট রসিদ</h2>
        </div>

        <div class="receipt-info">
            <div class="receipt-info-row">
                <div class="receipt-info-label">রসিদ নম্বর:</div>
                <div class="receipt-info-value">{{ $payment->transaction_id }}</div>
            </div>
            <div class="receipt-info-row">
                <div class="receipt-info-label">তারিখ:</div>
                <div class="receipt-info-value">{{ $payment->created_at->format('d/m/Y') }}</div>
            </div>
            <div class="receipt-info-row">
                <div class="receipt-info-label">অবস্থা:</div>
                <div class="receipt-info-value">
                    <span class="status-badge status-approved">অনুমোদিত</span>
                </div>
            </div>
        </div>

        <div class="member-section">
            <h3>সদস্য তথ্য</h3>
            <div class="receipt-info">
                <div class="receipt-info-row">
                    <div class="receipt-info-label">নাম:</div>
                    <div class="receipt-info-value">{{ $payment->user->name }}</div>
                </div>
                <div class="receipt-info-row">
                    <div class="receipt-info-label">সদস্যপদ নম্বর:</div>
                    <div class="receipt-info-value">{{ $payment->user->membership_id }}</div>
                </div>
                <div class="receipt-info-row">
                    <div class="receipt-info-label">ফোন:</div>
                    <div class="receipt-info-value">{{ $payment->user->phone }}</div>
                </div>
                <div class="receipt-info-row">
                    <div class="receipt-info-label">ঠিকানা:</div>
                    <div class="receipt-info-value">{{ $payment->user->address }}</div>
                </div>
            </div>
        </div>

        <table class="payment-details">
            <thead>
                <tr>
                    <th>বিবরণ</th>
                    <th style="text-align: right; width: 150px;">পরিমাণ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>মাসিক ফি</strong><br>
                        <span style="color: #6b7280;">{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }}</span>
                    </td>
                    <td style="text-align: right;">৳{{ number_format($payment->amount, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td style="text-align: right;">সর্বমোট:</td>
                    <td style="text-align: right; color: #059669; font-size: 18px;">৳{{ number_format($payment->amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="receipt-info" style="margin-bottom: 20px;">
            <div class="receipt-info-row">
                <div class="receipt-info-label">পেমেন্ট মাধ্যম:</div>
                <div class="receipt-info-value">{{ $payment->paymentMethod->name }}</div>
            </div>
            @if($payment->description)
            <div class="receipt-info-row">
                <div class="receipt-info-label">বিবরণ:</div>
                <div class="receipt-info-value">{{ $payment->description }}</div>
            </div>
            @endif
            @if($payment->admin_note)
            <div class="receipt-info-row">
                <div class="receipt-info-label">অ্যাডমিন নোট:</div>
                <div class="receipt-info-value">{{ $payment->admin_note }}</div>
            </div>
            @endif
        </div>

        <div class="footer-note">
            <strong>দ্রষ্টব্য:</strong> এই রসিদটি কম্পিউটার দ্বারা স্বয়ংক্রিয়ভাবে তৈরি করা হয়েছে এবং কোন স্বাক্ষর প্রয়োজন নেই।
        </div>

        <div class="footer">
            <p><strong>ধন্যবাদ আপনার পেমেন্টের জন্য!</strong></p>
            <p style="margin-top: 10px;">যোগাযোগ: {{ config('app.name', 'প্রজন্ম উন্নয়ন মিশন') }}</p>
        </div>

        <div class="watermark">
            রিপোর্ট তৈরির সময়: {{ now()->format('d/m/Y h:i A') }}
        </div>
    </div>
</body>
</html>
