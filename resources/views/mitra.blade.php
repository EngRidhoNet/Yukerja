<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Terpercaya - Yuk Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(90deg, #f0f9ff 0%, #e6f7ff 100%);
        }
        .cta-gradient {
            background: linear-gradient(90deg, #ffd700 0%, #ffb700 100%);
        }
        .floating {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .mitra-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .mitra-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .smooth-scroll {
            scroll-behavior: smooth;
        }
        .image-overlay {
            position: relative;
            overflow: hidden;
        }
        .image-overlay::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(255, 215, 0, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }
        .image-overlay:hover::before {
            opacity: 1;
        }
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .badge-verified {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .badge-category {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        .filter-tabs {
            position: sticky;
            top: 80px;
            z-index: 40;
        }
        .rating-stars {
            background: linear-gradient(90deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        @media (prefers-reduced-motion: reduce) {
            .floating, .pulse, .fade-in, .hover-lift {
                animation: none;
            }
        }
    </style>
</head>
<body class="font-sans smooth-scroll bg-gray-50">
    @include('layouts.front.navbar')

    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center fade-in">
                <h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-4 text-shadow">
                    <span class="block">Mitra Terpercaya</span>
                    <span class="block mt-2 text-yellow-500">Siap Melayani Anda</span>
                </h1>
                <p class="text-xl text-gray-700 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Temukan mitra profesional dan berpengalaman untuk berbagai kebutuhan layanan Anda
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg p-6 glass-effect">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" placeholder="Cari mitra atau layanan..." 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="flex-1">
                                <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option>Pilih Kategori</option>
                                    <option>Jasa Rumah Tangga</option>
                                    <option>Jasa Otomotif</option>
                                    <option>Jasa Pengiriman</option>
                                    <option>Jasa Teknisi</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <input type="text" placeholder="Lokasi..." 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <button class="cta-gradient text-blue-900 font-bold px-8 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                                <i class="fas fa-search mr-2"></i>
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Tabs -->
    <section class="filter-tabs bg-white shadow-md py-4">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="px-6 py-2 bg-blue-900 text-white rounded-full font-medium hover:bg-blue-800 transition duration-300" data-filter="all">
                    Semua Mitra
                </button>
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition duration-300" data-filter="verified">
                    Terverifikasi
                </button>
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition duration-300" data-filter="top-rated">
                    Rating Tertinggi
                </button>
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition duration-300" data-filter="nearby">
                    Terdekat
                </button>
                <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-full font-medium hover:bg-gray-300 transition duration-300" data-filter="available">
                    Tersedia Sekarang
                </button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="fade-in">
                    <div class="text-blue-500 mb-2">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-900 counter" data-target="150">0</h3>
                    <p class="text-gray-600 font-medium">Mitra Aktif</p>
                </div>
                
                <div class="fade-in">
                    <div class="text-blue-500 mb-2">
                        <i class="fas fa-star text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-900">4.8</h3>
                    <p class="text-gray-600 font-medium">Rating Rata-rata</p>
                </div>
                
                <div class="fade-in">
                    <div class="text-blue-500 mb-2">
                        <i class="fas fa-check-circle text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-900 counter" data-target="1250">0</h3>
                    <p class="text-gray-600 font-medium">Pekerjaan Selesai</p>
                </div>
                
                <div class="fade-in">
                    <div class="text-blue-500 mb-2">
                        <i class="fas fa-clock text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-blue-900">24/7</h3>
                    <p class="text-gray-600 font-medium">Layanan Tersedia</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mitra Grid -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Mitra Terbaik Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Profesional berpengalaman siap membantu kebutuhan Anda</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="mitraGrid">
                <!-- Mitra Card 1 -->
                <div class="mitra-card bg-white rounded-xl shadow-md overflow-hidden fade-in" data-category="rumah-tangga" data-verified="true" data-rating="4.9">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 image-overlay">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop&crop=face" 
                                 alt="Ahmad Sudirman" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute top-4 right-4 flex gap-2">
                            <span class="badge-verified text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-circle text-xs mr-1"></i>Online
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-blue-900">Ahmad Sudirman</h3>
                                <p class="text-gray-600 text-sm">Cleaning Service Professional</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center text-yellow-500 mb-1">
                                    <i class="fas fa-star text-sm"></i>
                                    <span class="text-sm font-bold ml-1">4.9</span>
                                </div>
                                <p class="text-xs text-gray-500">25 reviews</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <span class="badge-category text-white text-xs px-2 py-1 rounded-full">Jasa Rumah Tangga</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Spesialis pembersihan rumah, apartemen, dan kantor dengan pengalaman 5+ tahun.</p>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Jakarta Selatan - 2.5 km</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-blue-900">
                                <span class="text-lg font-bold">Rp 150K</span>
                                <span class="text-sm text-gray-500">/hari</span>
                            </div>
                            <div class="flex items-center text-green-600 text-sm">
                                <i class="fas fa-check-circle mr-1"></i>
                                <span>32 completed</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="flex-1 bg-blue-900 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-800 transition duration-300">
                                <i class="fas fa-phone mr-2"></i>Hubungi
                            </button>
                            <button class="flex-1 bg-yellow-500 text-blue-900 py-2 px-4 rounded-lg font-medium hover:bg-yellow-600 transition duration-300">
                                <i class="fas fa-calendar mr-2"></i>Book
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mitra Card 2 -->
                <div class="mitra-card bg-white rounded-xl shadow-md overflow-hidden fade-in" data-category="otomotif" data-verified="true" data-rating="4.8">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 image-overlay">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=300&fit=crop&crop=face" 
                                 alt="Budi Santoso" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute top-4 right-4 flex gap-2">
                            <span class="badge-verified text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                            <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-circle text-xs mr-1"></i>Busy
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-blue-900">Budi Santoso</h3>
                                <p class="text-gray-600 text-sm">Auto Mechanic Expert</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center text-yellow-500 mb-1">
                                    <i class="fas fa-star text-sm"></i>
                                    <span class="text-sm font-bold ml-1">4.8</span>
                                </div>
                                <p class="text-xs text-gray-500">42 reviews</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <span class="badge-category text-white text-xs px-2 py-1 rounded-full">Jasa Otomotif</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Teknisi berpengalaman untuk servis mobil, motor, dan perbaikan darurat.</p>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Jakarta Timur - 4.1 km</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-blue-900">
                                <span class="text-lg font-bold">Rp 200K</span>
                                <span class="text-sm text-gray-500">/service</span>
                            </div>
                            <div class="flex items-center text-green-600 text-sm">
                                <i class="fas fa-check-circle mr-1"></i>
                                <span>58 completed</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="flex-1 bg-blue-900 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-800 transition duration-300">
                                <i class="fas fa-phone mr-2"></i>Hubungi
                            </button>
                            <button class="flex-1 bg-yellow-500 text-blue-900 py-2 px-4 rounded-lg font-medium hover:bg-yellow-600 transition duration-300">
                                <i class="fas fa-calendar mr-2"></i>Book
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mitra Card 3 -->
                <div class="mitra-card bg-white rounded-xl shadow-md overflow-hidden fade-in" data-category="pengiriman" data-verified="false" data-rating="4.6">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 image-overlay">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=300&fit=crop&crop=face" 
                                 alt="Dedi Kurniawan" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute top-4 right-4 flex gap-2">
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-circle text-xs mr-1"></i>Online
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-blue-900">Dedi Kurniawan</h3>
                                <p class="text-gray-600 text-sm">Delivery Specialist</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center text-yellow-500 mb-1">
                                    <i class="fas fa-star text-sm"></i>
                                    <span class="text-sm font-bold ml-1">4.6</span>
                                </div>
                                <p class="text-xs text-gray-500">18 reviews</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <span class="badge-category text-white text-xs px-2 py-1 rounded-full">Jasa Pengiriman</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Layanan pengiriman cepat dan aman untuk berbagai jenis barang.</p>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Jakarta Pusat - 1.8 km</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-blue-900">
                                <span class="text-lg font-bold">Rp 15K</span>
                                <span class="text-sm text-gray-500">/km</span>
                            </div>
                            <div class="flex items-center text-green-600 text-sm">
                                <i class="fas fa-check-circle mr-1"></i>
                                <span>89 completed</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="flex-1 bg-blue-900 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-800 transition duration-300">
                                <i class="fas fa-phone mr-2"></i>Hubungi
                            </button>
                            <button class="flex-1 bg-yellow-500 text-blue-900 py-2 px-4 rounded-lg font-medium hover:bg-yellow-600 transition duration-300">
                                <i class="fas fa-calendar mr-2"></i>Book
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mitra Card 4 -->
                <div class="mitra-card bg-white rounded-xl shadow-md overflow-hidden fade-in" data-category="teknisi" data-verified="true" data-rating="4.9">
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 image-overlay">
                            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&h=300&fit=crop&crop=face" 
                                 alt="Eko Prasetyo" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute top-4 right-4 flex gap-2">
                            <span class="badge-verified text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-check-circle mr-1"></i>Verified
                            </span>
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                <i class="fas fa-circle text-xs mr-1"></i>Online
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-bold text-blue-900">Eko Prasetyo</h3>
                                <p class="text-gray-600 text-sm">Electronics Technician</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center text-yellow-500 mb-1">
                                    <i class="fas fa-star text-sm"></i>
                                    <span class="text-sm font-bold ml-1">4.9</span>
                                </div>
                                <p class="text-xs text-gray-500">36 reviews</p>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <span class="badge-category text-white text-xs px-2 py-1 rounded-full">Jasa Teknisi</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Ahli perbaikan AC, kulkas, TV, dan perangkat elektronik lainnya.</p>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Jakarta Barat - 3.2 km</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-blue-900">
                                <span class="text-lg font-bold">Rp 100K</span>
                                <span class="text-sm text-gray-500">/visit</span>
                            </div>
                            <div class="flex items-center text-green-600 text-sm">
                                <i class="fas fa-check-circle mr-1"></i>
                                <span>67 completed</span>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            <button class="flex-1 bg-blue-900 text-white py-2 px-4 rounded-lg font-medium hover:bg-blue-800 transition duration-300">
                                <i class="fas fa-phone mr-2"></i>Hubungi
                            </button>
                            <button class="flex-1 bg-yellow-500 text-blue-900 py-2 px-4 rounded-lg font-medium hover:bg-yellow-600 transition duration-300">
                                <i class="fas fa-calendar mr-2"></i>Book
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12 fade-in">
                <button class="bg-blue-900 text-white font-bold px-8 py-4 rounded-lg shadow-md hover:bg-blue-800 transition duration-300 transform hover:-translate-y-1 hover-lift">
                    <i class="fas fa-plus mr-2"></i>
                    Muat Lebih Banyak
                </button>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-shadow">Bergabung Sebagai Mitra?</h2>
                <p class="text-xl mb-8 max-w-3xl mx-auto leading-relaxed opacity-90">
                    Dapatkan penghasilan tambahan dengan bergabung bersama ribuan mitra terpercaya kami
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 pulse">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sebagai Mitra
                    </button>
                    <button class="bg-transparent border-2 border-white text-white font-bold px-8 py-4 rounded-lg hover:bg-white hover:text-blue-900 transition duration-300">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pelajari Lebih Lanjut
                    </button>
                </div>
                
                <!-- Benefits Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                    <div class="text-center fade-in">
                        <div class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-money-bill-wave text-2xl text-yellow-300"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Penghasilan Fleksibel</h3>
                        <p class="text-blue-100">Tentukan tarif dan jadwal kerja Anda sendiri</p>
                    </div>
                    
                    <div class="text-center fade-in">
                        <div class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-2xl text-yellow-300"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Perlindungan Asuransi</h3>
                        <p class="text-blue-100">Dapatkan proteksi untuk setiap pekerjaan yang dilakukan</p>
                    </div>
                    
                    <div class="text-center fade-in">
                        <div class="bg-white bg-opacity-20 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-graduation-cap text-2xl text-yellow-300"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Pelatihan Gratis</h3>
                        <p class="text-blue-100">Upgrade skill dengan program pelatihan berkualitas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Apa Kata Mereka</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Testimoni dari para pengguna dan mitra yang puas</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md hover-lift fade-in">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b77c?w=60&h=60&fit=crop&crop=face" 
                             alt="Sarah" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-bold text-blue-900">Sarah Wijaya</h4>
                            <p class="text-sm text-gray-600">Pelanggan</p>
                        </div>
                        <div class="ml-auto flex text-yellow-500">
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Pelayanan cleaning service dari Ahmad sangat memuaskan. Rumah jadi bersih dan rapi, harga juga terjangkau!"</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md hover-lift fade-in">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face" 
                             alt="Budi" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-bold text-blue-900">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Mitra</p>
                        </div>
                        <div class="ml-auto flex text-yellow-500">
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Sejak bergabung dengan Yuk Kerja, penghasilan saya meningkat 200%. Platform yang sangat membantu para teknisi seperti saya."</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gray-50 rounded-xl p-6 shadow-md hover-lift fade-in">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=60&h=60&fit=crop&crop=face" 
                             alt="Maya" class="w-12 h-12 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-bold text-blue-900">Maya Sari</h4>
                            <p class="text-sm text-gray-600">Pelanggan</p>
                        </div>
                        <div class="ml-auto flex text-yellow-500">
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                            <i class="fas fa-star text-sm"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 italic">"Aplikasi yang user-friendly dan mitra-mitra yang profesional. Sangat recommended untuk yang butuh jasa cepat dan terpercaya."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <img class="h-10 w-auto" src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Yuk Kerja Logo">
                        <span class="ml-2 text-xl font-bold">Yuk Kerja</span>
                    </div>
                    <p class="text-blue-100 mb-6 leading-relaxed">
                        Platform terpercaya yang menghubungkan Anda dengan mitra profesional untuk berbagai kebutuhan layanan. 
                        Solusi praktis untuk kehidupan yang lebih mudah.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-800 hover:bg-blue-700 p-3 rounded-full transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-blue-800 hover:bg-blue-700 p-3 rounded-full transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-blue-800 hover:bg-blue-700 p-3 rounded-full transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-blue-800 hover:bg-blue-700 p-3 rounded-full transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-blue-100 hover:text-white transition duration-300">Beranda</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition duration-300">Layanan</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition duration-300">Mitra</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition duration-300">Blog</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-white transition duration-300">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4">Hubungi Kami</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-yellow-300 mr-3"></i>
                            <span class="text-blue-100">Jakarta, Indonesia</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-yellow-300 mr-3"></i>
                            <span class="text-blue-100">+62 21 1234 5678</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-yellow-300 mr-3"></i>
                            <span class="text-blue-100">info@yukkerja.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-yellow-300 mr-3"></i>
                            <span class="text-blue-100">24/7 Customer Support</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-blue-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-blue-100 text-sm">© 2024 Yuk Kerja. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-blue-100 hover:text-white text-sm transition duration-300">Privacy Policy</a>
                    <a href="#" class="text-blue-100 hover:text-white text-sm transition duration-300">Terms of Service</a>
                    <a href="#" class="text-blue-100 hover:text-white text-sm transition duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }

        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    statsObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        const statsSection = document.querySelector('.counter').closest('section');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }

        // Filter functionality
        const filterButtons = document.querySelectorAll('[data-filter]');
        const mitraCards = document.querySelectorAll('.mitra-card');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');
                
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-900', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });
                button.classList.add('bg-blue-900', 'text-white');
                button.classList.remove('bg-gray-200', 'text-gray-700');

                // Filter cards
                mitraCards.forEach(card => {
                    const shouldShow = filter === 'all' || 
                        (filter === 'verified' && card.getAttribute('data-verified') === 'true') ||
                        (filter === 'top-rated' && parseFloat(card.getAttribute('data-rating')) >= 4.8) ||
                        (filter === 'nearby' && card.querySelector('.fa-map-marker-alt').parentNode.textContent.includes('km')) ||
                        (filter === 'available' && card.querySelector('.bg-green-500'));

                    if (shouldShow) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.querySelector('input[placeholder="Cari mitra atau layanan..."]');
        const categorySelect = document.querySelector('select');
        const locationInput = document.querySelector('input[placeholder="Lokasi..."]');
        const searchButton = document.querySelector('.cta-gradient');

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categorySelect.value;
            const locationTerm = locationInput.value.toLowerCase();

            mitraCards.forEach(card => {
                const name = card.querySelector('h3').textContent.toLowerCase();
                const profession = card.querySelector('.text-gray-600').textContent.toLowerCase();
                const description = card.querySelector('.line-clamp-2').textContent.toLowerCase();
                const location = card.querySelector('.fa-map-marker-alt').parentNode.textContent.toLowerCase();
                const category = card.querySelector('.badge-category').textContent;

                const matchesSearch = !searchTerm || name.includes(searchTerm) || 
                                    profession.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = selectedCategory === 'Pilih Kategori' || category.includes(selectedCategory);
                const matchesLocation = !locationTerm || location.includes(locationTerm);

                if (matchesSearch && matchesCategory && matchesLocation) {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }

        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') performSearch();
        });

        // Mobile menu toggle (if needed)
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.querySelector('.mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Load more functionality
        const loadMoreButton = document.querySelector('.bg-blue-900.hover\\:bg-blue-800.transform.hover\\:-translate-y-1');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', () => {
                // Simulate loading more cards
                loadMoreButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
                setTimeout(() => {
                    loadMoreButton.innerHTML = '<i class="fas fa-plus mr-2"></i>Muat Lebih Banyak';
                    // Here you would typically load more data from an API
                }, 2000);
            });
        }
    </script>
</body>
</html>