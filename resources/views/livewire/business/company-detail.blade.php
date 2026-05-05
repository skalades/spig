@section('title', $company->name . ' - Business Directory')

<div class="py-12">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Owner Status Banner -->
        @if($isOwner && $company->status !== 'approved')
            <div class="mb-8 p-6 rounded-[2rem] bg-yellow-50 border border-yellow-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4 text-yellow-700">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center text-2xl">
                        <i class="ri-error-warning-line"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest opacity-60">Status Bisnis: {{ ucfirst($company->status) }}</p>
                        <p class="text-sm font-bold">Profil ini hanya dapat dilihat oleh Anda sebelum disetujui oleh admin.</p>
                    </div>
                </div>
                <a href="{{ route('alumni.business.manage') }}" class="px-6 py-3 rounded-xl bg-yellow-600 text-white font-black text-xs uppercase tracking-widest hover:bg-yellow-700 transition-colors">
                    Lengkapi Profil
                </a>
            </div>
        @endif

        <!-- Back Link -->
        <a href="{{ route('alumni.business.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-iaspig-orange transition-colors mb-8 font-bold uppercase tracking-widest text-xs">
            <i class="ri-arrow-left-line"></i> Kembali ke Direktori
        </a>

        <!-- Hero Section -->
        <div class="bg-white rounded-[3rem] shadow-2xl shadow-iaspig-brown/5 border border-gray-50 overflow-hidden mb-12">
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
                                    @if($company->is_verified)
                                        <span class="px-3 py-1 bg-green-50 text-green-500 text-[10px] font-black uppercase tracking-widest rounded-lg flex items-center gap-1">
                                            <i class="ri-shield-check-fill"></i> Verified
                                        </span>
                                    @endif
                                </div>
                                <h1 class="text-4xl md:text-5xl font-black text-iaspig-brown leading-tight">{{ $company->name }}</h1>
                                <p class="text-gray-400 font-bold mt-2">Didirikan oleh <span class="text-iaspig-orange">{{ $company->user->name }}</span></p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3">
                                @if($isOwner)
                                    <a href="{{ route('alumni.business.manage') }}" class="px-6 py-4 rounded-2xl bg-iaspig-brown text-white font-black text-xs uppercase tracking-widest hover:bg-iaspig-orange transition-all flex items-center gap-2">
                                        <i class="ri-edit-line text-lg"></i> Edit Profil
                                    </a>
                                @endif
                                @if($company->whatsapp_number)
                                    <a href="https://wa.me/{{ $company->whatsapp_number }}" target="_blank" class="px-6 py-4 rounded-2xl bg-green-50 text-green-500 font-black text-xs uppercase tracking-widest hover:bg-green-500 hover:text-white transition-all flex items-center gap-2">
                                        <i class="ri-whatsapp-line text-lg"></i> Hubungi
                                    </a>
                                @endif
                                <button 
                                    @click="$dispatch('openReportModal', { id: '{{ $company->id }}', type: 'App\\Models\\Company' })"
                                    class="w-12 h-12 rounded-2xl bg-gray-50 text-gray-400 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all"
                                >
                                    <i class="ri-flag-line text-lg"></i>
                                </button>
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
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Email</p>
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

                            <!-- Social Media Links -->
                            @if($company->instagram)
                            <a href="{{ $company->instagram }}" target="_blank" class="flex items-center gap-4 text-iaspig-brown hover:text-iaspig-orange transition-colors group">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="ri-instagram-line"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Instagram</p>
                                    <p class="text-sm font-bold truncate max-w-[150px]">{{ str_replace(['https://instagram.com/', 'https://www.instagram.com/'], '@', rtrim($company->instagram, '/')) }}</p>
                                </div>
                            </a>
                            @endif

                            @if($company->linkedin)
                            <a href="{{ $company->linkedin }}" target="_blank" class="flex items-center gap-4 text-iaspig-brown hover:text-iaspig-orange transition-colors group">
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="ri-linkedin-box-line"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">LinkedIn</p>
                                    <p class="text-sm font-bold">Visit Profile</p>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Split -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left Column: Description & Services -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Description -->
                <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-gray-50">
                    <h3 class="text-2xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                        <i class="ri-information-line text-iaspig-orange"></i> Tentang Perusahaan
                    </h3>
                    <div class="text-gray-500 font-medium leading-relaxed whitespace-pre-line text-lg">
                        {{ $company->description ?? 'Belum ada deskripsi.' }}
                    </div>
                </div>

                <!-- Services -->
                @if($company->services->isNotEmpty())
                <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-gray-50">
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
                
                <!-- Map Section -->
                @if($company->latitude && $company->longitude)
                <div class="bg-white p-10 rounded-[3rem] shadow-xl border border-gray-50 overflow-hidden">
                    <h3 class="text-2xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                        <i class="ri-map-pin-line text-iaspig-orange"></i> Lokasi Perusahaan
                    </h3>
                    <div id="companyMap" class="h-80 w-full rounded-2xl z-0 shadow-inner border border-gray-100"></div>
                    <p class="mt-4 text-xs font-bold text-gray-400 italic flex items-center gap-2">
                        <i class="ri-information-line"></i> {{ $company->address }}
                    </p>
                </div>
                @endif

                <!-- Portfolio Section -->
                @if(($company->settings['show_portfolio'] ?? true) && $company->projects->count() > 0)
                <div class="bg-white rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-iaspig-brown/5 border border-gray-50 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-12">
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-iaspig-brown/5 rounded-full text-[10px] font-black text-iaspig-brown uppercase tracking-widest mb-2">
                                <i class="ri-folder-shared-line"></i> Works
                            </div>
                            <h2 class="text-3xl font-black text-iaspig-brown">Portofolio & Proyek</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                                <div class="absolute inset-0 bg-gradient-to-t from-iaspig-brown/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                                    @if($project->url)
                                        <a href="{{ $project->url }}" target="_blank" class="w-full py-3 bg-white text-iaspig-brown rounded-xl font-black text-xs uppercase tracking-widest text-center hover:bg-iaspig-orange hover:text-white transition-colors">
                                            Lihat Project
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-iaspig-orange">{{ $project->client_name ?? 'Confidential Client' }}</span>
                                    <span class="text-[10px] font-bold text-gray-400">{{ $project->project_date ? $project->project_date->format('Y') : 'N/A' }}</span>
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
                <div>
                    <h3 class="text-3xl font-black text-iaspig-brown mb-8">
                        {{ $company->industry_type === 'engineering' ? 'Katalog Rental Alat Survey' : 'Inventaris & Peralatan' }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                                    {{ $item->status }}
                                </span>
                            </div>
                            <h4 class="text-xl font-black text-iaspig-brown mb-2">{{ $item->item_name }}</h4>
                            <p class="text-sm font-bold text-gray-400 mb-4 line-clamp-2">{{ $item->description }}</p>
                            
                            <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                                <div class="font-black text-iaspig-brown">
                                    {{ $item->formatted_rate }} <span class="text-xs text-gray-400 font-bold">/ hari</span>
                                </div>
                                <button class="px-4 py-2 bg-iaspig-brown/5 text-iaspig-brown rounded-xl text-xs font-black uppercase tracking-widest hover:bg-iaspig-orange hover:text-white transition-colors">
                                    Sewa
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-8">
                <!-- Job Posts from this company -->
                @if($company->jobPosts->isNotEmpty())
                <div class="bg-iaspig-brown p-8 rounded-[2.5rem] shadow-2xl text-white relative overflow-hidden">
                    <div class="absolute -right-5 -bottom-5 text-white/5">
                        <i class="ri-briefcase-line text-[100px]"></i>
                    </div>
                    <div class="relative z-10">
                        <h4 class="text-xl font-black mb-6">Lowongan Terbuka</h4>
                        <div class="space-y-4">
                            @foreach($company->jobPosts->where('status', 'open')->take(3) as $job)
                            <a href="{{ route('alumni.jobs.show', $job->slug) }}" class="block bg-white/10 hover:bg-white/20 p-4 rounded-2xl transition-colors">
                                <h5 class="font-black text-lg mb-1">{{ $job->title }}</h5>
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-300">
                                    <span>{{ $job->location }}</span>
                                    <span>•</span>
                                    <span>{{ $job->job_type }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <a href="{{ route('alumni.jobs.index') }}?search={{ $company->name }}" class="block w-full text-center mt-6 py-4 bg-iaspig-orange rounded-xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-transform shadow-xl shadow-iaspig-orange/30">
                            Lihat Semua Lowongan
                        </a>
                    </div>
                </div>
                @endif
            </div>
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
