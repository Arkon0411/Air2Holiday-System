<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        @php
        // Determine background image based on current route name
        $backgroundImage = 'loginsplash.jpeg'; // default
        
        $currentRoute = Route::currentRouteName();
        
        if ($currentRoute === 'login') {
            $backgroundImage = 'loginsplash.jpeg';
        } elseif ($currentRoute === 'register') {
            $backgroundImage = 'registersplash.jpeg';
        } elseif ($currentRoute === 'password.request') {
            // Fortify names the forgot-password view route `password.request`
            $backgroundImage = 'forgotsplash.jpeg';
        }
        @endphp
        <link rel="preload" as="image" href="/img/{{ $backgroundImage }}">
    </head>
    <body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <!-- Left Side - Dynamic Background Image -->
            <div class="relative hidden h-full flex-col p-10 text-white lg:flex bg-image-container" style="background: url('/img/{{ $backgroundImage }}') center/cover; opacity: 0; transition: opacity 0.8s ease-out;" data-bg-image="/img/{{ $backgroundImage }}">
            </div>

            <!-- Right Side - Login/Register Form -->
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]" style="opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out;">
                    <!-- Mobile Logo -->
                        <a href="{{ route('home') }}" class="z-20 flex items-center justify-center gap-2 text-lg font-medium text-black dark:text-white" wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current items-center justify-center " />
                        </span>
                            <h1 class="strong">Air2Holiday</h1>
                    </a>
                    <!-- Form Content -->
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script>
            // Page load animation for auth panels
            (function() {
                const animateContent = function() {
                    const authContainer = document.querySelector('.mx-auto.flex.w-full.flex-col.justify-center');
                    const backgroundImage = document.querySelector('.bg-image-container');
                    
                    // Animate form immediately
                    if (authContainer) {
                        authContainer.style.opacity = '1';
                        authContainer.style.transform = 'translateY(0)';
                    }
                    
                    // Wait for background image to load before animating
                    if (backgroundImage) {
                        const bgImageUrl = backgroundImage.getAttribute('data-bg-image');
                        if (bgImageUrl) {
                            const img = new Image();
                            
                            // Set a timeout fallback in case the image loads too quickly
                            let animated = false;
                            const animateBackground = function() {
                                if (!animated) {
                                    animated = true;
                                    backgroundImage.style.opacity = '1';
                                }
                            };
                            
                            img.onload = function() {
                                // Small delay to ensure smooth animation even for cached images
                                setTimeout(animateBackground, 100);
                            };
                            img.onerror = animateBackground;
                            
                            img.src = bgImageUrl;
                            
                            // If image is already cached and loaded, animate immediately
                            if (img.complete) {
                                setTimeout(animateBackground, 100);
                            }
                        } else {
                            backgroundImage.style.opacity = '1';
                        }
                    }
                };
                
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', animateContent);
                } else {
                    setTimeout(animateContent, 50);
                }
            })();
        </script>

        @fluxScripts
    </body>
</html>