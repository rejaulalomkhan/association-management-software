<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">প্রোফাইল সম্পাদনা</h1>
        <a href="{{ route('member.dashboard') }}" wire:navigate
            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
            ← ফিরে যান
        </a>
    </div>

    @if (session()->has('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <!-- Profile Picture Section -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                প্রোফাইল ছবি
            </h2>

            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                <div>
                    @if ($new_profile_pic)
                        <img src="{{ $new_profile_pic->temporaryUrl() }}" alt="Preview"
                            class="w-32 h-32 rounded-full object-cover ring-4 ring-indigo-100">
                    @elseif ($profile_pic)
                        <img src="{{ asset('storage/' . $profile_pic) }}" alt="Profile"
                            class="w-32 h-32 rounded-full object-cover ring-4 ring-gray-100">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-indigo-400 to-purple-400 flex items-center justify-center ring-4 ring-gray-100">
                            <span class="text-white font-bold text-4xl">{{ substr($name, 0, 2) }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">নতুন ছবি আপলোড করুন</label>
                    <input type="file" wire:model="new_profile_pic" accept="image/*"
                        class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-lg file:border-0
                            file:text-sm file:font-semibold
                            file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100 cursor-pointer">
                    @error('new_profile_pic')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror

                    @if ($new_profile_pic)
                        <p class="text-sm text-green-600 mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            নতুন ছবি নির্বাচিত হয়েছে
                        </p>
                    @endif

                    <p class="text-xs text-gray-500 mt-1">JPG, PNG বা GIF (সর্বোচ্চ 2MB)</p>
                </div>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                মৌলিক তথ্য
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">পূর্ণ নাম *</label>
                    <input type="text" wire:model="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">পিতার নাম</label>
                    <input type="text" wire:model="father_name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('father_name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ইমেইল *</label>
                    <input type="email" wire:model="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ফোন *</label>
                    <input type="text" wire:model="phone"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('phone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">জন্ম তারিখ</label>
                    <input type="date" wire:model="dob"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('dob') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">রক্তের গ্রুপ</label>
                    <select wire:model="blood_group"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
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
                    @error('blood_group') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">পেশা</label>
                    <input type="text" wire:model="profession"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('profession') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">পদবী</label>
                    <input type="text" wire:model="position"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('position') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ধর্ম</label>
                    <select wire:model="religion"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">নির্বাচন করুন</option>
                        <option value="Islam">ইসলাম</option>
                        <option value="Hinduism">হিন্দু</option>
                        <option value="Buddhism">বৌদ্ধ</option>
                        <option value="Christianity">খ্রিস্টান</option>
                        <option value="Other">অন্যান্য</option>
                    </select>
                    @error('religion') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">জাতীয়তা</label>
                    <input type="text" wire:model="nationality" value="Bangladeshi"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('nationality') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                ঠিকানা
            </h2>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-gray-700">
                            স্থায়ী @if($same_address) এবং বর্তমান @endif ঠিকানা
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="same_address" wire:change="$refresh"
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2">
                            <span class="text-sm text-gray-700 font-medium">স্থায়ী এবং বর্তমান ঠিকানা একই</span>
                        </label>
                    </div>
                    <textarea wire:model.live="permanent_address" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                    @error('permanent_address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                @if(!$same_address)
                <div wire:key="present-address-field">
                    <label class="block text-sm font-medium text-gray-700 mb-2">বর্তমান ঠিকানা</label>
                    <textarea wire:model.defer="present_address" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                    @error('present_address') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>
        </div>

        <!-- Change Password -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                পাসওয়ার্ড পরিবর্তন
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">বর্তমান পাসওয়ার্ড</label>
                    <input type="password" wire:model="current_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('current_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">নতুন পাসওয়ার্ড</label>
                    <input type="password" wire:model="new_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('new_password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input type="password" wire:model="new_password_confirmation"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('new_password_confirmation') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <p class="text-sm text-gray-500 mt-2">* পাসওয়ার্ড পরিবর্তন করতে না চাইলে এই ফিল্ডগুলো খালি রাখুন</p>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('member.dashboard') }}" wire:navigate
                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                বাতিল করুন
            </a>
            <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-medium hover:from-indigo-700 hover:to-purple-700 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                পরিবর্তন সংরক্ষণ করুন
            </button>
        </div>
    </form>
</div>
