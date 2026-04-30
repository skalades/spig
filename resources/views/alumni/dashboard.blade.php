<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-secondary leading-tight">
            {{ __('Alumni Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-primary mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-secondary mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-gray-600">Terima kasih telah bergabung dengan IASPIG. Mari lengkapi profil Anda untuk mulai berjejaring.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profile Status Card -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-secondary">Status Profil</h4>
                        @if(Auth::user()->is_verified)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Terverifikasi</span>
                        @else
                            <span class="px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded-full">Menunggu Verifikasi</span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex-shrink-0"></div>
                        <div>
                            <p class="font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <a href="#" class="mt-6 block text-center py-2 px-4 bg-primary text-white rounded-md hover:bg-opacity-90 transition font-semibold">Lengkapi Profil</a>
                </div>

                <!-- Map Preview Card -->
                <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h4 class="font-bold text-secondary mb-4">Peta Sebaran Alumni</h4>
                    <div id="map-preview" class="h-48 bg-gray-50 rounded-md border border-dashed border-gray-300 flex items-center justify-center">
                        <div class="text-center">
                            <i class="ri-map-pin-line text-4xl text-primary mb-2"></i>
                            <p class="text-gray-500">Peta interaktif akan muncul di sini</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-sm text-gray-500">Lihat di mana teman-teman sejawatmu berada.</p>
                        <a href="#" class="text-primary font-semibold hover:underline text-sm">Buka Peta Penuh</a>
                    </div>
                </div>

                <!-- Stats/Activity Card -->
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h4 class="font-bold text-secondary mb-4">Aktivitas Terbaru</h4>
                    <ul class="space-y-4">
                        <li class="flex space-x-3">
                            <div class="w-2 h-2 bg-primary rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm">Selamat bergabung di IASPIG!</p>
                                <p class="text-xs text-gray-400">Baru saja</p>
                            </div>
                        </li>
                    </ul>
                </div>

                 <!-- Projects Card -->
                 <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h4 class="font-bold text-secondary mb-4">Proyek Portfolio</h4>
                    <div class="text-center py-4">
                        <p class="text-sm text-gray-500 mb-4">Belum ada proyek yang ditambahkan.</p>
                        <button class="text-sm font-semibold text-primary border border-primary px-4 py-2 rounded-md hover:bg-primary hover:text-white transition">+ Tambah Proyek</button>
                    </div>
                </div>

                 <!-- Networking Card -->
                 <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                    <h4 class="font-bold text-secondary mb-4">Kolaborasi</h4>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm">Status Ketersediaan</span>
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full italic">Off</span>
                    </div>
                    <p class="text-xs text-gray-400 mb-4">Aktifkan status "Open for Collab" agar alumni lain bisa mengajak kerja sama.</p>
                    <button class="w-full py-2 bg-secondary text-white rounded-md text-sm font-semibold hover:bg-opacity-90">Atur Kolaborasi</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
