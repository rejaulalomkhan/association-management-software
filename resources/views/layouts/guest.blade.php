<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    @php
        $faviconLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
    @endphp
    @if($faviconLogo && file_exists(storage_path('app/public/' . $faviconLogo)))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $faviconLogo) }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . $faviconLogo) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- PWA Meta Tags -->
    @laravelPWA
    
    <!-- iOS Specific -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <link rel="apple-touch-icon" href="/images/icons/icon-152x152.png">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#3b82f6">

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-3xl mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <!-- PWA Install Prompt -->
    @livewire('pwa-install-prompt')

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
