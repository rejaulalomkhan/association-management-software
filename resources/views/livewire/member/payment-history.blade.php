<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800">লেনদেন ইতিহাস</h1>
        <a href="{{ route('member.dashboard') }}" wire:navigate
            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
            ← ফিরে যান
        </a>
    </div>

    @if (session()->has('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">মাস</label>
                <select wire:model.live="filterMonth"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">সব মাস</option>
                    @foreach($months as $monthEn => $monthBn)
                        <option value="{{ $monthEn }}">{{ $monthBn }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">বছর</label>
                <select wire:model.live="filterYear"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">সব বছর</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">স্ট্যাটাস</label>
                <select wire:model.live="filterStatus"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">সব স্ট্যাটাস</option>
                    <option value="pending">অপেক্ষমাণ</option>
                    <option value="approved">অনুমোদিত</option>
                    <option value="rejected">প্রত্যাখ্যাত</option>
                </select>
            </div>

            <div class="flex items-end">
                <button wire:click="$set('filterMonth', ''); $set('filterYear', ''); $set('filterStatus', '')"
                    class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                    ফিল্টার রিসেট করুন
                </button>
            </div>
        </div>
    </div>

    <!-- Payments List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($payments->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            তারিখ
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            মাস/বছর
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            পরিমাণ
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            পেমেন্ট মাধ্যম
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            লেনদেন আইডি
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            স্ট্যাটাস
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            অ্যাকশন
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($payments as $payment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $months[$payment->month] ?? $payment->month }} {{ $payment->year }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            ৳{{ number_format($payment->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $payment->paymentMethod->localized_name ?? $payment->method }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                            {{ $payment->transaction_id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($payment->status === 'approved')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    অনুমোদিত
                                </span>
                            @elseif($payment->status === 'pending')
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    অপেক্ষমাণ
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    প্রত্যাখ্যাত
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button wire:click="viewDetails({{ $payment->id }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    বিস্তারিত
                                </button>
                                @if($payment->status === 'approved')
                                    <button wire:click="downloadReceipt({{ $payment->id }})"
                                        class="text-green-600 hover:text-green-900">
                                        রসিদ
                                    </button>
                                @elseif($payment->status === 'rejected')
                                    <button wire:click="editRejectedPayment({{ $payment->id }})"
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-orange-600 rounded hover:bg-orange-700 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        পুনরায় জমা
                                    </button>
                                    <button wire:click="deleteRejectedPayment({{ $payment->id }})"
                                        wire:confirm="আপনি কি নিশ্চিত যে এই পেমেন্ট মুছে ফেলতে চান? এটি পুনরুদ্ধার করা যাবে না।"
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-red-600 rounded hover:bg-red-700 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        মুছুন
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $payments->links() }}
        </div>
        @else
        <div class="px-6 py-12 text-center text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="mt-4 text-lg">কোনো লেনদেন পাওয়া যায়নি</p>
            <p class="mt-2 text-sm">ফিল্টার পরিবর্তন করে আবার চেষ্টা করুন</p>
        </div>
        @endif
    </div>

    <!-- Payment Details Modal -->
    @if($showDetailsModal && $selectedPayment)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50"
        x-data="{ show: @entangle('showDetailsModal') }"
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">

        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-lg bg-white"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100">

            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">পেমেন্ট বিস্তারিত</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="py-4 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">লেনদেন আইডি</p>
                        <p class="font-semibold text-gray-900 font-mono">{{ $selectedPayment->transaction_id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">স্ট্যাটাস</p>
                        @if($selectedPayment->status === 'approved')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                অনুমোদিত
                            </span>
                        @elseif($selectedPayment->status === 'pending')
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                অপেক্ষমাণ
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                প্রত্যাখ্যাত
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">মাস/বছর</p>
                        <p class="font-semibold text-gray-900">{{ $months[$selectedPayment->month] ?? $selectedPayment->month }} {{ $selectedPayment->year }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">পরিমাণ</p>
                        <p class="font-semibold text-gray-900 text-lg">৳{{ number_format($selectedPayment->amount, 2) }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">পেমেন্ট মাধ্যম</p>
                        <p class="font-semibold text-gray-900">{{ $selectedPayment->paymentMethod->localized_name ?? $selectedPayment->method }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">জমার তারিখ</p>
                        <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($selectedPayment->created_at)->format('d M Y, h:i A') }}</p>
                    </div>
                </div>

                @if($selectedPayment->proof_path)
                <div>
                    <p class="text-sm text-gray-500 mb-2">পেমেন্ট প্রমাণ</p>
                    <img src="{{ asset('storage/' . $selectedPayment->proof_path) }}"
                        alt="Payment Proof"
                        class="w-full max-h-64 object-contain border rounded-lg">
                </div>
                @endif

                @if($selectedPayment->admin_note)
                <div>
                    <p class="text-sm text-gray-500">অ্যাডমিন নোট</p>
                    <p class="font-medium text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $selectedPayment->admin_note }}</p>
                </div>
                @endif

                @if($selectedPayment->status === 'approved')
                <div>
                    <p class="text-sm text-gray-500">অনুমোদনের তারিখ</p>
                    <p class="font-semibold text-gray-900">{{ $selectedPayment->updated_at->format('d M Y, h:i A') }}</p>
                </div>
                @endif
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                @if($selectedPayment->status === 'rejected')
                    <button wire:click="editRejectedPayment({{ $selectedPayment->id }})"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-lg hover:bg-orange-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        পুনরায় জমা করুন
                    </button>
                    <button wire:click="deleteRejectedPayment({{ $selectedPayment->id }})"
                            wire:confirm="আপনি কি নিশ্চিত যে এই পেমেন্ট মুছে ফেলতে চান? এটি পুনরুদ্ধার করা যাবে না।"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        মুছে ফেলুন
                    </button>
                @endif
                <button wire:click="closeModal"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    বন্ধ করুন
                </button>
                @if($selectedPayment->status === 'approved')
                <button wire:click="downloadReceipt({{ $selectedPayment->id }})"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    রসিদ ডাউনলোড করুন
                </button>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
