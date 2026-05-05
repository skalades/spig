<div class="py-24 bg-iaspig-cream/30 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto mb-20 space-y-6" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 bg-iaspig-orange/10 text-iaspig-orange px-4 py-2 rounded-full font-bold text-xs tracking-widest uppercase">
                <i class="ri-store-2-line"></i> Marketplace Profesional
            </div>
            <h1 class="text-4xl md:text-5xl font-outfit font-bold text-iaspig-brown">Direktori Bisnis Alumni</h1>
            <p class="text-gray-500 text-lg">Temukan mitra strategis dan layanan geospasial terbaik langsung dari jaringan alumni SPIG UPI yang berpengalaman.</p>
        </div>

        <div class="mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-center">
                <div class="relative w-full sm:w-96">
                    <i class="ri-search-2-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
                    <input 
                        wire:model.live.debounce.300ms="search" 
                        type="text" 
                        placeholder="Cari perusahaan atau jasa..." 
                        class="w-full bg-white border-none rounded-[2rem] pl-16 pr-6 py-5 shadow-xl shadow-iaspig-brown/5 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all"
                    >
                </div>
                <div class="w-full sm:w-72">
                    <select wire:model.live="industry" class="w-full bg-white border-none rounded-[2rem] px-8 py-5 shadow-xl shadow-iaspig-brown/5 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown appearance-none transition-all">
                        <option value="">Semua Industri</option>
                        <option value="engineering">Engineering & Geospatial</option>
                        <option value="it_services">IT & Software Development</option>
                        <option value="creative">Creative Services</option>
                        <option value="general">General Services</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($companies as $company)
                <div class="bg-white rounded-[3rem] p-8 shadow-xl border border-gray-50 group hover:shadow-2xl hover:shadow-iaspig-brown/10 transition-all duration-500 relative overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="flex items-start gap-6 mb-8">
                        <div class="w-20 h-20 rounded-[1.5rem] bg-gray-50 flex-shrink-0 overflow-hidden border border-gray-100 p-2 group-hover:scale-110 transition-transform duration-500">
                            @if($company->hasMedia('logos'))
                                <img src="{{ $company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full bg-iaspig-brown/5 flex items-center justify-center text-iaspig-brown text-2xl font-black">
                                    {{ substr($company->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-[10px] font-black text-iaspig-orange uppercase tracking-widest mb-1">
                                {{ \App\Models\Company::INDUSTRY_TYPES[$company->industry_type] ?? $company->industry_type }}
                            </div>
                            <h3 class="text-2xl font-black text-iaspig-brown group-hover:text-iaspig-orange transition-colors truncate">{{ $company->name }}</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alumni Verified</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-iaspig-brown/60 font-medium text-sm leading-relaxed mb-8 line-clamp-3 h-[63px]">
                        {{ $company->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>

                    <div class="flex items-center justify-between pt-8 border-t border-gray-50">
                        <div class="flex gap-4">
                            @if($company->whatsapp_number)
                                <a href="https://wa.me/{{ $company->whatsapp_number }}" target="_blank" class="w-12 h-12 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all shadow-sm">
                                    <i class="ri-whatsapp-line text-xl"></i>
                                </a>
                            @endif
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="w-12 h-12 rounded-2xl bg-iaspig-brown/5 text-iaspig-brown flex items-center justify-center hover:bg-iaspig-brown hover:text-white transition-all shadow-sm">
                                    <i class="ri-global-line text-xl"></i>
                                </a>
                            @endif
                        </div>
                        
                        <a href="{{ route('public.directory.detail', $company->slug) }}" class="flex items-center gap-2 text-iaspig-brown font-black text-xs uppercase tracking-widest group/btn">
                            Lihat Profil
                            <i class="ri-arrow-right-line text-iaspig-orange group-hover/btn:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-20">
            {{ $companies->links() }}
        </div>
    </div>
</div>
