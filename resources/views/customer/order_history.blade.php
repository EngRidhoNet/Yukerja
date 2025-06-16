<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YukKerja - Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .status-pending { @apply bg-yellow-100 text-yellow-800 border border-yellow-200; }
        .status-paid { @apply bg-green-100 text-green-800 border border-green-200; }
        .status-failed { @apply bg-red-100 text-red-800 border border-red-200; }
        .status-refunded { @apply bg-gray-100 text-gray-800 border border-gray-200; }
        
        .loading-overlay {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(2px);
        }
        
        .animate-pulse-custom {
            animation: pulse 1.5s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .hover-scale {
            transition: transform 0.2s ease;
        }
        
        .hover-scale:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        
        @include('layouts.customer.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <nav class="px-4 py-3 flex items-center justify-between">
                    <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none hover:text-blue-600 transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Search Bar -->
                    <div class="flex-grow mx-2 md:mx-4 max-w-xl relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="searchInput" class="w-full pl-10 pr-10 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm md:text-base" placeholder="Cari riwayat pesanan...">
                        <button id="refreshBtn" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors" title="Refresh data">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                    
                    <!-- Right Side Icons -->
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600 transition-colors"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">1</span>
                        </a>
                        <div class="relative group">
                            <button class="focus:outline-none">
                                <img src="https://via.placeholder.com/32/4B5563/FFFFFF?text={{ auth()->user()->name[0] }}" alt="Profile" class="rounded-full w-8 h-8 border-2 border-gray-200">
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-200">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-50 rounded-t-lg">Profil</a>
                                <a href="{{ route('customer.dashboard.history') }}" class="block px-4 py-2 text-gray-800 bg-blue-50 border-l-4 border-blue-500">Pesanan</a>
                                <hr>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-50 rounded-b-lg">Keluar</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Content -->
            <main class="px-4 py-4 md:py-6 flex-1 overflow-y-auto">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Riwayat Pesanan</h1>
                        <p class="text-gray-600 mt-1">Kelola dan lihat semua riwayat transaksi Anda</p>
                    </div>
                    
                    <!-- Filter Buttons -->
                    <div class="flex flex-wrap gap-2">
                        <button onclick="filterOrders('all')" class="filter-btn bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-all duration-200 shadow-sm">
                            <i class="fas fa-list mr-1"></i> Semua
                        </button>
                        <button onclick="filterOrders('paid')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition-all duration-200 shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i> Lunas
                        </button>
                        <button onclick="filterOrders('pending')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition-all duration-200 shadow-sm">
                            <i class="fas fa-clock mr-1"></i> Pending
                        </button>
                        <button onclick="filterOrders('failed')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition-all duration-200 shadow-sm">
                            <i class="fas fa-times-circle mr-1"></i> Gagal
                        </button>
                        <button onclick="exportToCSV()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-all duration-200 shadow-sm">
                            <i class="fas fa-download mr-1"></i> Export CSV
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover-scale">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-blue-100">
                                <i class="fas fa-shopping-cart text-blue-600 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                                <p class="text-xl font-bold text-gray-900 stats-total">{{ $stats['total'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover-scale">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-green-100">
                                <i class="fas fa-check-circle text-green-600 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Selesai</p>
                                <p class="text-xl font-bold text-gray-900 stats-completed">{{ $stats['completed'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover-scale">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-yellow-100">
                                <i class="fas fa-clock text-yellow-600 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Pending</p>
                                <p class="text-xl font-bold text-gray-900 stats-pending">{{ $stats['pending'] }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 hover-scale">
                        <div class="flex items-center">
                            <div class="p-3 rounded-lg bg-red-100">
                                <i class="fas fa-times-circle text-red-600 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Dibatalkan</p>
                                <p class="text-xl font-bold text-gray-900 stats-failed">{{ $stats['failed'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden relative">
                    <!-- Loading Overlay -->
                    <div id="loadingOverlay" class="absolute inset-0 loading-overlay flex items-center justify-center z-10 hidden">
                        <div class="text-center">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-3"></div>
                            <p class="text-gray-600">Memuat data...</p>
                        </div>
                    </div>
                    
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Pesanan</h3>
                    </div>
                    
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Invoice</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mitra</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200" id="ordersTableBody">
                                <!-- Order rows will be inserted by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Mobile Cards -->
                    <div class="md:hidden" id="mobileOrdersList">
                        <!-- Mobile order cards will be inserted by JavaScript -->
                    </div>
                    
                    <!-- Empty State -->
                    <div id="emptyState" class="hidden text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-shopping-cart text-6xl"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pesanan</h3>
                        <p class="text-gray-600">Anda belum memiliki riwayat pesanan</p>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6 pagination-container">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium pagination-showing">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}</span> sampai 
                        <span class="font-medium pagination-to">{{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}</span> dari 
                        <span class="font-medium pagination-total">{{ $pagination['total'] }}</span> hasil
                    </div>
                    <div class="flex items-center space-x-2" id="paginationControls">
                        <!-- Pagination controls will be generated by JavaScript -->
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-xl rounded-xl bg-white">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-900">Detail Pesanan</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="modalContent">
                <!-- Modal content will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="messageContainer" class="fixed top-4 right-4 z-50"></div>

    <!-- Scripts -->
    <script>
        // Initial transaction data from Blade
        let ordersData = @json($transactions);
        let currentFilter = 'all';
        let currentOrders = ordersData;
        let currentPage = {{ $pagination['current_page'] }};
        let totalPages = {{ $pagination['last_page'] }};

        // Sidebar functionality
        const menuToggle = document.getElementById('menu-toggle');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebarFn() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        menuToggle.addEventListener('click', openSidebar);
        closeSidebar && closeSidebar.addEventListener('click', closeSidebarFn);
        overlay.addEventListener('click', closeSidebarFn);

        // Show loading
        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }

        // Hide loading
        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hidden');
        }

        // Show message
        function showMessage(message, type = 'success') {
            const container = document.getElementById('messageContainer');
            const messageDiv = document.createElement('div');
            const icon = type === 'success' ? 'fa-check' : 'fa-exclamation-triangle';
            const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
            
            messageDiv.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg mb-2 transform transition-all duration-300`;
            messageDiv.innerHTML = `<i class="fas ${icon} mr-2"></i>${message}`;
            
            container.appendChild(messageDiv);
            
            setTimeout(() => {
                messageDiv.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => messageDiv.remove(), 300);
            }, 3000);
        }

        // Filter functionality
        function filterOrders(status) {
            currentFilter = status;
            
            // Update filter button styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            event.target.classList.remove('bg-gray-200', 'text-gray-700');
            event.target.classList.add('bg-blue-600', 'text-white');
            
            // Update URL with status filter
            const url = new URL(window.location);
            url.searchParams.set('status', status);
            url.searchParams.delete('page');
            window.history.pushState({}, '', url);
            
            // Fetch filtered data
            refreshData();
        }

        // Search functionality
        let searchTimeout;
        document.getElementById('searchInput').addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value;
                const url = new URL(window.location);
                if (searchTerm) {
                    url.searchParams.set('search', searchTerm);
                } else {
                    url.searchParams.delete('search');
                }
                url.searchParams.delete('page');
                window.history.pushState({}, '', url);
                refreshData();
            }, 500);
        });

        // Format currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        // Format date
        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Get status badge
        function getStatusBadge(status) {
            const statusMap = {
                'paid': { text: 'Lunas', class: 'status-paid', icon: 'fa-check-circle' },
                'pending': { text: 'Pending', class: 'status-pending', icon: 'fa-clock' },
                'failed': { text: 'Gagal', class: 'status-failed', icon: 'fa-times-circle' },
                'refunded': { text: 'Refund', class: 'status-refunded', icon: 'fa-undo' }
            };
            
            const statusInfo = statusMap[status] || { text: status, class: 'status-pending', icon: 'fa-clock' };
            return `<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ${statusInfo.class}">
                        <i class="fas ${statusInfo.icon} mr-1"></i>${statusInfo.text}
                    </span>`;
        }

        // Render orders for desktop table
        function renderDesktopOrders() {
            const tbody = document.getElementById('ordersTableBody');
            tbody.innerHTML = '';
            
            if (currentOrders.length === 0) {
                document.getElementById('emptyState').classList.remove('hidden');
                return;
            }
            
            document.getElementById('emptyState').classList.add('hidden');
            
            currentOrders.forEach(order => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50 transition-colors duration-150';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${order.invoice_number}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 max-w-xs truncate" title="${order.job_title}">${order.job_title}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${order.mitra_name}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">${formatCurrency(order.amount)}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getStatusBadge(order.payment_status)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${formatDate(order.created_at)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="showOrderDetail(${order.id})" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-150">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Render orders for mobile cards
        function renderMobileOrders() {
            const container = document.getElementById('mobileOrdersList');
            container.innerHTML = '';
            
            if (currentOrders.length === 0) {
                document.getElementById('emptyState').classList.remove('hidden');
                return;
            }
            
            document.getElementById('emptyState').classList.add('hidden');
            
            currentOrders.forEach(order => {
                const card = document.createElement('div');
                card.className = 'p-4 border-b border-gray-200 last:border-b-0 hover:bg-gray-50 transition-colors duration-150';
                card.innerHTML = `
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900 text-sm">${order.invoice_number}</p>
                            <p class="text-sm text-gray-600 mt-1 truncate">${order.job_title}</p>
                        </div>
                        ${getStatusBadge(order.payment_status)}
                    </div>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-gray-600">
                            <i class="fas fa-user mr-1"></i>${order.mitra_name}
                        </span>
                        <span class="font-semibold text-gray-900">${formatCurrency(order.amount)}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            <i class="fas fa-calendar mr-1"></i>${formatDate(order.created_at)}
                        </span>
                        <button onclick="showOrderDetail(${order.id})" class="text-blue-600 text-sm font-medium hover:text-blue-800 transition-colors duration-150">
                            <i class="fas fa-eye mr-1"></i> Detail
                        </button>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        // Render orders (both desktop and mobile)
        function renderOrders() {
            renderDesktopOrders();
            renderMobileOrders();
        }

        // Show order detail modal
        function showOrderDetail(orderId) {
            showLoading();
            
            fetch(`/customer/dashboard/history/${orderId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(result => {
                hideLoading();
                
                if (!result.success) {
                    showMessage('Gagal memuat detail pesanan', 'error');
                    return;
                }
                
                const order = result.data;
                const modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">No. Invoice</label>
                                    <p class="text-sm text-gray-900 font-mono bg-white px-3 py-2 rounded border">${order.invoice_number}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                                    <div class="mt-1">${getStatusBadge(order.payment_status)}</div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Total Pembayaran</label>
                                    <p class="text-lg font-bold text-blue-600">${formatCurrency(order.amount)}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <h4 class="font-semibold text-gray-900 border-b pb-2">Informasi Layanan</h4>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Layanan</label>
                                    <p class="text-sm text-gray-900">${order.job_title}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Mitra</label>
                                    <p class="text-sm text-gray-900">${order.mitra_name}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                                    <p class="text-sm text-gray-900">${order.payment_method || '-'}</p>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <h4 class="font-semibold text-gray-900 border-b pb-2">Rincian Pembayaran</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Pendapatan Mitra:</span>
                                        <span class="text-sm font-medium">${formatCurrency(order.mitra_earning)}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Biaya Admin:</span>
                                        <span class="text-sm font-medium">${formatCurrency(order.admin_fee)}</span>
                                    </div>
                                    <div class="flex justify-between border-t pt-2">
                                        <span class="font-semibold">Total:</span>
                                        <span class="font-bold text-blue-600">${formatCurrency(order.amount)}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-900 mb-3">Informasi Transaksi</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pesanan</label>
                                    <p class="text-sm text-gray-900">${formatDate(order.created_at)}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembayaran</label>
                                    <p class="text-sm text-gray-900">${formatDate(order.payment_date)}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Referensi Transaksi</label>
                                    <p class="text-sm text-gray-900 font-mono bg-white px-3 py-2 rounded border">${order.transaction_reference || '-'}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                            <button onclick="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-150">
                                Tutup
                            </button>
                            ${order.payment_status === 'paid' ? `
                                <button onclick="downloadInvoice(${order.id})" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 transition-colors duration-150">
                                    <i class="fas fa-download mr-1"></i> Download Invoice
                                </button>
                            ` : ''}
                        </div>
                    </div>
                `;
                document.getElementById('orderModal').classList.remove('hidden');
            })
            .catch(error => {
                hideLoading();
                console.error('Error fetching order details:', error);
                showMessage('Gagal memuat detail pesanan', 'error');
            });
        }

        // Close modal
        function closeModal() {
            document.getElementById('orderModal').classList.add('hidden');
        }

        // Download invoice
        function downloadInvoice(orderId) {
            fetch(`/customer/dashboard/history/${orderId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(result => {
                if (!result.success) {
                    showMessage('Gagal memuat data invoice', 'error');
                    return;
                }
                
                const order = result.data;
                const invoiceContent = `
                    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; line-height: 1.6;">
                        <div style="text-align: center; margin-bottom: 30px; border-bottom: 3px solid #0B2F57; padding-bottom: 20px;">
                            <h1 style="color: #0B2F57; margin-bottom: 5px; font-size: 32px;">YukKerja</h1>
                            <h2 style="color: #666; margin-top: 0; font-size: 24px;">Invoice</h2>
                        </div>
                        
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #0B2F57;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <strong>No. Invoice:</strong>
                                <span style="font-family: monospace; background: white; padding: 2px 8px; border-radius: 4px;">${order.invoice_number}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                <strong>Tanggal:</strong>
                                <span>${formatDate(order.created_at)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <strong>Status:</strong>
                                <span style="color: #28a745; font-weight: bold; background: #d4edda; padding: 2px 8px; border-radius: 4px;">${order.payment_status.toUpperCase()}</span>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <h3 style="color: #0B2F57; border-bottom: 2px solid #0B2F57; padding-bottom: 5px; margin-bottom: 15px;">Detail Layanan</h3>
                            <div style="background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span><strong>Layanan:</strong></span>
                                    <span>${order.job_title}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span><strong>Mitra:</strong></span>
                                    <span>${order.mitra_name}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                    <span><strong>Metode Pembayaran:</strong></span>
                                    <span>${order.payment_method || '-'}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div style="border: 2px solid #0B2F57; border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                            <h3 style="color: #0B2F57; margin-bottom: 15px; text-align: center;">Rincian Pembayaran</h3>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; padding: 5px 0;">
                                <span>Subtotal (Pendapatan Mitra):</span>
                                <span>${formatCurrency(order.mitra_earning)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px; padding: 5px 0;">
                                <span>Biaya Admin:</span>
                                <span>${formatCurrency(order.admin_fee)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; padding: 15px 0; border-top: 2px solid #0B2F57; margin-top: 10px;">
                                <span>Total Pembayaran:</span>
                                <span style="color: #0B2F57; background: #e3f2fd; padding: 5px 10px; border-radius: 5px;">${formatCurrency(order.amount)}</span>
                            </div>
                        </div>
                        
                        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                            <h4 style="color: #0B2F57; margin-bottom: 10px;">Informasi Transaksi</h4>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span>Tanggal Pembayaran:</span>
                                <span>${formatDate(order.payment_date)}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span>Referensi:</span>
                                <span style="font-family: monospace; font-size: 12px;">${order.transaction_reference || '-'}</span>
                            </div>
                        </div>
                        
                        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 12px;">
                            <p style="margin-bottom: 5px;"><strong>Terima kasih telah menggunakan layanan YukKerja!</strong></p>
                            <p style="margin-bottom: 5px;">Invoice ini dibuat secara otomatis dan sah tanpa tanda tangan.</p>
                            <p style="margin-bottom: 0;">Untuk pertanyaan, hubungi customer service kami.</p>
                        </div>
                    </div>
                `;
                
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Invoice ${order.invoice_number}</title>
                        <style>
                            @media print {
                                body { margin: 0; }
                                .no-print { display: none !important; }
                            }
                            body { font-family: Arial, sans-serif; }
                        </style>
                    </head>
                    <body>
                        ${invoiceContent}
                        <div class="no-print" style="text-align: center; margin-top: 20px; padding: 20px; border-top: 2px solid #0B2F57;">
                            <button onclick="window.print()" style="background: #0B2F57; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px; font-size: 14px;">
                                <i class="fas fa-print"></i> Print Invoice
                            </button>
                            <button onclick="window.close()" style="background: #6c757d; color: white; padding: 12px 24px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px;">
                                <i class="fas fa-times"></i> Close
                            </button>
                        </div>
                    </body>
                    </html>
                `);
                printWindow.document.close();
            });
        }

        // Export to CSV
        function exportToCSV() {
            const search = document.getElementById('searchInput').value;
            const status = currentFilter;
            const url = `/customer/dashboard/history/export?status=${status}${search ? '&search=' + encodeURIComponent(search) : ''}`;
            window.location.href = url;
            showMessage('Export CSV dimulai...');
        }

        // Refresh data
        function refreshData() {
            showLoading();
            const url = new URL(window.location);
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                ordersData = data.transactions;
                currentOrders = ordersData;
                renderOrders();
                
                // Update stats
                document.querySelector('.stats-total').textContent = data.stats.total;
                document.querySelector('.stats-completed').textContent = data.stats.completed;
                document.querySelector('.stats-pending').textContent = data.stats.pending;
                document.querySelector('.stats-failed').textContent = data.stats.failed;
                
                // Update pagination info
                updatePaginationInfo(data.pagination);
                
                showMessage('Data berhasil diperbarui');
            })
            .catch(error => {
                hideLoading();
                console.error('Error refreshing data:', error);
                showMessage('Gagal memperbarui data', 'error');
            });
        }

        // Update pagination info
        function updatePaginationInfo(pagination) {
            document.querySelector('.pagination-showing').textContent = (pagination.current_page - 1) * pagination.per_page + 1;
            document.querySelector('.pagination-to').textContent = Math.min(pagination.current_page * pagination.per_page, pagination.total);
            document.querySelector('.pagination-total').textContent = pagination.total;
            
            currentPage = pagination.current_page;
            totalPages = pagination.last_page;
            
            renderPaginationControls();
        }

        // Render pagination controls
        function renderPaginationControls() {
            const container = document.getElementById('paginationControls');
            container.innerHTML = '';
            
            // Previous button
            if (currentPage > 1) {
                const prevBtn = document.createElement('a');
                prevBtn.href = '#';
                prevBtn.className = 'px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors duration-150';
                prevBtn.innerHTML = '<i class="fas fa-chevron-left"></i>';
                prevBtn.onclick = (e) => {
                    e.preventDefault();
                    changePage(currentPage - 1);
                };
                container.appendChild(prevBtn);
            }
            
            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('a');
                pageBtn.href = '#';
                pageBtn.className = `px-3 py-2 text-sm font-medium rounded-md transition-colors duration-150 ${
                    currentPage === i 
                        ? 'text-white bg-blue-600 border border-transparent' 
                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-50'
                }`;
                pageBtn.textContent = i;
                pageBtn.onclick = (e) => {
                    e.preventDefault();
                    changePage(i);
                };
                container.appendChild(pageBtn);
            }
            
            // Next button
            if (currentPage < totalPages) {
                const nextBtn = document.createElement('a');
                nextBtn.href = '#';
                nextBtn.className = 'px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors duration-150';
                nextBtn.innerHTML = '<i class="fas fa-chevron-right"></i>';
                nextBtn.onclick = (e) => {
                    e.preventDefault();
                    changePage(currentPage + 1);
                };
                container.appendChild(nextBtn);
            }
        }

        // Change page
        function changePage(page) {
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            window.history.pushState({}, '', url);
            refreshData();
        }

        // Add refresh button listener
        document.getElementById('refreshBtn').addEventListener('click', (e) => {
            e.preventDefault();
            const refreshIcon = e.target;
            refreshIcon.style.animation = 'spin 1s linear';
            setTimeout(() => refreshIcon.style.animation = '', 1000);
            refreshData();
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
            }
        });

        // Close sidebar/modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                if (!sidebar.classList.contains('-translate-x-full') && window.innerWidth < 768) {
                    closeSidebarFn();
                }
                if (!document.getElementById('orderModal').classList.contains('hidden')) {
                    closeModal();
                }
            }
        });

        // Close modal when clicking outside
        document.getElementById('orderModal').addEventListener('click', (e) => {
            if (e.target.id === 'orderModal') {
                closeModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            renderOrders();
            renderPaginationControls();
            
            // Set initial filter based on URL
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status') || 'all';
            const search = urlParams.get('search') || '';
            
            if (search) document.getElementById('searchInput').value = search;
            
            // Set active filter button
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            const activeBtn = document.querySelector(`button[onclick="filterOrders('${status}')"]`);
            if (activeBtn) {
                activeBtn.classList.remove('bg-gray-200', 'text-gray-700');
                activeBtn.classList.add('bg-blue-600', 'text-white');
            }
            
            currentFilter = status;
        });

        // Add CSS animation for spin
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>