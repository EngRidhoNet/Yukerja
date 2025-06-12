<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerja - Kelola Penawaran</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
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
        }

        .status-pending {
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
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
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
                        <input type="text" id="searchInput"
                            class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base"
                            placeholder="Cari pekerjaan...">
                    </div>

                    <!-- Right Side Icons -->
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </a>
                        <div class="relative group">
                            <button class="focus:outline-none">
                                <img src="{{ auth()->user()->profile_photo_url ?? 'https://via.placeholder.com/32/4B5563/FFFFFF?text=' . auth()->user()->name[0] }}"
                                    alt="Profile" class="rounded-full w-8 h-8">
                            </button>
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                                <a href="{{ route('customer.dashboard.history') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Riwayat Pesanan</a>
                                <hr>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Keluar</a>
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
                                            {{ \Carbon\Carbon::parse($jobPost->created_at)->format('d M Y') }}</p>
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
                                        class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
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

            if (visibleCount === 0) {
                jobPostsList.classList.add('hidden');
                emptyState.classList.remove('hidden');
            } else {
                jobPostsList.classList.remove('hidden');
                emptyState.classList.add('hidden');
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
                <div class="text-center py-8">
                    <i class="fas fa-handshake text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum Ada Penawaran</h3>
                    <p class="text-gray-600">Belum ada mitra yang mengajukan penawaran untuk pekerjaan ini.</p>
                </div>
            `;
                } else {
                    data.applications.forEach(app => {
                        // **PENYESUAIAN DIMULAI DI SINI**
                        const applicationCard = `
                    <div class="proposal-card bg-gray-50 rounded-xl p-6" data-status="${app.status}" data-id="${app.id}">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-4">
                            <div class="flex items-start space-x-4">
                                <img src="${app.mitra.profile_photo_url || 'https://via.placeholder.com/60/3B82F6/FFFFFF?text=' + (app.mitra.name ? app.mitra.name[0] : 'M')}" alt="Mitra" class="w-15 h-15 rounded-full border-2 border-blue-200">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">${app.mitra.name || 'Mitra Tanpa Nama'}</h3>
                                    <p class="text-sm text-gray-600 mb-1">${app.mitra.job_title || 'Mitra'}</p>
                                    <div class="flex items-center space-x-2">
                                        <div class="rating-stars flex">
                                            ${[1, 2, 3, 4, 5].map(i => `
                                                <i class="fas fa-star ${i <= (app.rating || 0) ? 'text-yellow-400' : 'text-gray-300'}"></i>
                                            `).join('')}
                                        </div>
                                        <span class="text-sm text-gray-600">(${Number(app.rating || 0).toFixed(1)})</span>
                                        <span class="text-sm text-gray-400">• ${app.mitra.reviews_count || 0} reviews</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 lg:mt-0 flex flex-col items-end">
                                <span class="status-badge status-${app.status} px-3 py-1 rounded-full text-sm font-medium mb-2">
                                    <i class="fas fa-${app.status === 'open' ? 'clock' : app.status === 'accepted' ? 'check-circle' : app.status === 'rejected' ? 'times-circle' : 'trophy'} mr-1"></i>
                                    ${app.status.charAt(0).toUpperCase() + app.status.slice(1)}
                                </span>
                                <span class="text-2xl font-bold text-gray-900">Rp ${Number(app.bid_amount || 0).toLocaleString('id-ID')}</span>
                                <span class="text-sm text-gray-500">Estimasi ${app.estimated_completion_time ? Math.ceil((new Date(app.estimated_completion_time) - new Date()) / (1000 * 60 * 60 * 24)) : 'N/A'} hari</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h4 class="font-semibold text-gray-800 mb-2">Pesan:</h4>
                            <p class="text-gray-600 text-sm">${app.message || 'Tidak ada pesan tambahan.'}</p>
                        </div>
                        ${app.status === 'completed' || app.status === 'in_progress' ? `
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700">Progress</span>
                                    <span class="text-sm text-gray-600">${app.status === 'completed' ? '100%' : 'In Progress'}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-${app.status === 'completed' ? 'purple' : 'green'}-600 h-2 rounded-full" style="width: ${app.status === 'completed' ? '100%' : '75%'}"></div>
                                </div>
                            </div>
                        ` : ''}
                        <div class="flex flex-col sm:flex-row gap-3">
                            ${app.status === 'open' ? `
                                <form action="/customer/applications/${app.id}/accept" method="POST" class="flex-1">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        <i class="fas fa-check mr-2"></i>Terima Penawaran
                                    </button>
                                </form>
                                <form action="/customer/applications/${app.id}/reject" method="POST" class="flex-1">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                        <i class="fas fa-times mr-2"></i>Tolak Penawaran
                                    </button>
                                </form>
                                <a href="/chatify/${app.mitra.id}" class="flex-1 text-center border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                                </a>
                            ` : app.status === 'accepted' || app.status === 'in_progress' ? `
                                <a href="/chatify/${app.mitra.id}" class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                                </a>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>Lihat Progress
                                </button>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-file-alt mr-2"></i>Lihat Deliverable
                                </button>
                            ` : app.status === 'completed' ? `
                                <button class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200" onclick="showRatingModal(${app.id})">
                                    <i class="fas fa-star mr-2"></i>Beri Rating
                                </button>
                                <button class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-redo mr-2"></i>Pesan Lagi
                                </button>
                                <a href="/chatify/${app.mitra.id}" class="flex-1 text-center border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-comments mr-2"></i>Lihat Riwayat Chat
                                </a>
                            ` : `
                                <a href="/chatify/${app.mitra.id}" class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-comments mr-2"></i>Chat Mitra
                                </a>
                                <button class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                                </button>
                            `}
                        </div>
                    </div>
                `;
                        // **PENYESUAIAN BERAKHIR DI SINI**
                        applicationsList.insertAdjacentHTML('beforeend', applicationCard);
                    });
                }

                modal.classList.remove('hidden');
            } catch (error) {
                console.error('Error fetching applications:', error);
                showNotification(`Gagal memuat penawaran: ${error.message}`, 'error');
            }
        }

        function closeApplicationsModal() {
            document.getElementById('applicationsModal').classList.add('hidden');
        }

        // Rating modal functionality
        function showRatingModal(applicationId) {
            const modal = document.getElementById('ratingModal');
            const form = document.getElementById('ratingForm');
            form.action = `/customer/applications/${applicationId}/rate`;

            const stars = modal.querySelectorAll('.rating-star');
            let selectedRating = 0;

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    selectedRating = index + 1;
                    updateStarDisplay(stars, selectedRating);
                    document.getElementById('ratingInput').value = selectedRating;
                });

                star.addEventListener('mouseenter', () => {
                    updateStarDisplay(stars, index + 1);
                });
            });

            modal.addEventListener('mouseleave', () => {
                updateStarDisplay(stars, selectedRating);
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
            const notificationBadge = bellIcon.nextElementSibling;
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
        }, 10000);
    </script>
</body>

</html>