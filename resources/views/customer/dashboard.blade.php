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

        #sidebar {
            width: 64px;
            transition: width 0.3s ease;
            background-color: #1e3a8a;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            z-index: 40;
        }

        #sidebar.active {
            width: 256px;
        }

        .content {
            margin-left: 64px;
            transition: margin-left 0.3s ease;
        }

        @media (min-width: 768px) {
            #sidebar {
                width: 256px;
            }

            .content {
                margin-left: 256px;
            }
        }
    </style>
</head>

<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        @include('layouts.customer.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden content">
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

                <div class="border-b border-gray-200">
                    <div class="px-4 py-2">
                        <ul class="flex space-x-2 md:space-x-4 overflow-x-auto whitespace-nowrap scrollbar-hide"
                            id="categoryNav">
                            <li>
                                <a href="#"
                                    class="category-item px-3 md:px-4 py-2 text-sm md:text-base font-medium border-b-2 border-transparent active"
                                    data-category="all">Semua Layanan</a>
                            </li>
                            @foreach($serviceCategories as $category)
                                <li>
                                    <a href="#"
                                        class="category-item px-3 md:px-4 py-2 text-sm md:text-base font-medium border-b-2 border-transparent"
                                        data-category="{{ $category->id }}">
                                        <i class="{{ $category->icon }} mr-1"></i>{{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="px-4 py-4 md:py-6 flex-1 overflow-y-auto">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 space-y-2 sm:space-y-0">
                    <h4 class="text-lg md:text-xl font-semibold">Layanan Tersedia</h4>
                    <button
                        class="flex items-center text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-sliders-h mr-2"></i> Filters
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="servicesContainer">
                    @foreach ($mitras as $mitra)
                        @php
                            $categoryName = $mitra->serviceCategory->name ?? 'Layanan';
                            $profilePhoto = $mitra->profile_photo ? asset('storage/' . $mitra->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode($mitra->business_name) . '&color=FFFFFF&background=4B5563';
                        @endphp
                        <div
                            class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                            <div class="flex items-start mb-3">
                                <div class="w-12 h-12 md:w-16 md:h-16 rounded-full mr-3 overflow-hidden">
                                    <img src="{{ $profilePhoto }}" alt="{{ $mitra->business_name }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm md:text-base font-semibold">{{ $categoryName }}</div>
                                    <div class="text-sm md:text-base font-semibold text-gray-800">
                                        {{ $mitra->business_name }}
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-star text-yellow-400 mr-1 text-sm"></i>
                                        <span class="mr-2 text-sm">{{ number_format($mitra->avg_rating ?? 0, 1) }}</span>
                                        <span
                                            class="text-gray-500 text-xs md:text-sm">{{ is_array($mitra->service_area) ? implode(', ', $mitra->service_area) : ($mitra->service_area ?? 'N/A') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 mb-3">Mulai dari Rp
                                {{ number_format($mitra->starting_price ?? 10000, 0, ',', '.') }}
                            </div>
                            <div class="flex space-x-2">

                                <a href="{{ url('/chatify/' . $mitra->user_id) }}"
                                    class="bg-blue-600 text-white text-xs md:text-sm px-3 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 flex-1 text-center">Chat</a>
                                <button
                                    class="bg-yellow-400 text-black text-xs md:text-sm px-3 py-2 rounded-md hover:bg-yellow-500 transition-colors duration-200 flex-1">Pesan</button>
                                <button
                                    class="bg-green-600 text-white text-xs md:text-sm px-3 py-2 rounded-md hover:bg-green-700 transition-colors duration-200 flex-1 detail-mitra"
                                    data-id="{{ $mitra->id }}">Detail Mitra</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $mitras->links() }}

                <div id="loadingIndicator" class="text-center py-8 hidden">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-blue-600">
                    </div>
                    <p class="mt-2 text-gray-600">Memuat layanan...</p>
                </div>

                <div id="noResults" class="text-center py-8 hidden">
                    <i class="fas fa-search text-gray-400 text-4xl mb-3"></i>
                    <h4 class="text-lg font-semibold text-gray-700">Tidak ada layanan yang ditemukan</h4>
                    <p class="text-gray-500 mt-1">Coba gunakan kata kunci lain atau filter yang berbeda</p>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal -->
    <div id="mitraModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Detail Mitra</h3>
                <button id="closeModal" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalContent">
                <p class="text-gray-600">Memuat data...</p>
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
            // Update the renderMitras function to handle the data properly:

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
                <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                    <div class="flex items-start mb-3">
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-full mr-3 overflow-hidden">
                            <img src="${profilePhoto}" alt="${mitra.business_name || 'Mitra'}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Mitra&color=FFFFFF&background=4B5563'">
                        </div>
                        <div class="flex-1">
                            <div class="text-sm md:text-base font-semibold">${categoryName}</div>
                            <div class="text-sm md:text-base font-semibold text-gray-800">${mitra.business_name || 'Nama Bisnis'}</div>
                            <div class="flex items-center mt-1">
                                <i class="fas fa-star text-yellow-400 mr-1 text-sm"></i>
                                <span class="mr-2 text-sm">${rating}</span>
                                <span class="text-gray-500 text-xs md:text-sm">${serviceArea}</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 mb-3">Mulai dari Rp ${price}</div>
                    <div class="flex space-x-2">
                        <a href="{{ url('/chatify') }}/${mitra.user_id}" class="bg-blue-600 text-white text-xs md:text-sm px-3 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 flex-1 text-center">Chat</a>
                        <button class="bg-yellow-400 text-black text-xs md:text-sm px-3 py-2 rounded-md hover:bg-yellow-500 transition-colors duration-200 flex-1">Pesan</button>
                        <button class="bg-green-600 text-white text-xs md:text-sm px-3 py-2 rounded-md hover:bg-green-700 transition-colors duration-200 flex-1 detail-mitra" data-id="${mitra.id}">Detail Mitra</button>
                    </div>
                </div>`;
                    });
                }
                $('#servicesContainer').html(html);
                attachDetailButtons();
            }

            // Replace the category navigation click handler with this improved version:

            $('#categoryNav').on('click', '.category-item', function (e) {
                e.preventDefault();

                // Update active state
                $('.category-item').removeClass('active text-blue-600 border-blue-600');
                $(this).addClass('active text-blue-600 border-blue-600');

                const categoryId = $(this).data('category');

                // Show loading state
                $('#servicesContainer').addClass('hidden');
                $('#loadingIndicator').removeClass('hidden');
                $('#noResults').addClass('hidden');

                // If "all" is selected, reload to show all mitras
                if (categoryId === 'all') {
                    window.location.href = '{{ route("customer.dashboard") }}';
                    return;
                }

                // AJAX request for specific category
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

                        // Show error message
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
                            console.log('Mitra detail response:', response); // Add this for debugging

                            if (response.success) {
                                const mitra = response.data;
                                const profilePhoto = mitra.profile_photo || `https://ui-avatars.com/api/?name=${encodeURIComponent(mitra.business_name)}&color=FFFFFF&background=4B5563`;
                                const categoryName = mitra.serviceCategory?.name || 'Layanan';

                                let html = `
                        <div class="flex items-start mb-4">
                            <div class="w-16 h-16 rounded-full mr-4 overflow-hidden">
                                <img src="${profilePhoto}" alt="${mitra.business_name}" class="w-full h-full object-cover" onerror="this.src='https://ui-avatars.com/api/?name=Mitra&color=FFFFFF&background=4B5563'">
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold">${mitra.business_name}</h4>
                                <p class="text-gray-600">${categoryName}</p>
                                <div class="flex items-center mt-1">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>
                                    <span class="mr-2">${parseFloat(mitra.avg_rating).toFixed(1)}</span>
                                    <span class="text-gray-500 text-sm">${Array.isArray(mitra.service_area) ? mitra.service_area.join(', ') : (mitra.service_area || 'N/A')}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5 class="font-semibold mb-2">Tentang Mitra</h5>
                            <p class="text-gray-600">${mitra.description || 'Tidak ada deskripsi'}</p>
                        </div>`;

                                if (mitra.skills && mitra.skills.length > 0) {
                                    html += `<div class="mb-4">
                            <h5 class="font-semibold mb-2">Keterampilan</h5>
                            <div class="flex flex-wrap gap-2">`;
                                    mitra.skills.forEach(skill => {
                                        html += `<span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">
                                ${skill.skill_name}${skill.experience_years ? ` (${skill.experience_years} tahun)` : ''}
                            </span>`;
                                    });
                                    html += `</div></div>`;
                                }

                                if (mitra.portfolio && mitra.portfolio.length > 0) {
                                    html += `<div class="mb-4">
                            <h5 class="font-semibold mb-2">Portofolio</h5>
                            <div class="space-y-3">`;
                                    mitra.portfolio.forEach(item => {
                                        html += `<div class="border p-3 rounded-md">
                                <h6 class="font-semibold">${item.title}</h6>
                                <p class="text-gray-600 text-sm">${item.description || 'Tidak ada deskripsi'}</p>`;
                                        if (item.completion_date) {
                                            html += `<p class="text-xs text-gray-500 mt-1">Selesai: ${new Date(item.completion_date).toLocaleDateString('id-ID')}</p>`;
                                        }
                                        html += `</div>`;
                                    });
                                    html += `</div></div>`;
                                }

                                if (mitra.reviews && mitra.reviews.length > 0) {
                                    html += `<div class="mb-4">
                            <h5 class="font-semibold mb-2">Ulasan Pelanggan</h5>
                            <div class="space-y-3">`;
                                    mitra.reviews.forEach(review => {
                                        html += `<div class="border p-3 rounded-md">
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400 mr-2">`;
                                        for (let i = 1; i <= 5; i++) {
                                            html += `<i class="fas fa-star${i <= review.rating ? '' : '-o'}"></i>`;
                                        }
                                        html += `</div>
                                    <span class="text-sm text-gray-600">${review.customer_name}</span>
                                </div>
                                <p class="text-gray-600 text-sm">${review.comment || 'Tidak ada komentar'}</p>
                                <p class="text-xs text-gray-500 mt-1">${new Date(review.created_at).toLocaleDateString('id-ID')}</p>
                            </div>`;
                                    });
                                    html += `</div></div>`;
                                }

                                html += `<div class="mb-4">
                        <h5 class="font-semibold mb-2">Harga</h5>
                        <p class="text-gray-600">Mulai dari Rp ${parseInt(mitra.starting_price).toLocaleString('id-ID')}</p>
                    </div>
                    <div class="flex space-x-2 mt-4">
                        <a href="{{ url('/chatify') }}/${mitra.user_id}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 flex-1 text-center">
                            <i class="fas fa-comment-dots mr-2"></i>Chat Sekarang
                        </a>
                        <button class="bg-yellow-400 text-black px-4 py-2 rounded-md hover:bg-yellow-500 transition-colors duration-200 flex-1">
                            <i class="fas fa-calendar-check mr-2"></i>Pesan Layanan
                        </button>
                    </div>`;

                                $('#modalContent').html(html);
                            } else {
                                $('#modalContent').html(`
                        <div class="text-center py-8">
                            <i class="fas fa-exclamation-circle text-red-500 text-4xl mb-3"></i>
                            <h4 class="text-lg font-semibold text-gray-700">Gagal memuat data mitra</h4>
                            <p class="text-gray-500 mt-1">${response.message || 'Silakan coba lagi nanti'}</p>
                        </div>
                    `);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX error:', error);
                            console.error('Response:', xhr.responseText);

                            $('#modalContent').html(`
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-circle text-red-500 text-4xl mb-3"></i>
                        <h4 class="text-lg font-semibold text-gray-700">Gagal memuat data mitra</h4>
                        <p class="text-gray-500 mt-1">Silakan coba lagi nanti</p>
                    </div>
                `);
                        }
                    });
                });
            }

            $('#closeModal').click(function () {
                $('#mitraModal').addClass('hidden');
            });

            attachDetailButtons();
        });
    </script>
</body>

</html>