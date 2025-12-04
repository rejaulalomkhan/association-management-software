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
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">বকেয়ার মাস</th>
                            <th class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase">মোট বকেয়া</th>
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
                            <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                                {{ $member->due_months }} মাস
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                                ৳{{ number_format($member->due_amount, 2) }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                                        বকেয়া
                                    </span>
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
                                           class="flex items-center justify-center w-8 h-8 text-white transition-colors bg-green-500 rounded-full hover:bg-green-600"
                                           title="WhatsApp">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
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
