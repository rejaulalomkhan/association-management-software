<div class="py-2 sm:py-6" x-data="{ successMessage: '' }" @notify.window="successMessage = $event.detail.message; setTimeout(() => successMessage = '', 5000)">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Success Message -->
        <template x-if="successMessage">
            <div x-transition
                 class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-800 dark:text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-green-800 dark:text-green-200 font-medium" x-text="successMessage"></span>
                </div>
            </div>
        </template>

        <!-- Error Messages -->
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900 dark:text-red-200 dark:border-red-800">
                {{ session('error') }}
            </div>
        @endif

        <!-- Top Cards Section -->
        <div class="grid gap-4 mb-6 md:grid-cols-2">
            <!-- Total Balance Card -->
            <div class="p-6 bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-100">মোট ব্যাংক ব্যালেন্স</p>
                        <h3 class="text-3xl font-bold mt-2">৳{{ number_format($totalBalance, 2) }}</h3>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-full">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Bank Account Details Card -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">ব্যাংক একাউন্ট বিবরণ</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">ব্যাংক নাম:</span>
                        <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bankDetails['name'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">একাউন্ট নম্বর:</span>
                        <span class="font-mono font-medium text-gray-900 dark:text-gray-100">{{ $bankDetails['account_number'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">শাখা:</span>
                        <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bankDetails['branch'] }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">একাউন্ট হোল্ডার:</span>
                        <span class="font-medium text-gray-900 dark:text-gray-100">{{ $bankDetails['account_holder'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deposit Entry Button (Admin/Accountant Only) -->
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('accountant'))
            <div class="mb-6">
                <livewire:admin.bank-deposit-form />
            </div>
        @endif

        <!-- Year Filter and History Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">ব্যাংক ট্রানজেকশন হিস্ট্রি</h2>
                    
                    <!-- Year Filter -->
                    <div class="flex items-center gap-2">
                        <label for="year-filter" class="text-sm font-medium text-gray-700 dark:text-gray-300">বছর:</label>
                        <select wire:model.live="selectedYear" id="year-filter" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($years as $year)
                                <option value="{{ $year }}">{{ $year === 'all' ? 'সকল বছর' : $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">তারিখ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">টাইপ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">মাস</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">টাকার পরিমাণ</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ব্যালেন্স</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">এন্ট্রি করেছেন</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ছবি</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($deposits as $deposit)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $deposit->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($deposit->transaction_type === 'deposit')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            জমা
                                        </span>
                                    @elseif($deposit->transaction_type === 'withdrawal')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            উত্তোলন
                                        </span>
                                    @elseif($deposit->transaction_type === 'deduction')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                            ব্যাংক কর্তন
                                        </span>
                                    @elseif($deposit->transaction_type === 'profit')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            ব্যাংক মুনাফা
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $deposit->month_name }}, {{ $deposit->year }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium {{ in_array($deposit->transaction_type, ['deposit', 'profit']) ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ in_array($deposit->transaction_type, ['withdrawal', 'deduction']) ? '-' : '+' }}৳{{ number_format($deposit->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    ৳{{ number_format($deposit->balance_after, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ $deposit->depositor->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ $deposit->bank_message_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 dark:text-blue-400" title="ব্যাংক মেসেজ">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </a>
                                        @if($deposit->bank_receipt)
                                            <a href="{{ $deposit->bank_receipt_url }}" target="_blank" class="text-purple-600 hover:text-purple-800 dark:text-purple-400" title="রশীদ">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="text-lg font-medium">কোনো ট্রানজেকশন পাওয়া যায়নি</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($deposits->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $deposits->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
