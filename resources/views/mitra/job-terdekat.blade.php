<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekerjaan Terdekat - Yuk Kerja</title>
    <meta name="description" content="Pekerjaan Terdekat Yuk Kerja">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .transition-sidebar {
            transition: width 0.3s ease, transform 0.3s ease, margin-left 0.3s ease;
        }
        .sidebar-collapsed { width: 80px; }
        .sidebar-expanded { width: 256px; }
        .content-area { transition: margin-left 0.3s ease; }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        /* Smooth transitions for dropdowns */
        .dropdown-transition {
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div x-data="{ 
        sidebarOpen: true,
        sidebarCollapsed: window.innerWidth < 1280 ? true : false,
        isMobile: window.innerWidth < 1024,
        toggleSidebar() {
            if (this.isMobile) {
                this.sidebarOpen = !this.sidebarOpen;
            } else {
                this.sidebarCollapsed = !this.sidebarCollapsed;
            }
        },
        setMobileState() {
            this.isMobile = window.innerWidth < 1024;
            if (this.isMobile) {
                this.sidebarOpen = false;
            } else {
                this.sidebarOpen = true;
            }
        }
    }" x-init="
        setMobileState();
        window.addEventListener('resize', () => setMobileState());
    " class="flex h-screen overflow-hidden">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen && isMobile" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-60 lg:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak></div>
        <!-- Sidebar -->
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
                <a href="{{ route('mitra.dashboard') }}" class="flex items-center px-6 py-3  hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Dashboard Mitra</span>
                </a>
                <a href="{{ route('mitra.dashboard.job-terdekat') }}" class="flex items-center bg-blue-700 px-6 py-3 hover:bg-blue-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Pekerjaan Terdekat</span>
                </a>
                <a href="{{ route('mitra.dashboard.riwayat') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Riwayat Pekerjaan</span>
                </a>
                <a href="{{ route('mitra.dashboard.area') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Manajemen Area Layanan</span>
                </a>
                <a href="{{ route('mitra.dashboard.penawaran') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Penawaran Masuk</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Keluar</span>
                </a>
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
        <div id="main-content" class="flex-1 flex flex-col overflow-y-auto bg-gray-100 p-6"
             x-bind:class="{ 'lg:ml-400': !sidebarCollapsed && !isMobile, 'lg:ml-400': sidebarCollapsed && !isMobile }">
            <!-- Top Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm">
                <div class="flex items-center">
                    <button @click="toggleSidebar()" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Pekerjaan Terdekat</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div x-data="{ showNotifications: false }" class="relative">
                        <button @click="showNotifications = !showNotifications" aria-label="Notifications"
                            class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="ml-1 bg-yellow-500 rounded-full h-5 w-5 flex items-center justify-center text-white text-xs">4</span>
                        </button>
                        <div x-show="showNotifications" @click.away="showNotifications = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50 custom-scrollbar dropdown-transition" x-cloak>
                            <div class="p-4 border-b">
                                <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-50 border-b">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Pekerjaan baru tersedia</p>
                                        <p class="text-xs text-gray-500 mt-1">10 menit yang lalu</p>
                                    </div>
                                </a>
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-50 border-b">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Pembayaran diterima</p>
                                        <p class="text-xs text-gray-500 mt-1">2 jam yang lalu</p>
                                    </div>
                                </a>
                            </div>
                            <div class="p-3 border-t">
                                <a href="#" class="block text-center text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ showProfileMenu: false }" class="border-l pl-4 border-gray-200 relative">
                        <button @click="showProfileMenu = !showProfileMenu" aria-label="Profile Menu"
                            class="flex items-center focus:outline-none">
                            <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <svg class="h-4 w-4 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="showProfileMenu" @click.away="showProfileMenu = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg z-50 dropdown-transition" x-cloak>
                            <div class="py-2 border-b">
                                <p class="px-4 text-sm font-medium text-gray-800">Budi Santoso</p>
                                <p class="px-4 text-xs text-gray-500">budi@example.com</p>
                            </div>
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Pekerjaan Terdekat</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800">Pembersihan Kantor</h3>
                                    <div class="text-sm text-gray-500 mt-1">Jl. Sudirman No. 123, Jakarta Pusat</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-800">Rp350.000</div>
                                    <div class="text-xs text-gray-500 mt-1">Jarak: 3,2 km</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Senin, 20 Mei 2025 • 08:00</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button class="px-3 py-1 text-xs border border-green-600 text-green-600 rounded hover:bg-green-50 transition-colors">
                                        Terima
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800">Perbaikan AC</h3>
                                    <div class="text-sm text-gray-500 mt-1">Jl. Gatot Subroto No. 45, Jakarta Selatan</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-800">Rp450.000</div>
                                    <div class="text-xs text-gray-500 mt-1">Jarak: 5,7 km</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Rabu, 21 Mei 2025 • 13:30</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button class="px-3 py-1 text-xs border border-green-600 text-green-600 rounded hover:bg-green-50 transition-colors">
                                        Terima
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-medium text-gray-800">Pengantaran Paket</h3>
                                    <div class="text-sm text-gray-500 mt-1">Jl. Kemang Raya No. 88, Jakarta Selatan</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm font-medium text-gray-800">Rp150.000</div>
                                    <div class="text-xs text-gray-500 mt-1">Jarak: 8,1 km</div>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Kamis, 22 Mei 2025 • 09:15</span>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                        Lihat Detail
                                    </button>
                                    <button class="px-3 py-1 text-xs border border-green-600 text-green-600 rounded hover:bg-green-50 transition-colors">
                                        Terima
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 border-t border-gray-200 text-center">
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua pekerjaan (15)</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>