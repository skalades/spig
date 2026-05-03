<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header Section -->
            <x-iaspig.page-header 
                title="Direktori Alumni" 
                subtitle="Temukan dan bangun relasi dengan rekan sejawat di seluruh Indonesia."
                badge="Alumni Ecosystem"
                icon="ri-team-line"
            />

            <!-- Filter Section -->
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                <form action="{{ route('alumni.directory') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    
                    <div class="flex-1 w-full">
                        <x-input-label for="search" :value="__('Cari Nama')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="ri-search-line"></i>
                            </div>
                            <x-text-input id="search" name="search" type="text" class="block w-full pl-10 bg-gray-50 border-transparent focus:bg-white" value="{{ request('search') }}" placeholder="Cari alumni..." />
                        </div>
                    </div>

                    <div class="w-full md:w-64">
                        <x-input-label for="skill" :value="__('Keahlian')" class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-2" />
                        <select id="skill" name="skill" class="block w-full border-gray-200 focus:border-iaspig-orange focus:ring-iaspig-orange rounded-2xl shadow-sm bg-gray-50 h-[42px]">
                            <option value="">Semua Keahlian</option>
                            @foreach($allSkills as $skill)
                                <option value="{{ $skill }}" {{ request('skill') == $skill ? 'selected' : '' }}>{{ $skill }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full md:w-auto flex items-center h-[42px] px-4 bg-iaspig-orange/5 rounded-2xl border border-iaspig-orange/10">
                        <label class="flex items-center gap-3 cursor-pointer h-full w-full">
                            <input type="checkbox" name="available" value="1" class="w-5 h-5 rounded-md text-iaspig-orange focus:ring-iaspig-orange border-iaspig-orange/30" {{ request('available') ? 'checked' : '' }}>
                            <span class="text-sm font-bold text-iaspig-brown uppercase whitespace-nowrap">Open for Collab</span>
                        </label>
                    </div>

                    <div class="w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-iaspig-brown text-white font-bold rounded-2xl hover:bg-iaspig-orange transition-colors h-[42px] flex items-center justify-center gap-2">
                            <i class="ri-filter-3-line"></i> Filter
                        </button>
                    </div>
                    
                    @if(request()->hasAny(['search', 'skill', 'available']))
                    <div class="w-full md:w-auto">
                        <a href="{{ route('alumni.directory') }}" class="w-full md:w-auto px-4 py-3 text-gray-500 font-bold hover:text-iaspig-orange transition-colors h-[42px] flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                    @endif
                </form>
            </div>

            <!-- Alumni Grid -->
            @if($alumnis->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($alumnis as $alumni)
                        <x-alumni.user-card :alumni="$alumni" />
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $alumnis->links() }}
                </div>
            @else
                <div class="bg-white p-12 rounded-[2rem] shadow-sm border border-gray-100 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                        <i class="ri-search-eye-line text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-iaspig-brown mb-2">Tidak Ada Data Ditemukan</h3>
                    <p class="text-gray-500">Coba sesuaikan filter pencarian Anda untuk menemukan hasil.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
