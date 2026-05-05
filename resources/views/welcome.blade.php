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
                <div class="p-10 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-100/50 hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange text-3xl mb-8 group-hover:bg-iaspig-orange group-hover:text-white transition-colors">
                        <i class="ri-map-2-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-4">Peta Sebaran Alumni</h3>
                    <p class="text-gray-500 leading-relaxed">Visualisasi interaktif sebaran alumni di seluruh wilayah menggunakan teknologi Web-GIS terkini.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="p-10 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-100/50 hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-iaspig-brown/10 rounded-2xl flex items-center justify-center text-iaspig-brown text-3xl mb-8 group-hover:bg-iaspig-brown group-hover:text-white transition-colors">
                        <i class="ri-building-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-4">Direktori Bisnis</h3>
                    <p class="text-gray-500 leading-relaxed">Wadah promosi perusahaan dan jasa survey milik alumni untuk kolaborasi bisnis yang lebih luas.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="p-10 rounded-3xl bg-white border border-gray-100 shadow-xl shadow-gray-100/50 hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange text-3xl mb-8 group-hover:bg-iaspig-orange group-hover:text-white transition-colors">
                        <i class="ri-briefcase-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-4">Bursa Kerja & Karier</h3>
                    <p class="text-gray-500 leading-relaxed">Akses peluang kerja strategis dan proyek eksklusif yang dibagikan langsung oleh rekan alumni di industri pemetaan.</p>
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
    <section class="pb-32">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-orange-brown rounded-[3rem] p-12 md:p-20 relative overflow-hidden shadow-2xl shadow-iaspig-brown/20">
                <div class="absolute top-0 right-0 w-96 h-96 bg-iaspig-orange/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <h2 class="text-4xl font-outfit font-bold text-white mb-6">Tertarik Bekerja Sama dengan Alumni Kami?</h2>
                        <p class="text-gray-300 text-lg mb-10">
                            Kami membuka peluang kemitraan bagi instansi pemerintah maupun swasta untuk berkolaborasi dengan talenta terbaik di bidang Geospasial.
                        </p>
                        <a href="mailto:info@spig.upi.edu" class="inline-flex items-center gap-2 bg-white text-iaspig-brown px-8 py-4 rounded-full font-bold hover:bg-iaspig-orange hover:text-white transition-all">
                            Ajukan Kemitraan <i class="ri-external-link-line"></i>
                        </a>
                    </div>
                    <div class="grid grid-cols-2 gap-4" data-aos="fade-left">
                        <div class="bg-white/5 p-8 rounded-2xl border border-white/10 text-center hover:bg-white/10 transition-colors">
                            <i class="ri-focus-3-line text-4xl text-iaspig-orange mb-4"></i>
                            <div class="text-white font-bold">Surveyor</div>
                        </div>
                        <div class="bg-white/5 p-8 rounded-2xl border border-white/10 text-center hover:bg-white/10 transition-colors">
                            <i class="ri-global-line text-4xl text-iaspig-orange mb-4"></i>
                            <div class="text-white font-bold">GIS Analyst</div>
                        </div>
                        <div class="bg-white/5 p-8 rounded-2xl border border-white/10 text-center hover:bg-white/10 transition-colors">
                            <i class="ri-compass-3-line text-4xl text-iaspig-orange mb-4"></i>
                            <div class="text-white font-bold">Mapper</div>
                        </div>
                        <div class="bg-white/5 p-8 rounded-2xl border border-white/10 text-center hover:bg-white/10 transition-colors">
                            <i class="ri-satellite-line text-4xl text-iaspig-orange mb-4"></i>
                            <div class="text-white font-bold">Remote Sensing</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
