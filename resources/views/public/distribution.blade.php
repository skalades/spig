@section('title', 'Peta Sebaran Alumni - IASPIG')

<x-layout>
    <div class="py-24 bg-iaspig-cream/30 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-iaspig-orange/10 rounded-full border border-iaspig-orange/20 mb-6">
                    <span class="w-2 h-2 bg-iaspig-orange rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-iaspig-orange">Global Distribution</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-outfit font-bold text-iaspig-brown leading-tight mb-6">Peta Sebaran <span class="text-iaspig-orange">Alumni</span></h1>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                    Visualisasi persebaran alumni SPIG UPI di seluruh wilayah. Gunakan filter untuk melihat domisili, lokasi kerja, atau bisnis alumni.
                </p>
            </div>

            <!-- Map Section -->
            <div class="bg-white p-6 md:p-8 rounded-[3rem] shadow-2xl border border-white overflow-hidden" data-aos="fade-up">
                <div class="flex flex-col xl:flex-row justify-between items-start xl:items-center gap-6 mb-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-iaspig-brown/5 rounded-2xl flex items-center justify-center text-iaspig-brown shadow-inner">
                            <i class="ri-map-2-line text-3xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-iaspig-brown uppercase tracking-tight">Geo-Spatial Map</h3>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Diferensiasi Sebaran & Heatmap • Live Data</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center justify-end gap-4 w-full xl:w-auto">
                        <!-- Group 1: Map Controls & Filters -->
                        <div class="flex flex-wrap items-center gap-2 bg-gray-50 p-2 rounded-[2rem] border border-gray-100 shadow-inner">
                            <!-- Custom Industry Filter Dropdown -->
                            <div class="relative min-w-[200px] group/dropdown" id="custom-industry-dropdown">
                                <button type="button" id="dropdown-toggle" class="w-full flex items-center justify-between bg-white border border-gray-200 rounded-xl px-5 py-2.5 text-[9px] font-black text-iaspig-brown uppercase tracking-widest shadow-sm hover:border-iaspig-orange/30 transition-all focus:outline-none">
                                    <span id="selected-industry-label">Semua Bidang Bisnis</span>
                                    <div class="flex items-center gap-2">
                                        <div class="w-px h-4 bg-gray-100 mx-1"></div>
                                        <i class="ri-arrow-down-s-line text-iaspig-orange text-lg transition-transform duration-300" id="dropdown-arrow"></i>
                                    </div>
                                </button>
                                
                                <div id="dropdown-menu" class="absolute top-full left-0 w-full mt-3 bg-white/95 backdrop-blur-md border border-white shadow-2xl rounded-2xl py-3 z-[100] opacity-0 invisible translate-y-4 transition-all duration-300">
                                    <div class="max-h-[280px] overflow-y-auto px-2 custom-scrollbar">
                                        <div class="px-3 mb-2">
                                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Pilih Bidang Bisnis</p>
                                        </div>
                                        <button data-value="all" class="dropdown-item w-full text-left px-4 py-3 rounded-xl text-[9px] font-black text-iaspig-brown uppercase tracking-widest hover:bg-iaspig-orange/10 hover:text-iaspig-orange transition-all flex items-center justify-between group">
                                            <span>Semua Bidang Bisnis</span>
                                            <i class="ri-check-line opacity-0 group-[.active]:opacity-100"></i>
                                        </button>
                                        @foreach($industries as $key => $name)
                                            <button data-value="{{ $name }}" class="dropdown-item w-full text-left px-4 py-3 rounded-xl text-[9px] font-black text-iaspig-brown uppercase tracking-widest hover:bg-iaspig-orange/10 hover:text-iaspig-orange transition-all flex items-center justify-between group">
                                                <span>{{ $name }}</span>
                                                <i class="ri-check-line opacity-0 group-[.active]:opacity-100"></i>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" id="industry-filter" value="all">
                            </div>

                            <div class="h-6 w-px bg-gray-200 mx-1 hidden md:block"></div>

                            <!-- Basemap Selector -->
                            <div class="flex items-center gap-1 bg-white/50 p-1 rounded-xl">
                                <button id="btn-light" class="px-4 py-2 bg-white shadow-sm border border-gray-200 rounded-lg text-[9px] font-black text-iaspig-orange uppercase tracking-widest transition-all">Light</button>
                                <button id="btn-osm" class="px-4 py-2 rounded-lg text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all hover:text-iaspig-orange">OSM</button>
                                <button id="btn-sat" class="px-4 py-2 rounded-lg text-[9px] font-black text-gray-400 uppercase tracking-widest transition-all hover:text-iaspig-orange">Satelit</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div id="public-map" class="h-[650px] rounded-[2.5rem] border-4 border-gray-50 shadow-inner z-0"></div>
                    
                    <!-- Legend Overlay -->
                    <div id="legend-container" class="absolute top-8 left-8 z-[40] transition-all duration-500 opacity-100 transform translate-x-0">
                        <div class="bg-white/90 backdrop-blur-md p-6 rounded-[2rem] border border-white shadow-xl space-y-4">
                            <div class="flex justify-between items-center border-b border-gray-100 pb-2 mb-2">
                                <h4 class="text-[10px] font-black text-iaspig-brown uppercase tracking-[0.2em]">Legenda Peta</h4>
                                <button id="close-legend" class="text-gray-400 hover:text-iaspig-orange"><i class="ri-close-line"></i></button>
                            </div>
                            
                            <div class="space-y-2">
                                <button onclick="toggleType('Domisili')" id="leg-domisili" class="w-full flex items-center justify-between p-2 rounded-xl hover:bg-gray-50 transition-all group active-filter">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-iaspig-orange border-2 border-white shadow-sm"></div>
                                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-iaspig-brown">Alumni (Domisili)</span>
                                    </div>
                                    <i class="ri-checkbox-circle-fill text-iaspig-orange opacity-100 transition-opacity check-icon"></i>
                                </button>
                                
                                <button onclick="toggleType('Lokasi Kerja')" id="leg-kerja" class="w-full flex items-center justify-between p-2 rounded-xl hover:bg-gray-50 transition-all group active-filter">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-blue-500 border-2 border-white shadow-sm"></div>
                                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-iaspig-brown">Alumni (Lokasi Kerja)</span>
                                    </div>
                                    <i class="ri-checkbox-circle-fill text-blue-500 opacity-100 transition-opacity check-icon"></i>
                                </button>
                                
                                <button onclick="toggleType('Bisnis')" id="leg-bisnis" class="w-full flex items-center justify-between p-2 rounded-xl hover:bg-gray-50 transition-all group active-filter">
                                    <div class="flex items-center gap-3">
                                        <div class="w-3 h-3 rounded-full bg-iaspig-brown border-2 border-white shadow-sm"></div>
                                        <span class="text-[11px] font-bold text-gray-600 group-hover:text-iaspig-brown">Bisnis Alumni</span>
                                    </div>
                                    <i class="ri-checkbox-circle-fill text-iaspig-brown opacity-100 transition-opacity check-icon"></i>
                                </button>
                            </div>
                            <div class="pt-2 text-center">
                                <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest italic">*Klik item untuk sembunyikan/tampilkan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Zoom Controls -->
                    <div class="absolute bottom-8 left-8 z-[40] flex flex-col gap-3">
                        <button id="zoom-in" class="w-12 h-12 bg-white/90 backdrop-blur-sm shadow-xl rounded-2xl flex items-center justify-center text-iaspig-brown hover:bg-iaspig-orange hover:text-white transition-all transform hover:scale-110 border border-white">
                            <i class="ri-add-line text-2xl"></i>
                        </button>
                        <button id="zoom-out" class="w-12 h-12 bg-white/90 backdrop-blur-sm shadow-xl rounded-2xl flex items-center justify-center text-iaspig-brown hover:bg-iaspig-orange hover:text-white transition-all transform hover:scale-110 border border-white">
                            <i class="ri-subtract-line text-2xl"></i>
                        </button>
                    </div>

                    <!-- Floating Visualization Modes (Bottom Center) -->
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-[40] flex items-center gap-3 bg-white/80 backdrop-blur-md p-2 rounded-[2rem] border border-white shadow-2xl">
                        <div class="flex items-center gap-1 bg-gray-50/50 p-1 rounded-xl border border-gray-100">
                            <button id="show-markers" class="px-6 py-2 bg-iaspig-orange text-white shadow-md rounded-lg text-[10px] font-black uppercase tracking-widest transition-all transform active:scale-95">
                                Marker
                            </button>
                            <button id="show-heatmap" class="px-6 py-2 rounded-lg text-[10px] font-black text-gray-400 uppercase tracking-widest transition-all hover:text-iaspig-orange">
                                Heatmap
                            </button>
                        </div>
                        
                        <div class="w-px h-6 bg-gray-200 mx-1"></div>

                        <button id="toggle-legend" class="flex items-center gap-2 h-10 px-5 bg-white border border-gray-200 rounded-xl shadow-sm text-gray-400 hover:text-iaspig-orange hover:border-iaspig-orange/30 transition-all group" title="Toggle Legenda">
                            <i class="ri-information-line text-xl"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest hidden sm:block">Legenda</span>
                        </button>
                    </div>
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
        .leaflet-popup-content-wrapper { border-radius: 1.5rem; padding: 0; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .leaflet-popup-tip { background: white; }
        
        /* Custom Marker Styles */
        .alumni-marker-icon, .company-marker-icon { 
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #E67E22; border-radius: 10px; }
        
        #dropdown-menu.show {
            opacity: 1;
            visible: visible;
            transform: translateY(0);
        }
        
        .dropdown-item.active {
            background-color: rgba(230, 126, 34, 0.1);
            color: #E67E22;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script src="https://unpkg.com/leaflet.heat/dist/leaflet-heat.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Basemaps
            var cartoLight = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; CartoDB'
            });
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            });
            var esriSat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '&copy; Esri'
            });

            var map = L.map('public-map', {
                zoomControl: false,
                scrollWheelZoom: true,
                layers: [cartoLight]
            }).setView([-2.5, 118], 5);

            // Basemap Control Logic
            const btnLight = document.getElementById('btn-light');
            const btnOsm = document.getElementById('btn-osm');
            const btnSat = document.getElementById('btn-sat');

            function resetBasemapBtns() {
                [btnLight, btnOsm, btnSat].forEach(b => {
                    b.classList.remove('bg-white', 'shadow-sm', 'border', 'border-gray-200', 'text-iaspig-orange');
                    b.classList.add('text-gray-400');
                });
            }

            btnLight.onclick = function() {
                map.removeLayer(osm); map.removeLayer(esriSat); map.addLayer(cartoLight);
                resetBasemapBtns(); this.classList.add('bg-white', 'shadow-sm', 'border', 'border-gray-200', 'text-iaspig-orange');
                this.classList.remove('text-gray-400');
            };
            btnOsm.onclick = function() {
                map.removeLayer(cartoLight); map.removeLayer(esriSat); map.addLayer(osm);
                resetBasemapBtns(); this.classList.add('bg-white', 'shadow-sm', 'border', 'border-gray-200', 'text-iaspig-orange');
                this.classList.remove('text-gray-400');
            };
            btnSat.onclick = function() {
                map.removeLayer(cartoLight); map.removeLayer(osm); map.addLayer(esriSat);
                resetBasemapBtns(); this.classList.add('bg-white', 'shadow-sm', 'border', 'border-gray-200', 'text-iaspig-orange');
                this.classList.remove('text-gray-400');
            };

            // Zoom Controls
            document.getElementById('zoom-in').onclick = function() { map.zoomIn(); };
            document.getElementById('zoom-out').onclick = function() { map.zoomOut(); };

            // Legend Toggle Logic
            const legend = document.getElementById('legend-container');
            const toggleBtn = document.getElementById('toggle-legend');
            const closeBtn = document.getElementById('close-legend');

            window.toggleLegend = function() {
                legend.classList.toggle('opacity-0');
                legend.classList.toggle('translate-x-[-120%]');
                legend.classList.toggle('pointer-events-none');
                toggleBtn.classList.toggle('text-iaspig-orange');
                toggleBtn.classList.toggle('border-iaspig-orange/30');
                toggleBtn.classList.toggle('bg-white');
            };

            toggleBtn.addEventListener('click', window.toggleLegend);
            closeBtn.addEventListener('click', window.toggleLegend);

            var markers = L.markerClusterGroup({
                showCoverageOnHover: false,
                maxClusterRadius: 50
            });

            var heatLayer = L.heatLayer([], {
                radius: 25, blur: 15, maxZoom: 10,
                gradient: {0.4: '#E67E22', 0.65: '#D35400', 1: '#5D4037'}
            });

            const btnMarkers = document.getElementById('show-markers');
            const btnHeatmap = document.getElementById('show-heatmap');
            
            // Custom Dropdown Logic
            const dropdownToggle = document.getElementById('dropdown-toggle');
            const dropdownMenu = document.getElementById('dropdown-menu');
            const dropdownArrow = document.getElementById('dropdown-arrow');
            const label = document.getElementById('selected-industry-label');
            const hiddenInput = document.getElementById('industry-filter');
            const items = document.querySelectorAll('.dropdown-item');

            dropdownToggle.onclick = function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('opacity-0');
                dropdownMenu.classList.toggle('invisible');
                dropdownMenu.classList.toggle('translate-y-4');
                dropdownMenu.classList.toggle('translate-y-0');
                dropdownArrow.classList.toggle('rotate-180');
            };

            items.forEach(item => {
                item.onclick = function() {
                    const value = this.getAttribute('data-value');
                    const text = this.querySelector('span').innerText;
                    
                    label.innerText = text;
                    hiddenInput.value = value;
                    
                    items.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    dropdownMenu.classList.add('opacity-0', 'invisible', 'translate-y-4');
                    dropdownMenu.classList.remove('translate-y-0');
                    dropdownArrow.classList.remove('rotate-180');
                    
                    renderMarkers(value);
                };
            });

            document.addEventListener('click', function() {
                dropdownMenu.classList.add('opacity-0', 'invisible', 'translate-y-4');
                dropdownMenu.classList.remove('translate-y-0');
                dropdownArrow.classList.remove('rotate-180');
            });

            var rawData = [];
            var activeTypes = {
                'Domisili': true,
                'Lokasi Kerja': true,
                'Bisnis': true
            };

            window.toggleType = function(type) {
                activeTypes[type] = !activeTypes[type];
                
                // Update UI
                const btnId = type === 'Domisili' ? 'leg-domisili' : (type === 'Lokasi Kerja' ? 'leg-kerja' : 'leg-bisnis');
                const btn = document.getElementById(btnId);
                const icon = btn.querySelector('.check-icon');
                
                if (activeTypes[type]) {
                    btn.classList.add('active-filter');
                    icon.classList.remove('opacity-0');
                    icon.classList.add('opacity-100');
                } else {
                    btn.classList.remove('active-filter');
                    icon.classList.remove('opacity-100');
                    icon.classList.add('opacity-0');
                }
                
                renderMarkers(hiddenInput.value);
            };

            function renderMarkers(filterValue = 'all') {
                markers.clearLayers();
                var heatPoints = [];

                rawData.forEach(loc => {
                    // Type Toggle Filter
                    var locType = loc.is_company ? 'Bisnis' : loc.type;
                    if (!activeTypes[locType]) return;

                    // Industry Filter Logic (Only for Companies)
                    if (filterValue !== 'all' && loc.is_company && loc.industry_type !== filterValue) {
                        return;
                    }

                    var currentIcon = domisiliIcon;
                    var bgColor = 'bg-iaspig-orange';
                    
                    if (loc.is_company) {
                        currentIcon = companyIcon;
                        bgColor = 'bg-iaspig-brown';
                    } else if (loc.type === 'Lokasi Kerja') {
                        currentIcon = kerjaIcon;
                        bgColor = 'bg-blue-500';
                    }

                    var popupContent = `
                        <div class="w-[240px]">
                            <div class="${bgColor} p-4 text-white">
                                <div class="text-[10px] font-black uppercase tracking-widest text-white/70 mb-1">${loc.type}</div>
                                <div class="font-bold text-base leading-tight">${loc.name}</div>
                            </div>
                            <div class="p-4 bg-white">
                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center gap-3">
                                        <i class="ri-briefcase-line text-iaspig-orange"></i>
                                        <div class="text-xs font-bold text-gray-600">${loc.current_job}</div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <i class="ri-building-line text-iaspig-orange"></i>
                                        <div class="text-xs font-bold text-gray-600">${loc.company}</div>
                                    </div>
                                </div>
                                ${loc.is_public ? `
                                    <div class="p-3 bg-blue-50 rounded-xl border border-blue-100 mb-3">
                                        <div class="flex items-center gap-2 text-blue-600 mb-1">
                                            <i class="ri-information-line"></i>
                                            <span class="text-[9px] font-black uppercase tracking-widest">Informasi Terbatas</span>
                                        </div>
                                        <p class="text-[10px] text-blue-800 leading-snug font-medium">Masuk sebagai alumni untuk melihat profil lengkap.</p>
                                    </div>
                                    <a href="{{ route('login') }}" class="block w-full py-2.5 bg-iaspig-brown text-white text-center text-[10px] font-black rounded-xl hover:bg-iaspig-orange transition-all uppercase tracking-widest">Log In Sekarang</a>
                                ` : `
                                    <a href="${loc.is_company ? `/directory/${loc.slug}` : `/alumni/directory/${loc.id}`}" class="block w-full py-2.5 bg-iaspig-orange text-white text-center text-[10px] font-black rounded-xl hover:bg-iaspig-brown transition-all uppercase tracking-widest">Lihat Detail</a>
                                `}
                            </div>
                        </div>
                    `;

                    var marker = L.marker([loc.latitude, loc.longitude], { icon: currentIcon })
                        .bindPopup(popupContent);
                    
                    markers.addLayer(marker);
                    heatPoints.push([loc.latitude, loc.longitude, 1]);
                });

                heatLayer.setLatLngs(heatPoints);
                if (!map.hasLayer(heatLayer)) map.addLayer(markers);
            }

            // industryFilter behavior replaced by custom dropdown logic above


            btnMarkers.onclick = function() {
                map.removeLayer(heatLayer); map.addLayer(markers);
                this.classList.add('bg-iaspig-orange', 'text-white', 'shadow-md');
                this.classList.remove('text-gray-400');
                btnHeatmap.classList.remove('bg-iaspig-orange', 'text-white', 'shadow-md');
                btnHeatmap.classList.add('text-gray-400');
            };

            btnHeatmap.onclick = function() {
                map.removeLayer(markers); map.addLayer(heatLayer);
                this.classList.add('bg-iaspig-orange', 'text-white', 'shadow-md');
                this.classList.remove('text-gray-400');
                btnMarkers.classList.remove('bg-iaspig-orange', 'text-white', 'shadow-md');
                btnMarkers.classList.add('text-gray-400');
            };

            // Custom Icons
            function createIcon(color, iconType) {
                let iconClass = 'ri-user-3-line';
                if(iconType === 'work') iconClass = 'ri-briefcase-line';
                if(iconType === 'company') iconClass = 'ri-building-2-line';

                return L.divIcon({
                    html: `<div class="relative flex items-center justify-center">
                            <svg width="34" height="44" viewBox="0 0 32 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 0C7.16344 0 0 7.16344 0 16C0 28 16 42 16 42C16 42 32 28 32 16C32 7.16344 24.8366 0 16 0Z" fill="${color}"/>
                                <circle cx="16" cy="16" r="7" fill="white"/>
                            </svg>
                            <i class="${iconClass} absolute text-[9px]" style="color: ${color}; top: 11px;"></i>
                           </div>`,
                    className: 'alumni-marker-icon',
                    iconSize: [34, 44],
                    iconAnchor: [17, 44],
                    popupAnchor: [0, -40]
                });
            }

            const domisiliIcon = createIcon('#E67E22', 'home');
            const kerjaIcon = createIcon('#3B82F6', 'work');
            const companyIcon = createIcon('#5D4037', 'company');

            fetch('{{ route('public.map-data') }}')
                .then(response => response.json())
                .then(data => {
                    rawData = data;
                    renderMarkers();
                });
        });
    </script>
    @endpush
</x-layout>
