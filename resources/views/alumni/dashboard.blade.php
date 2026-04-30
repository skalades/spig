<x-app-layout>
    <div class="pb-24 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Welcome Banner Premium -->
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-iaspig-orange/40 to-iaspig-brown/40 rounded-[3rem] blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative bg-iaspig-brown rounded-[3rem] p-8 lg:p-14 overflow-hidden shadow-2xl border border-white/10">
                    <!-- Background Decor -->
                    <div class="absolute top-0 right-0 w-full h-full pointer-events-none">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
                        <div class="absolute inset-0 bg-gradient-to-br from-iaspig-orange/20 via-transparent to-transparent"></div>
                    </div>
                    
                    <div class="relative z-10 grid lg:grid-cols-2 gap-10 items-center">
                        <div>
                            <div class="inline-flex items-center gap-3 px-5 py-2 bg-white/10 backdrop-blur-xl border border-white/10 rounded-full text-[10px] font-black text-iaspig-orange uppercase tracking-[0.3em] mb-6">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-6 w-auto">
                                <span class="w-1.5 h-1.5 bg-iaspig-orange rounded-full animate-pulse shadow-[0_0_10px_#E67E22]"></span>
                                Alumni Ecosystem
                            </div>
                            <h1 class="text-4xl lg:text-6xl font-black text-white font-outfit leading-tight mb-4">
                                Hello, <span class="text-iaspig-orange">{{ explode(' ', $user->name)[0] }}</span>!
                            </h1>
                            <p class="text-white/50 text-base lg:text-lg font-medium max-w-md leading-relaxed mb-8">
                                Pantau sebaran rekan sejawat dan perkuat jejaring profesional Anda dalam komunitas geospasial SPIG UPI.
                            </p>
                            
                            <div class="flex flex-wrap gap-4">
                                <a href="{{ route('alumni.profile.edit') }}" class="px-8 py-4 bg-iaspig-orange text-white rounded-2xl font-black shadow-lg shadow-iaspig-orange/30 hover:bg-white hover:text-iaspig-brown hover:-translate-y-1 transition-all duration-300 flex items-center gap-3">
                                    <i class="ri-user-settings-line text-xl"></i>
                                    Update Profil
                                </a>
                                <a href="#" class="px-8 py-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl font-black text-white hover:bg-white/10 transition-all flex items-center gap-3">
                                    <i class="ri-search-eye-line text-xl"></i>
                                    Cari Alumni
                                </a>
                            </div>
                        </div>
                        <div class="hidden lg:flex justify-end relative">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/5 backdrop-blur-2xl p-6 rounded-[2rem] border border-white/10 animate-float shadow-2xl">
                                    <div class="w-10 h-10 bg-iaspig-orange rounded-xl flex items-center justify-center text-white mb-4">
                                        <i class="ri-global-line text-2xl"></i>
                                    </div>
                                    <div class="text-2xl font-black text-white">{{ $stats['total_alumni'] }}</div>
                                    <div class="text-[9px] font-bold text-white/40 uppercase tracking-widest">Network</div>
                                </div>
                                <div class="bg-white/5 backdrop-blur-2xl p-6 rounded-[2rem] border border-white/10 mt-10 animate-float shadow-2xl" style="animation-delay: -2s">
                                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-iaspig-orange mb-4">
                                        <i class="ri-map-2-line text-2xl"></i>
                                    </div>
                                    <div class="text-2xl font-black text-white">{{ $stats['total_projects'] }}</div>
                                    <div class="text-[9px] font-bold text-white/40 uppercase tracking-widest">Projects</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <x-alumni.stat-card 
                    title="Total Alumni" 
                    value="{{ number_format($stats['total_alumni']) }}" 
                    icon="ri-team-line" 
                    color="iaspig-orange"
                />
                <x-alumni.stat-card 
                    title="Expertise Areas" 
                    value="{{ count($stats['expertise_dist']) }}" 
                    icon="ri-mind-map" 
                    color="blue-500"
                />
                <x-alumni.stat-card 
                    title="Project Contributions" 
                    value="{{ $stats['total_projects'] }}" 
                    icon="ri-compass-3-line" 
                    color="green-500"
                />
                <x-alumni.stat-card 
                    title="Verified Status" 
                    value="Active" 
                    icon="ri-shield-check-line" 
                    color="iaspig-brown"
                />
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Map Section -->
                <div class="lg:col-span-8">
                    <x-alumni.map-card title="Peta Sebaran Alumni" id="main-map" />
                </div>

                <!-- Sidebar Section -->
                <div class="lg:col-span-4 space-y-12">
                    @php
                        $completion = 0;
                        if($profile->current_job) $completion += 20;
                        if($profile->company) $completion += 20;
                        if($profile->bio) $completion += 20;
                        if($profile->latitude) $completion += 20;
                        if($profile->skills) $completion += 20;
                    @endphp
                    <x-alumni.profile-completion :completion="$completion" />
                    
                    <x-alumni.expertise-chart id="expertiseChart" />
                </div>
            </div>

        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    <style>
        .leaflet-container { font-family: 'Outfit', sans-serif; }
        .marker-cluster-small { background-color: rgba(230, 126, 34, 0.4); border: 2px solid rgba(230, 126, 34, 0.2); }
        .marker-cluster-small div { background-color: rgba(230, 126, 34, 1); color: white; font-weight: 900; }
        .leaflet-popup-content-wrapper { border-radius: 1.5rem; padding: 4px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .leaflet-popup-tip { background: white; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Leaflet Map Implementation with Premium Styling
            var map = L.map('main-map', {
                zoomControl: false,
                scrollWheelZoom: false
            }).setView([-2.5, 118], 5); 

            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            var markers = L.markerClusterGroup({
                showCoverageOnHover: false,
                maxClusterRadius: 50
            });

            @foreach($alumniLocations as $loc)
                var marker = L.marker([{{ $loc->latitude }}, {{ $loc->longitude }}])
                    .bindPopup(`
                        <div class="p-4 min-w-[200px]">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-10 h-10 rounded-full bg-iaspig-orange flex items-center justify-center text-white font-bold">
                                    {{ substr($loc->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-black text-iaspig-brown leading-tight">{{ $loc->user->name }}</div>
                                    <div class="text-[10px] font-bold text-iaspig-orange uppercase">{{ $loc->current_job }}</div>
                                </div>
                            </div>
                            <div class="bg-gray-50 p-2 rounded-xl border border-gray-100">
                                <div class="text-[9px] font-black text-gray-400 uppercase mb-1">Company</div>
                                <div class="text-xs font-bold text-iaspig-brown">{{ $loc->company ?? 'Freelance / Not Set' }}</div>
                            </div>
                            <a href="#" class="block w-full mt-3 py-2 bg-iaspig-brown text-white text-center text-[10px] font-black rounded-lg hover:bg-iaspig-orange transition-colors uppercase tracking-wider">View Profile</a>
                        </div>
                    `);
                markers.addLayer(marker);
            @endforeach

            map.addLayer(markers);

            // Chart.js Premium Implementation
            const ctx = document.getElementById('expertiseChart').getContext('2d');
            const expertiseData = @json($stats['expertise_dist']);
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(expertiseData),
                    datasets: [{
                        data: Object.values(expertiseData),
                        backgroundColor: [
                            '#E67E22', '#5D4037', '#3498DB', '#2ECC71', '#F1C40F', '#9B59B6', '#E74C3C', '#1ABC9C'
                        ],
                        borderWidth: 8,
                        borderColor: '#ffffff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 25,
                                font: {
                                    family: 'Outfit',
                                    size: 11,
                                    weight: 'bold'
                                },
                                color: '#5D4037'
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
