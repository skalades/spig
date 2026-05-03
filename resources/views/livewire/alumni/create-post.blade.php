<div 
    class="bg-white rounded-[2rem] p-8 shadow-xl border border-gray-100"
    x-data="{
        compressing: false,
        originalSize: 0,
        compressedSize: 0,

        compressAndUpload(event) {
            const file = event.target.files[0];
            if (!file || !file.type.startsWith('image/')) return;

            this.compressing = true;
            this.originalSize = file.size;

            const maxDim = 1920;
            const quality = 0.85;

            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    let w = img.width, h = img.height;

                    if (w > maxDim || h > maxDim) {
                        const ratio = Math.min(maxDim / w, maxDim / h);
                        w = Math.round(w * ratio);
                        h = Math.round(h * ratio);
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = w;
                    canvas.height = h;
                    canvas.getContext('2d').drawImage(img, 0, 0, w, h);

                    canvas.toBlob((blob) => {
                        this.compressedSize = blob.size;
                        const compressed = new File(
                            [blob],
                            file.name.replace(/\.[^.]+$/, '.jpg'),
                            { type: 'image/jpeg', lastModified: Date.now() }
                        );

                        $wire.upload('photo', compressed,
                            () => { this.compressing = false; },
                            () => { this.compressing = false; }
                        );
                    }, 'image/jpeg', quality);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        formatSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / 1048576).toFixed(1) + ' MB';
        },

        savedPercent() {
            if (!this.originalSize || !this.compressedSize) return 0;
            return Math.round((1 - this.compressedSize / this.originalSize) * 100);
        }
    }"
>
    <div class="flex gap-4 items-start mb-6">
        <div class="w-12 h-12 rounded-full bg-iaspig-orange flex items-center justify-center text-white text-xl font-black shadow-lg">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
        <div class="flex-1">
            <textarea 
                wire:model="content"
                class="w-full border-none focus:ring-0 text-lg font-medium text-iaspig-brown placeholder-gray-300 resize-none min-h-[100px]"
                placeholder="Apa yang ingin Anda bagikan hari ini, {{ explode(' ', Auth::user()->name)[0] }}?"
            ></textarea>
        </div>
    </div>

    @error('content') <span class="text-red-500 text-xs font-bold mb-4 block">{{ $message }}</span> @enderror
    @error('photo') <span class="text-red-500 text-xs font-bold mb-4 block">{{ $message }}</span> @enderror

    {{-- Compression progress indicator --}}
    <div x-show="compressing" x-transition class="mb-6 p-4 bg-iaspig-orange/5 rounded-2xl border border-iaspig-orange/20">
        <div class="flex items-center gap-3">
            <div class="w-5 h-5 border-2 border-iaspig-orange border-t-transparent rounded-full animate-spin"></div>
            <span class="text-xs font-bold text-iaspig-brown">Mengompresi gambar...</span>
        </div>
    </div>

    {{-- Photo preview with compression stats --}}
    @if($photo)
        <div class="mb-6">
            <div class="relative w-32 h-32 rounded-2xl overflow-hidden group">
                <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                <button 
                    wire:click="$set('photo', null)"
                    class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity text-white"
                >
                    <i class="ri-close-circle-line text-2xl"></i>
                </button>
            </div>
            {{-- Compression stats badge --}}
            <div x-show="compressedSize > 0" x-transition class="mt-2 inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 rounded-xl">
                <i class="ri-leaf-line text-green-500 text-sm"></i>
                <span class="text-[10px] font-bold text-green-600">
                    <span x-text="formatSize(originalSize)"></span> → <span x-text="formatSize(compressedSize)"></span>
                    <span class="text-green-500 font-black">(-<span x-text="savedPercent()"></span>%)</span>
                </span>
            </div>
        </div>
    @endif

    @if(!empty($metadata) && isset($metadata['title']))
        <div class="bg-iaspig-brown/5 rounded-[2rem] p-6 border border-iaspig-brown/10 mb-6 flex gap-4 items-start relative group">
            @if(isset($metadata['image']))
                <div class="w-16 h-16 rounded-2xl overflow-hidden shadow-sm flex-shrink-0">
                    <img src="{{ $metadata['image'] }}" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-iaspig-brown text-2xl shadow-sm">
                    <i class="ri-link"></i>
                </div>
            @endif
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-black text-iaspig-brown truncate">{{ $metadata['title'] }}</h4>
                <p class="text-[10px] text-iaspig-brown/50 font-bold line-clamp-2">{{ $metadata['description'] ?? 'No description available' }}</p>
                <p class="text-[9px] text-iaspig-orange font-black mt-1 uppercase tracking-widest">{{ parse_url($metadata['url'], PHP_URL_HOST) }}</p>
            </div>
            <button 
                wire:click="$set('metadata', [])"
                class="absolute -top-2 -right-2 w-6 h-6 bg-white rounded-full shadow-md flex items-center justify-center text-red-500 opacity-0 group-hover:opacity-100 transition-opacity"
            >
                <i class="ri-close-line"></i>
            </button>
        </div>
    @endif

    <div class="flex items-center justify-between pt-6 border-t border-gray-50">
        <div class="flex gap-2">
            {{-- File input uses Alpine handler instead of wire:model for client-side compression --}}
            <input type="file" id="photo-upload" class="hidden" accept="image/*" @change="compressAndUpload($event)">
            <button 
                onclick="document.getElementById('photo-upload').click()"
                :disabled="compressing"
                class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-gray-400 hover:bg-iaspig-orange/10 hover:text-iaspig-orange transition-all group disabled:opacity-50"
            >
                <i class="ri-image-line text-lg"></i>
                <span class="text-[10px] font-black uppercase tracking-widest">Foto</span>
            </button>
            <button class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-xl text-gray-400 hover:bg-iaspig-brown/5 hover:text-iaspig-brown transition-all">
                <i class="ri-briefcase-line text-lg"></i>
                <span class="text-[10px] font-black uppercase tracking-widest">Loker</span>
            </button>
        </div>

        <button 
            wire:click="save"
            wire:loading.attr="disabled"
            :disabled="compressing"
            class="px-8 py-3 bg-iaspig-brown text-white rounded-2xl font-black shadow-lg hover:bg-iaspig-orange hover:-translate-y-1 transition-all duration-300 flex items-center gap-2 disabled:opacity-50 disabled:hover:translate-y-0"
        >
            <span wire:loading.remove>Bagikan</span>
            <span wire:loading>Memproses...</span>
            <i class="ri-send-plane-fill" wire:loading.remove></i>
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-50 text-green-600 rounded-2xl text-xs font-bold flex items-center gap-2 animate-pulse">
            <i class="ri-checkbox-circle-line text-lg"></i>
            {{ session('message') }}
        </div>
    @endif
</div>
