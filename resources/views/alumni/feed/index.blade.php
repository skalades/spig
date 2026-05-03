<x-app-layout>
    <div class="pb-24 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <x-iaspig.page-header 
                title="Community Feed" 
                subtitle="Berbagi informasi, lowongan, dan perkembangan terbaru di jejaring profesional IASPIG."
                badge="Social Networking"
                icon="ri-chat-smile-3-line"
            />

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Feed Section -->
                <div class="lg:col-span-8 space-y-8">
                    <!-- Create Post Livewire -->
                    @livewire('alumni.create-post')

                    <!-- Feed Livewire -->
                    @livewire('alumni.feed')
                </div>

                <!-- Sidebar Section -->
                <div class="lg:col-span-4 space-y-10">
                    <!-- Verified Alumni Badge -->
                    <div class="bg-iaspig-brown rounded-[2rem] p-8 text-white relative overflow-hidden shadow-2xl">
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-iaspig-orange rounded-full blur-[80px] opacity-30"></div>
                        <div class="relative z-10 text-center">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <i class="ri-shield-check-fill text-3xl text-iaspig-orange"></i>
                            </div>
                            <h3 class="text-xl font-black mb-2">Eksklusif Terverifikasi</h3>
                            <p class="text-white/60 text-sm font-medium leading-relaxed">
                                Ruang ini hanya dapat diakses oleh alumni yang telah diverifikasi oleh pengurus IASPIG.
                            </p>
                        </div>
                    </div>

                    <!-- Trending/Recommended Alumni -->
                    @livewire('alumni.recommended-alumni')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
