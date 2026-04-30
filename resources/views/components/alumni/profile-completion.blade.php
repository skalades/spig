@props(['completion'])

<div class="glass-card p-8 rounded-[2.5rem] shadow-premium border border-white/50">
    <div class="flex items-center gap-4 mb-8">
        <div class="w-12 h-12 bg-iaspig-orange/10 rounded-2xl flex items-center justify-center text-iaspig-orange">
            <i class="ri-user-follow-line text-2xl"></i>
        </div>
        <div>
            <h3 class="text-xl font-black text-iaspig-brown font-outfit uppercase tracking-tight">Profil Anda</h3>
            <p class="text-xs text-gray-400 font-bold">Progress Kelengkapan</p>
        </div>
    </div>
    
    <div class="space-y-6">
        <div class="relative pt-1">
            <div class="flex mb-4 items-center justify-between">
                <div>
                    <span class="text-xs font-black inline-block py-1 px-3 uppercase rounded-full text-iaspig-orange bg-iaspig-orange/10">
                        {{ $completion }}% Terisi
                    </span>
                </div>
                <div class="text-right">
                    <span class="text-xs font-black inline-block text-iaspig-brown opacity-40 uppercase">
                        Target 100%
                    </span>
                </div>
            </div>
            <div class="overflow-hidden h-3 mb-4 text-xs flex rounded-full bg-gray-100 p-0.5">
                <div style="width:{{ $completion }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-iaspig-orange to-iaspig-brown rounded-full transition-all duration-1000 ease-out"></div>
            </div>
        </div>
        
        <p class="text-sm text-gray-500 leading-relaxed font-medium">
            Lengkapi data diri Anda untuk mempermudah jejaring profesional antar alumni SPIG UPI.
        </p>
        
        <a href="{{ route('alumni.profile.edit') }}" class="flex items-center justify-center gap-2 w-full py-4 bg-iaspig-brown text-white rounded-2xl font-bold hover:bg-iaspig-orange transition-all duration-300 shadow-lg shadow-iaspig-brown/20 group">
            <span>Update Profil</span>
            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
</div>
