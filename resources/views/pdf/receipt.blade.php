<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { max-width: 100px; margin-bottom: 10px; }
        .title { font-size: 24px; font-weight: bold; }
        .info { margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <!-- <img src="{{ public_path('logo.png') }}" class="logo"> -->
        <div class="title">{{ config('app.name') }}</div>
        <div>Payment Receipt</div>
    </div>

    <div class="info">
        <strong>Receipt #:</strong> {{ $payment->transaction_id }}<br>
        <strong>Date:</strong> {{ $payment->created_at->format('d M, Y') }}<br>
        <strong>Member:</strong> {{ $payment->user->name }} ({{ $payment->user->phone }})
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Monthly Fee - {{ $payment->month_year->format('F Y') }}</td>
                <td>৳{{ number_format($payment->amount, 2) }}</td>
            </tr>
            <tr>
                <td style="text-align: right;"><strong>Total</strong></td>
                <td><strong>৳{{ number_format($payment->amount, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="info">
        <strong>Payment Method:</strong> {{ $payment->method }}<br>
        <strong>Status:</strong> {{ ucfirst($payment->status) }}
    </div>

    <div class="footer">
        This is a computer-generated receipt and does not require a signature.<br>
        Generated on {{ now()->format('d M, Y h:i A') }}
    </div>
</body>
</html>
