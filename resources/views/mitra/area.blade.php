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
            z-index: 1;
        }
        .leaflet-container {
            font-family: inherit;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div x-data="serviceAreaManagement()" x-init="
        initSwipeGestures();
        setMobileState();
        window.addEventListener('resize', () => setMobileState());
        if(showTutorial) setTimeout(() => closeTutorial(), 5000);
        // Initialize map after DOM is loaded
        setTimeout(() => initMap(), 100);
        fetchProvinces();
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
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Manajemen Area Layanan</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div x-data="{ showNotifications: false }" class="relative">
                        <button @click="showNotifications = !showNotifications" aria-label="Notifications"
                            class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="ml-1 bg-yellow-500 rounded-full h-5 w-5 flex items-center justify-center text-white text-xs">3</span>
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
                                        <p class="text-sm font-medium text-gray-800">Notifikasi Contoh</p>
                                        <p class="text-xs text-gray-500 mt-1">2 menit yang lalu</p>
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
                                <p class="px-4 text-sm font-medium text-gray-800">User Demo</p>
                                <p class="px-4 text-xs text-gray-500">user@example.com</p>
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
                <!-- Notification Bar -->
                <div id="notification" class="hidden fixed top-4 right-4 px-4 py-2 rounded-lg border text-sm font-medium z-50"></div>
                
                <!-- Location Selection Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Atur Lokasi Anda</h2>
                        <p class="text-sm text-gray-600 mt-1">Pilih lokasi Anda saat ini atau tentukan lokasi di peta</p>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-3 mb-4">
                            <button @click="getCurrentLocation()" 
                                :disabled="isGettingLocation"
                                class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg x-show="!isGettingLocation" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg x-show="isGettingLocation" class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span x-text="isGettingLocation ? 'Mendapatkan Lokasi...' : 'Gunakan Lokasi Saat Ini'"></span>
                            </button>
                            <button @click="centerToCurrentLocation()" 
                                class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 4m0 13V4m-6 3l6-3" />
                                </svg>
                                Kembali ke Lokasi Saya
                            </button>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                            <div class="flex">
                                <svg class="h-5 w-5 text-yellow-600 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-yellow-800">Tips:</p>
                                    <p class="text-sm text-yellow-700 mt-1">Klik pada peta untuk memilih lokasi baru Anda. Lokasi yang Anda pilih akan menjadi titik pusat layanan Anda.</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-600 mb-2">
                            <span class="font-medium">Koordinat saat ini:</span> 
                            <span x-text="currentLat ? currentLat.toFixed(6) + ', ' + currentLng.toFixed(6) : 'Belum ditentukan'"></span>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Peta Lokasi</h2>
                        <p class="text-sm text-gray-600 mt-1">Klik pada peta untuk mengubah lokasi Anda</p>
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
                                        class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium hover:bg-blue-200 transition-colors">
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
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-colors"
                                            :class="currentStep >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
                                            1
                                        </button>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Pilih Provinsi</span>
                                    </div>
                                    <div class="flex-1 h-px bg-gray-200 mx-4"></div>
                                    <div class="flex items-center">
                                        <button @click="moveToStep(2)"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-colors"
                                            :class="currentStep >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600'">
                                            2
                                        </button>
                                        <span class="ml-2 text-sm font-medium text-gray-700">Pilih Kota</span>
                                    </div>
                                    <div class="flex-1 h-px bg-gray-200 mx-4"></div>
                                    <div class="flex items-center">
                                        <button @click="moveToStep(3)"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-colors"
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                <select x-model="selectedProvince" @change="onProvinceChange()" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Provinsi</option>
                                    <template x-for="province in provinces" :key="province.id">
                                        <option :value="province.id" x-text="province.name"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- City Dropdown -->
                            <div x-show="currentStep >= 2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten</label>
                                <select x-model="selectedCity" @change="onCityChange()" 
                                    :disabled="!selectedProvince"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                    <template x-for="city in cities" :key="city.id">
                                        <option :value="city.id" x-text="city.name"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- District Dropdown -->
                            <div x-show="currentStep >= 3">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                <select x-model="selectedDistrict" @change="onDistrictChange()" 
                                    :disabled="!selectedCity"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100">
                                    <option value="">Pilih Kecamatan</option>
                                    <template x-for="district in districts" :key="district.id">
                                        <option :value="district.id" x-text="district.name"></option>
                                    </template>
                                </select>
                            </div>

                            <!-- Add Button -->
                            <div class="flex items-end">
                                <button @click="addServiceArea()" 
                                    :disabled="!selectedDistrict"
                                    class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed">
                                    Tambah Area
                                </button>
                            </div>
                        </div>

                        <!-- Selected Service Areas -->
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-800 mb-3">Area Layanan Terpilih</h3>
                            <div x-show="serviceAreas.length === 0" class="text-sm text-gray-500 py-4">
                                Belum ada area layanan yang dipilih
                            </div>
                            <div class="space-y-2">
                                <template x-for="(area, index) in serviceAreas" :key="area.fullName">
                                    <div class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                                        <div>
                                            <div class="font-medium text-gray-800" x-text="area.district"></div>
                                            <div class="text-sm text-gray-600" x-text="area.city + ', ' + area.province"></div>
                                        </div>
                                        <button @click="removeServiceArea(index)" 
                                            class="text-red-600 hover:text-red-800 transition-colors">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="flex justify-end">
                            <button @click="saveServiceAreas()" 
                                :disabled="serviceAreas.length === 0"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed">
                                Simpan Area Layanan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Total Area Layanan</p>
                                <p class="text-2xl font-bold text-gray-900" x-text="serviceAreas.length"></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Area Aktif</p>
                                <p class="text-2xl font-bold text-gray-900" x-text="serviceAreas.length"></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100">
                                <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Terakhir Diperbarui</p>
                                <p class="text-sm font-bold text-gray-900">Hari ini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function serviceAreaManagement() {
            return {
                // UI State
                sidebarOpen: false,
                sidebarCollapsed: false,
                isMobile: false,
                showTutorial: true,
                isGettingLocation: false,
                currentStep: 1,

                // Location data
                currentLat: -6.2088,
                currentLng: 106.8456,
                map: null,
                currentMarker: null,

                // Service area data
                provinces: [],
                cities: [],
                districts: [],
                selectedProvince: '',
                selectedCity: '',
                selectedDistrict: '',
                serviceAreas: [],
                commonAreas: [
                    'Jakarta Pusat, DKI Jakarta',
                    'Jakarta Selatan, DKI Jakarta',
                    'Jakarta Barat, DKI Jakarta',
                    'Jakarta Timur, DKI Jakarta',
                    'Jakarta Utara, DKI Jakarta',
                    'Surabaya, Jawa Timur',
                    'Bandung, Jawa Barat',
                    'Medan, Sumatera Utara',
                    'Semarang, Jawa Tengah',
                    'Makassar, Sulawesi Selatan'
                ],

                // Methods
                initSwipeGestures() {
                    const mainContent = document.getElementById('main-content');
                    if (mainContent && typeof Hammer !== 'undefined') {
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
                    }
                },

                setMobileState() {
                    this.isMobile = window.innerWidth < 1024;
                    if (!this.isMobile) {
                        this.sidebarOpen = true;
                    }
                },

                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },

                closeTutorial() {
                    this.showTutorial = false;
                },

                // Map methods
                initMap() {
                    if (typeof L !== 'undefined') {
                        this.map = L.map('map').setView([this.currentLat, this.currentLng], 13);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(this.map);

                        this.currentMarker = L.marker([this.currentLat, this.currentLng], {
                            draggable: true
                        }).addTo(this.map);

                        this.currentMarker.bindPopup('Lokasi Anda').openPopup();

                        // Handle map click
                        this.map.on('click', (e) => {
                            this.updateLocation(e.latlng.lat, e.latlng.lng);
                        });

                        // Handle marker drag
                        this.currentMarker.on('dragend', (e) => {
                            const position = e.target.getLatLng();
                            this.updateLocation(position.lat, position.lng);
                        });
                    }
                },

                updateLocation(lat, lng) {
                    this.currentLat = lat;
                    this.currentLng = lng;
                    
                    if (this.currentMarker) {
                        this.currentMarker.setLatLng([lat, lng]);
                    }
                    
                    this.showNotification('Lokasi berhasil diperbarui!', 'success');
                },

                getCurrentLocation() {
                    if (navigator.geolocation) {
                        this.isGettingLocation = true;
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                const lat = position.coords.latitude;
                                const lng = position.coords.longitude;
                                this.updateLocation(lat, lng);
                                this.centerToCurrentLocation();
                                this.isGettingLocation = false;
                                this.showNotification('Lokasi berhasil didapatkan!', 'success');
                            },
                            (error) => {
                                this.isGettingLocation = false;
                                this.showNotification('Gagal mendapatkan lokasi. Pastikan GPS diaktifkan.', 'error');
                            }
                        );
                    } else {
                        this.showNotification('Geolokasi tidak didukung browser ini.', 'error');
                    }
                },

                centerToCurrentLocation() {
                    if (this.map) {
                        this.map.setView([this.currentLat, this.currentLng], 15);
                    }
                },

                // Service area methods
                moveToStep(step) {
                    if (step <= this.currentStep) {
                        this.currentStep = step;
                    }
                },

                async fetchProvinces() {
                    // Mock data - replace with actual API call
                    this.provinces = [
                        { id: '31', name: 'DKI Jakarta' },
                        { id: '32', name: 'Jawa Barat' },
                        { id: '33', name: 'Jawa Tengah' },
                        { id: '35', name: 'Jawa Timur' },
                        { id: '12', name: 'Sumatera Utara' },
                        { id: '73', name: 'Sulawesi Selatan' }
                    ];
                },

                async onProvinceChange() {
                    if (!this.selectedProvince) return;
                    
                    this.selectedCity = '';
                    this.selectedDistrict = '';
                    this.districts = [];
                    this.currentStep = Math.max(this.currentStep, 2);
                    
                    // Mock data - replace with actual API call
                    const cityData = {
                        '31': [
                            { id: '3101', name: 'Jakarta Pusat' },
                            { id: '3102', name: 'Jakarta Utara' },
                            { id: '3103', name: 'Jakarta Barat' },
                            { id: '3104', name: 'Jakarta Selatan' },
                            { id: '3105', name: 'Jakarta Timur' }
                        ],
                        '32': [
                            { id: '3201', name: 'Bandung' },
                            { id: '3202', name: 'Bekasi' },
                            { id: '3203', name: 'Bogor' },
                            { id: '3204', name: 'Depok' }
                        ]
                    };
                    
                    this.cities = cityData[this.selectedProvince] || [];
                },

                async onCityChange() {
                    if (!this.selectedCity) return;
                    
                    this.selectedDistrict = '';
                    this.currentStep = Math.max(this.currentStep, 3);
                    
                    // Mock data - replace with actual API call
                    const districtData = {
                        '3101': [
                            { id: '310101', name: 'Gambir' },
                            { id: '310102', name: 'Tanah Abang' },
                            { id: '310103', name: 'Menteng' },
                            { id: '310104', name: 'Senen' }
                        ],
                        '3104': [
                            { id: '310401', name: 'Kebayoran Baru' },
                            { id: '310402', name: 'Kebayoran Lama' },
                            { id: '310403', name: 'Cilandak' },
                            { id: '310404', name: 'Pondok Indah' }
                        ]
                    };
                    
                    this.districts = districtData[this.selectedCity] || [];
                },

                onDistrictChange() {
                    // Optional: Additional logic when district changes
                },

                addServiceArea() {
                    if (!this.selectedProvince || !this.selectedCity || !this.selectedDistrict) {
                        this.showNotification('Harap lengkapi semua pilihan!', 'error');
                        return;
                    }

                    const provinceName = this.provinces.find(p => p.id === this.selectedProvince)?.name || '';
                    const cityName = this.cities.find(c => c.id === this.selectedCity)?.name || '';
                    const districtName = this.districts.find(d => d.id === this.selectedDistrict)?.name || '';

                    const fullName = `${districtName}, ${cityName}, ${provinceName}`;
                    
                    // Check if already exists
                    if (this.serviceAreas.some(area => area.fullName === fullName)) {
                        this.showNotification('Area layanan sudah ada!', 'error');
                        return;
                    }

                    this.serviceAreas.push({
                        province: provinceName,
                        city: cityName,
                        district: districtName,
                        fullName: fullName,
                        provinceId: this.selectedProvince,
                        cityId: this.selectedCity,
                        districtId: this.selectedDistrict
                    });

                    // Reset selections
                    this.selectedProvince = '';
                    this.selectedCity = '';
                    this.selectedDistrict = '';
                    this.cities = [];
                    this.districts = [];
                    this.currentStep = 1;

                    this.showNotification('Area layanan berhasil ditambahkan!', 'success');
                },

                addCommonArea(areaString) {
                    const parts = areaString.split(', ');
                    if (parts.length >= 2) {
                        const area = {
                            province: parts[parts.length - 1],
                            city: parts[parts.length - 2],
                            district: parts[0],
                            fullName: areaString,
                            provinceId: 'common',
                            cityId: 'common',
                            districtId: 'common'
                        };

                        if (!this.serviceAreas.some(existingArea => existingArea.fullName === areaString)) {
                            this.serviceAreas.push(area);
                            this.showNotification('Area populer berhasil ditambahkan!', 'success');
                        } else {
                            this.showNotification('Area layanan sudah ada!', 'error');
                        }
                    }
                },

                removeServiceArea(index) {
                    this.serviceAreas.splice(index, 1);
                    this.showNotification('Area layanan berhasil dihapus!', 'success');
                },

                saveServiceAreas() {
                    if (this.serviceAreas.length === 0) {
                        this.showNotification('Tidak ada area layanan untuk disimpan!', 'error');
                        return;
                    }

                    // Here you would typically send data to your backend
                    console.log('Saving service areas:', this.serviceAreas);
                    console.log('Current location:', { lat: this.currentLat, lng: this.currentLng });

                    this.showNotification(`${this.serviceAreas.length} area layanan berhasil disimpan!`, 'success');
                },

                showNotification(message, type = 'info') {
                    const notification = document.getElementById('notification');
                    if (notification) {
                        notification.textContent = message;
                        notification.className = `fixed top-4 right-4 px-4 py-2 rounded-lg border text-sm font-medium z-50 ${
                            type === 'success' ? 'bg-green-100 border-green-300 text-green-800' :
                            type === 'error' ? 'bg-red-100 border-red-300 text-red-800' :
                            'bg-blue-100 border-blue-300 text-blue-800'
                        }`;
                        notification.classList.remove('hidden');
                        
                        setTimeout(() => {
                            notification.classList.add('hidden');
                        }, 3000);
                    }
                }
            }
        }
    </script>
</body>
</html>