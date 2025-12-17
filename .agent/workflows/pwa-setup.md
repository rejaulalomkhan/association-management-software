---
description: How to add PWA functionality to make the app installable
---

# PWA (Progressive Web App) Setup Workflow

This workflow explains how to add PWA functionality to the application, making it installable on mobile devices and desktops with the organization logo as the app icon.

## What is PWA?

A Progressive Web App (PWA) allows users to install your web application on their devices like a native app. Benefits include:
- **Offline Access**: Works without internet connection
- **Home Screen Icon**: Appears like a native app
- **Full Screen**: Runs without browser UI
- **Fast Loading**: Cached resources load instantly
- **Push Notifications**: (Optional) Send notifications to users

## Installation Steps

### Step 1: Install Laravel PWA Package

// turbo
```bash
composer require silviolleite/laravelpwa
```

### Step 2: Publish PWA Assets

// turbo
```bash
php artisan vendor:publish --provider="LaravelPWA\Providers\LaravelPWAServiceProvider"
```

This will create:
- `config/laravelpwa.php` - Configuration file
- `public/serviceworker.js` - Service worker file
- `public/manifest.json` - Web app manifest
- `public/offline.html` - Offline fallback page

### Step 3: Configure PWA Manifest

Edit `config/laravelpwa.php`:

```php
return [
    'name' => env('APP_NAME', 'প্রজন্ম উন্নয়ন মিশন'),
    'manifest' => [
        'name' => env('APP_NAME', 'প্রজন্ম উন্নয়ন মিশন'),
        'short_name' => 'প্রজন্ম',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#3b82f6', // Blue color
        'display' => 'standalone',
        'orientation' => 'portrait',
        'status_bar' => 'black',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash-640x1136.png',
            '750x1334' => '/images/icons/splash-750x1334.png',
            '828x1792' => '/images/icons/splash-828x1792.png',
            '1125x2436' => '/images/icons/splash-1125x2436.png',
            '1242x2208' => '/images/icons/splash-1242x2208.png',
            '1242x2688' => '/images/icons/splash-1242x2688.png',
            '1536x2048' => '/images/icons/splash-1536x2048.png',
            '1668x2224' => '/images/icons/splash-1668x2224.png',
            '1668x2388' => '/images/icons/splash-1668x2388.png',
            '2048x2732' => '/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'প্রোফাইল',
                'description' => 'আমার প্রোফাইল দেখুন',
                'url' => '/member/profile',
                'icons' => [
                    "src" => "/images/icons/icon-96x96.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'পেমেন্ট',
                'description' => 'পেমেন্ট সাবমিট করুন',
                'url' => '/member/payment',
                'icons' => [
                    "src" => "/images/icons/icon-96x96.png",
                    "purpose" => "any"
                ]
            ]
        ],
        'custom' => []
    ]
];
```

### Step 4: Generate App Icons from Organization Logo

You need to create icons in different sizes. Use the organization logo from the database.

#### Option 1: Use Online Icon Generator

1. Get organization logo from `storage/app/public/` (saved via settings)
2. Go to https://www.pwabuilder.com/imageGenerator
3. Upload the logo
4. Download generated icons
5. Extract to `public/images/icons/`

#### Option 2: Use ImageMagick (if installed)

```bash
# Install ImageMagick first (if not installed)
# Then run these commands:

convert logo.png -resize 72x72 public/images/icons/icon-72x72.png
convert logo.png -resize 96x96 public/images/icons/icon-96x96.png
convert logo.png -resize 128x128 public/images/icons/icon-128x128.png
convert logo.png -resize 144x144 public/images/icons/icon-144x144.png
convert logo.png -resize 152x152 public/images/icons/icon-152x152.png
convert logo.png -resize 192x192 public/images/icons/icon-192x192.png
convert logo.png -resize 384x384 public/images/icons/icon-384x384.png
convert logo.png -resize 512x512 public/images/icons/icon-512x512.png
```

#### Option 3: Manual Creation

1. Open organization logo in an image editor (Photoshop, GIMP, etc.)
2. Resize to each required size
3. Export as PNG
4. Save to `public/images/icons/`

**Required Sizes:**
- 72x72
- 96x96
- 128x128
- 144x144
- 152x152
- 192x192
- 384x384
- 512x512

### Step 5: Add PWA Meta Tags to Layout

Edit `resources/views/layouts/app.blade.php` and add in the `<head>` section:

```blade
<head>
    <!-- Existing meta tags -->
    
    <!-- PWA Meta Tags -->
    @laravelPWA
    
    <!-- iOS Specific -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <link rel="apple-touch-icon" href="/images/icons/icon-152x152.png">
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#3b82f6">
</head>
```

### Step 6: Configure Service Worker

Edit `public/serviceworker.js` to customize caching strategy:

```javascript
var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-512x512.png'
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
```

### Step 7: Create Offline Page

Edit `public/offline.html`:

```html
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>অফলাইন - প্রজন্ম উন্নয়ন মিশন</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">📡</div>
        <h1>আপনি অফলাইন আছেন</h1>
        <p>ইন্টারনেট সংযোগ পাওয়া যাচ্ছে না। অনুগ্রহ করে আপনার সংযোগ চেক করুন।</p>
    </div>
</body>
</html>
```

### Step 8: Add Install Prompt (Optional)

Create a Livewire component for install prompt:

```bash
php artisan make:livewire PwaInstallPrompt
```

In `app/Livewire/PwaInstallPrompt.php`:

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class PwaInstallPrompt extends Component
{
    public $showPrompt = false;

    public function render()
    {
        return view('livewire.pwa-install-prompt');
    }
}
```

In `resources/views/livewire/pwa-install-prompt.blade.php`:

```blade
<div x-data="{ 
    showInstall: false,
    deferredPrompt: null,
    init() {
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            this.deferredPrompt = e;
            this.showInstall = true;
        });
    },
    install() {
        if (this.deferredPrompt) {
            this.deferredPrompt.prompt();
            this.deferredPrompt.userChoice.then((choiceResult) => {
                this.deferredPrompt = null;
                this.showInstall = false;
            });
        }
    }
}">
    <div x-show="showInstall" 
         x-transition
         class="fixed bottom-4 right-4 bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4 max-w-sm z-50">
        <div class="flex items-start gap-3">
            <img src="/images/icons/icon-96x96.png" alt="App Icon" class="w-12 h-12 rounded-lg">
            <div class="flex-1">
                <h3 class="font-bold text-gray-900 dark:text-white">অ্যাপ ইনস্টল করুন</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                    দ্রুত অ্যাক্সেসের জন্য আপনার ডিভাইসে ইনস্টল করুন
                </p>
                <div class="flex gap-2 mt-3">
                    <button @click="install()" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                        ইনস্টল করুন
                    </button>
                    <button @click="showInstall = false" 
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600">
                        পরে
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
```

Add to your main layout:

```blade
<body>
    <!-- Your content -->
    
    <livewire:pwa-install-prompt />
</body>
```

## Testing PWA

### Step 1: Clear Cache

// turbo
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Step 2: Test in Browser

1. Open your app in Chrome/Edge
2. Open DevTools (F12)
3. Go to "Application" tab
4. Check "Manifest" section
5. Verify all icons are loaded
6. Check "Service Workers" section
7. Verify service worker is registered

### Step 3: Test Installation

**On Desktop (Chrome/Edge):**
1. Look for install icon in address bar
2. Click to install
3. App should open in standalone window

**On Mobile (Android):**
1. Open in Chrome
2. Tap menu (3 dots)
3. Select "Add to Home screen"
4. App icon appears on home screen

**On Mobile (iOS):**
1. Open in Safari
2. Tap share button
3. Select "Add to Home Screen"
4. App icon appears on home screen

### Step 4: Test Offline Functionality

1. Install the app
2. Open DevTools
3. Go to "Network" tab
4. Select "Offline"
5. Refresh the page
6. Should show offline page

## Updating PWA

When you make changes to the app:

1. Update version in `serviceworker.js`:
   ```javascript
   var staticCacheName = "pwa-v" + new Date().getTime();
   ```

2. Clear browser cache or uninstall/reinstall app

## Troubleshooting

### Icons Not Showing

1. Check file paths in `config/laravelpwa.php`
2. Verify icons exist in `public/images/icons/`
3. Clear cache: `php artisan cache:clear`
4. Hard refresh browser (Ctrl+Shift+R)

### Service Worker Not Registering

1. Check browser console for errors
2. Verify `serviceworker.js` is accessible at `/serviceworker.js`
3. Make sure you're using HTTPS (or localhost)
4. Clear browser cache

### Install Prompt Not Showing

1. PWA must meet installability criteria:
   - Served over HTTPS
   - Has valid manifest
   - Has service worker
   - Has icons
2. User hasn't installed before
3. User hasn't dismissed prompt 3 times

### App Not Working Offline

1. Check service worker caching strategy
2. Verify files are being cached
3. Check DevTools > Application > Cache Storage
4. Update `filesToCache` array in `serviceworker.js`

## Best Practices

1. **Optimize Icons**: Use PNG format, compress images
2. **Test on Multiple Devices**: iOS, Android, Desktop
3. **Update Service Worker**: Increment version on changes
4. **Monitor Performance**: Check loading times
5. **Handle Offline Gracefully**: Show meaningful offline page
6. **Cache Strategically**: Don't cache everything
7. **Test Installation Flow**: Ensure smooth user experience

## Environment Variables

Add to `.env`:

```env
APP_NAME="প্রজন্ম উন্নয়ন মিশন"
PWA_SHORT_NAME="প্রজন্ম"
PWA_THEME_COLOR="#3b82f6"
PWA_BACKGROUND_COLOR="#ffffff"
```

## Quick Reference

| Task | Command/Action |
|------|----------------|
| Install Package | `composer require silviolleite/laravelpwa` |
| Publish Assets | `php artisan vendor:publish --provider="LaravelPWA\Providers\LaravelPWAServiceProvider"` |
| Clear Cache | `php artisan cache:clear` |
| Test Manifest | DevTools > Application > Manifest |
| Test Service Worker | DevTools > Application > Service Workers |
| Generate Icons | Use https://www.pwabuilder.com/imageGenerator |

## Additional Resources

- [PWA Builder](https://www.pwabuilder.com/)
- [Web.dev PWA Guide](https://web.dev/progressive-web-apps/)
- [MDN PWA Documentation](https://developer.mozilla.org/en-US/docs/Web/Progressive_web_apps)
