<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">অপেক্ষমাণ নিবন্ধন</h1>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        @if($pendingUsers->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ছবি</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">নাম</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ফোন</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ইমেইল</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">আবেদনের তারিখ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">কার্যক্রম</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pendingUsers as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->profile_pic)
                                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="{{ $user->name }}"
                                    class="h-10 w-10 rounded-full object-cover">
                            @else
                                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <span class="text-indigo-600 font-medium text-sm">{{ substr($user->name, 0, 2) }}</span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            <div class="text-sm text-gray-500">পিতা: {{ $user->father_name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->phone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                            <button wire:click="viewDetails({{ $user->id }})"
                                class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                বিস্তারিত
                            </button>
                            <button wire:click="approveMember({{ $user->id }})"
                                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                অনুমোদন
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200">
            {{ $pendingUsers->links() }}
        </div>
        @else
        <div class="px-6 py-12 text-center text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <p class="mt-4 text-lg">কোনো অপেক্ষমাণ নিবন্ধন নেই</p>
        </div>
        @endif
    </div>

    <!-- Details Modal -->
    @if($showModal && $selectedUser)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-gray-800">সদস্যের বিস্তারিত তথ্য</h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <!-- Profile Photo -->
                    <div class="flex justify-center">
                        @if($selectedUser->profile_pic)
                            <img src="{{ asset('storage/' . $selectedUser->profile_pic) }}" alt="{{ $selectedUser->name }}"
                                class="h-24 w-24 rounded-full object-cover">
                        @else
                            <div class="h-24 w-24 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-indigo-600 font-medium text-2xl">{{ substr($selectedUser->name, 0, 2) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">নাম</label>
                            <p class="text-gray-900">{{ $selectedUser->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">পিতার নাম</label>
                            <p class="text-gray-900">{{ $selectedUser->father_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">ফোন</label>
                            <p class="text-gray-900">{{ $selectedUser->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">ইমেইল</label>
                            <p class="text-gray-900">{{ $selectedUser->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">জন্ম তারিখ</label>
                            <p class="text-gray-900">{{ $selectedUser->dob ? \Carbon\Carbon::parse($selectedUser->dob)->format('d M Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">রক্তের গ্রুপ</label>
                            <p class="text-gray-900">{{ $selectedUser->blood_group ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">পেশা</label>
                            <p class="text-gray-900">{{ $selectedUser->profession ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">ধর্ম</label>
                            <p class="text-gray-900">{{ $selectedUser->religion ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">জাতীয়তা</label>
                            <p class="text-gray-900">{{ $selectedUser->nationality ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium text-gray-500">বর্তমান ঠিকানা</label>
                            <p class="text-gray-900">{{ $selectedUser->present_address ?? 'N/A' }}</p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium text-gray-500">স্থায়ী ঠিকানা</label>
                            <p class="text-gray-900">{{ $selectedUser->permanent_address ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Rejection Reason (if rejecting) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">প্রত্যাখ্যানের কারণ (ঐচ্ছিক)</label>
                        <textarea wire:model="rejectionReason" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                            placeholder="সদস্য প্রত্যাখ্যান করলে কারণ লিখুন..."></textarea>
                        @error('rejectionReason') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3 pt-4">
                        <button wire:click="approveMember({{ $selectedUser->id }})"
                            class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            ✓ অনুমোদন করুন
                        </button>
                        <button wire:click="rejectMember({{ $selectedUser->id }})"
                            class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            ✗ প্রত্যাখ্যান করুন
                        </button>
                        <button wire:click="closeModal"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            বন্ধ করুন
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
