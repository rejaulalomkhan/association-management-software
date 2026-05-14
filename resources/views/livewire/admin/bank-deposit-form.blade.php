<div>
    <!-- Toggle Button -->
    @if(!$showForm)
        <button wire:click="toggleForm" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            নতুন ট্রানজেকশন এন্ট্রি
        </button>
    @endif

    <!-- Form Modal -->
    @if($showForm)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">ব্যাংক ট্রানজেকশন এন্ট্রি</h3>
                <button wire:click="toggleForm" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="save" class="space-y-6">
                <!-- Transaction Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ট্রানজেকশন টাইপ</label>
                    <div class="flex flex-wrap gap-4">
                        <label class="flex items-center">
                            <input type="radio" wire:model.live="transactionType" value="deposit" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">টাকা জমা</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model.live="transactionType" value="withdrawal" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">টাকা উত্তোলন</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model.live="transactionType" value="deduction" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">ব্যাংক কর্তন</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" wire:model.live="transactionType" value="profit" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">ব্যাংক মুনাফা</span>
                        </label>
                    </div>
                    @error('transactionType') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>

                <!-- Month and Year -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">মাস</label>
                        <select wire:model.live="month" id="month" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
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
                        @error('month') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">বছর</label>
                        <select wire:model.live="year" id="year" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($years as $yearOption)
                                <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                            @endforeach
                        </select>
                        @error('year') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Duplicate Month Warning -->
                @if($isDuplicate)
                    <div class="p-3 text-sm text-orange-800 bg-orange-100 border border-orange-200 rounded-lg dark:bg-orange-900 dark:text-orange-200 dark:border-orange-800">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div>
                                <p class="font-semibold">সতর্কতা!</p>
                                <p class="mt-1">এই মাসের জন্য ইতিমধ্যে জমা এন্ট্রি করা হয়েছে। আপনি কি নিশ্চিত যে আবার এন্ট্রি করতে চান?</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">টাকার পরিমাণ (৳)</label>
                    <input type="number" wire:model="amount" id="amount" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="0.00">
                    @error('amount') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>

                <!-- Bank Message Screenshot -->
                <div>
                    <label for="bankMessage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ব্যাংক মেসেজ স্ক্রিনশট <span class="text-red-500">*</span></label>
                    <input type="file" wire:model="bankMessage" id="bankMessage" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('bankMessage') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    
                    @if ($bankMessage)
                        <div class="mt-2">
                            <img src="{{ $bankMessage->temporaryUrl() }}" class="h-32 rounded border border-gray-300">
                        </div>
                    @endif
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">সর্বোচ্চ 5MB, JPG, PNG</p>
                </div>

                <!-- Bank Receipt (Optional) -->
                <div>
                    <label for="bankReceipt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ব্যাংক রশীদ (ঐচ্ছিক)</label>
                    <input type="file" wire:model="bankReceipt" id="bankReceipt" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('bankReceipt') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                    
                    @if ($bankReceipt)
                        <div class="mt-2">
                            <img src="{{ $bankReceipt->temporaryUrl() }}" class="h-32 rounded border border-gray-300">
                        </div>
                    @endif
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">সর্বোচ্চ 5MB, JPG, PNG</p>
                </div>

                <!-- Notes -->
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">নোট (ঐচ্ছিক)</label>
                    <textarea wire:model="notes" id="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="অতিরিক্ত তথ্য..."></textarea>
                    @error('notes') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" wire:click="toggleForm" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        বাতিল
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
