<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerja - Beranda</title>
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
    </style>
</head>
<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        
        <!-- Sidebar -->
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
                        <input type="text" class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base" placeholder="Cari jasa">
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
                
                <!-- Category Navigation -->
                <div class="border-b border-gray-200">
                    <div class="px-4 py-2">
                        <ul class="flex space-x-2 md:space-x-4 overflow-x-auto whitespace-nowrap scrollbar-hide">
                            <li>
                                <a href="#" class="px-3 md:px-4 py-2 text-sm md:text-base text-blue-600 font-medium border-b-2 border-blue-600">Untuk Kamu</a>
                            </li>
                            <li>
                                <a href="#" class="px-3 md:px-4 py-2 text-sm md:text-base text-gray-600 font-medium hover:text-blue-600 transition-colors duration-200">Layanan Umum</a>
                            </li>
                            <li>
                                <a href="#" class="px-3 md:px-4 py-2 text-sm md:text-base text-gray-600 font-medium hover:text-blue-600 transition-colors duration-200">Bengkel Kendaraan</a>
                            </li>
                            <li>
                                <a href="#" class="px-3 md:px-4 py-2 text-sm md:text-base text-gray-600 font-medium hover:text-blue-600 transition-colors duration-200">Layanan Rumah Tangga</a>
                            </li>
                            <li>
                                <a href="#" class="px-3 md:px-4 py-2 text-sm md:text-base text-gray-600 font-medium hover:text-blue-600 transition-colors duration-200">Pekerjaan Freelance</a>
                            </li>
                            <li>
                                <a href="#" class="px-3 md:px-4 py-2 text-sm md:text-base text-gray-600 font-medium hover:text-blue-600 transition-colors duration-200">Lain-lain</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="px-4 py-4 md:py-6 flex-1 overflow-y-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 md:mb-6 space-y-2 sm:space-y-0">
                    <h4 class="text-lg md:text-xl font-semibold">Layanan</h4>
                    <button class="flex items-center text-gray-800 font-semibold hover:text-blue-600 transition-colors duration-200">
                        <i class="fas fa-sliders-h mr-2"></i> Filters
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach ($mitras as $mitra)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                            <div class="flex items-start mb-3">
                                <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full mr-3 flex items-center justify-center">
                                    <i class="fas fa-tools text-white text-lg md:text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-sm md:text-base font-semibold">{{ $mitra->service_category ?? 'Layanan' }}</div>
                                    <div class="text-sm md:text-base font-semibold text-gray-800">{{ $mitra->business_name }}</div>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-star text-yellow-400 mr-1 text-sm"></i>
                                        <span class="mr-2 text-sm">{{ number_format($mitra->avg_rating, 1) }}</span>
                                        <span class="text-gray-500 text-xs md:text-sm">{{ $mitra->service_area ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500 mb-3">Mulai dari Rp {{ number_format(10000 + ($mitra->id * 5000), 0, ',', '.') }}</div>
                            <div class="flex space-x-2">
                                <button class="bg-blue-600 text-white text-xs md:text-sm px-3 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 flex-1">Chat</button>
                                <button class="bg-yellow-400 text-black text-xs md:text-sm px-3 py-2 rounded-md hover:bg-yellow-500 transition-colors duration-200 flex-1">Pesan</button>
                                <button class="bg-green-600 text-white text-xs md:text-sm px-3 py-2 rounded-md hover:bg-green-700 transition-colors duration-200 flex-1 detail-mitra" data-id="{{ $mitra->id }}">Detail Mitra</button>
                            </div>
                        </div>
                    @endforeach
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mitraModal = document.getElementById('mitraModal');
        const closeModal = document.getElementById('closeModal');
        const modalContent = document.getElementById('modalContent');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebarFn() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        function openModal() {
            mitraModal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        }

        function closeModalFn() {
            mitraModal.classList.add('hidden');
            overlay.classList.add('hidden');
        }

        menuToggle.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarFn);
        overlay.addEventListener('click', closeSidebarFn);
        closeModal.addEventListener('click', closeModalFn);

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
            }
        });

        // Close sidebar/modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeSidebarFn();
                closeModalFn();
            }
        });

        // Fetch mitra details on "Detail Mitra" button click
        document.querySelectorAll('.detail-mitra').forEach(button => {
            button.addEventListener('click', function() {
                const mitraId = this.getAttribute('data-id');
                $.ajax({
                    url: `/mitra/${mitraId}`,
                    method: 'GET',
                    success: function(data) {
                        let html = `<h4 class="text-lg font-semibold mb-2">${data.business_name}</h4>`;
                        html += `<p class="text-gray-600 mb-4">${data.description ?? 'Tidak ada deskripsi'}</p>`;

                        // Skills Section
                        if (data.skills && data.skills.length > 0) {
                            html += `<h5 class="text-md font-semibold mb-2">Keterampilan</h5>`;
                            html += `<ul class="list-disc pl-5 mb-4">`;
                            data.skills.forEach(skill => {
                                html += `<li>${skill.skill_name} (${skill.experience_years ? skill.experience_years + ' tahun' : 'N/A'})`;
                                if (skill.certification) {
                                    html += ` - Sertifikasi: ${skill.certification}`;
                                }
                                html += `</li>`;
                            });
                            html += `</ul>`;
                        } else {
                            html += `<p class="text-gray-600 mb-4">Belum ada keterampilan yang terdaftar.</p>`;
                        }

                        // Portfolio Section
                        if (data.portfolio && data.portfolio.length > 0) {
                            html += `<h5 class="text-md font-semibold mb-2">Portofolio</h5>`;
                            html += `<div class="grid grid-cols-1 gap-4">`;
                            data.portfolio.forEach(item => {
                                html += `<div class="border p-3 rounded-md">`;
                                html += `<h6 class="font-semibold">${item.title}</h6>`;
                                html += `<p class="text-gray-600">${item.description ?? 'Tidak ada deskripsi'}</p>`;
                                if (item.image_url) {
                                    html += `<img src="${item.image_url}" alt="${item.title}" class="w-full h-32 object-cover rounded-md mt-2">`;
                                }
                                if (item.completion_date) {
                                    html += `<p class="text-sm text-gray-500">Selesai: ${new Date(item.completion_date).toLocaleDateString('id-ID')}</p>`;
                                }
                                html += `</div>`;
                            });
                            html += `</div>`;
                        } else {
                            html += `<p class="text-gray-600 mb-4">Belum ada portofolio yang terdaftar.</p>`;
                        }

                        // Fallback if no skills or portfolio
                        if ((!data.skills || data.skills.length === 0) && (!data.portfolio || data.portfolio.length === 0)) {
                            html += `<p class="text-gray-600 font-semibold">Data mitra belum lengkap nih!</p>`;
                        }

                        modalContent.innerHTML = html;
                        openModal();
                    },
                    error: function() {
                        modalContent.innerHTML = `<p class="text-red-600">Gagal memuat data mitra.</p>`;
                        openModal();
                    }
                });
            });
        });
    </script>
</body>
</html>