<div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap');

        * {
            font-family: 'Noto Serif Bengali', serif !important;
        }

        /* Custom scrollbar for terms content */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        html.dark .overflow-y-auto::-webkit-scrollbar-track {
            background: #374151;
        }

        html.dark .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #6b7280;
        }

        html.dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

    @if($showTerms)
        {{-- Terms and Conditions Page --}}
        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    @php
                        $orgLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
                        $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
                    @endphp
                    @if($orgLogo)
                        <img src="{{ asset('storage/' . $orgLogo) }}" alt="{{ $orgName }}" style="max-height: 80px; width: auto;">
                    @endif
                </div>

                <!-- Header -->
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2 text-center">শর্তাবলী এবং নিয়মাবলী</h2>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-6">সদস্য নিবন্ধনের আগে অনুগ্রহ করে নিচের শর্তাবলী পড়ুন এবং সম্মত হন</p>

                <!-- Terms Content -->
                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6 max-h-96 overflow-y-auto border border-gray-200 dark:border-gray-700">
                    <div class="prose dark:prose-invert max-w-none">
                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">১. সাধারণ শর্তাবলী</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            প্রজন্ম উন্নয়ন মিশনে সদস্য হিসেবে নিবন্ধন করার মাধ্যমে আপনি নিম্নলিখিত শর্তাবলী মেনে নিতে সম্মত হচ্ছেন। 
                            এই শর্তাবলী সংগঠনের নিয়ম-কানুন এবং আপনার দায়িত্ব ও অধিকার নির্ধারণ করে।
                        </p>

                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">২. সদস্যপদের যোগ্যতা</h3>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2">
                            <li>আবেদনকারীকে অবশ্যই বাংলাদেশী নাগরিক হতে হবে</li>
                            <li>ন্যূনতম বয়স ১৮ বছর হতে হবে</li>
                            <li>সকল তথ্য সঠিক এবং সত্য হতে হবে</li>
                            <li>সংগঠনের উদ্দেশ্য ও লক্ষ্যের সাথে একমত হতে হবে</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৩. সদস্যের দায়িত্ব</h3>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4 space-y-2">
                            <li>সংগঠনের নিয়ম-কানুন মেনে চলা</li>
                            <li>সংগঠনের কার্যক্রমে সক্রিয় অংশগ্রহণ করা</li>
                            <li>সংগঠনের সুনাম রক্ষা করা</li>
                            <li>নির্ধারিত সদস্য ফি যথাসময়ে পরিশোধ করা</li>
                            <li>প্রদত্ত তথ্য হালনাগাদ রাখা</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৪. গোপনীয়তা নীতি</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            আপনার ব্যক্তিগত তথ্য সম্পূর্ণ গোপনীয় রাখা হবে এবং শুধুমাত্র সংগঠনের অভ্যন্তরীণ কাজে ব্যবহার করা হবে। 
                            আপনার অনুমতি ছাড়া কোনো তথ্য তৃতীয় পক্ষের সাথে শেয়ার করা হবে না।
                        </p>

                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৫. সদস্যপদ বাতিল</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            সংগঠনের নিয়ম লঙ্ঘন, মিথ্যা তথ্য প্রদান, বা সংগঠনের সুনাম ক্ষুণ্ণ করার মতো কাজের জন্য 
                            প্রশাসন যে কোনো সময় সদস্যপদ বাতিল করার অধিকার সংরক্ষণ করে।
                        </p>

                        <h3 class="text-xl font-semibold mb-3 text-gray-900 dark:text-gray-100">৬. অনুমোদন প্রক্রিয়া</h3>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            নিবন্ধন আবেদন জমা দেওয়ার পর প্রশাসন আপনার তথ্য যাচাই করবে। অনুমোদন পেতে ৭-১৫ কার্যদিবস সময় লাগতে পারে। 
                            অনুমোদনের পর আপনি ইমেইল/ফোনে বিজ্ঞপ্তি পাবেন।
                        </p>
                    </div>
                </div>

                <!-- Error Message -->
                @error('termsAccepted')
                    <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
                        <p class="text-red-600 dark:text-red-400 text-sm">{{ $message }}</p>
                    </div>
                @enderror

                <!-- Acceptance Checkbox -->
                <div class="mb-6">
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" wire:model="termsAccepted" class="mt-1 h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-3 text-gray-700 dark:text-gray-300 text-base">
                            আমি উপরের সকল শর্তাবলী পড়েছি এবং সম্মত হয়েছি। আমি নিশ্চিত করছি যে আমার প্রদত্ত সকল তথ্য সঠিক এবং সত্য।
                        </span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('tyro-login.login') }}" class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                        ← লগইন পেজে ফিরে যান
                    </a>
                    <button wire:click="acceptTerms" type="button" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        সম্মত এবং এগিয়ে যান
                    </button>
                </div>
            </div>
        </div>
    @else
        {{-- Registration Form --}}
        <div class="max-w-4xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                <!-- Logo -->
                <div class="flex justify-center mb-6">
                    @php
                        $orgLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
                        $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
                    @endphp
                    @if($orgLogo)
                        <img src="{{ asset('storage/' . $orgLogo) }}" alt="{{ $orgName }}" style="max-height: 80px; width: auto;">
                    @endif
                </div>

                <!-- Header -->
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2 text-center">{{ $orgName }}</h2>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-2 text-center">সদস্য নিবন্ধন</h3>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-8">নিচের ফর্মটি পূরণ করে আপনার নিবন্ধন আবেদন জমা দিন</p>

                <form wire:submit.prevent="register" x-data="{ showPassword: false, showPasswordConfirmation: false }">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">নাম <span class="text-red-500">*</span></label>
                            <input wire:model="name" id="name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required autofocus autocomplete="name" placeholder="আপনার পূর্ণ নাম লিখুন" />
                            @error('name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">ফোন নম্বর <span class="text-red-500">*</span></label>
                            <input wire:model="phone" id="phone" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required autocomplete="tel" placeholder="01700000000" />
                            @error('phone') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Father's Name -->
                        <div>
                            <label for="father_name" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">পিতার নাম <span class="text-red-500">*</span></label>
                            <input wire:model="father_name" id="father_name" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required placeholder="পিতার পূর্ণ নাম" />
                            @error('father_name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label for="dob" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">জন্ম তারিখ <span class="text-red-500">*</span></label>
                            <input wire:model="dob" id="dob" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="date" required />
                            @error('dob') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Blood Group -->
                        <div>
                            <label for="blood_group" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">রক্তের গ্রুপ <span class="text-red-500">*</span></label>
                            <select wire:model="blood_group" id="blood_group" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            @error('blood_group') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Profession -->
                        <div>
                            <label for="profession" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">পেশা <span class="text-red-500">*</span></label>
                            <input wire:model="profession" id="profession" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required placeholder="আপনার পেশা লিখুন" />
                            @error('profession') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Religion -->
                        <div>
                            <label for="religion" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">ধর্ম <span class="text-red-500">*</span></label>
                            <select wire:model="religion" id="religion" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required>
                                <option value="">ধর্ম নির্বাচন করুন</option>
                                <option value="ইসলাম" selected>ইসলাম</option>
                                <option value="হিন্দু">হিন্দু</option>
                                <option value="খ্রিস্টান">খ্রিস্টান</option>
                                <option value="বৌদ্ধ">বৌদ্ধ</option>
                                <option value="অন্যান্য">অন্যান্য</option>
                            </select>
                            @error('religion') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nationality -->
                        <div>
                            <label for="nationality" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">জাতীয়তা <span class="text-red-500">*</span></label>
                            <input wire:model="nationality" id="nationality" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" type="text" required placeholder="বাংলাদেশী" />
                            @error('nationality') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Present Address -->
                    <div class="mt-6">
                        <label for="present_address" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">বর্তমান ঠিকানা <span class="text-red-500">*</span></label>
                        <textarea wire:model.live="present_address" id="present_address" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" required placeholder="আপনার বর্তমান ঠিকানা লিখুন"></textarea>
                        @error('present_address') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Same Address Checkbox -->
                    <div class="mt-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" wire:model.live="sameAddress" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">স্থায়ী ঠিকানা বর্তমান ঠিকানার মতো</span>
                        </label>
                    </div>

                    <!-- Permanent Address -->
                    <div class="mt-4">
                        <label for="permanent_address" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">স্থায়ী ঠিকানা <span class="text-red-500">*</span></label>
                        <textarea wire:model="permanent_address" id="permanent_address" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300 @if($sameAddress) bg-gray-100 dark:bg-gray-800 @endif" @if($sameAddress) disabled @endif required placeholder="আপনার স্থায়ী ঠিকানা লিখুন"></textarea>
                        @error('permanent_address') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Profile Picture -->
                    <div class="mt-6">
                        <label for="profile_pic" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">প্রোফাইল ছবি</label>
                        <input wire:model="profile_pic" id="profile_pic" type="file" accept="image/*" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300" />
                        @error('profile_pic') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="profile_pic" class="text-sm text-indigo-600 dark:text-indigo-400 mt-1">আপলোড হচ্ছে...</div>
                        
                        @if ($profile_pic)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">ছবি প্রিভিউ:</p>
                                <img src="{{ $profile_pic->temporaryUrl() }}" class="h-32 w-32 object-cover rounded-lg border-2 border-gray-300 dark:border-gray-600">
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">পাসওয়ার্ড <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input wire:model="password" id="password" class="w-full px-4 py-2.5 pr-12 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" :type="showPassword ? 'text' : 'password'" required autocomplete="new-password" placeholder="পাসওয়ার্ড লিখুন" />
                                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">পাসওয়ার্ড নিশ্চিত করুন <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input wire:model="password_confirmation" id="password_confirmation" class="w-full px-4 py-2.5 pr-12 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-300" :type="showPasswordConfirmation ? 'text' : 'password'" required autocomplete="new-password" placeholder="পাসওয়ার্ড পুনরায় লিখুন" />
                                <button type="button" @click="showPasswordConfirmation = !showPasswordConfirmation" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none">
                                    <svg x-show="!showPasswordConfirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPasswordConfirmation" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium" href="{{ route('tyro-login.login') }}" wire:navigate>
                            ইতিমধ্যে নিবন্ধিত আছেন?
                        </a>

                        <button type="submit" class="inline-flex items-center px-8 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-wider hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-md">
                            নিবন্ধন করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div wire:loading wire:target="register" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
            <div class="flex flex-col items-center p-8 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl">
                <!-- Spinner -->
                <div class="relative w-16 h-16">
                    <div class="absolute inset-0 border-4 border-indigo-200 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-transparent border-t-indigo-600 rounded-full animate-spin"></div>
                </div>
                <!-- Loading Text -->
                <p class="mt-4 text-lg font-semibold text-gray-700 dark:text-gray-200">নিবন্ধন হচ্ছে...</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">অনুগ্রহ করে অপেক্ষা করুন</p>
            </div>
        </div>
    @endif
</div>
