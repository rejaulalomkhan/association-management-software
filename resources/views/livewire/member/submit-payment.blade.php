<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 md:text-3xl">পেমেন্ট জমা দিন</h1>

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Unpaid Months List -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">বকেয়া মাসের তালিকা</h2>

            @if(count($unpaidMonths) > 0)
            <div class="space-y-2 max-h-96 overflow-y-auto">
                @foreach($unpaidMonths as $month)
                <button
                    wire:click="selectMonth('{{ $month['month'] }}', {{ $month['year'] }})"
                    type="button"
                    class="w-full p-4 text-left rounded-lg border-2 transition-all
                        {{ $selectedMonth === $month['month'] && $selectedYear === $month['year']
                            ? 'border-indigo-500 bg-indigo-50'
                            : 'border-gray-200 hover:border-indigo-300' }}">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-900">{{ $month['month_bn'] }} {{ $month['year'] }}</p>
                            <p class="text-sm text-gray-500">{{ $month['month'] }} {{ $month['year'] }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-bold text-indigo-600">৳{{ number_format($month['amount'], 2) }}</p>
                            @if($selectedMonth === $month['month'] && $selectedYear === $month['year'])
                            <p class="text-xs text-indigo-600">নির্বাচিত ✓</p>
                            @endif
                        </div>
                    </div>
                </button>
                @endforeach
            </div>
            @else
            <div class="text-center py-8 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="mt-4">সব মাসের পেমেন্ট জমা দেওয়া হয়েছে! 🎉</p>
            </div>
            @endif
        </div>

        <!-- Payment Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">পেমেন্ট তথ্য</h2>

            @if($selectedMonth && $selectedYear)
            <form wire:submit.prevent="submit" class="space-y-4">
                <div class="p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                    <p class="text-sm text-gray-600 mb-1">নির্বাচিত মাস</p>
                    <p class="text-xl font-bold text-indigo-700">{{ $selectedMonth }} {{ $selectedYear }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">পরিমাণ (৳)</label>
                    <input type="number" wire:model="amount" step="0.01"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">পেমেন্ট মাধ্যম</label>
                    <select wire:model="payment_method_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">নির্বাচন করুন</option>
                        @foreach($paymentMethods as $method)
                        <option value="{{ $method->id }}">{{ $method->localized_name }}</option>
                        @endforeach
                    </select>
                    @error('payment_method_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">পেমেন্ট প্রমাণ (স্ক্রিনশট)</label>
                    <input type="file" wire:model="proof" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @error('proof') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @if($proof)
                    <p class="text-sm text-green-600 mt-1">✓ ফাইল নির্বাচিত</p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">বিবরণ (ঐচ্ছিক)</label>
                    <textarea wire:model="description" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                        placeholder="অতিরিক্ত তথ্য লিখুন..."></textarea>
                    @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit"
                    class="w-full px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    পেমেন্ট জমা দিন
                </button>
            </form>
            @else
            <div class="text-center py-12 text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="mt-4">বামদিক থেকে একটি মাস নির্বাচন করুন</p>
            </div>
            @endif
        </div>
    </div>
</div>
