<div class="bg-white rounded-[2rem] p-8 shadow-xl border border-gray-100">
    <h3 class="text-lg font-black text-iaspig-brown mb-6 flex items-center gap-3">
        <i class="ri-user-star-line text-iaspig-orange"></i>
        Rekomendasi Koneksi
    </h3>
    <div class="space-y-6">
        @foreach($recommendations as $alumni)
            <div class="flex items-center gap-4 group cursor-pointer">
                <div class="w-12 h-12 rounded-full bg-iaspig-brown/5 flex items-center justify-center text-iaspig-brown font-black shadow-sm overflow-hidden group-hover:scale-105 transition-transform">
                    @if($alumni->alumniProfile && $alumni->alumniProfile->photo)
                        <img src="{{ asset('storage/' . $alumni->alumniProfile->photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr($alumni->name, 0, 1) }}
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-black text-iaspig-brown truncate group-hover:text-iaspig-orange transition-colors">
                        {{ $alumni->name }}
                    </div>
                    <div class="text-[10px] font-bold text-gray-400">
                        Angkatan {{ $alumni->alumniProfile->class_year ?? '?' }}
                    </div>
                </div>
                <button class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-iaspig-orange/10 hover:text-iaspig-orange transition-all">
                    <i class="ri-user-add-line"></i>
                </button>
            </div>
        @endforeach

        @if($recommendations->isEmpty())
            <div class="text-center py-4 text-gray-300 font-bold text-xs">
                Belum ada rekomendasi.
            </div>
        @endif
    </div>

    <div class="mt-8 pt-8 border-t border-gray-50 space-y-4">
        <a href="{{ route('alumni.business.index') }}" class="flex items-center justify-between p-4 bg-iaspig-brown/5 rounded-2xl group hover:bg-iaspig-brown transition-all duration-300">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-iaspig-brown shadow-sm group-hover:scale-110 transition-transform">
                    <i class="ri-briefcase-line"></i>
                </div>
                <div>
                    <div class="text-[10px] font-black text-iaspig-brown group-hover:text-white uppercase tracking-widest">Business</div>
                    <div class="text-[9px] font-bold text-gray-400 group-hover:text-iaspig-orange/80">Direktori Alumni</div>
                </div>
            </div>
            <i class="ri-arrow-right-line text-iaspig-orange group-hover:translate-x-1 transition-transform"></i>
        </a>

        <a href="{{ route('alumni.jobs.index') }}" class="flex items-center justify-between p-4 bg-iaspig-orange/5 rounded-2xl group hover:bg-iaspig-orange transition-all duration-300">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-iaspig-orange shadow-sm group-hover:scale-110 transition-transform">
                    <i class="ri-briefcase-4-line"></i>
                </div>
                <div>
                    <div class="text-[10px] font-black text-iaspig-orange group-hover:text-white uppercase tracking-widest text-iaspig-brown">Career</div>
                    <div class="text-[9px] font-bold text-gray-400 group-hover:text-white/80">Loker & Peluang</div>
                </div>
            </div>
            <i class="ri-arrow-right-line text-iaspig-orange group-hover:translate-x-1 transition-transform group-hover:text-white"></i>
        </a>
    </div>
</div>
