<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8 px-4">
    <div class="max-w-4xl mx-auto">

        @if($status === 'active')
            <x-member-certificate-body
                :member="$member"
                :show-verified-badge="true"
                :show-back-button="false"
                :show-print-button="true"
            />

        @elseif($status === 'inactive')
            @php
                $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 p-6 text-white text-center">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <h1 class="text-2xl font-bold">সদস্যপদ সক্রিয় নয়</h1>
                </div>
                <div class="p-8 text-center">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        এই সদস্যপদটি বর্তমানে <strong>{{ $orgName }}</strong>-এ সক্রিয় নেই।
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        যদি কোনো সমস্যা হয়ে থাকে, অনুগ্রহ করে প্রতিষ্ঠানের সাথে যোগাযোগ করুন।
                    </p>
                </div>
            </div>

        @else
            {{-- not_found --}}
            @php
                $orgName = app(\App\Services\SettingsService::class)->get('organization_name', config('app.name'));
            @endphp
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-red-500 to-pink-600 p-6 text-white text-center">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h1 class="text-2xl font-bold">অবৈধ QR কোড</h1>
                </div>
                <div class="p-8 text-center">
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        এই QR কোডটি <strong>{{ $orgName }}</strong>-এর কোনো সদস্যের সাথে মেলেনি।
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        অনুগ্রহ করে নিশ্চিত করুন আপনি সঠিক QR কোডটি স্ক্যান করেছেন।
                    </p>
                </div>
            </div>
        @endif

    </div>
</div>
