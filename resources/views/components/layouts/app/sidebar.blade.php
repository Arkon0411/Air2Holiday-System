<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                 <x-app-logo-icon class="size-9 fill-current items-center justify-center " />
                 <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-50">Air2Holiday</h1>
            </a>

            <flux:navlist variant="outline">
                @if(auth()->user()->isAirline())
                    <flux:navlist.group :heading="__('Airline Panel')" class="grid">
                        <flux:navlist.item icon="chart-bar" :href="route('adminpanel.index')" :current="request()->routeIs('adminpanel.index')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                        <flux:navlist.item icon="paper-airplane" :href="route('adminpanel.flights.index')" :current="request()->routeIs('adminpanel.flights.index')" wire:navigate>{{ __('Flights') }}</flux:navlist.item>
                    </flux:navlist.group>
                @else
                    <flux:navlist.group :heading="__('Admin Panel')" class="grid">
                        <flux:navlist.item icon="chart-bar" :href="route('adminpanel.index')" :current="request()->routeIs('adminpanel.index')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                        <flux:navlist.item icon="flag" :href="route('adminpanel.airports.index')" :current="request()->routeIs('adminpanel.airports.index')" wire:navigate>{{ __('Airports') }}</flux:navlist.item>
                        <flux:navlist.item icon="building-office-2" :href="route('adminpanel.airlines.index')" :current="request()->routeIs('adminpanel.airlines.index')" wire:navigate>{{ __('Airlines') }}</flux:navlist.item>
                        <flux:navlist.item icon="bookmark-square" :href="route('adminpanel.bookings.index')" :current="request()->routeIs('adminpanel.bookings.index')" wire:navigate>{{ __('Bookings') }}</flux:navlist.item>
                        <flux:navlist.item icon="paper-airplane" :href="route('adminpanel.flights.index')" :current="request()->routeIs('adminpanel.flights.index')" wire:navigate>{{ __('Flights') }}</flux:navlist.item>
                        <flux:navlist.item icon="user-group" :href="route('adminpanel.users.index')" :current="request()->routeIs('adminpanel.users.index')" wire:navigate>{{ __('Users') }}</flux:navlist.item>
                    </flux:navlist.group>
                @endif
            </flux:navlist>


            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    class="cursor-pointer"
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    avatar:src="{{ auth()->user()->profile_photo_url }}"
                    avatar:class="w-8 h-8 rounded-full object-cover"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <div class="shrink-0">
                                    <flux:avatar src="{{ auth()->user()->profile_photo_url }}" size="sm" circle />
                                </div>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    class="cursor-pointer"
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    avatar:src="{{ auth()->user()->profile_photo_url }}"
                    avatar:class="w-8 h-8 rounded-full object-cover"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <div class="shrink-0">
                                    <flux:avatar src="{{ auth()->user()->profile_photo_url }}" size="sm" circle />
                                </div>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        @stack('scripts')
    </body>
</html>