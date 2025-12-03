<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লেনদেন রিপোর্ট</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 14px;
            color: #666;
        }
        .report-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        .report-info p {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #f0f9ff;
            border-left: 4px solid #2563eb;
        }
        .summary h3 {
            margin-bottom: 10px;
            color: #1e40af;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 11px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>লেনদেন রিপোর্ট</h1>
        <p>{{ config('app.name') }}</p>
        <p>রিপোর্ট তৈরির তারিখ: {{ date('d/m/Y') }}</p>
    </div>

    <div class="report-info">
        @if($month && $year)
            <p><strong>সময়কাল:</strong> {{ \App\Helpers\BanglaHelper::getBanglaMonth($month) }} {{ $year }}</p>
        @elseif($year)
            <p><strong>বছর:</strong> {{ $year }}</p>
        @endif
        <p><strong>মোট লেনদেন:</strong> {{ $transactions->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>সদস্য ID</th>
                <th>নাম</th>
                <th>মাস/বছর</th>
                <th>পরিমাণ</th>
                <th>পেমেন্ট মাধ্যম</th>
                <th>অবস্থা</th>
                <th>তারিখ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0;
                $approvedCount = 0;
                $pendingCount = 0;
                $rejectedCount = 0;
            @endphp
            @foreach($transactions as $transaction)
                @php
                    $totalAmount += $transaction->amount;
                    if($transaction->status === 'approved') $approvedCount++;
                    elseif($transaction->status === 'pending') $pendingCount++;
                    else $rejectedCount++;
                @endphp
                <tr>
                    <td>{{ $transaction->user->membership_id }}</td>
                    <td>{{ $transaction->user->name }}</td>
                    <td>{{ \App\Helpers\BanglaHelper::getBanglaMonth($transaction->month) }} {{ $transaction->year }}</td>
                    <td>৳{{ number_format($transaction->amount, 2) }}</td>
                    <td>{{ $transaction->paymentMethod->name }}</td>
                    <td>
                        @if($transaction->status === 'pending')
                            <span class="status status-pending">অপেক্ষমাণ</span>
                        @elseif($transaction->status === 'approved')
                            <span class="status status-approved">অনুমোদিত</span>
                        @else
                            <span class="status status-rejected">প্রত্যাখ্যাত</span>
                        @endif
                    </td>
                    <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <h3>সারসংক্ষেপ</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <span>মোট লেনদেন:</span>
                <strong>{{ $transactions->count() }}</strong>
            </div>
            <div class="summary-item">
                <span>মোট পরিমাণ:</span>
                <strong>৳{{ number_format($totalAmount, 2) }}</strong>
            </div>
            <div class="summary-item">
                <span>অনুমোদিত:</span>
                <strong>{{ $approvedCount }}</strong>
            </div>
            <div class="summary-item">
                <span>অপেক্ষমাণ:</span>
                <strong>{{ $pendingCount }}</strong>
            </div>
            <div class="summary-item">
                <span>প্রত্যাখ্যাত:</span>
                <strong>{{ $rejectedCount }}</strong>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>এই রিপোর্টটি স্বয়ংক্রিয়ভাবে তৈরি করা হয়েছে - {{ config('app.name') }}</p>
    </div>
</body>
</html>
