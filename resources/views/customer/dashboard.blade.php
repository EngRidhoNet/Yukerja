<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>YukKerja - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .status-pending {
            @apply bg-yellow-100 text-yellow-800;
        }

        .status-paid {
            @apply bg-green-100 text-green-800;
        }

        .status-failed {
            @apply bg-red-100 text-red-800;
        }

        .status-refunded {
            @apply bg-gray-100 text-gray-800;
        }

        /* Enhanced Sidebar Styles */
        #sidebar {
            width: 64px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 40;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        #sidebar.active {
            width: 256px;
        }

        .content {
            margin-left: 64px;
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Enhanced Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Enhanced Search Input */
        .search-container {
            position: relative;
            background: white;
            border-radius: 50px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .search-container:focus-within {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 12px 50px 12px 45px;
            border-radius: 50px;
            font-size: 14px;
        }

        /* Enhanced Service Cards */
        .service-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid rgba(229, 231, 235, 0.8);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-color: #667eea;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        /* Enhanced Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            border: none;
            color: #8b4513;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .btn-success {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border: none;
            color: #065f46;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-secondary:hover, .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        /* Enhanced Category Navigation */
        .category-nav {
            background: white;
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
            padding: 0 1rem;
        }

        .category-item {
            padding: 12px 20px;
            font-weight: 500;
            color: #6b7280;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            border-radius: 8px 8px 0 0;
            margin: 0 4px;
        }

        .category-item:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .category-item.active {
            color: #667eea;
            border-bottom-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        /* Enhanced Modal */
        .modal-content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        /* Enhanced Avatar */
        .avatar {
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Enhanced Rating */
        .rating-container {
            background: rgba(251, 191, 36, 0.1);
            border-radius: 20px;
            padding: 4px 8px;
            display: inline-flex;
            align-items: center;
        }

        /* Glassmorphism effects */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Loading Animation */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(102, 126, 234, 0.3);
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Enhanced notification badge */
        .notification-badge {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Price tag styling */
        .price-tag {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        @media (min-width: 768px) {
            #sidebar {
                width: 256px;
            }

            .content {
                margin-left: 256px;
            }
        }

        /* Mobile optimizations */
        @media (max-width: 768px) {
            .service-card {
                padding: 16px;
            }
            
            .search-input {
                padding: 10px 40px 10px 35px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body class="font-sans">
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        @include('layouts.customer.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden content">
            <!-- Header -->
            <header>
                <nav class="px-4 py-4 flex items-center justify-between">
                    <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none hover:text-blue-600 p-2 rounded-lg hover:bg-gray-100 transition-all duration-200">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <div class="flex-grow mx-4 max-w-xl">
                        <div class="search-container">
                            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 z-10"></i>
                            <input type="text" id="searchInput" class="search-input" placeholder="Cari jasa yang Anda butuhkan...">
                            <button id="refreshBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-600 transition-colors duration-200 p-1 rounded" title="Refresh data">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="relative p-2 text-gray-600 hover:text-blue-600 hover:bg-gray-100 rounded-lg transition-all duration-200">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="notification-badge absolute -top-1 -right-1 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </button>
                        </div>
                        <div class="relative group">
                            <button class="focus:outline-none p-1">
                                <img src="https://ui-avatars.com/api/?name=User&color=7F9CF5&background=EBF4FF" alt="Profile" class="avatar w-10 h-10">
                            </button>
                            <div class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                                <div class="py-2">
                                    <a href="#" class="block px-4 py-3 text-gray-800 hover:bg-gray-50 transition-colors duration-200 flex items-center">
                                        <i class="fas fa-user mr-3 text-gray-400"></i>
                                        Profil Saya
                                    </a>
                                    <hr class="border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-3 text-gray-800 hover:bg-gray-50 transition-colors duration-200 flex items-center">
                                            <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="category-nav">
                    <div class="py-2">
                        <ul class="flex space-x-1 overflow-x-auto whitespace-nowrap scrollbar-hide" id="categoryNav">
                            <li>
                                <a href="#" class="category-item active" data-category="all">
                                    <i class="fas fa-th-large mr-2"></i>
                                    Semua Layanan
                                </a>
                            </li>
                            @foreach($serviceCategories as $category)
                                <li>
                                    <a href="#" class="category-item" data-category="{{ $category->id }}">
                                        <i class="{{ $category->icon }} mr-2"></i>{{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="px-6 py-8 flex-1 overflow-y-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 space-y-4 sm:space-y-0">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Temukan Layanan Terbaik</h1>
                        <p class="text-gray-600">Ribuan profesional siap membantu kebutuhan Anda</p>
                    </div>
                    <button class="flex items-center px-6 py-3 text-gray-700 font-medium hover:text-blue-600 transition-colors duration-200 bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-200">
                        <i class="fas fa-sliders-h mr-2"></i> 
                        Filter & Urutkan
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="servicesContainer">
                    @foreach ($mitras as $mitra)
                        @php
                            $categoryName = $mitra->serviceCategory->name ?? 'Layanan';
                            $profilePhoto = $mitra->profile_photo ? asset('storage/' . $mitra->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($mitra->business_name) . '&color=FFFFFF&background=4B5563';
                        @endphp
                        <div class="service-card">
                            <div class="flex items-start mb-4">
                                <div class="w-14 h-14 md:w-16 md:h-16 rounded-full mr-4 overflow-hidden flex-shrink-0">
                                    <img src="{{ $profilePhoto }}" alt="{{ $mitra->business_name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">{{ $categoryName }}</div>
                                    <h3 class="text-base font-bold text-gray-900 truncate mb-2">{{ $mitra->business_name }}</h3>
                                    <div class="flex items-center">
                                        <div class="rating-container mr-3">
                                            <i class="fas fa-star text-yellow-500 text-sm mr-1"></i>
                                            <span class="text-sm font-medium text-gray-700">{{ number_format($mitra->avg_rating ?? 0, 1) }}</span>
                                        </div>
                                        <span class="text-xs text-gray-500 truncate">{{ is_array($mitra->service_area) ? implode(', ', $mitra->service_area) : ($mitra->service_area ?? 'N/A') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <span class="price-tag">
                                    Mulai Rp {{ number_format($mitra->starting_price ?? 10000, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <div class="flex space-x-2">
                                <a href="{{ url('/chatify/' . $mitra->user_id) }}" class="btn-primary flex-1 text-center">
                                    <i class="fas fa-comment-dots mr-1"></i>Chat
                                </a>
                                <button class="btn-secondary flex-1">
                                    <i class="fas fa-calendar-check mr-1"></i>Pesan
                                </button>
                                <button class="btn-success flex-1 detail-mitra" data-id="{{ $mitra->id }}">
                                    <i class="fas fa-info-circle mr-1"></i>Detail
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $mitras->links() }}
                </div>

                <div id="loadingIndicator" class="text-center py-12 hidden">
                    <div class="loading-spinner mx-auto mb-4"></div>
                    <p class="text-gray-600 font-medium">Memuat layanan terbaik untuk Anda...</p>
                </div>

                <div id="noResults" class="text-center py-16 hidden">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-search text-gray-400 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Tidak ada layanan yang ditemukan</h4>
                    <p class="text-gray-500">Coba gunakan kata kunci lain atau filter yang berbeda</p>
                </div>
            </main>
        </div>
    </div>

    <!-- Enhanced Modal -->
    <div id="mitraModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50 hidden p-4">
        <div class="modal-content w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-900">Detail Mitra</h3>
                <button id="closeModal" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-full transition-all duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div id="modalContent" class="p-6">
                <div class="flex items-center justify-center py-12">
                    <div class="loading-spinner"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const sidebar = $('#sidebar');
            const overlay = $('#overlay');
            const menuToggle = $('#menu-toggle');

            function openSidebar() {
                sidebar.removeClass('-translate-x-full');
                overlay.removeClass('hidden');
            }

            function closeSidebar() {
                sidebar.addClass('-translate-x-full');
                overlay.addClass('hidden');
            }

            menuToggle.on('click', openSidebar);
            $('#close-sidebar, #overlay').on('click', closeSidebar);

            $(document).on('keydown', (e) => {
                if (e.key === 'Escape' && !sidebar.hasClass('-translate-x-full')) {
                    closeSidebar();
                }
            });

            function renderMitras(mitras) {
                let html = '';
                if (mitras && mitras.length > 0) {
                    mitras.forEach(mitra => {
                        const profilePhoto = mitra.profile_photo
                            ? (mitra.profile_photo.startsWith('http') ? mitra.profile_photo : `{{ asset('storage') }}/${mitra.profile_photo}`)
                            : `https://ui-avatars.com/api/?name=${encodeURIComponent(mitra.business_name || 'Mitra')}&color=FFFFFF&background=4B5563`;

                        const categoryName = mitra.serviceCategory?.name || 'Layanan';
                        const serviceArea = Array.isArray(mitra.service_area)
                            ? mitra.service_area.join(', ')
                            : (typeof mitra.service_area === 'string' ? mitra.service_area : 'N/A');

                        const rating = mitra.avg_rating ? parseFloat(mitra.avg_rating).toFixed(1) : '0.0';
                        const price = mitra.starting_price ? parseInt(mitra.starting_price).toLocaleString('id-ID') : '10.000';

                        html += `
                <div class="service-card">
                    <div class="flex items-start mb-4">
                        <div class="w-14 h-14 md:w-16 md:h-16 rounded-full mr-4 overflow-hidden flex-shrink-0">
                            <img src="${profilePhoto}" alt="${mitra.business_name || 'Mitra'}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Mitra&color=FFFFFF&background=4B5563'">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">${categoryName}</div>
                            <h3 class="text-base font-bold text-gray-900 truncate mb-2">${mitra.business_name || 'Nama Bisnis'}</h3>
                            <div class="flex items-center">
                                <div class="rating-container mr-3">
                                    <i class="fas fa-star text-yellow-500 text-sm mr-1"></i>
                                    <span class="text-sm font-medium text-gray-700">${rating}</span>
                                </div>
                                <span class="text-xs text-gray-500 truncate">${serviceArea}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="price-tag">Mulai Rp ${price}</span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ url('/chatify') }}/${mitra.user_id}" class="btn-primary flex-1 text-center">
                            <i class="fas fa-comment-dots mr-1"></i>Chat
                        </a>
                        <button class="btn-secondary flex-1">
                            <i class="fas fa-calendar-check mr-1"></i>Pesan
                        </button>
                        <button class="btn-success flex-1 detail-mitra" data-id="${mitra.id}">
                            <i class="fas fa-info-circle mr-1"></i>Detail
                        </button>
                    </div>
                </div>`;
                    });
                }
                $('#servicesContainer').html(html);
                attachDetailButtons();
            }

            $('#categoryNav').on('click', '.category-item', function (e) {
                e.preventDefault();

                $('.category-item').removeClass('active');
                $(this).addClass('active');

                const categoryId = $(this).data('category');

                $('#servicesContainer').addClass('hidden');
                $('#loadingIndicator').removeClass('hidden');
                $('#noResults').addClass('hidden');

                if (categoryId === 'all') {
                    window.location.href = '{{ route("customer.dashboard") }}';
                    return;
                }

                $.ajax({
                    url: `{{ route("customer.mitra.category", ":categoryId") }}`.replace(':categoryId', categoryId),
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log('Category filter response:', response);

                        $('#loadingIndicator').addClass('hidden');
                        $('#servicesContainer').removeClass('hidden');

                        if (response.success && response.data && response.data.length > 0) {
                            renderMitras(response.data);
                            $('#noResults').addClass('hidden');
                        } else {
                            $('#servicesContainer').html('');
                            $('#noResults').removeClass('hidden');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error:', error);
                        console.error('Status:', status);
                        console.error('Response:', xhr.responseText);

                        $('#loadingIndicator').addClass('hidden');
                        $('#servicesContainer').removeClass('hidden');
                        $('#servicesContainer').html('');
                        $('#noResults').removeClass('hidden');

                        alert('Terjadi kesalahan saat memuat data. Silakan coba lagi.');
                    }
                });
            });

            function attachDetailButtons() {
                $('.detail-mitra').click(function () {
                    const mitraId = $(this).data('id');
                    $('#mitraModal').removeClass('hidden');

                    $.ajax({
                        url: `{{ route('customer.mitra.show', ':id') }}`.replace(':id', mitraId),
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            console.log('Mitra detail response:', response);

                            if (response.success) {
                                const mitra = response.data;
                                const profilePhoto = mitra.profile_photo || `https://ui-avatars.com/api/?name=${encodeURIComponent(mitra.business_name)}&color=FFFFFF&background=4B5563`;
                                const categoryName = mitra.serviceCategory?.name || 'Layanan';

                                let html = `
                        <div class="flex items-start mb-6">
                            <div class="w-20 h-20 rounded-full mr-4 overflow-hidden flex-shrink-0">
                                <img src="${profilePhoto}" alt="${mitra.business_name}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Mitra&color=FFFFFF&background=4B5563'">
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-1">${categoryName}</div>
                                <h4 class="text-2xl font-bold text-gray-900 mb-2">${mitra.business_name}</h4>
                                <div class="flex items-center">
                                    <div class="rating-container mr-4">
                                        <i class="fas fa-star text-yellow-500 mr-1"></i>
                                        <span class="font-medium">${parseFloat(mitra.avg_rating).toFixed(1)}</span>
                                    </div>
                                    <span class="text-gray-500">${Array.isArray(mitra.service_area) ? mitra.service_area.join(', ') : (mitra.service_area || 'N/A')}</span>
                                </div>
                            </div>
                        </div>`;

                                if (mitra.description) {
                                    html += `<div class="mb-6">
                            <h5 class="font-semibold text-gray-900 mb-3">Tentang Mitra</h5>
                            <p class="text-gray-600 leading-relaxed">${mitra.description}</p>
                        </div>`;
                                }

                                if (mitra.skills && mitra.skills.length > 0) {
                                    html += `<div class="mb-6">
                            <h5 class="font-semibold text-gray-900 mb-3">Keterampilan</h5>
                            <div class="flex flex-wrap gap-2">`;
                                    mitra.skills.forEach(skill => {
                                        html += `<span class="bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 text-sm px-4 py-2 rounded-full border border-blue-200">
                                ${skill.skill_name}${skill.experience_years ? ` (${skill.experience_years} tahun)` : ''}
                            </span>`;
                                    });
                                    html += `</div></div>`;
                                }

                                if (mitra.portfolio && mitra.portfolio.length > 0) {
                                    html += `<div class="mb-6">
                            <h5 class="font-semibold text-gray-900 mb-3">Portofolio</h5>
                            <div class="space-y-4">`;
                                    mitra.portfolio.forEach(item => {
                                        html += `<div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <h6 class="font-semibold text-gray-900 mb-2">${item.title}</h6>
                                <p class="text-gray-600 text-sm leading-relaxed mb-2">${item.description || 'Tidak ada deskripsi'}</p>`;
                                        if (item.completion_date) {
                                            html += `<p class="text-xs text-gray-500 flex items-center">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    Selesai: ${new Date(item.completion_date).toLocaleDateString('id-ID')}
                                </p>`;
                                        }
                                        html += `</div>`;
                                    });
                                    html += `</div></div>`;
                                }

                                if (mitra.reviews && mitra.reviews.length > 0) {
                                    html += `<div class="mb-6">
                            <h5 class="font-semibold text-gray-900 mb-3">Ulasan Pelanggan</h5>
                            <div class="space-y-4">`;
                                    mitra.reviews.forEach(review => {
                                        html += `<div class="bg-white border border-gray-200 p-4 rounded-xl">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                            ${review.customer_name.charAt(0).toUpperCase()}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">${review.customer_name}</p>
                                            <div class="flex text-yellow-400">`;
                                        for (let i = 1; i <= 5; i++) {
                                            html += `<i class="fas fa-star${i <= review.rating ? '' : '-o'} text-sm"></i>`;
                                        }
                                        html += `</div>
                                        </div>
                                    </div>
                                    <span class="text-xs text-gray-500">${new Date(review.created_at).toLocaleDateString('id-ID')}</span>
                                </div>
                                <p class="text-gray-600 leading-relaxed">${review.comment || 'Tidak ada komentar'}</p>
                            </div>`;
                                    });
                                    html += `</div></div>`;
                                }

                                html += `<div class="mb-6">
                        <h5 class="font-semibold text-gray-900 mb-3">Harga Layanan</h5>
                        <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-xl border border-blue-200">
                            <div class="flex items-center">
                                <i class="fas fa-tag text-blue-600 mr-2"></i>
                                <span class="text-gray-700">Mulai dari</span>
                                <span class="font-bold text-xl text-blue-600 ml-2">Rp ${parseInt(mitra.starting_price).toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ url('/chatify') }}/${mitra.user_id}" class="btn-primary flex-1 text-center py-3">
                            <i class="fas fa-comment-dots mr-2"></i>Chat Sekarang
                        </a>
                        <button class="btn-secondary flex-1 py-3">
                            <i class="fas fa-calendar-check mr-2"></i>Pesan Layanan
                        </button>
                    </div>`;

                                $('#modalContent').html(html);
                            } else {
                                $('#modalContent').html(`
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-700 mb-2">Gagal memuat data mitra</h4>
                            <p class="text-gray-500">${response.message || 'Silakan coba lagi nanti'}</p>
                        </div>
                    `);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', error);
                            console.error('Response:', xhr.responseText);

                            $('#modalContent').html(`
                    <div class="text-center py-12">
                        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-700 mb-2">Gagal memuat data mitra</h4>
                        <p class="text-gray-500">Silakan coba lagi nanti</p>
                    </div>
                `);
                        }
                    });
                });
            }

            $('#closeModal').click(function () {
                $('#mitraModal').addClass('hidden');
            });

            // Close modal when clicking outside
            $('#mitraModal').click(function (e) {
                if (e.target === this) {
                    $('#mitraModal').addClass('hidden');
                }
            });

            // Close modal with escape key
            $(document).keydown(function (e) {
                if (e.key === 'Escape') {
                    $('#mitraModal').addClass('hidden');
                }
            });

            attachDetailButtons();
        });
    </script>
</body>

</html>