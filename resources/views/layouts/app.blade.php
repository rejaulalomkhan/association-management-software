<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Desktop Sidebar -->
        <aside class="hidden md:block w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen">
            <x-sidebar />
        </aside>

        <!-- Main Content -->
        <main class="flex-1 pb-16 md:pb-0 overflow-y-auto h-screen">
            <!-- Mobile Header -->
            <header class="md:hidden bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center sticky top-0 z-10">
                <div class="font-bold text-lg text-gray-800 dark:text-gray-200">
                    {{ config('app.name') }}
                </div>
                <!-- Notification Icon Placeholder -->
                <button class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </button>
            </header>

            <div class="p-6">
                {{ $slot }}
            </div>
        </main>

        <!-- Mobile Bottom Nav -->
        <nav class="md:hidden fixed bottom-0 w-full bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 z-50">
            <x-bottom-nav />
        </nav>
    </div>

    <x-toast />

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
