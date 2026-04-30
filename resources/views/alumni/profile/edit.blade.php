<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header Section -->
            <div class="bg-gradient-orange-brown p-8 rounded-[2rem] shadow-xl text-white relative overflow-hidden">
                <div class="topo-pattern opacity-10"></div>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h2 class="text-3xl font-bold font-outfit uppercase tracking-tight">Lengkapi Profil Profesional</h2>
                        <p class="text-white/80 mt-2 font-medium">Data Anda membantu kami membangun peta jaringan alumni yang akurat dan kuat.</p>
                    </div>
                    <a href="{{ route('alumni.dashboard') }}" class="px-6 py-3 bg-white/20 backdrop-blur-md border border-white/30 rounded-full font-bold hover:bg-white/30 transition-all">
                        <i class="ri-arrow-left-line mr-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left: Personal & Professional -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- Professional Info -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-briefcase-4-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Informasi Profesional</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <x-input-label for="current_job" :value="__('Pekerjaan Saat Ini')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="current_job" name="current_job" type="text" class="block w-full" :value="old('current_job', $profile->current_job)" placeholder="Contoh: Senior GIS Specialist" />
                                    <x-input-error :messages="$errors->get('current_job')" />
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="company" :value="__('Instansi / Perusahaan')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="company" name="company" type="text" class="block w-full" :value="old('company', $profile->company)" placeholder="Contoh: Badan Informasi Geospasial" />
                                    <x-input-error :messages="$errors->get('company')" />
                                </div>

                                <div class="md:col-span-2 space-y-2">
                                    <x-input-label for="bio" :value="__('Bio Singkat')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <textarea id="bio" name="bio" rows="4" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm transition-all">{{ old('bio', $profile->bio) }}</textarea>
                                    <x-input-error :messages="$errors->get('bio')" />
                                </div>
                            </div>
                        </div>

                        <!-- Location Pinning -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-map-pin-user-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Pin Lokasi Domisili</h3>
                            </div>
                            <p class="text-gray-500 text-sm mb-6">Tentukan lokasi Anda pada peta untuk muncul di direktori sebaran alumni.</p>

                            <div id="location-picker" class="h-96 rounded-2xl border-2 border-gray-100 overflow-hidden mb-6 z-0"></div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <x-input-label for="latitude" :value="__('Latitude')" class="text-xs font-bold text-gray-400" />
                                    <x-text-input id="latitude" name="latitude" type="text" class="block w-full bg-gray-50" :value="old('latitude', $profile->latitude)" readonly />
                                </div>
                                <div class="space-y-2">
                                    <x-input-label for="longitude" :value="__('Longitude')" class="text-xs font-bold text-gray-400" />
                                    <x-text-input id="longitude" name="longitude" type="text" class="block w-full bg-gray-50" :value="old('longitude', $profile->longitude)" readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Avatar & Skills -->
                    <div class="space-y-8">
                        
                        <!-- Profile Photo -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100 text-center">
                            <div class="mb-6 relative inline-block">
                                <div class="w-32 h-32 rounded-full border-4 border-iaspig-orange/20 overflow-hidden mx-auto bg-gray-100">
                                    @if($profile->avatar)
                                        <img src="{{ asset('storage/' . $profile->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i class="ri-user-line text-5xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <label for="avatar" class="absolute bottom-0 right-0 w-10 h-10 bg-iaspig-orange text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:bg-iaspig-brown transition-colors">
                                    <i class="ri-camera-line"></i>
                                    <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*">
                                </label>
                            </div>
                            <h4 class="font-bold text-iaspig-brown uppercase text-sm tracking-widest">Foto Profil</h4>
                            <p class="text-gray-400 text-xs mt-2">JPG, PNG (Maks 2MB)</p>
                        </div>

                        <!-- Expertise & Availability -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-star-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Keahlian & Status</h3>
                            </div>

                            <div class="space-y-6">
                                <div class="space-y-3">
                                    <x-input-label :value="__('Keahlian Khusus')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach(['GIS', 'Remote Sensing', 'Lidar', 'Drone Survey', 'Land Survey', 'Hydrography', 'Photogrammetry', 'BIM'] as $skill)
                                            <label class="flex items-center gap-2 p-3 border border-gray-100 rounded-xl hover:bg-iaspig-orange/5 cursor-pointer transition-all">
                                                <input type="checkbox" name="skills[]" value="{{ $skill }}" 
                                                    class="rounded text-iaspig-orange focus:ring-iaspig-orange border-gray-200"
                                                    {{ is_array(old('skills', $profile->skills)) && in_array($skill, old('skills', $profile->skills)) ? 'checked' : '' }}>
                                                <span class="text-sm font-medium text-gray-600">{{ $skill }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="border-gray-100">

                                <div class="p-4 bg-iaspig-orange/5 rounded-2xl border border-iaspig-orange/10">
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="availability_status" value="1" 
                                            class="w-6 h-6 rounded-md text-iaspig-orange focus:ring-iaspig-orange border-iaspig-orange/30"
                                            {{ old('availability_status', $profile->availability_status) ? 'checked' : '' }}>
                                        <div>
                                            <span class="block text-sm font-bold text-iaspig-brown uppercase">Open for Collaboration</span>
                                            <span class="text-xs text-gray-500">Aktifkan jika Anda terbuka untuk kerja sama profesional.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="bg-white p-6 rounded-[2rem] shadow-lg border border-gray-100 flex justify-end gap-4 sticky bottom-6 z-10">
                    <x-primary-button class="px-12 py-4">
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Leaflet Integration -->
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var defaultLat = {{ $profile->latitude ?? -6.8614 }};
            var defaultLng = {{ $profile->longitude ?? 107.5946 }};
            
            var map = L.map('location-picker').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            function updateInputs(lat, lng) {
                document.getElementById('latitude').value = lat.toFixed(8);
                document.getElementById('longitude').value = lng.toFixed(8);
            }

            marker.on('dragend', function(e) {
                var pos = e.target.getLatLng();
                updateInputs(pos.lat, pos.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInputs(e.latlng.lat, e.latlng.lng);
            });
        });
    </script>
    @endpush
</x-app-layout>
