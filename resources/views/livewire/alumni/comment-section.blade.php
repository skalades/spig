<div>
    <button 
        wire:click="toggleComments"
        class="flex items-center gap-2 group/comment transition-all"
    >
        <div class="w-10 h-10 rounded-full flex items-center justify-center text-gray-300 group-hover/comment:bg-iaspig-brown/5 group-hover/comment:text-iaspig-brown transition-all">
            <i class="ri-chat-3-line text-xl"></i>
        </div>
        <span class="text-sm font-black text-gray-400 group-hover/comment:text-iaspig-brown">{{ $post->comments->count() }}</span>
    </button>

    @if($showComments)
        <div class="mt-6 pt-6 border-t border-gray-50 space-y-6 animate-in slide-in-from-top-4 duration-300">
            <!-- Comment Form -->
            <div class="flex gap-4 items-start bg-gray-50/50 p-4 rounded-[2rem] border border-gray-100">
                <div class="w-10 h-10 rounded-full bg-iaspig-orange flex items-center justify-center text-white text-sm font-black shadow-md flex-shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    @if($replyingToId)
                        <div class="flex items-center justify-between mb-2 px-2">
                            <span class="text-[10px] font-black text-iaspig-orange uppercase tracking-widest">Membalas komentar...</span>
                            <button wire:click="cancelReply" class="text-[10px] font-bold text-red-500 hover:underline">Batal</button>
                        </div>
                    @endif
                    <div class="relative">
                        <textarea 
                            wire:model="body"
                            rows="1"
                            placeholder="Tulis komentar..." 
                            class="w-full bg-white border-none rounded-2xl px-6 py-3 text-sm font-medium focus:ring-2 focus:ring-iaspig-orange/20 transition-all resize-none overflow-hidden"
                            x-data="{ 
                                resize() { 
                                    $el.style.height = '0px'; 
                                    $el.style.height = $el.scrollHeight + 'px' 
                                } 
                            }"
                            x-init="resize()"
                            @input="resize()"
                        ></textarea>
                        <button 
                            wire:click="save"
                            class="absolute right-2 bottom-2 w-8 h-8 rounded-xl bg-iaspig-brown text-white flex items-center justify-center hover:bg-iaspig-orange transition-colors"
                        >
                            <i class="ri-send-plane-fill text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Comments List -->
            <div class="space-y-6 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($comments as $comment)
                    <div class="space-y-4">
                        <!-- Main Comment -->
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 rounded-full bg-iaspig-brown/5 flex items-center justify-center text-iaspig-brown text-sm font-black flex-shrink-0">
                                @if($comment->user->alumniProfile && $comment->user->alumniProfile->photo)
                                    <img src="{{ asset('storage/' . $comment->user->alumniProfile->photo) }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    {{ substr($comment->user->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 rounded-2xl p-4 mb-2">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-black text-iaspig-brown">{{ $comment->user->name }}</span>
                                        <span class="text-[10px] font-bold text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-iaspig-brown/70 font-medium leading-relaxed">
                                        {{ $comment->body }}
                                    </p>
                                </div>
                                <button 
                                    wire:click="setReply({{ $comment->id }})"
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-iaspig-orange ml-4 transition-colors"
                                >
                                    Balas
                                </button>
                                <button 
                                    @click="$dispatch('openReportModal', { id: '{{ $comment->id }}', type: 'App\\Models\\Comment' })"
                                    class="text-[10px] font-black uppercase tracking-widest text-gray-300 hover:text-red-400 ml-4 transition-colors"
                                    title="Laporkan Komentar"
                                >
                                    <i class="ri-flag-line"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Replies -->
                        @if($comment->replies->count() > 0)
                            <div class="ml-14 space-y-4 border-l-2 border-gray-50 pl-4">
                                @foreach($comment->replies as $reply)
                                    <div class="flex gap-3 items-start">
                                        <div class="w-8 h-8 rounded-full bg-iaspig-brown/5 flex items-center justify-center text-iaspig-brown text-[10px] font-black flex-shrink-0">
                                            @if($reply->user->alumniProfile && $reply->user->alumniProfile->photo)
                                                <img src="{{ asset('storage/' . $reply->user->alumniProfile->photo) }}" class="w-full h-full rounded-full object-cover">
                                            @else
                                                {{ substr($reply->user->name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div class="flex-1 bg-gray-50/50 rounded-2xl p-3 border border-gray-50">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="text-[10px] font-black text-iaspig-brown">{{ $reply->user->name }}</span>
                                                <span class="text-[8px] font-bold text-gray-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="flex justify-between items-center mt-2 px-1">
                                                <p class="text-xs text-iaspig-brown/70 font-medium leading-relaxed">
                                                    {{ $reply->body }}
                                                </p>
                                                <button 
                                                    @click="$dispatch('openReportModal', { id: '{{ $reply->id }}', type: 'App\\Models\\Comment' })"
                                                    class="text-[10px] text-gray-300 hover:text-red-400 transition-colors"
                                                    title="Laporkan Balasan"
                                                >
                                                    <i class="ri-flag-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach

                @if($comments->isEmpty())
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-200">
                            <i class="ri-chat-smile-2-line text-3xl"></i>
                        </div>
                        <div class="text-gray-300 font-bold text-xs uppercase tracking-widest">
                            Belum ada komentar
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
