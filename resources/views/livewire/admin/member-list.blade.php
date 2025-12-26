<div class="space-y-6">
    <!-- Total Member Count Card -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-indigo-100 text-sm font-medium">মোট সক্রিয় সদস্য</p>
                <h2 class="text-4xl font-bold mt-1">{{ $totalMembers }} জন</h2>
            </div>
            <div class="p-4 bg-white bg-opacity-20 rounded-full">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

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
                    <tr class="hover:bg-gray-50">
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
                                <a href="{{ route('admin.members.view', $member->id) }}" 
                                   wire:navigate
                                   class="text-indigo-600 hover:text-indigo-900">
                                    প্রোফাইল →
                                </a>
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
</div>
