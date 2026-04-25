<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>পেমেন্ট রিসিপ্ট</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500,700);
        @page {
            margin: 0;
        }
        body {
            background: #ffffff;
            font-family: 'Roboto', 'solaimanlipi', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0;
            background: #fff;
            overflow: visible;
            min-height: 297mm;
            position: relative;
        }
        .section-title {
            color: #1976D2;
            font-size: 17px;
            font-weight: 500;
            margin: 0 0 8px 0;
        }
        .title-wrap {
            padding: 20px 24px;
            background: #f8f9fa;
            border-bottom: 2px solid #2196F3;
        }
        .table-reset { width: 100%; border-collapse: collapse; }
        .table-reset td { border: none; padding: 0; vertical-align: middle; }
        .logo-small {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            display: inline-block;
        }
        .logo-large, .avatar-large {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            display: inline-block;
        }
        .fallback-small, .fallback-large {
            color: #fff;
            text-align: center;
            font-weight: bold;
            display: inline-block;
            border-radius: 50%;
        }
        .fallback-small {
            width: 50px; height: 50px; line-height: 50px; font-size: 24px; background: #4CAF50;
        }
        .fallback-large {
            width: 70px; height: 70px; line-height: 70px; font-size: 28px; background: #2196F3;
        }
        .header-wrap {
            padding: 28px 30px;
            border-bottom: 1px solid #e5e7eb;
        }
        .content-wrap {
            padding: 30px;
            /* Keep room for footer block */
            padding-bottom: 110px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            border: 1px solid #e5e7eb;
        }
        .details-table th, .details-table td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            font-size: 14px;
        }
        .details-table th {
            background: #2196F3;
            color: #fff;
            text-align: left;
        }
        .details-table .amt { text-align: right; }
        .summary-table {
            width: 50%;
            margin-left: auto;
            border-collapse: collapse;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
        }
        .summary-table td {
            border: 1px solid #e5e7eb;
            padding: 8px 12px;
            font-size: 14px;
        }
        .summary-table .right { text-align: right; }
        .pay-meta {
            padding: 14px 0;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }
        .approver-wrap {
            margin-bottom: 10px;
        }
        .approver-block {
            width: 260px;
            text-align: left;
        }
        .approver-line {
            border-top: 1px solid #111827;
            width: 100%;
        }
        .footer-wrap {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 30;
            padding: 16px 30px;
            border-top: 2px solid #bfdbfe;
            background: #f8fafc;
        }
        .muted { color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    @php
        $memberService = app(\App\Services\MemberService::class);
        $paymentSummary = $memberService->calculateOutstandingDues($payment->user);
        $settingsService = app(\App\Services\SettingsService::class);
        $orgName = $settingsService->get('organization_name', config('app.name'));
        $orgLogo = $settingsService->get('organization_logo');
        $logoPath = $orgLogo ? storage_path('app/public/' . $orgLogo) : null;
        $orgEmail = $settingsService->get('organization_email');
        $orgPhone = $settingsService->get('organization_phone');
        $profilePic = $payment->user->profile_pic;
        $profilePath = $profilePic ? storage_path('app/public/' . $profilePic) : null;
    @endphp

    <div class="container">
        <div class="title-wrap">
            <table class="table-reset">
                <tr>
                    <td style="width: 60%;">
                        <table class="table-reset">
                            <tr>
                                <td style="width: 62px;">
                                    @if($logoPath && file_exists($logoPath))
                                        <img src="{{ $logoPath }}" class="logo-small" alt="Logo">
                                    @else
                                        <span class="fallback-small">প্র</span>
                                    @endif
                                </td>
                                <td>
                                    <p style="font-size: 24px; margin: 0; color: #1976D2; font-weight: 500;">পেইড পেমেন্ট রশিদ</p>
                                    <p class="muted" style="margin-top: 3px;">রিসিপ্ট #{{ $payment->id }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 40%; text-align: right;">
                        <p class="muted">ইস্যু তারিখ: {{ optional($payment->created_at)->format('d M, Y') }}</p>
                        <p class="muted" style="margin-top: 3px;">অনুমোদনের তারিখ: {{ optional($payment->processed_at)->format('d M, Y') ?? 'পেন্ডিং' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="header-wrap">
            <table class="table-reset">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <p class="section-title">পেমেন্ট প্রদানকারী</p>
                        <table class="table-reset">
                            <tr>
                                <td style="width: 82px;">
                                    @if($profilePath && file_exists($profilePath))
                                        <img src="{{ $profilePath }}" class="avatar-large" alt="Profile">
                                    @else
                                        <span class="fallback-large">{{ mb_substr($payment->user->name, 0, 1) }}</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">
                                    <p style="font-size: 20px; margin: 0 0 4px 0; color: #222;">{{ $payment->user->name }}</p>
                                    <p class="muted">Email: {{ $payment->user->email }}<br>Phone: {{ $payment->user->phone }}<br>সদস্য আইডি: {{ $payment->user->membership_id }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%; padding-left: 18px; vertical-align: top;">
                        <p class="section-title">পেমেন্ট গ্রহণকারী</p>
                        <table class="table-reset">
                            <tr>
                                <td style="width: 82px;">
                                    @if($logoPath && file_exists($logoPath))
                                        <img src="{{ $logoPath }}" class="logo-large" alt="Logo">
                                    @else
                                        <span class="fallback-large" style="background:#4CAF50;">প্র</span>
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">
                                    <p style="font-size: 22px; margin: 0 0 4px 0; color: #222;">{{ $orgName }}</p>
                                    <p class="muted">
                                        @if($orgEmail) Email: {{ $orgEmail }}<br>@endif
                                        @if($orgPhone) Phone: {{ $orgPhone }}@endif
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <div class="content-wrap">
            <p style="font-size: 15px; margin-bottom: 18px;"><strong>পেমেন্ট বিবরণ:</strong> {{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }} মাসের সদস্যপদ ফি
            @if($payment->description)
                <br><span class="muted">নোট: {{ $payment->description }}</span>
            @endif
            </p>

            <table class="details-table">
                <thead>
                    <tr>
                        <th style="width:50%;">বিবরণ</th>
                        <th style="width:25%;">মাস/বছর</th>
                        <th style="width:25%; text-align:right;">টাকা</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }} - সদস্যপদ ফি</td>
                        <td>{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }}</td>
                        <td class="amt">৳{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                    <tr style="background: #E3F2FD;">
                        <td colspan="2" style="color:#1976D2; font-weight: 600;">এই পেমেন্টের পরিমাণ</td>
                        <td class="amt" style="color:#1976D2; font-weight: 600;">৳{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="summary-table">
                <tr style="background:#f5f5f5;">
                    <td>মোট পেমেন্ট সংখ্যা</td>
                    <td class="right">{{ $paymentSummary['paid_months'] }} টি</td>
                </tr>
                <tr style="background:#f5f5f5;">
                    <td>মোট জমাকৃত টাকা</td>
                    <td class="right">৳{{ number_format($paymentSummary['total_paid'], 2) }}</td>
                </tr>
                @if($paymentSummary['unpaid_months'] > 0)
                <tr style="background:#fff3cd;">
                    <td>বকেয়া মাস</td>
                    <td class="right">{{ $paymentSummary['unpaid_months'] }} টি</td>
                </tr>
                <tr style="background:#fff3cd;">
                    <td>বকেয়া টাকা</td>
                    <td class="right">৳{{ number_format($paymentSummary['total_due'], 2) }}</td>
                </tr>
                @endif
            </table>

            @if($payment->paymentMethod)
            <div class="pay-meta">
                <strong>পেমেন্ট মাধ্যম:</strong> {{ $payment->paymentMethod->name }}
                @if($payment->transaction_id)
                    | <strong>লেনদেন আইডি:</strong> {{ $payment->transaction_id }}
                @endif
                @if($payment->paymentMethod->account_number)
                    | <strong>অ্যাকাউন্ট:</strong> {{ $payment->paymentMethod->account_number }}
                @endif
                @if($payment->processed_at)
                    | <strong>তারিখ:</strong> {{ $payment->processed_at->format('d M, Y') }}
                @endif
                | <strong>স্ট্যাটাস:</strong>
                @if ($payment->status === 'approved')
                    <span style="color:#16a34a;">অনুমোদিত</span>
                @elseif ($payment->status === 'pending')
                    <span style="color:#ca8a04;">পেন্ডিং</span>
                @elseif ($payment->status === 'rejected')
                    <span style="color:#dc2626;">বাতিল</span>
                @endif
            </div>
            @endif

            @if($payment->admin_note)
            <div style="margin-top: 16px;">
                <p style="font-size: 14px;"><strong>অ্যাডমিন নোট:</strong> {{ $payment->admin_note }}</p>
            </div>
            @endif

            <div style="margin-top: 24px; text-align: center;">
                <p style="color:#1976D2; font-size: 16px;"><strong>ধন্যবাদ!</strong> আপনার পেমেন্ট সফলভাবে গৃহীত এবং অনুমোদিত হয়েছে।</p>
            </div>

        </div>
        @if($payment->status === 'approved')
            <div class="approver-wrap" style="margin-top: 24px;">
                <div class="approver-block">
                    <p style="font-size: 15px; color: #111827; margin: 0 0 8px 0; text-align:center;">{{ $payment->approver?->name ?? 'N/A' }}</p>
                    <div class="approver-line"></div>
                    <p style="font-size: 14px; color: #4b5563; margin-top: 6px; text-align:center;">অনুমোদনকারী</p>
                </div>
            </div>
        @endif
        <div class="footer-wrap">            
            <table class="table-reset">
                <tr>
                    <td style="width:60%; vertical-align:top;">
                        <p style="font-size: 15px; font-weight: 600; color: #1e3a8a;">{{ $orgName }}</p>
                        <p class="muted" style="margin-top:4px;">
                            @if($orgPhone) ফোন: {{ $orgPhone }} @endif
                            @if($orgEmail) | ইমেইল: {{ $orgEmail }} @endif
                        </p>
                    </td>
                    <td style="width:40%; vertical-align:top; text-align:right;">
                        <p class="muted">রিসিপ্ট আইডি: #{{ $payment->id }}</p>
                        <p class="muted" style="margin-top:4px;">প্রিন্ট সময়: {{ now()->format('d M, Y h:i A') }}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
