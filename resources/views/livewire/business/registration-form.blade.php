<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-iaspig-brown/10 overflow-hidden border border-gray-100">
        <div class="bg-iaspig-brown p-12 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-4xl font-black mb-2">Daftarkan Bisnis Anda</h2>
                <p class="text-iaspig-orange font-bold uppercase tracking-widest text-xs">Pemberdayaan Ekonomi Alumni IASPIG</p>
            </div>
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <i class="ri-briefcase-line text-[120px]"></i>
            </div>
        </div>

        <form wire:submit.prevent="save" class="p-12 space-y-12">
            <!-- Section: Identitas -->
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-iaspig-orange/10 text-iaspig-orange flex items-center justify-center font-black">01</span>
                    <h3 class="text-xl font-black text-iaspig-brown">Identitas Perusahaan</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Nama Perusahaan</label>
                        <input type="text" wire:model.live="name" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        @error('name') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Slug (Otomatis)</label>
                        <input type="text" wire:model="slug" readonly class="w-full bg-gray-100 border-none rounded-2xl px-6 py-4 font-bold text-gray-400 cursor-not-allowed">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <x-iaspig.custom-select 
                            wire:model="industry_type" 
                            label="Bidang Industri"
                            placeholder="Pilih Industri"
                            :options="[
                                ['value' => 'Surveying', 'label' => 'Surveying'],
                                ['value' => 'GIS', 'label' => 'GIS & Remote Sensing'],
                                ['value' => 'Hydrography', 'label' => 'Hydrography'],
                                ['value' => 'Consulting', 'label' => 'Consulting'],
                                ['value' => 'Education', 'label' => 'Education'],
                                ['value' => 'Other', 'label' => 'Lainnya'],
                            ]"
                        />
                        @error('industry_type') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Logo Perusahaan</label>
                        <div class="relative group">
                            <input type="file" wire:model="logo" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="w-full bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl px-6 py-4 flex items-center gap-4 group-hover:border-iaspig-orange transition-colors">
                                <i class="ri-image-add-line text-2xl text-gray-400 group-hover:text-iaspig-orange"></i>
                                <span class="text-sm font-bold text-gray-400 group-hover:text-iaspig-orange">
                                    {{ $logo ? $logo->getClientOriginalName() : 'Pilih file logo...' }}
                                </span>
                            </div>
                        </div>
                        @error('logo') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Deskripsi Singkat</label>
                    <textarea wire:model="description" rows="4" class="w-full bg-gray-50 border-none rounded-3xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all"></textarea>
                    @error('description') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Section: Kontak -->
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-iaspig-orange/10 text-iaspig-orange flex items-center justify-center font-black">02</span>
                    <h3 class="text-xl font-black text-iaspig-brown">Kontak & Media Sosial</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Website</label>
                        <div class="relative">
                            <i class="ri-global-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" wire:model="website" placeholder="https://..." class="w-full bg-gray-50 border-none rounded-2xl pl-14 pr-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">WhatsApp</label>
                        <div class="relative">
                            <i class="ri-whatsapp-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" wire:model="whatsapp_number" placeholder="628..." class="w-full bg-gray-50 border-none rounded-2xl pl-14 pr-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Email</label>
                        <div class="relative">
                            <i class="ri-mail-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" wire:model="email" class="w-full bg-gray-50 border-none rounded-2xl pl-14 pr-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Layanan -->
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-iaspig-orange/10 text-iaspig-orange flex items-center justify-center font-black">03</span>
                    <h3 class="text-xl font-black text-iaspig-brown">Layanan & Jasa</h3>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Tags Layanan (Pisahkan dengan koma)</label>
                    <input type="text" wire:model="services" placeholder="Rental Alat, Topografi, Bathymetry..." class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                </div>
            </div>

            <div class="pt-12">
                <button type="submit" class="w-full bg-iaspig-orange text-white py-6 rounded-3xl font-black text-lg uppercase tracking-widest shadow-2xl shadow-iaspig-orange/40 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-4">
                    <span wire:loading.remove>Daftarkan Perusahaan</span>
                    <span wire:loading class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                    <i class="ri-arrow-right-line text-2xl" wire:loading.remove></i>
                </button>
            </div>
        </form>
    </div>
</div>
