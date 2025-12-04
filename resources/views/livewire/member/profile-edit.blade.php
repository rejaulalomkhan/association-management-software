<div class="py-6">
    <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
        <!-- Success Messages -->
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('password_message'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                {{ session('password_message') }}
            </div>
        @endif

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ role_route('profile') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                প্রোফাইলে ফিরে যান
            </a>
        </div>

        <!-- Profile Edit Form -->
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    প্রোফাইল সম্পাদনা
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    আপনার প্রোফাইলের তথ্য আপডেট করুন
                </p>
            </div>

            <form wire:submit="updateProfile" class="p-6 space-y-6">
                <!-- Profile Photo -->
                <div class="flex flex-col items-center space-y-4" x-data="{ photoPreview: null }">
                    <div class="relative">
                        <template x-if="photoPreview">
                            <img :src="photoPreview" alt="Preview" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                        </template>
                        <template x-if="!photoPreview">
                            @if(auth()->user()->photo)
                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                            @else
                                <div class="flex items-center justify-center w-32 h-32 text-4xl font-bold text-white bg-blue-500 border-4 border-gray-300 rounded-full">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </template>

                        <!-- Loading indicator -->
                        <div wire:loading wire:target="photo" class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 rounded-full">
                            <svg class="w-8 h-8 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <label class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700">
                            <span wire:loading.remove wire:target="photo">ছবি নির্বাচন করুন</span>
                            <span wire:loading wire:target="photo">আপলোড হচ্ছে...</span>
                            <input type="file" wire:model="photo" class="hidden" accept="image/*"
                                   @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                        </label>
                        @error('photo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-center text-gray-500 dark:text-gray-400">সর্বোচ্চ ২MB</p>
                    </div>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নাম *</label>
                    <input type="text" wire:model="name" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Email and Phone -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ইমেইল</label>
                        <input type="email" wire:model="email" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ফোন *</label>
                        <input type="text" wire:model="phone" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Profession, Religion, Nationality, Position -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">পেশা</label>
                        <input type="text" wire:model="profession" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('profession') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ধর্ম</label>
                        <input type="text" wire:model="religion" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('religion') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">জাতীয়তা</label>
                        <input type="text" wire:model="nationality" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('nationality') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">পদবী</label>
                        <input type="text" wire:model="position" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        @error('position') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Blood Group -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">রক্তের গ্রুপ</label>
                    <select wire:model="blood_group" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <option value="">নির্বাচন করুন</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                    @error('blood_group') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Addresses -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">স্থায়ী ঠিকানা</label>
                    <div class="mb-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="same_address" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mr-2">
                            <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">স্থায়ী এবং বর্তমান ঠিকানা একই</span>
                        </label>
                    </div>
                    <textarea wire:model="permanent_address" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('permanent_address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                @if(!$same_address)
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">বর্তমান ঠিকানা</label>
                    <textarea wire:model="present_address" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('present_address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                @endif

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ role_route('profile') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                        বাতিল
                    </a>
                    <button type="submit" wire:loading.attr="disabled" wire:target="updateProfile,photo" class="relative px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="updateProfile">সংরক্ষণ করুন</span>
                        <span wire:loading wire:target="updateProfile" class="flex items-center">
                            <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            সংরক্ষণ হচ্ছে...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Password Change Section -->
        <div class="mt-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">
                    পাসওয়ার্ড পরিবর্তন
                </h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    আপনার পাসওয়ার্ড আপডেট করুন
                </p>
            </div>

            <form wire:submit="updatePassword" class="p-6 space-y-4">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">বর্তমান পাসওয়ার্ড *</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" wire:model="current_password" class="block w-full py-2 pl-10 pr-3 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    @error('current_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড *</label>
                    <input type="password" wire:model="new_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                    @error('new_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">কমপক্ষে ৮ অক্ষর</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">পাসওয়ার্ড নিশ্চিত করুন *</label>
                    <input type="password" wire:model="new_password_confirmation" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" wire:loading.attr="disabled" wire:target="updatePassword" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span wire:loading.remove wire:target="updatePassword">পাসওয়ার্ড পরিবর্তন করুন</span>
                        <span wire:loading wire:target="updatePassword" class="flex items-center">
                            <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            পরিবর্তন হচ্ছে...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
