@section('title', $company->name . ' - Marketplace Alumni')

<div class="py-24 bg-iaspig-cream/30 min-h-screen">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Back Link -->
        <a href="{{ route('public.directory.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-iaspig-orange transition-colors mb-8 font-bold uppercase tracking-widest text-xs" data-aos="fade-right">
            <i class="ri-arrow-left-line"></i> Kembali ke Direktori
        </a>

        <!-- Hero Section -->
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-iaspig-brown/5 border border-gray-50 overflow-hidden mb-12" data-aos="fade-up">
            <!-- Cover/Banner Pattern -->
            <div class="h-48 bg-iaspig-brown relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="2" fill="none"/>
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
                    </svg>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="px-8 md:px-12 pb-12">
                <div class="flex flex-col md:flex-row gap-8 items-start -mt-20 relative z-10">
                    <!-- Logo -->
                    <div class="w-40 h-40 rounded-[2.5rem] bg-white shadow-xl flex-shrink-0 flex items-center justify-center overflow-hidden border-8 border-white">
                        @if($company->hasMedia('logos'))
                            <img src="{{ $company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full bg-iaspig-orange/10 flex items-center justify-center text-iaspig-orange text-5xl font-black">
                                {{ substr($company->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="flex-1 pt-24 md:pt-20">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-4">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-[10px] font-black text-iaspig-orange uppercase tracking-widest">{{ \App\Models\Company::INDUSTRY_TYPES[$company->industry_type] ?? $company->industry_type }}</span>
                                    <span class="px-3 py-1 bg-green-50 text-green-500 text-[10px] font-black uppercase tracking-widest rounded-lg flex items-center gap-1">
                                        <i class="ri-shield-check-fill"></i> Alumni Verified
                                    </span>
                                </div>
                                <h1 class="text-4xl md:text-5xl font-black text-iaspig-brown leading-tight">{{ $company->name }}</h1>
                                <p class="text-gray-400 font-bold mt-2">Professional Member IASPIG</p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3">
                                @if($company->whatsapp_number)
                                    <a href="https://wa.me/{{ $company->whatsapp_number }}" target="_blank" class="px-8 py-4 rounded-2xl bg-green-50 text-green-500 font-black text-xs uppercase tracking-widest hover:bg-green-500 hover:text-white transition-all flex items-center gap-2 shadow-lg shadow-green-500/10">
                                        <i class="ri-whatsapp-line text-lg"></i> Hubungi Sekarang
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Contact Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 p-6 bg-gray-50 rounded-3xl border border-gray-100">
                            @if($company->website)
                            <a href="{{ $company->website }}" target="_blank" class="flex items-center gap-4 text-iaspig-brown hover:text-iaspig-orange transition-colors group">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="ri-global-line"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Website</p>
                                    <p class="text-sm font-bold truncate max-w-[150px]">{{ parse_url($company->website, PHP_URL_HOST) ?? $company->website }}</p>
                                </div>
                            </a>
                            @endif

                            @if($company->email)
                            <a href="mailto:{{ $company->email }}" class="flex items-center gap-4 text-iaspig-brown hover:text-iaspig-orange transition-colors group">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="ri-mail-line"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Email Bisnis</p>
                                    <p class="text-sm font-bold truncate max-w-[150px]">{{ $company->email }}</p>
                                </div>
                            </a>
                            @endif

                            @if($company->address)
                            <div class="flex items-center gap-4 text-iaspig-brown group">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center">
                                    <i class="ri-map-pin-line text-iaspig-orange"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Lokasi</p>
                                    <p class="text-sm font-bold truncate max-w-[150px]">{{ $company->address }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="space-y-12">
            <!-- About & Services -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2 space-y-12">
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-gray-50" data-aos="fade-up">
                        <h3 class="text-2xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                            <i class="ri-information-line text-iaspig-orange"></i> Tentang Perusahaan
                        </h3>
                        <div class="text-gray-500 font-medium leading-relaxed whitespace-pre-line text-lg">
                            {{ $company->description ?? 'Belum ada deskripsi.' }}
                        </div>
                    </div>

                    @if($company->services->isNotEmpty())
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-gray-50" data-aos="fade-up">
                        <h3 class="text-2xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                            <i class="ri-service-line text-iaspig-orange"></i> Layanan & Jasa Utama
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($company->services as $service)
                                <span class="px-6 py-3 bg-iaspig-brown/5 text-iaspig-brown font-black text-sm uppercase tracking-widest rounded-2xl hover:bg-iaspig-orange hover:text-white transition-colors cursor-default">
                                    {{ $service->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <div class="space-y-12">
                    @if($company->latitude && $company->longitude)
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-gray-50 overflow-hidden" data-aos="fade-left">
                        <h3 class="text-xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                            <i class="ri-map-pin-line text-iaspig-orange"></i> Peta Lokasi
                        </h3>
                        <div id="companyMap" class="h-64 w-full rounded-2xl z-0 shadow-inner border border-gray-100"></div>
                        <p class="mt-4 text-[10px] font-bold text-gray-400 italic leading-relaxed">
                            {{ $company->address }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Portfolio Section -->
            @if(($company->settings['show_portfolio'] ?? true) && $company->projects->count() > 0)
            <div class="bg-white rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-iaspig-brown/5 border border-gray-50" data-aos="fade-up">
                <div class="mb-12">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-iaspig-brown/5 rounded-full text-[10px] font-black text-iaspig-brown uppercase tracking-widest mb-2">
                        <i class="ri-folder-shared-line"></i> Portofolio
                    </div>
                    <h2 class="text-3xl font-black text-iaspig-brown">Rekam Jejak & Proyek</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($company->projects as $project)
                    <div class="group bg-gray-50 rounded-[2.5rem] overflow-hidden border border-gray-100 hover:border-iaspig-orange/20 transition-all duration-500">
                        <div class="aspect-video relative overflow-hidden">
                            @if($project->hasMedia('projects'))
                                <img src="{{ $project->getFirstMediaUrl('projects', 'optimized') }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-iaspig-brown/10 flex items-center justify-center text-iaspig-brown/20">
                                    <i class="ri-folder-image-line text-6xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-8">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-black uppercase tracking-widest text-iaspig-orange">{{ $project->client_name ?? 'Client Partner' }}</span>
                                <span class="text-[10px] font-bold text-gray-400">{{ $project->project_date ? $project->project_date->format('Y') : '' }}</span>
                            </div>
                            <h4 class="text-xl font-black text-iaspig-brown mb-2">{{ $project->title }}</h4>
                            <p class="text-sm font-medium text-gray-500 line-clamp-2 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Rental Inventories -->
            @if(($company->settings['show_rental'] ?? false) && $company->inventories->isNotEmpty())
            <div data-aos="fade-up">
                <h3 class="text-3xl font-black text-iaspig-brown mb-8 px-4">Katalog Rental & Peralatan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($company->inventories as $item)
                    <div class="bg-white rounded-[2rem] p-6 shadow-xl border border-gray-50 group hover:-translate-y-1 transition-transform">
                        <div class="h-48 rounded-xl bg-gray-50 mb-6 overflow-hidden flex items-center justify-center">
                            @if($item->hasMedia('inventories'))
                                <img src="{{ $item->getFirstMediaUrl('inventories', 'thumb') }}" class="w-full h-full object-cover">
                            @else
                                <i class="ri-tools-line text-5xl text-gray-300"></i>
                            @endif
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-black uppercase tracking-widest text-iaspig-orange">{{ $item->category }}</span>
                            <span class="px-3 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest {{ $item->status === 'available' ? 'bg-green-50 text-green-500' : 'bg-red-50 text-red-500' }}">
                                {{ $item->status === 'available' ? 'Tersedia' : 'Disewa' }}
                            </span>
                        </div>
                        <h4 class="text-xl font-black text-iaspig-brown mb-2">{{ $item->item_name }}</h4>
                        <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                            <div class="font-black text-iaspig-brown">
                                {{ $item->formatted_rate }} <span class="text-xs text-gray-400 font-bold">/ hari</span>
                            </div>
                            <a href="https://wa.me/{{ $company->whatsapp_number }}?text=Halo%20{{ $company->name }},%20saya%20tertarik%20untuk%20menyewa%20{{ $item->item_name }}" target="_blank" class="px-4 py-2 bg-iaspig-brown text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-iaspig-orange transition-colors">
                                Tanya Sewa
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($company->latitude && $company->longitude)
                const lat = {{ $company->latitude }};
                const lng = {{ $company->longitude }};
                
                const map = L.map('companyMap', {
                    scrollWheelZoom: false,
                    attributionControl: false
                }).setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                @php
                    $icon = match($company->industry_type) {
                        'engineering' => 'ri-compass-3-fill',
                        'it_services' => 'ri-code-s-slash-fill',
                        'creative' => 'ri-camera-fill',
                        'consultant' => 'ri-briefcase-fill',
                        'commerce' => 'ri-shopping-bag-fill',
                        default => 'ri-community-fill',
                    };
                @endphp

                const customIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div class="w-10 h-10 bg-iaspig-orange rounded-full border-4 border-white shadow-xl flex items-center justify-center text-white">
                            <i class="{{ $icon }} text-xl"></i>
                          </div>`,
                    iconSize: [40, 40],
                    iconAnchor: [20, 40]
                });

                L.marker([lat, lng], { icon: customIcon }).addTo(map)
                    .bindPopup("<div class='font-black text-iaspig-brown p-2'>{{ $company->name }}</div>")
                    .openPopup();
            @endif
        });
    </script>
@endpush
