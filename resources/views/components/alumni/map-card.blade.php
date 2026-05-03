@props(['title', 'id'])

<div class="glass-card p-8 rounded-[3rem] shadow-premium border border-white/50 overflow-hidden">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange">
                <i class="ri-map-pin-2-line text-2xl"></i>
            </div>
            <div>
                <h3 class="text-2xl font-black text-iaspig-brown font-outfit uppercase tracking-tight">{{ $title }}</h3>
                <p class="text-xs text-gray-400 font-bold">Visualisasi Data Geospasial Alumni</p>
            </div>
        </div>
        <div class="flex items-center gap-2 bg-gray-50 p-1.5 rounded-full border border-gray-100">
            <button id="show-markers" class="px-4 py-1.5 bg-white shadow-sm rounded-full text-[10px] font-black text-iaspig-orange uppercase tracking-wider transition-all">
                Alumni
            </button>
            <button id="show-companies" class="px-4 py-1.5 rounded-full text-[10px] font-black text-gray-400 uppercase tracking-wider transition-all hover:text-iaspig-orange">
                Bisnis
            </button>
            <button id="show-heatmap" class="px-4 py-1.5 rounded-full text-[10px] font-black text-gray-400 uppercase tracking-wider transition-all hover:text-iaspig-orange">
                Heatmap
            </button>
        </div>
    </div>
    
    <div class="relative">
        <div id="{{ $id }}" class="h-[550px] rounded-[2.5rem] border-4 border-gray-50 shadow-inner overflow-hidden z-0"></div>
        
        <!-- Custom Map Controls Placeholder -->
        <div class="absolute bottom-6 left-6 z-[40] flex flex-col gap-2">
            <button id="zoom-in" class="w-10 h-10 bg-white shadow-lg rounded-xl flex items-center justify-center text-iaspig-brown hover:bg-iaspig-orange hover:text-white transition-all">
                <i class="ri-add-line text-xl"></i>
            </button>
            <button id="zoom-out" class="w-10 h-10 bg-white shadow-lg rounded-xl flex items-center justify-center text-iaspig-brown hover:bg-iaspig-orange hover:text-white transition-all">
                <i class="ri-subtract-line text-xl"></i>
            </button>
        </div>
    </div>
</div>
