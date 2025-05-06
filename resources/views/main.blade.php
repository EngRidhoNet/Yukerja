<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Kerja - Temukan Mitra Terdekat Sekarang!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
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
    </style>
</head>
<body class="font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="#" class="flex-shrink-0 flex items-center">
                        <img class="h-12 w-auto" src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Yuk Kerja Logo">
                        {{-- <span class="ml-2 text-2xl font-bold text-blue-900">Yuk Kerja</span> --}}
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('main') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Home</a>
                    <a href="{{ route('about') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">About</a>
                    <a href="{{ route('customer.register') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Daftar Customer</a>
                    <a href="{{ route('login') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Masuk</a>
                    <a href="{{ route('mitra.register') }}" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">Daftar Mitra</a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex md:hidden items-center">
                    <button type="button" class="text-gray-600 hover:text-blue-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-32 pb-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-blue-900 mb-4">
                        <span class="block">Butuh Jasa Harian?</span>
                        <span class="block mt-2 text-yellow-500 pulse">Temukan Mitra Terdekat!</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-2xl">
                        Yuk Kerja hadir sebagai solusi digital yang menjembatani kebutuhan tenaga kerja informal dan pelaku UMKM dengan teknologi yang inklusif dan terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                            Temukan Mitra Sekarang
                        </a>
                        <a href="#" class="bg-white text-blue-900 font-medium border-2 border-blue-900 px-8 py-4 rounded-lg text-center hover:bg-blue-50 transition duration-300">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    {{-- <div class="relative z-10">
                        <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Workers" class="rounded-xl shadow-2xl floating">
                    </div> --}}
                    {{-- <div class="absolute top-1/2 right-0 transform translate-x-1/4 -translate-y-1/2 z-0">
                        <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Service Worker" class="rounded-full border-4 border-white shadow-xl">
                    </div>
                    <div class="absolute bottom-0 left-0 transform -translate-x-1/4 translate-y-1/4 z-20">
                        <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Delivery" class="rounded-full border-4 border-white shadow-xl">
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-handshake text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900">35+</h3>
                    <p class="text-gray-600 mt-2">Active Clients</p>
                </div>
                
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-chart-line text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900">1+</h3>
                    <p class="text-gray-600 mt-2">Years of Experience</p>
                </div>
                
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900">11</h3>
                    <p class="text-gray-600 mt-2">IT Recruiters</p>
                </div>
                
                <div class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-tasks text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900">112</h3>
                    <p class="text-gray-600 mt-2">Resources Deployed</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Services Section -->
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">Layanan Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Temukan berbagai jasa profesional dan tukang terlatih untuk membantu kebutuhan harian Anda</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="h-48 bg-blue-100 flex justify-center items-center">
                        <img src="/api/placeholder/300/200" alt="Home Service" class="h-32 w-auto">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Jasa Rumah Tangga</h3>
                        <p class="text-gray-600 mb-4">Layanan pembersihan, perbaikan, dan perawatan untuk rumah Anda</p>
                        <a href="#" class="text-yellow-500 font-medium hover:text-yellow-600 flex items-center">
                            Lihat Detail
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="h-48 bg-blue-100 flex justify-center items-center">
                        <img src="/api/placeholder/300/200" alt="Automotive Service" class="h-32 w-auto">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Jasa Otomotif</h3>
                        <p class="text-gray-600 mb-4">Perbaikan, perawatan, dan layanan untuk kendaraan Anda</p>
                        <a href="#" class="text-yellow-500 font-medium hover:text-yellow-600 flex items-center">
                            Lihat Detail
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                    <div class="h-48 bg-blue-100 flex justify-center items-center">
                        <img src="/api/placeholder/300/200" alt="Delivery Service" class="h-32 w-auto">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Jasa Pengiriman</h3>
                        <p class="text-gray-600 mb-4">Pengiriman barang cepat dan aman ke berbagai tujuan</p>
                        <a href="#" class="text-yellow-500 font-medium hover:text-yellow-600 flex items-center">
                            Lihat Detail
                            <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-blue-900 text-white font-bold px-8 py-4 rounded-lg shadow-md hover:bg-blue-800 transition duration-300 transform hover:-translate-y-1">
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>
    
    <!-- How It Works -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">Cara Kerja</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Mudah dan cepat untuk mendapatkan layanan yang Anda butuhkan</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 text-2xl font-bold mb-6">1</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Pilih Layanan</h3>
                    <p class="text-gray-600">Pilih layanan yang Anda butuhkan dari berbagai kategori yang tersedia</p>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 text-2xl font-bold mb-6">2</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Temukan Mitra</h3>
                    <p class="text-gray-600">Kami akan mencarikan mitra terdekat yang sesuai dengan kebutuhan Anda</p>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 text-2xl font-bold mb-6">3</div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Dapatkan Layanan</h3>
                    <p class="text-gray-600">Mitra akan datang ke lokasi Anda dan menyelesaikan pekerjaan dengan profesional</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="py-20 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">Apa Kata Mereka</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Lihat pengalaman pengguna yang telah menggunakan layanan Yuk Kerja</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <img src="/api/placeholder/64/64" alt="Customer" class="h-12 w-12 rounded-full">
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
                    <p class="text-gray-600 italic">"Sangat puas dengan layanan yang diberikan. Tukang datang tepat waktu dan menyelesaikan pekerjaan dengan baik."</p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <img src="/api/placeholder/64/64" alt="Customer" class="h-12 w-12 rounded-full">
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
                    <p class="text-gray-600 italic">"Aplikasi yang sangat membantu. Saya bisa menemukan tukang AC dengan cepat saat unit AC di rumah rusak mendadak."</p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <div class="mr-4">
                            <img src="/api/placeholder/64/64" alt="Customer" class="h-12 w-12 rounded-full">
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
                    <p class="text-gray-600 italic">"Sebagai pemilik usaha kecil, Yuk Kerja membantu saya menemukan pekerja lepas dengan kualifikasi yang tepat. Sangat direkomendasikan!"</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-20 bg-blue-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap Bergabung dengan Yuk Kerja?</h2>
                    <p class="text-blue-100 text-xl mb-6">Daftarkan diri Anda sekarang dan jadi bagian dari revolusi pekerjaan informal di Indonesia</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                            Daftar Sebagai Pengguna
                        </a>
                        <a href="#" class="bg-transparent text-white font-medium border-2 border-white px-8 py-4 rounded-lg text-center hover:bg-white hover:text-blue-900 transition duration-300">
                            Daftar Sebagai Mitra
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="/api/placeholder/400/300" alt="Yuk Kerja App" class="rounded-xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="bg-blue-900 text-white pt-16 pb-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center mb-6">
                        <img class="h-10 w-auto" src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Yuk Kerja Logo">
                        <span class="ml-2 text-xl font-bold">Yuk Kerja</span>
                    </div>
                    <p class="text-blue-200 mb-6">Solusi digital untuk kebutuhan tenaga kerja informal dan UMKM di Indonesia</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">About Us</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Services</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Blog</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Services</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Jasa Rumah Tangga</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Jasa Otomotif</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Jasa Pengiriman</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Jasa Teknisi</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white transition duration-300">Jasa Lainnya</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-6">Contact</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-yellow-500"></i>
                            <span class="text-blue-200">Kantor Pak Fachrul Kaprodi TI</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3 text-yellow-500"></i>
                            <span class="text-blue-200">+62 21 1234 5678</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-yellow-500"></i>
                            <span class="text-blue-200">info@yukkerja.id</span>
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
    <div class="fixed bottom-8 right-8">
        <button class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold w-16 h-16 rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
            <i class="fas fa-comments text-2xl"></i>
        </button>
    </div>
    
    <!-- Mobile Navigation Menu (Hidden by default) -->
    <div class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="bg-white h-full w-64 pt-16 px-4">
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Home</a>
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">About</a>
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Daftar</a>
            <a href="#" class="block py-3 text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Masuk</a>
            <a href="#" class="block py-3 bg-yellow-500 text-blue-900 font-bold px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300 mt-4">Daftar Mitra</a>
        </div>
    </div>
    
    <script>
        // You can add JavaScript functionality here if needed
        // For a Blade template, you might want to move this to a separate JS file
        
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle functionality
            const mobileMenuButton = document.querySelector('button[type="button"]');
            const mobileMenu = document.querySelector('.fixed.inset-0.bg-black');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
                
                // Close menu when clicking outside
                mobileMenu.addEventListener('click', function(e) {
                    if (e.target === mobileMenu) {
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
            
            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Add scroll animations for elements
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate-on-scroll');
                
                elements.forEach(element => {
                    const elementPosition = element.getBoundingClientRect().top;
                    const windowHeight = window.innerHeight;
                    
                    if (elementPosition < windowHeight - 100) {
                        element.classList.add('animated');
                    }
                });
            };
            
            // Initial check and add event listener
            animateOnScroll();
            window.addEventListener('scroll', animateOnScroll);
            
            // Form validation functions can be added here
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('border-red-500');
                        } else {
                            field.classList.remove('border-red-500');
                        }
                    });
                    
                    if (!isValid) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>