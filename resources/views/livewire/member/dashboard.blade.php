<div class="space-y-6">
    <!-- Header with Profile -->
    <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                @if($user->profile_pic)
                    <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="{{ $user->name }}"
                        class="h-16 w-16 rounded-full object-cover ring-4 ring-white">
                @else
                    <div class="h-16 w-16 rounded-full bg-indigo-400 flex items-center justify-center ring-4 ring-white">
                        <span class="text-white font-bold text-2xl">{{ substr($user->name, 0, 2) }}</span>
                    </div>
                @endif
                <div>
                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                    <p class="text-indigo-100">সদস্য নম্বর: {{ $user->membership_id ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-indigo-100">যোগদানের তারিখ</p>
                <p class="text-lg font-semibold">{{ $user->joined_at ? \Carbon\Carbon::parse($user->joined_at)->format('d M Y') : 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Current Month Payment Notification -->
    @if(!$currentMonthPaid)
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="ml-3 flex-1">
                <p class="text-sm font-medium text-yellow-800">
                    {{ $currentMonth }} {{ $currentYear }} মাসের টাকা এখনো জমা দেওয়া হয়নি!
                </p>
            </div>
            <div>
                <a href="{{ route('member.payment') }}" wire:navigate
                    class="px-4 py-2 bg-yellow-400 text-yellow-900 rounded-lg font-medium hover:bg-yellow-500">
                    এখনই জমা দিন
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Due Payment Card -->
    <livewire:member.due-payment-card />

    <!-- Balance Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Total Paid -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-gray-600">মোট জমা</p>
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">৳{{ number_format($duesInfo['total_paid'], 2) }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $duesInfo['paid_months'] }} মাস পরিশোধিত</p>
        </div>

        <!-- Total Due -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-gray-600">বকেয়া</p>
                <div class="p-2 bg-red-100 rounded-lg">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">৳{{ number_format($duesInfo['total_due'], 2) }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $duesInfo['unpaid_months'] }} মাস বাকি</p>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-3">
                <p class="text-sm font-medium text-gray-600">অপেক্ষমাণ</p>
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">৳{{ number_format($duesInfo['total_pending'], 2) }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $duesInfo['pending_months'] }} মাস অপেক্ষমাণ</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('member.payment') }}" wire:navigate
            class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="p-3 bg-indigo-100 rounded-full mb-3">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">পেমেন্ট জমা</span>
        </a>

        <a href="{{ route('member.history') }}" wire:navigate
            class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="p-3 bg-green-100 rounded-full mb-3">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">লেনদেন তালিকা</span>
        </a>

        <a href="{{ route('member.profile.edit') }}" wire:navigate
            class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
            <div class="p-3 bg-blue-100 rounded-full mb-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">প্রোফাইল সম্পাদনা</span>
        </a>

        <form method="POST" action="{{ route('tyro-login.logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow">
                <div class="p-3 bg-red-100 rounded-full mb-3">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">লগআউট</span>
            </button>
        </form>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">সাম্প্রতিক লেনদেন</h2>
        </div>

        @if($recentPayments->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($recentPayments as $payment)
            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg
                            @if($payment->status === 'approved') bg-green-100
                            @elseif($payment->status === 'pending') bg-yellow-100
                            @else bg-red-100 @endif">
                            <svg class="w-5 h-5
                                @if($payment->status === 'approved') text-green-600
                                @elseif($payment->status === 'pending') text-yellow-600
                                @else text-red-600 @endif"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $payment->month }} {{ $payment->year }}</p>
                            <p class="text-sm text-gray-500">{{ $payment->paymentMethod->localized_name ?? $payment->method }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">৳{{ number_format($payment->amount, 2) }}</p>
                        <span class="px-2 py-1 text-xs rounded-full
                            @if($payment->status === 'approved') bg-green-100 text-green-800
                            @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            @if($payment->status === 'approved') অনুমোদিত
                            @elseif($payment->status === 'pending') অপেক্ষমাণ
                            @else প্রত্যাখ্যাত @endif
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <a href="{{ route('member.history') }}" wire:navigate
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                সব লেনদেন দেখুন →
            </a>
        </div>
        @else
        <div class="px-6 py-12 text-center text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="mt-4">কোনো লেনদেন নেই</p>
            <a href="{{ route('member.payment') }}" wire:navigate
                class="mt-4 inline-block px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                প্রথম পেমেন্ট জমা দিন
            </a>
        </div>
        @endif
    </div>
</div>
