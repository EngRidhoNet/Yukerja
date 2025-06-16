<div x-bind:class="{
    'translate-x-0': sidebarOpen, 
    '-translate-x-full': !sidebarOpen && isMobile,
    'sidebar-collapsed': sidebarCollapsed && !isMobile,
    'sidebar-expanded': !sidebarCollapsed && !isMobile
}" class="fixed inset-y-0 left-0 z-30 transform transition-sidebar bg-gray-900 text-white lg:relative lg:translate-x-0">
    <!-- Logo -->
    <div class="flex items-center justify-center h-16 bg-gray-900 px-4">
        <div class="flex items-center">
            <div class="font-bold tracking-tight"
                x-bind:class="{ 'text-xl': !sidebarCollapsed || isMobile, 'text-base': sidebarCollapsed && !isMobile }">
                <div>Yuk</div>
                <div class="-mt-1">Kerja</div>
            </div>
            <div x-show="!sidebarCollapsed || isMobile"
                class="ml-2 text-xs font-medium px-2 py-0.5 bg-blue-600 rounded">Mitra</div>
        </div>
    </div>
    <nav class="mt-4 space-y-1">
        <a href="{{ route('mitra.dashboard') }}"
           class="flex items-center px-6 py-3 transition-colors"
           x-bind:class="{ 
               'bg-blue-700': '{{ request()->routeIs('mitra.dashboard') }}',
               'hover:bg-blue-800': !'{{ request()->routeIs('mitra.dashboard') }}',
               'justify-center': sidebarCollapsed && !isMobile 
           }">
            <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Dashboard Mitra</span>
        </a>
        <a href="{{ route('mitra.dashboard.job-terdekat') }}"
           class="flex items-center px-6 py-3 transition-colors"
           x-bind:class="{ 
               'bg-blue-700': '{{ request()->routeIs('mitra.dashboard.job-terdekat') }}',
               'hover:bg-blue-800': !'{{ request()->routeIs('mitra.dashboard.job-terdekat') }}',
               'justify-center': sidebarCollapsed && !isMobile 
           }">
            <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Pekerjaan Terdekat</span>
        </a>
        <a href="{{ route('mitra.dashboard.transactions') }}"
           class="flex items-center px-6 py-3 transition-colors"
           x-bind:class="{ 
               'bg-blue-700': '{{ request()->routeIs('mitra.dashboard.transactions') }}',
               'hover:bg-blue-800': !'{{ request()->routeIs('mitra.dashboard.transactions') }}',
               'justify-center': sidebarCollapsed && !isMobile 
           }">
            <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Transaksi</span>
        </a>
        <a href="{{ route('mitra.dashboard.riwayat') }}"
           class="flex items-center px-6 py-3 transition-colors"
           x-bind:class="{ 
               'bg-blue-700': '{{ request()->routeIs('mitra.dashboard.riwayat') }}',
               'hover:bg-blue-800': !'{{ request()->routeIs('mitra.dashboard.riwayat') }}',
               'justify-center': sidebarCollapsed && !isMobile 
           }">
            <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Riwayat Pekerjaan</span>
        </a>
        <a href="{{ route('mitra.dashboard.area') }}"
           class="flex items-center px-6 py-3 transition-colors"
           x-bind:class="{ 
               'bg-blue-700': '{{ request()->routeIs('mitra.dashboard.area') }}',
               'hover:bg-blue-800': !'{{ request()->routeIs('mitra.dashboard.area') }}',
               'justify-center': sidebarCollapsed && !isMobile 
           }">
            <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Manajemen Area Layanan</span>
        </a>
        <a href="{{ url('/chatify')}}"
            class="flex items-center px-6 py-3 transition-colors"
            x-bind:class="{ 
                 'bg-blue-700': '{{ request()->is('chatify*') }}',
                 'hover:bg-blue-800': !'{{ request()->is('chatify*') }}',
                 'justify-center': sidebarCollapsed && !isMobile 
            }">
             <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h6m-6 4h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
             </svg>
             <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Chat</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="flex items-center px-6 py-3 transition-colors cursor-pointer"
              x-bind:class="{ 
                  'justify-center': sidebarCollapsed && !isMobile 
              }"
              onclick="this.submit()">
            @csrf
            <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Keluar</span>
        </form>
    </nav>
    <!-- Collapse Toggle Button -->
    <div class="absolute bottom-0 left-0 right-0 p-4 hidden lg:block">
        <button @click="sidebarCollapsed = !sidebarCollapsed"
            class="w-full flex items-center justify-center p-2 rounded bg-gray-800 hover:bg-gray-700 transition-colors">
            <svg x-show="!sidebarCollapsed" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
            <svg x-show="sidebarCollapsed" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>