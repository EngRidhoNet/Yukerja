<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Kerja - Temukan Mitra Terdekat Sekarang!</title>
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
        .parallax {
            transform: translateZ(0);
            will-change: transform;
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
        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .smooth-scroll {
            scroll-behavior: smooth;
        }
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        .chat-pulse {
            animation: chatPulse 2s infinite;
        }
        @keyframes chatPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255, 215, 0, 0.7); }
            50% { box-shadow: 0 0 0 20px rgba(255, 215, 0, 0); }
        }
        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .service-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        @media (prefers-reduced-motion: reduce) {
            .floating, .pulse, .fade-in, .hover-lift, .chat-pulse {
                animation: none;
            }
        }
    </style>
</head>
<body class="font-sans smooth-scroll">
    <!-- Navbar -->
    @include('layouts.front.navbar')

    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-yellow-50/50"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10 fade-in">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-blue-900 mb-4 text-shadow">
                        <span class="block">Butuh Jasa Harian?</span>
                        <span class="block mt-2 text-yellow-500 pulse">Temukan Mitra Terdekat!</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-2xl leading-relaxed">
                        Yuk Kerja hadir sebagai solusi digital yang menjembatani kebutuhan tenaga kerja informal dan pelaku UMKM dengan teknologi yang inklusif dan terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#services" class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1 hover-lift">
                            <i class="fas fa-search mr-2"></i>
                            Temukan Mitra Sekarang
                        </a>
                        <a href="#about" class="bg-white text-blue-900 font-medium border-2 border-blue-900 px-8 py-4 rounded-lg text-center hover:bg-blue-50 transition duration-300 hover-lift">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 relative fade-in">
                    <!-- Main worker image (team) -->
                    <div class="relative z-10 overflow-hidden rounded-xl shadow-2xl floating image-overlay" style="height: 400px;">
                        <img src="{{ asset('images/workers.jpg') }}" alt="Professional Team" 
                             class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105"
                             loading="eager">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent rounded-xl"></div>
                    </div> 
                    
                    <!-- Decorative elements with improved positioning -->
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-yellow-400 rounded-lg z-0 opacity-20 parallax"></div>
                    <div class="absolute -top-4 -left-4 w-16 h-16 bg-blue-900 rounded-full z-0 opacity-20 parallax"></div>
                    <div class="absolute top-1/2 -left-8 w-8 h-8 bg-yellow-300 rounded-full z-0 opacity-30 parallax"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-handshake text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="35">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">Active Clients</p>
                </div>
                
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-chart-line text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="1">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">Years of Experience</p>
                </div>
                
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="11">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">IT Recruiters</p>
                </div>
                
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-tasks text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="112">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">Resources Deployed</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section id="services" class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Layanan Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Temukan berbagai jasa profesional dan tukang terlatih untuk membantu kebutuhan harian Anda</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="service-card bg-white rounded-xl shadow-md overflow-hidden fade-in">
                    <div class="h-48 bg-blue-100 flex justify-center items-center image-overlay">
                        <div class="loading-skeleton w-32 h-32 rounded-lg"></div>
                        <i class="fas fa-home text-6xl text-blue-500 absolute"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Jasa Rumah Tangga</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">Layanan pembersihan, perbaikan, dan perawatan untuk rumah Anda dengan standar profesional</p>
                        <a href="#" class="text-yellow-500 font-medium hover:text-yellow-600 flex items-center group transition duration-300">
                            Lihat Detail
                            <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div class="service-card bg-white rounded-xl shadow-md overflow-hidden fade-in">
                    <div class="h-48 bg-blue-100 flex justify-center items-center image-overlay">
                        <div class="loading-skeleton w-32 h-32 rounded-lg"></div>
                        <i class="fas fa-car text-6xl text-blue-500 absolute"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Jasa Otomotif</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">Perbaikan, perawatan, dan layanan untuk kendaraan Anda dengan teknisi berpengalaman</p>
                        <a href="#" class="text-yellow-500 font-medium hover:text-yellow-600 flex items-center group transition duration-300">
                            Lihat Detail
                            <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div class="service-card bg-white rounded-xl shadow-md overflow-hidden fade-in">
                    <div class="h-48 bg-blue-100 flex justify-center items-center image-overlay">
                        <div class="loading-skeleton w-32 h-32 rounded-lg"></div>
                        <i class="fas fa-shipping-fast text-6xl text-blue-500 absolute"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Jasa Pengiriman</h3>
                        <p class="text-gray-600 mb-4 leading-relaxed">Pengiriman barang cepat dan aman ke berbagai tujuan dengan tracking real-time</p>
                        <a href="#" class="text-yellow-500 font-medium hover:text-yellow-600 flex items-center group transition duration-300">
                            Lihat Detail
                            <svg class="w-5 h-5 ml-1 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12 fade-in">
                <a href="#" class="inline-block bg-blue-900 text-white font-bold px-8 py-4 rounded-lg shadow-md hover:bg-blue-800 transition duration-300 transform hover:-translate-y-1 hover-lift">
                    <i class="fas fa-th-large mr-2"></i>
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>
    
    <!-- How It Works -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Cara Kerja</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Mudah dan cepat untuk mendapatkan layanan yang Anda butuhkan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center fade-in hover-lift">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 text-2xl font-bold mb-6 relative">
                        1
                        <div class="absolute inset-0 rounded-full bg-yellow-500 opacity-20 animate-ping"></div>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Pilih Layanan</h3>
                    <p class="text-gray-600 leading-relaxed">Pilih layanan yang Anda butuhkan dari berbagai kategori yang tersedia dengan mudah</p>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center fade-in hover-lift">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 text-2xl font-bold mb-6 relative">
                        2
                        <div class="absolute inset-0 rounded-full bg-yellow-500 opacity-20 animate-ping animation-delay-1000"></div>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Temukan Mitra</h3>
                    <p class="text-gray-600 leading-relaxed">Kami akan mencarikan mitra terdekat yang sesuai dengan kebutuhan dan lokasi Anda</p>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center fade-in hover-lift">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 text-2xl font-bold mb-6 relative">
                        3
                        <div class="absolute inset-0 rounded-full bg-yellow-500 opacity-20 animate-ping animation-delay-2000"></div>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Dapatkan Layanan</h3>
                    <p class="text-gray-600 leading-relaxed">Mitra akan datang ke lokasi Anda dan menyelesaikan pekerjaan dengan profesional</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="py-20 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Apa Kata Mereka</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Lihat pengalaman pengguna yang telah menggunakan layanan Yuk Kerja</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-500"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Ahmad Sudirman</h4>
                            <p class="text-gray-500 text-sm">Jakarta Selatan</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">"Sangat puas dengan layanan yang diberikan. Tukang datang tepat waktu dan menyelesaikan pekerjaan dengan baik."</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-500"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Siti Nurhaliza</h4>
                            <p class="text-gray-500 text-sm">Bandung</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">"Aplikasi yang sangat membantu. Saya bisa menemukan tukang AC dengan cepat saat unit AC di rumah rusak mendadak."</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-user text-blue-500"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-900">Budi Santoso</h4>
                            <p class="text-gray-500 text-sm">Surabaya</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">"Sebagai pemilik usaha kecil, Yuk Kerja membantu saya menemukan pekerja lepas dengan kualifikasi yang tepat. Sangat direkomendasikan!"</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-20 bg-blue-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0 fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-shadow">Siap Bergabung dengan Yuk Kerja?</h2>
                    <p class="text-blue-100 text-xl mb-6 leading-relaxed">Daftarkan diri Anda sekarang dan jadi bagian dari revolusi pekerjaan informal di Indonesia</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1 hover-lift">
                            <i class="fas fa-user-plus mr-2"></i>
                            Daftar Sebagai Pengguna
                        </a>
                        <a href="#" class="bg-transparent text-white font-medium border-2 border-white px-8 py-4 rounded-lg text-center hover:bg-white hover:text-blue-900 transition duration-300 hover-lift">
                            <i class="fas fa-handshake mr-2"></i>
                            Daftar Sebagai Mitra
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center fade-in">
                    <div class="relative">
                        <div class="loading-skeleton w-96 h-72 rounded-xl"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-mobile-alt text-8xl text-blue-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-blue-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div class="fade-in">
                    <div class="flex items-center mb-6">
                        <img class="h-10 w-auto" src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Yuk Kerja Logo">
                        <span class="ml-2 text-xl font-bold">Yuk Kerja</span>
                    </div>
                    <p class="text-blue-200 mb-6 leading-relaxed">Solusi digital untuk kebutuhan tenaga kerja informal dan UMKM di Indonesia</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift" aria-label="Facebook">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift" aria-label="Twitter">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift" aria-label="Instagram">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="fade-in">
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Home</a></li>
                        <li><a href="#about" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">About Us</a></li>
                        <li><a href="#services" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Services</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Blog</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div class="fade-in">
                    <h4 class="text-lg font-bold mb-6">Services</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa Rumah Tangga</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa Otomotif</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa Pengiriman</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa Teknisi</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa Lainnya</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="fade-in">
                    <h4 class="text-lg font-bold mb-6">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-yellow-500 flex-shrink-0"></i>
                            <span class="text-blue-200">Kantor Pak Fachrul Kaprodi TI</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-yellow-500 flex-shrink-0"></i>
                            <a href="tel:+622112345678" class="text-blue-200 hover:text-white transition duration-300">+62 21 1234 5678</a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-yellow-500 flex-shrink-0"></i>
                            <a href="mailto:info@yukkerja.id" class="text-blue-200 hover:text-white transition duration-300">info@yukkerja.id</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-blue-800 mb-8">
            
            <div class="flex flex-col md:flex-row items-center justify-between">
                <p class="text-blue-200 text-sm mb-4 md:mb-0">&copy; 2025 Yuk Kerja. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-200 hover:text-white text-sm transition duration-300">Privacy Policy</a>
                    <a href="#" class="text-blue-200 hover:text-white text-sm transition duration-300">Terms of Service</a>
                    <a href="#" class="text-blue-200 hover:text-white text-sm transition duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Chat Button -->
    <div class="fixed bottom-8 right-8 z-50">
        <button class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold w-16 h-16 rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1 chat-pulse" aria-label="Chat Support">
            <i class="fas fa-comments text-2xl"></i>
        </button>
    </div>
    
    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 left-8 bg-blue-900 hover:bg-blue-800 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition duration-300 transform hover:-translate-y-1 opacity-0 invisible z-50" aria-label="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div class="hidden fixed inset-0 bg-black bg-opacity-50 z-50" id="mobileMenu">
        <div class="bg-white h-full w-64 pt-16 px-4 transform -translate-x-full transition-transform duration-300" id="mobileMenuContent">
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Home</a>
            <a href="#about" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">About</a>
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Daftar</a>
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Masuk</a>
            <a href="#" class="block py-3 bg-yellow-500 text-blue-900 font-bold px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300 mt-4">Daftar Mitra</a>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Observe all fade-in elements
            document.querySelectorAll('.fade-in').forEach(el => {
                observer.observe(el);
            });

            // Counter animation
            function animateCounter(element) {
                const target = parseInt(element.dataset.target);
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        element.textContent = target + '+';
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 16);
            }

            // Animate counters when they come into view
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            document.querySelectorAll('.counter').forEach(counter => {
                counterObserver.observe(counter);
            });

            // Mobile menu functionality
            const mobileMenuButton = document.querySelector('button[type="button"]');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuContent = document.getElementById('mobileMenuContent');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    setTimeout(() => {
                        mobileMenuContent.classList.toggle('-translate-x-full');
                    }, 10);
                });
                
                mobileMenu.addEventListener('click', function(e) {
                    if (e.target === mobileMenu) {
                        mobileMenuContent.classList.add('-translate-x-full');
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                        }, 300);
                    }
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const headerOffset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Back to top button functionality
            const backToTopButton = document.getElementById('backToTop');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.add('opacity-0', 'invisible');
                    backToTopButton.classList.remove('opacity-100', 'visible');
                }
            });

            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Form validation
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('border-red-500');
                            
                            // Add error message if not exists
                            if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('error-message')) {
                                const errorMsg = document.createElement('span');
                                errorMsg.className = 'error-message text-red-500 text-sm mt-1 block';
                                errorMsg.textContent = 'Field ini wajib diisi';
                                field.parentNode.insertBefore(errorMsg, field.nextSibling);
                            }
                        } else {
                            field.classList.remove('border-red-500');
                            
                            // Remove error message if exists
                            if (field.nextElementSibling && field.nextElementSibling.classList.contains('error-message')) {
                                field.nextElementSibling.remove();
                            }
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            });

            // Parallax effect for decorative elements
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.parallax');
                
                parallaxElements.forEach(element => {
                    const speed = 0.5;
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });

            // Lazy loading for images
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('loading-skeleton');
                        imageObserver.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });

            // Performance optimization - debounce scroll events
            function debounce(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            }

            // Apply debounced scroll handler
            const debouncedScrollHandler = debounce(() => {
                // Scroll-based animations can be added here
            }, 16);

            window.addEventListener('scroll', debouncedScrollHandler);

            // Accessibility improvements
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                    mobileMenuContent.classList.add('-translate-x-full');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300);
                }
            });

            // Add focus management for better accessibility
            const focusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
            
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    const focusable = document.querySelectorAll(focusableElements);
                    const firstFocusable = focusable[0];
                    const lastFocusable = focusable[focusable.length - 1];

                    if (e.shiftKey) {
                        if (document.activeElement === firstFocusable) {
                            lastFocusable.focus();
                            e.preventDefault();
                        }
                    } else {
                        if (document.activeElement === lastFocusable) {
                            firstFocusable.focus();
                            e.preventDefault();
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>