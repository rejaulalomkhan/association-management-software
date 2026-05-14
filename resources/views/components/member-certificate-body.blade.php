@props([
    'member',
    'showVerifiedBadge' => false,
    'showBackButton' => false,
    'showPrintButton' => true,
    'backUrl' => null,
])

@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;

    $orgLogo = app(\App\Services\SettingsService::class)->get('organization_logo');
    $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
    $orgAddress = app(\App\Services\SettingsService::class)->get('organization_address', '');
    $orgPhone = app(\App\Services\SettingsService::class)->get('organization_phone', '');

    $verificationUrl = $member->verificationUrl();
    $qrSvg = $verificationUrl
        ? QrCode::format('svg')->size(140)->margin(1)->errorCorrection('M')->generate($verificationUrl)
        : null;
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100..900&display=swap');
    .certificate-body, .certificate-body * {
        font-family: 'Noto Serif Bengali', serif;
    }
    @media print {
        .print\:hidden { display: none !important; }
        .certificate-body { box-shadow: none !important; }
    }
</style>

<div class="certificate-body bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
    {{-- Organization Header --}}
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-5 text-white">
        <div class="flex items-center gap-4">
            @if($orgLogo)
                <div class="bg-white rounded-lg p-2 shadow-md flex-shrink-0">
                    <img src="{{ asset('storage/' . $orgLogo) }}" alt="{{ $orgName }}" class="h-14 w-auto">
                </div>
            @endif
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl sm:text-3xl font-bold leading-tight">{{ $orgName }}</h1>
                @if($orgAddress)
                    <p class="text-indigo-100 text-sm mt-1">{{ $orgAddress }}</p>
                @endif
                @if($orgPhone)
                    <p class="text-indigo-100 text-sm">ফোন: {{ $orgPhone }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

    @if($showVerifiedBadge)
        <div class="bg-green-50 border-b-2 border-green-500 px-6 py-3 flex items-center justify-center gap-3">
            <svg class="w-8 h-8 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"/>
            </svg>
            <div>
                <div class="font-bold text-green-800">ভেরিফাইড সদস্য</div>
                <div class="text-xs text-green-700">এই সদস্য {{ $orgName }}-এর একজন নিবন্ধিত সদস্য।</div>
            </div>
        </div>
    @endif

    {{-- ID-card style header: Photo | Info | QR --}}
    <div class="p-6 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col md:flex-row items-center md:items-stretch gap-6">

            {{-- Profile Picture --}}
            <div class="flex-shrink-0">
                @if($member->profile_pic)
                    <img src="{{ asset('storage/' . $member->profile_pic) }}"
                         alt="{{ $member->name }}"
                         class="w-36 h-36 object-cover rounded-xl border-4 border-white dark:border-gray-700 shadow-lg ring-2 ring-indigo-200 dark:ring-indigo-800">
                @else
                    <div class="w-36 h-36 flex items-center justify-center bg-gradient-to-br from-indigo-400 to-purple-500 rounded-xl border-4 border-white dark:border-gray-700 shadow-lg ring-2 ring-indigo-200 dark:ring-indigo-800">
                        <span class="text-5xl font-bold text-white tracking-wider">{{ strtoupper(mb_substr($member->name, 0, 2)) }}</span>
                    </div>
                @endif
            </div>

            {{-- Center: Name, position, status, ID --}}
            <div class="flex-1 flex flex-col justify-center text-center md:text-left min-w-0">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                    {{ $member->name }}
                </h2>

                @if($member->position || $member->profession)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        @if($member->position)
                            <span class="font-semibold">{{ $member->position }}</span>
                        @endif
                        @if($member->position && $member->profession)
                            <span class="mx-1 text-gray-400">•</span>
                        @endif
                        @if($member->profession)
                            {{ $member->profession }}
                        @endif
                    </p>
                @endif

                <div class="mt-3 flex flex-wrap gap-2 justify-center md:justify-start">
                    <span class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                        একটিভ সদস্য
                    </span>
                    @if($member->blood_group)
                        <span class="inline-flex items-center px-3 py-1 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full text-xs font-semibold">
                            🩸 {{ $member->blood_group }}
                        </span>
                    @endif
                </div>

                @if($member->membership_id)
                    <div class="mt-4 inline-flex self-center md:self-start">
                        <div class="bg-indigo-600 text-white px-4 py-2 rounded-l-lg text-xs font-semibold flex items-center">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                            </svg>
                            সদস্য নম্বর
                        </div>
                        <div class="bg-white dark:bg-gray-800 border-2 border-indigo-600 px-4 py-2 rounded-r-lg text-indigo-800 dark:text-indigo-300 font-bold font-mono">
                            {{ $member->membership_id }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- QR Code --}}
            @if($qrSvg)
                <div class="flex-shrink-0 flex flex-col items-center md:border-l md:border-gray-200 md:dark:border-gray-700 md:pl-6">
                    <div class="bg-white p-2 rounded-lg border-2 border-gray-200 dark:border-gray-700 shadow-sm">
                        {!! $qrSvg !!}
                    </div>
                    <div class="mt-2 text-[11px] text-gray-600 dark:text-gray-400 text-center leading-tight flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        স্ক্যান করে ভেরিফাই করুন
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Member Details --}}
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            সদস্যের বিস্তারিত তথ্য
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-0 bg-gray-50 dark:bg-gray-900 rounded-lg p-4">
            @php
                $rows = [
                    ['পিতার নাম', $member->father_name],
                    ['জন্ম তারিখ', $member->dob ? \Carbon\Carbon::parse($member->dob)->format('d/m/Y') : null],
                    ['ফোন', $member->phone],
                    ['ধর্ম', $member->religion],
                    ['জাতীয়তা', $member->nationality],
                    ['যোগদানের তারিখ', $member->joined_at ? \Carbon\Carbon::parse($member->joined_at)->format('d/m/Y') : null],
                ];
            @endphp

            @foreach($rows as [$label, $value])
                @if($value)
                    <div class="flex py-2 border-b border-gray-200 dark:border-gray-700 last:border-0">
                        <span class="font-semibold text-gray-700 dark:text-gray-300 w-32 flex-shrink-0">{{ $label }}:</span>
                        <span class="text-gray-900 dark:text-gray-100">{{ $value }}</span>
                    </div>
                @endif
            @endforeach

            @if($member->present_address)
                <div class="flex py-2 border-b border-gray-200 dark:border-gray-700 md:col-span-2">
                    <span class="font-semibold text-gray-700 dark:text-gray-300 w-32 flex-shrink-0">বর্তমান ঠিকানা:</span>
                    <span class="text-gray-900 dark:text-gray-100">{{ $member->present_address }}</span>
                </div>
            @endif
            @if($member->permanent_address)
                <div class="flex py-2 md:col-span-2 border-gray-200 dark:border-gray-700 {{ $member->present_address ? '' : 'border-b' }}">
                    <span class="font-semibold text-gray-700 dark:text-gray-300 w-32 flex-shrink-0">স্থায়ী ঠিকানা:</span>
                    <span class="text-gray-900 dark:text-gray-100">{{ $member->permanent_address }}</span>
                </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        @if($showBackButton || $showPrintButton)
            <div class="mt-6 flex flex-wrap gap-3 justify-center print:hidden">
                @if($showBackButton && $backUrl)
                    <a href="{{ $backUrl }}" wire:navigate
                       class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        ফিরে যান
                    </a>
                @endif
                @if($showPrintButton)
                    <button onclick="window.print()" type="button"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        প্রিন্ট করুন
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>
