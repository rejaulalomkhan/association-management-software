<div class="max-w-7xl p-6 mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('documents.list') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-gray-600 transition-colors hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            ফিরে যান
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 md:grid-cols-3">
        <!-- Document Preview (Left Side - 2 columns on desktop) -->
        <div class="md:col-span-2">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6">
                    <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">ডকুমেন্ট প্রিভিউ</h2>
                    
                    @if($document->isPdf())
                        <!-- PDF Preview -->
                        <div class="border border-gray-300 rounded-lg dark:border-gray-600" style="height: 600px;">
                            <iframe 
                                src="{{ $document->file_url }}" 
                                class="w-full h-full rounded-lg"
                                frameborder="0"
                            ></iframe>
                        </div>
                    @elseif($document->isImage())
                        <!-- Image Preview -->
                        <div class="flex items-center justify-center border border-gray-300 rounded-lg dark:border-gray-600">
                            <img 
                                src="{{ $document->file_url }}" 
                                alt="{{ $document->subject }}" 
                                class="object-contain w-full rounded-lg max-h-96"
                            >
                        </div>
                    @else
                        <!-- Unsupported File Type -->
                        <div class="flex flex-col items-center justify-center p-12 border border-gray-300 rounded-lg dark:border-gray-600">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">প্রিভিউ উপলব্ধ নেই</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Document Details (Right Side - 1 column on desktop) -->
        <div class="md:col-span-1">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6">
                    <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">বিস্তারিত তথ্য</h2>
                    
                    <!-- Subject -->
                    <div class="mb-4">
                        <label class="block mb-1 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">বিষয়</label>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $document->subject }}</p>
                    </div>

                    <!-- Description -->
                    @if($document->description)
                        <div class="mb-4">
                            <label class="block mb-1 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">বর্ণনা</label>
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $document->description }}</p>
                        </div>
                    @endif

                    <!-- Uploader -->
                    <div class="mb-4">
                        <label class="block mb-1 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">আপলোডকারী</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $document->uploader->name }}</p>
                    </div>

                    <!-- Upload Date -->
                    <div class="mb-4">
                        <label class="block mb-1 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">আপলোড তারিখ</label>
                        <p class="text-sm text-gray-900 dark:text-white">{{ $document->created_at->format('d F Y, h:i A') }}</p>
                    </div>

                    <!-- File Info -->
                    <div class="mb-4">
                        <label class="block mb-1 text-xs font-medium text-gray-500 uppercase dark:text-gray-400">ফাইল তথ্য</label>
                        <div class="flex items-center gap-2">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded dark:bg-green-900 dark:text-green-200">
                                {{ strtoupper($document->file_type) }}
                            </span>
                            <span class="text-xs text-gray-600 dark:text-gray-400">{{ $document->formatted_file_size }}</span>
                        </div>
                    </div>

                    <!-- Download Button -->
                    <div class="pt-4 mt-6 border-t border-gray-200 dark:border-gray-700">
                        <a 
                            href="{{ $document->file_url }}" 
                            download="{{ $document->file_name }}"
                            class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            ডাউনলোড করুন
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
