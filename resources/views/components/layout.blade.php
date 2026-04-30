<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'IASPIG - Ikatan Alumni SPIG UPI' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .topo-pattern {
            opacity: 0.05;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 10 Q 50 40 90 10' stroke='%235D4037' fill='transparent'/%3E%3Cpath d='M10 30 Q 50 60 90 30' stroke='%235D4037' fill='transparent'/%3E%3Cpath d='M10 50 Q 50 80 90 50' stroke='%235D4037' fill='transparent'/%3E%3C/svg%3E");
            pointer-events: none;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navbar -->
    <nav class="glass-nav">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo IASPIG" class="h-12">
                <div class="hidden md:block">
                    <span class="block font-outfit font-bold text-iaspig-brown leading-none text-xl">IASPIG</span>
                    <span class="text-xs text-iaspig-orange font-semibold">ALUMNI SPIG UPI</span>
                </div>
            </a>
            
            <div class="hidden lg:flex items-center gap-8 font-semibold">
                <a href="#" class="hover:text-iaspig-orange transition-colors">Beranda</a>
                <a href="#" class="hover:text-iaspig-orange transition-colors">Direktori</a>
                <a href="#" class="hover:text-iaspig-orange transition-colors">Peta Sebaran</a>
                <a href="#" class="hover:text-iaspig-orange transition-colors">Bisnis</a>
            </div>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-iaspig-brown font-semibold hover:text-iaspig-orange transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="btn-primary">Gabung</a>
            </div>
        </div>
    </nav>

    <main class="pb-20 lg:pb-0">
        {{ $slot }}
    </main>

    <!-- Bottom Navigation (Mobile Only) -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white/80 backdrop-blur-lg border-t border-gray-100 z-50 lg:hidden px-4 py-3">
        <div class="flex justify-between items-center max-w-md mx-auto">
            <a href="/" class="flex flex-col items-center gap-1 text-iaspig-orange">
                <i class="ri-home-5-line text-2xl"></i>
                <span class="text-[10px] font-bold uppercase">Beranda</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1 text-gray-400 hover:text-iaspig-orange transition-colors">
                <i class="ri-team-line text-2xl"></i>
                <span class="text-[10px] font-bold uppercase">Direktori</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1 text-gray-400 hover:text-iaspig-orange transition-colors">
                <i class="ri-map-pin-2-line text-2xl"></i>
                <span class="text-[10px] font-bold uppercase">Peta</span>
            </a>
            <a href="#" class="flex flex-col items-center gap-1 text-gray-400 hover:text-iaspig-orange transition-colors">
                <i class="ri-briefcase-line text-2xl"></i>
                <span class="text-[10px] font-bold uppercase">Karier</span>
            </a>
            <a href="{{ route('login') }}" class="flex flex-col items-center gap-1 text-gray-400 hover:text-iaspig-orange transition-colors">
                <i class="ri-user-3-line text-2xl"></i>
                <span class="text-[10px] font-bold uppercase">Masuk</span>
            </a>
        </div>
    </nav>

    <!-- Footer -->
    <footer class="bg-iaspig-brown text-white py-16">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-16 mb-6">
                <p class="text-gray-300 max-w-md">
                    Ikatan Alumni Survey Pemetaan dan Informasi Geografis (IASPIG) Universitas Pendidikan Indonesia. 
                    Membangun koneksi, memperkuat kolaborasi geospasial.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-6">Navigasi</h4>
                <ul class="space-y-4 text-gray-400">
                    <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Kontak</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-6">Sosial Media</h4>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-iaspig-orange transition-all"><i class="ri-instagram-line"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-iaspig-orange transition-all"><i class="ri-linkedin-box-line"></i></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-iaspig-orange transition-all"><i class="ri-facebook-box-line"></i></a>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-6 mt-16 pt-8 border-t border-white/10 text-center text-gray-500">
            <p>&copy; {{ date('Y') }} IASPIG UPI. All rights reserved.</p>
        </div>
    </footer>
    <!-- AOS Init -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-in-out',
        });
    </script>
</body>
</html>
