@props(['alumni'])

<div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden group">
    <!-- Top Decor -->
    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-iaspig-orange to-iaspig-brown opacity-0 group-hover:opacity-100 transition-opacity"></div>
    
    @if(optional($alumni->alumniProfile)->availability_status)
    <div class="absolute top-4 right-4 bg-green-100 text-green-700 text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full flex items-center gap-1">
        <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
        Available
    </div>
    @endif

    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-2xl bg-iaspig-orange/10 border-2 border-iaspig-orange/20 overflow-hidden flex-shrink-0">
            @if(optional($alumni->alumniProfile)->avatar)
                <img src="{{ asset('storage/' . $alumni->alumniProfile->avatar) }}" alt="{{ $alumni->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-iaspig-orange font-bold text-xl">
                    {{ substr($alumni->name, 0, 1) }}
                </div>
            @endif
        </div>
        <div>
            <h3 class="font-black text-lg text-iaspig-brown font-outfit leading-tight">{{ $alumni->name }}</h3>
            <p class="text-xs font-bold text-iaspig-orange uppercase mt-1">{{ optional($alumni->alumniProfile)->current_job ?? 'Alumni SPIG' }}</p>
        </div>
    </div>

    <div class="space-y-3 mb-6">
        <div class="flex items-start gap-2">
            <i class="ri-building-line text-gray-400 mt-0.5"></i>
            <span class="text-sm text-gray-600">{{ optional($alumni->alumniProfile)->company ?? 'Belum ada instansi' }}</span>
        </div>
        <div class="flex items-start gap-2">
            <i class="ri-map-pin-line text-gray-400 mt-0.5"></i>
            <span class="text-sm text-gray-600 line-clamp-1">{{ optional($alumni->alumniProfile)->address ?? 'Lokasi belum diatur' }}</span>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 mb-6">
        @if(is_array(optional($alumni->alumniProfile)->skills))
            @foreach(array_slice($alumni->alumniProfile->skills, 0, 3) as $skill)
                <span class="px-2 py-1 bg-gray-50 text-gray-500 text-[10px] font-bold uppercase rounded-lg border border-gray-100">{{ $skill }}</span>
            @endforeach
            @if(count($alumni->alumniProfile->skills) > 3)
                <span class="px-2 py-1 bg-gray-50 text-gray-400 text-[10px] font-bold rounded-lg border border-gray-100">+{{ count($alumni->alumniProfile->skills) - 3 }}</span>
            @endif
        @else
            <span class="text-xs text-gray-400 italic">Belum ada keahlian</span>
        @endif
    </div>

    <div class="flex gap-2">
        <a href="{{ route('alumni.directory.show', $alumni->id) }}" class="flex-1 py-3 bg-gray-50 hover:bg-iaspig-brown text-iaspig-brown hover:text-white text-center rounded-xl font-bold text-sm transition-colors">
            Lihat Profil
        </a>
        @if(optional($alumni->alumniProfile)->whatsapp)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $alumni->alumniProfile->whatsapp) }}" target="_blank" class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white flex items-center justify-center rounded-xl transition-colors shadow-lg shadow-green-500/20">
                <i class="ri-whatsapp-line text-xl"></i>
            </a>
        @endif
    </div>
</div>
