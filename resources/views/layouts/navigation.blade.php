<nav x-data="{ open: false }" class="glass-nav sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="IASPIG Logo" class="h-8 lg:h-10 w-auto">
                    </a>
                </div>

                <!-- Navigation Links (Desktop Only) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 lg:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('alumni.feed')" :active="request()->routeIs('alumni.feed')">
                        {{ __('Community') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-2 lg:gap-4">
                <!-- Notification Center (Always Visible) -->
                @livewire('alumni.notification-center')

                <!-- Settings Dropdown (Desktop Only) -->
                <div class="hidden lg:flex lg:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-xl text-iaspig-brown bg-iaspig-brown/5 hover:bg-iaspig-brown/10 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-iaspig-orange flex items-center justify-center text-white">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- User Avatar (Mobile Only - Link to Profile) -->
                <a href="{{ route('profile.edit') }}" class="lg:hidden w-8 h-8 rounded-full bg-iaspig-orange flex items-center justify-center text-white text-xs font-black shadow-md">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </a>
            </div>
        </div>
    </div>
</nav>
