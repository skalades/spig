<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <!-- OpenGraph Meta Tags -->
        <meta property="og:title" content="@yield('title', config('app.name', 'Laravel'))">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="IASPIG Social Hub">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
        
        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-24 lg:pb-0">
                {{ $slot }}
            </main>

            @if(Auth::check() && Auth::user()->role === 'alumni')
                <x-alumni.bottom-nav />
                @livewire('alumni.report-modal')
            @endif
        </div>

        <!-- Global Notification Handler -->
        <div 
            x-data="{ 
                show: false, 
                message: '', 
                type: 'success',
                timer: null
            }"
            @notify.window="
                show = true;
                message = $event.detail[0].message;
                type = $event.detail[0].type || 'success';
                clearTimeout(timer);
                timer = setTimeout(() => show = false, 3000);
            "
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-10"
            class="fixed bottom-28 left-4 right-4 sm:left-auto sm:right-8 sm:w-96 z-[100]"
            style="display: none;"
        >
            <div :class="{
                'bg-iaspig-brown': type === 'success',
                'bg-red-500': type === 'error'
            }" class="p-6 rounded-[2rem] shadow-2xl flex items-center gap-4 text-white">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <i :class="type === 'success' ? 'ri-checkbox-circle-line' : 'ri-error-warning-line'" class="text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="text-xs font-black uppercase tracking-widest opacity-60" x-text="type === 'success' ? 'Berhasil' : 'Peringatan'"></p>
                    <p class="text-sm font-bold" x-text="message"></p>
                </div>
                <button @click="show = false" class="text-white/40 hover:text-white">
                    <i class="ri-close-line text-xl"></i>
                </button>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
