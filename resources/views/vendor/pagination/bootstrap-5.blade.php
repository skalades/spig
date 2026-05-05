@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center gap-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">
                <i class="ri-arrow-left-s-line text-lg"></i>
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-iaspig-brown hover:bg-iaspig-orange hover:text-white hover:border-iaspig-orange transition-all shadow-sm">
                <i class="ri-arrow-left-s-line text-lg"></i>
            </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="w-10 h-10 flex items-center justify-center text-gray-400 font-bold">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-10 h-10 rounded-xl bg-iaspig-brown border border-iaspig-brown flex items-center justify-center text-white font-black text-xs shadow-lg shadow-iaspig-brown/20">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-iaspig-brown font-black text-xs hover:bg-iaspig-orange hover:text-white hover:border-iaspig-orange transition-all shadow-sm">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-iaspig-brown hover:bg-iaspig-orange hover:text-white hover:border-iaspig-orange transition-all shadow-sm">
                <i class="ri-arrow-right-s-line text-lg"></i>
            </button>
        @else
            <span class="w-10 h-10 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center text-gray-300 cursor-not-allowed">
                <i class="ri-arrow-right-s-line text-lg"></i>
            </span>
        @endif
    </nav>
@endif
