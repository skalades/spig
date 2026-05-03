<div>
    @if($isOpen)
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-iaspig-brown/60 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="close"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-[3rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                    <div class="bg-white p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">
                                <i class="ri-error-warning-line text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-iaspig-brown leading-tight">Laporkan Konten</h3>
                                <p class="text-xs font-bold text-gray-400">Bantu kami menjaga komunitas tetap aman.</p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 ml-4">Alasan Pelaporan</label>
                                <textarea 
                                    wire:model="reason" 
                                    rows="4" 
                                    placeholder="Jelaskan mengapa konten ini melanggar pedoman komunitas..."
                                    class="w-full bg-gray-50 border-none rounded-3xl px-6 py-4 focus:ring-2 focus:ring-red-500 font-bold text-iaspig-brown transition-all"
                                ></textarea>
                                @error('reason') <span class="text-red-500 text-[10px] font-bold ml-4">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-10 flex flex-col sm:flex-row-reverse gap-4">
                        <button 
                            type="button" 
                            wire:click="submit"
                            class="w-full sm:w-auto bg-red-500 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-red-500/30 hover:scale-105 transition-all"
                        >
                            Kirim Laporan
                        </button>
                        <button 
                            type="button" 
                            wire:click="close"
                            class="w-full sm:w-auto bg-white text-gray-400 px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest border border-gray-100 hover:bg-gray-50 transition-all"
                        >
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
