<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">নোটিফিকেশন</h1>
            <p class="mt-1 text-sm text-gray-600">আপনার সকল নোটিফিকেশন দেখুন</p>
        </div>
        @if($unreadCount > 0)
        <button wire:click="markAllAsRead" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            সকল পড়া হয়েছে চিহ্নিত করুন
        </button>
        @endif
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Notifications List -->
    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        @forelse ($notifications as $notification)
            <div class="border-b border-gray-200 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                <div class="flex items-start p-4 space-x-4">
                    <!-- Icon -->
                    <div class="flex-shrink-0">
                        @if(($notification->data['type'] ?? '') === 'payment_approved')
                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        @elseif(($notification->data['type'] ?? '') === 'payment_rejected')
                            <div class="flex items-center justify-center w-12 h-12 bg-red-100 rounded-full">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        @else
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $notification->data['message'] ?? 'নতুন নোটিফিকেশন' }}
                                </p>
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $notification->created_at->format('d M Y, h:i A') }}
                                    <span class="mx-1">•</span>
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                            @if(!$notification->read_at)
                                <span class="flex-shrink-0 inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                    নতুন
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        @if(!$notification->read_at)
                        <button wire:click="markAsRead('{{ $notification->id }}')"
                                class="text-blue-600 hover:text-blue-900"
                                title="পড়া হয়েছে চিহ্নিত করুন">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </button>
                        @endif
                        <button wire:click="deleteNotification('{{ $notification->id }}')"
                                wire:confirm="আপনি কি এই নোটিফিকেশনটি মুছে ফেলতে চান?"
                                class="text-red-600 hover:text-red-900"
                                title="মুছে ফেলুন">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-12 text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900">কোনো নোটিফিকেশন নেই</h3>
                <p class="mt-2 text-sm text-gray-500">আপনার কোনো নোটিফিকেশন নেই</p>
            </div>
        @endforelse

        <!-- Pagination -->
        @if($notifications->hasPages())
        <div class="px-6 py-4 bg-gray-50">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</div>
