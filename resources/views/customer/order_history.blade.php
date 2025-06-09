<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .status-pending { @apply bg-yellow-100 text-yellow-800; }
        .status-paid { @apply bg-green-100 text-green-800; }
        .status-failed { @apply bg-red-100 text-red-800; }
        .status-refunded { @apply bg-gray-100 text-gray-800; }
    </style>
</head>
<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        
        @include('layouts.customer.sidebar')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <nav class="px-4 py-3 flex items-center justify-between">
                    <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none hover:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Search Bar -->
                    <div class="flex-grow mx-2 md:mx-4 max-w-xl relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base" placeholder="Cari riwayat pesanan...">
                    </div>
                    
                    <!-- Right Side Icons -->
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">1</span>
                        </a>
                        <div class="relative group">
                            <button class="focus:outline-none">
                                <img src="https://via.placeholder.com/32/4B5563/FFFFFF?text=P" alt="Profile" class="rounded-full w-8 h-8">
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan</a>
                                <hr>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Keluar</a>
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
                        <button onclick="filterOrders('all')" class="filter-btn bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200">
                            Semua
                        </button>
                        <button onclick="filterOrders('paid')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors duration-200">
                            <i class="fas fa-check-circle mr-1"></i> Lunas
                        </button>
                        <button onclick="filterOrders('pending')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors duration-200">
                            <i class="fas fa-clock mr-1"></i> Pending
                        </button>
                        <button onclick="filterOrders('failed')" class="filter-btn bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors duration-200">
                            <i class="fas fa-times-circle mr-1"></i> Gagal
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-blue-100">
                                <i class="fas fa-shopping-cart text-blue-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Total Pesanan</p>
                                <p class="text-xl font-semibold text-gray-900">127</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-green-100">
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Selesai</p>
                                <p class="text-xl font-semibold text-gray-900">98</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-yellow-100">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Pending</p>
                                <p class="text-xl font-semibold text-gray-900">24</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-lg p-4 shadow-sm border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-red-100">
                                <i class="fas fa-times-circle text-red-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-600">Dibatalkan</p>
                                <p class="text-xl font-semibold text-gray-900">5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Daftar Pesanan</h3>
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
                                <!-- Order rows will be inserted here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Mobile Cards -->
                    <div class="md:hidden" id="mobileOrdersList">
                        <!-- Mobile order cards will be inserted here by JavaScript -->
                    </div>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-700">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">127</span> hasil
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md">1</button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">2</button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">3</button>
                        <button class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Pesanan</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="modalContent">
                <!-- Modal content will be inserted here -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sample data - replace with actual data from your backend
        const ordersData = [
            {
                id: 1,
                invoice_number: 'INV-2024-001',
                job_title: 'Tambal Ban Motor',
                mitra_name: 'Setia Sukses',
                amount: 15000,
                admin_fee: 1500,
                mitra_earning: 13500,
                payment_status: 'paid',
                payment_method: 'Dana',
                payment_date: '2024-01-15 10:30:00',
                transaction_reference: 'TXN123456789',
                created_at: '2024-01-15 09:00:00'
            },
            {
                id: 2,
                invoice_number: 'INV-2024-002',
                job_title: 'Service AC',
                mitra_name: 'Jaya Motor',
                amount: 75000,
                admin_fee: 7500,
                mitra_earning: 67500,
                payment_status: 'pending',
                payment_method: null,
                payment_date: null,
                transaction_reference: null,
                created_at: '2024-01-16 14:20:00'
            },
            {
                id: 3,
                invoice_number: 'INV-2024-003',
                job_title: 'Cuci Motor',
                mitra_name: 'Mandiri Service',
                amount: 25000,
                admin_fee: 2500,
                mitra_earning: 22500,
                payment_status: 'failed',
                payment_method: 'OVO',
                payment_date: null,
                transaction_reference: 'TXN987654321',
                created_at: '2024-01-17 11:45:00'
            },
            {
                id: 4,
                invoice_number: 'INV-2024-004',
                job_title: 'Ganti Oli',
                mitra_name: 'Barokah Motor',
                amount: 45000,
                admin_fee: 4500,
                mitra_earning: 40500,
                payment_status: 'paid',
                payment_method: 'GoPay',
                payment_date: '2024-01-18 16:15:00',
                transaction_reference: 'TXN456789123',
                created_at: '2024-01-18 15:30:00'
            }
        ];

        let currentFilter = 'all';
        let currentOrders = ordersData;

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
        closeSidebar.addEventListener('click', closeSidebarFn);
        overlay.addEventListener('click', closeSidebarFn);

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
            
            // Filter orders
            if (status === 'all') {
                currentOrders = ordersData;
            } else {
                currentOrders = ordersData.filter(order => order.payment_status === status);
            }
            
            renderOrders();
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            currentOrders = ordersData.filter(order => 
                order.invoice_number.toLowerCase().includes(searchTerm) ||
                order.job_title.toLowerCase().includes(searchTerm) ||
                order.mitra_name.toLowerCase().includes(searchTerm)
            );
            renderOrders();
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
                'paid': { text: 'Lunas', class: 'status-paid' },
                'pending': { text: 'Pending', class: 'status-pending' },
                'failed': { text: 'Gagal', class: 'status-failed' },
                'refunded': { text: 'Refund', class: 'status-refunded' }
            };
            
            const statusInfo = statusMap[status] || { text: status, class: 'status-pending' };
            return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusInfo.class}">${statusInfo.text}</span>`;
        }

        // Render orders for desktop table
        function renderDesktopOrders() {
            const tbody = document.getElementById('ordersTableBody');
            tbody.innerHTML = '';
            
            currentOrders.forEach(order => {
                const row = document.createElement('tr');
                row.className = 'hover:bg-gray-50';
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${order.invoice_number}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${order.job_title}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${order.mitra_name}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">${formatCurrency(order.amount)}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        ${getStatusBadge(order.payment_status)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${formatDate(order.created_at)}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button onclick="showOrderDetail(${order.id})" class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-eye"></i> Detail
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
            
            currentOrders.forEach(order => {
                const card = document.createElement('div');
                card.className = 'p-4 border-b border-gray-200 last:border-b-0';
                card.innerHTML = `
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="font-medium text-gray-900">${order.invoice_number}</p>
                            <p class="text-sm text-gray-600">${order.job_title}</p>
                        </div>
                        ${getStatusBadge(order.payment_status)}
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-600">${order.mitra_name}</span>
                        <span class="font-medium text-gray-900">${formatCurrency(order.amount)}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">${formatDate(order.created_at)}</span>
                        <button onclick="showOrderDetail(${order.id})" class="text-blue-600 text-sm font-medium">
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
            const order = ordersData.find(o => o.id === orderId);
            if (!order) return;
            
            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. Invoice</label>
                            <p class="mt-1 text-sm text-gray-900">${order.invoice_number}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                            <div class="mt-1">${getStatusBadge(order.payment_status)}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Layanan</label>
                            <p class="mt-1 text-sm text-gray-900">${order.job_title}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mitra</label>
                            <p class="mt-1 text-sm text-gray-900">${order.mitra_name}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                            <p class="mt-1 text-sm font-medium text-gray-900">${formatCurrency(order.amount)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Biaya Admin</label>
                            <p class="mt-1 text-sm text-gray-900">${formatCurrency(order.admin_fee)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pendapatan Mitra</label>
                            <p class="mt-1 text-sm text-gray-900">${formatCurrency(order.mitra_earning)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                            <p class="mt-1 text-sm text-gray-900">${order.payment_method || '-'}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pesanan</label>
                            <p class="mt-1 text-sm text-gray-900">${formatDate(order.created_at)}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pembayaran</label>
                            <p class="mt-1 text-sm text-gray-900">${order.payment_date ? formatDate(order.payment_date) : '-'}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Referensi Transaksi</label>
                            <p class="mt-1 text-sm text-gray-900 font-mono">${order.transaction_reference || '-'}</p>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button onclick="closeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Tutup
                        </button>
                        ${order.payment_status === 'paid' ? `
                            <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                <i class="fas fa-download mr-1"></i> Download Invoice
                            </button>
                        ` : ''}
                    </div>
                </div>
            `;
            
            document.getElementById('orderModal').classList.remove('hidden');
        }

        // Close modal
        function closeModal() {
            document.getElementById('orderModal').classList.add('hidden');
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
            }
        });

        // Close sidebar on escape key
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

        // Download invoice function
        function downloadInvoice(orderId) {
            const order = ordersData.find(o => o.id === orderId);
            if (!order) return;
            
            // Create a simple invoice content
            const invoiceContent = `
                <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px;">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h1 style="color: #0B2F57; margin-bottom: 5px;">YukKerja</h1>
                        <h2 style="color: #666; margin-top: 0;">Invoice</h2>
                    </div>
                    
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>No. Invoice:</strong>
                            <span>${order.invoice_number}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Tanggal:</strong>
                            <span>${formatDate(order.created_at)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <strong>Status:</strong>
                            <span style="color: #28a745; font-weight: bold;">${order.payment_status.toUpperCase()}</span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <h3 style="color: #0B2F57; border-bottom: 2px solid #0B2F57; padding-bottom: 5px;">Detail Layanan</h3>
                        <div style="padding: 10px 0;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span>Layanan:</span>
                                <span>${order.job_title}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span>Mitra:</span>
                                <span>${order.mitra_name}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span>Metode Pembayaran:</span>
                                <span>${order.payment_method || '-'}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="border-top: 2px solid #0B2F57; padding-top: 15px;">
                        <h3 style="color: #0B2F57; margin-bottom: 15px;">Rincian Pembayaran</h3>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Subtotal:</span>
                            <span>${formatCurrency(order.mitra_earning)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span>Biaya Admin:</span>
                            <span>${formatCurrency(order.admin_fee)}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; padding-top: 10px; border-top: 1px solid #ddd;">
                            <span>Total:</span>
                            <span style="color: #0B2F57;">${formatCurrency(order.amount)}</span>
                        </div>
                    </div>
                    
                    <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 12px;">
                        <p>Terima kasih telah menggunakan layanan YukKerja!</p>
                        <p>Invoice ini dibuat secara otomatis dan sah tanpa tanda tangan.</p>
                    </div>
                </div>
            `;
            
            // Create a new window for printing
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
                    </style>
                </head>
                <body>
                    ${invoiceContent}
                    <div class="no-print" style="text-align: center; margin-top: 20px;">
                        <button onclick="window.print()" style="background: #0B2F57; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                            Print Invoice
                        </button>
                        <button onclick="window.close()" style="background: #6c757d; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                            Close
                        </button>
                    </div>
                </body>
                </html>
            `);
            printWindow.document.close();
        }

        // Export to CSV function
        function exportToCSV() {
            const headers = ['No Invoice', 'Layanan', 'Mitra', 'Total', 'Biaya Admin', 'Pendapatan Mitra', 'Status', 'Metode Pembayaran', 'Tanggal Pesanan', 'Tanggal Pembayaran', 'Referensi Transaksi'];
            
            const csvContent = [
                headers.join(','),
                ...currentOrders.map(order => [
                    order.invoice_number,
                    `"${order.job_title}"`,
                    `"${order.mitra_name}"`,
                    order.amount,
                    order.admin_fee,
                    order.mitra_earning,
                    order.payment_status,
                    order.payment_method || '',
                    order.created_at,
                    order.payment_date || '',
                    order.transaction_reference || ''
                ].join(','))
            ].join('\n');
            
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', `order_history_${new Date().toISOString().split('T')[0]}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        // Add export button functionality
        function addExportButton() {
            const headerDiv = document.querySelector('.flex.flex-col.sm\\:flex-row.justify-between.items-start.sm\\:items-center.mb-6');
            const filterDiv = headerDiv.querySelector('.flex.flex-wrap.gap-2');
            
            const exportBtn = document.createElement('button');
            exportBtn.onclick = exportToCSV;
            exportBtn.className = 'bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors duration-200';
            exportBtn.innerHTML = '<i class="fas fa-download mr-1"></i> Export CSV';
            
            filterDiv.appendChild(exportBtn);
        }

        // Initialize the page
        function initializePage() {
            renderOrders();
            addExportButton();
        }

        // Call initialization when page loads
        document.addEventListener('DOMContentLoaded', initializePage);

        // Refresh data function (for real implementation)
        function refreshData() {
            // This would typically fetch data from your API
            // For demo purposes, we'll just re-render existing data
            renderOrders();
            
            // Show a success message
            const successMsg = document.createElement('div');
            successMsg.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
            successMsg.innerHTML = '<i class="fas fa-check mr-2"></i>Data berhasil diperbarui';
            document.body.appendChild(successMsg);
            
            setTimeout(() => {
                successMsg.remove();
            }, 3000);
        }

        // Add refresh button
        function addRefreshButton() {
            const searchDiv = document.querySelector('.flex-grow.mx-2.md\\:mx-4.max-w-xl.relative');
            const refreshBtn = document.createElement('button');
            refreshBtn.onclick = refreshData;
            refreshBtn.className = 'absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600';
            refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i>';
            refreshBtn.title = 'Refresh data';
            
            searchDiv.appendChild(refreshBtn);
        }

        // Enhanced initialization
        function enhancedInitialization() {
            renderOrders();
            addExportButton();
            addRefreshButton();
        }

        // Update the DOMContentLoaded event
        document.addEventListener('DOMContentLoaded', enhancedInitialization);
    </script>
</body>
</html>