<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>পেমেন্ট রিসিপ্ট</title>
    <style>
        /* 'bangla' is the logical font name configured in config/dompdf.php */
        body { font-family: 'bangla', 'DejaVu Sans', sans-serif; font-size: 12px; line-height: 1.6; color: #333; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .header h1 { font-size: 20px; margin-bottom: 5px; }
        .header p { font-size: 12px; }
        .section { margin-bottom: 15px; }
        .section h3 { font-size: 14px; margin-bottom: 8px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 4px; }
        .label { font-weight: bold; }
        .footer { margin-top: 25px; text-align: center; font-size: 11px; color: #666; border-top: 1px solid #ddd; padding-top: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>পেমেন্ট রিসিপ্ট</h1>
        <p>{{ config('app.name') }}</p>
    </div>

    <div class="section">
        <h3>মৌলিক তথ্য</h3>
        <div class="row"><span class="label">সদস্য:</span> <span>{{ $payment->user->name }} ({{ $payment->user->membership_id }})</span></div>
        <div class="row"><span class="label">মাস/বছর:</span> <span>{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }}</span></div>
        <div class="row"><span class="label">পরিমাণ:</span> <span>৳{{ number_format($payment->amount, 2) }}</span></div>
        <div class="row"><span class="label">পেমেন্ট মাধ্যম:</span> <span>{{ optional($payment->paymentMethod)->name }}</span></div>
        <div class="row"><span class="label">ট্রানজেকশন আইডি:</span> <span>{{ $payment->transaction_id ?? '-' }}</span></div>
    </div>

    <div class="section">
        <h3>স্ট্যাটাস</h3>
        <div class="row"><span class="label">অবস্থা:</span> <span>অনুমোদিত</span></div>
        <div class="row"><span class="label">সাবমিটের তারিখ:</span> <span>{{ optional($payment->created_at)->format('d/m/Y H:i') }}</span></div>
        <div class="row"><span class="label">অনুমোদনের তারিখ:</span> <span>{{ optional($payment->processed_at)->format('d/m/Y H:i') }}</span></div>
        <div class="row"><span class="label">অনুমোদনকারী:</span> <span>{{ optional($payment->approver)->name ?? '-' }}</span></div>
    </div>

    @if ($payment->description)
        <div class="section">
            <h3>মেম্বারের নোট</h3>
            <p>{{ $payment->description }}</p>
        </div>
    @endif

    @if ($payment->admin_note)
        <div class="section">
            <h3>অ্যাডমিন নোট</h3>
            <p>{{ $payment->admin_note }}</p>
        </div>
    @endif

    <div class="footer">
        <p>এই রিসিপ্টটি সিস্টেম দ্বারা স্বয়ংক্রিয়ভাবে তৈরি করা হয়েছে।</p>
    </div>
</body>
</html>
