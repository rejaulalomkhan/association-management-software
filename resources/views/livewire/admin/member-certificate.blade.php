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

        <!-- Member Information Section -->
        <div class="p-8">
            <div class="flex items-start justify-between mb-6">
                <div class="flex-1 mr-6">
                    <div class="flex items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mr-4">সদস্যের স্টেটাস:</h2>
                        <span class="px-4 py-2 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full font-semibold text-sm">
                            একটিভ
                        </span>
                    </div>

                    @if($member->membership_id)
                    <div class="bg-indigo-50 dark:bg-indigo-900/20 border-l-4 border-indigo-500 p-4 rounded-r-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-indigo-500 mt-1 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                            <div>
                                <h4 class="text-base font-semibold text-indigo-900 dark:text-indigo-200 mb-1">সদস্য নম্বর</h4>
                                <p class="text-lg font-bold text-indigo-800 dark:text-indigo-300">
                                    {{ $member->membership_id }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Profile Picture -->
                <div class="ml-6 flex-shrink-0">
                    @if($member->profile_pic)
                        <img src="{{ asset('storage/' . $member->profile_pic) }}" 
                             alt="{{ $member->name }}" 
                             class="w-32 h-32 object-cover rounded-lg border-4 border-indigo-200 dark:border-indigo-700 shadow-lg">
                    @else
                        <div class="w-32 h-32 flex items-center justify-center bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900 dark:to-purple-900 rounded-lg border-4 border-indigo-200 dark:border-indigo-700 shadow-lg">
                            <span class="text-4xl font-bold text-indigo-600 dark:text-indigo-300">{{ strtoupper(substr($member->name, 0, 2)) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Member Details Table -->
            <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">সদস্যের তথ্য</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">নাম:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">পিতার নাম:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->father_name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">জন্ম তারিখ:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ \Carbon\Carbon::parse($member->dob)->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">ফোন:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->phone }}</span>
                    </div>
                    @if($member->blood_group)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">রক্তের গ্রুপ:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->blood_group }}</span>
                    </div>
                    @endif
                    @if($member->profession)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">পেশা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->profession }}</span>
                    </div>
                    @endif
                    @if($member->religion)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">ধর্ম:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->religion }}</span>
                    </div>
                    @endif
                    @if($member->nationality)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">জাতীয়তা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->nationality }}</span>
                    </div>
                    @endif
                    @if($member->present_address)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">বর্তমান ঠিকানা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->present_address }}</span>
                    </div>
                    @endif
                    @if($member->permanent_address)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">স্থায়ী ঠিকানা:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->permanent_address }}</span>
                    </div>
                    @endif
                    @if($member->position)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">পদবী:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ $member->position }}</span>
                    </div>
                    @endif
                    @if($member->joined_at)
                    <div class="flex border-b border-gray-200 dark:border-gray-700 pb-3 md:col-span-2">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-40">যোগদানের তারিখ:</span>
                        <span class="text-gray-900 dark:text-gray-100 ml-2">{{ \Carbon\Carbon::parse($member->joined_at)->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-6 text-center print:hidden">
                <a href="{{ route('admin.members') }}" wire:navigate
                   class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    ফিরে যান
                </a>
                <button onclick="window.print()" 
                   class="ml-3 inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition-colors duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    প্রিন্ট করুন
                </button>
            </div>
        </div>
    </div>
</div>
