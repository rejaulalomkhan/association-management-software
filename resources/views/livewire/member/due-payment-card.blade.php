@if($allCleared)
    <div
        x-data="{ open: true }"
        x-show="open"
        class="flex items-start gap-3 p-4 mb-4 text-sm text-green-800 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900 dark:border-green-700 dark:text-green-100"
    >
        <div class="mt-0.5">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-green-700 dark:text-green-200">অভিনন্দন!</p>
            <p class="mt-1">
                আপনার পূর্বের কোনো বকেয়া নেই। এখন পর্যন্ত সকল মাসের পেমেন্ট সঠিক সময়ে পরিশোধ হয়েছে।
            </p>
            <p class="mt-1 text-xs text-green-700 dark:text-green-300">
                নিয়মিত পেমেন্টের জন্য ধন্যবাদ।
            </p>
        </div>
        <button
            type="button"
            class="inline-flex items-center justify-center w-5 h-5 text-green-500 transition hover:text-green-700"
            x-on:click="open = false"
            aria-label="বন্ধ করুন"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@elseif($onlyCurrentMonthDue)
    <div
        x-data="{ open: true }"
        x-show="open"
        class="flex items-start gap-3 p-4 mb-4 text-sm text-blue-800 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900 dark:border-blue-700 dark:text-blue-100"
    >
        <div class="mt-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-blue-700 dark:text-blue-200">চলতি মাসের পেমেন্ট স্মরণ করিয়ে দেয়া</p>
            <p class="mt-1">
                আপনার পূর্বের কোনো বকেয়া নেই। শুধুমাত্র চলতি মাসের পেমেন্ট
                <span class="font-semibold text-blue-700 dark:text-blue-200">৳{{ number_format($monthlyFee, 0) }}</span>
                পরিশোধের অপেক্ষায় আছে।
            </p>
        </div>
        <button
            type="button"
            class="inline-flex items-center justify-center w-5 h-5 text-blue-500 transition hover:text-blue-700"
            x-on:click="open = false"
            aria-label="বন্ধ করুন"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@elseif($dueMonths > 0)
    <div
        x-data="{ open: true }"
        x-show="open"
        class="flex items-start gap-3 p-4 mb-4 text-sm text-orange-800 border border-orange-200 rounded-lg bg-orange-50 dark:bg-orange-900 dark:border-orange-700 dark:text-orange-100"
    >
        <div class="mt-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="font-semibold text-orange-700 dark:text-orange-200">বকেয়া পেমেন্ট সতর্কতা</p>
            <p class="mt-1">
                আপনার
                <span class="font-semibold text-red-600 dark:text-red-300">{{ $dueMonths }} মাসের</span>
                বকেয়া রয়েছে।
                প্রতি মাস
                <span class="font-semibold text-orange-700 dark:text-orange-200">৳{{ number_format($monthlyFee, 0) }}</span>
                হিসেবে মোট বকেয়া
                <span class="font-extrabold text-red-700 dark:text-red-300">৳{{ number_format($dueAmount, 0) }}</span>।
            </p>
            <p class="mt-1 text-xs text-orange-700 dark:text-orange-300">
                সংগঠন চালু থেকে বর্তমান মাস পর্যন্ত হিসাব।
            </p>
        </div>
        <button
            type="button"
            class="inline-flex items-center justify-center w-5 h-5 text-orange-500 transition hover:text-orange-700"
            x-on:click="open = false"
            aria-label="বন্ধ করুন"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif
