<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penawaran Masuk - Yuk Kerja</title>
    <meta name="description" content="Lihat daftar penawaran pekerjaan masuk di Yuk Kerja">
    <!-- Tailwind CSS via CDN (Switch to local setup for production) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .transition-sidebar {
            transition: width 0.3s ease, transform 0.3s ease, margin-left 0.3s ease;
        }
        .sidebar-collapsed { width: 80px; }
        .sidebar-expanded { width: 250px; }
        .content-area { transition: margin-left 0.3s ease; }
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .dropdown-transition {
            transition: all 0.2s ease-in-out;
        }
        .offer-card {
            transition: all 0.2s ease;
        }
        .offer-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .menu-item {
            position: relative;
        }
        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: #2563eb;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
    </style>
</head>
<body class="bg-slate-50 font-sans antialiased text-slate-900">
    <div x-data="{
        sidebarOpen: true,
        sidebarCollapsed: window.innerWidth < 1280 ? true : false,
        isMobile: window.innerWidth < 1024,
        showTutorial: !localStorage.getItem('sidebarTutorialShown'),
        offers: [],
        filteredOffers: [],
        searchQuery: '',
        filterStatus: 'all',
        isLoading: false
    }" class="flex h-screen overflow-hidden">
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
        }" class="fixed inset-y-0 left-0 z-30 transform transition-sidebar bg-slate-800 text-white lg:relative lg:translate-x-0">
            <div class="flex items-center justify-center h-16 bg-slate-900 px-4">
                <div class="flex items-center">
                    <div class="font-bold tracking-tight"
                        x-bind:class="{ 'text-xl': !sidebarCollapsed || isMobile, 'text-base': sidebarCollapsed && !isMobile }">
                        <div class="text-blue-400">Yuk</div>
                        <div class="-mt-1 text-white">Kerja</div>
                    </div>
                    <div x-show="!sidebarCollapsed || isMobile"
                        class="ml-2 text-xs font-medium px-2 py-0.5 bg-blue-600 rounded-full">Mitra</div>
                </div>
            </div>
            <nav class="mt-6 space-y-1 px-2">
                <a href="{{ route('mitra.dashboard') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors menu-item"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5 text-slate-400" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Dashboard</span>
                </a>
                <a href="{{ route('mitra.dashboard.job-terdekat') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors menu-item"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5 text-slate-400" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Pekerjaan Terdekat</span>
                </a>
                <a href="{{ route('mitra.dashboard.riwayat') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors menu-item"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5 text-slate-400" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Riwayat Pekerjaan</span>
                </a>
                <a href="{{ route('mitra.dashboard.area') }}" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors menu-item"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5 text-slate-400" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Area Layanan</span>
                </a>
         
                <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors menu-item"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5 text-slate-400" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Pengaturan</span>
                </a>
                <div class="pt-4 border-t border-slate-700 mt-6">
                    <a href="#" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-700 transition-colors menu-item"
                        x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                        <svg class="h-5 w-5 text-slate-400" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Keluar</span>
                    </a>
                </div>
            </nav>
            <div class="absolute bottom-0 left-0 right-0 p-4 hidden lg:block">
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                    class="w-full flex items-center justify-center p-2 rounded bg-slate-700 hover:bg-slate-600 transition-colors">
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
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-slate-200">
                <div class="flex items-center">
                    <button @click="toggleSidebar()" class="text-slate-600 hover:text-slate-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-bold text-slate-800 ml-4">Penawaran Masuk</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div x-data="{ showNotifications: false }" class="relative">
                        <button @click="showNotifications = !showNotifications" aria-label="Notifications"
                            class="flex items-center text-slate-600 hover:text-slate-900 focus:outline-none">
                            <div class="relative">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-yellow-500 rounded-full h-5 w-5 flex items-center justify-center text-white text-xs font-medium pulse-animation">4</span>
                            </div>
                        </button>
                        <div x-show="showNotifications" @click.away="showNotifications = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50 custom-scrollbar dropdown-transition" x-cloak>
                            <div class="p-4 border-b border-slate-200">
                                <h3 class="text-sm font-semibold text-slate-800">Notifikasi</h3>
                            </div>
                            <div class="max-h-64 overflow-y-auto">
                                <a href="#" class="flex px-4 py-3 hover:bg-slate-50 border-b border-slate-100">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-slate-800">Pekerjaan baru tersedia</p>
                                        <p class="text-xs text-slate-500 mt-1">10 menit yang lalu</p>
                                    </div>
                                </a>
                                <a href="#" class="flex px-4 py-3 hover:bg-slate-50 border-b border-slate-100">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-slate-800">Pembayaran diterima</p>
                                        <p class="text-xs text-slate-500 mt-1">2 jam yang lalu</p>
                                    </div>
                                </a>
                            </div>
                            <div class="p-3 border-t border-slate-200">
                                <a href="#" class="block text-center text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ showProfileMenu: false }" class="border-l pl-4 border-slate-200 relative">
                        <button @click="showProfileMenu = !showProfileMenu" aria-label="Profile Menu"
                            class="flex items-center focus:outline-none">
                            <div class="h-8 w-8 rounded-full bg-slate-200 flex items-center justify-center">
                                <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <svg class="h-4 w-4 ml-1 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="showProfileMenu" @click.away="showProfileMenu = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg z-50 dropdown-transition" x-cloak>
                            <div class="py-2 border-b border-slate-200">
                                <p class="px-4 text-sm font-medium text-slate-800">Budi Santoso</p>
                                <p class="px-4 text-xs text-slate-500">budi@example.com</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('mitra.dashboard.edit-profile') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">Profil Saya</a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">Pengaturan</a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-6">
                <!-- Notification Bar -->
                <div id="notification" class="hidden fixed top-4 right-4 px-4 py-2 rounded-lg border text-sm font-medium z-50"></div>
                
                <!-- Offers Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-200">
                        <h2 class="text-lg font-semibold text-slate-800">Daftar Penawaran Masuk</h2>
                        <div class="mt-4 flex flex-col md:flex-row gap-4">
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Cari Penawaran</label>
                                <input x-model.debounce="searchQuery" type="text" placeholder="Ketik kata kunci..."
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="w-full md:w-1/3">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Filter Status</label>
                                <select x-model="filterStatus"
                                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                    <option value="all">Semua</option>
                                    <option value="pending">Menunggu</option>
                                    <option value="accepted">Diterima</option>
                                    <option value="rejected">Ditolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <template x-if="isLoading">
                            <div class="text-center py-10">
                                <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <p class="text-sm text-slate-600 mt-2">Memuat penawaran...</p>
                            </div>
                        </template>
                        <template x-if="!isLoading">
                            <template x-if="filteredOffers.length === 0">
                                <p class="text-sm text-slate-500 text-center py-10">Tidak ada penawaran yang tersedia.</p>
                            </template>
                            <template x-if="filteredOffers.length > 0">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <template x-for="offer in filteredOffers" :key="offer.id">
                                        <div class="offer-card bg-white p-4 rounded-lg border border-slate-200">
                                            <div class="flex items-center justify-between mb-2">
                                                <h3 class="text-md font-semibold text-slate-800" x-text="offer.title"></h3>
                                                <span class="px-2 py-1 text-xs font-medium rounded"
                                                    :class="{
                                                        'bg-yellow-100 text-yellow-800': offer.status === 'pending',
                                                        'bg-green-100 text-green-800': offer.status === 'accepted',
                                                        'bg-red-100 text-red-800': offer.status === 'rejected'
                                                    }" x-text="offer.status === 'pending' ? 'Menunggu' : offer.status === 'accepted' ? 'Diterima' : 'Ditolak'"></span>
                                            </div>
                                            <p class="text-sm text-slate-600 mb-2" x-text="offer.description"></p>
                                            <div class="text-sm text-slate-500 mb-2">
                                                <span>Lokasi: </span><span x-text="offer.location"></span>
                                            </div>
                                            <div class="text-sm text-slate-500 mb-2">
                                                <span>Bayaran: </span><span x-text="'Rp ' + offer.pay.toLocaleString()"></span>
                                            </div>
                                            <div class="text-sm text-slate-500 mb-4">
                                                <span>Tanggal: </span><span x-text="new Date(offer.date).toLocaleDateString('id-ID')"></span>
                                            </div>
                                            <div class="flex justify-end space-x-2">
                                                <button @click="acceptOffer(offer.id)"
                                                    class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 text-sm"
                                                    x-show="offer.status === 'pending'">Terima</button>
                                                <button @click="rejectOffer(offer.id)"
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm"
                                                    x-show="offer.status === 'pending'">Tolak</button>
                                                <button @click="viewDetails(offer.id)"
                                                    class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">Lihat Detail</button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                        </template>
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
                            <h3 class="text-xl font-bold text-slate-800 mt-3">Selamat Datang di Penawaran Masuk!</h3>
                            <p class="text-slate-600 mt-2 text-sm">Gunakan tombol di pojok kiri atas untuk memperluas atau meminimalkan sidebar navigasi.</p>
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
        document.addEventListener('alpine:init', () => {
            Alpine.data('jobOffers', () => ({
                initSwipeGestures() {
                    const mainContent = document.querySelector('#main-content');
                    const hammer = new Hammer(mainContent);
                    hammer.on('swiperight', () => {
                        if (this.isMobile && !this.sidebarOpen) this.sidebarOpen = true;
                    });
                    hammer.on('swipeleft', () => {
                        if (this.isMobile && this.sidebarOpen) this.sidebarOpen = false;
                    });
                },
                setMobileState() {
                    this.isMobile = window.innerWidth < 1024;
                    if (this.isMobile) this.sidebarOpen = false;
                    else this.sidebarOpen = true;
                },
                toggleSidebar() {
                    if (this.isMobile) this.sidebarOpen = !this.sidebarOpen;
                    else this.sidebarCollapsed = !this.sidebarCollapsed;
                },
                closeTutorial() {
                    this.showTutorial = false;
                    localStorage.setItem('sidebarTutorialShown', true);
                },
                async fetchOffers() {
                    try {
                        this.isLoading = true;
                        // Simulate API call with mock data (replace with real API endpoint)
                        const response = await new Promise(resolve => setTimeout(() => resolve({
                            offers: [
                                { id: 1, title: "Pembersihan Rumah", description: "Membersihkan rumah 2 lantai", location: "Tanah Abang, Jakarta Pusat", pay: 150000, date: "2025-05-18T10:00:00", status: "pending" },
                                { id: 2, title: "Perawatan Taman", description: "Memotong rumput dan merapikan taman", location: "Kemang, Jakarta Selatan", pay: 200000, date: "2025-05-17T14:30:00", status: "accepted" },
                                { id: 3, title: "Pengiriman Barang", description: "Mengantarkan paket ke alamat tertentu", location: "Menteng, Jakarta Pusat", pay: 120000, date: "2025-05-19T09:00:00", status: "rejected" }
                            ]
                        }), 1000));
                        this.offers = response.offers;
                        this.filterOffers();
                        this.isLoading = false;
                    } catch (error) {
                        console.error('Error fetching offers:', error);
                        this.isLoading = false;
                    }
                },
                filterOffers() {
                    this.filteredOffers = this.offers.filter(offer => {
                        const matchesSearch = offer.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                            offer.description.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                            offer.location.toLowerCase().includes(this.searchQuery.toLowerCase());
                        const matchesStatus = this.filterStatus === 'all' || offer.status === this.filterStatus;
                        return matchesSearch && matchesStatus;
                    });
                },
                acceptOffer(offerId) {
                    const offer = this.offers.find(o => o.id === offerId);
                    if (offer) {
                        offer.status = 'accepted';
                        this.filterOffers();
                        this.showNotification('Penawaran diterima', 'success');
                    }
                },
                rejectOffer(offerId) {
                    const offer = this.offers.find(o => o.id === offerId);
                    if (offer) {
                        offer.status = 'rejected';
                        this.filterOffers();
                        this.showNotification('Penawaran ditolak', 'info');
                    }
                },
                viewDetails(offerId) {
                    this.showNotification(`Melihat detail penawaran ID ${offerId}`, 'info');
                    // Add logic to navigate to a details page or modal
                },
                showNotification(message, type = 'info') {
                    const notification = document.getElementById('notification');
                    notification.textContent = message;
                    notification.classList.remove('bg-blue-100', 'text-blue-800', 'border-blue-200', 'bg-green-100', 'text-green-800', 'border-green-200', 'bg-red-100', 'text-red-800', 'border-red-200', 'hidden');
                    
                    if (type === 'success') {
                        notification.classList.add('bg-green-100', 'text-green-800', 'border-green-200');
                    } else if (type === 'error') {
                        notification.classList.add('bg-red-100', 'text-red-800', 'border-red-200');
                    } else {
                        notification.classList.add('bg-blue-100', 'text-blue-800', 'border-blue-200');
                    }
                    
                    setTimeout(() => {
                        notification.classList.add('hidden');
                    }, 3000);
                },
                init() {
                    this.initSwipeGestures();
                    this.setMobileState();
                    window.addEventListener('resize', () => this.setMobileState());
                    this.fetchOffers();
                    if (this.showTutorial) setTimeout(() => this.closeTutorial(), 5000);
                }
            }));
        });
    </script>
</body>
</html>