<div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="mb-6 text-2xl font-bold">আমার প্রোফাইল</h2>

                @if (session()->has('message'))
                    <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Profile View/Edit Section -->
                <div class="p-6 mb-6 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">ব্যক্তিগত তথ্য</h3>
                        <button wire:click="toggleEditMode" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            @if($editMode)
                                বাতিল করুন
                            @else
                                সম্পাদনা করুন
                            @endif
                        </button>
                    </div>

                    @if(!$editMode)
                        <!-- View Mode -->
                        <div class="flex items-start space-x-6">
                            <div class="flex-shrink-0">
                                @if(auth()->user()->photo)
                                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                                @else
                                    <div class="flex items-center justify-center w-32 h-32 text-4xl font-bold text-white bg-blue-500 border-4 border-gray-300 rounded-full">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">নাম</label>
                                    <p class="mt-1 text-lg">{{ auth()->user()->name }}</p>
                                </div>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">ইমেইল</label>
                                        <p class="mt-1">{{ auth()->user()->email ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">ফোন</label>
                                        <p class="mt-1">{{ auth()->user()->phone }}</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">ঠিকানা</label>
                                    <p class="mt-1">{{ auth()->user()->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Edit Mode -->
                        <form wire:submit.prevent="updateProfile">
                            <div class="space-y-4">
                                <div class="flex items-start space-x-6">
                                    <div class="flex-shrink-0">
                                        @if($photo)
                                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                                        @elseif(auth()->user()->photo)
                                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                                        @else
                                            <div class="flex items-center justify-center w-32 h-32 text-4xl font-bold text-white bg-blue-500 border-4 border-gray-300 rounded-full">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <input type="file" wire:model="photo" class="mt-2 text-sm" accept="image/*">
                                        @error('photo') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="flex-1 space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নাম *</label>
                                            <input type="text" wire:model="name" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                            @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ইমেইল</label>
                                                <input type="email" wire:model="email" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                                @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ফোন *</label>
                                                <input type="text" wire:model="phone" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                                @error('phone') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ঠিকানা</label>
                                            <textarea wire:model="address" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                                            @error('address') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="px-6 py-2 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700">
                                        সংরক্ষণ করুন
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>

                <!-- Change Password Section -->
                <div class="p-6 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <h3 class="mb-4 text-lg font-semibold">পাসওয়ার্ড পরিবর্তন</h3>

                    @if (session()->has('password_message'))
                        <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                            {{ session('password_message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="updatePassword">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">বর্তমান পাসওয়ার্ড *</label>
                                <input type="password" wire:model="current_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                @error('current_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড *</label>
                                    <input type="password" wire:model="new_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                    @error('new_password') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড নিশ্চিত করুন *</label>
                                    <input type="password" wire:model="new_password_confirmation" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    পাসওয়ার্ড পরিবর্তন করুন
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
