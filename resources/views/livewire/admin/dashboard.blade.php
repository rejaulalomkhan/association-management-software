<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">এডমিন ড্যাশবোর্ড</h1>

        <!-- Month/Year Filter -->
        <div class="flex gap-3">
            <select wire:model.live="selectedMonth"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="">সকল মাস</option>
                <option value="January">জানুয়ারি</option>
                <option value="February">ফেব্রুয়ারি</option>
                <option value="March">মার্চ</option>
                <option value="April">এপ্রিল</option>
                <option value="May">মে</option>
                <option value="June">জুন</option>
                <option value="July">জুলাই</option>
                <option value="August">আগস্ট</option>
                <option value="September">সেপ্টেম্বর</option>
                <option value="October">অক্টোবর</option>
                <option value="November">নভেম্বর</option>
                <option value="December">ডিসেম্বর</option>
            </select>

            <select wire:model.live="selectedYear"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="">সকল বছর</option>
                @php
                    $orgStartYear = app(\App\Services\SettingsService::class)->getOrganizationEstablishedYear();
                @endphp
                @for($year = now()->year; $year >= $orgStartYear; $year--)
                <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Members -->
        <div class="p-6 text-white rounded-lg shadow-lg bg-gradient-to-br from-blue-500 to-blue-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-100">মোট সদস্য</p>
                    <p class="mt-1 text-3xl font-bold">{{ $stats['total_members'] }}</p>
                </div>
                <div class="p-3 bg-blue-400 rounded-full bg-opacity-30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Paid This Month -->
        <div class="p-6 text-white rounded-lg shadow-lg bg-gradient-to-br from-green-500 to-green-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-green-100">পরিশোধিত</p>
                    <p class="mt-1 text-3xl font-bold">{{ $stats['paid_count'] }}</p>
                    <p class="mt-1 text-xs text-green-100">৳{{ number_format($stats['total_paid'], 2) }}</p>
                </div>
                <div class="p-3 bg-green-400 rounded-full bg-opacity-30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Unpaid This Month -->
        <div class="p-6 text-white rounded-lg shadow-lg bg-gradient-to-br from-red-500 to-red-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-red-100">বকেয়া</p>
                    <p class="mt-1 text-3xl font-bold">{{ $stats['unpaid_count'] }}</p>
                    <p class="mt-1 text-xs text-red-100">{{ round($stats['collection_rate'], 1) }}% সংগৃহীত</p>
                </div>
                <div class="p-3 bg-red-400 rounded-full bg-opacity-30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Approvals -->
        <div class="p-6 text-white rounded-lg shadow-lg bg-gradient-to-br from-yellow-500 to-yellow-600">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-yellow-100">অপেক্ষমাণ</p>
                    <p class="mt-1 text-3xl font-bold">{{ $stats['pending_count'] }}</p>
                    <p class="mt-1 text-xs text-yellow-100">নিবন্ধন: {{ $stats['pending_registrations'] }}</p>
                </div>
                <div class="p-3 bg-yellow-400 rounded-full bg-opacity-30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Paid Members Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">পরিশোধিত সদস্য ({{ $selectedMonth }} {{ $selectedYear }})</h2>
            </div>

            @if($paidMembers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">সদস্য</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">পরিমাণ</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">মাধ্যম</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($paidMembers as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($payment->user->profile_pic)
                                        <img src="{{ asset('storage/' . $payment->user->profile_pic) }}"
                                            class="object-cover w-8 h-8 rounded-full" alt="{{ $payment->user->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-8 h-8 bg-green-100 rounded-full">
                                            <span class="text-xs font-medium text-green-600">{{ substr($payment->user->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $payment->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $payment->user->membership_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="text-sm font-semibold text-green-600">৳{{ number_format($payment->amount, 2) }}</span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="text-xs text-gray-600">{{ $payment->paymentMethod->localized_name ?? $payment->method }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-6 py-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-2">এই মাসে কোনো পেমেন্ট নেই</p>
            </div>
            @endif
        </div>

        <!-- Unpaid Members Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">বকেয়া সদস্য ({{ $selectedMonth }} {{ $selectedYear }})</h2>
            </div>

            @if($unpaidMembers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">সদস্য</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">ফোন</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">অবস্থা</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($unpaidMembers as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($member->profile_pic)
                                        <img src="{{ asset('storage/' . $member->profile_pic) }}"
                                            class="object-cover w-8 h-8 rounded-full" alt="{{ $member->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-8 h-8 bg-red-100 rounded-full">
                                            <span class="text-xs font-medium text-red-600">{{ substr($member->name, 0, 2) }}</span>
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $member->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $member->membership_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                                {{ $member->phone }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                    বকেয়া
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-6 py-12 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="mt-2">সব সদস্য পেমেন্ট করেছে! 🎉</p>
            </div>
            @endif
        </div>
    </div>
</div>
