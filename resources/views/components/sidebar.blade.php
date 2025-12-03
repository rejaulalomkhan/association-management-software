<div class="flex flex-col h-full">
    <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-gray-700">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
    </div>

    <div class="flex-1 overflow-y-auto py-4">
        <nav class="space-y-1 px-2" x-data="{ settingsOpen: {{ request()->routeIs('admin.settings', 'admin.roles', 'admin.privileges', 'admin.user-roles') ? 'true' : 'false' }} }">
            @if(auth()->user()->hasRole('admin'))
            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link href="{{ route('admin.pending-registrations') }}" :active="request()->routeIs('admin.pending-registrations')">
                {{ __('Pending Registrations') }}
            </x-nav-link>
            <x-nav-link href="{{ route('admin.members') }}" :active="request()->routeIs('admin.members')">
                {{ __('Members') }}
            </x-nav-link>
            <x-nav-link href="{{ route('admin.transactions') }}" :active="request()->routeIs('admin.transactions')">
                {{ __('Transactions') }}
            </x-nav-link>

            <!-- Settings Dropdown -->
            <div class="relative">
                <button @click="settingsOpen = !settingsOpen"
                        class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150
                               {{ request()->routeIs('admin.settings', 'admin.roles', 'admin.privileges', 'admin.user-roles') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                    <span>{{ __('Settings') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': settingsOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="settingsOpen" x-collapse class="ml-3 mt-1 space-y-1">
                    <a href="{{ route('admin.settings') }}"
                       class="block px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.settings') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        {{ __('General Settings') }}
                    </a>
                    <a href="{{ route('admin.roles') }}"
                       class="block px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.roles') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        {{ __('Roles') }}
                    </a>
                    <a href="{{ route('admin.privileges') }}"
                       class="block px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.privileges') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        {{ __('Privileges') }}
                    </a>
                    <a href="{{ route('admin.user-roles') }}"
                       class="block px-3 py-2 text-sm rounded-lg transition-colors duration-150
                              {{ request()->routeIs('admin.user-roles') ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        {{ __('User Roles') }}
                    </a>
                </div>
            </div>
            @endif

            @if(auth()->user()->hasRole('accountant'))
            <x-nav-link href="{{ route('accountant.dashboard') }}" :active="request()->routeIs('accountant.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link href="{{ route('accountant.transactions') }}" :active="request()->routeIs('accountant.transactions')">
                {{ __('Transactions') }}
            </x-nav-link>
            @endif

            @if(auth()->user()->hasRole('member'))
            <x-nav-link href="{{ route('member.dashboard') }}" :active="request()->routeIs('member.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link href="{{ route('member.profile.edit') }}" :active="request()->routeIs('member.profile.edit')">
                {{ __('Edit Profile') }}
            </x-nav-link>
            <x-nav-link href="{{ route('member.payment') }}" :active="request()->routeIs('member.payment')">
                {{ __('Pay Now') }}
            </x-nav-link>
            <x-nav-link href="{{ route('member.history') }}" :active="request()->routeIs('member.history')">
                {{ __('Payment History') }}
            </x-nav-link>
            @endif
        </nav>
    </div>

    <div class="p-4 border-t border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('tyro-login.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                Logout
            </button>
        </form>
    </div>
</div>
