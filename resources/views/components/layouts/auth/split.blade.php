<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            @php
            // Determine background image based on current route name
            $backgroundImage = 'loginsplash.jpeg'; // default
            
            $currentRoute = Route::currentRouteName();
            
            if ($currentRoute === 'login') {
                $backgroundImage = 'loginsplash.jpeg';
            } elseif ($currentRoute === 'register') {
                $backgroundImage = 'registersplash.jpeg';
            }
            @endphp
            <!-- Left Side - Dynamic Background Image -->
            <div class="relative hidden h-full flex-col p-10 text-white lg:flex" style="background: url('/img/{{ $backgroundImage }}') center/cover">
            </div>

            <!-- Right Side - Login/Register Form -->
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <!-- Mobile Logo -->
                    <a href="{{ route('home') }}" class="z-20 flex items-center justify-center gap-2 text-lg font-medium text-black dark:text-white lg:justify-start" wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current" />
                        </span>
                        Air2Holidays
                    </a>
                    <!-- Form Content -->
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>