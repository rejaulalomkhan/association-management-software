<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">লেনদেন ব্যবস্থাপনা</h1>
        <p class="mt-1 text-gray-600">সকল পেমেন্ট লেনদেন দেখুন এবং পরিচালনা করুন</p>
    </div>

    <!-- Filters -->
    <div class="p-6 mb-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-5">
            <!-- Month Filter -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">মাস</label>
                <select wire:model.live="selectedMonth" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">সকল মাস</option>
                    <option value="1">জানুয়ারি</option>
                    <option value="2">ফেব্রুয়ারি</option>
                    <option value="3">মার্চ</option>
                    <option value="4">এপ্রিল</option>
                    <option value="5">মে</option>
                    <option value="6">জুন</option>
                    <option value="7">জুলাই</option>
                    <option value="8">আগস্ট</option>
                    <option value="9">সেপ্টেম্বর</option>
                    <option value="10">অক্টোবর</option>
                    <option value="11">নভেম্বর</option>
                    <option value="12">ডিসেম্বর</option>
                </select>
            </div>

            <!-- Year Filter -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">বছর</label>
                <select wire:model.live="selectedYear" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">সকল বছর</option>
                    @for ($year = date('Y'); $year >= 2024; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>

            <!-- Member Filter -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">সদস্য</label>
                <select wire:model.live="selectedMember" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">সকল সদস্য</option>
                    @foreach ($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->membership_id }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">অবস্থা</label>
                <select wire:model.live="selectedStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">সকল অবস্থা</option>
                    <option value="pending">অপেক্ষমাণ</option>
                    <option value="approved">অনুমোদিত</option>
                    <option value="rejected">প্রত্যাখ্যাত</option>
                </select>
            </div>

            <!-- Export Button -->
            <div class="flex items-end">
                <button wire:click="exportReport" class="flex items-center justify-center w-full px-4 py-2 text-white transition bg-green-600 rounded-lg hover:bg-green-700">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    রিপোর্ট এক্সপোর্ট
                </button>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-400 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Transactions Table -->
    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">সদস্য</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">মাস/বছর</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">পরিমাণ</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">পেমেন্ট মাধ্যম</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">অবস্থা</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">পেমেন্ট পরিশোধের তারিখ</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">কার্যক্রম</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @php
                                        $profilePic = $transaction->user->profile_pic ?? $transaction->user->photo ?? null;
                                    @endphp
                                    @if ($profilePic)
                                        <img src="{{ asset('storage/' . $profilePic) }}" alt="{{ $transaction->user->name }}" class="object-cover w-10 h-10 rounded-full">
                                    @else
                                        <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-blue-500 rounded-full">
                                            {{ strtoupper(substr($transaction->user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $transaction->user->membership_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ \App\Helpers\BanglaHelper::getBanglaMonth($transaction->month) }} {{ $transaction->year }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                ৳{{ number_format($transaction->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ $transaction->paymentMethod->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($transaction->status === 'pending')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                        অপেক্ষমাণ
                                    </span>
                                @elseif ($transaction->status === 'approved')
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                        অনুমোদিত
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                        প্রত্যাখ্যাত
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $transaction->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <div class="flex space-x-2">
                                    @if ($transaction->status === 'pending')
                                        <button wire:click="approvePayment({{ $transaction->id }})"
                                                wire:confirm="আপনি কি এই পেমেন্ট অনুমোদন করতে চান?"
                                                class="text-green-600 cursor-pointer hover:text-green-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                        <button wire:click="openNoteModal({{ $transaction->id }})"
                                                class="text-red-600 cursor-pointer hover:text-red-900"
                                                title="পেমেন্ট প্রত্যাখ্যান করুন">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endif
                                    <!-- View details -->
                                    <button wire:click="viewPayment({{ $transaction->id }})"
                                            class="text-gray-700 cursor-pointer hover:text-gray-900"
                                            title="বিস্তারিত দেখুন">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                        <button wire:click="openNoteModal({{ $transaction->id }})"
                                            class="text-blue-600 cursor-pointer hover:text-blue-900"
                                            title="নোট যোগ করুন">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    @if ($transaction->status === 'approved')
                                        <!-- Download receipt for approved payments -->
                                        <button wire:click="downloadReceipt({{ $transaction->id }})"
                                                class="text-green-700 cursor-pointer hover:text-green-900"
                                                title="রিসিপ্ট ডাউনলোড করুন">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                কোনো লেনদেন পাওয়া যায়নি
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50">
            {{ $transactions->links() }}
        </div>
    </div>

    <!-- Note Modal -->
    <div x-data="{ open: false }"
         @open-note-modal.window="open = true"
         @close-note-modal.window="open = false"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50" @click="open = false"></div>

            <div class="z-50 w-full max-w-lg p-6 bg-white rounded-lg shadow-xl">
                <h3 class="mb-4 text-lg font-semibold">পেমেন্ট প্রত্যাখ্যান</h3>

                <p class="mb-3 text-sm text-gray-600">আপনি চাইলে নিচে কারণ লিখতে পারেন। কারণ না লিখলেও প্রত্যাখ্যান করা যাবে।</p>

                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">অ্যাডমিন নোট (ঐচ্ছিক)</label>
                    <textarea wire:model="adminNote"
                              rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="এখানে নোট লিখুন..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button @click="open = false"
                            class="px-4 py-2 text-gray-700 transition bg-gray-300 rounded-lg hover:bg-gray-400">
                        বাতিল
                    </button>
                    <button wire:click="saveNote"
                            wire:then="rejectPayment({{ $selectedPaymentId ?? 'null' }})"
                            class="px-4 py-2 text-white transition bg-red-600 rounded-lg hover:bg-red-700">
                        নিশ্চিত করে প্রত্যাখ্যান করুন
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- View Payment Modal -->
    <div x-data="{ open: false }"
         @open-view-modal.window="open = true"
         x-show="open"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50" @click="open = false"></div>

            <div class="z-50 w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
                <h3 class="mb-4 text-lg font-semibold">পেমেন্ট বিস্তারিত</h3>

                @if ($selectedPaymentForView)
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <p class="text-sm text-gray-500">সদস্য</p>
                            <p class="text-sm font-medium text-gray-900">{{ $selectedPaymentForView->user->name }} ({{ $selectedPaymentForView->user->membership_id }})</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">মাস/বছর</p>
                            <p class="text-sm font-medium text-gray-900">{{ \App\Helpers\BanglaHelper::getBanglaMonth($selectedPaymentForView->month) }} {{ $selectedPaymentForView->year }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">পরিমাণ</p>
                            <p class="text-sm font-medium text-gray-900">৳{{ number_format($selectedPaymentForView->amount, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">পেমেন্ট মাধ্যম</p>
                            <p class="text-sm font-medium text-gray-900">{{ optional($selectedPaymentForView->paymentMethod)->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">রেফারেন্স / ট্রানজেকশন আইডি</p>
                            <p class="text-sm font-medium text-gray-900">{{ $selectedPaymentForView->transaction_id ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">অবস্থা</p>
                            <p class="text-sm font-medium text-gray-900">{{ $selectedPaymentForView->status }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">সাবমিটের তারিখ</p>
                            <p class="text-sm font-medium text-gray-900">{{ optional($selectedPaymentForView->created_at)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">অনুমোদনকারী</p>
                            <p class="text-sm font-medium text-gray-900">{{ optional($selectedPaymentForView->approver)->name ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">মেম্বারের নোট</p>
                            <p class="text-sm text-gray-900">{{ $selectedPaymentForView->description ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">অ্যাডমিন নোট</p>
                            <p class="text-sm text-gray-900">{{ $selectedPaymentForView->admin_note ?? '-' }}</p>
                        </div>
                    </div>

                    @if ($selectedPaymentForView->proof_path)
                        <div class="mt-4">
                            <p class="mb-2 text-sm text-gray-500">প্রমাণপত্র (স্ক্রিনশট/ছবি)</p>
                            <a href="{{ asset('storage/' . $selectedPaymentForView->proof_path) }}" target="_blank">
                                <img src="{{ asset('storage/' . $selectedPaymentForView->proof_path) }}" alt="Proof" class="object-contain w-full border rounded-lg max-h-80">
                            </a>
                        </div>
                    @endif
                @endif

                <div class="flex justify-end mt-6">
                    <button @click="open = false"
                            class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded-lg hover:bg-gray-300">
                        বন্ধ করুন
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
