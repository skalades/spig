<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-iaspig.page-header 
            title="Admin Command Hub" 
            subtitle="Pusat kendali untuk moderasi konten, persetujuan bisnis, dan manajemen komunitas IASPIG."
            badge="Control Panel"
            icon="ri-shield-user-line"
        />
            
            <div class="flex bg-gray-100 p-1.5 rounded-2xl border border-gray-200">
                <button wire:click="$set('activeTab', 'reports')" class="px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ $activeTab === 'reports' ? 'bg-white shadow-sm text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                    Reports
                </button>
                <button wire:click="$set('activeTab', 'companies')" class="px-8 py-3 rounded-xl text-xs font-black uppercase tracking-widest transition-all {{ $activeTab === 'companies' ? 'bg-white shadow-sm text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                    Businesses
                </button>
            </div>
        </div>

        @if($activeTab === 'reports')
        <!-- Reports Section -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-black text-iaspig-brown">Moderasi Konten</h2>
            <div class="flex bg-gray-50 p-1 rounded-xl border border-gray-100">
                <button wire:click="$set('filterStatus', 'pending')" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all {{ $filterStatus === 'pending' ? 'bg-white shadow-sm text-iaspig-orange' : 'text-gray-400' }}">
                    Pending
                </button>
                <button wire:click="$set('filterStatus', 'reviewed')" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all {{ $filterStatus === 'reviewed' ? 'bg-white shadow-sm text-iaspig-orange' : 'text-gray-400' }}">
                    Reviewed
                </button>
            </div>
        </div>


        <div class="bg-white rounded-[3rem] shadow-2xl shadow-iaspig-brown/5 border border-gray-50 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Reporter</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Konten Terlapor</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Alasan</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Waktu</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($reports as $report)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-iaspig-orange flex items-center justify-center text-white font-bold">
                                        {{ substr($report->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-black text-iaspig-brown text-sm">{{ $report->user->name }}</div>
                                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alumni</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="max-w-xs">
                                    <span class="px-2 py-0.5 bg-iaspig-brown/5 text-iaspig-brown text-[9px] font-black uppercase tracking-widest rounded-md border border-iaspig-brown/10 mb-1 inline-block">
                                        {{ class_basename($report->reportable_type) }}
                                    </span>
                                    @if($report->reportable)
                                        <div class="text-sm font-medium text-gray-500 line-clamp-2 italic">
                                            "{{ Str::limit($report->reportable->content ?? $report->reportable->body ?? $report->reportable->title ?? 'Konten Multimedia', 60) }}"
                                        </div>
                                    @else
                                        <div class="text-sm font-medium text-red-400 italic">Konten telah dihapus.</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-bold text-iaspig-brown">{{ $report->reason }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $report->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($report->status === 'pending')
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="dismissReport({{ $report->id }})" class="p-3 rounded-xl bg-gray-50 text-gray-400 hover:bg-gray-100 hover:text-iaspig-brown transition-all" title="Abaikan Laporan">
                                            <i class="ri-close-line text-lg"></i>
                                        </button>
                                        <button wire:click="deleteReportedContent({{ $report->id }})" wire:confirm="Hapus konten ini secara permanen?" class="p-3 rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all shadow-sm" title="Hapus Konten">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-300">No Action Required</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="ri-shield-user-line text-6xl text-gray-200 mb-4"></i>
                                    <p class="text-xl font-black text-gray-300">Tidak ada laporan {{ $filterStatus }}</p>
                                    <p class="text-gray-400 text-sm mt-1 font-bold italic">Semua konten terlihat aman.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            @if($reports->hasPages())
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>
        @else
        <!-- Companies Section -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-black text-iaspig-brown">Persetujuan Bisnis</h2>
            <div class="flex bg-gray-50 p-1 rounded-xl border border-gray-100">
                <button wire:click="$set('filterCompanyStatus', 'pending')" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all {{ $filterCompanyStatus === 'pending' ? 'bg-white shadow-sm text-iaspig-orange' : 'text-gray-400' }}">
                    Pending
                </button>
                <button wire:click="$set('filterCompanyStatus', 'approved')" class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all {{ $filterCompanyStatus === 'approved' ? 'bg-white shadow-sm text-iaspig-orange' : 'text-gray-400' }}">
                    Approved
                </button>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-iaspig-brown/5 border border-gray-50 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Owner</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Nama Perusahaan</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Industri</th>
                        <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($pendingCompanies as $company)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="font-bold text-iaspig-brown">{{ $company->user->name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $company->user->email }}</div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden">
                                        @if($company->hasMedia('logos'))
                                            <img src="{{ $company->getFirstMediaUrl('logos', 'thumb') }}" class="w-full h-full object-contain">
                                        @else
                                            <span class="text-iaspig-orange font-black">{{ substr($company->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="font-black text-iaspig-brown">{{ $company->name }}</div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-iaspig-orange/10 text-iaspig-orange text-[10px] font-black uppercase tracking-widest rounded-lg">
                                    {{ $company->industry_type }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                @if($company->status === 'pending')
                                    <div class="flex justify-end gap-2">
                                        <button wire:click="rejectCompany({{ $company->id }})" class="px-4 py-2 rounded-xl bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                            Reject
                                        </button>
                                        <button wire:click="approveCompany({{ $company->id }})" class="px-4 py-2 rounded-xl bg-green-50 text-green-500 text-[10px] font-black uppercase tracking-widest hover:bg-green-500 hover:text-white transition-all">
                                            Approve
                                        </button>
                                    </div>
                                @else
                                    <span class="text-[10px] font-black uppercase tracking-widest text-green-500">Approved</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <p class="text-gray-400 font-bold italic">Tidak ada bisnis dalam antrean {{ $filterCompanyStatus }}.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if($pendingCompanies->hasPages())
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-100">
                    {{ $pendingCompanies->links() }}
                </div>
            @endif
        </div>
        @endif

    </div>
</div>
