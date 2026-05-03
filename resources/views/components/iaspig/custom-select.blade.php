@props([
    'model',
    'options' => [],
    'placeholder' => 'Pilih opsi...',
    'label' => null,
])

<div 
    x-data="{ 
        open: false, 
        value: @entangle($attributes->wire('model')),
        label: '{{ $placeholder }}',
        options: {{ json_encode($options) }},
        init() {
            this.updateLabel();
            this.$watch('value', () => this.updateLabel());
        },
        updateLabel() {
            const selected = this.options.find(opt => opt.value == this.value);
            this.label = selected ? selected.label : '{{ $placeholder }}';
        },
        select(val) {
            this.value = val;
            this.open = false;
        }
    }" 
    class="relative w-full"
>
    @if($label)
        <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4 mb-2 block">{{ $label }}</label>
    @endif

    <button 
        @click="open = !open" 
        type="button"
        class="w-full bg-white border-none rounded-[2rem] px-8 py-6 shadow-xl shadow-iaspig-brown/5 focus:ring-2 focus:ring-iaspig-orange font-bold text-iaspig-brown transition-all flex items-center justify-between group"
        :class="{ 'ring-2 ring-iaspig-orange': open }"
    >
        <span x-text="label" :class="{ 'text-gray-400': !value }"></span>
        <i class="ri-arrow-down-s-line text-xl text-gray-300 group-hover:text-iaspig-orange transition-colors" :class="{ 'rotate-180': open }"></i>
    </button>

    <div 
        x-show="open" 
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="absolute z-50 w-full mt-4 bg-white rounded-[2rem] shadow-2xl border border-gray-50 overflow-hidden py-2"
    >
        <template x-for="option in options" :key="option.value">
            <button 
                @click="select(option.value)" 
                type="button"
                class="w-full text-left px-8 py-4 text-sm font-bold transition-all hover:bg-iaspig-orange/5 flex items-center justify-between group"
                :class="{ 'bg-iaspig-orange/10 text-iaspig-orange': value == option.value, 'text-iaspig-brown': value != option.value }"
            >
                <span x-text="option.label"></span>
                <i x-show="value == option.value" class="ri-check-line text-iaspig-orange"></i>
            </button>
        </template>
    </div>
</div>
