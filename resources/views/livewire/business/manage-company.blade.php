<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <a href="{{ route('alumni.dashboard') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-iaspig-orange transition-colors mb-4 font-bold uppercase tracking-widest text-xs">
                    <i class="ri-arrow-left-line"></i> Dashboard Alumni
                </a>
                <h1 class="text-4xl font-black text-iaspig-brown">Manajemen Perusahaan</h1>
                <p class="text-gray-400 font-bold mt-2">Kelola profil, layanan, dan inventaris rental untuk {{ $company->name }}.</p>
            </div>
            <div class="flex gap-4">
                @if($company->status === 'approved')
                    <a href="{{ route('alumni.business.detail', $company->slug) }}" target="_blank" class="px-6 py-4 rounded-2xl bg-white text-iaspig-brown font-black text-xs uppercase tracking-widest hover:text-iaspig-orange transition-colors shadow-lg border border-gray-50 flex items-center gap-2">
                        Lihat Profil Publik <i class="ri-external-link-line"></i>
                    </a>
                @else
                    <div class="px-6 py-4 rounded-2xl bg-yellow-50 text-yellow-700 font-black text-[10px] uppercase tracking-widest border border-yellow-100 flex items-center gap-3">
                        <i class="ri-error-warning-line text-xl"></i>
                        <span>Status: {{ ucfirst($company->status) }} - Belum tampil di direktori publik</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Left Column: Settings Navigation / General Info -->
            <div class="space-y-6">
                <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-gray-50 text-center relative overflow-hidden">
                    <div class="w-32 h-32 rounded-3xl mx-auto mb-6 bg-gray-50 flex items-center justify-center overflow-hidden border border-gray-100 p-2">
                        @if($company->hasMedia('logos'))
                            <img src="{{ $company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                        @else
                            <div class="text-4xl font-black text-iaspig-orange">{{ substr($company->name, 0, 1) }}</div>
                        @endif
                    </div>
                    <h2 class="text-2xl font-black text-iaspig-brown mb-2">{{ $company->name }}</h2>
                    <p class="text-iaspig-orange text-[10px] font-black uppercase tracking-widest mb-6">{{ $company->industry_type }}</p>
                    
                    @if($company->is_verified)
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 text-green-500 rounded-xl text-xs font-black uppercase tracking-widest">
                            <i class="ri-shield-check-fill"></i> Verified Partner
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-50 text-yellow-600 rounded-xl text-xs font-black uppercase tracking-widest">
                            <i class="ri-time-line"></i> Menunggu Verifikasi
                        </div>
                    @endif
                </div>

                <!-- Services Manager -->
                <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-gray-50">
                    <h3 class="text-lg font-black text-iaspig-brown mb-6 flex items-center gap-2">
                        <i class="ri-service-line text-iaspig-orange"></i> Layanan Aktif
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($company->services as $service)
                            <div class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-xs font-bold text-iaspig-brown border border-gray-100 group">
                                {{ $service->name }}
                                <button wire:click="deleteService({{ $service->id }})" wire:confirm="Hapus layanan ini?" class="text-gray-300 hover:text-red-500 transition-colors">
                                    <i class="ri-close-circle-fill"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-sm font-bold text-gray-400">Belum ada layanan ditambahkan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- General Settings -->
                <div class="bg-white rounded-[2rem] p-8 shadow-xl border border-gray-50">
                    <h3 class="text-lg font-black text-iaspig-brown mb-6 flex items-center gap-2">
                        <i class="ri-settings-4-line text-iaspig-orange"></i> Pengaturan Umum
                    </h3>
                    
                    <form wire:submit.prevent="updateCompany" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Deskripsi</label>
                            <textarea wire:model="description" rows="4" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm"></textarea>
                            @error('description') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">WhatsApp (62...)</label>
                            <input type="text" wire:model="whatsapp_number" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Instagram (URL)</label>
                            <input type="text" wire:model="instagram" placeholder="https://instagram.com/..." class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Alamat Kantor</label>
                            <input type="text" wire:model="address" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Latitude</label>
                                <input type="text" wire:model="latitude" placeholder="-6.123..." class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Longitude</label>
                                <input type="text" wire:model="longitude" placeholder="106.123..." class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Bidang Industri</label>
                            <select wire:model="industry_type" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                                @foreach(\App\Models\Company::INDUSTRY_TYPES as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-4 p-6 bg-iaspig-brown/5 rounded-2xl border border-iaspig-brown/10">
                            <label class="text-[10px] font-black uppercase tracking-widest text-iaspig-brown ml-1">Modul Fitur</label>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-iaspig-brown">Aktifkan Portofolio</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model.live="settings.show_portfolio" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-iaspig-orange"></div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-iaspig-brown">Aktifkan Sewa Alat</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model.live="settings.show_rental" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-iaspig-orange"></div>
                                </label>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">LinkedIn (URL)</label>
                            <input type="text" wire:model="linkedin" placeholder="https://linkedin.com/company/..." class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-inner text-sm">
                        </div>

                        <button type="submit" class="w-full py-4 bg-iaspig-brown text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-iaspig-orange transition-colors flex items-center justify-center gap-2 shadow-lg">
                            <i class="ri-save-line"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Manager Section -->
            <div class="lg:col-span-2 space-y-12">
                <!-- Portfolio Section -->
                @if($settings['show_portfolio'])
                <div class="bg-white rounded-[3rem] p-10 shadow-xl border border-gray-50">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-2xl font-black text-iaspig-brown">Portofolio & Proyek</h3>
                            <p class="text-gray-400 font-bold text-sm mt-1">Pamerkan hasil kerja terbaik Anda</p>
                        </div>
                        <button wire:click="toggleAddProject" class="w-12 h-12 rounded-2xl bg-iaspig-brown text-white flex items-center justify-center hover:scale-105 transition-transform shadow-lg shadow-iaspig-brown/30">
                            <i class="ri-add-line text-2xl"></i>
                        </button>
                    </div>
                    @if($isAddingProject)
                        <form wire:submit.prevent="saveProject" class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 mb-10 relative">
                            <button type="button" wire:click="toggleAddProject" class="absolute top-6 right-6 text-gray-400 hover:text-red-500 transition-colors">
                                <i class="ri-close-line text-2xl"></i>
                            </button>
                            <h4 class="text-lg font-black text-iaspig-brown mb-8">Tambah Proyek Baru</h4>
                            
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Judul Proyek</label>
                                    <input type="text" wire:model="project_title" placeholder="Cth: Survey Topografi Bendungan..." class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm">
                                    @error('project_title') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Nama Klien</label>
                                        <input type="text" wire:model="client_name" placeholder="PT. ..." class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Tanggal Proyek</label>
                                        <input type="date" wire:model="project_date" class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Link Proyek (URL)</label>
                                    <input type="text" wire:model="project_url" placeholder="https://..." class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Deskripsi Proyek</label>
                                    <textarea wire:model="project_description" rows="3" class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm"></textarea>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Foto Proyek</label>
                                    <input type="file" wire:model="project_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-iaspig-orange/10 file:text-iaspig-orange hover:file:bg-iaspig-orange/20 transition-colors">
                                    @error('project_image') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="bg-iaspig-brown text-white px-8 py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-iaspig-orange transition-colors">
                                        Simpan Proyek
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    <div class="grid grid-cols-1 gap-6">
                        @forelse($company->projects as $project)
                            <div class="flex items-center gap-6 p-4 rounded-2xl border border-gray-100 bg-white group">
                                <div class="w-20 h-20 rounded-xl bg-gray-50 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if($project->hasMedia('projects'))
                                        <img src="{{ $project->getFirstMediaUrl('projects', 'thumb') }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="ri-folder-image-line text-2xl text-gray-300"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-lg font-black text-iaspig-brown truncate">{{ $project->title }}</h4>
                                    <p class="text-xs font-bold text-gray-400">{{ $project->client_name }} • {{ $project->project_date ? $project->project_date->format('M Y') : 'N/A' }}</p>
                                </div>
                                <button wire:click="deleteProject({{ $project->id }})" wire:confirm="Hapus proyek ini?" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        @empty
                            <div class="text-center py-10 bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
                                <p class="text-gray-400 text-sm font-bold">Belum ada portofolio proyek.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                @endif

                <!-- Inventory Section -->
                @if($settings['show_rental'])
                <div class="bg-white rounded-[3rem] p-10 shadow-xl border border-gray-50">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-2xl font-black text-iaspig-brown">Inventaris & Rental</h3>
                            <p class="text-gray-400 font-bold text-sm mt-1">Kelola katalog alat/perangkat yang disewakan</p>
                        </div>
                        <button wire:click="toggleAddItem" class="w-12 h-12 rounded-2xl bg-iaspig-orange text-white flex items-center justify-center hover:scale-105 transition-transform shadow-lg shadow-iaspig-orange/30">
                            <i class="ri-add-line text-2xl"></i>
                        </button>
                    </div>

                    <!-- Add Item Form -->
                    @if($isAddingItem)
                        <form wire:submit.prevent="saveInventoryItem" class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 mb-10 relative">
                            <button type="button" wire:click="toggleAddItem" class="absolute top-6 right-6 text-gray-400 hover:text-red-500 transition-colors">
                                <i class="ri-close-line text-2xl"></i>
                            </button>
                            <h4 class="text-lg font-black text-iaspig-brown mb-6">Tambah Item Baru</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Nama Item</label>
                                    <input type="text" wire:model="item_name" placeholder="Cth: Leica TS16 / Drone DJI" class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm">
                                    @error('item_name') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                                </div>
                                <div class="space-y-2">
                                    <x-iaspig.custom-select 
                                        wire:model="category" 
                                        label="Kategori"
                                        placeholder="Pilih Kategori"
                                        :options="[
                                            ['value' => 'Total Station', 'label' => 'Total Station'],
                                            ['value' => 'Theodolite', 'label' => 'Theodolite'],
                                            ['value' => 'Waterpass/Level', 'label' => 'Waterpass / Auto Level'],
                                            ['value' => 'GNSS/GPS', 'label' => 'GNSS / GPS Geodetic'],
                                            ['value' => 'Drone/UAV', 'label' => 'Drone / UAV'],
                                            ['value' => 'Camera', 'label' => 'Camera / Photography Gear'],
                                            ['value' => 'IT Gear', 'label' => 'Laptop / IT Equipment'],
                                            ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]"
                                    />
                                    @error('category') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="space-y-2" x-data="{ 
                                    displayValue: '',
                                    formatCurrency(val) {
                                        if (!val) return '';
                                        let num = val.toString().replace(/\D/g, '');
                                        return num.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                    }
                                }" x-init="displayValue = formatCurrency($wire.daily_rate)">
                                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Harga Sewa / Hari (Rp)</label>
                                    <div class="relative">
                                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 font-bold">Rp</div>
                                        <input 
                                            type="text" 
                                            x-model="displayValue" 
                                            x-on:input="
                                                let raw = $event.target.value.replace(/\D/g, '');
                                                displayValue = formatCurrency(raw);
                                                $wire.set('daily_rate', raw);
                                            "
                                            placeholder="500.000" 
                                            class="w-full bg-white border-none rounded-2xl pl-14 pr-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm"
                                        >
                                    </div>
                                    @error('daily_rate') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                                </div>
                                <div class="space-y-2">
                                    <x-iaspig.custom-select 
                                        wire:model="status" 
                                        label="Status"
                                        placeholder="Pilih Status"
                                        :options="[
                                            ['value' => 'available', 'label' => 'Tersedia (Available)'],
                                            ['value' => 'rented', 'label' => 'Sedang Disewa (Rented)'],
                                            ['value' => 'maintenance', 'label' => 'Perawatan (Maintenance)'],
                                        ]"
                                    />
                                    @error('status') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-2 mb-6">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Deskripsi Item (Kondisi/Kelengkapan)</label>
                                <textarea wire:model="item_description" rows="3" class="w-full bg-white border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown shadow-sm"></textarea>
                                @error('item_description') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2 mb-8">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Foto Item</label>
                                <input type="file" wire:model="item_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-widest file:bg-iaspig-orange/10 file:text-iaspig-orange hover:file:bg-iaspig-orange/20 transition-colors">
                                @error('item_image') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-iaspig-brown text-white px-8 py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-iaspig-orange transition-colors flex items-center gap-2">
                                    <span wire:loading.remove wire:target="saveInventoryItem">Simpan Item</span>
                                    <span wire:loading wire:target="saveInventoryItem">Menyimpan...</span>
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Inventory List -->
                    <div class="space-y-4">
                        @forelse($company->inventories as $item)
                            <div class="flex items-center gap-6 p-4 rounded-2xl border border-gray-100 hover:border-iaspig-orange/30 transition-colors bg-white group">
                                <div class="w-20 h-20 rounded-xl bg-gray-50 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    @if($item->hasMedia('inventories'))
                                        <img src="{{ $item->getFirstMediaUrl('inventories', 'thumb') }}" class="w-full h-full object-cover">
                                    @else
                                        <i class="ri-tools-line text-2xl text-gray-300"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ $item->category }}</span>
                                        <span class="text-[10px] font-black uppercase tracking-widest {{ $item->status === 'available' ? 'text-green-500' : ($item->status === 'maintenance' ? 'text-yellow-500' : 'text-red-500') }}">
                                            {{ $item->status }}
                                        </span>
                                    </div>
                                    <h4 class="text-lg font-black text-iaspig-brown truncate">{{ $item->item_name }}</h4>
                                    <p class="text-sm font-bold text-iaspig-orange">{{ $item->formatted_rate }} / hari</p>
                                </div>
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button wire:click="deleteItem({{ $item->id }})" wire:confirm="Yakin ingin menghapus item ini?" class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition-colors">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
                                <i class="ri-archive-line text-5xl text-gray-300 mb-4"></i>
                                <h4 class="text-xl font-black text-gray-400">Inventaris Kosong</h4>
                                <p class="text-gray-400 text-sm mt-2">Anda belum menambahkan item apapun ke katalog.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
