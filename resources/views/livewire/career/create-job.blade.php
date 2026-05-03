<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-iaspig-brown/10 overflow-hidden border border-gray-100">
        <div class="bg-iaspig-brown p-12 text-white relative overflow-hidden">
            <div class="relative z-10">
                <a href="{{ route('alumni.jobs.index') }}" class="inline-flex items-center gap-2 text-iaspig-orange hover:text-white transition-colors mb-6 text-sm font-bold uppercase tracking-widest">
                    <i class="ri-arrow-left-line"></i> Kembali ke Job Board
                </a>
                <h2 class="text-4xl font-black mb-2">Posting Lowongan Baru</h2>
                <p class="text-iaspig-orange font-bold uppercase tracking-widest text-xs">Berbagi Peluang Karir untuk Alumni</p>
            </div>
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <i class="ri-file-add-line text-[120px]"></i>
            </div>
        </div>

        <form wire:submit.prevent="save" class="p-12 space-y-12">
            <!-- Basic Info -->
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-iaspig-orange/10 text-iaspig-orange flex items-center justify-center font-black">01</span>
                    <h3 class="text-xl font-black text-iaspig-brown">Informasi Dasar</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Judul Posisi</label>
                        <input type="text" wire:model.live="title" placeholder="Cth: Senior GIS Analyst" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        @error('title') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <x-iaspig.custom-select 
                            wire:model="company_id" 
                            label="Perusahaan (Opsional)"
                            placeholder="Posting atas nama sendiri"
                            :options="[
                                ['value' => '', 'label' => 'Posting atas nama sendiri'],
                                ...$myCompanies->map(fn($c) => ['value' => $c->id, 'label' => $c->name])->toArray()
                            ]"
                        />
                        @error('company_id') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-2">
                        <x-iaspig.custom-select 
                            wire:model="job_type" 
                            label="Tipe Pekerjaan"
                            placeholder="Pilih Tipe"
                            :options="[
                                ['value' => 'Full-time', 'label' => 'Full-time'],
                                ['value' => 'Part-time', 'label' => 'Part-time'],
                                ['value' => 'Contract', 'label' => 'Contract'],
                                ['value' => 'Freelance', 'label' => 'Freelance'],
                                ['value' => 'Internship', 'label' => 'Internship'],
                            ]"
                        />
                        @error('job_type') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Lokasi</label>
                        <div class="relative">
                            <i class="ri-map-pin-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" wire:model="location" placeholder="Jakarta / Remote" class="w-full bg-gray-50 border-none rounded-2xl pl-14 pr-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        </div>
                        @error('location') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Batas Akhir (Deadline)</label>
                        <input type="date" wire:model="deadline" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                        @error('deadline') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Details -->
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <span class="w-10 h-10 rounded-xl bg-iaspig-orange/10 text-iaspig-orange flex items-center justify-center font-black">02</span>
                    <h3 class="text-xl font-black text-iaspig-brown">Detail Pekerjaan</h3>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Deskripsi Pekerjaan</label>
                    <textarea wire:model="description" rows="5" class="w-full bg-gray-50 border-none rounded-3xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all" placeholder="Jelaskan peran dan tanggung jawab pekerjaan ini..."></textarea>
                    @error('description') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Persyaratan (Requirements)</label>
                    <textarea wire:model="requirements" rows="5" class="w-full bg-gray-50 border-none rounded-3xl px-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all" placeholder="Kualifikasi yang dibutuhkan (pengalaman, skill, sertifikasi)..."></textarea>
                    @error('requirements') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Rentang Gaji (Opsional)</label>
                    <div class="relative">
                        <i class="ri-money-dollar-circle-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" wire:model="salary_range" placeholder="Rp 5.000.000 - Rp 10.000.000 / Kompetitif" class="w-full bg-gray-50 border-none rounded-2xl pl-14 pr-6 py-4 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all">
                    </div>
                    @error('salary_range') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="ri-information-line text-iaspig-orange"></i>
                    <span class="text-sm font-bold text-gray-400">Lowongan akan otomatis dibagikan ke Feed Alumni.</span>
                </div>
                <button type="submit" class="bg-iaspig-orange text-white px-10 py-5 rounded-2xl font-black text-sm uppercase tracking-widest shadow-2xl shadow-iaspig-orange/40 hover:scale-105 transition-all flex items-center gap-3">
                    <span wire:loading.remove>Post Lowongan</span>
                    <span wire:loading>Memproses...</span>
                    <i class="ri-send-plane-fill" wire:loading.remove></i>
                </button>
            </div>
        </form>
    </div>
</div>
