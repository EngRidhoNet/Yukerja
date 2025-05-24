<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Area Layanan - Yuk Kerja</title>
    <meta name="description" content="Manajemen Area Layanan Yuk Kerja">
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Hammer.js for swipe gestures -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    <!-- Leaflet.js for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Axios for API calls -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
        #map { 
            height: 450px; 
            width: 100%; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div x-data="{ 
        sidebarOpen: true,
        sidebarCollapsed: window.innerWidth < 1280 ? true : false,
        isMobile: window.innerWidth < 1024,
        showTutorial: !localStorage.getItem('sidebarTutorialShown'),
        selectedProvince: '',
        selectedCity: '',
        selectedDistrict: '',
        serviceAreas: @json($mitra->service_area ?? []),
        provinces: [],
        cities: {},
        districts: {},
        map: null,
        marker: null,
        currentStep: 1,
        isLoading: false,
        commonAreas: [
            'Tanah Abang, Jakarta Pusat, DKI Jakarta',
            'Menteng, Jakarta Pusat, DKI Jakarta',
            'Kemang, Jakarta Selatan, DKI Jakarta'
        ],
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
        }
    }" x-init="
        initSwipeGestures();
        setMobileState();
        window.addEventListener('resize', () => setMobileState());
        if(showTutorial) setTimeout(() => closeTutorial(), 5000);
        initMap();
        fetchProvinces();
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
                <a href="{{ route('mitra.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
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
                <a href="{{ route('mitra.dashboard.riwayat') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Riwayat Pekerjaan</span>
                </a>
                <a href="{{ route('mitra.dashboard.area') }}" class="flex items-center px-6 py-3 bg-blue-700 hover:bg-blue-800 transition-colors"
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
                <a href="{{ route('logout') }}" class="flex items-center px-6 py-3 hover:bg-gray-800 transition-colors"
                    x-bind:class="{ 'justify-center': sidebarCollapsed && !isMobile }">
                    <svg class="h-5 w-5" x-bind:class="{ 'mr-3': !sidebarCollapsed || isMobile }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span x-show="!sidebarCollapsed || isMobile" class="text-sm font-medium">Keluar</span>
                </a>
            </nav>
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
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Manajemen Area Layanan</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div x-data="{ showNotifications: false }" class="relative">
                        <button @click="showNotifications = !showNotifications" aria-label="Notifications"
                            class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="ml-1 bg-yellow-500 rounded-full h-5 w-5 flex items-center justify-center text-white text-xs">{{ $notifications->count() }}</span>
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
                                @foreach($notifications as $notification)
                                    <a href="{{ $notification->redirect_url ?? '#' }}" class="flex px-4 py-3 hover:bg-gray-50 border-b">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-800">{{ $notification->title }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                @endforeach
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
                                @if($mitra->profile_photo)
                                    <img src="{{ asset('storage/' . $mitra->profile_photo) }}" alt="Profile" class="h-8 w-8 rounded-full">
                                @else
                                    <svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                @endif
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
                                <p class="px-4 text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="px-4 text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('mitra.dashboard.edit-profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pengaturan</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                <!-- Notification Bar -->
                <div id="notification" class="hidden fixed top-4 right-4 px-4 py-2 rounded-lg border text-sm font-medium z-50"></div>
                
                <!-- Map Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Lokasi Anda Saat Ini</h2>
                        <p class="text-sm text-gray-600 mt-1">Klik pada peta untuk menetapkan posisi Anda</p>
                    </div>
                    <div class="p-6">
                        <div id="map"></div>
                    </div>
                </div>
                
                <!-- Manage Service Area Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Kelola Area Layanan</h2>
                    </div>
                    <div class="p-6">
                        <!-- Common Areas -->
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-800 mb-3">Area Populer</h3>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="area in commonAreas" :key="area">
                                    <button @click="addCommonArea(area)"
                                        class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium hover:bg-blue-200">
                                        <span x-text="area.split(', ')[0]"></span>
                                    </button>
                                </template>
                            </div>
                        </div>
                        
                        <!-- Step Indicators -->
                        <div class="flex items-center mb-6">
                            <div class="flex-1">
                                <div class="flex items-center">
                                    <div class="flex items-center">
                                        <button @click="moveToStep(1)"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium"
                                            :class="currentStep >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
                                            1
                                        </button>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Pilih Provinsi</span>
                                    </div>
                                    <div class="flex-1 h-px bg-gray-200 mx-4"></div>
                                    <div class="flex items-center">
                                        <button @click="moveToStep(2)"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium"
                                            :class="currentStep >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
                                            2
                                        </button>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Pilih Kota</span>
                                    </div>
                                    <div class="flex-1 h-px bg-gray-200 mx-4"></div>
                                    <div class="flex items-center">
                                        <button @click="moveToStep(3)"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium"
                                            :class="currentStep >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
                                            3
                                        </button>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Pilih Kecamatan</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Selection Form -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <!-- Province Dropdown -->
                            <div x-show="currentStep >= 1">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                <select x-model="selectedProvince" @change="fetchCities(selectedProvince); selectedCity = ''; selectedDistrict = ''; moveToStep(2)"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Provinsi</option>
                                    <template x-for="province in provinces" :key="province.id">
                                        <option :value="province.id" x-text="province.name"></option>
                                    </template>
                                </select>
                            </div>
                            <!-- City Dropdown -->
                            <div x-show="currentStep >= 2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                <select x-model="selectedCity" @change="fetchDistricts(selectedCity); selectedDistrict = ''; moveToStep(3)"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    :disabled="!selectedProvince">
                                    <option value="">Pilih Kota</option>
                                    <template x-if="selectedProvince && cities[selectedProvince]">
                                        <template x-for="city in cities[selectedProvince]" :key="city.id">
                                            <option :value="city.id" x-text="city.name"></option>
                                        </template>
                                    </template>
                                </select>
                            </div>
                            <!-- District Dropdown -->
                            <div x-show="currentStep >= 3">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                <select x-model="selectedDistrict"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    :disabled="!selectedCity">
                                    <option value="">Pilih Kecamatan</option>
                                    <template x-if="selectedCity && districts[selectedCity]">
                                        <template x-for="district in districts[selectedCity]" :key="district.id">
                                            <option :value="district.id" x-text="district.name"></option>
                                        </template>
                                    </template>
                                </select>
                            </div>
                            <!-- Add Button -->
                            <div class="flex items-end">
                                <button @click="addServiceArea()"
                                    class="w-full px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors flex items-center justify-center"
                                    :disabled="!selectedDistrict || isLoading">
                                    <span x-show="!isLoading">Tambah Area</span>
                                    <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Service Areas List -->
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-sm font-semibold text-gray-800 mb-3">Daftar Area Layanan</h3>
                            <template x-if="serviceAreas.length === 0">
                                <p class="text-sm text-gray-500">Belum ada area layanan yang ditambahkan.</p>
                            </template>
                            <template x-if="serviceAreas.length > 0">
                                <div class="space-y-2">
                                    <template x-for="area in serviceAreas" :key="area">
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-md">
                                            <span class="text-sm text-gray-800" x-text="area"></span>
                                            <button @click="removeServiceArea(area)"
                                                class="text-sm text-red-600 hover:text-red-700">
                                                Hapus
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </template>
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
        function serviceAreaManagement() {
            return {
                initMap() {
                    this.map = L.map('map').setView([{{ $mitra->latitude ?? -6.2088 }}, {{ $mitra->longitude ?? 106.8456 }}], 12);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(this.map);
                    this.marker = L.marker([{{ $mitra->latitude ?? -6.2088 }}, {{ $mitra->longitude ?? 106.8456 }}]).addTo(this.map)
                        .bindPopup('Lokasi Anda saat ini').openPopup();
                    
                    L.circle([{{ $mitra->latitude ?? -6.2088 }}, {{ $mitra->longitude ?? 106.8456 }}], {
                        color: '#2563eb',
                        fillColor: '#60a5fa',
                        fillOpacity: 0.2,
                        radius: 3000
                    }).addTo(this.map);

                    this.map.on('click', async (e) => {
                        const { lat, lng } = e.latlng;
                        this.marker.setLatLng([lat, lng]).setPopupContent('Lokasi baru Anda').openPopup();
                        this.map.setView([lat, lng], 14);
                        try {
                            this.isLoading = true;
                            await axios.post('/api/mitra/update-location', {
                                latitude: lat,
                                longitude: lng
                            }, {
                                headers: {
                                    'Authorization': 'Bearer {{ auth()->user()->api_token ?? '' }}'
                                }
                            });
                            this.showNotification('Lokasi berhasil diperbarui', 'success');
                        } catch (error) {
                            console.error('Error updating location:', error);
                            this.showNotification('Gagal memperbarui lokasi', 'error');
                        } finally {
                            this.isLoading = false;
                        }
                    });
                },
                async fetchProvinces() {
                    try {
                        this.isLoading = true;
                        const response = await fetch('https://dev.farizdotid.com/api/daerahindonesia/provinsi');
                        const data = await response.json();
                        this.provinces = data.provinsis.map(p => ({ id: p.id, name: p.nama }));
                        this.isLoading = false;
                    } catch (error) {
                        console.error('Error fetching provinces:', error);
                        this.isLoading = false;
                        this.showNotification('Gagal memuat provinsi', 'error');
                    }
                },
                async fetchCities(provinceId) {
                    try {
                        this.isLoading = true;
                        const response = await fetch(`https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=${provinceId}`);
                        const data = await response.json();
                        this.cities[provinceId] = data.kotas.map(c => ({ id: c.id, name: c.nama }));
                        this.selectedCity = '';
                        this.districts = {};
                        this.isLoading = false;
                    } catch (error) {
                        console.error('Error fetching cities:', error);
                        this.isLoading = false;
                        this.showNotification('Gagal memuat kota', 'error');
                    }
                },
                async fetchDistricts(cityId) {
                    try {
                        this.isLoading = true;
                        const response = await fetch(`https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=${cityId}`);
                        const data = await response.json();
                        this.districts[cityId] = data.kecamatans.map(d => ({ id: d.id, name: d.nama }));
                        this.selectedDistrict = '';
                        this.isLoading = false;
                    } catch (error) {
                        console.error('Error fetching districts:', error);
                        this.isLoading = false;
                        this.showNotification('Gagal memuat kecamatan', 'error');
                    }
                },
                async addServiceArea() {
                    if (this.selectedProvince && this.selectedCity && this.selectedDistrict) {
                        const province = this.provinces.find(p => p.id == this.selectedProvince).name;
                        const city = this.cities[this.selectedProvince].find(c => c.id == this.selectedCity).name;
                        const district = this.districts[this.selectedCity].find(d => d.id == this.selectedDistrict).name;
                        const area = `${district}, ${city}, ${province}`;
                        
                        if (!this.serviceAreas.includes(area)) {
                            this.serviceAreas.push(area);
                            const coords = this.getApproximateCoords(area);
                            
                            this.map.setView(coords, 14);
                            this.marker.setLatLng(coords).setPopupContent(`Area Layanan: ${area}`).openPopup();
                            
                            L.circle(coords, {
                                color: '#2563eb',
                                fillColor: '#60a5fa',
                                fillOpacity: 0.2,
                                radius: 2000
                            }).addTo(this.map);
                            
                            try {
                                this.isLoading = true;
                                await axios.post('/api/mitra/update-service-areas', {
                                    service_areas: this.serviceAreas
                                }, {
                                    headers: {
                                        'Authorization': 'Bearer {{ auth()->user()->api_token ?? '' }}'
                                    }
                                });
                                this.showNotification('Area layanan berhasil ditambahkan', 'success');
                            } catch (error) {
                                console.error('Error updating service areas:', error);
                                this.showNotification('Gagal menambah area layanan', 'error');
                                this.serviceAreas = this.serviceAreas.filter(a => a !== area); // Rollback
                            } finally {
                                this.isLoading = false;
                            }
                        }
                        this.selectedProvince = '';
                        this.selectedCity = '';
                        this.selectedDistrict = '';
                        this.currentStep = 1;
                    }
                },
                async removeServiceArea(area) {
                    const originalAreas = [...this.serviceAreas];
                    this.serviceAreas = this.serviceAreas.filter(a => a !== area);
                    try {
                        this.isLoading = true;
                        await axios.post('/api/mitra/update-service-areas', {
                            service_areas: this.serviceAreas
                        }, {
                            headers: {
                                'Authorization': 'Bearer {{ auth()->user()->api_token ?? '' }}'
                            }
                        });
                        this.showNotification('Area layanan berhasil dihapus', 'success');
                    } catch (error) {
                        console.error('Error removing service area:', error);
                        this.showNotification('Gagal menghapus area layanan', 'error');
                        this.serviceAreas = originalAreas; // Rollback
                    } finally {
                        this.isLoading = false;
                    }
                },
                getApproximateCoords(area) {
                    const coordMap = {
                        'Tanah Abang, Jakarta Pusat, DKI Jakarta': [-6.1990, 106.8166],
                        'Menteng, Jakarta Pusat, DKI Jakarta': [-6.1950, 106.8390],
                        'Kemang, Jakarta Selatan, DKI Jakarta': [-6.2607, 106.8161],
                        'Pancoran, Jakarta Selatan, DKI Jakarta': [-6.2431, 106.8397],
                        'Kebon Jeruk, Jakarta Barat, DKI Jakarta': [-6.1893, 106.7697],
                        'Kembangan, Jakarta Barat, DKI Jakarta': [-6.1849, 106.7345],
                        'Cidadap, Bandung, Jawa Barat': [-6.9147, 107.6098],
                        'Cibeunying, Bandung, Jawa Barat': [-6.9050, 107.6340],
                        'Bogor Tengah, Bogor, Jawa Barat': [-6.5971, 106.7970],
                        'Bogor Selatan, Bogor, Jawa Barat': [-6.6390, 106.8000],
                        'Semarang Tengah, Semarang, Jawa Tengah': [-6.9920, 110.4229],
                        'Semarang Barat, Semarang, Jawa Tengah': [-6.9833, 110.3995],
                        'Jebres, Solo, Jawa Tengah': [-7.5561, 110.8515],
                        'Laweyan, Solo, Jawa Tengah': [-7.5653, 110.8057]
                    };
                    return coordMap[area] || [{{ $mitra->latitude ?? -6.2088 }}, {{ $mitra->longitude ?? 106.8456 }}];
                },
                async addCommonArea(area) {
                    if (!this.serviceAreas.includes(area)) {
                        this.serviceAreas.push(area);
                        const coords = this.getApproximateCoords(area);
                        
                        this.map.setView(coords, 14);
                        this.marker.setLatLng(coords).setPopupContent(`Area Layanan: ${area}`).openPopup();
                        
                        L.circle(coords, {
                            color: '#2563eb',
                            fillColor: '#60a5fa',
                            fillOpacity: 0.2,
                            radius: 2000
                        }).addTo(this.map);
                        
                        try {
                            this.isLoading = true;
                            await axios.post('/api/mitra/update-service-areas', {
                                service_areas: this.serviceAreas
                            }, {
                                headers: {
                                    'Authorization': 'Bearer {{ auth()->user()->api_token ?? '' }}'
                                }
                            });
                            this.showNotification('Area layanan berhasil ditambahkan', 'success');
                        } catch (error) {
                            console.error('Error adding common area:', error);
                            this.showNotification('Gagal menambah area layanan', 'error');
                            this.serviceAreas = this.serviceAreas.filter(a => a !== area); // Rollback
                        } finally {
                            this.isLoading = false;
                        }
                    }
                },
                moveToStep(step) {
                    if (step === 2 && !this.selectedProvince) return;
                    if (step === 3 && !this.selectedCity) return;
                    this.currentStep = step;
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
                }
            };
        }
    </script>
</body>
</html>