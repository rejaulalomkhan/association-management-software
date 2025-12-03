<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">রোল ম্যানেজমেন্ট</h1>
            <p class="text-sm text-gray-600 mt-1">রোল তৈরি, সম্পাদনা এবং প্রিভিলেজ বরাদ্দ করুন</p>
        </div>
        <button wire:click="openCreateModal" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            নতুন রোল তৈরি করুন
        </button>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <!-- Search -->
    <div class="bg-white rounded-lg shadow-md p-4">
        <input wire:model.live="search" type="text" placeholder="রোল খুঁজুন..."
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>

    <!-- Roles Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">নাম</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">স্লাগ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">বিবরণ</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ব্যবহারকারী</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">কার্যক্রম</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($roles as $role)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $role->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">{{ $role->slug }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $role->description ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded">{{ $role->users_count }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                <button wire:click="openEditModal({{ $role->id }})" class="text-blue-600 hover:text-blue-900" title="সম্পাদনা">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button wire:click="openPrivilegeModal({{ $role->id }})" class="text-green-600 hover:text-green-900" title="প্রিভিলেজ">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </button>
                                <button wire:click="deleteRole({{ $role->id }})" wire:confirm="আপনি কি এই রোল মুছে ফেলতে চান?" class="text-red-600 hover:text-red-900" title="মুছে ফেলুন">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            কোনো রোল পাওয়া যায়নি
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50">
            {{ $roles->links() }}
        </div>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showModal') }" x-show="show" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="show = false"></div>

                <div class="bg-white rounded-lg shadow-xl max-w-lg w-full z-50 p-6">
                    <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'রোল সম্পাদনা করুন' : 'নতুন রোল তৈরি করুন' }}</h3>

                    <form wire:submit.prevent="save">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">নাম *</label>
                                <input wire:model="name" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">স্লাগ * (lowercase, hyphen allowed)</label>
                                <input wire:model="slug" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">বিবরণ</label>
                                <textarea wire:model="description" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                বাতিল
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                {{ $isEditing ? 'আপডেট করুন' : 'তৈরি করুন' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Privilege Assignment Modal -->
    @if($showPrivilegeModal && $selectedRoleForPrivileges)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showPrivilegeModal') }" x-show="show" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" @click="show = false"></div>

                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full z-50 p-6 max-h-[90vh] overflow-y-auto">
                    <h3 class="text-lg font-semibold mb-4">প্রিভিলেজ বরাদ্দ করুন: {{ $selectedRoleForPrivileges->name }}</h3>

                    <div class="space-y-2 mb-6">
                        @foreach($allPrivileges as $privilege)
                            <label class="flex items-center space-x-3 p-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <input type="checkbox" wire:model="selectedPrivileges" value="{{ $privilege->id }}"
                                       class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $privilege->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $privilege->slug }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button wire:click="closePrivilegeModal" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            বাতিল
                        </button>
                        <button wire:click="savePrivileges" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            সংরক্ষণ করুন
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
