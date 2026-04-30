<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-iaspig-brown font-outfit uppercase tracking-tight">Selamat Datang Kembali</h2>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-bold text-iaspig-brown uppercase tracking-widest ml-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="ri-mail-line"></i>
                </div>
                <x-text-input id="email" class="block w-full pl-11" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-6 space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-iaspig-brown uppercase tracking-widest ml-1" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <i class="ri-lock-2-line"></i>
                </div>
                <x-text-input id="password" class="block w-full pl-11"
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-md border-gray-200 text-iaspig-orange shadow-sm focus:ring-iaspig-orange transition-all cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-gray-500 group-hover:text-iaspig-brown transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-iaspig-orange hover:text-iaspig-brown transition-colors font-semibold" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
        </div>

        <div class="mt-10">
            <x-primary-button class="w-full justify-center py-4 text-lg">
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-iaspig-orange font-bold hover:underline">Daftar Sekarang</a>
            </p>
        </div>
    </form>
</x-guest-layout>
