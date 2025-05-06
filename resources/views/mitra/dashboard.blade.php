{{-- resources/views/dashboard-mitra.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mitra - Yuk Kerja</title>
    <meta name="description" content="Dashboard Mitra Yuk Kerja">
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-50">
        <!-- Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"
             x-cloak></div>

        <!-- Sidebar -->
        <div x-bind:class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" 
             class="fixed inset-y-0 left-0 z-30 w-64 transform transition duration-300 ease-in-out bg-gray-800 lg:translate-x-0 lg:static lg:inset-0">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-gray-800 px-4">
                <div class="flex items-center">
                    {{-- <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Logo" class=""> --}}
                    <div class="ml-2 text-white font-bold text-lg">
                        <div>Yuk</div>
                        <div class="-mt-1">Kerja</div>
                    </div>
                    <div class="ml-1 text-xs text-white px-2 py-0.5 bg-blue-500 rounded">Mitra</div>
                </div>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="mt-4">
                <a href="#" class="flex items-center px-6 py-3 text-white bg-blue-600 hover:bg-blue-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard Mitra
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Pekerjaan Terdekat
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Riwayat Pekerjaan
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Manajemen Area Layanan
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    Penawaran Masuk
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-2xl font-semibold text-gray-700 ml-2 lg:ml-0">Dashboard Mitra</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="flex items-center text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="ml-1 bg-yellow-500 rounded-full h-5 w-5 flex items-center justify-center text-white text-xs">4</span>
                    </button>
                    <div class="border-l pl-4 border-gray-200">
                        <button class="flex items-center focus:outline-none">
                            <div class="h-8 w-8 rounded-lg bg-gray-200 flex items-center justify-center">
                                <svg class="h-5 w-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <svg class="h-4 w-4 ml-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Active Jobs -->
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-gray-700">8</div>
                        <div class="text-lg font-medium text-gray-700">Pekerjaan Aktif</div>
                    </div>
                    
                    <!-- Completed Jobs -->
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-gray-700">24</div>
                        <div class="text-lg font-medium text-gray-700">Pekerjaan Selesai</div>
                    </div>
                    
                    <!-- Rating -->
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold text-gray-700">4,8</div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 ml-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                            </svg>
                        </div>
                        <div class="text-lg font-medium text-gray-700">Statistik Rating</div>
                    </div>
                    
                    <!-- Violations -->
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="text-lg font-medium text-gray-700">Jumlah Pelanggaran</div>
                    </div>
                </div>

                <!-- Pending Jobs Section -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-5 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-700">Pekerjaan yang belum tertangani</h2>
                    </div>
                    
                    <div class="p-4">
                        <div class="border-b border-gray-100 py-3">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="mb-2 md:mb-0">
                                    <span class="font-medium">Tambal Ban Setia Sukses</span>
                                </div>
                                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                    <span class="text-sm text-gray-500 mb-2 md:mb-0">12 April 2025 | 13.52</span>
                                    <button class="bg-gray-700 hover:bg-gray-800 text-white py-2 px-4 rounded">
                                        Tangani
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="py-3">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="mb-2 md:mb-0">
                                    <span class="font-medium">Tambal Ban Setia Sukses</span>
                                </div>
                                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                    <span class="text-sm text-gray-500 mb-2 md:mb-0">12 April 2025 | 13.52</span>
                                    <button class="bg-gray-700 hover:bg-gray-800 text-white py-2 px-4 rounded">
                                        Tangani
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>