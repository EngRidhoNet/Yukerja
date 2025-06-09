<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerja - Manage Proposals</title>
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
        .status-badge {
            transition: all 0.3s ease;
        }
        .proposal-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .proposal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #3b82f6;
        }
        .rating-stars {
            color: #fbbf24;
        }
        .form-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        .status-pending { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); color: #92400e; }
        .status-accepted { background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); color: #065f46; }
        .status-rejected { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); color: #991b1b; }
        .status-completed { background: linear-gradient(135deg, #ddd6fe 0%, #c4b5fd 100%); color: #5b21b6; }
        .filter-btn {
            transition: all 0.3s ease;
        }
        .filter-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            transform: scale(1.05);
        }
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
                        <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base" placeholder="Cari penawaran atau nama mitra...">
                    </div>
                    
                    <!-- Right Side Icons -->
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
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
            <main class="flex-1 overflow-y-auto form-container">
                <div class="max-w-7xl mx-auto px-4 py-6 md:py-8">
                    <!-- Page Header -->
                    <div class="mb-8">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Kelola Penawaran</h1>
                        <p class="text-gray-600">Kelola penawaran yang masuk untuk proyek Anda dan pilih mitra terbaik</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-yellow-100">
                                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Menunggu</p>
                                    <p class="text-2xl font-bold text-gray-900" id="pendingCount">5</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-green-100">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Diterima</p>
                                    <p class="text-2xl font-bold text-gray-900" id="acceptedCount">2</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-red-100">
                                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Ditolak</p>
                                    <p class="text-2xl font-bold text-gray-900" id="rejectedCount">1</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-lg">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-purple-100">
                                    <i class="fas fa-trophy text-purple-600 text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Selesai</p>
                                    <p class="text-2xl font-bold text-gray-900" id="completedCount">3</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <div class="flex flex-wrap gap-3">
                            <button class="filter-btn active px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium" data-filter="all">
                                Semua Penawaran
                            </button>
                            <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium" data-filter="pending">
                                <i class="fas fa-clock mr-1"></i> Menunggu
                            </button>
                            <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium" data-filter="accepted">
                                <i class="fas fa-check-circle mr-1"></i> Diterima
                            </button>
                            <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium" data-filter="rejected">
                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                            </button>
                            <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium" data-filter="completed">
                                <i class="fas fa-trophy mr-1"></i> Selesai
                            </button>
                        </div>
                    </div>

                    <!-- Proposals List -->
                    <div class="space-y-6" id="proposalsList">
                        <!-- Sample Proposal Cards -->
                        <div class="proposal-card bg-white rounded-xl shadow-lg p-6" data-status="pending">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    <img src="https://via.placeholder.com/60/3B82F6/FFFFFF?text=A" alt="Mitra" class="w-15 h-15 rounded-full border-2 border-blue-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Ahmad Rizki</h3>
                                        <p class="text-sm text-gray-600 mb-1">Web Developer</p>
                                        <div class="flex items-center space-x-2">
                                            <div class="rating-stars flex">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">(4.9)</span>
                                            <span class="text-sm text-gray-400">• 127 reviews</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 lg:mt-0 flex flex-col items-end">
                                    <span class="status-badge status-pending px-3 py-1 rounded-full text-sm font-medium mb-2">
                                        <i class="fas fa-clock mr-1"></i> Menunggu
                                    </span>
                                    <span class="text-2xl font-bold text-gray-900">Rp 2.500.000</span>
                                    <span class="text-sm text-gray-500">Estimasi 7 hari</span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Untuk: Website E-commerce Modern</h4>
                                <p class="text-gray-600 text-sm">Saya tertarik mengerjakan proyek website e-commerce Anda. Dengan pengalaman 5+ tahun di bidang web development, saya yakin dapat memberikan hasil terbaik sesuai kebutuhan Anda.</p>
                            </div>

                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">React.js</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Node.js</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">MongoDB</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Payment Gateway</span>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-check mr-2"></i>Terima Penawaran
                                </button>
                                <button class="flex-1 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>Tolak Penawaran
                                </button>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                                </button>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </button>
                            </div>
                        </div>

                        <div class="proposal-card bg-white rounded-xl shadow-lg p-6" data-status="accepted">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    <img src="https://via.placeholder.com/60/10B981/FFFFFF?text=S" alt="Mitra" class="w-15 h-15 rounded-full border-2 border-green-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Sari Mulyani</h3>
                                        <p class="text-sm text-gray-600 mb-1">UI/UX Designer</p>
                                        <div class="flex items-center space-x-2">
                                            <div class="rating-stars flex">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">(4.7)</span>
                                            <span class="text-sm text-gray-400">• 89 reviews</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 lg:mt-0 flex flex-col items-end">
                                    <span class="status-badge status-accepted px-3 py-1 rounded-full text-sm font-medium mb-2">
                                        <i class="fas fa-check-circle mr-1"></i> Diterima
                                    </span>
                                    <span class="text-2xl font-bold text-gray-900">Rp 1.800.000</span>
                                    <span class="text-sm text-gray-500">Estimasi 5 hari</span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Untuk: Redesign Mobile App</h4>
                                <p class="text-gray-600 text-sm">Terima kasih telah mempercayakan proyek ini kepada saya. Saat ini sedang dalam tahap development dan akan segera diselesaikan sesuai timeline.</p>
                            </div>

                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Progress</span>
                                    <span class="text-sm text-gray-600">75%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: 75%"></div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                                </button>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>Lihat Progress
                                </button>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-file-alt mr-2"></i>Lihat Deliverable
                                </button>
                            </div>
                        </div>

                        <div class="proposal-card bg-white rounded-xl shadow-lg p-6" data-status="completed">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    <img src="https://via.placeholder.com/60/8B5CF6/FFFFFF?text=M" alt="Mitra" class="w-15 h-15 rounded-full border-2 border-purple-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">Muhammad Fauzi</h3>
                                        <p class="text-sm text-gray-600 mb-1">Digital Marketer</p>
                                        <div class="flex items-center space-x-2">
                                            <div class="rating-stars flex">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="text-sm text-gray-600">(5.0)</span>
                                            <span class="text-sm text-gray-400">• 156 reviews</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 lg:mt-0 flex flex-col items-end">
                                    <span class="status-badge status-completed px-3 py-1 rounded-full text-sm font-medium mb-2">
                                        <i class="fas fa-trophy mr-1"></i> Selesai
                                    </span>
                                    <span class="text-2xl font-bold text-gray-900">Rp 3.200.000</span>
                                    <span class="text-sm text-gray-500">Selesai dalam 10 hari</span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="font-semibold text-gray-800 mb-2">Untuk: Campaign Digital Marketing</h4>
                                <p class="text-gray-600 text-sm">Proyek telah selesai dengan hasil yang memuaskan. ROI meningkat 300% dan engagement rate naik 150%. Terima kasih atas kepercayaannya!</p>
                            </div>

                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Progress</span>
                                    <span class="text-sm text-green-600">100% Complete</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 100%"></div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <button class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-star mr-2"></i>Beri Rating
                                </button>
                                <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-redo mr-2"></i>Pesan Lagi
                                </button>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-download mr-2"></i>Download Report
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empty State -->
                    <div id="emptyState" class="hidden text-center py-16">
                        <div class="mx-auto w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-handshake text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Penawaran</h3>
                        <p class="text-gray-600 mb-6">Belum ada penawaran yang masuk untuk filter yang dipilih</p>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>Post Job Baru
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 transform transition-all duration-300">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                    <i class="fas fa-question text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2" id="modalTitle">Konfirmasi Aksi</h3>
                <p class="text-gray-600 mb-6" id="modalMessage">Apakah Anda yakin ingin melakukan aksi ini?</p>
                <div class="flex gap-3">
                    <button id="cancelAction" class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                        Batal
                    </button>
                    <button id="confirmAction" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
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
        const filterButtons = document.querySelectorAll('.filter-btn');
        const proposalCards = document.querySelectorAll('.proposal-card');
        const emptyState = document.getElementById('emptyState');
        const proposalsList = document.getElementById('proposalsList');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active filter
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const filter = button.dataset.filter;
                let visibleCount = 0;

                proposalCards.forEach(card => {
                    const status = card.dataset.status;
                    if (filter === 'all' || status === filter) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state
                if (visibleCount === 0) {
                    proposalsList.classList.add('hidden');
                    emptyState.classList.remove('hidden');
                } else {
                    proposalsList.classList.remove('hidden');
                    emptyState.classList.add('hidden');
                }
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const activeFilter = document.querySelector('.filter-btn.active').dataset.filter;
            let visibleCount = 0;

            proposalCards.forEach(card => {
                const title = card.querySelector('h4').textContent.toLowerCase();
                const name = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();
                const status = card.dataset.status;
                
                const matchesSearch = title.includes(searchTerm) || name.includes(searchTerm) || description.includes(searchTerm);
                const matchesFilter = activeFilter === 'all' || status === activeFilter;

                if (matchesSearch && matchesFilter) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state
            if (visibleCount === 0) {
                proposalsList.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                proposalsList.classList.remove('hidden');
                emptyState.classList.add('hidden');
            }
        });

        // Modal functionality
        const confirmModal = document.getElementById('confirmModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalMessage = document.getElementById('modalMessage');
        const cancelAction = document.getElementById('cancelAction');
        const confirmAction = document.getElementById('confirmAction');

        let currentAction = null;
        let currentElement = null;

        function showConfirmModal(title, message, action, element) {
            modalTitle.textContent = title;
            modalMessage.textContent = message;
            currentAction = action;
            currentElement = element;
            confirmModal.classList.remove('hidden');
        }

        function hideConfirmModal() {
            confirmModal.classList.add('hidden');
            currentAction = null;
            currentElement = null;
        }

        cancelAction.addEventListener('click', hideConfirmModal);

        confirmAction.addEventListener('click', () => {
            if (currentAction && currentElement) {
                currentAction(currentElement);
            }
            hideConfirmModal();
        });

        // Proposal actions
        function acceptProposal(card) {
            const statusBadge = card.querySelector('.status-badge');
            statusBadge.className = 'status-badge status-accepted px-3 py-1 rounded-full text-sm font-medium mb-2';
            statusBadge.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Diterima';
            card.dataset.status = 'accepted';
            
            // Update action buttons
            const buttonContainer = card.querySelector('.flex.flex-col.sm\\:flex-row.gap-3');
            buttonContainer.innerHTML = `
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </button>
                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-eye mr-2"></i>Lihat Progress
                </button>
                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-file-alt mr-2"></i>Lihat Deliverable
                </button>
            `;
            
            // Add progress bar
            const progressHtml = `
                <div class="mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-700">Progress</span>
                        <span class="text-sm text-gray-600">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 0%"></div>
                    </div>
                </div>
            `;
            buttonContainer.insertAdjacentHTML('beforebegin', progressHtml);
            
            updateStats();
            showNotification('Penawaran berhasil diterima!', 'success');
        }

        function rejectProposal(card) {
            const statusBadge = card.querySelector('.status-badge');
            statusBadge.className = 'status-badge status-rejected px-3 py-1 rounded-full text-sm font-medium mb-2';
            statusBadge.innerHTML = '<i class="fas fa-times-circle mr-1"></i> Ditolak';
            card.dataset.status = 'rejected';
            
            // Update action buttons
            const buttonContainer = card.querySelector('.flex.flex-col.sm\\:flex-row.gap-3');
            buttonContainer.innerHTML = `
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </button>
                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                </button>
            `;
            
            updateStats();
            showNotification('Penawaran telah ditolak', 'info');
        }

        // Event listeners for proposal actions
        document.addEventListener('click', (e) => {
            const card = e.target.closest('.proposal-card');
            if (!card) return;

            if (e.target.textContent.includes('Terima Penawaran')) {
                showConfirmModal(
                    'Terima Penawaran',
                    'Apakah Anda yakin ingin menerima penawaran ini? Setelah diterima, mitra akan mulai mengerjakan proyek.',
                    acceptProposal,
                    card
                );
            } else if (e.target.textContent.includes('Tolak Penawaran')) {
                showConfirmModal(
                    'Tolak Penawaran',
                    'Apakah Anda yakin ingin menolak penawaran ini? Aksi ini tidak dapat dibatalkan.',
                    rejectProposal,
                    card
                );
            } else if (e.target.textContent.includes('Chat Mitra')) {
                showNotification('Membuka chat dengan mitra...', 'info');
            } else if (e.target.textContent.includes('Lihat Detail') || e.target.textContent.includes('Lihat Progress')) {
                showNotification('Membuka detail penawaran...', 'info');
            } else if (e.target.textContent.includes('Beri Rating')) {
                showRatingModal(card);
            }
        });

        // Update statistics
        function updateStats() {
            const pendingCards = document.querySelectorAll('[data-status="pending"]');
            const acceptedCards = document.querySelectorAll('[data-status="accepted"]');
            const rejectedCards = document.querySelectorAll('[data-status="rejected"]');
            const completedCards = document.querySelectorAll('[data-status="completed"]');

            document.getElementById('pendingCount').textContent = pendingCards.length;
            document.getElementById('acceptedCount').textContent = acceptedCards.length;
            document.getElementById('rejectedCount').textContent = rejectedCards.length;
            document.getElementById('completedCount').textContent = completedCards.length;
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full`;
            
            const colors = {
                success: 'bg-green-500 text-white',
                error: 'bg-red-500 text-white',
                info: 'bg-blue-500 text-white',
                warning: 'bg-yellow-500 text-white'
            };
            
            notification.className += ` ${colors[type]}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : type === 'warning' ? 'exclamation' : 'info'}-circle mr-3"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Rating modal functionality
        function showRatingModal(card) {
            const ratingModal = document.createElement('div');
            ratingModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            ratingModal.innerHTML = `
                <div class="bg-white rounded-2xl p-8 max-w-md mx-4 transform transition-all duration-300">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                            <i class="fas fa-star text-yellow-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Beri Rating</h3>
                        <p class="text-gray-600 mb-6">Bagaimana pengalaman Anda dengan mitra ini?</p>
                        
                        <div class="flex justify-center space-x-2 mb-6">
                            ${[1,2,3,4,5].map(i => `
                                <button class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors duration-200" data-rating="${i}">
                                    <i class="fas fa-star"></i>
                                </button>
                            `).join('')}
                        </div>
                        
                        <textarea class="w-full p-3 border border-gray-300 rounded-lg mb-4" rows="3" placeholder="Tuliskan review Anda (opsional)"></textarea>
                        
                        <div class="flex gap-3">
                            <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors duration-200" onclick="this.closest('.fixed').remove()">
                                Batal
                            </button>
                            <button class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200" onclick="submitRating(this)">
                                Kirim Rating
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(ratingModal);
            
            // Rating star interaction
            const stars = ratingModal.querySelectorAll('.rating-star');
            let selectedRating = 0;
            
            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    selectedRating = index + 1;
                    updateStarDisplay(stars, selectedRating);
                });
                
                star.addEventListener('mouseenter', () => {
                    updateStarDisplay(stars, index + 1);
                });
            });
            
            ratingModal.addEventListener('mouseleave', () => {
                updateStarDisplay(stars, selectedRating);
            });
        }

        function updateStarDisplay(stars, rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        function submitRating(button) {
            const modal = button.closest('.fixed');
            const selectedStars = modal.querySelectorAll('.rating-star.text-yellow-400').length;
            
            if (selectedStars === 0) {
                showNotification('Pilih rating terlebih dahulu', 'warning');
                return;
            }
            
            showNotification(`Rating ${selectedStars} bintang berhasil dikirim!`, 'success');
            modal.remove();
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            updateStats();
            
            // Set initial filter
            const allFilter = document.querySelector('[data-filter="all"]');
            if (allFilter) {
                allFilter.click();
            }
        });

        // Auto-refresh notifications (simulate real-time updates)
        setInterval(() => {
            const bellIcon = document.querySelector('.fa-bell');
            const notificationBadge = bellIcon.nextElementSibling;
            const currentCount = parseInt(notificationBadge.textContent);
            
            // Randomly add new notifications
            if (Math.random() < 0.1) { // 10% chance every 10 seconds
                const newCount = currentCount + 1;
                notificationBadge.textContent = newCount;
                notificationBadge.classList.add('animate-pulse');
                
                setTimeout(() => {
                    notificationBadge.classList.remove('animate-pulse');
                }, 1000);
                
                showNotification('Penawaran baru masuk!', 'info');
            }
        }, 10000);
    </script>
</body>
</html>