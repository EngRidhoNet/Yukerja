<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Yuk Kerja</title>
    <meta name="description" content="Pengaturan Mitra Yuk Kerja">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Hammer.js for swipe gestures -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
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
                this.sidebarCollapsed = !sidebarCollapsed;
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
        @include('layouts.mitra.sidebar')
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
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Pengaturan</h1>
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
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6">Pengaturan Akun</h2>
                    <div class="space-y-6">
                        <!-- Account Details -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-4">Detail Akun</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" value="Budi Santoso" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" value="budi@example.com" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <input type="text" value="+628123456789" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
                                    <input type="password" placeholder="Masukkan kata sandi baru" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                            <div class="mt-6">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Simpan Perubahan</button>
                            </div>
                        </div>
                        <!-- Notification Preferences -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-4">Preferensi Notifikasi</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="notify-jobs" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="notify-jobs" class="ml-2 text-sm text-gray-700">Notifikasi pekerjaan baru</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="notify-payments" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="notify-payments" class="ml-2 text-sm text-gray-700">Notifikasi pembayaran</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="notify-reminders" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="notify-reminders" class="ml-2 text-sm text-gray-700">Pengingat jadwal pekerjaan</label>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Simpan Preferensi</button>
                            </div>
                        </div>
                        <!-- Privacy Settings -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-4">Pengaturan Privasi</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="public-profile" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="public-profile" class="ml-2 text-sm text-gray-700">Buat profil saya publik</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="share-location" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="share-location" class="ml-2 text-sm text-gray-700">Bagikan lokasi saat bekerja</label>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Simpan Pengaturan</button>
                            </div>
                        </div>
                        <!-- Data Controls -->
                        <div>
                            <h3 class="text-sm font-medium text-gray-700 mb-4">Kontroll Data</h3>
                            <div class="space-y-4">
                                <p class="text-sm text-gray-600">Anda dapat mengelola data Anda dengan mengklik ikon buku di bawah pesan untuk melupakan percakapan tertentu, atau nonaktifkan fitur memori di bagian "Data Controls" di pengaturan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>