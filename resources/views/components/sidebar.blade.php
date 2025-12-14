<div class="flex flex-col h-full">
    <div class="flex-1 overflow-y-auto py-4">
        <nav class="space-y-1 px-2" x-data="{ settingsOpen: {{ request()->routeIs('admin.settings', 'admin.roles', 'admin.privileges', 'admin.user-roles') ? 'true' : 'false' }} }">
            
            @if(request()->routeIs('admin.*') && auth()->user()->hasRole('admin'))
            <!-- Admin Section -->
            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                Admin
            </div>

            <a href="{{ route('admin.dashboard') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                ড্যাশবোর্ড
            </a>

            <a href="{{ route('admin.pending-registrations') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('admin.pending-registrations') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="flex-1">অপেক্ষমাণ রেজিস্ট্রেশন</span>
                @php
                    $pendingCount = \App\Models\User::where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-600 rounded-full shadow-md">
                        {{ $pendingCount > 9 ? '9+' : $pendingCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.members') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('admin.members') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                সদস্যগণ
            </a>

            <a href="{{ route('admin.transactions') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('admin.transactions') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="flex-1">লেনদেন</span>
                @php
                    $pendingPayments = \App\Models\Payment::where('status', 'pending')->count();
                @endphp
                @if($pendingPayments > 0)
                    <span class="flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-600 rounded-full shadow-md">
                        {{ $pendingPayments > 9 ? '9+' : $pendingPayments }}
                    </span>
                @endif
            </a>

            <a href="{{ route('admin.bank-deposits') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('admin.bank-deposits') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <span class="flex-1">ব্যাংক জমা</span>
            </a>

            <!-- Separator -->
            <div class="my-2 border-t border-gray-200 dark:border-gray-700"></div>

            <!-- Settings Dropdown -->
            <div class="relative">
                <button @click="settingsOpen = !settingsOpen"
                        class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                               {{ request()->routeIs('admin.settings', 'admin.roles', 'admin.privileges', 'admin.user-roles') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>সেটিংস</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': settingsOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="settingsOpen" x-collapse class="ml-8 mt-1 space-y-1">
                    <a href="{{ route('admin.settings') }}" wire:navigate
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.settings') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        সাধারণ সেটিংস
                    </a>
                    <a href="{{ route('admin.roles') }}" wire:navigate
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.roles') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        রোল
                    </a>
                    <a href="{{ route('admin.privileges') }}" wire:navigate
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.privileges') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        প্রিভিলেজ
                    </a>
                    <a href="{{ route('admin.user-roles') }}"
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.user-roles') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        ইউজার রোল
                    </a>
                </div>
            </div>
            @endif

            @if(request()->routeIs('accountant.*') && auth()->user()->hasRole('accountant'))
            <!-- Accountant Section -->
            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                Accountant
            </div>

            <a href="{{ route('accountant.dashboard') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('accountant.dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                ড্যাশবোর্ড
            </a>

            <a href="{{ route('accountant.transactions') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('accountant.transactions') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="flex-1">লেনদেন</span>
                @php
                    $pendingPayments = \App\Models\Payment::where('status', 'pending')->count();
                @endphp
                @if($pendingPayments > 0)
                    <span class="flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-600 rounded-full shadow-md">
                        {{ $pendingPayments > 9 ? '9+' : $pendingPayments }}
                    </span>
                @endif
            </a>

            <a href="{{ route('accountant.bank-deposits') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('accountant.bank-deposits') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
                <span class="flex-1">ব্যাংক জমা</span>
            </a>
            @endif

            @if(!request()->routeIs('admin.*') && !request()->routeIs('accountant.*'))
            <!-- Member Section -->
            <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
                সদস্য
            </div>

            <a href="{{ route('member.dashboard') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('member.dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                ড্যাশবোর্ড
            </a>

            <a href="{{ route('member.profile.edit') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('member.profile.edit') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                প্রোফাইল এডিট
            </a>

            <a href="{{ route('member.payment') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('member.payment') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                পেমেন্ট করুন
            </a>

            <a href="{{ route('member.history') }}" wire:navigate
               class="flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                      {{ request()->routeIs('member.history') ? 'bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                পেমেন্ট হিস্টরি
            </a>
            @endif
        </nav>
    </div>

    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('tyro-login.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                লগআউট
            </button>
        </form>
    </div>
</div>
