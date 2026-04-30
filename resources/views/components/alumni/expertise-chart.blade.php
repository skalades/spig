@props(['id'])

<div class="glass-card p-8 rounded-[2.5rem] shadow-premium border border-white/50">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange">
            <i class="ri-pie-chart-line text-2xl"></i>
        </div>
        <div>
            <h3 class="text-xl font-black text-iaspig-brown font-outfit uppercase tracking-tight">Keahlian</h3>
            <p class="text-xs text-gray-400 font-bold">Distribusi Sektoral</p>
        </div>
    </div>
    
    <div class="relative h-[300px]">
        <canvas id="{{ $id }}"></canvas>
    </div>
</div>
