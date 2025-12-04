<div class="py-6" x-data="{ showEditModal: false }" @close-modal.window="showEditModal = false">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Success Messages -->
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('password_message'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                {{ session('password_message') }}
            </div>
        @endif

        <!-- Profile Card -->
        <div class="mb-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6">
                <div class="flex flex-col items-center space-y-4 text-center sm:flex-row sm:text-left sm:items-start sm:space-y-0 sm:space-x-6">
                    <!-- Profile Picture -->
                    <div class="flex-shrink-0">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="object-cover w-24 h-24 border-4 border-gray-300 rounded-full sm:w-32 sm:h-32">
                        @else
                            <div class="flex items-center justify-center w-24 h-24 text-3xl font-bold text-white bg-blue-500 border-4 border-gray-300 rounded-full sm:w-32 sm:h-32 sm:text-4xl">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ auth()->user()->name }}</h2>
                                @if(auth()->user()->membership_id)
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">সদস্য আইডি: <span class="font-mono font-semibold">{{ auth()->user()->membership_id }}</span></p>
                                @endif
                            </div>
                            @if(auth()->user()->blood_group)
                            <div class="flex-shrink-0 ml-4">
                                <div class="px-4 py-2 text-center bg-red-100 border-2 border-red-300 rounded-lg dark:bg-red-900 dark:border-red-700">
                                    <div class="text-xs font-medium text-red-600 dark:text-red-300">রক্তের গ্রুপ</div>
                                    <div class="text-2xl font-bold text-red-700 dark:text-red-200">{{ auth()->user()->blood_group }}</div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mt-3 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                            @if(auth()->user()->phone)
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span class="font-medium">ফোন:</span> <span class="ml-1">{{ auth()->user()->phone }}</span>
                            </p>
                            @endif
                            @if(auth()->user()->email)
                            <p class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="font-medium">ইমেইল:</span> <span class="ml-1">{{ auth()->user()->email }}</span>
                            </p>
                            @endif
                            @if(auth()->user()->permanent_address)
                            <p class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium">স্থায়ী ঠিকানা:</span> <span class="ml-1">{{ auth()->user()->permanent_address }}</span>
                            </p>
                            @endif
                            @if(auth()->user()->present_address && auth()->user()->present_address !== auth()->user()->permanent_address)
                            <p class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-medium">বর্তমান ঠিকানা:</span> <span class="ml-1">{{ auth()->user()->present_address }}</span>
                            </p>
                            @endif
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="flex-shrink-0">
                        <a href="{{ role_route('profile.edit') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            প্রোফাইল সম্পাদনা
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
            <!-- Total Paid Card -->
            <div class="overflow-hidden bg-white border-t-4 border-green-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">মোট পরিশোধিত</p>
                            <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">৳{{ number_format($totalPaid, 2) }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $paidMonths }} মাস</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Due Card -->
            <div class="overflow-hidden bg-white border-t-4 border-red-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">বকেয়া</p>
                            <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">৳{{ number_format($totalDue, 2) }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $dueMonths }} মাস</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Payment Card -->
            <div class="overflow-hidden bg-white border-t-4 border-yellow-500 shadow-md dark:bg-gray-800 rounded-xl">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">অপেক্ষমান পেমেন্ট</p>
                            <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">৳{{ number_format($pendingAmount, 2) }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ $pendingMonths }} মাস</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6">
                <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-gray-100">আমার ট্রানজেকশন</h3>

                @if($transactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-900">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">তারিখ</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">মাস</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">পরিমাণ</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">মাধ্যম</th>
                                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">অবস্থা</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ $transaction->payment_month }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        ৳{{ number_format($transaction->amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-100">
                                        {{ $transaction->paymentMethod->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($transaction->status === 'approved')
                                            <span class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">
                                                অনুমোদিত
                                            </span>
                                        @elseif($transaction->status === 'rejected')
                                            <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-200">
                                                প্রত্যাখ্যাত
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-200">
                                                অপেক্ষমাণ
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                @else
                    <div class="py-12 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">কোনো ট্রানজেকশন পাওয়া যায়নি</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div x-show="showEditModal"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true"
         style="display: none;">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-show="showEditModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="showEditModal = false"
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                 aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div x-show="showEditModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 @click.stop
                 class="relative inline-block w-full max-w-2xl px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:p-6">                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button @click="showEditModal = false" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="text-2xl font-bold leading-6 text-gray-900 dark:text-gray-100" id="modal-title">
                            প্রোফাইল সম্পাদনা
                        </h3>

                        <form wire:submit="updateBasicInfo" class="mt-6 space-y-6">
                            <!-- Profile Photo -->
                            <div class="flex flex-col items-center space-y-4" x-data="{ photoPreview: null }">
                                <div class="relative">
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" alt="Preview" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                                    </template>
                                    <template x-if="!photoPreview">
                                        @if(auth()->user()->photo)
                                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="object-cover w-32 h-32 border-4 border-gray-300 rounded-full">
                                        @else
                                            <div class="flex items-center justify-center w-32 h-32 text-4xl font-bold text-white bg-blue-500 border-4 border-gray-300 rounded-full">
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </template>

                                    <!-- Loading indicator for photo upload -->
                                    <div wire:loading wire:target="photo" class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 rounded-full">
                                        <svg class="w-8 h-8 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <label class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700">
                                        <span wire:loading.remove wire:target="photo">ছবি নির্বাচন করুন</span>
                                        <span wire:loading wire:target="photo">আপলোড হচ্ছে...</span>
                                        <input type="file" wire:model="photo" class="hidden" accept="image/*"
                                               @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                    @error('photo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">সর্বোচ্চ ২MB</p>
                                </div>
                            </div>

                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নাম *</label>
                                <input type="text" wire:model="name" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <!-- Email and Phone -->
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ইমেইল</label>
                                    <input type="email" wire:model="email" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ফোন *</label>
                                    <input type="text" wire:model="phone" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                    @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ঠিকানা</label>
                                <textarea wire:model="address" rows="3" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                                @error('address') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="flex items-center justify-between pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                                <button type="button" wire:click="openPasswordModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="inline-block w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    পাসওয়ার্ড পরিবর্তন
                                </button>
                                <div class="flex space-x-3">
                                    <button type="button" @click="showEditModal = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                        বাতিল
                                    </button>
                                    <button type="submit" wire:loading.attr="disabled" wire:target="updateBasicInfo,photo" class="relative px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span wire:loading.remove wire:target="updateBasicInfo">সংরক্ষণ করুন</span>
                                        <span wire:loading wire:target="updateBasicInfo" class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            সংরক্ষণ হচ্ছে...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Change Modal -->
    @if($showPasswordModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" wire:click="closePasswordModal" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div class="relative inline-block w-full max-w-lg px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button wire:click="closePasswordModal" class="text-gray-400 hover:text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div>
                    <h3 class="text-xl font-bold leading-6 text-gray-900 dark:text-gray-100">পাসওয়ার্ড পরিবর্তন</h3>

                    <form wire:submit.prevent="updatePassword" class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">বর্তমান পাসওয়ার্ড *</label>
                            <div class="relative">
                                <input type="password" wire:model="current_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                            </div>
                            @error('current_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড * <span class="text-xs text-gray-500">(কমপক্ষে ৮ অক্ষর)</span></label>
                            <input type="password" wire:model="new_password" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                            @error('new_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">নতুন পাসওয়ার্ড নিশ্চিত করুন *</label>
                            <input type="password" wire:model="new_password_confirmation" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div class="flex justify-end pt-4 space-x-3 border-t border-gray-200 dark:border-gray-700">
                            <button type="button" wire:click="closePasswordModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                                বাতিল
                            </button>
                            <button type="submit" wire:loading.attr="disabled" wire:target="updatePassword" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove wire:target="updatePassword">পাসওয়ার্ড পরিবর্তন করুন</span>
                                <span wire:loading wire:target="updatePassword" class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    পরিবর্তন হচ্ছে...
                                </span>
                            </button>
                        </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
