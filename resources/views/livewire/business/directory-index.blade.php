<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <x-iaspig.page-header 
            title="Business Directory" 
            subtitle="Temukan dan berkolaborasi dengan perusahaan yang didirikan oleh alumni IASPIG. Dari survei terestrial hingga solusi GIS canggih."
            badge="Business Hub"
            icon="ri-building-4-line"
        />

        <div class="mb-12">
            
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto items-center">
                <a href="{{ route('alumni.business.register') }}" class="bg-iaspig-brown text-white px-8 py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-iaspig-brown/30 hover:bg-iaspig-orange transition-all flex items-center gap-3 w-full sm:w-auto justify-center">
                    <i class="ri-add-circle-line text-xl"></i> Register Business
                </a>
                <div class="relative flex-1 sm:w-80">
                    <i class="ri-search-2-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
                    <input 
                        wire:model.live.debounce.300ms="search" 
                        type="text" 
                        placeholder="Cari perusahaan atau jasa..." 
                        class="w-full bg-white border-none rounded-[2rem] pl-16 pr-6 py-6 shadow-xl shadow-iaspig-brown/5 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all"
                    >
                </div>
                <div class="w-full sm:w-64">
                    <x-iaspig.custom-select 
                        wire:model.live="industry" 
                        placeholder="Semua Industri"
                        :options="[
                            ['value' => '', 'label' => 'Semua Industri'],
                            ['value' => 'Surveying', 'label' => 'Surveying'],
                            ['value' => 'GIS', 'label' => 'GIS & Remote Sensing'],
                            ['value' => 'Hydrography', 'label' => 'Hydrography'],
                            ['value' => 'Consulting', 'label' => 'Consulting'],
                        ]"
                    />
                </div>
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($companies as $company)
                <div class="bg-white rounded-[3rem] p-8 shadow-xl border border-gray-50 group hover:shadow-2xl hover:shadow-iaspig-brown/5 transition-all duration-500 relative overflow-hidden">
                    <!-- Verification Badge -->
                    @if($company->is_verified)
                        <div class="absolute top-0 right-0 bg-iaspig-orange text-white px-6 py-2 rounded-bl-[2rem] text-[10px] font-black uppercase tracking-widest flex items-center gap-2">
                            <i class="ri-shield-check-fill"></i> Verified
                        </div>
                    @endif

                    <div class="flex items-start gap-6 mb-8">
                        <div class="w-20 h-20 rounded-[1.5rem] bg-gray-50 flex-shrink-0 overflow-hidden border border-gray-100 p-2 group-hover:scale-110 transition-transform duration-500">
                            @if($company->hasMedia('logos'))
                                <img src="{{ $company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full bg-iaspig-brown/5 flex items-center justify-center text-iaspig-brown text-2xl font-black">
                                    {{ substr($company->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-[10px] font-black text-iaspig-orange uppercase tracking-widest mb-1">{{ $company->industry_type }}</div>
                            <h3 class="text-2xl font-black text-iaspig-brown group-hover:text-iaspig-orange transition-colors truncate">{{ $company->name }}</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Active Partner</span>
                            </div>
                        </div>
                    </div>

                    <p class="text-iaspig-brown/60 font-medium text-sm leading-relaxed mb-8 line-clamp-3">
                        {{ $company->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>

                    <!-- Services Tags -->
                    <div class="flex flex-wrap gap-2 mb-10">
                        @foreach($company->services as $service)
                            <span class="px-4 py-1.5 bg-iaspig-brown/5 rounded-xl text-[10px] font-black text-iaspig-brown uppercase tracking-wider group-hover:bg-iaspig-orange/10 group-hover:text-iaspig-orange transition-colors">
                                {{ $service->name }}
                            </span>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between pt-8 border-t border-gray-50">
                        <div class="flex gap-4">
                            @if($company->whatsapp_number)
                                <a href="https://wa.me/{{ $company->whatsapp_number }}" target="_blank" class="w-12 h-12 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all shadow-sm">
                                    <i class="ri-whatsapp-line text-xl"></i>
                                </a>
                            @endif
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="w-12 h-12 rounded-2xl bg-iaspig-brown/5 text-iaspig-brown flex items-center justify-center hover:bg-iaspig-brown hover:text-white transition-all shadow-sm">
                                    <i class="ri-global-line text-xl"></i>
                                </a>
                            @endif
                        </div>
                        
                        <a href="{{ route('alumni.business.detail', $company->slug) }}" class="flex items-center gap-2 text-iaspig-brown font-black text-xs uppercase tracking-widest group/btn">
                            View Profile
                            <i class="ri-arrow-right-line text-iaspig-orange group-hover/btn:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-20">
            {{ $companies->links() }}
        </div>
    </div>
</div>
