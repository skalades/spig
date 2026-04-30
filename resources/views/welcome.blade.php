<x-layout>
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center overflow-hidden">
        <div class="topo-pattern"></div>
        <div class="container mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 bg-iaspig-orange/10 text-iaspig-orange px-4 py-2 rounded-full font-bold text-sm tracking-wide">
                    <i class="ri-radar-line text-lg"></i>
                    GEOSPACIAL COMMUNITY
                </div>
                <h1 class="text-5xl lg:text-7xl font-outfit font-bold text-iaspig-brown leading-tight" data-aos="fade-up">
                    Koneksi Tanpa Batas, <span class="text-iaspig-orange">Kolaborasi</span> Tanpa Jarak.
                </h1>
                <p class="text-lg text-gray-600 max-w-xl" data-aos="fade-up" data-aos-delay="200">
                    Wadah pemersatu alumni SPIG UPI untuk menjaga napas silaturahmi lintas generasi. 
                    Temukan rekan seperjuangan, akses bursa kerja eksklusif, dan kembangkan potensi bisnis pemetaanmu dalam satu ekosistem yang kolaboratif dan progresif.
                </p>
                <div class="flex flex-wrap gap-4 pt-4" data-aos="fade-up" data-aos-delay="400">
                    <a href="#" class="btn-primary flex items-center gap-2 text-lg">
                        Gabung Sekarang <i class="ri-arrow-right-line"></i>
                    </a>
                    <a href="#" class="px-8 py-3 rounded-full border-2 border-iaspig-brown text-iaspig-brown font-bold hover:bg-iaspig-brown hover:text-white transition-all duration-300">
                        Lihat Peta Sebaran
                    </a>
                </div>
            </div>
            <div class="relative" data-aos="zoom-in" data-aos-delay="600">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-iaspig-orange/10 rounded-full blur-3xl animate-slow-pulse"></div>
                <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-iaspig-brown/10 rounded-full blur-3xl animate-slow-pulse" style="animation-delay: -4s;"></div>
                <div class="rounded-3xl overflow-hidden shadow-2xl border-8 border-white transform rotate-2 animate-float">
                    <img src="{{ asset('assets/img/hero_bg.png') }}" alt="Surveying Concept" class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-iaspig-cream py-20 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl font-bold text-iaspig-orange font-outfit">1,500+</div>
                    <div class="text-sm font-semibold text-iaspig-brown uppercase tracking-widest">Total Alumni</div>
                </div>
                <div class="space-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl font-bold text-iaspig-orange font-outfit">25+</div>
                    <div class="text-sm font-semibold text-iaspig-brown uppercase tracking-widest">Angkatan</div>
                </div>
                <div class="space-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl font-bold text-iaspig-orange font-outfit">300+</div>
                    <div class="text-sm font-semibold text-iaspig-brown uppercase tracking-widest">Perusahaan</div>
                </div>
                <div class="space-y-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl font-bold text-iaspig-orange font-outfit">34</div>
                    <div class="text-sm font-semibold text-iaspig-brown uppercase tracking-widest">Provinsi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-20 space-y-4" data-aos="fade-up">
                <h2 class="text-4xl font-outfit font-bold text-iaspig-brown">Fitur Unggulan Geospasial</h2>
                <p class="text-gray-500">Ekosistem digital untuk menjaga koneksi dan mendukung pertumbuhan profesional alumni.</p>
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

    <!-- Partner CTA -->
    <section class="pb-32">
        <div class="container mx-auto px-6">
            <div class="bg-iaspig-brown rounded-[3rem] p-12 md:p-20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-96 h-96 bg-iaspig-orange/10 rounded-full blur-3xl -mr-48 -mt-48"></div>
                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <h2 class="text-4xl font-outfit font-bold text-white mb-6">Tertarik Bekerja Sama dengan Alumni Kami?</h2>
                        <p class="text-gray-300 text-lg mb-10">
                            Kami membuka peluang kemitraan bagi instansi pemerintah maupun swasta untuk berkolaborasi dengan talenta terbaik di bidang Geospasial.
                        </p>
                        <a href="#" class="inline-flex items-center gap-2 bg-white text-iaspig-brown px-8 py-4 rounded-full font-bold hover:bg-iaspig-orange hover:text-white transition-all">
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
