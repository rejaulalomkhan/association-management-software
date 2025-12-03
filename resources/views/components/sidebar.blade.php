<div class="flex flex-col h-full">
    <div class="h-16 flex items-center justify-center border-b border-gray-200 dark:border-gray-700">
        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
    </div>

    <div class="flex-1 overflow-y-auto py-4">
        <nav class="space-y-1 px-2">
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
            <x-nav-link href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">
                {{ __('Settings') }}
            </x-nav-link>
            @endif

            @if(auth()->user()->hasRole('accountant'))
            <x-nav-link href="{{ route('accountant.dashboard') }}" :active="request()->routeIs('accountant.dashboard')">
                {{ __('Dashboard') }}
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
