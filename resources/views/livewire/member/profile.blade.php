<div class="py-2 sm:py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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

        <!-- Profile Card -->
        <div class="mb-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 rounded-none sm:rounded-lg w-full">
            <div class="p-2 sm:p-6 w-full">
                <!-- Mobile View: Horizontal Card Layout -->
                <div class="flex gap-3 items-start w-full sm:hidden relative overflow-hidden">
                    <!-- Background Logo -->
                    @php
                        $bgLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
                    @endphp
                    @if($bgLogo)
                    <div class="absolute inset-0 flex items-center justify-center opacity-[0.1] pointer-events-none">
                        <img src="{{ asset('storage/' . $bgLogo) }}" alt="Background" class="w-32 h-32 object-contain">
                    </div>
                    @endif

                    <!-- Edit Icon Button (Top Right) -->
                    <a href="{{ role_route('profile.edit') }}" wire:navigate class="absolute top-0 right-0 z-50 flex items-center justify-center w-8 h-8 text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>

                    <!-- Profile Picture with Contact Icons -->
                    <div class="flex-shrink-0 relative z-10">
                        @if(auth()->user()->profile_pic)
                            <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="{{ auth()->user()->name }}" class="object-cover w-20 h-20 border-2 border-gray-300 rounded-full">
                        @else
                            <div class="flex items-center justify-center w-16 h-16 text-xl font-bold text-white bg-blue-500 border-2 border-gray-300 rounded-full">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <!-- Quick Contact Icons Below Picture -->
                        @if(auth()->user()->phone)
                        <div class="flex justify-center gap-2 mt-2">
                            @php
                                $orgName = app(\App\Services\SettingsService::class)->get('organization_name', 'প্রজন্ম উন্নয়ন মিশন');
                                $message = urlencode("হেলো " . auth()->user()->name . ",\n" . $orgName . " থেকে যোগাযোগ করছি।");
                            @endphp
                            <a href="https://wa.me/88{{ preg_replace('/[^0-9]/', '', auth()->user()->phone) }}?text={{ $message }}" target="_blank" class="flex items-center justify-center w-7 h-7 text-white transition-colors bg-green-500 rounded-full hover:bg-green-600" title="WhatsApp">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                            <a href="tel:{{ auth()->user()->phone }}" class="flex items-center justify-center w-7 h-7 text-white transition-colors bg-blue-500 rounded-full hover:bg-blue-600" title="কল করুন">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- User Info -->
                    <div class="flex-1 min-w-0 relative z-10">
                        <div class="flex items-center gap-2 mb-1">
                            <h2 class="text-base font-bold text-gray-900 dark:text-gray-100 truncate">{{ auth()->user()->name }}</h2>
                            @if(auth()->user()->blood_group)
                            <span class="inline-flex items-center px-1.5 py-0.5 text-xs font-semibold text-red-700 bg-red-100 rounded dark:bg-red-900 dark:text-red-200">
                                🩸{{ auth()->user()->blood_group }}
                            </span>
                            @endif
                        </div>

                        <div class="space-y-0.5 text-xs text-gray-700 dark:text-gray-300">
                            @if(auth()->user()->position || auth()->user()->profession)
                            <p class="flex items-center">
                                <svg class="w-3 h-3 mr-1 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="truncate">
                                    @if(auth()->user()->position){{ auth()->user()->position }}@endif
                                    @if(auth()->user()->position && auth()->user()->profession) • @endif
                                    @if(auth()->user()->profession){{ auth()->user()->profession }}@endif
                                </span>
                            </p>
                            @endif
                            @if(auth()->user()->phone)
                            <p class="flex items-center">
                                <svg class="w-3 h-3 mr-1 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="font-medium mr-1">ফোন:</span>
                                <a href="tel:{{ auth()->user()->phone }}" class="text-blue-600 hover:underline dark:text-blue-400 truncate">{{ auth()->user()->phone }}</a>
                            </p>
                            @endif
                            @if(auth()->user()->email)
                            <p class="flex items-center">
                                <svg class="w-3 h-3 mr-1 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium mr-1">ইমেইল:</span>
                                <a href="mailto:{{ auth()->user()->email }}" class="text-purple-600 hover:underline dark:text-purple-400 truncate">{{ auth()->user()->email }}</a>
                            </p>
                            @endif
                            @if(auth()->user()->permanent_address)
                            <p class="flex items-start">
                                <svg class="w-3 h-3 mr-1 mt-0.5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium mr-1">স্থায়ী ঠিকানা:</span>
                                <span class="flex-1">{{ auth()->user()->permanent_address }}</span>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Desktop View: Original Layout -->
                <div class="hidden sm:flex flex-col gap-3 items-center text-center w-full sm:flex-row sm:text-left sm:items-start sm:gap-6">
                    <!-- Profile Picture -->
                    <div class="flex-shrink-0 w-full sm:w-auto flex flex-col items-center">
                        @if(auth()->user()->profile_pic)
                            <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="{{ auth()->user()->name }}" class="object-cover w-20 h-20 border-4 border-gray-300 rounded-full sm:w-24 sm:h-24">
                        @else
                            <div class="flex items-center justify-center w-20 h-20 text-2xl font-bold text-white bg-blue-500 border-4 border-gray-300 rounded-full sm:w-24 sm:h-24 sm:text-3xl">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        @if(auth()->user()->phone)
                        <!-- Quick Contact Icons -->
                        <div class="flex justify-center gap-2 mt-2">
                            @php
                                $orgName = app(\App\Services\SettingsService::class)->get('organization_name', 'প্রজন্ম উন্নয়ন মিশন');
                                $message = urlencode("হেলো " . auth()->user()->name . ",\n" . $orgName . " থেকে যোগাযোগ করছি।");
                            @endphp
                            <a href="https://wa.me/88{{ preg_replace('/[^0-9]/', '', auth()->user()->phone) }}?text={{ $message }}" target="_blank" class="flex items-center justify-center w-8 h-8 text-white transition-colors bg-green-500 rounded-full hover:bg-green-600" title="WhatsApp">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                            <a href="tel:{{ auth()->user()->phone }}" class="flex items-center justify-center w-8 h-8 text-white transition-colors bg-blue-500 rounded-full hover:bg-blue-600" title="কল করুন">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1 w-full">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center justify-center gap-1 sm:justify-start">
                                    <h2 class="text-lg sm:text-2xl font-bold text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</h2>
                                    @if(auth()->user()->blood_group)
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs sm:text-sm font-semibold text-red-700 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-200">
                                        🩸 {{ auth()->user()->blood_group }}
                                    </span>
                                    @endif
                                </div>
                                @if(auth()->user()->membership_id)
                                <p class="mt-1 text-xs sm:text-sm text-center text-gray-600 sm:text-left dark:text-gray-400">সদস্য আইডি: <span class="font-mono font-semibold">{{ auth()->user()->membership_id }}</span></p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-2 space-y-1 text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                            @if(auth()->user()->position || auth()->user()->profession)
                            <p class="flex items-center justify-center text-center sm:justify-start sm:text-left">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                @if(auth()->user()->position)
                                    <span class="font-medium">{{ auth()->user()->position }}</span>
                                @endif
                                @if(auth()->user()->position && auth()->user()->profession)
                                    <span class="mx-2">•</span>
                                @endif
                                @if(auth()->user()->profession)
                                    <span>{{ auth()->user()->profession }}</span>
                                @endif
                            </p>
                            @endif
                            @if(auth()->user()->phone)
                            <p class="flex items-center justify-center text-center sm:justify-start sm:text-left">
                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="font-medium">ফোন:</span>
                                <a href="tel:{{ auth()->user()->phone }}" class="ml-1 text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-400 dark:hover:text-blue-300">{{ auth()->user()->phone }}</a>
                            </p>
                            @endif
                            @if(auth()->user()->email)
                            <p class="flex items-center justify-center text-center sm:justify-start sm:text-left">
                                <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">ইমেইল:</span>
                                <a href="mailto:{{ auth()->user()->email }}" class="ml-1 text-purple-600 break-all hover:text-purple-800 hover:underline dark:text-purple-400 dark:hover:text-purple-300">{{ auth()->user()->email }}</a>
                            </p>
                            @endif
                            @if(auth()->user()->permanent_address)
                            <p class="flex items-start justify-center text-center sm:justify-start sm:text-left">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium">স্থায়ী ঠিকানা:</span> <span class="ml-1">{{ auth()->user()->permanent_address }}</span>
                            </p>
                            @endif
                            @if(auth()->user()->present_address && auth()->user()->present_address !== auth()->user()->permanent_address)
                            <p class="flex items-start justify-center text-center sm:justify-start sm:text-left">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium">বর্তমান ঠিকানা:</span> <span class="ml-1">{{ auth()->user()->present_address }}</span>
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Organization Logo (Desktop Only) -->
                    <div class="flex flex-col items-center flex-shrink-0 gap-2 w-full sm:w-auto">
                        @php
                            $logo = app(\App\Services\SettingsService::class)->get('organization_logo');
                        @endphp
                        @if($logo)
                            <img src="{{ asset('storage/' . $logo) }}" alt="Organization Logo" class="object-contain w-20 h-20 sm:w-24 sm:h-24">
                        @else
                            <div class="flex items-center justify-center w-20 h-20 text-xs text-gray-400 bg-gray-100 rounded-lg sm:w-24 sm:h-24 dark:bg-gray-700 dark:text-gray-500">
                                <span>লোগো নেই</span>
                            </div>
                        @endif

                        <!-- Action Buttons (Desktop Only) -->
                        <div class="flex flex-col gap-2 w-full sm:flex-row sm:w-auto">
                            <a href="{{ route('member.payment') }}" wire:navigate class="inline-flex items-center justify-center w-full sm:w-auto px-2 py-1.5 text-xs font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors whitespace-nowrap">
                                <svg class="inline-block w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                পেমেন্ট সাবমিট
                            </a>
                            <a href="{{ role_route('profile.edit') }}" wire:navigate class="inline-flex items-center justify-center w-full sm:w-auto px-2 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors whitespace-nowrap">
                                <svg class="inline-block w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                প্রোফাইল সম্পাদনা
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Due Payment Card -->
        <div class="mb-4 w-full">
            <livewire:member.due-payment-card />
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 gap-2 mb-4 md:gap-6 md:grid-cols-4 w-full">
            <!-- Total Paid Card -->
            <div class="overflow-hidden bg-white border-t-4 border-green-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-2 sm:p-4 md:p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-600 md:text-sm dark:text-gray-400">{{ $paidMonths }} মাসের মোট</p>
                            <p class="mt-1 text-xl font-bold text-green-600 md:mt-2 md:text-3xl dark:text-green-400">৳{{ (int)$totalPaid == $totalPaid ? (int)$totalPaid : number_format($totalPaid, 2) }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">টাকা জমা হয়েছে!</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Due Card -->
            <div class="overflow-hidden bg-white border-t-4 border-red-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-2 sm:p-4 md:p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-600 md:text-sm dark:text-gray-400">বকেয়া</p>
                            <p class="mt-1 text-xl font-bold text-red-600 md:mt-2 md:text-3xl dark:text-red-400">৳{{ number_format($totalDue, 2) }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $dueMonths }} মাস</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Payment Card -->
            <div class="overflow-hidden bg-white border-t-4 border-yellow-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-2 sm:p-4 md:p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-600 md:text-sm dark:text-gray-400">অপেক্ষমান পেমেন্ট</p>
                            <p class="mt-1 text-xl font-bold text-yellow-600 md:mt-2 md:text-3xl dark:text-yellow-400">৳{{ number_format($pendingAmount, 2) }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $pendingMonths }} মাস</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Transactions Card -->
            <div class="overflow-hidden bg-white border-t-4 border-blue-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-2 sm:p-4 md:p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-xs font-medium text-gray-600 md:text-sm dark:text-gray-400">মোট লেনদেন</p>
                            <p class="mt-1 text-xl font-bold text-blue-600 md:mt-2 md:text-3xl dark:text-blue-400">{{ $transactions->total() }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">সর্বমোট</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Payment Record Book -->
        <div class="mb-4 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg w-full">
            <div class="p-3 sm:p-6 w-full">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between mb-4 w-full">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">বার্ষিক পেমেন্ট রেকর্ড বই</h3>
                    <div class="flex items-center gap-2">
                        <label for="year-filter" class="text-sm font-medium text-gray-700 dark:text-gray-300">সাল:</label>
                        <select wire:model.live="selectedYear" id="year-filter" class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">সকল বছর</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto w-full">
                    <table class="min-w-max w-full border border-gray-300 dark:border-gray-600 text-xs sm:text-sm">
                        <thead class="bg-blue-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-2 py-2 sm:px-4 sm:py-3 font-bold text-center text-gray-700 border border-gray-300 dark:border-gray-600 dark:text-gray-200">মাস</th>
                                <th class="px-2 py-2 sm:px-4 sm:py-3 font-bold text-center text-gray-700 border border-gray-300 dark:border-gray-600 dark:text-gray-200">তারিখ</th>
                                <th class="px-2 py-2 sm:px-4 sm:py-3 font-bold text-center text-gray-700 border border-gray-300 dark:border-gray-600 dark:text-gray-200">টাকা</th>
                                <th class="px-2 py-2 sm:px-4 sm:py-3 font-bold text-center text-gray-700 border border-gray-300 dark:border-gray-600 dark:text-gray-200">স্বাক্ষর</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach($monthlyData as $data)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-2 py-2 sm:px-4 sm:py-3 font-medium text-center text-gray-900 border border-gray-300 dark:border-gray-600 dark:text-gray-100">
                                    {{ $data['month'] }}
                                </td>
                                <td class="px-2 py-2 sm:px-4 sm:py-3 text-center text-gray-700 border border-gray-300 dark:border-gray-600 dark:text-gray-300">
                                    {{ $data['date'] }}
                                </td>
                                <td class="px-2 py-2 sm:px-4 sm:py-3 font-semibold text-center text-gray-900 border border-gray-300 dark:border-gray-600 dark:text-gray-100">
                                    @if($data['amount'])
                                        <span class="text-green-600 dark:text-green-400">৳{{ $data['amount'] }}</span>
                                    @endif
                                </td>
                                <td class="px-2 py-2 sm:px-4 sm:py-3 text-center border border-gray-300 dark:border-gray-600">
                                    @if($data['signature'])
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-200">
                                            @php
                                                $user = \App\Models\User::where('name', $data['signature'])->first();
                                            @endphp
                                            @if($user && $user->profile_pic)
                                                <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="{{ $user->name }}" class="w-5 h-5 rounded-full object-cover border border-gray-300 dark:border-gray-600">
                                            @else
                                                <span class="flex items-center justify-center w-5 h-5 rounded-full bg-blue-500 text-white text-[10px] font-bold border border-gray-300 dark:border-gray-600">
                                                    {{ strtoupper(mb_substr($data['signature'], 0, 1)) }}
                                                </span>
                                            @endif
                                            <span>{{ $data['signature'] }}</span>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg w-full">
            <!-- Futuristic Transaction Table -->
            <div class="mt-10">
                <div class="flex items-center justify-between mb-6 mx-4">
                    <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">
                        আমার ট্রানজেকশন
                    </h2>
                    <div class="px-4 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-200">
                        সর্বমোট {{ $transactions->total() }} টি লেনদেন
                    </div>
                </div>

                <div class="relative overflow-hidden border border-white/20 shadow-2xl rounded-2xl bg-white/40 dark:bg-gray-800/40 backdrop-blur-xl">
                    <!-- Decorative Gradients -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
                    
                    @if($transactions->count() > 0)
                        <div class="overflow-x-auto mx-4">
                            <table class="min-w-full divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                <thead class="bg-gray-50/50 dark:bg-gray-700/50">
                                    <tr>
                                        <th scope="col" class="px-8 py-5 text-sm font-extrabold tracking-wider text-left uppercase text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">সাবমিটের তারিখ</th>
                                        <th scope="col" class="px-8 py-5 text-sm font-extrabold tracking-wider text-left uppercase text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">যে মাসের পেমেন্ট</th>
                                        <th scope="col" class="px-8 py-5 text-sm font-extrabold tracking-wider text-left uppercase text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">পরিমাণ</th>
                                        <th scope="col" class="px-8 py-5 text-sm font-extrabold tracking-wider text-left uppercase text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">পেমেন্ট মাধ্যম</th>
                                        <th scope="col" class="px-8 py-5 text-sm font-extrabold tracking-wider text-left uppercase text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">অবস্থা</th>
                                        <th scope="col" class="px-8 py-5 text-sm font-extrabold tracking-wider text-left uppercase text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400">রিসিপ্ট</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200/50 dark:divide-gray-700/50">
                                    @foreach($transactions as $transaction)
                                    <tr class="transition-all duration-300 hover:bg-blue-50/50 dark:hover:bg-blue-900/20 group">
                                        <td class="px-4 py-2 text-sm text-gray-700 whitespace-nowrap dark:text-gray-300 group-hover:text-blue-600 dark:group-hover:text-blue-400">
                                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-2 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                            {{ \App\Helpers\BanglaHelper::getBanglaMonth($transaction->month) }} {{ $transaction->year }}
                                        </td>
                                        <td class="px-4 py-2 text-sm font-bold text-gray-900 whitespace-nowrap dark:text-gray-100">
                                            ৳{{ number_format($transaction->amount, 2) }}
                                        </td>
                                        <td class="px-4 py-2 text-sm text-gray-700 whitespace-nowrap dark:text-gray-300">
                                            <span class="inline-flex items-center px-4 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ $transaction->paymentMethod->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @if($transaction->status === 'approved')
                                                <span class="inline-flex items-center px-4 py-1 text-xs font-bold text-green-700 bg-green-100 rounded-full shadow-sm dark:bg-green-900/50 dark:text-green-300 ring-1 ring-green-500/20">
                                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                                    অনুমোদিত
                                                </span>
                                            @elseif($transaction->status === 'rejected')
                                                <span class="inline-flex items-center px-4 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full shadow-sm dark:bg-red-900/50 dark:text-red-300 ring-1 ring-red-500/20">
                                                    <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                                    প্রত্যাখ্যাত
                                                </span>
                                            @else
                                                  <span class="inline-flex items-center px-4 py-1 text-xs font-bold text-black bg-orange-100 rounded-full shadow-sm dark:bg-orange-900/50 dark:text-orange-300 ring-1 ring-orange-500/20">
                                                    <svg class="w-3 h-3 mr-1.5 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    অপেক্ষমাণ
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 space-x-2 text-sm whitespace-nowrap">
                                            @if($transaction->status === 'approved')
                                                <div class="flex items-center space-x-2">
                                                    {{-- Preview button --}}
                                                    <a href="{{ route('member.payments.receipt.preview', $transaction->id) }}"
                                                       class="inline-flex items-center px-3 py-2 text-xs font-medium text-blue-600 transition-colors bg-blue-50 rounded-md hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-900/50"
                                                       target="_blank">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                        প্রিভিউ
                                                    </a>
    
                                                    {{-- Download button --}}
                                                    <button wire:click="downloadReceipt({{ $transaction->id }})"
                                                            class="inline-flex items-center px-3 py-2 text-xs font-medium text-white transition-all bg-gradient-to-r from-green-500 to-emerald-600 rounded-md shadow-md hover:shadow-lg hover:from-green-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                        ডাউনলোড
                                                    </button>
                                                </div>
                                            @elseif($transaction->status === 'pending')
                                                <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                                    অনুমোদনের পর রিসিপ্ট পাবেন
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-gray-600">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
    
                        <!-- Custom Pagination -->
                        <div class="px-6 py-4 border-t border-gray-200/50 dark:border-gray-700/50 bg-gray-50/30 dark:bg-gray-800/30">
                            {{ $transactions->links('vendor.pagination.custom-profile', data: ['scrollTo' => false]) }}
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="p-4 mb-4 bg-gray-100 rounded-full dark:bg-gray-700/50">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">কোনো লেনদেন পাওয়া যায়নি</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">আপনার এখনো কোনো পেমেন্ট রেকর্ড নেই।</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    <!-- Edit Profile Modal -->
    @if($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" wire:click="$set('showEditModal', false)" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button wire:click="$set('showEditModal', false)" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-2xl font-bold leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
                            প্রোফাইল সম্পাদনা
                        </h3>

                        <form wire:submit.prevent="updateBasicInfo" class="mt-6 space-y-6">
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

                                    <!-- Loading indicator for photo upload -->
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
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">সর্বোচ্চ ২MB</p>
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

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ঠিকানা</label>
                                <textarea wire:model="address" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                                @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-center justify-between pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                                <button type="button" wire:click="openPasswordModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    পাসওয়ার্ড পরিবর্তন
                                </button>
                                <div class="flex space-x-3">
                                    <button type="button" wire:click="$set('showEditModal', false)" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                        বাতিল
                                    </button>
                                    <button type="submit" wire:loading.attr="disabled" wire:target="updateBasicInfo,photo" class="relative px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span wire:loading.remove wire:target="updateBasicInfo">সংরক্ষণ করুন</span>
                                        <span wire:loading wire:target="updateBasicInfo" class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            সংরক্ষণ হচ্ছে...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



    <!-- Password Change Modal -->
    @if($showPasswordModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" wire:click="closePasswordModal" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div class="relative inline-block w-full max-w-lg px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button wire:click="closePasswordModal" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div>
                    <h3 class="text-xl font-bold leading-6 text-gray-900 dark:text-gray-100">পাসওয়ার্ড পরিবর্তন</h3>

                    <form wire:submit.prevent="updatePassword" class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">বর্তমান পাসওয়ার্ড *</label>
                            <div class="relative">
                                <input type="password" wire:model="current_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('current_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড * <span class="text-xs text-gray-500">(কমপক্ষে ৮ অক্ষর)</span></label>
                            <input type="password" wire:model="new_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            @error('new_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড নিশ্চিত করুন *</label>
                            <input type="password" wire:model="new_password_confirmation" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex justify-end pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                            <button type="button" wire:click="closePasswordModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                বাতিল
                            </button>
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
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
