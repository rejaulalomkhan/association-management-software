<div class="grid h-16 grid-cols-5">

    @php
        // Role priority: admin > accountant > member
        $user = auth()->user();
    @endphp

    @if(request()->routeIs('admin.*') && $user->hasRole('admin'))
        <!-- Admin Menu -->
        <button class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 focus:outline-none" @click="sidebarOpen = !sidebarOpen">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="mt-1 text-xs">মেনু</span>
        </button>
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"></path></svg>
            <span class="mt-1 text-xs">ড্যাশ</span>
        </a>
        <a href="{{ route('admin.members') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('admin.members') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <span class="mt-1 text-xs">মেম্বার</span>
        </a>
        <a href="{{ route('admin.settings') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('admin.settings') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span class="mt-1 text-xs">সেটিংস</span>
        </a>

    @elseif(request()->routeIs('accountant.*') && $user->hasRole('accountant'))
        <!-- Accountant Menu -->
        <button class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 focus:outline-none" @click="sidebarOpen = !sidebarOpen">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="mt-1 text-xs">মেনু</span>
        </button>
        <a href="{{ route('accountant.dashboard') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('accountant.dashboard') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"></path></svg>
            <span class="mt-1 text-xs">ড্যাশ</span>
        </a>
        <a href="{{ route('accountant.transactions') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('accountant.transactions') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="mt-1 text-xs">লেনদেন</span>
        </a>

    @elseif(!request()->routeIs('admin.*') && !request()->routeIs('accountant.*'))
        <!-- Member Menu (Default for everyone in member panel) -->
        <button class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 focus:outline-none" @click="sidebarOpen = !sidebarOpen">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="mt-1 text-xs">মেনু</span>
        </button>
        <a href="{{ route('member.dashboard') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('member.dashboard') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="mt-1 text-xs">হোম</span>
        </a>
        <a href="{{ route('member.payment') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('member.payment') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="mt-1 text-xs">পেমেন্ট</span>
        </a>
        <a href="{{ route('member.bank-deposits') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('member.bank-deposits') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
            <span class="mt-1 text-xs">ব্যাংক</span>
        </a>
        <a href="{{ route('member.profile') }}" wire:navigate class="flex flex-col items-center justify-center text-gray-500 hover:text-indigo-600 {{ request()->routeIs('member.profile') ? 'text-indigo-600' : '' }}">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="mt-1 text-xs">প্রোফাইল</span>
        </a>
    @endif

</div>
