<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <a href="{{ route('dashboard') }}" class="ms-2 me-5 flex items-center space-x-2 rtl:space-x-reverse lg:ms-0" wire:navigate>
            </a>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="paper-airplane" :href="route('flights')" :current="request()->routeIs('flights')" wire:navigate>
                    {{ __('Flights') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:navbar class="-mb-px max-lg:hidden    ">
                <flux:navbar.item icon="book-open-text" :href="route('bookings')" :current="request()->routeIs('bookings')" wire:navigate>
                    {{ __('My Bookings') }}
                </flux:navbar.item>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
            </flux:navbar>

            @if(auth()->check() && auth()->user()->isAdmin())
            <flux:navbar class="-mb-px max-lg:hidden    ">
                <flux:navbar.item icon="adjustments-horizontal" :href="route('adminpanel.index')" :current="request()->routeIs('adminpanel.*')" wire:navigate>
                    {{ __('') }}
                </flux:navbar.item>
            </flux:navbar>
            @endif

            <!-- Desktop User Menu -->
            @auth
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
            @endauth

            @guest
                <div class="hidden lg:block">
                    <flux:button     :href="route('login')" class="me-3">{{ __('Log In') }}</flux:button-link>
                    <flux:button variant="primary"     :href="route('register')" class="me-3">{{ __('Register') }}</flux:button-link>
                </div>
            @endguest
            
            

        </flux:header>

        <!-- Mobile Menu -->
        <flux:sidebar stashable sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="ms-1 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')">
                    <flux:navlist.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                      {{ __('Dashboard') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="paper-airplane" :href="route('flights')" :current="request()->routeIs('flights')" wire:navigate>
                      {{ __('Flights') }}
                    </flux:navlist.item>
                    <flux:navlist.item icon="book-open-text" :href="route('bookings')" :current="request()->routeIs('bookings')" wire:navigate>
                      {{ __('My Bookings') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />
        </flux:sidebar>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
