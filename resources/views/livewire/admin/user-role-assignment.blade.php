<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">ব্যবহারকারী রোল ব্যবস্থাপনা</h1>
        <p class="mt-1 text-gray-600 dark:text-gray-400">ব্যবহারকারীদের রোল নির্ধারণ ও পরিবর্তন করুন</p>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900 dark:text-red-200 dark:border-red-800">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search Bar -->
    <div class="mb-6">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="নাম, ইমেইল, ফোন বা মেম্বারশিপ আইডি দিয়ে খুঁজুন..." 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
    </div>

    <!-- Users Table -->
    <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">ব্যবহারকারী</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">মেম্বারশিপ আইডি</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">বর্তমান রোল</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-gray-300">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($user->profile_picture)
                                        <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }}" class="w-10 h-10 mr-3 rounded-full">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 mr-3 text-white bg-gray-400 rounded-full">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->phone }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->membership_id ?? 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($user->roles as $role)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($role->name === 'admin' || $role->name === 'super-admin')
                                                bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                            @elseif($role->name === 'accountant')
                                                bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                            @else
                                                bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                            @endif
                                        ">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-500 dark:text-gray-400">কোনো রোল নেই</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                <button 
                                    wire:click="openRoleModal({{ $user->id }})"
                                    class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    রোল পরিবর্তন
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">কোনো ব্যবহারকারী পাওয়া যায়নি</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Role Assignment Modal -->
    @if($showModal && $selectedUser)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto">
            <!-- Background Overlay -->
            <div 
                wire:click="closeModal"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 dark:bg-gray-900 dark:bg-opacity-75"
            ></div>

            <!-- Modal Content -->
            <div class="relative z-50 w-full max-w-lg mx-4 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <!-- Modal Header -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">রোল নির্ধারণ করুন</h3>
                        <button 
                            wire:click="closeModal"
                            type="button"
                            class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4 max-h-96 overflow-y-auto">
                    <!-- User Info -->
                    <div class="p-3 mb-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                        <div class="flex items-center">
                            @if($selectedUser->profile_picture)
                                <img src="{{ Storage::url($selectedUser->profile_picture) }}" alt="{{ $selectedUser->name }}" class="w-12 h-12 mr-3 rounded-full">
                            @else
                                <div class="flex items-center justify-center w-12 h-12 mr-3 text-white bg-gray-400 rounded-full">
                                    {{ strtoupper(substr($selectedUser->name, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">{{ $selectedUser->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $selectedUser->email }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Roles Selection -->
                    <div class="space-y-2">
                        <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">রোল নির্বাচন করুন (একাধিক নির্বাচন করতে পারবেন):</label>
                        @foreach($allRoles as $role)
                            <label class="flex items-center p-3 transition-colors border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700">
                                <input 
                                    type="checkbox" 
                                    wire:model="selectedRoles" 
                                    value="{{ $role->id }}"
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-600"
                                >
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ ucfirst($role->name) }}
                                </span>
                                @if($role->description)
                                    <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">({{ $role->description }})</span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="flex gap-3">
                        <button 
                            wire:click="saveRoles"
                            type="button"
                            class="flex-1 px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <span wire:loading.remove wire:target="saveRoles">সংরক্ষণ করুন</span>
                            <span wire:loading wire:target="saveRoles">সংরক্ষণ হচ্ছে...</span>
                        </button>
                        <button 
                            wire:click="closeModal"
                            type="button"
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-200 dark:border-gray-500 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500"
                        >
                            বাতিল করুন
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
