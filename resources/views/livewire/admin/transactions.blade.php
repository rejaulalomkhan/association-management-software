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
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">তারিখ</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">কার্যক্রম</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($transaction->user->photo)
                                        <img src="{{ asset('storage/' . $transaction->user->photo) }}" alt="{{ $transaction->user->name }}" class="object-cover w-10 h-10 rounded-full">
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
                                                class="text-green-600 hover:text-green-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                        <button wire:click="rejectPayment({{ $transaction->id }})"
                                                wire:confirm="আপনি কি এই পেমেন্ট প্রত্যাখ্যান করতে চান?"
                                                class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    @endif
                                    <button wire:click="openNoteModal({{ $transaction->id }})"
                                            class="text-blue-600 hover:text-blue-900"
                                            title="নোট যোগ করুন">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    @if ($transaction->proof_image)
                                        <a href="{{ asset('storage/' . $transaction->proof_image) }}" target="_blank"
                                           class="text-purple-600 hover:text-purple-900"
                                           title="প্রমাণপত্র দেখুন">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </a>
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
                <h3 class="mb-4 text-lg font-semibold">অ্যাডমিন নোট</h3>

                <div class="mb-4">
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
                            class="px-4 py-2 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                        সংরক্ষণ করুন
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
