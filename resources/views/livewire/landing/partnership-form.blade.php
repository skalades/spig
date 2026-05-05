<div class="bg-white/[0.03] backdrop-blur-2xl p-10 md:p-14 rounded-[3.5rem] border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.3)] relative overflow-hidden group" data-aos="fade-left">
    <!-- Decorative Glow -->
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-iaspig-orange/20 rounded-full blur-[100px] group-hover:bg-iaspig-orange/30 transition-colors duration-700"></div>
    
    <form wire:submit.prevent="submit" class="relative z-10 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-iaspig-orange/80 px-1">Nama Lengkap</label>
                <div class="relative">
                    <input type="text" wire:model="name" class="w-full bg-white/[0.05] border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:bg-white/[0.08] focus:border-iaspig-orange/50 focus:ring-0 transition-all duration-300" placeholder="John Doe">
                </div>
                @error('name') <span class="text-red-400 text-[10px] font-bold px-1">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-3">
                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-iaspig-orange/80 px-1">Instansi / Perusahaan</label>
                <input type="text" wire:model="organization" class="w-full bg-white/[0.05] border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:bg-white/[0.08] focus:border-iaspig-orange/50 focus:ring-0 transition-all duration-300" placeholder="PT. Geospasial Indonesia">
                @error('organization') <span class="text-red-400 text-[10px] font-bold px-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-iaspig-orange/80 px-1">Email Bisnis</label>
                <input type="email" wire:model="email" class="w-full bg-white/[0.05] border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:bg-white/[0.08] focus:border-iaspig-orange/50 focus:ring-0 transition-all duration-300" placeholder="partnership@company.com">
                @error('email') <span class="text-red-400 text-[10px] font-bold px-1">{{ $message }}</span> @enderror
            </div>
            <div class="space-y-3">
                <label class="text-[10px] font-black uppercase tracking-[0.2em] text-iaspig-orange/80 px-1">No. WhatsApp</label>
                <input type="text" wire:model="phone" class="w-full bg-white/[0.05] border-white/10 rounded-2xl px-6 py-4 text-white placeholder-white/20 focus:bg-white/[0.08] focus:border-iaspig-orange/50 focus:ring-0 transition-all duration-300" placeholder="081234567890">
                @error('phone') <span class="text-red-400 text-[10px] font-bold px-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="space-y-3">
            <label class="text-[10px] font-black uppercase tracking-[0.2em] text-iaspig-orange/80 px-1">Pesan / Rencana Kolaborasi</label>
            <textarea wire:model="message" rows="4" class="w-full bg-white/[0.05] border-white/10 rounded-[2rem] px-6 py-5 text-white placeholder-white/20 focus:bg-white/[0.08] focus:border-iaspig-orange/50 focus:ring-0 transition-all duration-300 resize-none" placeholder="Ceritakan singkat rencana kerja sama Anda..."></textarea>
            @error('message') <span class="text-red-400 text-[10px] font-bold px-1">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full relative group/btn overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-iaspig-orange to-[#ff8f5e] transition-transform duration-500 group-hover/btn:scale-105"></div>
            <div class="relative py-5 rounded-2xl font-black text-white text-xs uppercase tracking-[0.3em] flex items-center justify-center gap-3">
                Kirim Pengajuan
                <i class="ri-arrow-right-up-line text-xl group-hover/btn:rotate-45 transition-transform duration-300"></i>
            </div>
        </button>
    </form>
</div>
