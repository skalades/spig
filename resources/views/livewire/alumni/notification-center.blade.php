<div class="relative" x-data="{ open: false }" wire:poll.30s="refreshNotifications">
    <button 
        @click="open = !open" 
        class="relative w-10 h-10 rounded-xl flex items-center justify-center text-iaspig-brown hover:bg-iaspig-brown/5 transition-all"
    >
        <i class="ri-notification-3-fill text-xl"></i>
        @if($unreadCount > 0)
            <span class="absolute top-2 right-2 w-2 h-2 bg-iaspig-orange rounded-full animate-ping"></span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-iaspig-orange rounded-full"></span>
        @endif
    </button>

    <div 
        x-show="open" 
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="absolute right-0 mt-2 w-80 bg-white rounded-[2rem] shadow-2xl border border-gray-100 z-50 overflow-hidden"
    >
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-black text-iaspig-brown">Notifikasi</h3>
            @if($unreadCount > 0)
                <button wire:click="markAllAsRead" class="text-[10px] font-bold text-iaspig-orange uppercase tracking-widest hover:underline">Tandai semua dibaca</button>
            @endif
        </div>

        <div class="max-h-[400px] overflow-y-auto custom-scrollbar">
            @forelse($notifications as $notification)
                <div 
                    wire:click="markAsRead('{{ $notification->id }}')"
                    class="p-4 border-b border-gray-50 flex gap-4 hover:bg-gray-50 cursor-pointer transition-colors {{ $notification->read_at ? 'opacity-60' : 'bg-iaspig-orange/5' }}"
                >
                    <div class="w-10 h-10 rounded-full bg-iaspig-orange/10 flex items-center justify-center text-iaspig-orange flex-shrink-0">
                        <i class="{{ $notification->data['icon'] ?? 'ri-notification-3-line' }} text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-iaspig-brown leading-relaxed">
                            {!! $notification->data['message'] !!}
                        </p>
                        <span class="text-[10px] font-medium text-gray-400 mt-1 block">
                            {{ $notification->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-200">
                        <i class="ri-notification-off-line text-3xl"></i>
                    </div>
                    <p class="text-gray-300 font-bold text-xs uppercase tracking-widest">Belum ada notifikasi</p>
                </div>
            @endforelse
        </div>

        @if($notifications->isNotEmpty())
            <a href="#" class="block p-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-iaspig-orange transition-colors">
                Lihat Semua Notifikasi
            </a>
        @endif
    </div>
</div>
