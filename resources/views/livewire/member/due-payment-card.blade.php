<div class="overflow-hidden bg-gradient-to-br from-orange-50 to-red-50 border-l-4 border-orange-500 shadow-lg dark:from-gray-800 dark:to-gray-900 dark:border-orange-600 rounded-xl">
    <div class="p-6">
        @if($dueMonths > 0)
            <!-- Has Due -->
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-orange-100 rounded-full dark:bg-orange-900">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">বকেয়া পেমেন্ট</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        আপনার <span class="font-semibold text-orange-600 dark:text-orange-400">{{ $dueMonths }} মাসের</span> বকেয়া রয়েছে
                    </p>

                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <div class="p-3 bg-white rounded-lg dark:bg-gray-800">
                            <p class="text-xs text-gray-500 dark:text-gray-400">মোট মাস</p>
                            <p class="mt-1 text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalMonths }}</p>
                        </div>
                        <div class="p-3 bg-white rounded-lg dark:bg-gray-800">
                            <p class="text-xs text-gray-500 dark:text-gray-400">পরিশোধিত</p>
                            <p class="mt-1 text-xl font-bold text-green-600 dark:text-green-400">{{ $paidMonths }}</p>
                        </div>
                    </div>

                    <div class="p-4 mt-4 bg-orange-100 border border-orange-200 rounded-lg dark:bg-orange-900 dark:border-orange-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-orange-800 dark:text-orange-200">মোট বকেয়া</p>
                                <p class="text-xs text-orange-600 dark:text-orange-400">{{ $dueMonths }} মাস × ৳{{ number_format($monthlyFee, 0) }}</p>
                            </div>
                            <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">৳{{ number_format($dueAmount, 0) }}</p>
                        </div>
                    </div>

                    <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                        <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        সংগঠন চালু থেকে বর্তমান মাস পর্যন্ত হিসাব
                    </p>
                </div>
            </div>
        @else
            <!-- No Due -->
            <div class="flex items-start gap-4">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-green-100 rounded-full dark:bg-green-900">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-green-600 dark:text-green-400">অভিনন্দন!</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        আপনার পূর্বের কোনো বকেয়া নেই। সকল পেমেন্ট সম্পন্ন হয়েছে।
                    </p>

                    <div class="grid grid-cols-2 gap-3 mt-4">
                        <div class="p-3 bg-white rounded-lg dark:bg-gray-800">
                            <p class="text-xs text-gray-500 dark:text-gray-400">মোট মাস</p>
                            <p class="mt-1 text-xl font-bold text-gray-900 dark:text-gray-100">{{ $totalMonths }}</p>
                        </div>
                        <div class="p-3 bg-white rounded-lg dark:bg-gray-800">
                            <p class="text-xs text-gray-500 dark:text-gray-400">পরিশোধিত</p>
                            <p class="mt-1 text-xl font-bold text-green-600 dark:text-green-400">{{ $paidMonths }}</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 mt-4 bg-green-50 border border-green-200 rounded-lg dark:bg-green-900 dark:border-green-800">
                        <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium text-green-800 dark:text-green-200">সকল পেমেন্ট আপডেট</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
