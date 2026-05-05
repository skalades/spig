<x-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-gradient-premium">
        <div class="topo-pattern"></div>
        <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 bg-iaspig-orange/10 text-iaspig-orange px-4 py-2 rounded-full font-bold text-sm tracking-wide">
                    <i class="ri-radar-line text-lg"></i>
                    GEOSPACIAL COMMUNITY
                </div>
                <h1 class="text-5xl lg:text-7xl font-outfit font-bold text-iaspig-brown leading-tight" data-aos="fade-up">
                    Sinergi Geospasial, <span class="text-iaspig-orange">Membangun</span> Negeri.
                </h1>
                <p class="text-lg text-gray-600 max-w-xl" data-aos="fade-up" data-aos-delay="200">
                    Pusat kolaborasi strategis alumni SPIG UPI. Akses bursa kerja eksklusif, direktori bisnis pemetaan, dan jaringan profesional dalam satu ekosistem digital yang progresif untuk masa depan survei dan pemetaan Indonesia.
                </p>
                <div class="flex flex-wrap gap-4 pt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('register') }}" class="btn-primary flex items-center gap-2 text-lg">
                        Gabung Sekarang <i class="ri-arrow-right-line"></i>
                    </a>
                    <a href="{{ route('alumni.dashboard') }}" class="px-8 py-3 rounded-full border-2 border-iaspig-brown text-iaspig-brown font-bold hover:bg-iaspig-brown hover:text-white transition-all duration-300">
                        Lihat Peta Sebaran
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="zoom-in" data-aos-delay="600">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-iaspig-orange/10 rounded-full blur-3xl animate-slow-pulse"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-iaspig-brown/10 rounded-full blur-3xl animate-slow-pulse" style="animation-delay: -4s;"></div>
                
                <!-- Floating Badge -->
                <div class="absolute -left-8 top-1/4 z-20 bg-white/80 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-white/50 flex items-center gap-4 animate-float">
                    <div class="w-12 h-12 bg-iaspig-orange rounded-full flex items-center justify-center text-white text-xl shadow-lg shadow-iaspig-orange/30">
                        <i class="ri-team-fill"></i>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 font-bold uppercase tracking-tighter">Verified Alumni</div>
                        <div class="text-xl font-bold text-iaspig-brown font-outfit">1.842+ Anggota</div>
                    </div>
                </div>

                <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ asset('assets/img/hero_bg.jpg') }}" alt="Surveying Concept" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-iaspig-cream py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach($stats as $index => $stat)
                <div class="space-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="text-4xl font-bold text-iaspig-orange font-outfit">{{ $stat->value }}</div>
                    <div class="text-sm font-semibold text-iaspig-brown uppercase tracking-widest">{{ $stat->label }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-20 space-y-4" data-aos="fade-up">
                <h2 class="text-4xl font-outfit font-bold text-iaspig-brown">Eksplorasi Ekosistem IASPIG</h2>
                <p class="text-gray-500 italic font-medium">Solusi cerdas untuk menjaga koneksi dan akselerasi pertumbuhan profesional di industri geospasial.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <a href="{{ route('public.distribution') }}" class="p-10 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-100/50 hover:-translate-y-2 transition-all duration-500 group block" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange text-3xl mb-8 group-hover:bg-iaspig-orange group-hover:text-white transition-colors">
                        <i class="ri-map-pin-2-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-4">Peta Sebaran Alumni</h3>
                    <p class="text-gray-500 leading-relaxed">Pantau persebaran geografis ribuan alumni SPIG UPI yang tersebar di seluruh Indonesia dan mancanegara secara real-time.</p>
                </a>
                
                <!-- Feature 2 -->
                <a href="{{ route('public.directory.index') }}" class="p-10 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-100/50 hover:-translate-y-2 transition-all duration-500 group block" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-iaspig-brown/10 rounded-2xl flex items-center justify-center text-iaspig-brown text-3xl mb-8 group-hover:bg-iaspig-brown group-hover:text-white transition-colors">
                        <i class="ri-store-2-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-4">Gerbang Bisnis Alumni</h3>
                    <p class="text-gray-500 leading-relaxed mb-6">Marketplace profesional untuk menemukan jasa surveyor, GIS, dan layanan teknis lainnya langsung dari tangan ahli.</p>
                    <div class="flex items-center gap-2 text-iaspig-brown font-bold text-sm">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        {{ $businessCount }}+ Bisnis Terdaftar
                    </div>
                </a>
                
                <!-- Feature 3 -->
                <div class="p-10 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-100/50 hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange text-3xl mb-8 group-hover:bg-iaspig-orange group-hover:text-white transition-colors">
                        <i class="ri-calendar-event-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-4">Agenda & Event Komunitas</h3>
                    <div class="space-y-4">
                        @foreach($upcomingEvents as $event)
                        <div class="flex items-start gap-3">
                            <div class="bg-iaspig-orange/10 text-iaspig-orange text-[10px] font-bold px-2 py-1 rounded-md whitespace-nowrap mt-1">
                                {{ $event->event_date->format('d M') }}
                            </div>
                            <div class="text-sm text-gray-600 font-medium line-clamp-1">{{ $event->title }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="py-32 bg-iaspig-cream/30">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div class="max-w-2xl space-y-4" data-aos="fade-right">
                    <h2 class="text-4xl font-outfit font-bold text-iaspig-brown">Karya Nyata & Portofolio</h2>
                    <p class="text-gray-500 font-medium">Rekam jejak dedikasi alumni dalam proyek strategis nasional, mulai dari infrastruktur hingga pemetaan lingkungan.</p>
                </div>
                <div data-aos="fade-left">
                    <a href="{{ route('alumni.business.index') }}" class="inline-flex items-center gap-2 text-iaspig-orange font-bold hover:gap-4 transition-all">
                        Lihat Semua Proyek <i class="ri-arrow-right-line"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($projects as $index => $project)
                <div class="group relative rounded-3xl overflow-hidden shadow-2xl h-[400px]" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-iaspig-brown via-iaspig-brown/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                    <div class="absolute bottom-0 left-0 p-8 w-full transform translate-y-4 group-hover:translate-y-0 transition-transform">
                        <span class="text-iaspig-orange font-bold text-xs uppercase tracking-widest mb-2 block">{{ $project->category }}</span>
                        <h3 class="text-white text-xl font-bold mb-2">{{ $project->title }}</h3>
                        <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500">{{ $project->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Partner CTA -->
    <section id="kemitraan" class="py-32 relative overflow-hidden bg-[#1a110e]">
        <div class="absolute inset-0 topo-pattern opacity-[0.03]"></div>
        <div class="absolute -left-24 top-0 w-96 h-96 bg-iaspig-orange/10 rounded-full blur-[120px]"></div>
        <div class="absolute -right-24 bottom-0 w-96 h-96 bg-iaspig-brown/20 rounded-full blur-[120px]"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-12" data-aos="fade-right">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-3 px-4 py-2 bg-iaspig-orange/10 rounded-full border border-iaspig-orange/20">
                            <span class="w-2 h-2 bg-iaspig-orange rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-iaspig-orange">Collaboration</span>
                        </div>
                        <h2 class="text-5xl md:text-6xl font-outfit font-bold text-white leading-tight">Sinergi Strategis <br> Bersama <span class="text-iaspig-orange">Alumni</span></h2>
                        <p class="text-gray-400 text-lg leading-relaxed max-w-xl">
                            Buka peluang kolaborasi baru. Kami menghubungkan instansi Anda dengan tenaga ahli geospasial tersertifikasi dari jaringan alumni SPIG UPI.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="group p-8 rounded-3xl bg-white/[0.03] border border-white/5 hover:border-iaspig-orange/30 transition-all duration-500">
                            <div class="w-14 h-14 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange text-2xl mb-6 group-hover:bg-iaspig-orange group-hover:text-white transition-all">
                                <i class="ri-mail-send-line"></i>
                            </div>
                            <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">Email Korespondensi</div>
                            <div class="text-white font-bold text-lg">info@spig.upi.edu</div>
                        </div>

                        <div class="group p-8 rounded-3xl bg-white/[0.03] border border-white/5 hover:border-iaspig-orange/30 transition-all duration-500">
                            <div class="w-14 h-14 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange text-2xl mb-6 group-hover:bg-iaspig-orange group-hover:text-white transition-all">
                                <i class="ri-map-pin-line"></i>
                            </div>
                            <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest mb-1">Lokasi Sekretariat</div>
                            <div class="text-white font-bold leading-snug">Kampus UPI, Bandung</div>
                        </div>
                    </div>
                </div>

                @livewire('landing.partnership-form')
            </div>
        </div>
    </section>
</x-layout>
