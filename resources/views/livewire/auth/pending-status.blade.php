<div class="max-w-4xl mx-auto">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap');

        * {
            font-family: 'Noto Serif Bengali', serif !important;
        }
    </style>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Organization Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-4 text-white">
            <div class="flex items-center mb-4">
                @php
                    $orgLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
                    $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
                    $orgAddress = app(\App\Services\SettingsService::class)->get('organization_address', '');
                    $orgPhone = app(\App\Services\SettingsService::class)->get('organization_phone', '');
                @endphp
                @if($orgLogo)
                    <div class="bg-white rounded-lg p-3 mr-6 shadow-md">
                        <img src="{{ asset('storage/' . $orgLogo) }}" alt="{{ $orgName }}" class="h-16 w-auto">
                    </div>
                @endif
                <div class="flex-1 ml-2">
                    <h1 class="text-3xl font-bold mb-2">{{ $orgName }}</h1>
                    @if($orgAddress)
                        <p class="text-indigo-100 mb-1">{{ $orgAddress }}</p>
                    @endif
                    @if($orgPhone)
                        <p class="text-indigo-100">ফোন: {{ $orgPhone }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

        <!-- User Information Section -->
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1 mr-6">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mr-4">আবেদনের স্টেটাস:</h2>
                        <span class="px-4 py-2 bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full font-semibold text-sm">
                            অপেক্ষমাণ
                        </span>
                    </div>

                    <!-- Notification Message -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-4 rounded-r-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-500 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h4 class="text-base font-semibold text-blue-900 dark:text-blue-200 mb-1">গুরুত্বপূর্ণ বিজ্ঞপ্তি</h4>
                                <p class="text-sm text-blue-800 dark:text-blue-300 leading-relaxed">
                                    আপনার সদস্য নিবন্ধন সংগঠনের প্রশাসন টিমের সিদ্ধান্তক্রমে অনুমোদন হলে আপনি লগিন করতে পারবেন। 
                                    আপনার অপেক্ষার জন্য অসংখ্য ধন্যবাদ।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Picture -->
                @if($user->profile_pic)
                    <div class="ml-6">
                        <img src="{{ asset('storage/' . $user->profile_pic) }}" 
                             alt="{{ $user->name }}" 
                             class="w-32 h-32 object-cover rounded-lg border-4 border-indigo-200 dark:border-indigo-700 shadow-lg">
                    </div>
                @endif
            </div>

            <!-- User Details Table -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">আবেদনকারীর তথ্য</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">নাম:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">পিতার নাম:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->father_name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">জন্ম তারিখ:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ \Carbon\Carbon::parse($user->dob)->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">ফোন:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->phone }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">রক্তের গ্রুপ:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->blood_group }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">পেশা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->profession }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">ধর্ম:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->religion }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">জাতীয়তা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->nationality }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">বর্তমান ঠিকানা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->present_address }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">স্থায়ী ঠিকানা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->permanent_address }}</span>
                    </div>
                    @if($user->position)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">পদবী:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $user->position }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Back to Login Button -->
            <div class="mt-6 text-center">
                <a href="{{ route('tyro-login.login') }}" 
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    লগিন পেজে ফিরে যান
                </a>
            </div>
        </div>
    </div>
</div>
