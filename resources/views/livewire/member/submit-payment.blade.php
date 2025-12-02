<div class="py-6">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h2 class="text-2xl font-bold mb-6">Submit Monthly Payment</h2>

                <form wire:submit="submit">
                    <!-- Month -->
                    <div class="mb-4">
                        <label for="month" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Month</label>
                        <input wire:model="month" id="month" type="month" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required />
                        @error('month') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Amount -->
                    <div class="mb-4">
                        <label for="amount" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Amount (৳)</label>
                        <input wire:model="amount" id="amount" type="number" step="0.01" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required />
                        @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4">
                        <label for="method" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Payment Method</label>
                        <select wire:model="method" id="method" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="">Select Method</option>
                            @foreach($paymentMethods as $pm)
                                <option value="{{ $pm['type'] }}">{{ $pm['type'] }} ({{ $pm['number'] }})</option>
                            @endforeach
                        </select>
                        @error('method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Transaction ID -->
                    <div class="mb-4">
                        <label for="transaction_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Transaction ID</label>
                        <input wire:model="transaction_id" id="transaction_id" type="text" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required />
                        @error('transaction_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Screenshot -->
                    <div class="mb-4">
                        <label for="screenshot" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Screenshot (Optional)</label>
                        <input wire:model="screenshot" id="screenshot" type="file" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                        @error('screenshot') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="screenshot" class="text-sm text-gray-500 mt-2">Uploading...</div>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Note / Description</label>
                        <textarea wire:model="description" id="description" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                        @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Submit Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
