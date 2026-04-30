@props(['title', 'value', 'icon', 'color' => 'iaspig-orange'])

<div class="glass-card p-6 rounded-[2.5rem] shadow-premium border border-white/50 group hover:-translate-y-1 transition-all duration-300">
    <div class="flex items-center gap-5">
        <div class="w-14 h-14 bg-{{ $color }}/10 rounded-2xl flex items-center justify-center text-{{ $color }} group-hover:scale-110 transition-transform duration-300">
            <i class="{{ $icon }} text-3xl"></i>
        </div>
        <div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">{{ $title }}</p>
            <h3 class="text-3xl font-black text-iaspig-brown font-outfit">{{ $value }}</h3>
        </div>
    </div>
</div>
