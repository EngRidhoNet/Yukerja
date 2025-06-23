<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Yuk Kerja</title>
    <meta name="description" content="Detail Transaksi Mitra Yuk Kerja">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        <div x-show="sidebarOpen && isMobile" @click="sidebarOpen = false"
            class="fixed inset-0 z-20 bg-black bg-opacity-60 lg:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak></div>
        @include('layouts.mitra.sidebar')
        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out"
            x-bind:class="{ 'lg:ml-200': !sidebarCollapsed && !isMobile, 'lg:ml-200': sidebarCollapsed && !isMobile }">
            <header class="flex items-center justify-between px-6 py-4 bg-white shadow-sm">
                <div class="flex items-center">
                    <button @click="toggleSidebar()" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-semibold text-gray-800 ml-4">Detail Transaksi</h1>
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
                                <p class="px-4 text-sm font-medium text-gray-800">{{ $user->name }}</p>
                                <p class="px-4 text-xs text-gray-500">{{ $user->email }}</p>
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
            <main class="flex-1 overflow-y-auto bg-gray-100 p-6">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Detail Transaksi</h2>
                    </div>
                    <div class="p-6">
                        <div class="divide-y divide-gray-200">
                            <div class="py-4">
                                <h3 class="text-base font-medium text-gray-800">Informasi Transaksi</h3>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Nomor Invoice</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->invoice_number }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Tanggal Pembayaran</p>
                                        <p class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::parse($transaction->payment_date)->translatedFormat('l, d M Y • H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Jumlah</p>
                                        <p class="text-sm font-medium text-gray-800">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Biaya Admin</p>
                                        <p class="text-sm font-medium text-gray-800">Rp{{ number_format($transaction->admin_fee, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Pendapatan Mitra</p>
                                        <p class="text-sm font-medium text-gray-800">Rp{{ number_format($transaction->mitra_earning, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Status Pembayaran</p>
                                        <p class="text-sm font-medium {{ $transaction->payment_status == 'completed' ? 'text-green-600' : ($transaction->payment_status == 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ ucfirst($transaction->payment_status) }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Metode Pembayaran</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->payment_method ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Referensi Transaksi</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->transaction_reference ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <h3 class="text-base font-medium text-gray-800">Informasi Pekerjaan</h3>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Judul Pekerjaan</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->jobPost->title }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Kategori</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->jobPost->serviceCategory->name ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Alamat</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->jobPost->address ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="py-4">
                                <h3 class="text-base font-medium text-gray-800">Informasi Pelanggan</h3>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Nama Pelanggan</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->customer->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Email</p>
                                        <p class="text-sm font-medium text-gray-800">{{ $transaction->customer->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('mitra.dashboard.transactions') }}" class="px-4 py-2 text-sm bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Kembali</a>
                        </div>
                    </div>
                </div>
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
                            <h3 class="text-xl font-bold text-gray-800 mt-3">Selamat Datang di Detail Transaksi!</h3>
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
</body>
</html>