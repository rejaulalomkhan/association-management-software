<?php

return [
    'name' => 'প্রজন্ম উন্নয়ন মিশন',
    'manifest' => [
        'name' => env('APP_NAME', 'প্রজন্ম উন্নয়ন মিশন'),
        'short_name' => 'প্রজন্ম',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#3b82f6',
        'display' => 'standalone',
        'orientation'=> 'portrait',
        'status_bar'=> 'black',
        'icons' => [
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any maskable'
            ],
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any maskable'
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
                    "src" => "/images/icons/icon-192x192.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'পেমেন্ট',
                'description' => 'পেমেন্ট সাবমিট করুন',
                'url' => '/member/payment',
                'icons' => [
                    "src" => "/images/icons/icon-192x192.png",
                    "purpose" => "any"
                ]
            ]
        ],
        'custom' => []
    ]
];

