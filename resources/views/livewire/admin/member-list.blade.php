<div class="space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">সদস্য তালিকা</h1>

        <!-- Search and Filter -->
        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('admin.members.add') }}" wire:navigate
                class="flex items-center justify-center px-4 py-2 font-medium text-white transition-colors rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                সদস্য যুক্ত করুন
            </a>

            <input type="text" wire:model.live="search" placeholder="নাম, ফোন বা সদস্য নম্বর খুঁজুন..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">

            <select wire:model.live="statusFilter"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                <option value="active">সক্রিয়</option>
                <option value="inactive">নিষ্ক্রিয়</option>
                <option value="pending">অপেক্ষমাণ</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        @if($members->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ছবি</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">নাম</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">সদস্য নম্বর</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">ফোন</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">যোগদান</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">অবস্থা</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">কার্যক্রম</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($members as $member)
                    <tr class="cursor-pointer hover:bg-gray-50" wire:click="viewMemberProfile({{ $member->id }})">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($member->profile_pic)
                                <img src="{{ asset('storage/' . $member->profile_pic) }}" alt="{{ $member->name }}"
                                    class="object-cover w-10 h-10 rounded-full ring-2 ring-indigo-500">
                            @else
                                <div class="flex items-center justify-center w-10 h-10 bg-indigo-100 rounded-full ring-2 ring-indigo-500">
                                    <span class="text-sm font-medium text-indigo-600">{{ substr($member->name, 0, 2) }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $member->name }}</div>
                            <div class="text-sm text-gray-500">{{ $member->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium text-indigo-800 bg-indigo-100 rounded">
                                {{ $member->membership_id ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $member->phone }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                            {{ $member->joined_at ? \Carbon\Carbon::parse($member->joined_at)->format('d M Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                @if($member->status === 'active') bg-green-100 text-green-800
                                @elseif($member->status === 'inactive') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ $member->status === 'active' ? 'সক্রিয়' : ($member->status === 'inactive' ? 'নিষ্ক্রিয়' : 'অপেক্ষমাণ') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <button wire:click.stop="viewMemberProfile({{ $member->id }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    বিস্তারিত →
                                </button>
                                @if($member->status === 'active')
                                <a href="{{ route('admin.member-certificate', $member->id) }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full hover:bg-green-200 transition-colors">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    সদস্য পত্র
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $members->links() }}
        </div>
        @else
        <div class="px-6 py-12 text-center text-gray-500">
            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <p class="mt-4 text-lg">কোনো সদস্য পাওয়া যায়নি</p>
        </div>
        @endif
    </div>

    <!-- Member Profile Modal -->
    @if($showMemberProfile && $selectedMember)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">সদস্যের প্রোফাইল</h2>
                    <button wire:click="closeProfile" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Profile Header -->
                <div class="flex items-center p-4 mb-6 space-x-4 rounded-lg bg-gradient-to-r from-indigo-50 to-blue-50">
                    @if($selectedMember->profile_pic)
                        <img src="{{ asset('storage/' . $selectedMember->profile_pic) }}" alt="{{ $selectedMember->name }}"
                            class="object-cover w-20 h-20 rounded-full ring-4 ring-white">
                    @else
                        <div class="flex items-center justify-center w-20 h-20 bg-indigo-200 rounded-full ring-4 ring-white">
                            <span class="text-2xl font-bold text-indigo-700">{{ substr($selectedMember->name, 0, 2) }}</span>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $selectedMember->name }}</h3>
                        <p class="font-medium text-indigo-600">{{ $selectedMember->membership_id ?? 'No ID' }}</p>
                        <p class="text-sm text-gray-600">{{ $selectedMember->profession ?? 'পেশা উল্লেখ নেই' }}</p>
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="grid grid-cols-1 gap-4 mb-6 md:grid-cols-2">
                    <div class="p-3 rounded bg-gray-50">
                        <label class="text-xs font-medium text-gray-500">পিতার নাম</label>
                        <p class="font-medium text-gray-900">{{ $selectedMember->father_name }}</p>
                    </div>
                    <div class="p-3 rounded bg-gray-50">
                        <label class="text-xs font-medium text-gray-500">জন্ম তারিখ</label>
                        <p class="font-medium text-gray-900">{{ $selectedMember->dob ? \Carbon\Carbon::parse($selectedMember->dob)->format('d M Y') : 'N/A' }}</p>
                    </div>
                    <div class="p-3 rounded bg-gray-50">
                        <label class="text-xs font-medium text-gray-500">ফোন</label>
                        <p class="font-medium text-gray-900">{{ $selectedMember->phone }}</p>
                    </div>
                    <div class="p-3 rounded bg-gray-50">
                        <label class="text-xs font-medium text-gray-500">রক্তের গ্রুপ</label>
                        <p class="font-medium text-gray-900">{{ $selectedMember->blood_group ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="mb-6">
                    <h4 class="mb-3 text-lg font-semibold text-gray-800">পেমেন্ট সামারি</h4>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-4 border border-green-200 rounded-lg bg-green-50">
                            <p class="text-sm font-medium text-green-600">মোট পরিশোধিত</p>
                            <p class="text-2xl font-bold text-green-700">৳{{ number_format($selectedMember->payments->where('status', 'approved')->sum('amount'), 2) }}</p>
                            <p class="text-xs text-green-600">{{ $selectedMember->payments->where('status', 'approved')->count() }} মাস</p>
                        </div>
                        <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                            <p class="text-sm font-medium text-yellow-600">অপেক্ষমাণ</p>
                            <p class="text-2xl font-bold text-yellow-700">৳{{ number_format($selectedMember->payments->where('status', 'pending')->sum('amount'), 2) }}</p>
                            <p class="text-xs text-yellow-600">{{ $selectedMember->payments->where('status', 'pending')->count() }} মাস</p>
                        </div>
                        <div class="p-4 border border-red-200 rounded-lg bg-red-50">
                            <p class="text-sm font-medium text-red-600">প্রত্যাখ্যাত</p>
                            <p class="text-2xl font-bold text-red-700">৳{{ number_format($selectedMember->payments->where('status', 'rejected')->sum('amount'), 2) }}</p>
                            <p class="text-xs text-red-600">{{ $selectedMember->payments->where('status', 'rejected')->count() }} মাস</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div>
                    <h4 class="mb-3 text-lg font-semibold text-gray-800">সাম্প্রতিক লেনদেন</h4>
                    @if($selectedMember->payments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-xs font-medium text-left text-gray-500">মাস</th>
                                    <th class="px-4 py-2 text-xs font-medium text-left text-gray-500">পরিমাণ</th>
                                    <th class="px-4 py-2 text-xs font-medium text-left text-gray-500">মাধ্যম</th>
                                    <th class="px-4 py-2 text-xs font-medium text-left text-gray-500">অবস্থা</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($selectedMember->payments->take(5) as $payment)
                                <tr>
                                    <td class="px-4 py-2 text-sm">{{ $payment->month }} {{ $payment->year }}</td>
                                    <td class="px-4 py-2 text-sm font-medium">৳{{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-4 py-2 text-sm">{{ $payment->method }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($payment->status === 'approved') bg-green-100 text-green-800
                                            @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $payment->status === 'approved' ? 'অনুমোদিত' : ($payment->status === 'pending' ? 'অপেক্ষমাণ' : 'প্রত্যাখ্যাত') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="py-4 text-center text-gray-500">কোনো লেনদেন নেই</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
