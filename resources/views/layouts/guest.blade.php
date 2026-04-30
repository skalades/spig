<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-white">
        <div class="min-h-screen flex">
            <!-- Left Side: Image & Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-iaspig-brown relative overflow-hidden">
                <img src="{{ asset('assets/img/login_side_image_1777573343050.png') }}" alt="Surveying" class="absolute inset-0 w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 bg-gradient-to-t from-iaspig-brown via-transparent to-iaspig-brown/30"></div>
                
                <div class="relative z-10 w-full h-full flex flex-col justify-between p-12 lg:p-24">
                    <a href="/">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-28 drop-shadow-2xl">
                    </a>
                    
                    <div class="space-y-10">
                        <div class="inline-block px-6 py-3 bg-iaspig-orange/30 backdrop-blur-md rounded-full text-white font-bold text-base border border-white/20 tracking-[0.2em]">
                            PLATFORM ALUMNI GEOSPASIAL SPIG
                        </div>
                        <h2 class="text-6xl lg:text-8xl font-outfit font-bold text-white leading-tight drop-shadow-2xl">
                            Membangun <span class="text-iaspig-orange">Koneksi</span>,<br>Memperkuat Kolaborasi.
                        </h2>
                        <p class="text-white/90 text-2xl max-w-2xl leading-relaxed font-medium">
                            Selamat datang di ekosistem digital IASPIG UPI. Wadah bagi para profesional pemetaan untuk tumbuh bersama dalam satu harmoni industri geospasial.
                        </p>
                    </div>
                    
                    <div class="text-white/40 text-base font-semibold tracking-widest uppercase">
                        &copy; {{ date('Y') }} IASPIG UPI &bull; The Professional Mapping Network
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-iaspig-cream/30 relative">
                <div class="topo-pattern opacity-10"></div>
                
                <div class="w-full max-w-xl relative z-10">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden mb-16 text-center">
                         <a href="/">
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-24 mx-auto mb-6 drop-shadow-xl">
                        </a>
                        <h2 class="text-3xl font-bold text-iaspig-brown uppercase tracking-tighter">IASPIG PLATFORM</h2>
                    </div>

                    <div class="bg-white p-12 lg:p-20 rounded-[4rem] shadow-[0_48px_100px_-20px_rgba(93,64,55,0.25)] border border-gray-50 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-iaspig-orange/5 rounded-full -mr-32 -mt-32"></div>
                        <div class="relative z-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
