<div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 md:text-3xl">পেমেন্ট সাবমিট করুন</h1>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">আপনার পেমেন্ট তথ্য প্রদান করুন। অনুমোদনের পর মূল হিসেবে যুক্ত হবে।</p>
                </div>
                <a href="{{ route('member.profile') }}" class="flex items-center justify-center w-10 h-10 text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600" title="ফিরে যান">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-800">
                {{ session('success') }}
            </div>
        @endif

        <!-- Payment Form Card -->
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6">
                <!-- Overdue Information -->
                <div wire:loading wire:target="selectedUserId,payment_type" class="p-4 mb-6 border-l-4 border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 animate-pulse">
                    <div class="flex items-start">
                        <div class="w-5 h-5 mr-2 bg-gray-300 rounded dark:bg-gray-600"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-4 bg-gray-300 rounded dark:bg-gray-600 w-3/4"></div>
                            <div class="h-3 bg-gray-300 rounded dark:bg-gray-600 w-1/2"></div>
                        </div>
                    </div>
                </div>

                <div wire:loading.remove wire:target="selectedUserId,payment_type">
                    @php
                        $overdueMonths = (int) ($overdueInfo['months'] ?? 0);
                        $overdueAmount = (float) ($overdueInfo['amount'] ?? 0);
                        $selectedUser = collect($availableUsers)->firstWhere('id', $selectedUserId);
                        $selectedUserName = $selectedUser ? $selectedUser->name : 'আপনার';
                    @endphp
                    @if($overdueMonths > 0)
                        <div class="p-4 mb-6 border-l-4 border-orange-500 bg-orange-50 dark:bg-orange-900 dark:border-orange-600">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-orange-800 dark:text-orange-200">
                                    <span class="font-bold">{{ $selectedUserName }}</span> এর পূর্বের
                                    <span class="font-bold">{{ $overdueMonths }} মাসের</span>
                                    <span class="font-bold">৳{{ number_format($overdueAmount, 0) }}</span>
                                    টাকা বকেয়া রয়েছে
                                </p>
                                <p class="mt-1 text-xs text-orange-600 dark:text-orange-400">
                                    বকেয়া পরিশোধের জন্য নিচে "বকেয়া" অপশন নির্বাচন করুন
                                </p>
                            </div>
                        </div>
                        </div>
                    @else
                        <div class="p-4 mb-6 border-l-4 border-green-500 bg-green-50 dark:bg-green-900 dark:border-green-600">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-sm font-semibold text-green-800 dark:text-green-200">
                                <span class="font-bold">{{ $selectedUserName }}</span> এর পূর্বের কোনো বকেয়া নেই
                            </p>
                        </div>
                        </div>
                    @endif
                </div>

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

                <form wire:submit.prevent="submitPayment" class="space-y-6">
                    <!-- User Selection -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">কোন সদস্যের জন্য পেমেন্ট? *</label>

                        @if($isAdminOrAccountant)
                            @php
                                $selectedUser = collect($availableUsers)->firstWhere('id', $selectedUserId);
                            @endphp
                            
                            <!-- Responsive Grid Layout: Side by side on desktop -->
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                                <!-- Dropdown -->
                                <div>
                                    <select wire:model.live="selectedUserId" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                        @foreach($availableUsers as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                                @if(!empty($user->membership_id))
                                                    (ID: {{ $user->membership_id }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Selected User Display with Photo -->
                                <div class="flex items-center gap-3 p-3 border-2 border-green-500 rounded-lg bg-green-50 dark:bg-green-900/30 dark:border-green-600">
                                    @if($selectedUser)
                                        @if($selectedUser->profile_pic)
                                            <img src="{{ asset('storage/' . $selectedUser->profile_pic) }}" alt="{{ $selectedUser->name }}" class="object-cover w-12 h-12 rounded-full ring-2 ring-green-500">
                                        @else
                                            <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full ring-2 ring-green-500 dark:bg-green-800">
                                                <span class="text-lg font-bold text-green-600 dark:text-green-300">{{ substr($selectedUser->name, 0, 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate dark:text-gray-100">{{ $selectedUser->name }}</p>
                                            @if(!empty($selectedUser->membership_id))
                                                <p class="text-xs text-gray-600 dark:text-gray-400">সদস্য আইডি: {{ $selectedUser->membership_id }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">এডমিন/একাউন্টেন্ট চাইলে অন্য সদস্যের জন্যও পেমেন্ট সাবমিট করতে পারবেন।</p>
                        @else
                            @php
                                $currentUser = auth()->user();
                            @endphp
                            <div class="flex items-center justify-between px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $currentUser->name }}</p>
                                    @if($currentUser->membership_id)
                                        <p class="text-xs text-gray-500 dark:text-gray-400">সদস্য আইডি: {{ $currentUser->membership_id }}</p>
                                    @endif
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-200">নিজের পেমেন্ট</span>
                            </div>
                            <input type="hidden" wire:model="selectedUserId">
                        @endif
                        @error('selectedUserId') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Payment Type Selection -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">পেমেন্ট ধরন *</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label class="relative flex flex-col items-center px-3 py-2.5 border-2 rounded-lg cursor-pointer transition-all {{ $payment_type === 'current' ? 'border-blue-500 bg-blue-50 dark:bg-blue-900 shadow-sm' : 'border-gray-300 hover:border-blue-300 dark:border-gray-600' }} {{ $isCurrentMonthAlreadyPaid ? 'opacity-60 cursor-not-allowed' : '' }}">
                                <input type="radio" wire:model.live="payment_type" value="current" class="sr-only" {{ $isCurrentMonthAlreadyPaid ? 'disabled' : '' }}>
                                <svg class="w-5 h-5 mb-1 {{ $payment_type === 'current' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs font-medium text-center {{ $payment_type === 'current' ? 'text-blue-700 dark:text-blue-300' : 'text-gray-600 dark:text-gray-400' }}">
                                    @if($isCurrentMonthAlreadyPaid)
                                        চলতি মাস ✓
                                    @else
                                        চলতি মাস
                                    @endif
                                </span>
                            </label>

                            <label class="relative flex flex-col items-center px-3 py-2.5 border-2 rounded-lg cursor-pointer transition-all {{ $payment_type === 'overdue' ? 'border-orange-500 bg-orange-50 dark:bg-orange-900 shadow-sm' : 'border-gray-300 hover:border-orange-300 dark:border-gray-600' }} {{ $overdueInfo['months'] == 0 ? 'opacity-50 cursor-not-allowed' : '' }}">
                                <input type="radio" wire:model.live="payment_type" value="overdue" class="sr-only" {{ $overdueInfo['months'] == 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5 mb-1 {{ $payment_type === 'overdue' ? 'text-orange-600 dark:text-orange-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-xs font-medium text-center {{ $payment_type === 'overdue' ? 'text-orange-700 dark:text-orange-300' : 'text-gray-600 dark:text-gray-400' }}">বকেয়া</span>
                            </label>

                            <label class="relative flex flex-col items-center px-3 py-2.5 border-2 rounded-lg cursor-pointer transition-all {{ $payment_type === 'advance' ? 'border-purple-500 bg-purple-50 dark:bg-purple-900 shadow-sm' : 'border-gray-300 hover:border-purple-300 dark:border-gray-600' }}">
                                <input type="radio" wire:model.live="payment_type" value="advance" class="sr-only">
                                <svg class="w-5 h-5 mb-1 {{ $payment_type === 'advance' ? 'text-purple-600 dark:text-purple-400' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                                <span class="text-xs font-medium text-center {{ $payment_type === 'advance' ? 'text-purple-700 dark:text-purple-300' : 'text-gray-600 dark:text-gray-400' }}">অগ্রিম</span>
                            </label>
                        </div>
                    </div>

                    <!-- Year + Month Selection (for overdue and advance) -->
                    @if($payment_type !== 'current')
                    <div class="grid gap-4" style="grid-template-columns: 3fr 5fr;">
                        <!-- Year Selection -->
                        <div wire:loading.class="opacity-50 pointer-events-none" wire:loading.attr="aria-busy" wire:target="payment_type">
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">সাল নির্বাচন করুন *</label>
                            <div class="relative">
                                <select wire:model.live="paymentYear" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    @foreach($paymentYears as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                                <div wire:loading wire:target="payment_type" class="absolute inset-0 flex items-center justify-center rounded-lg bg-white/60 dark:bg-gray-800/60">
                                    <svg class="w-5 h-5 text-green-600 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Month Selection Dropdown -->
                        <div x-data="{ open: false }"
                            wire:key="month-dropdown-{{ $payment_type }}-{{ $paymentYear }}"
                            @payment-type-changed.window="open = false"
                            x-init="$watch('$wire.paymentYear', () => open = false); $watch('$wire.payment_type', () => open = false)"
                            wire:loading.class="opacity-50 pointer-events-none" wire:loading.attr="aria-busy" wire:target="payment_type,paymentYear">
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">কোন মাসের পেমেন্ট? *</label>

                            <!-- Dropdown Button -->
                            <div @click="open = !open" class="relative">
                                <button type="button" class="flex items-center justify-between w-full px-4 py-3 text-sm text-left bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    <span>
                                        @if(count($selectedMonths) > 0)
                                            <span class="font-semibold text-green-600 dark:text-green-400">{{ count($selectedMonths) }} টি মাস নির্বাচিত</span>
                                        @else
                                            <span class="text-gray-500">মাস নির্বাচন করুন...</span>
                                        @endif
                                    </span>
                                    <svg class="w-5 h-5 ml-2 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <!-- Dropdown Content -->
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-10 w-full mt-2 overflow-hidden bg-white border border-gray-300 rounded-lg shadow-lg dark:bg-gray-700 dark:border-gray-600">
                                    <!-- Loading skeleton for months -->
                                    <div wire:loading wire:target="paymentYear,payment_type" class="p-4 space-y-2 animate-pulse">
                                        <div class="h-10 bg-gray-200 rounded dark:bg-gray-600"></div>
                                        <div class="h-10 bg-gray-200 rounded dark:bg-gray-600"></div>
                                        <div class="h-10 bg-gray-200 rounded dark:bg-gray-600"></div>
                                        <div class="h-10 bg-gray-200 rounded dark:bg-gray-600"></div>
                                    </div>

                                    <div wire:loading.remove wire:target="paymentYear,payment_type" class="overflow-y-auto max-h-64">
                                        @php
                                            $unpaidMonths = [];
                                            if(isset($paymentYear)) {
                                                $unpaidMonths = $this->getUnpaidMonthsForYear($paymentYear);
                                            }
                                        @endphp

                                        @if(count($unpaidMonths) > 0)
                                            @foreach($unpaidMonths as $monthNum)
                                                <label class="flex items-center px-4 py-3 transition-colors cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-600 {{ in_array($monthNum, $selectedMonths) ? 'bg-green-50 dark:bg-green-900' : '' }}">
                                                    <input type="checkbox" wire:model.live="selectedMonths" value="{{ $monthNum }}" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                                                    <span class="ml-3 text-sm {{ in_array($monthNum, $selectedMonths) ? 'font-semibold text-green-700 dark:text-green-300' : 'text-gray-700 dark:text-gray-300' }}">
                                                        {{ $banglaMonthNames[$monthNum] }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        @else
                                            <div class="px-4 py-3 text-sm text-center text-gray-500 dark:text-gray-400">
                                                এই বছরের সব মাসের পেমেন্ট সম্পন্ন হয়েছে
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                নির্বাচিত: <span class="font-semibold text-green-600">{{ count($selectedMonths) }} মাস</span>
                            </p>
                            @error('selectedMonths') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    @endif

                    <!-- Payment Details Section with Padding -->
                    <div class="p-4 space-y-6 bg-gray-50 rounded-lg dark:bg-gray-700/30 sm:p-6">
                        <!-- Payment Amount Display -->
                        <!-- Loading skeleton -->
                        <div wire:loading wire:target="payment_type,selectedMonths,paymentYear,selectedUserId" class="relative p-5 overflow-hidden border-2 border-gray-200 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 dark:border-gray-600 animate-pulse">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="w-24 h-4 mb-2 bg-gray-300 rounded dark:bg-gray-600"></div>
                                    <div class="w-32 h-3 bg-gray-300 rounded dark:bg-gray-600"></div>
                                </div>
                                <div class="w-32 h-12 bg-gray-300 rounded dark:bg-gray-600"></div>
                            </div>
                        </div>

                        <!-- Actual content -->
                        <div wire:loading.remove wire:target="payment_type,selectedMonths,paymentYear,selectedUserId" class="relative p-5 overflow-hidden border-2 border-green-300 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900 dark:to-emerald-900 dark:border-green-700 shadow-sm">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-green-200 rounded-full opacity-20 -mr-16 -mt-16 dark:bg-green-700"></div>
                            <div class="relative flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-green-800 dark:text-green-200">পেমেন্ট পরিমাণ</p>
                                    <p class="text-xs text-green-600 dark:text-green-400 mt-0.5">{{ count($selectedMonths) }} মাস × ৳{{ number_format($monthlyFee, 0) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-4xl font-bold text-green-600 dark:text-green-300">৳{{ number_format($payment_amount, 0) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">পেমেন্ট মাধ্যম *</label>
                            <select wire:model.live="payment_method_id" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">নির্বাচন করুন</option>
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name_bn ?? $method->name }}</option>
                                @endforeach
                            </select>
                            @error('payment_method_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Reference Number -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">রেফারেন্স নাম্বার</label>
                            <input type="text" wire:model="payment_reference" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="ট্রানজেকশন আইডি বা রেফারেন্স নাম্বার">
                            @error('payment_reference') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Proof Screenshot (Optional) -->
                        <div x-data="{ fileName: '', previewUrl: '' }">
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">স্ক্রিনশট / ছবি (ঐচ্ছিক)</label>

                            <div class="flex gap-2">
                                <label class="flex-1 flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-500 transition-colors">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <input type="file" wire:model="payment_proof" accept="image/*" class="hidden" x-on:change="fileName = $event.target.files[0]?.name || ''; previewUrl = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : ''">
                                    <span class="truncate" x-text="fileName || 'ফাইল নির্বাচন করুন'"></span>
                                </label>

                                <label class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg cursor-pointer hover:bg-green-700 transition-colors shadow-sm">
                                    <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="hidden sm:inline">ক্যামেরা</span>
                                    <input type="file" wire:model="payment_proof" accept="image/*" capture="environment" class="hidden" x-on:change="fileName = $event.target.files[0]?.name || 'Camera photo'; previewUrl = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : ''">
                                </label>
                            </div>

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">পেমেন্টের স্ক্রিনশট বা ছবি তুলুন / আপলোড করুন (সর্বোচ্চ ২ এমবি, শুধু ছবি)।</p>

                            <div x-show="previewUrl" class="mt-3">
                                <p class="mb-1 text-xs font-medium text-gray-600 dark:text-gray-300">প্রিভিউ:</p>
                                <img :src="previewUrl" alt="Payment proof preview" class="object-contain w-full border border-gray-200 rounded-lg max-h-56 dark:border-gray-600">
                            </div>

                            @error('payment_proof') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">নোট (ঐচ্ছিক)</label>
                            <textarea wire:model="payment_note" rows="3" class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="অতিরিক্ত কোন তথ্য থাকলে লিখুন..."></textarea>
                            @error('payment_note') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex gap-3">
                            <button type="submit" class="flex-1 px-6 py-3 text-sm font-medium text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <span wire:loading.remove wire:target="submitPayment">পেমেন্ট সাবমিট করুন</span>
                                <span wire:loading wire:target="submitPayment">সাবমিট হচ্ছে...</span>
                            </button>
                            <a href="{{ route('member.profile') }}" class="px-6 py-3 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                বাতিল
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
