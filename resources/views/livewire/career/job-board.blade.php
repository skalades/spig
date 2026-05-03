<div class="py-12">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header Section -->
        <x-iaspig.page-header 
            title="Career Hub" 
            subtitle="Membangun karir bersama alumni Geodesi & Geomatika. Temukan peluang terbaik di industri surveying dan spasial."
            badge="Professional Network"
            icon="ri-briefcase-line"
        />

        <!-- Search & Filter -->
        <div class="bg-white rounded-[3rem] p-4 shadow-2xl shadow-iaspig-brown/5 border border-gray-50 flex flex-col md:flex-row gap-4 mb-12">
            <div class="relative flex-1">
                <i class="ri-search-line absolute left-6 top-1/2 -translate-y-1/2 text-gray-300"></i>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Posisi, perusahaan, atau lokasi..." class="w-full border-none bg-transparent pl-14 pr-6 py-4 focus:ring-0 font-bold text-iaspig-brown">
            </div>
            <div class="w-full md:w-56">
                <x-iaspig.custom-select 
                    wire:model.live="type" 
                    placeholder="Semua Tipe"
                    :options="[
                        ['value' => '', 'label' => 'Semua Tipe'],
                        ['value' => 'Full-time', 'label' => 'Full-time'],
                        ['value' => 'Contract', 'label' => 'Contract'],
                        ['value' => 'Freelance', 'label' => 'Freelance'],
                        ['value' => 'Internship', 'label' => 'Internship'],
                    ]"
                />
            </div>
            <a href="{{ route('alumni.jobs.create') }}" class="bg-iaspig-orange text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:scale-105 transition-all flex items-center justify-center gap-2">
                <i class="ri-add-line text-lg"></i> Post Job
            </a>
        </div>

        <!-- Job List -->
        <div class="space-y-6">
            @forelse($jobs as $job)
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-gray-50 group hover:border-iaspig-orange/20 transition-all duration-300">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Company Logo -->
                        <div class="w-20 h-20 rounded-3xl bg-gray-50 flex-shrink-0 flex items-center justify-center overflow-hidden border border-gray-100 p-2">
                            @if($job->company && $job->company->hasMedia('logos'))
                                <img src="{{ $job->company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full bg-iaspig-orange/10 flex items-center justify-center text-iaspig-orange text-2xl font-black">
                                    {{ substr($job->company->name ?? $job->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-2">
                                <span class="px-3 py-1 bg-iaspig-orange/10 text-iaspig-orange text-[9px] font-black uppercase tracking-widest rounded-lg">
                                    {{ $job->job_type }}
                                </span>
                                @if($job->deadline && $job->deadline->isFuture())
                                    <span class="text-[10px] font-bold text-green-500 flex items-center gap-1">
                                        <i class="ri-time-line"></i> Aktif sampai {{ $job->deadline->format('d M') }}
                                    </span>
                                @endif
                            </div>
                            
                            <h3 class="text-2xl font-black text-iaspig-brown mb-1 group-hover:text-iaspig-orange transition-colors">
                                {{ $job->title }}
                            </h3>
                            <p class="text-sm font-bold text-gray-400 mb-4">
                                {{ $job->company->name ?? 'Posted by ' . $job->user->name }} • {{ $job->location ?? 'Remote / N/A' }}
                            </p>

                            <div class="flex flex-wrap gap-4 items-center justify-between mt-auto">
                                <div class="flex items-center gap-4 text-xs font-bold text-iaspig-brown/60">
                                    <div class="flex items-center gap-1">
                                        <i class="ri-money-dollar-circle-line"></i>
                                        {{ $job->salary_range ?? 'Kompetitif' }}
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <i class="ri-history-line"></i>
                                        {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                
                                <div class="flex gap-2">
                                    <a href="{{ route('alumni.jobs.show', $job->slug) }}" class="px-6 py-3 rounded-xl bg-gray-50 text-iaspig-brown text-xs font-black uppercase tracking-widest hover:bg-gray-100 transition-all">
                                        Detail
                                    </a>
                                    <a href="{{ route('alumni.jobs.show', $job->slug) }}" class="px-6 py-3 rounded-xl bg-iaspig-brown text-white text-xs font-black uppercase tracking-widest hover:bg-iaspig-orange transition-all shadow-lg shadow-iaspig-brown/20">
                                        Lamar Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200">
                    <i class="ri-briefcase-line text-6xl text-gray-300 mb-4"></i>
                    <h4 class="text-xl font-black text-gray-400">Belum ada lowongan kerja</h4>
                    <p class="text-gray-400 text-sm">Jadilah yang pertama berbagi peluang di sini!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
