<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header Section -->
            <div class="bg-gradient-orange-brown p-8 rounded-[2rem] shadow-xl text-white relative overflow-hidden flex flex-col md:flex-row items-center gap-8">
                <div class="topo-pattern opacity-10"></div>
                <div class="relative z-10">
                    <div class="w-32 h-32 rounded-full border-4 border-white/30 overflow-hidden bg-white/10 backdrop-blur-sm">
                        @if($alumni->alumniProfile && $alumni->alumniProfile->avatar)
                            <img src="{{ asset('storage/' . $alumni->alumniProfile->avatar) }}" alt="{{ $alumni->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white/50">
                                <i class="ri-user-line text-5xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="relative z-10 flex-1 text-center md:text-left">
                    <h2 class="text-4xl font-bold font-outfit uppercase tracking-tight">{{ $alumni->name }}</h2>
                    @if($alumni->alumniProfile)
                        <p class="text-white/90 text-lg mt-1">
                            {{ $alumni->alumniProfile->current_job ?? 'Alumni' }} 
                            @if($alumni->alumniProfile->company) di <strong>{{ $alumni->alumniProfile->company }}</strong> @endif
                        </p>
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 mt-4">
                            @if($alumni->alumniProfile->angkatan)
                                <span class="px-3 py-1 bg-white/20 rounded-full text-sm backdrop-blur-sm"><i class="ri-calendar-line mr-1"></i> Angkatan {{ $alumni->alumniProfile->angkatan }}</span>
                            @endif
                            @if($alumni->alumniProfile->availability_status)
                                <span class="px-3 py-1 bg-iaspig-brown/10 text-iaspig-brown border border-iaspig-brown/20 rounded-full text-sm backdrop-blur-sm"><i class="ri-check-line mr-1"></i> Open for Collab</span>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="relative z-10">
                    <a href="{{ route('alumni.directory') }}" class="px-6 py-3 bg-white/20 backdrop-blur-md border border-white/30 rounded-full font-bold hover:bg-white/30 transition-all flex items-center">
                        <i class="ri-arrow-left-line mr-2"></i> Kembali
                    </a>
                </div>
            </div>

            @if($alumni->alumniProfile)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column: Bio & Skills -->
                    <div class="space-y-8">
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <h3 class="text-lg font-bold text-iaspig-brown uppercase mb-4">Tentang</h3>
                            <p class="text-gray-600 leading-relaxed text-sm">
                                {{ $alumni->alumniProfile->bio ?? 'Belum ada bio.' }}
                            </p>

                            @if(is_array($alumni->alumniProfile->skills) && count($alumni->alumniProfile->skills) > 0)
                                <h3 class="text-lg font-bold text-iaspig-brown uppercase mt-8 mb-4">Keahlian</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($alumni->alumniProfile->skills as $skill)
                                        <span class="px-3 py-1 bg-iaspig-orange/10 text-iaspig-orange rounded-full text-xs font-bold">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <hr class="border-gray-100 my-6">
                            
                            <h3 class="text-lg font-bold text-iaspig-brown uppercase mb-4">Kontak Profesional</h3>
                            <div class="space-y-3">
                                <a href="mailto:{{ $alumni->email }}" class="flex items-center gap-3 text-gray-600 hover:text-iaspig-orange transition-colors text-sm">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center"><i class="ri-mail-line"></i></div>
                                    {{ $alumni->email }}
                                </a>
                                @if($alumni->alumniProfile->linkedin)
                                <a href="{{ $alumni->alumniProfile->linkedin }}" target="_blank" class="flex items-center gap-3 text-gray-600 hover:text-iaspig-orange transition-colors text-sm">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center"><i class="ri-linkedin-fill"></i></div>
                                    LinkedIn Profile
                                </a>
                                @endif
                                @if($alumni->alumniProfile->instagram)
                                <a href="{{ $alumni->alumniProfile->instagram }}" target="_blank" class="flex items-center gap-3 text-gray-600 hover:text-iaspig-orange transition-colors text-sm">
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center"><i class="ri-instagram-line"></i></div>
                                    Instagram Profile
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Career Map -->
                    <div class="lg:col-span-2 space-y-8">
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 relative overflow-hidden">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                        <i class="ri-route-line text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Career Journey Map</h3>
                                </div>
                            </div>
                            
                            @if(count($careerData) > 0)
                                <div id="career-journey-map" class="h-96 rounded-2xl border-2 border-gray-100 overflow-hidden z-0"></div>
                                
                                <div class="mt-6 space-y-4">
                                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Detail Riwayat</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($careerData as $job)
                                            <div class="p-4 rounded-xl border border-gray-100 {{ $job['is_current'] ? 'bg-iaspig-orange/5 border-iaspig-orange/30' : 'bg-gray-50' }}">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-xs font-bold px-2 py-1 bg-white rounded-lg border border-gray-200 text-gray-500">Pin #{{ $job['id'] }}</span>
                                                    @if($job['is_current'])
                                                        <span class="text-[10px] font-bold text-iaspig-orange uppercase tracking-wider bg-white px-2 py-1 rounded-md border border-iaspig-orange/20">Saat Ini</span>
                                                    @endif
                                                </div>
                                                <h5 class="font-bold text-iaspig-brown text-sm">{{ $job['position'] }}</h5>
                                                <p class="text-gray-600 text-xs">{{ $job['company'] }}</p>
                                                <p class="text-gray-400 text-[10px] mt-1">{{ $job['year'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                        <i class="ri-map-pin-line text-2xl"></i>
                                    </div>
                                    <h4 class="font-bold text-gray-600">Belum Ada Data Peta Karir</h4>
                                    <p class="text-sm text-gray-400 mt-1">Alumni ini belum memetakan riwayat pekerjaannya.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(count($careerData) > 0)
        @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            .custom-div-icon {
                background: transparent;
                border: none;
            }
            .career-pin {
                width: 32px;
                height: 32px;
                background-color: #E67E22;
                color: white;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
                border: 2px solid white;
            }
            .career-pin span {
                transform: rotate(45deg);
                font-weight: bold;
                font-size: 14px;
            }
            .career-pin.current {
                background-color: #5D4037;
                width: 36px;
                height: 36px;
                z-index: 1000;
            }
        </style>
        @endpush

        @push('scripts')
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var careerData = {!! json_encode($careerData) !!};
                
                var map = L.map('career-journey-map').setView([-2.5, 118.0], 5);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', { 
                    attribution: '&copy; OpenStreetMap' 
                }).addTo(map);

                var bounds = [];
                
                careerData.forEach(function(job) {
                    var isCurrentClass = job.is_current ? 'current' : '';
                    var iconHtml = '<div class="career-pin ' + isCurrentClass + '"><span>' + job.id + '</span></div>';
                    
                    var icon = L.divIcon({
                        className: 'custom-div-icon',
                        html: iconHtml,
                        iconSize: [32, 32],
                        iconAnchor: [16, 32]
                    });

                    var marker = L.marker([job.lat, job.lng], { icon: icon }).addTo(map);
                    marker.bindPopup('<b>' + job.company + '</b><br>' + job.position + '<br><span class="text-xs text-gray-500">' + job.year + '</span>');
                    
                    bounds.push([job.lat, job.lng]);
                });

                if (bounds.length > 1) {
                    // Draw lines connecting the journey
                    L.polyline(bounds, {
                        color: '#E67E22', 
                        weight: 3, 
                        dashArray: '5, 10',
                        opacity: 0.7
                    }).addTo(map);
                }

                if (bounds.length > 0) {
                    map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
                }
            });
        </script>
        @endpush
    @endif
</x-app-layout>
