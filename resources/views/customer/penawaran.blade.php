<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerja - Kelola Penawaran</title>
<<<<<<< HEAD
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
=======
    <meta name="csrf-token" content="{{ csrf_token() }}">
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
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

        .job-card,
        .proposal-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .job-card:hover,
        .proposal-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }

        .status-badge {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .status-badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .status-badge:hover::before {
            left: 100%;
        }

        .status-pending,
        .status-open {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
        }

        .status-in_progress {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
        }

        .status-completed {
            background: linear-gradient(135deg, #ddd6fe 0%, #c4b5fd 100%);
            color: #5b21b6;
        }

        .status-accepted {
            background: linear-gradient(135deg, #c7f9ff 0%, #a7efff 100%);
            color: #0369a1;
        }

        .status-rejected {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
        }

        .form-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }

        .rating-stars {
            color: #fbbf24;
        }

        .rating-stars i {
            transition: color 0.2s ease;
        }

        .proposal-card {
            backdrop-filter: blur(10px);
        }

        @keyframes pulse-glow {
<<<<<<< HEAD
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.5); }
=======

            0%,
            100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            }

            50% {
                box-shadow: 0 0 30px rgba(59, 130, 246, 0.5);
            }
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
        }

        .proposal-card:hover {
            animation: pulse-glow 2s infinite;
        }

        .gradient-btn {
            background: linear-gradient(135deg, var(--from-color), var(--to-color));
            transition: all 0.3s ease;
            transform: scale(1);
        }

        .gradient-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-accept {
            --from-color: #10b981;
            --to-color: #059669;
        }

        .btn-reject {
            --from-color: #ef4444;
            --to-color: #dc2626;
        }

        .btn-deal {
            --from-color: #8b5cf6;
            --to-color: #7c3aed;
        }

        .btn-chat {
            --from-color: #3b82f6;
            --to-color: #2563eb;
        }

        .btn-secondary {
            --from-color: #6b7280;
            --to-color: #4b5563;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid #ffffff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
<<<<<<< HEAD
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
=======
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
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

                    <div class="flex-grow mx-2 md:mx-4 max-w-xl relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        <input type="text" id="searchInput"
                            class="w-full pl-10 pr-10 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base"
                            placeholder="Cari jasa...">
                        <button id="refreshBtn"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-blue-600"
                            title="Refresh data">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>

                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">0</span>
                        </a>
                        <div class="relative group">
                            <button class="focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF"
                                    alt="Profile" class="rounded-full w-8 h-8">
                            </button>
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                                <hr>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Keluar</button>
                                </form>
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
                        <p class="text-gray-600">Lihat pekerjaan Anda dan kelola penawaran dari mitra</p>
                    </div>

                    <!-- Job Posts List -->
                    <div class="space-y-6" id="jobPostsList">
                        @forelse ($jobPosts as $jobPost)
                            <div class="job-card bg-white rounded-xl shadow-lg p-6" data-id="{{ $jobPost->id }}">
                                <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $jobPost->title }}</h3>
                                        <p class="text-sm text-gray-600 mb-1">
<<<<<<< HEAD
                                            {{ \Carbon\Carbon::parse($jobPost->created_at)->format('d M Y') }}</p>
=======
                                            {{ \Carbon\Carbon::parse($jobPost->created_at)->format('d M Y') }}
                                        </p>
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
                                        <p class="text-sm text-gray-600">{{ Str::limit($jobPost->description, 100) }}</p>
                                    </div>
                                    <div class="mt-4 lg:mt-0 flex flex-col items-end">
                                        <span
                                            class="status-badge status-{{ $jobPost->status }} px-3 py-1 rounded-full text-sm font-medium mb-2">
                                            <i
                                                class="fas fa-{{ $jobPost->status === 'pending' ? 'clock' : ($jobPost->status === 'in_progress' ? 'check-circle' : 'trophy') }} mr-1"></i>
                                            {{ ucfirst(str_replace('_', ' ', $jobPost->status)) }}
                                        </span>
                                        <span class="text-sm text-gray-500">Budget: Rp
                                            {{ number_format($jobPost->budget, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button onclick="showApplicationsModal({{ $jobPost->id }})"
                                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        <i class="fas fa-eye mr-2"></i>Lihat Penawaran
                                    </button>
                                    <a href="{{ route('customer.dashboard.post-job') }}"
                                        class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200 text-center">
                                        <i class="fas fa-edit mr-2"></i>Edit Job
                                    </a>
                                </div>
                            </div>
                        @empty
                            <!-- Empty State -->
                            <div id="emptyState" class="text-center py-16">
                                <div
                                    class="mx-auto w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                                    <i class="fas fa-briefcase text-4xl text-gray-400"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pekerjaan</h3>
                                <p class="text-gray-600 mb-6">Buat pekerjaan baru untuk mendapatkan penawaran dari mitra</p>
                                <a href="{{ route('customer.dashboard.post-job') }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-plus mr-2"></i>Post Job Baru
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Applications Modal -->
    <div id="applicationsModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-4xl w-full mx-4 overflow-y-auto max-h-[80vh]">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900" id="modalTitle">Penawaran untuk: <span id="jobTitle"></span>
                </h3>
                <button onclick="closeApplicationsModal()" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="applicationsList" class="space-y-6"></div>
        </div>
    </div>

    <!-- Rating Modal -->
    <div id="ratingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 transform transition-all duration-300">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                    <i class="fas fa-star text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Beri Rating</h3>
                <p class="text-gray-600 mb-6">Bagaimana pengalaman Anda dengan mitra ini?</p>

                <div class="flex justify-center space-x-2 mb-6">
                    <button
                        class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors duration-200"
                        data-rating="1"><i class="fas fa-star"></i></button>
                    <button
                        class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors duration-200"
                        data-rating="2"><i class="fas fa-star"></i></button>
                    <button
                        class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors duration-200"
                        data-rating="3"><i class="fas fa-star"></i></button>
                    <button
                        class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors duration-200"
                        data-rating="4"><i class="fas fa-star"></i></button>
                    <button
                        class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors duration-200"
                        data-rating="5"><i class="fas fa-star"></i></button>
                </div>

                <form id="ratingForm" method="POST">
                    @csrf
                    <input type="hidden" name="rating" id="ratingInput">
                    <textarea name="review" class="w-full p-3 border border-gray-300 rounded-lg mb-4" rows="3"
                        placeholder="Tuliskan review Anda (opsional)"></textarea>
                    <div class="flex gap-3">
                        <button type="button"
                            class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors duration-200"
                            onclick="closeRatingModal()">Batal</button>
                        <button type="submit"
                            class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg font-medium transition-colors duration-200">Kirim
                            Rating</button>
                    </div>
                </form>
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

        if (menuToggle && closeSidebar && sidebar && overlay) {
            menuToggle.addEventListener('click', openSidebar);
            closeSidebar.addEventListener('click', closeSidebarFn);
            overlay.addEventListener('click', closeSidebarFn);
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        const jobPostsList = document.getElementById('jobPostsList');
        const emptyState = document.getElementById('emptyState');
        const jobCards = document.querySelectorAll('.job-card');

        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            let visibleCount = 0;

            jobCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibleCount === 0 && searchTerm !== '') {
                if (!jobPostsList.classList.contains('hidden')) {
                    jobPostsList.classList.add('hidden');
                }
                if (emptyState && emptyState.classList.contains('hidden')) {
                    emptyState.classList.remove('hidden');
                }
            } else {
                jobPostsList.classList.remove('hidden');
                if (emptyState && !emptyState.classList.contains('hidden')) {
                    emptyState.classList.add('hidden');
                }
            }
        });

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

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        async function showApplicationsModal(jobPostId) {
            const modal = document.getElementById('applicationsModal');
            const applicationsList = document.getElementById('applicationsList');
            const jobTitle = document.getElementById('jobTitle');
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!csrfToken) {
                showNotification('CSRF token tidak ditemukan.', 'error');
                return;
            }

            try {
                const response = await fetch(`/customer/jobs/${jobPostId}/applications`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();

                if (!data.jobPost || !data.applications) {
                    throw new Error('Data tidak lengkap dari server.');
                }

                jobTitle.textContent = data.jobPost.title || 'Pekerjaan Tanpa Judul';
                applicationsList.innerHTML = '';

                if (data.applications.length === 0) {
                    applicationsList.innerHTML = `
                        <div class="text-center py-12">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                                <i class="fas fa-handshake text-3xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Penawaran</h3>
                            <p class="text-gray-600">Belum ada mitra yang mengajukan penawaran untuk pekerjaan ini.</p>
                        </div>
                    `;
                } else {
                    data.applications.forEach(app => {
                        const applicationCard = `
                            <div class="proposal-card bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-xl transition-all duration-300" data-status="${app.status}" data-id="${app.id}">
                                <!-- Header Section -->
                                <div class="flex flex-col lg:flex-row lg:items-start justify-between mb-6">
                                    <div class="flex items-start space-x-4 flex-1">
                                        <div class="relative">
                                            <img src="${app.mitra.profile_photo_url || 'https://via.placeholder.com/64/3B82F6/FFFFFF?text=' + (app.mitra.name ? app.mitra.name[0] : 'M')}" 
                                                 alt="Mitra" class="w-16 h-16 rounded-full border-3 border-blue-200 shadow-lg">
                                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <h3 class="text-xl font-bold text-gray-900">${app.mitra.name || 'Mitra Tanpa Nama'}</h3>
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">Verified</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">${app.mitra.job_title || 'Professional'}</p>
                                            <div class="flex items-center space-x-3">
                                                <div class="rating-stars flex">
                                                    ${[1, 2, 3, 4, 5].map(i => `
                                                        <i class="fas fa-star text-sm ${i <= (app.mitra.rating || 0) ? 'text-yellow-400' : 'text-gray-300'}"></i>
                                                    `).join('')}
                                                </div>
                                                <span class="text-sm font-medium text-gray-700">${Number(app.mitra.rating || 0).toFixed(1)}</span>
                                                <span class="text-sm text-gray-400">•</span>
                                                <span class="text-sm text-gray-600">${app.mitra.reviews_count || 0} reviews</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Status & Price Section -->
                                    <div class="mt-4 lg:mt-0 flex flex-col items-end space-y-2">
                                        <span class="status-badge status-${app.status} px-4 py-2 rounded-full text-sm font-semibold shadow-sm">
                                            <i class="fas fa-${getStatusIcon(app.status)} mr-2"></i>
                                            ${getStatusText(app.status)}
                                        </span>
                                        <div class="text-right">
                                            <div class="text-3xl font-bold text-gray-900">Rp ${Number(app.bid_amount || 0).toLocaleString('id-ID')}</div>
                                            <div class="text-sm text-gray-500">
                                                <i class="fas fa-clock mr-1"></i>
                                                Estimasi ${app.estimated_completion_time ? Math.ceil((new Date(app.estimated_completion_time) - new Date()) / (1000 * 60 * 60 * 24)) : 'N/A'} hari
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Message Section -->
                                <div class="mb-6 p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                    <h4 class="font-semibold text-gray-800 mb-2">
                                        <i class="fas fa-comment-alt mr-2 text-blue-500"></i>Pesan dari Mitra:
                                    </h4>
                                    <p class="text-gray-700 leading-relaxed">${app.message || 'Tidak ada pesan tambahan.'}</p>
                                </div>

<<<<<<< HEAD
                                <!-- Progress Section -->
                                ${(app.status === 'completed' || app.status === 'in_progress') ? `
                                    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg border border-green-200">
                                        <div class="flex justify-between items-center mb-3">
                                            <span class="text-sm font-semibold text-gray-700">
                                                <i class="fas fa-tasks mr-2 text-green-600"></i>Progress Pekerjaan
                                            </span>
                                            <span class="text-sm font-bold text-green-600">
                                                ${app.status === 'completed' ? '100%' : '75%'}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-3 shadow-inner">
                                            <div class="bg-gradient-to-r from-green-500 to-blue-500 h-3 rounded-full transition-all duration-1000 ease-out" 
                                                 style="width: ${app.status === 'completed' ? '100%' : '75%'}"></div>
                                        </div>
                                        <div class="mt-2 text-xs text-gray-600">
                                            ${app.status === 'completed' ? 'Pekerjaan telah selesai' : 'Sedang dalam pengerjaan'}
                                        </div>
                                    </div>
                                ` : ''}
=======
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-3">
                                    ${getActionButtons(app, csrfToken)}
                                </div>
                            </div>
                        `;
                        applicationsList.insertAdjacentHTML('beforeend', applicationCard);
                    });
                }

                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Error fetching applications:', error);
                showNotification(`Gagal memuat penawaran: ${error.message}`, 'error');
            }
        }

        function getStatusIcon(status) {
            const icons = {
                'open': 'clock',
                'accepted': 'handshake',
                'in_progress': 'spinner',
                'completed': 'check-circle',
                'rejected': 'times-circle'
            };
            return icons[status] || 'question-circle';
        }

        function getStatusText(status) {
            const texts = {
                'open': 'Menunggu',
                'accepted': 'Diterima',
                'in_progress': 'Dikerjakan',
                'completed': 'Selesai',
                'rejected': 'Ditolak'
            };
            return texts[status] || 'Unknown';
        }


<<<<<<< HEAD
      function getActionButtons(app, csrfToken) {
            console.log('Application status:', app.status); // Debug log
            
            switch(app.status) {
                case 'open':
                case 'pending':
                    return `
                        <button onclick="acceptApplication(${app.id})" 
                                class="flex-1 gradient-btn btn-accept text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-check mr-2"></i>Terima Penawaran
                        </button>
                        <button onclick="rejectApplication(${app.id})" 
                                class="flex-1 gradient-btn btn-reject text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-times mr-2"></i>Tolak Penawaran
                        </button>
                        <a href="/chatify/${app.mitra.id}" 
                           class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-comments mr-2"></i>Chat Mitra
                        </a>
                    `;
                    
                case 'accepted':
                    return `
                        <button onclick="dealApplication(${app.id})" 
                                class="flex-1 gradient-btn btn-deal text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-handshake mr-2"></i>Deal & Mulai Kerja
                        </button>
                        <a href="/chatify/${app.mitra.id}" 
                           class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-comments mr-2"></i>Chat Mitra
                        </a>
                    `;
                    
                case 'in_progress':
                    return `
                        <a href="/chatify/${app.mitra.id}" 
                           class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-comments mr-2"></i>Chat Mitra
                        </a>
                        <button class="flex-1 gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-eye mr-2"></i>Lihat Progress
                        </button>
                        <button class="flex-1 gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-file-alt mr-2"></i>Lihat Deliverable
                        </button>
                    `;
                    
                case 'completed':
                    return `
                        <button onclick="showRatingModal(${app.id})" 
                                class="flex-1 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-star mr-2"></i>Beri Rating
                        </button>
                        <button class="flex-1 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-redo mr-2"></i>Pesan Lagi
                        </button>
                        <a href="/chatify/${app.mitra.id}" 
                           class="flex-1 text-center gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-comments mr-2"></i>Riwayat Chat
                        </a>
                    `;
                    
                case 'rejected':
                    return `
                        <a href="/chatify/${app.mitra.id}" 
                           class="flex-1 text-center gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-comments mr-2"></i>Chat Mitra
                        </a>
                        <button class="flex-1 gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg" disabled>
                            <i class="fas fa-ban mr-2"></i>Ditolak
                        </button>
                         <button onclick="deleteApplication(${app.id})" 
                                class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    `;
                    
                default:
                    // Default case untuk status yang tidak dikenal atau null
                    return `
                        <button onclick="acceptApplication(${app.id})" 
                                class="flex-1 gradient-btn btn-accept text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-check mr-2"></i>Terima Penawaran
                        </button>
                        <button onclick="rejectApplication(${app.id})" 
                                class="flex-1 gradient-btn btn-reject text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-times mr-2"></i>Tolak Penawaran
                        </button>
                        <a href="/chatify/${app.mitra.id}" 
                           class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                            <i class="fas fa-comments mr-2"></i>Chat Mitra
                        </a>
                    `;
            }
        }

=======
        function getActionButtons(app, csrfToken) {
            console.log('Application status:', app.status);

            switch (app.status) {
                case 'open':
                case 'pending':
                    return `
                <button onclick="acceptApplication(${app.id})" 
                        class="flex-1 gradient-btn btn-accept text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-check mr-2"></i>Terima Penawaran
                </button>
                <button onclick="rejectApplication(${app.id})" 
                        class="flex-1 gradient-btn btn-reject text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-times mr-2"></i>Tolak Penawaran
                </button>
                <a href="/chatify/${app.mitra.id}" 
                   class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </a>
            `;

                case 'accepted':
                    return `
                <button onclick="createPayment(${app.id})" 
                        class="flex-1 gradient-btn btn-deal text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-credit-card mr-2"></i>Bayar Sekarang
                </button>
                <a href="/chatify/${app.mitra.id}" 
                   class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </a>
            `;

                case 'in_progress':
                    return `
                <div class="flex-1 bg-green-100 border border-green-300 text-green-800 px-6 py-3 rounded-lg font-semibold text-center">
                    <i class="fas fa-check-circle mr-2"></i>Pembayaran Berhasil - Sedang Dikerjakan
                </div>
                <a href="/chatify/${app.mitra.id}" 
                   class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </a>
                <button onclick="markAsCompleted(${app.id})" 
                        class="flex-1 gradient-btn btn-deal text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-flag-checkered mr-2"></i>Tandai Selesai
                </button>
            `;

                case 'completed':
                    return `
                <button onclick="showRatingModal(${app.id})" 
                        class="flex-1 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-star mr-2"></i>Beri Rating
                </button>
                <a href="/chatify/${app.mitra.id}" 
                   class="flex-1 text-center gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-comments mr-2"></i>Riwayat Chat
                </a>
            `;

                case 'rejected':
                    return `
                <a href="/chatify/${app.mitra.id}" 
                   class="flex-1 text-center gradient-btn btn-secondary text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </a>
                <button onclick="deleteApplication(${app.id})" 
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            `;

                default:
                    return `
                <button onclick="acceptApplication(${app.id})" 
                        class="flex-1 gradient-btn btn-accept text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-check mr-2"></i>Terima Penawaran
                </button>
                <button onclick="rejectApplication(${app.id})" 
                        class="flex-1 gradient-btn btn-reject text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-times mr-2"></i>Tolak Penawaran
                </button>
                <a href="/chatify/${app.mitra.id}" 
                   class="flex-1 text-center gradient-btn btn-chat text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200 shadow-lg">
                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                </a>
            `;
            }
        }

        // Add new payment function
        async function createPayment(applicationId) {
            if (!confirm('Apakah Anda yakin ingin melakukan pembayaran? Transaksi akan diproses melalui Xendit.')) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const button = event.target.closest('button');
            const originalContent = button.innerHTML;

            try {
                button.disabled = true;
                button.innerHTML = `<div class="loading-spinner mr-2"></div>Membuat invoice...`;
                showNotification('Membuat invoice pembayaran...', 'info');

                const response = await fetch(`/customer/applications/${applicationId}/payment`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showNotification('Invoice berhasil dibuat! Mengarahkan ke halaman pembayaran...', 'success');

                    // Redirect to payment URL in the same window
                    window.location.href = data.payment_url;
                } else {
                    showNotification(data.message || 'Gagal membuat pembayaran.', 'error');
                    button.disabled = false;
                    button.innerHTML = originalContent;
                }

            } catch (error) {
                console.error('Error creating payment:', error);
                showNotification('Terjadi kesalahan saat membuat pembayaran.', 'error');
                button.disabled = false;
                button.innerHTML = originalContent;
            }
        }

        async function markAsCompleted(applicationId) {
            if (!confirm('Apakah pekerjaan sudah selesai dan Anda puas dengan hasilnya?')) return;

            await handleApplicationAction(applicationId, 'complete', 'Menandai sebagai selesai...');
        }
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1

        function closeApplicationsModal() {
            document.getElementById('applicationsModal').classList.add('hidden');
        }

        async function deleteApplication(applicationId) {
            if (!confirm('Apakah Anda yakin ingin menghapus penawaran ini?')) return;
<<<<<<< HEAD
            
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
            await handleApplicationAction(applicationId, 'delete', 'Menghapus penawaran...');
        }

        // New functions for handling actions
        async function acceptApplication(applicationId) {
            if (!confirm('Apakah Anda yakin ingin menerima penawaran ini? Transaksi akan dibuat.')) return;
<<<<<<< HEAD
            
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
            await handleApplicationAction(applicationId, 'accept', 'Menerima penawaran...');
        }

        async function rejectApplication(applicationId) {
            if (!confirm('Apakah Anda yakin ingin menolak penawaran ini?')) return;
<<<<<<< HEAD
            
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
            await handleApplicationAction(applicationId, 'reject', 'Menolak penawaran...');
        }

        async function dealApplication(applicationId) {
            if (!confirm('Apakah Anda yakin ingin memulai pekerjaan ini? Pembayaran akan diproses.')) return;
<<<<<<< HEAD
            
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
            await handleApplicationAction(applicationId, 'deal', 'Memproses deal...');
        }

        async function handleApplicationAction(applicationId, action, loadingMessage) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            const button = event.target.closest('button');
            const originalContent = button.innerHTML;
<<<<<<< HEAD
            
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
            try {
                // Show loading state
                button.disabled = true;
                button.innerHTML = `<div class="loading-spinner mr-2"></div>${loadingMessage}`;
                showNotification(loadingMessage, 'info');
<<<<<<< HEAD
                
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
                const response = await fetch(`/customer/applications/${applicationId}/${action}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showNotification(data.message, 'success');
                    closeApplicationsModal();
<<<<<<< HEAD
                    
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
                    // Refresh the page after a short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showNotification(data.message || `Gagal ${action} penawaran.`, 'error');
                    button.disabled = false;
                    button.innerHTML = originalContent;
                }

            } catch (error) {
                console.error(`Error ${action}ing application:`, error);
                showNotification(`Terjadi kesalahan saat ${action} penawaran.`, 'error');
                button.disabled = false;
                button.innerHTML = originalContent;
            }
        }

        // Rating modal functionality
        function showRatingModal(applicationId) {
            const modal = document.getElementById('ratingModal');
            const form = document.getElementById('ratingForm');
            form.action = `/customer/applications/${applicationId}/rate`;

            const stars = modal.querySelectorAll('.rating-star');
            let selectedRating = 0;

            // Reset previous event listeners
            stars.forEach(star => {
                const newStar = star.cloneNode(true);
                star.parentNode.replaceChild(newStar, star);
            });

            const newStars = modal.querySelectorAll('.rating-star');
            newStars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    selectedRating = index + 1;
                    updateStarDisplay(newStars, selectedRating);
                    document.getElementById('ratingInput').value = selectedRating;
                });

                star.addEventListener('mouseenter', () => {
                    updateStarDisplay(newStars, index + 1);
                });
            });

            modal.addEventListener('mouseleave', () => {
                updateStarDisplay(newStars, selectedRating);
            });

            modal.classList.remove('hidden');
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

        function closeRatingModal() {
            document.getElementById('ratingModal').classList.add('hidden');
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', () => {
            // Show success message if present
            @if (session('success'))
                showNotification('{{ session('success') }}', 'success');
            @endif
        });

        // Auto-refresh notifications
        setInterval(() => {
            const bellIcon = document.querySelector('.fa-bell');
            const notificationBadge = bellIcon?.nextElementSibling;
<<<<<<< HEAD
            
=======

>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
            if (bellIcon && notificationBadge) {
                const currentCount = parseInt(notificationBadge.textContent);

                if (Math.random() < 0.1) {
                    const newCount = currentCount + 1;
                    notificationBadge.textContent = newCount;
                    notificationBadge.classList.add('animate-pulse');

                    setTimeout(() => {
                        notificationBadge.classList.remove('animate-pulse');
                    }, 1000);

                    showNotification('Penawaran baru masuk!', 'info');
                }
            }
        }, 10000);
<<<<<<< HEAD
=======

        // Di bagian akhir script, update bagian DOMContentLoaded
        document.addEventListener('DOMContentLoaded', () => {
            // Check for payment failure
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('payment_failed')) {
                showNotification('Pembayaran dibatalkan atau gagal. Silakan coba lagi.', 'error');
                // Remove the parameter from URL
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }

            // Show session flash messages
            @if (session('status'))
                showNotification('{{ session('message') }}', '{{ session('status') }}');
            @endif
});
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
    </script>
</body>

</html>