<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Noto Serif Bengali', serif !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col min-h-screen" x-data="{ sidebarOpen: false }">

        <!-- Header (Desktop and Mobile) -->
        <header class="sticky top-0 z-20 flex items-center justify-between px-3 py-3 bg-white border-b border-gray-200 shadow-sm sm:px-6 dark:bg-gray-800 dark:border-gray-700">
            <!-- Sidebar Toggle (Mobile) moved to bottom bar -->
            <div class="flex items-center">
                <a href="{{ role_route('dashboard') }}" wire:navigate class="flex items-center space-x-3 transition-opacity hover:opacity-80">
                    @php
                        $logo = app(\App\Services\SettingsService::class)->get('organization_logo');
                        $orgName = app(\App\Services\SettingsService::class)->get('organization_name', 'প্রজন্ম উন্নয়ন মিশন');
                    @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="w-auto h-10">
                    @else
                        <x-application-logo class="block w-auto h-8 text-gray-800 fill-current dark:text-gray-200" />
                    @endif
                    <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        {{ $orgName }}
                    </h1>
                </a>
            </div>

                <!-- Profile Dropdown -->
                <div class="flex items-center space-x-4" x-data="{ profileOpen: false, notificationOpen: false }">
                    <!-- Notifications -->
                    @php
                        $customUnreadCount = \App\Models\Notification::where('user_id', auth()->id())
                            ->where('read', false)
                            ->count();
                        $customNotifications = \App\Models\Notification::where('user_id', auth()->id())
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp

                    <div class="relative">
                        <button @click="notificationOpen = !notificationOpen" class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <!-- Notification badge -->
                            @if($customUnreadCount > 0)
                            <span class="absolute -top-2 -right-1 flex items-center justify-center min-w-[18px] h-4 px-0.5 text-[10px] font-bold text-white bg-red-600 rounded-full ring-2 ring-white shadow-md">
                                {{ $customUnreadCount > 9 ? '9+' : $customUnreadCount }}
                            </span>
                            @endif
                        </button>

                        <!-- Notification Dropdown -->
                        <div x-show="notificationOpen"
                             @click.away="notificationOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 z-50 flex flex-col w-80 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-[32rem] dark:bg-gray-800 dark:border-gray-700"
                             style="display: none;">

                            <!-- Header -->
                            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200">নোটিফিকেশন</h3>
                                @if($customUnreadCount > 0)
                                <span class="text-xs font-medium text-blue-600 dark:text-blue-400">{{ $customUnreadCount }} নতুন</span>
                                @endif
                            </div>

                            <!-- Notifications List -->
                            <div class="flex-1 overflow-y-auto">
                                @forelse($customNotifications as $notification)
                                    <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-700 {{ $notification->read ? '' : 'bg-blue-50 dark:bg-blue-900/20' }}">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                @if($notification->type === 'payment_approved')
                                                    <div class="flex items-center justify-center w-8 h-8 bg-green-100 rounded-full dark:bg-green-900">
                                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                    </div>
                                                @elseif(($notification->data['type'] ?? '') === 'payment_rejected')
                                                    <div class="flex items-center justify-center w-8 h-8 bg-red-100 rounded-full dark:bg-red-900">
                                                        <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full dark:bg-blue-900">
                                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm text-gray-800 dark:text-gray-200">{{ $notification->message }}</p>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <p class="text-sm">কোনো নোটিফিকেশন নেই</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Footer -->
                            @if(auth()->user()->hasRole('member'))
                            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('member.notifications') }}" class="block text-sm font-medium text-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                    সকল নোটিফিকেশন দেখুন
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profile -->
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center space-x-3 focus:outline-none">
                            @if(auth()->user()->profile_pic)
                                <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="{{ auth()->user()->name }}" class="object-cover w-10 h-10 border-2 border-gray-300 rounded-full">
                            @else
                                <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-blue-500 border-2 border-gray-300 rounded-full">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="hidden text-left lg:block">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst(auth()->user()->tyroRoleSlugs()[0] ?? 'User') }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="profileOpen"
                             @click.away="profileOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 z-50 w-56 py-1 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700"
                             style="display: none;">

                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email ?? auth()->user()->phone }}</p>
                            </div>

                            <!-- Menu Items -->
                            <a href="@if(auth()->user()->hasRole('member')) {{ route('member.profile') }} @elseif(auth()->user()->hasRole('admin')) {{ route('admin.profile') }} @elseif(auth()->user()->hasRole('accountant')) {{ route('accountant.profile') }} @else # @endif" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                প্রোফাইল
                            </a>

                            @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.settings') }}" class="flex items-center block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                সেটিংস
                            </a>
                            @endif

                            <div class="my-1 border-t border-gray-200 dark:border-gray-700"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('tyro-login.logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-left text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    লগআউট
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

        <!-- Content Area with Sidebar -->

        <div class="flex-1 block md:flex md:flex-row">
            <!-- Sidebar (Desktop & Mobile Offcanvas) -->
            <div class="relative">
                <!-- Desktop Sidebar -->
                <aside class="hidden w-64 h-full bg-white border-r border-gray-200 md:block dark:bg-gray-800 dark:border-gray-700">
                    <x-sidebar />
                </aside>
                <!-- Mobile Offcanvas Sidebar -->
                <div x-show="sidebarOpen" class="fixed inset-0 z-40 flex md:hidden" style="display: none;">
                    <div class="fixed inset-0 bg-black bg-opacity-40" @click="sidebarOpen = false"></div>
                    <aside class="relative w-64 h-full bg-white border-r border-gray-200 shadow-xl dark:bg-gray-800 dark:border-gray-700">
                        <button class="absolute text-gray-500 top-2 right-2 hover:text-gray-700" @click="sidebarOpen = false">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <x-sidebar />
                    </aside>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex flex-col flex-1 pb-16 md:pb-0">
                <div class="flex-1 p-6 overflow-y-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>

            <!-- Mobile Header -->
            <header class="hidden">
                <!-- Profile Picture and Name -->
                <div class="flex items-center space-x-3">
                    @if(auth()->user()->profile_pic)
                        <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="{{ auth()->user()->name }}" class="object-cover w-10 h-10 border-2 border-gray-300 rounded-full">
                    @else
                        <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-blue-500 border-2 border-gray-300 rounded-full">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ auth()->user()->name }}</p>
                        @if(auth()->user()->membership_id)
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->membership_id }}</p>
                        @endif
                    </div>
                </div>

                <!-- Notification Icon (mobile) - uses custom notifications table -->
                @php
                    $mobileUnreadCount = \App\Models\Notification::where('user_id', auth()->id())
                        ->where('read', false)
                        ->count();
                @endphp

                <a href="@if(auth()->user()->hasRole('member')) {{ route('member.notifications') }} @else # @endif" class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    @if($mobileUnreadCount > 0)
                    <span class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 rounded-full">
                        {{ $mobileUnreadCount > 9 ? '9+' : $mobileUnreadCount }}
                    </span>
                    @endif
                </a>
            </header>

        <!-- Mobile Bottom Nav -->
        <nav class="fixed bottom-0 z-50 w-full bg-white border-t border-gray-200 md:hidden dark:bg-gray-800 dark:border-gray-700">
            <x-bottom-nav />
        </nav>
    </div>

    <x-toast />

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
