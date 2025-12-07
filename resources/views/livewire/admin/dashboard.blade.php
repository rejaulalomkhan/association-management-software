<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                এডমিন ড্যাশবোর্ড
            </h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">সংস্থার সামগ্রিক অবস্থার একনজরে</p>
        </div>

        <!-- Month/Year Filter -->
        <div class="flex gap-3">
            <div class="relative">
                <select wire:model.live="selectedMonth"
                    class="appearance-none pl-4 pr-10 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm transition-all hover:border-blue-400 cursor-pointer">
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
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <div class="relative">
                <select wire:model.live="selectedYear"
                    class="appearance-none pl-4 pr-10 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm transition-all hover:border-purple-400 cursor-pointer">
                    <option value="">সকল বছর</option>
                    @php
                        $orgStartYear = app(\App\Services\SettingsService::class)->getOrganizationEstablishedYear();
                    @endphp
                    @for($year = now()->year; $year >= $orgStartYear; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Total Members -->
        <div class="relative overflow-hidden transition-all duration-300 bg-white shadow-lg dark:bg-gray-800 rounded-2xl hover:shadow-xl group hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 transition-transform bg-blue-500 rounded-full opacity-10 group-hover:scale-150"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-xl">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span class="flex items-center text-xs font-medium text-green-600 bg-green-100 dark:bg-green-900/30 dark:text-green-400 px-2.5 py-0.5 rounded-full">
                        সক্রিয়
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">মোট সদস্য</p>
                <h3 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_members'] }}</h3>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        </div>

        <!-- Paid This Month -->
        <div class="relative overflow-hidden transition-all duration-300 bg-white shadow-lg dark:bg-gray-800 rounded-2xl hover:shadow-xl group hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 transition-transform bg-green-500 rounded-full opacity-10 group-hover:scale-150"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-xl">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        {{ $selectedMonth ? \App\Helpers\BanglaHelper::getBanglaMonth($selectedMonth) : 'এই মাস' }}
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">পরিশোধিত</p>
                <div class="flex items-baseline gap-2 mt-1">
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['paid_count'] }}</h3>
                    <span class="text-sm font-medium text-green-600 dark:text-green-400">৳{{ number_format($stats['total_paid']) }}</span>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-green-500 to-emerald-600"></div>
        </div>

        <!-- Unpaid This Month -->
        <div class="relative overflow-hidden transition-all duration-300 bg-white shadow-lg dark:bg-gray-800 rounded-2xl hover:shadow-xl group hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 transition-transform bg-red-500 rounded-full opacity-10 group-hover:scale-150"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-50 dark:bg-red-900/30 rounded-xl">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-red-600 bg-red-100 dark:bg-red-900/30 dark:text-red-400 px-2.5 py-0.5 rounded-full">
                        {{ round($stats['collection_rate'], 1) }}% সংগৃহীত
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">বকেয়া</p>
                <h3 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['unpaid_count'] }}</h3>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 to-pink-600"></div>
        </div>

        <!-- Pending Approvals -->
        <div class="relative overflow-hidden transition-all duration-300 bg-white shadow-lg dark:bg-gray-800 rounded-2xl hover:shadow-xl group hover:-translate-y-1">
            <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 transition-transform bg-yellow-500 rounded-full opacity-10 group-hover:scale-150"></div>
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-xl">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30 dark:text-yellow-400 px-2.5 py-0.5 rounded-full">
                        নিবন্ধন: {{ $stats['pending_registrations'] }}
                    </span>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">অপেক্ষমাণ</p>
                <h3 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_count'] }}</h3>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-orange-600"></div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <!-- Paid Members Table -->
        <div class="relative overflow-hidden bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">পরিশোধিত সদস্য</h2>
                    <span class="px-3 py-1 text-xs font-medium text-green-600 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-400">
                        {{ $selectedMonth ? \App\Helpers\BanglaHelper::getBanglaMonth($selectedMonth) : 'সব' }} {{ $selectedYear }}
                    </span>
                </div>
            </div>

            @if($paidMembers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">সদস্য</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">পরিমাণ</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">মাধ্যম</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($paidMembers as $payment)
                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($payment->user->profile_pic)
                                        <img src="{{ asset('storage/' . $payment->user->profile_pic) }}"
                                            class="object-cover w-10 h-10 border-2 border-white rounded-full shadow-sm dark:border-gray-700" alt="{{ $payment->user->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-green-600 bg-green-100 border-2 border-white rounded-full shadow-sm dark:border-gray-700 dark:bg-green-900/30 dark:text-green-400">
                                            {{ substr($payment->user->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $payment->user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->user->membership_id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-bold text-green-600 dark:text-green-400">৳{{ number_format($payment->amount, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                    {{ $payment->paymentMethod->localized_name ?? $payment->method }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="flex flex-col items-center justify-center px-6 py-12 text-center">
                <div class="p-4 mb-4 bg-gray-50 rounded-full dark:bg-gray-700/50">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400">এই মাসে কোনো পেমেন্ট নেই</p>
            </div>
            @endif
        </div>

        <!-- Unpaid Members Table -->
        <div class="relative overflow-hidden bg-white shadow-lg dark:bg-gray-800 rounded-2xl">
            <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-800 dark:text-white">বকেয়া সদস্য</h2>
                    <span class="px-3 py-1 text-xs font-medium text-red-600 bg-red-100 rounded-full dark:bg-red-900/30 dark:text-red-400">
                        {{ $selectedMonth ? \App\Helpers\BanglaHelper::getBanglaMonth($selectedMonth) : 'সব' }} {{ $selectedYear }}
                    </span>
                </div>
            </div>

            @if($unpaidMembers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">সদস্য</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">বকেয়া</th>
                            <th class="px-6 py-4 text-xs font-semibold tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($unpaidMembers as $member)
                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($member->profile_pic)
                                        <img src="{{ asset('storage/' . $member->profile_pic) }}"
                                            class="object-cover w-10 h-10 border-2 border-white rounded-full shadow-sm dark:border-gray-700" alt="{{ $member->name }}">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-red-600 bg-red-100 border-2 border-white rounded-full shadow-sm dark:border-gray-700 dark:bg-red-900/30 dark:text-red-400">
                                            {{ substr($member->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $member->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $member->phone }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-red-600 dark:text-red-400">৳{{ number_format($member->due_amount, 2) }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $member->due_months }} মাস</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($member->phone)
                                    @php
                                        $orgName = app(\App\Services\SettingsService::class)->get('organization_name', 'প্রজন্ম উন্নয়ন মিশন');
                                        $phoneForWa = preg_replace('/[^0-9]/', '', $member->phone);
                                        if (!str_starts_with($phoneForWa, '88')) {
                                            $phoneForWa = '88' . $phoneForWa;
                                        }
                                        $message = urlencode("প্রিয় {$member->name},\nআপনার মোট {$member->due_months} মাসের বকেয়া রয়েছে। মোট বকেয়া: ৳" . number_format($member->due_amount, 2) . "।\n\n- " . $orgName);
                                    @endphp
                                    <a href="https://wa.me/{{ $phoneForWa }}?text={{ $message }}" target="_blank"
                                       class="inline-flex items-center justify-center w-8 h-8 text-white transition-all transform bg-green-500 rounded-lg hover:bg-green-600 hover:scale-110 shadow-md hover:shadow-lg"
                                       title="WhatsApp এ রিমাইন্ডার পাঠান">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                        </svg>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="flex flex-col items-center justify-center px-6 py-12 text-center">
                <div class="p-4 mb-4 bg-gray-50 rounded-full dark:bg-gray-700/50">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-gray-500 dark:text-gray-400">সব সদস্য পেমেন্ট করেছে! 🎉</p>
            </div>
            @endif
        </div>
    </div>
</div>
