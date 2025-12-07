<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">হিসাবরক্ষক ড্যাশবোর্ড</h1>
        <p class="text-sm text-gray-600 mt-1">পেমেন্ট অনুমোদন ও প্রত্যাখ্যান ব্যবস্থাপনা</p>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

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

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium">অপেক্ষমাণ</h3>
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
            <p class="text-sm opacity-90 mt-1">পেমেন্ট অপেক্ষমাণ</p>
        </div>

        <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium">আজ অনুমোদিত</h3>
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold">{{ $stats['approved_today'] }}</p>
            <p class="text-sm opacity-90 mt-1">পেমেন্ট অনুমোদিত</p>
        </div>

        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium">আজকের আদায়</h3>
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold">৳{{ number_format($stats['total_amount_today'], 2) }}</p>
            <p class="text-sm opacity-90 mt-1">মোট টাকা</p>
        </div>

        <div class="bg-gradient-to-br from-red-400 to-red-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium">আজ প্রত্যাখ্যাত</h3>
                <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-3xl font-bold">{{ $stats['rejected_today'] }}</p>
            <p class="text-sm opacity-90 mt-1">পেমেন্ট প্রত্যাখ্যাত</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">মাস</label>
                <select wire:model.live="filterMonth"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">সব মাস</option>
                    @foreach($months as $monthEn => $monthBn)
                        <option value="{{ $monthEn }}">{{ $monthBn }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">বছর</label>
                <select wire:model.live="filterYear"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">সব বছর</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button wire:click="$set('filterMonth', ''); $set('filterYear', '')"
                    class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium">
                    ফিল্টার রিসেট
                </button>
            </div>
        </div>
    </div>

    <!-- Pending Payments Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">অপেক্ষমাণ পেমেন্ট তালিকা</h2>
        </div>

        @if($pendingPayments->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">সদস্য</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">মাস/বছর</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">পরিমাণ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">মাধ্যম</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">তারিখ</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pendingPayments as $payment)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($payment->user->profile_pic)
                                    <img src="{{ asset('storage/' . $payment->user->profile_pic) }}"
                                        alt="{{ $payment->user->name }}"
                                        class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-600 font-medium">{{ substr($payment->user->name, 0, 2) }}</span>
                                    </div>
                                @endif
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $payment->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $payment->user->membership_id }}</p>
                                </div>
                            </div>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($payment->created_at)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <button wire:click="viewDetails({{ $payment->id }})"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                                বিস্তারিত দেখুন
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $pendingPayments->links() }}
        </div>
        @else
        <div class="px-6 py-12 text-center text-gray-500">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="mt-4 text-lg">কোনো অপেক্ষমাণ পেমেন্ট নেই</p>
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
        x-transition:enter-end="opacity-100">

        <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-lg bg-white"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">

            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">পেমেন্ট অনুমোদন/প্রত্যাখ্যান</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="py-4 space-y-4">
                <!-- Member Info -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center space-x-4">
                        @if($selectedPayment->user->profile_pic)
                            <img src="{{ asset('storage/' . $selectedPayment->user->profile_pic) }}"
                                alt="{{ $selectedPayment->user->name }}"
                                class="h-16 w-16 rounded-full object-cover">
                        @else
                            <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-700 font-bold text-xl">{{ substr($selectedPayment->user->name, 0, 2) }}</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-900 text-lg">{{ $selectedPayment->user->name }}</p>
                            <p class="text-sm text-gray-600">সদস্য নম্বর: {{ $selectedPayment->user->membership_id }}</p>
                            <p class="text-sm text-gray-600">ফোন: {{ $selectedPayment->user->phone }}</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">লেনদেন আইডি</p>
                        <p class="font-semibold text-gray-900 font-mono">{{ $selectedPayment->transaction_id }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">মাস/বছর</p>
                        <p class="font-semibold text-gray-900">{{ $months[$selectedPayment->month] ?? $selectedPayment->month }} {{ $selectedPayment->year }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">পরিমাণ</p>
                        <p class="font-semibold text-gray-900 text-lg">৳{{ number_format($selectedPayment->amount, 2) }}</p>
                    </div>
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
                        class="w-full max-h-96 object-contain border rounded-lg">
                </div>
                @endif

                <!-- Approval Note -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">অনুমোদন নোট (ঐচ্ছিক)</label>
                    <textarea wire:model="approvalNote" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500"
                        placeholder="অনুমোদনের জন্য কোনো মন্তব্য..."></textarea>
                </div>

                <!-- Rejection Reason -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">প্রত্যাখ্যানের কারণ</label>
                    <textarea wire:model="rejectionReason" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                        placeholder="প্রত্যাখ্যান করলে কারণ উল্লেখ করুন..."></textarea>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-between space-x-3 pt-4 border-t">
                <button wire:click="closeModal"
                    class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                    বন্ধ করুন
                </button>
                <div class="flex space-x-3">
                    <button wire:click="rejectPayment"
                        class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        প্রত্যাখ্যান করুন
                    </button>
                    <button wire:click="approvePayment"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        অনুমোদন করুন
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
