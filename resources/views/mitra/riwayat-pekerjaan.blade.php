<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pekerjaan - Yuk Kerja</title>
    <meta name="description" content="Riwayat Pekerjaan Yuk Kerja">
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
        showTutorial: !localStorage.getItem('riwayatTutorialShown'),
        showJobModal: false,
        jobDetails: null,
        loading: false,
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
            localStorage.setItem('riwayatTutorialShown', true);
        },
        async openJobModal(jobId) {
            this.loading = true;
            this.showJobModal = true;
            try {
                const response = await fetch('{{ url('/mitra/job') }}/' + jobId + '/detail');
                if (!response.ok) throw new Error('Failed to fetch job details');
                this.jobDetails = await response.json();
            } catch (error) {
                console.error(error);
                this.jobDetails = { error: 'Failed to load job details' };
            } finally {
                this.loading = false;
            }
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
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Riwayat Pekerjaan</h1>
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
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                <!-- Job History Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Riwayat Pekerjaan</h2>
                        <div x-data="{ showFilter: false }" class="relative">
                            <button @click="showFilter = !showFilter" aria-label="Filter Jobs"
                                class="flex items-center text-sm text-gray-600 hover:text-gray-800">
                                <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>
                            <div x-show="showFilter" @click.away="showFilter = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg z-50 dropdown-transition" x-cloak>
                                <form method="GET" action="{{ route('mitra.dashboard.riwayat') }}">
                                    <div class="p-4">
                                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Filter Riwayat</h3>
                                        <div class="mb-4">
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Pekerjaan</label>
                                            <select name="category" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Semua</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal</label>
                                            <select name="date" class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Semua</option>
                                                <option value="this_month" {{ request('date') == 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                                                <option value="last_month" {{ request('date') == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                                                <option value="this_year" {{ request('date') == 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('mitra.dashboard.riwayat') }}" class="px-3 py-1 text-sm text-gray-600 hover:text-gray-800">Reset</a>
                                            <button type="submit" class="px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                                Terapkan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Sorting Controls -->
                    <div class="px-6 py-3 bg-gray-50 flex justify-end space-x-4 text-sm text-gray-600">
                        <div>
                            Urutkan:
                            <a href="{{ route('mitra.dashboard.riwayat', array_merge(request()->query(), ['sort' => 'scheduled_date', 'direction' => request('sort') == 'scheduled_date' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="ml-2 {{ request('sort', 'scheduled_date') == 'scheduled_date' ? 'font-semibold text-blue-600' : 'hover:text-blue-600' }}">
                                Tanggal {{ request('sort') == 'scheduled_date' ? (request('direction') == 'asc' ? '↑' : '↓') : '' }}
                            </a>
                            <a href="{{ route('mitra.dashboard.riwayat', array_merge(request()->query(), ['sort' => 'budget', 'direction' => request('sort') == 'budget' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="ml-2 {{ request('sort') == 'budget' ? 'font-semibold text-blue-600' : 'hover:text-blue-600' }}">
                                Bid Amount {{ request('sort') == 'budget' ? (request('direction') == 'asc' ? '↑' : '↓') : '' }}
                            </a>
                            <a href="{{ route('mitra.dashboard.riwayat', array_merge(request()->query(), ['sort' => 'rating', 'direction' => request('sort') == 'rating' && request('direction') == 'asc' ? 'desc' : 'asc'])) }}"
                                class="ml-2 {{ request('sort') == 'rating' ? 'font-semibold text-blue-600' : 'hover:text-blue-600' }}">
                                Rating {{ request('sort') == 'rating' ? (request('direction') == 'asc' ? '↑' : '↓') : '' }}
                            </a>
                        </div>
                    </div>
                    <!-- Jobs List -->
                    <div class="divide-y divide-gray-200">
                        @forelse($jobs as $job)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between">
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $job->title }}</h3>
                                        <div class="text-sm text-gray-500 mt-1">{{ $job->address }}</div>
                                        <div class="text-xs text-gray-400 mt-1">{{ $job->serviceCategory->name }}</div>
                                    </div>
                                    <div class="text-right">
                                        {{-- <div class="text-sm font-medium text-gray-800">Rp{{ number_format($job->jobApplications->first()->bid_amount, 0, ',', '.') }}</div> --}}
                                        <div class="flex items-center justify-end text-sm text-yellow-600 mt-1">
                                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <span>{{ number_format($job->reviews->avg('rating'), 1) ?: 'Belum dinilai' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ \Carbon\Carbon::parse($job->scheduled_date)->translatedFormat('l, d M Y • H:i') }}</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button @click="openJobModal({{ $job->id }})" class="px-3 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                            Lihat Detail
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-gray-500">
                                Tidak ada riwayat pekerjaan yang tersedia.
                            </div>
                        @endforelse
                    </div>
                    <!-- Pagination -->
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        {{ $jobs->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
                <!-- Job Detail Modal -->
                <div x-show="showJobModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50" x-cloak>
                    <div class="bg-white rounded-xl shadow-xl p-6 max-w-lg w-full mx-4" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Detail Pekerjaan</h3>
                            <button @click="showJobModal = false" class="text-gray-500 hover:text-gray-700">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div x-show="loading" class="text-center text-gray-500">Memuat...</div>
                        <div x-show="!loading && jobDetails">
                            <template x-if="jobDetails.error">
                                <p class="text-red-600" x-text="jobDetails.error"></p>
                            </template>
                            <template x-if="!jobDetails.error">
                                <div>
                                    <h4 class="text-base font-medium text-gray-800" x-text="jobDetails.title"></h4>
                                    <p class="text-sm text-gray-500 mt-1" x-text="jobDetails.address"></p>
                                    <p class="text-xs text-gray-400 mt-1" x-text="jobDetails.category"></p>
                                    <p class="text-sm font-medium text-gray-800 mt-2">Bid Amount: Rp<span x-text="jobDetails.bid_amount"></span></p>
                                    <p class="text-sm text-gray-500 mt-1">Jarak: <span x-text="jobDetails.distance"></span> km</p>
                                    <p class="text-sm text-gray-500 mt-1">Tanggal: <span x-text="jobDetails.scheduled_date"></span></p>
                                    <p class="text-sm text-gray-500 mt-1">Estimasi Selesai: <span x-text="jobDetails.estimated_completion_time"></span></p>
                                    <p class="text-sm text-gray-600 mt-2" x-text="jobDetails.description"></p>
                                    <p class="text-sm text-gray-600 mt-2" x-text="jobDetails.message ? 'Pesan: ' + jobDetails.message : 'Pesan: Tidak ada pesan'"></p>
                                </div>
                            </template>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button @click="showJobModal = false" class="px-4 py-2 text-sm bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Tutup</button>
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
                            <h3 class="text-xl font-bold text-gray-800 mt-3">Selamat Datang di Riwayat Pekerjaan!</h3>
                            <p class="text-gray-600 mt-2 text-sm">Lihat semua pekerjaan yang telah Anda selesaikan. Gunakan filter untuk mencari berdasarkan kategori atau tanggal, dan urutkan sesuai kebutuhan Anda.</p>
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
</body>
</html>