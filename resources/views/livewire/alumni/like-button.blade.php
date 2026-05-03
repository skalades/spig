<button 
    wire:click="toggleLike" 
    class="flex items-center gap-2 group/like transition-all"
>
    <div class="w-10 h-10 rounded-full flex items-center justify-center transition-all {{ $isLiked ? 'bg-iaspig-orange text-white shadow-lg shadow-iaspig-orange/30' : 'text-gray-300 group-hover/like:bg-iaspig-orange/10 group-hover/like:text-iaspig-orange' }}">
        <i class="{{ $isLiked ? 'ri-heart-fill' : 'ri-heart-line' }} text-xl"></i>
    </div>
    <span class="text-sm font-black {{ $isLiked ? 'text-iaspig-orange' : 'text-gray-400 group-hover/like:text-iaspig-orange' }}">
        {{ $likesCount }}
    </span>
</button>
