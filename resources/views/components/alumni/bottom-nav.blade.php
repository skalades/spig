<nav class="fixed bottom-0 left-0 right-0 z-50 lg:hidden bg-white/80 backdrop-blur-xl border-t border-gray-100 px-6 py-3 shadow-[0_-5px_20px_rgba(0,0,0,0.05)] rounded-t-[2rem]">
    <div class="flex justify-between items-center max-w-md mx-auto">
        <!-- Dashboard / Home -->
        <a href="{{ route('alumni.dashboard') }}" 
           class="flex flex-col items-center gap-1 group transition-all {{ request()->routeIs('alumni.dashboard') ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
            <div class="p-2 rounded-xl transition-all {{ request()->routeIs('alumni.dashboard') ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                <i class="ri-dashboard-3-line text-xl {{ request()->routeIs('alumni.dashboard') ? 'ri-dashboard-3-fill' : '' }}"></i>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-widest">Home</span>
        </a>

        @php
            $isCommunityActive = request()->routeIs('alumni.feed') || 
                                request()->routeIs('alumni.business.*') || 
                                request()->routeIs('alumni.jobs.*') || 
                                request()->routeIs('alumni.directory') ||
                                (request()->routeIs('alumni.directory.show') && request()->route('id') != Auth::id());
        @endphp

        @if($isCommunityActive)
            <!-- Community/Feed -->
            <a href="{{ route('alumni.feed') }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ request()->routeIs('alumni.feed') ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ request()->routeIs('alumni.feed') ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-community-line text-xl {{ request()->routeIs('alumni.feed') ? 'ri-community-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Feed</span>
            </a>

            <!-- Business -->
            <a href="{{ route('alumni.business.index') }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ request()->routeIs('alumni.business.*') ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ request()->routeIs('alumni.business.*') ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-briefcase-line text-xl {{ request()->routeIs('alumni.business.*') ? 'ri-briefcase-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Business</span>
            </a>

            <!-- Career -->
            <a href="{{ route('alumni.jobs.index') }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ request()->routeIs('alumni.jobs.*') ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ request()->routeIs('alumni.jobs.*') ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-briefcase-4-line text-xl {{ request()->routeIs('alumni.jobs.*') ? 'ri-briefcase-4-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Career</span>
            </a>

            <!-- Koneksi -->
            <a href="{{ route('alumni.directory') }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ request()->routeIs('alumni.directory') ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ request()->routeIs('alumni.directory') ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-team-line text-xl {{ request()->routeIs('alumni.directory') ? 'ri-team-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Koneksi</span>
            </a>
        @else
            <!-- Community/Feed (Default) -->
            <a href="{{ route('alumni.feed') }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ request()->routeIs('alumni.feed') ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ request()->routeIs('alumni.feed') ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-community-line text-xl {{ request()->routeIs('alumni.feed') ? 'ri-community-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Feed</span>
            </a>

            <!-- Directory (Default) -->
            @php
                $isAlumniActive = request()->routeIs('alumni.directory') || 
                                 (request()->routeIs('alumni.directory.show') && request()->route('id') != Auth::id());
            @endphp
            <a href="{{ route('alumni.directory') }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ $isAlumniActive ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ $isAlumniActive ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-team-line text-xl {{ $isAlumniActive ? 'ri-team-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Alumni</span>
            </a>

            <!-- View Public Profile -->
            @php
                $isViewActive = request()->routeIs('alumni.directory.show') && request()->route('id') == Auth::id();
            @endphp
            <a href="{{ route('alumni.directory.show', Auth::id()) }}" 
               class="flex flex-col items-center gap-1 group transition-all {{ $isViewActive ? 'text-iaspig-orange' : 'text-gray-400 hover:text-iaspig-brown' }}">
                <div class="p-2 rounded-xl transition-all {{ $isViewActive ? 'bg-iaspig-orange/10' : 'group-hover:bg-gray-50' }}">
                    <i class="ri-user-line text-xl {{ $isViewActive ? 'ri-user-fill' : '' }}"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">View</span>
            </a>

            <!-- Logout (Mobile) -->
            <button type="button" onclick="document.getElementById('logout-form-nav').submit();" 
                    class="flex flex-col items-center gap-1 group transition-all text-gray-400 hover:text-red-500">
                <div class="p-2 rounded-xl transition-all group-hover:bg-red-50">
                    <i class="ri-logout-box-line text-xl"></i>
                </div>
                <span class="text-[10px] font-bold uppercase tracking-widest">Logout</span>
            </button>
        @endif

        <form id="logout-form-nav" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>
    </div>
</nav>
