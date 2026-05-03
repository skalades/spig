<div class="space-y-8" wire:poll.30s="checkNewPosts">
    @if($hasNewPosts)
        <button 
            wire:click="refreshFeed"
            class="w-full py-4 bg-iaspig-orange text-white font-black text-xs uppercase tracking-widest rounded-2xl shadow-lg shadow-iaspig-orange/30 animate-bounce mb-8"
        >
            🚀 Postingan Baru Tersedia - Klik untuk Refresh
        </button>
    @endif
    @foreach($posts as $post)
        <x-alumni.post-card :post="$post" wire:key="post-{{ $post->id }}" />
    @endforeach

    @if($posts->hasMorePages())
        <div 
            x-data="{
                observe() {
                    let observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.loadMore()
                            }
                        })
                    }, {
                        rootMargin: '200px'
                    })
                    observer.observe(this.$el)
                }
            }"
            x-init="observe()"
            class="py-10 flex justify-center"
        >
            <div class="flex items-center gap-2 text-iaspig-orange font-black text-[10px] uppercase tracking-widest">
                <span class="w-2 h-2 bg-iaspig-orange rounded-full animate-ping"></span>
                Memuat postingan lainnya...
            </div>
        </div>
    @else
        <div class="py-10 text-center text-gray-300 font-bold text-xs">
            ✨ Anda telah mencapai ujung feed.
        </div>
    @endif
</div>
