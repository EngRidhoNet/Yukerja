<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mitra - Yuk Kerja</title>
    <meta name="description" content="Dashboard Mitra Yuk Kerja">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Hammer.js for swipe gestures -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <!-- Chart.js for income chart -->
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
        showTutorial: !localStorage.getItem('sidebarTutorialShown'),
        initSwipeGestures() {
            const mainContent = document.querySelector('#main-content');
            const hammer = new Hammer(mainContent);
            hammer.on('swiperight', () => {
                if (this.isMobile && !this.sidebarOpen) {
                    this.sidebarOpen = true;
                }
            });
            hammer.on('swipeleft', () => {
                if (this.isMobile && this.sidebarOpen) {
                    this.sidebarOpen = false;
                }
            });
        },
        setMobileState() {
            this.isMobile = window.innerWidth < 1024;
            if (this.isMobile) {
                this.sidebarOpen = false;
            } else {
                this.sidebarOpen = true;
            }
        },
        toggleSidebar() {
            if (this.isMobile) {
                this.sidebarOpen = !this.sidebarOpen;
            } else {
                this.sidebarCollapsed = !this.sidebarCollapsed;
            }
        },
        closeTutorial() {
            this.showTutorial = false;
            localStorage.setItem('sidebarTutorialShown', true);
        }
    }" x-init="
        initSwipeGestures(); 
        setMobileState();
        window.addEventListener('resize', () => setMobileState());
        if(showTutorial) {
            setTimeout(() => closeTutorial(), 5000);
        }
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
                <a href="{{ route('mitra.dashboard') }}" class="flex items-center px-6 py-3 bg-blue-700 hover:bg-blue-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Dashboard Mitra</span>
                </a>
                <a href="{{ route('mitra.dashboard.job-terdekat') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Pekerjaan Terdekat</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Riwayat Pekerjaan</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Manajemen Area Layanan</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
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
        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out"
            x-bind:class="{ 'lg:ml-200': !sidebarCollapsed && !isMobile, 'lg:ml-200': sidebarCollapsed && !isMobile }">
            <!-- Top Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm">
                <div class="flex items-center">
                    <button @click="toggleSidebar()" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Dashboard Mitra</h1>
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
                        <!-- Notifications Dropdown -->
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
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-50 border-b">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Ada pelanggan menunggu respons</p>
                                        <p class="text-xs text-gray-500 mt-1">5 jam yang lalu</p>
                                    </div>
                                </a>
                                <a href="#" class="flex px-4 py-3 hover:bg-gray-50">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-800">Pengingat jadwal pekerjaan</p>
                                        <p class="text-xs text-gray-500 mt-1">Kemarin</p>
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
                        <!-- Profile Dropdown -->
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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="text-3xl font-bold text-gray-800">8</div>
                        <div class="text-sm font-medium text-gray-600">Pekerjaan Aktif</div>
                        <div class="mt-3 flex items-center text-xs text-green-600">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            <span>20% lebih banyak dari minggu lalu</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="text-3xl font-bold text-gray-800">24</div>
                        <div class="text-sm font-medium text-gray-600">Pekerjaan Selesai</div>
                        <div class="mt-3 flex items-center text-xs text-green-600">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            <span>15% lebih banyak dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold text-gray-800">4,8</div>
                            <svg class="h-6 w-6 text-yellow-400 ml-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Statistik Rating</div>
                        <div class="mt-3 text-xs text-gray-500">
                            <span>Dari 42 ulasan pelanggan</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center text-red-600">
                            <div class="text-3xl font-bold">0</div>
                            <svg class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Jumlah Pelanggaran</div>
                        <div class="mt-3 text-xs text-green-600">
                            <span>Status akun: Sangat Baik</span>
                        </div>
                    </div>
                </div>
                <!-- Pending Jobs Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Pekerjaan yang Belum Tertangani</h2>
                        <div x-data="{ showFilter: false }" class="relative">
                            <button @click="showFilter = !showFilter" aria-label="Filter Jobs"
                                class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>
                            <!-- Filter Dropdown -->
                            <div x-show="showFilter" @click.away="showFilter = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50 dropdown-transition" x-cloak>
                                <div class="p-4">
                                    <h3 class="text-sm font-semibold text-gray-800 mb-3">Filter Pekerjaan</h3>
                                    <div class="mb-4">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Pekerjaan</label>
                                        <select class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option>Semua</option>
                                            <option>Pembersihan</option>
                                            <option>Perbaikan</option>
                                            <option>Pengantaran</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-xs font-medium text-gray-600 mb-1">Jarak</label>
                                        <select class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option>Semua</option>
                                            <option>&lt; 5 km</option>
                                            <option>5 - 10 km</option>
                                            <option>&gt; 10 km</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end">
                                        <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Terapkan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Jobs List -->
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
                                    <span>Senin, 21 Mei 2025 • 08:00</span>
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
                                    <span>Rabu, 23 Mei 2025 • 13:30</span>
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
                                    <span>Kamis, 24 Mei 2025 • 09:15</span>
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
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua pekerjaan (12)</a>
                    </div>
                </div>
                <!-- Recent Activities & Income Chart Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Activities -->
                    <div class="bg-white rounded-xl shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="p-5 flex">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Pembayaran diterima untuk pekerjaan "Perbaikan Kulkas"</p>
                                    <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
                                </div>
                            </div>
                            <div class="p-5 flex">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Pekerjaan baru "Pengantaran Paket" ditambahkan</p>
                                    <p class="text-xs text-gray-500 mt-1">3 jam yang lalu</p>
                                </div>
                            </div>
                            <div class="p-5 flex">
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 flex-shrink-0">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Mendapatkan ulasan 5 bintang dari pelanggan</p>
                                    <p class="text-xs text-gray-500 mt-1">5 jam yang lalu</p>
                                </div>
                            </div>
                            <div class="p-5 flex">
                                <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 flex-shrink-0">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-800">Pekerjaan "Perbaikan Kulkas" selesai</p>
                                    <p class="text-xs text-gray-500 mt-1">1 hari yang lalu</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-50 border-t border-gray-200 text-center">
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Lihat semua aktivitas</a>
                        </div>
                    </div>
                    <!-- Income Chart -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-800">Pendapatan Bulanan</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="incomeChart" class="w-full h-64"></canvas>
                        </div>
                        <div class="p-4 bg-gray-50 border-t border-gray-200 text-center">
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700">Lihat laporan lengkap</a>
                        </div>
                    </div>
                </div>
                <!-- Sidebar Tutorial Overlay -->
                <div x-show="showTutorial" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" x-cloak>
                    <div class="bg-white rounded-xl shadow-xl p-8 max-w-md">
                        <div class="text-center mb-6">
                            <svg class="h-12 w-12 text-blue-600 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-xl font-bold text-gray-800 mt-3">Selamat Datang di Dashboard Mitra!</h3>
                            <p class="text-gray-600 mt-2 text-sm">Gunakan tombol di pojok kiri atas untuk memperluas atau meminimalkan sidebar navigasi sesuai kebutuhan Anda.</p>
                        </div>
                        <div class="flex justify-center">
                            <button @click="closeTutorial()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                Mengerti
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        // Initialize Chart.js for Income Chart
        const ctx = document.getElementById('incomeChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [2500000, 2800000, 3100000, 3500000, 3850000],
                    backgroundColor: 'rgba(59, 130, 246, 0.6)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>