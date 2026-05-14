<div class="max-w-3xl p-6 mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">নতুন ডকুমেন্ট যুক্ত করুন</h1>
            <p class="mt-1 text-gray-600 dark:text-gray-400">PDF বা ছবি আপলোড করুন</p>
        </div>
        <a href="{{ route('documents.list') }}" wire:navigate class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            ফিরে যান
        </a>
    </div>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
            {{ session('success') }}
        </div>
    @endif

    <!-- Validation Errors Summary -->
    @if ($errors->any())
        <div x-data="{ show: true }" 
             x-init="$nextTick(() => { 
                 if (show) { 
                     $el.scrollIntoView({ behavior: 'smooth', block: 'start' }); 
                     window.scrollBy(0, -20);
                 } 
             })"
             class="p-4 mb-6 border-l-4 border-red-500 bg-red-50 dark:bg-red-900/30 dark:border-red-600">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="flex-1">
                    <p class="mb-2 text-sm font-semibold text-red-800 dark:text-red-200">ফর্ম সাবমিট করতে সমস্যা হয়েছে। নিচের ত্রুটিগুলো সংশোধন করুন:</p>
                    <ul class="space-y-1 text-xs text-red-700 list-disc list-inside dark:text-red-300">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Upload Form -->
    <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <form wire:submit.prevent="submitDocument" class="p-6 space-y-6">
            <!-- Subject -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">বিষয় *</label>
                <input 
                    type="text" 
                    wire:model="subject" 
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                    placeholder="ডকুমেন্টের বিষয় লিখুন"
                >
                @error('subject') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">বর্ণনা (ঐচ্ছিক)</label>
                <textarea 
                    wire:model="description" 
                    rows="4" 
                    class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                    placeholder="ডকুমেন্ট সম্পর্কে সংক্ষিপ্ত বর্ণনা লিখুন..."
                ></textarea>
                @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- File Upload -->
            <div x-data="{ fileName: '', previewUrl: '', fileType: '' }">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">ডকুমেন্ট ফাইল *</label>
                
                <!-- Upload Area -->
                <div class="flex gap-2">
                    <label class="flex-1 flex flex-col items-center justify-center px-4 py-8 text-center border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:border-gray-600 hover:border-green-400 dark:hover:border-green-500 transition-colors">
                        <svg class="w-12 h-12 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <p class="mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                            <span class="text-green-600">ক্লিক করুন</span> অথবা ড্র্যাগ করুন
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">PDF, JPG, JPEG, PNG (সর্বোচ্চ ১০ এমবি)</p>
                        <input 
                            type="file" 
                            wire:model="document_file" 
                            class="hidden"
                            accept=".pdf,.jpg,.jpeg,.png"
                            x-on:change="
                                fileName = $event.target.files[0]?.name || '';
                                fileType = $event.target.files[0]?.type || '';
                                if ($event.target.files[0] && fileType.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => previewUrl = e.target.result;
                                    reader.readAsDataURL($event.target.files[0]);
                                } else {
                                    previewUrl = '';
                                }
                            "
                        >
                    </label>
                </div>

                <!-- Loading Indicator -->
                <div wire:loading wire:target="document_file" class="mt-3">
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-5 h-5 text-green-600 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>আপলোড হচ্ছে...</span>
                    </div>
                </div>

                <!-- File Preview -->
                <div x-show="fileName" class="mt-3">
                    <div class="p-3 border border-gray-200 rounded-lg dark:border-gray-700">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white" x-text="fileName"></p>
                            </div>
                        </div>
                        
                        <!-- Image Preview -->
                        <div x-show="previewUrl" class="mt-3">
                            <img :src="previewUrl" alt="Preview" class="object-contain w-full border border-gray-200 rounded-lg max-h-48 dark:border-gray-600">
                        </div>
                    </div>
                </div>

                @error('document_file') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex gap-3 pt-4">
                <button 
                    type="submit" 
                    class="flex-1 px-6 py-3 text-sm font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                    wire:loading.attr="disabled"
                    wire:target="submitDocument"
                >
                    <span wire:loading.remove wire:target="submitDocument">ডকুমেন্ট সাবমিট করুন</span>
                    <span wire:loading wire:target="submitDocument">সাবমিট হচ্ছে...</span>
                </button>
            </div>
        </form>
    </div>
</div>
