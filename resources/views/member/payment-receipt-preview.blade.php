@extends('layouts.receipt')

@section('content')
<div class="min-h-screen py-10 bg-gray-100">
    <div class="max-w-3xl p-8 mx-auto bg-white rounded-lg shadow-md">
        {{-- Header: Logo + Organization Info --}}
        <div class="pb-4 mb-6 text-center border-b">
            @if(file_exists(public_path('logo.png')))
                <img src="{{ asset('logo.png') }}" alt="Logo" class="mx-auto mb-2" style="height:60px;">
            @endif

            <h1 class="mb-1 text-xl font-bold">
                {{ config('app.name') }}
            </h1>
            <p class="text-xs leading-4 text-gray-600">
                {{ config('app.address_line_1', 'ঠিকানা লাইন ১') }}<br>
                {{ config('app.address_line_2', 'ঠিকানা লাইন ২') }}
            </p>
        </div>

        {{-- Title + Meta --}}
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="text-lg font-semibold">পেমেন্ট রিসিপ্ট (প্রিভিউ)</h2>
                <p class="mt-1 text-xs text-gray-500">সাবমিট করা পেমেন্টের বিস্তারিত তথ্য</p>
            </div>
            <div class="text-xs text-right text-gray-600">
                <div>রিসিপ্ট নং: <span class="font-semibold">{{ $payment->id }}</span></div>
                <div>তারিখ: {{ optional($payment->created_at)->format('d/m/Y') }}</div>
            </div>
        </div>

        {{-- Member Info --}}
        <div class="p-4 mb-4 border rounded-md">
            <h3 class="pb-1 mb-2 text-sm font-semibold border-b">সদস্য তথ্য</h3>
            <div class="space-y-1 text-sm">
                <div><span class="font-semibold">নাম:</span> {{ $payment->user->name }}</div>
                <div><span class="font-semibold">মেম্বার আইডি:</span> {{ $payment->user->membership_id }}</div>
            </div>
        </div>

        {{-- Payment Info --}}
        <div class="p-4 mb-4 border rounded-md">
            <h3 class="pb-1 mb-2 text-sm font-semibold border-b">পেমেন্ট তথ্য</h3>
            <table class="w-full text-sm border-separate" style="border-spacing: 0 4px;">
                <tr>
                    <td class="w-32 py-1 font-semibold align-top">মাস/বছর</td>
                    <td class="py-1">
                        {{ \App\Helpers\BanglaHelper::getBanglaMonth($payment->month) }} {{ $payment->year }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">পরিমাণ</td>
                    <td class="py-1">৳{{ number_format($payment->amount, 2) }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">পেমেন্ট মাধ্যম</td>
                    <td class="py-1">{{ optional($payment->paymentMethod)->name }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">ট্রানজেকশন আইডি</td>
                    <td class="py-1">{{ $payment->transaction_id ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">স্ট্যাটাস</td>
                    <td class="py-1">
                        @if ($payment->status === 'approved')
                            অনুমোদিত
                        @elseif ($payment->status === 'pending')
                            পেন্ডিং
                        @elseif ($payment->status === 'rejected')
                            বাতিল
                        @else
                            {{ ucfirst($payment->status) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">সাবমিটের তারিখ</td>
                    <td class="py-1">{{ optional($payment->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">অনুমোদনের তারিখ</td>
                    <td class="py-1">{{ optional($payment->processed_at)->format('d/m/Y H:i') ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-1 font-semibold align-top">অনুমোদনকারী</td>
                    <td class="py-1">{{ optional($payment->approver)->name ?? '-' }}</td>
                </tr>
            </table>
        </div>

        {{-- Notes --}}
        @if ($payment->description)
            <div class="p-4 mb-4 border rounded-md">
                <h3 class="pb-1 mb-2 text-sm font-semibold border-b">মেম্বারের নোট</h3>
                <p class="text-sm leading-relaxed">{{ $payment->description }}</p>
            </div>
        @endif

        @if ($payment->admin_note)
            <div class="p-4 mb-4 border rounded-md">
                <h3 class="pb-1 mb-2 text-sm font-semibold border-b">অ্যাডমিন নোট</h3>
                <p class="text-sm leading-relaxed">{{ $payment->admin_note }}</p>
            </div>
        @endif

        {{-- Footer + Actions --}}
        <div class="flex items-center justify-between mt-6">
            <p class="text-[11px] text-gray-500">
                এই রিসিপ্টটি সিস্টেম দ্বারা স্বয়ংক্রিয়ভাবে তৈরি করা হয়েছে।
            </p>

            {{-- PDF ডাউনলোডের জন্য পরে তুমি route সেট করবে --}}
            <a href="#"
               class="inline-flex items-center px-4 py-2 text-xs font-medium text-white bg-indigo-600 rounded cursor-not-allowed hover:bg-indigo-700"
               title="PDF ডাউনলোড (backend এখনও কনফিগার করা হয়নি)">
                PDF ডাউনলোড
            </a>
        </div>
    </div>
</div>
@endsection
