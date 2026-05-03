@props([
    'title',
    'subtitle' => null,
    'badge' => 'Alumni Ecosystem',
    'icon' => 'ri-global-line',
])

<div class="relative group mb-12">
    <div class="absolute inset-0 bg-gradient-to-r from-iaspig-orange/20 to-iaspig-brown/20 rounded-[3rem] blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
    <div class="relative bg-iaspig-brown rounded-[3rem] p-8 lg:p-14 overflow-hidden shadow-2xl border border-white/10">
        <!-- Background Decor -->
        <div class="absolute top-0 right-0 w-full h-full pointer-events-none">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-iaspig-orange/20 via-transparent to-transparent"></div>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-white/10 backdrop-blur-xl border border-white/10 rounded-full text-[10px] font-black text-iaspig-orange uppercase tracking-[0.3em] mb-6">
                    <span class="w-1.5 h-1.5 bg-iaspig-orange rounded-full animate-pulse shadow-[0_0_10px_#E67E22]"></span>
                    {{ $badge }}
                </div>
                <h1 class="text-4xl lg:text-5xl font-black text-white font-outfit leading-tight mb-4 uppercase tracking-tight">
                    {{ $title }}
                </h1>
                @if($subtitle)
                    <p class="text-white/50 text-base font-medium leading-relaxed">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            <div class="hidden lg:flex justify-end">
                <div class="w-24 h-24 bg-white/5 backdrop-blur-2xl rounded-[2rem] border border-white/10 flex items-center justify-center text-iaspig-orange shadow-2xl animate-float">
                    <i class="{{ $icon }} text-5xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>
