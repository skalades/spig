<div class="py-12">
    <div class="max-w-5xl mx-auto px-4">
        <a href="{{ route('alumni.jobs.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-iaspig-orange transition-colors mb-8 font-bold uppercase tracking-widest text-xs">
            <i class="ri-arrow-left-line"></i> Kembali ke Job Board
        </a>

        <div class="bg-white rounded-[3rem] p-10 md:p-16 shadow-2xl shadow-iaspig-brown/5 border border-gray-50 relative overflow-hidden">
            <!-- Header Section -->
            <div class="flex flex-col md:flex-row gap-8 mb-12 items-start relative z-10">
                <div class="w-32 h-32 rounded-[2rem] bg-gray-50 flex-shrink-0 flex items-center justify-center overflow-hidden border border-gray-100 p-4 shadow-inner">
                    @if($job->company && $job->company->hasMedia('logos'))
                        <img src="{{ $job->company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                    @else
                        <div class="w-full h-full bg-iaspig-orange/10 flex items-center justify-center text-iaspig-orange text-4xl font-black rounded-xl">
                            {{ substr($job->company->name ?? $job->user->name, 0, 1) }}
                        </div>
                    @endif
                </div>

                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="px-4 py-1.5 bg-iaspig-orange/10 text-iaspig-orange text-[10px] font-black uppercase tracking-widest rounded-xl">
                            {{ $job->job_type }}
                        </span>
                        @if($job->status === 'open')
                            <span class="px-4 py-1.5 bg-green-50 text-green-500 text-[10px] font-black uppercase tracking-widest rounded-xl flex items-center gap-1">
                                <i class="ri-checkbox-circle-fill"></i> Dibuka
                            </span>
                        @else
                            <span class="px-4 py-1.5 bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-xl flex items-center gap-1">
                                <i class="ri-close-circle-fill"></i> Ditutup
                            </span>
                        @endif
                    </div>

                    <h1 class="text-4xl md:text-5xl font-black text-iaspig-brown mb-4 leading-tight">{{ $job->title }}</h1>
                    
                    <div class="flex flex-wrap gap-6 text-sm font-bold text-gray-400">
                        <div class="flex items-center gap-2">
                            <i class="ri-building-4-line text-iaspig-orange text-lg"></i>
                            <span class="text-iaspig-brown">{{ $job->company->name ?? 'Individu: ' . $job->user->name }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ri-map-pin-line text-iaspig-orange text-lg"></i>
                            {{ $job->location ?? 'Remote' }}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ri-money-dollar-circle-line text-iaspig-orange text-lg"></i>
                            {{ $job->salary_range ?? 'Gaji Kompetitif' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-px bg-gray-100 w-full my-12"></div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 relative z-10">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-12">
                    <div>
                        <h3 class="text-2xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                            <i class="ri-file-text-line text-iaspig-orange"></i> Deskripsi Pekerjaan
                        </h3>
                        <div class="text-gray-500 font-medium leading-relaxed whitespace-pre-line text-lg">
                            {{ $job->description }}
                        </div>
                    </div>

                    @if($job->requirements)
                    <div>
                        <h3 class="text-2xl font-black text-iaspig-brown mb-6 flex items-center gap-3">
                            <i class="ri-checkbox-multiple-line text-iaspig-orange"></i> Persyaratan
                        </h3>
                        <div class="text-gray-500 font-medium leading-relaxed whitespace-pre-line text-lg bg-gray-50 p-8 rounded-3xl border border-gray-100">
                            {{ $job->requirements }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Action Card -->
                    <div class="bg-iaspig-brown text-white p-8 rounded-[2rem] shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 text-white/5">
                            <i class="ri-briefcase-line text-[150px]"></i>
                        </div>
                        <div class="relative z-10">
                            <h4 class="text-xl font-black mb-6">Tertarik dengan posisi ini?</h4>
                            
                            @if($job->company && $job->company->whatsapp_number)
                                <a href="https://wa.me/{{ $job->company->whatsapp_number }}?text=Halo%20saya%20tertarik%20dengan%20lowongan%20{{ $job->title }}%20yang%20diposting%20di%20IASPIG%20Career%20Hub" target="_blank" class="w-full bg-green-500 hover:bg-green-600 text-white py-4 rounded-xl font-black text-sm uppercase tracking-widest text-center transition-colors mb-4 flex items-center justify-center gap-2">
                                    <i class="ri-whatsapp-line text-xl"></i> Hubungi via WhatsApp
                                </a>
                            @endif

                            @if($job->company && $job->company->email)
                                <a href="mailto:{{ $job->company->email }}?subject=Lamaran%20Kerja:%20{{ $job->title }}" class="w-full bg-white text-iaspig-brown hover:bg-gray-50 py-4 rounded-xl font-black text-sm uppercase tracking-widest text-center transition-colors flex items-center justify-center gap-2">
                                    <i class="ri-mail-send-line text-xl text-iaspig-orange"></i> Kirim Email Lamaran
                                </a>
                            @else
                                <a href="mailto:{{ $job->user->email }}?subject=Lamaran%20Kerja:%20{{ $job->title }}" class="w-full bg-white text-iaspig-brown hover:bg-gray-50 py-4 rounded-xl font-black text-sm uppercase tracking-widest text-center transition-colors flex items-center justify-center gap-2">
                                    <i class="ri-mail-send-line text-xl text-iaspig-orange"></i> Kirim Email Lamaran
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100">
                        <h4 class="text-lg font-black text-iaspig-brown mb-6">Informasi Tambahan</h4>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="ri-calendar-event-line text-gray-400 mt-1"></i>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Diposting Pada</p>
                                    <p class="text-sm font-bold text-iaspig-brown">{{ $job->created_at->format('d M Y') }}</p>
                                </div>
                            </li>
                            @if($job->deadline)
                            <li class="flex items-start gap-3">
                                <i class="ri-timer-line text-iaspig-orange mt-1"></i>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-widest text-iaspig-orange">Batas Waktu</p>
                                    <p class="text-sm font-bold text-iaspig-brown">{{ $job->deadline->format('d M Y') }}</p>
                                    @if($job->deadline->isFuture())
                                        <p class="text-xs text-gray-500">{{ now()->diffInDays($job->deadline) }} hari lagi</p>
                                    @endif
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                    
                    <button 
                        @click="$dispatch('openReportModal', { id: '{{ $job->id }}', type: 'App\\Models\\JobPost' })"
                        class="w-full text-center text-xs font-bold text-gray-400 hover:text-red-500 uppercase tracking-widest transition-colors flex items-center justify-center gap-2"
                    >
                        <i class="ri-flag-line"></i> Laporkan Lowongan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
