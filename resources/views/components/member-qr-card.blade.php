@props([
    'member',
    'title' => 'সদস্য ভেরিফিকেশন QR',
    'subtitle' => 'এই QR কোড স্ক্যান করে যে কেউ আপনার সদস্যপদ যাচাই করতে পারবে।',
    'size' => 200,
])

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;

    $verificationUrl = $member->verificationUrl();
    $qrSvg = $verificationUrl
        ? QrCode::format('svg')->size($size)->margin(1)->errorCorrection('M')->generate($verificationUrl)
        : null;

    $certificateUrl = $verificationUrl; // public verification page (same URL)
@endphp

@if($qrSvg)
    <div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden']) }}>
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-4 py-3 text-white">
            <h3 class="font-semibold text-base flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                </svg>
                {{ $title }}
            </h3>
        </div>
        <div class="p-4 flex flex-col sm:flex-row items-center gap-4">
            <div class="bg-white p-2 rounded-lg border-2 border-gray-200 flex-shrink-0">
                {!! $qrSvg !!}
            </div>
            <div class="flex-1 text-center sm:text-left">
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                    {{ $subtitle }}
                </p>
                <div class="space-y-2"
                     x-data="{ copied: false, copy() { navigator.clipboard.writeText($refs.link.value); this.copied = true; setTimeout(() => this.copied = false, 2000); } }">
                    <input x-ref="link" type="text" readonly value="{{ $certificateUrl }}"
                           class="w-full px-3 py-2 text-xs bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded font-mono text-gray-700 dark:text-gray-300"
                           onclick="this.select()">
                    <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                        <button type="button" @click="copy()"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <span x-text="copied ? 'কপি হয়েছে!' : 'লিংক কপি'"></span>
                        </button>
                        <a href="{{ $certificateUrl }}" target="_blank" rel="noopener"
                           class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-900 border border-indigo-600 dark:border-indigo-400 hover:bg-indigo-50 dark:hover:bg-gray-800 rounded transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h9a2 2 0 002-2v-5M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            ভেরিফাই পেজ দেখুন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
