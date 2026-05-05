@props(['post'])

<div class="bg-white rounded-[2rem] p-8 shadow-xl border border-gray-100 group transition-all duration-300 hover:shadow-2xl hover:shadow-iaspig-brown/5">
    <!-- Post Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div class="w-14 h-14 rounded-full bg-iaspig-orange flex items-center justify-center text-white text-xl font-black shadow-lg shadow-iaspig-orange/30 overflow-hidden">
                    @if($post->user->alumniProfile && $post->user->alumniProfile->photo)
                        <img src="{{ asset('storage/' . $post->user->alumniProfile->photo) }}" alt="Photo" class="w-full h-full object-cover">
                    @else
                        {{ substr($post->user->name, 0, 1) }}
                    @endif
                </div>
                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-md">
                    <i class="ri-shield-check-fill text-iaspig-orange text-xs"></i>
                </div>
            </div>
            <div>
                <div class="font-black text-iaspig-brown text-lg leading-tight hover:text-iaspig-orange transition-colors cursor-pointer">
                    {{ $post->user->name }}
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md">
                        Angkatan {{ $post->user->alumniProfile->class_year ?? '?' }}
                    </span>
                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                    <span class="text-[10px] font-bold text-gray-400">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="w-10 h-10 rounded-xl flex items-center justify-center text-gray-300 hover:bg-gray-50 hover:text-iaspig-brown transition-all">
                <i class="ri-more-2-line text-xl"></i>
            </button>
            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 py-2">
                <button 
                    @click="
                        if (navigator.share) {
                            navigator.share({
                                title: 'Postingan {{ $post->user->name }}',
                                text: '{{ Str::limit($post->content, 100) }}',
                                url: '{{ url('/alumni/feed?post=' . $post->id) }}'
                            }).catch(err => console.log('Error sharing:', err));
                        } else {
                            navigator.clipboard.writeText('{{ url('/alumni/feed?post=' . $post->id) }}');
                            $dispatch('notify', { message: 'Link disalin ke clipboard!', type: 'success' });
                        }
                        open = false;
                    "
                    class="w-full text-left px-6 py-3 text-sm font-bold text-iaspig-brown hover:bg-gray-50 flex items-center gap-3"
                >
                    <i class="ri-share-forward-line"></i> Bagikan
                </button>
                <button 
                    @click="
                        $dispatch('openReportModal', { id: '{{ $post->id }}', type: 'App\\Models\\Post' });
                        open = false;
                    "
                    class="w-full text-left px-6 py-3 text-sm font-bold text-gray-400 hover:bg-red-50 hover:text-red-500 flex items-center gap-3"
                >
                    <i class="ri-flag-line"></i> Laporkan
                </button>
                @can('delete', $post)
                <button 
                    wire:click="deletePost('{{ $post->id }}')"
                    wire:confirm="Apakah Anda yakin ingin menghapus postingan ini?"
                    class="w-full text-left px-6 py-3 text-sm font-bold text-red-500 hover:bg-red-50 flex items-center gap-3"
                >
                    <i class="ri-delete-bin-line"></i> Hapus Post
                </button>
                @endcan
            </div>
        </div>
    </div>

    <!-- Post Content -->
    <div class="text-iaspig-brown/80 font-medium leading-relaxed mb-6 whitespace-pre-line">
        {{ $post->content }}
    </div>

    <!-- Multi-Image Grid -->
    @if($post->type === 'photo')
        <div class="rounded-3xl overflow-hidden mb-6 border border-gray-100 bg-gray-50">
            @if($post->hasMedia('posts'))
                <img 
                    src="{{ $post->getFirstMediaUrl('posts', 'optimized') }}" 
                    alt="Post Image" 
                    class="w-full h-auto object-cover max-h-[600px]"
                    loading="lazy"
                >
            @else
                <div class="py-20 flex flex-col items-center justify-center text-gray-300">
                    <i class="ri-image-2-line text-5xl mb-2"></i>
                    <p class="text-xs font-bold uppercase tracking-widest">Gambar tidak ditemukan</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Job / Link Preview -->
    @if($post->type === 'job' && !empty($post->metadata))
        <a href="{{ $post->metadata['url'] }}" target="_blank" class="block bg-iaspig-brown/5 rounded-[2rem] p-6 border border-iaspig-brown/10 mb-6 group/job hover:bg-iaspig-brown/10 transition-colors cursor-pointer">
            <div class="flex gap-4 items-start">
                @if(isset($post->metadata['image']))
                    <div class="w-20 h-20 rounded-2xl overflow-hidden shadow-sm flex-shrink-0">
                        <img src="{{ $post->metadata['image'] }}" class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-iaspig-brown text-2xl shadow-sm">
                        <i class="ri-briefcase-line"></i>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="text-[10px] font-black text-iaspig-orange uppercase tracking-widest mb-1">Link Tersemat</div>
                    <h4 class="text-lg font-black text-iaspig-brown group-hover/job:text-iaspig-orange transition-colors truncate">{{ $post->metadata['title'] ?? 'Untitled' }}</h4>
                    <p class="text-sm text-iaspig-brown/50 font-bold mb-3 line-clamp-2">{{ $post->metadata['description'] ?? '' }}</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-white rounded-lg text-[9px] font-black uppercase text-gray-400">{{ parse_url($post->metadata['url'], PHP_URL_HOST) }}</span>
                    </div>
                </div>
            </div>
        </a>
    @endif

    <!-- Post Footer / Interactions -->
    <div class="flex items-center justify-between pt-6 border-t border-gray-50">
        <div class="flex items-center gap-6">
            @livewire('alumni.like-button', ['post' => $post], key('like-'.$post->id))
            @livewire('alumni.comment-section', ['post' => $post], key('comment-'.$post->id))
        </div>
        
        <button 
            @click="
                if (navigator.share) {
                    navigator.share({
                        title: 'Postingan {{ $post->user->name }}',
                        text: '{{ Str::limit($post->content, 100) }}',
                        url: '{{ url('/alumni/feed?post=' . $post->id) }}'
                    }).catch(err => console.log('Error sharing:', err));
                } else {
                    navigator.clipboard.writeText('{{ url('/alumni/feed?post=' . $post->id) }}');
                    $dispatch('notify', { message: 'Link disalin ke clipboard!', type: 'success' });
                }
            "
            class="w-10 h-10 rounded-full flex items-center justify-center text-gray-300 hover:bg-iaspig-orange/10 hover:text-iaspig-orange transition-all"
        >
            <i class="ri-share-forward-line text-xl"></i>
        </button>
    </div>
</div>
