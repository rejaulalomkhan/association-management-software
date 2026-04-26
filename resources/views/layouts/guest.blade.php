<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ org_name() }}</title>

    @php
        $settingsService = app(\App\Services\SettingsService::class);
        $headPwaIcon = (string) $settingsService->get('pwa_icon_192', '');
        $headOrgLogo = (string) $settingsService->get('organization_logo', '');
        $headIconUrl = null;
        if ($headPwaIcon && file_exists(storage_path('app/public/' . $headPwaIcon))) {
            $headIconUrl = asset('storage/' . $headPwaIcon);
        } elseif ($headOrgLogo && file_exists(storage_path('app/public/' . $headOrgLogo))) {
            $headIconUrl = asset('storage/' . $headOrgLogo);
        }
    @endphp
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $headIconUrl ?: asset('favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $headIconUrl ?: asset('favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $headIconUrl ?: asset('apple-touch-icon.png') }}">

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
    <meta name="apple-mobile-web-app-title" content="{{ org_name() }}">
    <link rel="apple-touch-icon" href="{{ $headIconUrl ?: asset('apple-touch-icon.png') }}">
    
    <!-- Theme Color -->
    @php
        $themeColor = $settingsService->get('pwa_theme_color', '#3b82f6');
    @endphp
    <meta name="theme-color" content="{{ $themeColor }}">

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
