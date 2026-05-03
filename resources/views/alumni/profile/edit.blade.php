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

            <!-- Success Notification -->
            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 transform translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 transform translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-init="setTimeout(() => show = false, 4000)" 
                     class="fixed top-24 right-8 z-50 bg-white border-l-4 border-iaspig-orange p-4 rounded-xl shadow-2xl flex items-start gap-4 max-w-sm">
                    <div class="bg-iaspig-orange/10 text-iaspig-orange rounded-full p-2">
                        <i class="ri-checkbox-circle-fill text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-iaspig-brown font-outfit">Berhasil Disimpan!</h3>
                        <p class="text-sm text-gray-500 mt-1">Perubahan profil Anda telah berhasil diperbarui.</p>
                    </div>
                    <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <i class="ri-close-line text-xl"></i>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('alumni.profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left: Profile Data (Col Span 2) -->
                    <div class="lg:col-span-2 space-y-8">
                        
                        <!-- 1. Informasi Dasar & Kontak -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-profile-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Informasi Dasar & Kontak</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2 md:col-span-2">
                                    <x-input-label for="name" :value="__('Nama Lengkap (Sesuai Ijazah)')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" 
                                        oninput="this.value = this.value.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')" />
                                    <x-input-error :messages="$errors->get('name')" />
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="nim" :value="__('NIM')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="nim" name="nim" type="text" class="block w-full" :value="old('nim', $profile->nim)" placeholder="Contoh: 180XXXX" />
                                    <x-input-error :messages="$errors->get('nim')" />
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="angkatan" :value="__('Tahun Angkatan')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <select id="angkatan" name="angkatan" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm">
                                        <option value="">Pilih Angkatan</option>
                                        @for($year = date('Y'); $year >= 2000; $year--)
                                            <option value="{{ $year }}" {{ old('angkatan', $profile->angkatan) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <x-input-error :messages="$errors->get('angkatan')" />
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="whatsapp" :value="__('No. WhatsApp')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="whatsapp" name="whatsapp" type="text" class="block w-full" :value="old('whatsapp', $profile->whatsapp)" placeholder="08123456789" />
                                    <x-input-error :messages="$errors->get('whatsapp')" />
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="linkedin" :value="__('URL LinkedIn')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="linkedin" name="linkedin" type="url" class="block w-full" :value="old('linkedin', $profile->linkedin)" placeholder="https://linkedin.com/in/..." />
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <x-input-label for="bio" :value="__('Bio Singkat')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <textarea id="bio" name="bio" rows="3" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm transition-all">{{ old('bio', $profile->bio) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Tracer Study / Keterserapan -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-pie-chart-2-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Tracer Study & Keterserapan</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <x-input-label for="kategori_keterserapan" :value="__('Kategori')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <select id="kategori_keterserapan" name="kategori_keterserapan" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Bekerja (Full-time)" {{ old('kategori_keterserapan', $profile->kategori_keterserapan) == 'Bekerja (Full-time)' ? 'selected' : '' }}>Bekerja (Full-time)</option>
                                        <option value="Bekerja (Freelance/Kontrak)" {{ old('kategori_keterserapan', $profile->kategori_keterserapan) == 'Bekerja (Freelance/Kontrak)' ? 'selected' : '' }}>Bekerja (Freelance/Kontrak)</option>
                                        <option value="Wirausaha / Memiliki Usaha" {{ old('kategori_keterserapan', $profile->kategori_keterserapan) == 'Wirausaha / Memiliki Usaha' ? 'selected' : '' }}>Wirausaha / Memiliki Usaha</option>
                                        <option value="Studi Lanjut (S1/S2/S3)" {{ old('kategori_keterserapan', $profile->kategori_keterserapan) == 'Studi Lanjut (S1/S2/S3)' ? 'selected' : '' }}>Studi Lanjut (S1/S2/S3)</option>
                                        <option value="Belum Bekerja" {{ old('kategori_keterserapan', $profile->kategori_keterserapan) == 'Belum Bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="sektor" :value="__('Sektor Instansi')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <select id="sektor" name="sektor" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm">
                                        <option value="">Pilih Sektor</option>
                                        <option value="Instansi Pemerintah / Kementerian" {{ old('sektor', $profile->sektor) == 'Instansi Pemerintah / Kementerian' ? 'selected' : '' }}>Instansi Pemerintah / Kementerian</option>
                                        <option value="BUMN / BUMD" {{ old('sektor', $profile->sektor) == 'BUMN / BUMD' ? 'selected' : '' }}>BUMN / BUMD</option>
                                        <option value="Perusahaan Swasta" {{ old('sektor', $profile->sektor) == 'Perusahaan Swasta' ? 'selected' : '' }}>Perusahaan Swasta</option>
                                        <option value="NGO / Organisasi Non-Profit" {{ old('sektor', $profile->sektor) == 'NGO / Organisasi Non-Profit' ? 'selected' : '' }}>NGO / Organisasi Non-Profit</option>
                                        <option value="Institusi Pendidikan / Akademik" {{ old('sektor', $profile->sektor) == 'Institusi Pendidikan / Akademik' ? 'selected' : '' }}>Institusi Pendidikan / Akademik</option>
                                        <option value="Lainnya" {{ old('sektor', $profile->sektor) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="cakupan_keterserapan" :value="__('Cakupan Wilayah')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <select id="cakupan_keterserapan" name="cakupan_keterserapan" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm">
                                        <option value="">Pilih Cakupan</option>
                                        <option value="Lokal (Tingkat Kota/Provinsi)" {{ old('cakupan_keterserapan', $profile->cakupan_keterserapan) == 'Lokal (Tingkat Kota/Provinsi)' ? 'selected' : '' }}>Lokal (Tingkat Kota/Provinsi)</option>
                                        <option value="Nasional" {{ old('cakupan_keterserapan', $profile->cakupan_keterserapan) == 'Nasional' ? 'selected' : '' }}>Nasional</option>
                                        <option value="Multinasional / Internasional" {{ old('cakupan_keterserapan', $profile->cakupan_keterserapan) == 'Multinasional / Internasional' ? 'selected' : '' }}>Multinasional / Internasional</option>
                                    </select>
                                </div>

                                </div>
                            </div>
                        </div>

                        <!-- 3. Pekerjaan Saat Ini & Atasan -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-building-4-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Pekerjaan Saat Ini</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="space-y-2">
                                    <x-input-label for="current_job" :value="__('Jabatan Saat Ini')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="current_job" name="current_job" type="text" class="block w-full" :value="old('current_job', $profile->current_job)" placeholder="Senior GIS Specialist" />
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="company" :value="__('Nama Instansi / Perusahaan')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <x-text-input id="company" name="company" type="text" class="block w-full" :value="old('company', $profile->company)" placeholder="Badan Informasi Geospasial" />
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <x-input-label for="address" :value="__('Alamat Instansi / Perusahaan')" class="text-xs font-bold uppercase tracking-widest text-gray-400" />
                                    <textarea id="address" name="address" rows="2" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm transition-all">{{ old('address', $profile->address) }}</textarea>
                                </div>
                            </div>

                            </div>
                        </div>

                        <!-- 4. Riwayat Pekerjaan & Career Map (Alpine Linked) -->
                        <div x-data="careerMapManager()" class="space-y-8">
                            
                            <!-- Daftar Riwayat -->
                            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                            <i class="ri-history-line text-xl"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Riwayat Perjalanan Karir</h3>
                                    </div>
                                    <button type="button" @click="addJob()" class="px-4 py-2 bg-iaspig-orange text-white text-xs font-bold rounded-xl hover:bg-iaspig-brown transition-colors">
                                        <i class="ri-add-line mr-1"></i> Tambah Riwayat
                                    </button>
                                </div>

                                <div class="space-y-4">
                                    <template x-for="(job, index) in jobs" :key="index">
                                        <div class="p-4 border rounded-2xl relative group transition-all" 
                                             :class="activeIndex === index ? 'border-iaspig-orange bg-iaspig-orange/5 shadow-md' : 'border-gray-100 bg-gray-50'">
                                            <button type="button" @click="removeJob(index)" class="absolute -top-3 -right-3 w-8 h-8 bg-white border border-gray-200 rounded-full text-red-500 hover:bg-red-50 hover:border-red-200 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center shadow-sm">
                                                <i class="ri-close-line"></i>
                                            </button>
                                            
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                                                <button type="button" @click="activateMapMode(index)" 
                                                        class="px-4 py-2 rounded-xl text-xs font-bold border transition-colors flex items-center justify-center gap-2"
                                                        :class="activeIndex === index ? 'bg-iaspig-orange text-white border-iaspig-orange animate-pulse shadow-lg shadow-iaspig-orange/30' : (job.lat && job.lng ? 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100' : 'bg-white text-gray-500 border-gray-200 hover:border-iaspig-orange hover:text-iaspig-orange')">
                                                    <i class="ri-map-pin-line text-sm"></i> 
                                                    <span x-text="activeIndex === index ? 'Pilih Titik di Peta Bawah ↓' : (job.lat && job.lng ? 'Lokasi Tersimpan (Ubah)' : 'Tandai Lokasi di Peta')"></span>
                                                </button>
                                                
                                                <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-iaspig-brown bg-white px-3 py-2 rounded-xl border border-gray-200 hover:border-iaspig-orange transition-colors">
                                                    <input type="checkbox" x-model="job.is_current" :name="`job_history[${index}][is_current]`" class="rounded text-iaspig-orange focus:ring-iaspig-orange border-gray-300 w-4 h-4">
                                                    Ini Pekerjaan Saat Ini
                                                </label>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <!-- hidden inputs for map coords -->
                                                <input type="hidden" x-model="job.lat" :name="`job_history[${index}][lat]`">
                                                <input type="hidden" x-model="job.lng" :name="`job_history[${index}][lng]`">
                                                
                                                <div class="space-y-1">
                                                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Perusahaan / Instansi</label>
                                                    <input type="text" x-model="job.company" :name="`job_history[${index}][company]`" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-xl shadow-sm text-sm py-2">
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Posisi / Jabatan</label>
                                                    <input type="text" x-model="job.position" :name="`job_history[${index}][position]`" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-xl shadow-sm text-sm py-2">
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Tahun Mulai</label>
                                                    <input type="text" x-model="job.start_year" :name="`job_history[${index}][start_year]`" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-xl shadow-sm text-sm py-2" placeholder="2018">
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Tahun Selesai</label>
                                                    <input type="text" x-model="job.end_year" :name="`job_history[${index}][end_year]`" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-xl shadow-sm text-sm py-2" placeholder="2021 (atau Sekarang)">
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Peta Karir Bersama -->
                            <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                        <i class="ri-route-line text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Peta Karir</h3>
                                </div>
                                <div class="mb-4 h-10 flex items-center">
                                    <p class="text-sm text-gray-500" x-show="activeIndex === null">Klik tombol <strong class="text-iaspig-orange">Tandai Lokasi di Peta</strong> pada riwayat pekerjaan di atas untuk menambahkan Pin.</p>
                                    <div class="px-4 py-2 bg-iaspig-orange/10 text-iaspig-orange font-bold rounded-xl text-sm animate-pulse border border-iaspig-orange/20" x-show="activeIndex !== null">
                                        <i class="ri-map-pin-add-line mr-2"></i> Mode Pin Aktif: Silakan klik pada peta!
                                    </div>
                                </div>
                                <div id="career-map" class="h-96 rounded-2xl border-2 overflow-hidden z-0 transition-colors" :class="activeIndex !== null ? 'border-iaspig-orange shadow-[0_0_0_4px_rgba(249,115,22,0.1)]' : 'border-gray-100'"></div>
                            </div>
                        </div>

                    </div>

                    <!-- Right: Avatar, Skills, Home Map -->
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
                            <p class="text-gray-400 text-xs mt-2">JPG, PNG (Akan dikompresi otomatis)</p>
                        </div>

                        <!-- Expertise & Availability -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-8">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-star-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Keahlian</h3>
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
                                            <span class="block text-sm font-bold text-iaspig-brown uppercase">Open for Collab</span>
                                            <span class="text-[10px] text-gray-500">Tandai jika Anda terbuka untuk kerja sama profesional.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Peta Domisili -->
                        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-10 h-10 bg-iaspig-orange/10 rounded-xl flex items-center justify-center text-iaspig-orange">
                                    <i class="ri-home-4-line text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-iaspig-brown font-outfit uppercase">Domisili</h3>
                            </div>
                            <p class="text-gray-500 text-xs mb-4">Pilih lokasi tempat tinggal Anda (Rumah).</p>
                            <div id="home-map" class="h-64 rounded-2xl border-2 border-gray-100 overflow-hidden mb-4 z-0"></div>
                            <div class="grid grid-cols-2 gap-2">
                                <x-text-input id="latitude" name="latitude" type="text" class="block w-full bg-gray-50 text-xs" :value="old('latitude', $profile->latitude)" readonly placeholder="Lat" />
                                <x-text-input id="longitude" name="longitude" type="text" class="block w-full bg-gray-50 text-xs" :value="old('longitude', $profile->longitude)" readonly placeholder="Lng" />
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Action Bar -->
                <div class="bg-white p-6 rounded-[2rem] shadow-lg border border-gray-100 flex justify-end gap-4 sticky bottom-6 z-20">
                    <x-primary-button type="submit" class="px-12 py-4">
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>

    <!-- Leaflet Integration -->
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
            background-color: #F97316; /* iaspig-orange */
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
            background-color: #5C4B41; /* iaspig-brown */
            width: 36px;
            height: 36px;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Alpine Component for Career Map
        document.addEventListener('alpine:init', () => {
            Alpine.data('careerMapManager', () => ({
                jobs: {!! json_encode(old('job_history', is_array($profile->job_history) && count($profile->job_history) > 0 ? $profile->job_history : [['company' => '', 'position' => '', 'start_year' => '', 'end_year' => '', 'lat' => null, 'lng' => null, 'is_current' => false]])) !!},
                activeIndex: null,
                map: null,
                markers: [],

                init() {
                    // Make sure lat/lng are parsed
                    this.jobs.forEach(job => {
                        if(!job.lat) job.lat = null;
                        if(!job.lng) job.lng = null;
                        if(job.is_current === undefined) job.is_current = false;
                    });

                    setTimeout(() => {
                        this.initMap();
                    }, 100);

                    this.$watch('jobs', (value) => {
                        this.renderMarkers();
                    }, { deep: true });
                },

                addJob() {
                    this.jobs.push({company: '', position: '', start_year: '', end_year: '', lat: null, lng: null, is_current: false});
                },

                removeJob(index) {
                    this.jobs.splice(index, 1);
                    if (this.activeIndex === index) this.activeIndex = null;
                },

                activateMapMode(index) {
                    if (this.activeIndex === index) {
                        this.activeIndex = null; // toggle off
                    } else {
                        this.activeIndex = index;
                        // scroll map into view smoothly
                        document.getElementById('career-map').scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                },

                initMap() {
                    var defaultLat = -2.5;
                    var defaultLng = 118.0;
                    this.map = L.map('career-map').setView([defaultLat, defaultLng], 5);
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', { 
                        attribution: '&copy; OpenStreetMap' 
                    }).addTo(this.map);

                    this.renderMarkers();

                    this.map.on('click', (e) => {
                        if (this.activeIndex !== null) {
                            this.jobs[this.activeIndex].lat = e.latlng.lat.toFixed(8);
                            this.jobs[this.activeIndex].lng = e.latlng.lng.toFixed(8);
                            this.activeIndex = null; // Exit pin mode
                            this.renderMarkers();
                        }
                    });
                },

                renderMarkers() {
                    if (!this.map) return;
                    
                    // Clear existing markers
                    this.markers.forEach(m => this.map.removeLayer(m));
                    this.markers = [];

                    let bounds = [];

                    this.jobs.forEach((job, index) => {
                        if (job.lat && job.lng) {
                            let isCurrent = job.is_current ? 'current' : '';
                            let iconHtml = `<div class="career-pin ${isCurrent}"><span>${index + 1}</span></div>`;
                            
                            let icon = L.divIcon({
                                className: 'custom-div-icon',
                                html: iconHtml,
                                iconSize: [32, 32],
                                iconAnchor: [16, 32]
                            });

                            let marker = L.marker([job.lat, job.lng], { icon: icon }).addTo(this.map);
                            marker.bindPopup(`<b>${job.company || 'Perusahaan'}</b><br>${job.position || 'Posisi'}`);
                            this.markers.push(marker);
                            bounds.push([job.lat, job.lng]);
                        }
                    });

                    // Draw polyline if more than 1 point
                    if (bounds.length > 1) {
                        // Optional: remove old polyline if exists
                        if (this.polyline) this.map.removeLayer(this.polyline);
                        this.polyline = L.polyline(bounds, {color: '#F97316', weight: 3, dashArray: '5, 10'}).addTo(this.map);
                    } else if (this.polyline) {
                        this.map.removeLayer(this.polyline);
                    }

                    if (bounds.length > 0) {
                        this.map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
                    }
                }
            }));
        });

        // Simple Home Map Script
        document.addEventListener('DOMContentLoaded', function() {
            var homeLat = {{ $profile->latitude ?? -6.8614 }};
            var homeLng = {{ $profile->longitude ?? 107.5946 }};
            var homeMap = L.map('home-map').setView([homeLat, homeLng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OSM' }).addTo(homeMap);
            var homeMarker = L.marker([homeLat, homeLng], { draggable: true }).addTo(homeMap);
            
            homeMarker.on('dragend', function(e) {
                var pos = e.target.getLatLng();
                document.getElementById('latitude').value = pos.lat.toFixed(8);
                document.getElementById('longitude').value = pos.lng.toFixed(8);
            });
            homeMap.on('click', function(e) {
                homeMarker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat.toFixed(8);
                document.getElementById('longitude').value = e.latlng.lng.toFixed(8);
            });
        });
    </script>
    @endpush
</x-app-layout>
