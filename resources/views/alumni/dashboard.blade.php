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
                                <a href="{{ route('alumni.directory') }}" class="px-8 py-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl font-black text-white hover:bg-white/10 transition-all flex items-center gap-3">
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
                    value="{{ number_format($stats['total_alumni'], 0, ',', '.') }}" 
                    icon="ri-team-line" 
                    color="iaspig-orange"
                />
                <x-alumni.stat-card 
                    title="Expertise Areas" 
                    value="{{ count($stats['expertise_dist']) }}" 
                    icon="ri-mind-map" 
                    color="iaspig-brown"
                />
                <x-alumni.stat-card 
                    title="Project Contributions" 
                    value="{{ $stats['total_projects'] }}" 
                    icon="ri-compass-3-line" 
                    color="iaspig-orange"
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

                    <!-- Business Management Section -->
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gray-50 relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 text-iaspig-brown/5 group-hover:scale-110 transition-transform duration-500">
                            <i class="ri-building-4-line text-[120px]"></i>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-xl font-black text-iaspig-brown mb-2 uppercase tracking-tight">Business Hub</h3>
                            @if($user->companies->count() > 0)
                                <p class="text-gray-400 text-xs font-bold mb-6">Kelola perusahaan Anda dan pantau inventaris rental.</p>
                                <div class="space-y-3">
                                    @foreach($user->companies as $company)
                                        <a href="{{ route('alumni.business.manage') }}" class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl hover:bg-iaspig-orange/10 hover:text-iaspig-orange transition-all border border-transparent hover:border-iaspig-orange/20">
                                            <div class="flex items-center gap-3">
                                                <i class="ri-settings-4-line text-lg"></i>
                                                <span class="font-black text-sm">{{ $company->name }}</span>
                                            </div>
                                            <i class="ri-arrow-right-s-line"></i>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-400 text-xs font-bold mb-6">Punya perusahaan atau jasa? Daftarkan di direktori alumni sekarang.</p>
                                <a href="{{ route('alumni.business.register') }}" class="w-full py-4 bg-iaspig-brown text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-iaspig-orange transition-all flex items-center justify-center gap-3 shadow-lg shadow-iaspig-brown/20">
                                    <i class="ri-add-circle-line text-lg"></i> Register My Business
                                </a>
                            @endif
                        </div>
                    </div>
                    
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
    <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Leaflet Map Implementation with Premium Styling
            // Basemap Layers
            var cartoLight = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; OpenStreetMap'
            });

            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            });

            var esriSatelite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri'
            });

            // Initialize Map
            var map = L.map('main-map', {
                zoomControl: false,
                scrollWheelZoom: false,
                layers: [cartoLight] // Default layer
            }).setView([-2.5, 118], 5); 

            // Layer Control
            var baseMaps = {
                "Clean Minimal (Carto)": cartoLight,
                "OpenStreetMap": osm,
                "Satelit (Esri)": esriSatelite
            };

            L.control.layers(baseMaps).addTo(map);

            // Custom Zoom Controls Implementation
            document.getElementById('zoom-in').onclick = function() {
                map.zoomIn();
            };
            document.getElementById('zoom-out').onclick = function() {
                map.zoomOut();
            };

            var alumniMarkers = L.markerClusterGroup({
                showCoverageOnHover: false,
                maxClusterRadius: 50
            });

            var companyMarkers = L.markerClusterGroup({
                showCoverageOnHover: false,
                maxClusterRadius: 50
            });

            var heatLayer = L.heatLayer([], {
                radius: 25,
                blur: 15,
                maxZoom: 10,
                gradient: {0.4: '#E67E22', 0.65: '#D35400', 1: '#5D4037'}
            });

            // Layer Toggle Implementation
            const btnMarkers = document.getElementById('show-markers');
            const btnCompanies = document.getElementById('show-companies');
            const btnHeatmap = document.getElementById('show-heatmap');

            function resetButtons() {
                [btnMarkers, btnCompanies, btnHeatmap].forEach(btn => {
                    btn.classList.remove('bg-white', 'shadow-sm', 'text-iaspig-orange');
                    btn.classList.add('text-gray-400');
                });
            }

            function setActive(btn) {
                resetButtons();
                btn.classList.add('bg-white', 'shadow-sm', 'text-iaspig-orange');
                btn.classList.remove('text-gray-400');
            }

            btnMarkers.onclick = function() {
                map.removeLayer(heatLayer);
                map.removeLayer(companyMarkers);
                map.addLayer(alumniMarkers);
                setActive(this);
            };

            btnCompanies.onclick = function() {
                map.removeLayer(heatLayer);
                map.removeLayer(alumniMarkers);
                map.addLayer(companyMarkers);
                setActive(this);
            };

            btnHeatmap.onclick = function() {
                map.removeLayer(alumniMarkers);
                map.removeLayer(companyMarkers);
                map.addLayer(heatLayer);
                setActive(this);
            };

            // Custom Brand Marker Icon
            var brandIcon = L.divIcon({
                html: `<svg width="32" height="42" viewBox="0 0 32 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 0C7.16344 0 0 7.16344 0 16C0 28 16 42 16 42C16 42 32 28 32 16C32 7.16344 24.8366 0 16 0Z" fill="#E67E22"/>
                        <circle cx="16" cy="16" r="6" fill="white"/>
                      </svg>`,
                className: 'brand-marker-icon',
                iconSize: [32, 42],
                iconAnchor: [16, 42],
                popupAnchor: [0, -40]
            });

            // Fetch map data via AJAX for scalability
            fetch('{{ route('alumni.map-data') }}')
                .then(response => response.json())
                .then(data => {
                    var heatPoints = [];
                    data.forEach(loc => {
                        var initialName = loc.name ? loc.name.substring(0, 1) : '?';
                        var userName = loc.name ? loc.name : 'Unknown';
                        var company = loc.company ? loc.company : 'Freelance / Not Set';
                        var currentJob = loc.current_job ? loc.current_job : 'Alumni';
                        var isCompany = loc.type === 'Perusahaan';

                        // Use different icon for company
                        var currentIcon = brandIcon;
                        var bgColor = isCompany ? 'bg-iaspig-brown' : 'bg-iaspig-orange';
                        var textColor = isCompany ? 'text-white' : 'text-iaspig-brown';
                        var linkUrl = isCompany ? `/alumni/business/${loc.slug}` : `/alumni/directory/${loc.user_id}`;

                        if (isCompany) {
                            currentIcon = L.divIcon({
                                html: `<svg width="32" height="42" viewBox="0 0 32 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 0C7.16344 0 0 7.16344 0 16C0 28 16 42 16 42C16 42 32 28 32 16C32 7.16344 24.8366 0 16 0Z" fill="#5D4037"/>
                                        <circle cx="16" cy="16" r="6" fill="#E67E22"/>
                                      </svg>`,
                                className: 'brand-marker-icon company-marker',
                                iconSize: [32, 42],
                                iconAnchor: [16, 42],
                                popupAnchor: [0, -40]
                            });
                        }
                        
                        var marker = L.marker([loc.latitude, loc.longitude], { icon: currentIcon })
                            .bindPopup(`
                                <div class="p-4 min-w-[200px]">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-10 h-10 rounded-full ${bgColor} flex items-center justify-center text-white font-bold">
                                            ${initialName}
                                        </div>
                                        <div>
                                            <div class="font-black ${textColor} leading-tight">${userName}</div>
                                            <div class="text-[10px] font-bold text-iaspig-orange uppercase">${currentJob}</div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded-xl border border-gray-100">
                                        <div class="text-[9px] font-black text-gray-400 uppercase mb-1">${isCompany ? 'Verified Business' : 'Company'}</div>
                                        <div class="text-xs font-bold text-iaspig-brown">${company}</div>
                                    </div>
                                    <a href="${linkUrl}" class="block w-full mt-3 py-2 bg-iaspig-brown !text-white text-center text-[10px] font-black rounded-lg hover:bg-iaspig-orange transition-colors uppercase tracking-wider">View Profile</a>
                                </div>
                            `);
                        
                        if (isCompany) {
                            companyMarkers.addLayer(marker);
                        } else {
                            alumniMarkers.addLayer(marker);
                        }
                        
                        heatPoints.push([loc.latitude, loc.longitude, 1]); // Lat, Lng, Intensity
                    });
                    
                    heatLayer.setLatLngs(heatPoints);
                    map.addLayer(alumniMarkers); // Default show alumni
                    map.addLayer(companyMarkers); // Default show companies too if you want overlay
                })
                .catch(error => console.error('Error loading map data:', error));

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
                            '#E67E22', '#5D4037', '#FFB347', '#D35400', '#A04000', '#873600', '#6E2C00'
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
