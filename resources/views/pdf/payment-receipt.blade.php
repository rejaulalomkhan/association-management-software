<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>পেমেন্ট রিসিপ্ট</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300,400,500,700);
        body {
            background: #E0E0E0;
            font-family: 'Roboto', 'solaimanlipi', sans-serif;
            margin: 0;
            padding: 20px;
        }
        #invoice {
            margin: 0 auto;
            width: 700px;
            background: #FFF;
            padding: 0;
        }
        .invoice-section {
            border-bottom: 1px solid #EEE;
            padding: 30px;
        }
        .title-section {
            padding: 20px 30px;
            background: #f8f9fa;
            border-bottom: 2px solid #2196F3;
        }
        h1 {
            font-size: 1.8em;
            color: #1976D2;
            margin: 0;
            font-weight: 500;
        }
        h2 {
            font-size: 1.2em;
            margin: 0 0 8px 0;
            color: #222;
            font-weight: 500;
        }
        h3 {
            font-size: 1.1em;
            margin: 0 0 10px 0;
            color: #333;
            font-weight: 500;
        }
        p {
            font-size: 1em;
            color: #555;
            line-height: 1.6em;
            margin: 0;
        }
        .small-text {
            font-size: 0.95em;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 12px 15px;
            border: 1px solid #E0E0E0;
        }
        .table-header {
            background: #2196F3;
            color: white;
            font-weight: 500;
            font-size: 1.1em;
            padding: 12px 15px;
            border: 1px solid #1976D2;
        }
        .table-header h2 {
            color: white;
            font-size: 1.1em;
            margin: 0;
        }
        .table-row {
            border: 1px solid #E0E0E0;
        }
        .table-row td {
            font-size: 1em;
            color: #333;
        }
        .table-total {
            background: #E3F2FD;
            font-weight: 500;
            border: 1px solid #90caf9;
        }
        .table-total h2 {
            color: #1976D2;
            font-size: 1.1em;
        }
        .logo-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #4CAF50;
            color: white;
            text-align: center;
            line-height: 50px;
            font-size: 24px;
            font-weight: bold;
            display: inline-block;
            vertical-align: middle;
        }
        .logo-img-small {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            display: inline-block;
            vertical-align: middle;
        }
        .avatar-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #2196F3;
            color: white;
            text-align: center;
            line-height: 70px;
            font-size: 28px;
            font-weight: bold;
            display: inline-block;
            vertical-align: middle;
        }
        .logo-img, .avatar-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
        .payment-to {
            color: #1976D2;
            font-size: 1.1em;
            font-weight: 500;
        }
    </style>
</head>
<body>
    @php
        // Calculate payment summary
        $memberService = app(\App\Services\MemberService::class);
        $paymentSummary = $memberService->calculateOutstandingDues($payment->user);
        $settingsService = app(\App\Services\SettingsService::class);
        $orgName = $settingsService->get('organization_name', config('app.name'));
        $orgLogo = $settingsService->get('organization_logo');
        $logoPath = $orgLogo ? storage_path('app/public/' . $orgLogo) : null;
        $orgEmail = $settingsService->get('organization_email');
        $orgPhone = $settingsService->get('organization_phone');
        $orgAddress = $settingsService->get('organization_address');
    @endphp
    
    <div id="invoice">
        <!-- Title Section -->
        <div class="title-section">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="width: 60%; border: none; padding: 0; vertical-align: middle;">
                        <table style="border: none;">
                            <tr>
                                <td style="border: none; padding: 0; padding-right: 12px; vertical-align: middle;">
                                    @if($logoPath && file_exists($logoPath))
                                        <img src="{{ $logoPath }}" class="logo-img-small" alt="Logo">
                                    @else
                                        <div class="logo-circle">প্র</div>
                                    @endif
                                </td>
                                <td style="border: none; padding: 0; vertical-align: middle;">
                                    <h1 style="font-size: 1.5em;">পেইড পেমেন্ট রশিদ</h1>
                                    <p class="small-text" style="margin-top: 3px;">রিসিপ্ট #{{ $payment->id }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 40%; border: none; padding: 0; text-align: right; vertical-align: middle;">
                        <p class="small-text">ইস্যু তারিখ: {{ optional($payment->created_at)->format('d M, Y') }}</p>
                        <p class="small-text" style="margin-top: 3px;">অনুমোদনের তারিখ: {{ optional($payment->processed_at)->format('d M, Y') }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Header Section -->
        <div class="invoice-section">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="width: 50%; border: none; padding: 0; vertical-align: top;">
                        <h2 style="font-size: 1.1em; margin-bottom: 8px; color: #1976D2;">পেমেন্ট প্রদানকারী</h2>
                        <table style="border: none;">
                            <tr>
                                <td style="border: none; padding: 0; padding-right: 12px; vertical-align: middle;">
                                    @php
                                        $profilePic = $payment->user->profile_pic;
                                        $profilePath = $profilePic ? storage_path('app/public/' . $profilePic) : null;
                                    @endphp
                                    
                                    @if($profilePath && file_exists($profilePath))
                                        <img src="{{ $profilePath }}" class="avatar-img" alt="Profile">
                                    @else
                                        <div class="avatar-circle">{{ mb_substr($payment->user->name, 0, 1) }}</div>
                                    @endif
                                </td>
                                <td style="border: none; padding: 0; vertical-align: middle;">
                                    <h2 style="margin-bottom: 5px;">{{ $payment->user->name }}</h2>
                                    <p class="small-text">Email: {{ $payment->user->email }}<br>
                                       Phone: {{ $payment->user->phone }}<br>
                                       সদস্য আইডি: {{ $payment->user->membership_id }}</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%; border: none; padding: 0; padding-left: 20px; vertical-align: top;">
                        <h2 style="font-size: 1.1em; margin-bottom: 8px; color: #1976D2;">পেমেন্ট গ্রহণকারী</h2>
                        <table style="border: none;">
                            <tr>
                                <td style="border: none; padding: 0; padding-right: 15px; vertical-align: middle;">
                                    @if($logoPath && file_exists($logoPath))
                                        <img src="{{ $logoPath }}" class="logo-img" alt="Logo">
                                    @else
                                        <div class="logo-circle" style="width: 70px; height: 70px; line-height: 70px; font-size: 32px;">প্র</div>
                                    @endif
                                </td>
                                <td style="border: none; padding: 0; vertical-align: middle;">
                                    <h2 style="font-size: 1.3em; margin-bottom: 5px;">{{ $orgName }}</h2>
                                    <p class="small-text">
                                        @if($orgEmail)Email: {{ $orgEmail }}@endif
                                        @if($orgEmail && $orgPhone)<br>@endif
                                        @if($orgPhone)Phone: {{ $orgPhone }}@endif
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Payment Info Section -->
        <div class="invoice-section" style="border-bottom: none;">
            <p style="margin-bottom: 20px;"><strong>পেমেন্ট বিবরণ:</strong> {{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }} মাসের সদস্যপদ ফি
            @if($payment->description)
                <br><span class="small-text">নোট: {{ $payment->description }}</span>
            @endif
            </p>

            <!-- Payment Details Table -->
            <table style="border: 1px solid #E0E0E0;">
                <tr class="table-header">
                    <td style="width: 50%;"><h2>বিবরণ</h2></td>
                    <td style="width: 25%;"><h2>মাস/বছর</h2></td>
                    <td style="width: 25%; text-align: right;"><h2>টাকা</h2></td>
                </tr>
                
                <tr class="table-row">
                    <td>{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }} - সদস্যপদ ফি</td>
                    <td>{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }}</td>
                    <td style="text-align: right;">৳{{ number_format($payment->amount, 2) }}</td>
                </tr>
                
                <tr class="table-total">
                    <td colspan="2"><h2>এই পেমেন্টের পরিমাণ</h2></td>
                    <td style="text-align: right;"><h2>৳{{ number_format($payment->amount, 2) }}</h2></td>
                </tr>
            </table>

            <!-- Payment Summary - Right Side -->
            <table style="width: 100%; border: none; margin-top: 20px;">
                <tr>
                    <td style="width: 50%; border: none; padding: 0;"></td>
                    <td style="width: 50%; border: none; padding: 0; padding-left: 20px;">
                        <table style="width: 100%; border: 1px solid #E0E0E0;">
                            <tr style="background: #f5f5f5; border: 1px solid #E0E0E0;">
                                <td style="padding: 10px 15px; border: 1px solid #E0E0E0;">মোট পেমেন্ট সংখ্যা</td>
                                <td style="padding: 10px 15px; text-align: right; border: 1px solid #E0E0E0;">{{ $paymentSummary['paid_months'] }} টি</td>
                            </tr>
                            <tr style="background: #f5f5f5; border: 1px solid #E0E0E0;">
                                <td style="padding: 10px 15px; border: 1px solid #E0E0E0;">মোট জমাকৃত টাকা</td>
                                <td style="padding: 10px 15px; text-align: right; border: 1px solid #E0E0E0;">৳{{ number_format($paymentSummary['total_paid'], 2) }}</td>
                            </tr>
                            @if($paymentSummary['unpaid_months'] > 0)
                            <tr style="background: #fff3cd; border: 1px solid #E0E0E0;">
                                <td style="padding: 10px 15px; border: 1px solid #E0E0E0;">বকেয়া মাস</td>
                                <td style="padding: 10px 15px; text-align: right; border: 1px solid #E0E0E0;">{{ $paymentSummary['unpaid_months'] }} টি</td>
                            </tr>
                            <tr style="background: #fff3cd; border: 1px solid #E0E0E0;">
                                <td style="padding: 10px 15px; border: 1px solid #E0E0E0;">বকেয়া টাকা</td>
                                <td style="padding: 10px 15px; text-align: right; border: 1px solid #E0E0E0;">৳{{ number_format($paymentSummary['total_due'], 2) }}</td>
                            </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>

            @if($payment->paymentMethod)
            <div style="margin-top: 20px; padding: 15px 0; border-top: 1px solid #E0E0E0; border-bottom: 1px solid #E0E0E0;">
                <p style="font-size: 1em;">
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
                </p>
            </div>
            @endif

            @if($payment->admin_note)
            <div style="margin-top: 20px;">
                <p><strong>অ্যাডমিন নোট:</strong> {{ $payment->admin_note }}</p>
            </div>
            @endif

            <div style="margin-top: 25px; text-align: center;">
                <p style="color: #1976D2; font-size: 1.05em;"><strong>ধন্যবাদ!</strong> আপনার পেমেন্ট সফলভাবে গৃহীত এবং অনুমোদিত হয়েছে। 
                @if($payment->approver)
                    অনুমোদনকারী: {{ $payment->approver->name }}
                @endif
                </p>
            </div>
        </div>
    </div>
</body>
</html>
