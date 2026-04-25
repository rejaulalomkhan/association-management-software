@extends('layouts.receipt')

@section('content')
@php
    // Calculate payment summary
    $memberService = app(\App\Services\MemberService::class);
    $paymentSummary = $memberService->calculateOutstandingDues($payment->user);
    $settingsService = app(\App\Services\SettingsService::class);
    $orgName = $settingsService->get('organization_name', config('app.name'));
    $orgLogo = $settingsService->get('organization_logo');
    $logoPath = $orgLogo ? asset('storage/' . $orgLogo) : null;
    $orgEmail = $settingsService->get('organization_email');
    $orgPhone = $settingsService->get('organization_phone');
    $profilePic = $payment->user->profile_pic;
    $profilePath = $profilePic ? asset('storage/' . $profilePic) : null;
@endphp

<div class="min-h-screen py-10 bg-gray-100">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg" style="font-family: 'Roboto', sans-serif;">
        
        <!-- Title Section -->
        <div class="p-6 border-b-2" style="background: #f8f9fa; border-color: #2196F3;">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="width: 60%;">
                    <div class="mr-3">
                        @if($logoPath && file_exists(public_path('storage/' . $orgLogo)))
                            <img src="{{ $logoPath }}" alt="Logo" class="rounded-full" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="flex items-center justify-center text-white bg-green-500 rounded-full" style="width: 50px; height: 50px; font-size: 24px; font-weight: bold;">
                                প্র
                            </div>
                        @endif
                    </div>
                    <div>
                        <h1 class="font-medium" style="font-size: 1.5em; color: #1976D2;">পেইড পেমেন্ট রশিদ</h1>
                        <p class="text-gray-600" style="font-size: 0.95em; margin-top: 3px;">রিসিপ্ট #{{ $payment->id }}</p>
                    </div>
                </div>
                <div class="text-right" style="width: 40%;">
                    <p class="text-gray-600" style="font-size: 0.95em;">ইস্যু তারিখ: {{ optional($payment->created_at)->format('d M, Y') }}</p>
                    <p class="text-gray-600" style="font-size: 0.95em; margin-top: 3px;">অনুমোদনের তারিখ: {{ optional($payment->processed_at)->format('d M, Y') ?? 'পেন্ডিং' }}</p>
                    @if($payment->status === 'approved')
                        <a href="{{ route('member.payments.receipt.download', $payment->id) }}"
                           class="inline-block px-4 py-2 mt-3 text-sm font-medium text-white transition rounded-md"
                           style="background: #2563eb;">
                            PDF Download
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Header Section -->
        <div class="p-8 border-b border-gray-200">
            <div class="flex items-start justify-between gap-6">
                <div style="width: 50%;">
                    <h2 class="mb-2 font-medium" style="font-size: 1.1em; color: #1976D2;">পেমেন্ট প্রদানকারী</h2>
                    <div class="flex items-center">
                        <div class="mr-3">
                            @if($profilePath && file_exists(public_path('storage/' . $profilePic)))
                                <img src="{{ $profilePath }}" alt="Profile" class="rounded-full" style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <div class="flex items-center justify-center text-white rounded-full" style="width: 70px; height: 70px; font-size: 28px; font-weight: bold; background: #2196F3;">
                                    {{ mb_substr($payment->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="mb-1 font-medium" style="font-size: 1.2em; color: #222;">{{ $payment->user->name }}</h2>
                            <p class="text-gray-600" style="font-size: 0.95em;">
                                Email: {{ $payment->user->email }}<br>
                                Phone: {{ $payment->user->phone }}<br>
                                সদস্য আইডি: {{ $payment->user->membership_id }}
                            </p>
                        </div>
                    </div>
                </div>
                <div style="width: 50%;">
                    <h2 class="mb-2 font-medium" style="font-size: 1.1em; color: #1976D2;">পেমেন্ট গ্রহণকারী</h2>
                    <div class="flex items-center">
                        <div class="mr-4">
                            @if($logoPath && file_exists(public_path('storage/' . $orgLogo)))
                                <img src="{{ $logoPath }}" alt="Logo" class="rounded-full" style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <div class="flex items-center justify-center text-white bg-green-500 rounded-full" style="width: 70px; height: 70px; font-size: 32px; font-weight: bold;">
                                    প্র
                                </div>
                            @endif
                        </div>
                        <div>
                            <h2 class="mb-1 font-medium" style="font-size: 1.3em; color: #222;">{{ $orgName }}</h2>
                            <p class="text-gray-600" style="font-size: 0.95em;">
                                @if($orgEmail) Email: {{ $orgEmail }}<br>@endif
                                @if($orgPhone) Phone: {{ $orgPhone }}@endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Info Section -->
        <div class="p-8">
            <p class="mb-6" style="font-size: 1em;"><strong>পেমেন্ট বিবরণ:</strong> {{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }} মাসের সদস্যপদ ফি
            @if($payment->description)
                <br><span class="text-gray-600" style="font-size: 0.95em;">নোট: {{ $payment->description }}</span>
            @endif
            </p>

            <!-- Payment Details Table -->
            <table class="w-full mb-6 overflow-hidden border border-gray-200 rounded-lg" style="border-collapse: collapse;">
                <thead>
                    <tr style="background: #2196F3; color: white; border: 1px solid #1976D2;">
                        <th class="px-4 py-3 font-medium text-left border border-blue-700" style="font-size: 1.1em; width: 50%;">বিবরণ</th>
                        <th class="px-4 py-3 font-medium text-left border border-blue-700" style="font-size: 1.1em; width: 25%;">মাস/বছর</th>
                        <th class="px-4 py-3 font-medium text-right border border-blue-700" style="font-size: 1.1em; width: 25%;">টাকা</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border border-gray-200">
                        <td class="px-4 py-3 border border-gray-200" style="font-size: 1em; color: #333;">{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }} - সদস্যপদ ফি</td>
                        <td class="px-4 py-3 border border-gray-200" style="font-size: 1em; color: #333;">{{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }}</td>
                        <td class="px-4 py-3 text-right border border-gray-200" style="font-size: 1em; color: #333;">৳{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                    
                    <tr style="background: #E3F2FD; border: 1px solid #90caf9;">
                        <td colspan="2" class="px-4 py-3 font-medium border border-blue-200" style="font-size: 1.1em; color: #1976D2;">এই পেমেন্টের পরিমাণ</td>
                        <td class="px-4 py-3 font-medium text-right border border-blue-200" style="font-size: 1.1em; color: #1976D2;">৳{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Payment Summary - Right Side -->
            <div class="flex justify-end mb-6">
                <div style="width: 50%;">
                    <table class="w-full border border-gray-200 rounded-lg" style="border-collapse: collapse;">
                        <tr style="background: #f5f5f5;">
                            <td class="px-4 py-2 border border-gray-200" style="font-size: 1em;">মোট পেমেন্ট সংখ্যা</td>
                            <td class="px-4 py-2 text-right border border-gray-200" style="font-size: 1em;">{{ $paymentSummary['paid_months'] }} টি</td>
                        </tr>
                        <tr style="background: #f5f5f5;">
                            <td class="px-4 py-2 border border-gray-200" style="font-size: 1em;">মোট জমাকৃত টাকা</td>
                            <td class="px-4 py-2 text-right border border-gray-200" style="font-size: 1em;">৳{{ number_format($paymentSummary['total_paid'], 2) }}</td>
                        </tr>
                        @if($paymentSummary['unpaid_months'] > 0)
                        <tr style="background: #fff3cd;">
                            <td class="px-4 py-2 border border-gray-200" style="font-size: 1em;">বকেয়া মাস</td>
                            <td class="px-4 py-2 text-right border border-gray-200" style="font-size: 1em;">{{ $paymentSummary['unpaid_months'] }} টি</td>
                        </tr>
                        <tr style="background: #fff3cd;">
                            <td class="px-4 py-2 border border-gray-200" style="font-size: 1em;">বকেয়া টাকা</td>
                            <td class="px-4 py-2 text-right border border-gray-200" style="font-size: 1em;">৳{{ number_format($paymentSummary['total_due'], 2) }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            @if($payment->paymentMethod)
            <div class="py-4 border-t border-b border-gray-200">
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
                    | <strong>স্ট্যাটাস:</strong> 
                    @if ($payment->status === 'approved')
                        <span class="text-green-600">অনুমোদিত</span>
                    @elseif ($payment->status === 'pending')
                        <span class="text-yellow-600">পেন্ডিং</span>
                    @elseif ($payment->status === 'rejected')
                        <span class="text-red-600">বাতিল</span>
                    @endif
                </p>
            </div>
            @endif

            @if($payment->admin_note)
            <div class="mt-5">
                <p style="font-size: 1em;"><strong>অ্যাডমিন নোট:</strong> {{ $payment->admin_note }}</p>
            </div>
            @endif

            <div class="mt-6 text-center">
                <p style="color: #1976D2; font-size: 1.05em;"><strong>ধন্যবাদ!</strong> আপনার পেমেন্ট সফলভাবে গৃহীত এবং অনুমোদিত হয়েছে।</p>
            </div>

            @if($payment->status === 'approved')
            <div class="mt-16">
                <div class="text-left" style="max-width: 260px;">
                    <p style="font-size: 1em; color: #111827; margin-bottom: 8px; text-align: center;">
                        {{ $payment->approver?->name ?? 'N/A' }}
                    </p>
                    <div style="border-top: 1px solid #111827; width: 100%;"></div>
                    <p style="font-size: 0.95em; color: #4b5563; margin-top: 6px; text-align: center;">অনুমোদনকারী</p>
                </div>
            </div>
            @endif
        </div>

        <div class="px-8 py-5 border-t-2 rounded-b-lg" style="background: #f8fafc; border-color: #bfdbfe;">
            <div class="flex items-start justify-between gap-6 text-sm" style="color: #475569;">
                <div style="width: 60%;">
                    <p style="font-weight: 600; color: #1e3a8a;">{{ $orgName }}</p>
                    <p style="margin-top: 4px;">
                        @if($orgPhone) ফোন: {{ $orgPhone }} @endif
                        @if($orgEmail) | ইমেইল: {{ $orgEmail }} @endif
                    </p>
                </div>
                <div class="text-right" style="width: 40%;">
                    <p>রিসিপ্ট আইডি: #{{ $payment->id }}</p>
                    <p style="margin-top: 4px;">প্রিন্ট সময়: {{ now()->format('d M, Y h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
