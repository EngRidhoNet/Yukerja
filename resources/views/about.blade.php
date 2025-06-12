<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Kerja - Tentang Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }
        
        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-delay {
            animation: float 6s ease-in-out infinite;
            animation-delay: -3s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }
        
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .timeline-line {
            background: linear-gradient(to bottom, #667eea, #764ba2);
        }
        
        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }
        
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(102, 126, 234, 0.4);
            }
            50% {
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.8);
            }
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .card-hover {
            transition: all 0.4s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.3);
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease-out;
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease-out;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .scroll-smooth {
            scroll-behavior: smooth;
        }
        
        .gradient-border {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 2px;
            border-radius: 16px;
        }
        
        .gradient-border-inner {
            background: white;
            border-radius: 14px;
        }
    </style>
</head>
<body class="font-sans antialiased scroll-smooth">
    
    <!-- Enhanced Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="h-10 w-10 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-briefcase text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold gradient-text">Yuk Kerja</span>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Beranda</a>
                    <a href="#" class="text-purple-600 font-semibold">Tentang</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Layanan</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition duration-300">Kontak</a>
                    <button class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition duration-300 transform hover:scale-105">
                        Daftar Mitra
                    </button>
                </div>
                
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-gray-700 hover:text-purple-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient min-h-screen flex items-center justify-center relative">
        <div class="absolute inset-0 bg-black/20"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full floating"></div>
        <div class="absolute top-40 right-20 w-32 h-32 bg-white/5 rounded-full floating-delay"></div>
        <div class="absolute bottom-20 left-20 w-16 h-16 bg-white/10 rounded-full floating"></div>
        
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <span class="inline-block px-4 py-2 bg-white/20 text-white rounded-full text-sm font-medium mb-6 glassmorphism">
                    🚀 Menghubungkan Indonesia Melalui Teknologi
                </span>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 leading-tight">
                Tentang
                <span class="block bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                    Yuk Kerja
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-4xl mx-auto leading-relaxed">
                Platform inovatif yang mentransformasi ekosistem kerja informal Indonesia melalui teknologi yang inklusif dan berkelanjutan
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <button class="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-xl">
                    <i class="fas fa-play-circle mr-2"></i>
                    Tonton Cerita Kami
                </button>
                <button class="glassmorphism text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-arrow-down mr-2"></i>
                    Jelajahi Lebih Lanjut
                </button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black gradient-text mb-2">10K+</div>
                    <div class="text-gray-600 font-medium">Mitra Terdaftar</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black gradient-text mb-2">50K+</div>
                    <div class="text-gray-600 font-medium">Pekerjaan Selesai</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black gradient-text mb-2">25+</div>
                    <div class="text-gray-600 font-medium">Kota Dilayani</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-black gradient-text mb-2">4.8</div>
                    <div class="text-gray-600 font-medium">Rating Pengguna</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="slide-in-left">
                    <div class="inline-block px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-6">
                        💡 Cerita Kami
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-8 leading-tight">
                        Dari Mimpi Menjadi
                        <span class="gradient-text">Kenyataan</span>
                    </h2>
                    
                    <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                        <p>
                            Yuk Kerja lahir dari kepedulian mendalam terhadap jutaan pekerja informal Indonesia yang masih kesulitan mengakses peluang ekonomi digital. Kami percaya bahwa teknologi harus menjadi jembatan, bukan jurang pemisah.
                        </p>
                        <p>
                            Sejak 2023, kami telah berkomitmen membangun ekosistem yang tidak hanya menghubungkan, tetapi juga memberdayakan. Setiap fitur yang kami kembangkan dirancang dengan hati, mengutamakan kemudahan dan keadilan bagi semua pihak.
                        </p>
                        <p>
                            Perjalanan ini baru dimulai, namun dampaknya telah dirasakan ribuan keluarga Indonesia. Kami terus berinovasi untuk menciptakan masa depan yang lebih inklusif dan berkelanjutan.
                        </p>
                    </div>
                    
                    <div class="mt-8 flex flex-wrap gap-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700 font-medium">Teknologi Inklusif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700 font-medium">Dampak Berkelanjutan</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700 font-medium">Komunitas Solid</span>
                        </div>
                    </div>
                </div>
                
                <div class="slide-in-right">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-blue-600 rounded-3xl transform rotate-6 opacity-20"></div>
                        <div class="relative bg-white rounded-3xl p-8 shadow-2xl">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl">
                                    <i class="fas fa-users text-4xl gradient-text mb-4"></i>
                                    <div class="text-2xl font-bold text-gray-900">Komunitas</div>
                                    <div class="text-gray-600">Terpercaya</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl">
                                    <i class="fas fa-shield-alt text-4xl gradient-text mb-4"></i>
                                    <div class="text-2xl font-bold text-gray-900">Keamanan</div>
                                    <div class="text-gray-600">Terjamin</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl">
                                    <i class="fas fa-rocket text-4xl gradient-text mb-4"></i>
                                    <div class="text-2xl font-bold text-gray-900">Inovasi</div>
                                    <div class="text-gray-600">Berkelanjutan</div>
                                </div>
                                <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl">
                                    <i class="fas fa-heart text-4xl gradient-text mb-4"></i>
                                    <div class="text-2xl font-bold text-gray-900">Dampak</div>
                                    <div class="text-gray-600">Positif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-block px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-6">
                    🎯 Misi & Visi
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Mengapa Kami
                    <span class="gradient-text">Ada</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Komitmen kami untuk mentransformasi ekosistem kerja informal Indonesia
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Mission -->
                <div class="gradient-border hover-lift">
                    <div class="gradient-border-inner p-8 h-full">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 pulse-glow">
                                <i class="fas fa-bullseye text-3xl text-white"></i>
                            </div>
                            <h3 class="text-3xl font-bold gradient-text">Misi Kami</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    Menciptakan platform digital yang menghubungkan pencari dan penyedia jasa informal dengan teknologi yang mudah diakses
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    Memberdayakan tenaga kerja informal dengan akses ke peluang ekonomi yang adil dan berkelanjutan
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    Meningkatkan kualitas layanan melalui program pelatihan dan sertifikasi yang komprehensif
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <p class="text-gray-700 leading-relaxed">
                                    Mendukung pertumbuhan UMKM dengan akses ke sumber daya manusia yang terampil dan terpercaya
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vision -->
                <div class="gradient-border hover-lift">
                    <div class="gradient-border-inner p-8 h-full">
                        <div class="text-center mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 pulse-glow">
                                <i class="fas fa-eye text-3xl text-white"></i>
                            </div>
                            <h3 class="text-3xl font-bold gradient-text">Visi Kami</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Menjadi platform terdepan yang mentransformasi sektor kerja informal di Indonesia melalui teknologi yang inklusif dan terintegrasi.
                            </p>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Kami membayangkan masa depan di mana setiap tenaga kerja informal memiliki akses ke peluang ekonomi yang adil, berkelanjutan, dan memberikan penghidupan yang layak.
                            </p>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Dengan teknologi yang kami kembangkan, kami berharap dapat berkontribusi pada pembangunan ekonomi yang lebih merata dan inklusif di seluruh Indonesia.
                            </p>
                            
                            <div class="mt-8 p-6 bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl">
                                <h4 class="font-bold text-gray-900 mb-3">Target 2030</h4>
                                <div class="grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <div class="text-2xl font-bold gradient-text">1M+</div>
                                        <div class="text-sm text-gray-600">Mitra Aktif</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold gradient-text">100+</div>
                                        <div class="text-sm text-gray-600">Kota Terjangkau</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-block px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-6">
                    ⭐ Nilai-Nilai Kami
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Prinsip Yang
                    <span class="gradient-text">Memandu</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Nilai-nilai fundamental yang menjadi landasan setiap keputusan dan tindakan kami
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="card-hover bg-gradient-to-br from-purple-50 to-blue-50 p-8 rounded-3xl text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-handshake text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold gradient-text mb-4">Inklusivitas</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Kami percaya setiap orang berhak mendapatkan akses ke peluang ekonomi tanpa memandang latar belakang.
                    </p>
                </div>
                
                <!-- Value 2 -->
                <div class="card-hover bg-gradient-to-br from-purple-50 to-blue-50 p-8 rounded-3xl text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold gradient-text mb-4">Kepercayaan</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Kami membangun platform berdasarkan kepercayaan dan transparansi antara semua pihak yang terlibat.
                    </p>
                </div>
                
                <!-- Value 3 -->
                <div class="card-hover bg-gradient-to-br from-purple-50 to-blue-50 p-8 rounded-3xl text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lightbulb text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold gradient-text mb-4">Inovasi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Kami terus berinovasi untuk menciptakan solusi teknologi yang sesuai dengan kebutuhan lokal.
                    </p>
                </div>
                
                <!-- Value 4 -->
                <div class="card-hover bg-gradient-to-br from-purple-50 to-blue-50 p-8 rounded-3xl text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold gradient-text mb-4">Keberlanjutan</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Kami berkomitmen menciptakan dampak jangka panjang yang positif bagi masyarakat dan ekonomi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-24 bg-gradient-to-br from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-block px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-6">
                    👥 Tim Kami
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Orang-Orang
                    <span class="gradient-text">Hebat</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Bertemu dengan tim visioner yang berdedikasi untuk menciptakan perubahan nyata
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-purple-400 to-blue-500 flex items-center justify-center">
                        <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-5xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Ahmad Fadillah</h3>
                        <p class="text-purple-600 font-semibold mb-4">CEO & Co-Founder</p>
                        <p class="text-gray-600 mb-6 text-sm">Visioner teknologi dengan 10+ tahun pengalaman<div class="flex justify-center space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-linkedin-in text-gray-600 hover:text-purple-600"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-twitter text-gray-600 hover:text-purple-600"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-pink-400 to-purple-500 flex items-center justify-center">
                        <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-5xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Sari Indrawati</h3>
                        <p class="text-purple-600 font-semibold mb-4">CTO & Co-Founder</p>
                        <p class="text-gray-600 mb-6 text-sm">Expert dalam pengembangan platform digital</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-linkedin-in text-gray-600 hover:text-purple-600"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-github text-gray-600 hover:text-purple-600"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                        <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-5xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Budi Santoso</h3>
                        <p class="text-purple-600 font-semibold mb-4">Head of Operations</p>
                        <p class="text-gray-600 mb-6 text-sm">Spesialis dalam operasional dan pertumbuhan bisnis</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-linkedin-in text-gray-600 hover:text-purple-600"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-instagram text-gray-600 hover:text-purple-600"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="h-64 bg-gradient-to-br from-orange-400 to-red-500 flex items-center justify-center">
                        <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-5xl text-white"></i>
                        </div>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Maya Kartika</h3>
                        <p class="text-purple-600 font-semibold mb-4">Head of Marketing</p>
                        <p class="text-gray-600 mb-6 text-sm">Ahli strategi pemasaran dan komunikasi digital</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-linkedin-in text-gray-600 hover:text-purple-600"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-purple-100 transition duration-300">
                                <i class="fab fa-instagram text-gray-600 hover:text-purple-600"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Timeline Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <div class="inline-block px-4 py-2 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-6">
                    📈 Perjalanan Kami
                </div>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                    Milestone
                    <span class="gradient-text">Penting</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Setiap langkah adalah bukti komitmen kami untuk terus berkembang dan memberikan dampak positif
                </p>
            </div>
            
            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full timeline-line"></div>
                
                <!-- Timeline Items -->
                <div class="space-y-16">
                    <!-- 2023 -->
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8 text-right">
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-8 rounded-3xl shadow-lg hover-lift">
                                <div class="text-2xl font-bold gradient-text mb-2">2023</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Ide & Konsep</h3>
                                <p class="text-gray-700">Penelitian mendalam tentang tantangan sektor kerja informal di Indonesia dan pengembangan konsep platform yang inklusif.</p>
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-lightbulb text-white text-lg"></i>
                        </div>
                        <div class="flex-1 pl-8"></div>
                    </div>
                    
                    <!-- Early 2024 -->
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-code text-white text-lg"></i>
                        </div>
                        <div class="flex-1 pl-8">
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-8 rounded-3xl shadow-lg hover-lift">
                                <div class="text-2xl font-bold gradient-text mb-2">Awal 2024</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Pengembangan MVP</h3>
                                <p class="text-gray-700">Peluncuran versi beta dengan fitur dasar matching pencari dan penyedia jasa, serta sistem rating dan review.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mid 2024 -->
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8 text-right">
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-8 rounded-3xl shadow-lg hover-lift">
                                <div class="text-2xl font-bold gradient-text mb-2">Pertengahan 2024</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Peluncuran Official</h3>
                                <p class="text-gray-700">Launch resmi platform Yuk Kerja dengan 1000+ mitra pertama di 5 kota besar Indonesia.</p>
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-rocket text-white text-lg"></i>
                        </div>
                        <div class="flex-1 pl-8"></div>
                    </div>
                    
                    <!-- Late 2024 -->
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8"></div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-chart-line text-white text-lg"></i>
                        </div>
                        <div class="flex-1 pl-8">
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-8 rounded-3xl shadow-lg hover-lift">
                                <div class="text-2xl font-bold gradient-text mb-2">Akhir 2024</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Ekspansi Cepat</h3>
                                <p class="text-gray-700">Pertumbuhan eksponensial dengan 10K+ mitra terdaftar dan ekspansi ke 25+ kota di seluruh Indonesia.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 2025 -->
                    <div class="relative flex items-center">
                        <div class="flex-1 pr-8 text-right">
                            <div class="bg-gradient-to-r from-green-50 to-blue-50 p-8 rounded-3xl shadow-lg hover-lift border-2 border-green-200">
                                <div class="text-2xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent mb-2">2025</div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Inovasi Berkelanjutan</h3>
                                <p class="text-gray-700">Pengembangan fitur AI untuk matching yang lebih akurat dan program pelatihan digital untuk meningkatkan keterampilan mitra.</p>
                            </div>
                        </div>
                        <div class="absolute left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center pulse-glow">
                            <i class="fas fa-star text-white text-lg"></i>
                        </div>
                        <div class="flex-1 pl-8"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Call to Action -->
    <section class="py-24 hero-gradient relative">
        <div class="absolute inset-0 bg-black/30"></div>
        
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 w-24 h-24 bg-white/10 rounded-full floating"></div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-white/5 rounded-full floating-delay"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-black text-white mb-8">
                Bergabunglah Dengan
                <span class="block bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                    Revolusi Digital
                </span>
            </h2>
            
            <p class="text-xl text-white/90 mb-12 max-w-3xl mx-auto">
                Jadilah bagian dari ekosistem yang mentransformasi masa depan kerja informal Indonesia. Bersama kita ciptakan peluang yang lebih baik untuk semua.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <button class="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105 shadow-xl">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar Sebagai Mitra
                </button>
                <button class="glassmorphism text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white/20 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Kami
                </button>
            </div>
            
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="glassmorphism p-6 rounded-2xl">
                    <i class="fas fa-clock text-3xl text-white mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">24/7 Support</h3>
                    <p class="text-white/80">Bantuan tersedia kapan saja</p>
                </div>
                <div class="glassmorphism p-6 rounded-2xl">
                    <i class="fas fa-shield-alt text-3xl text-white mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">Keamanan Terjamin</h3>
                    <p class="text-white/80">Data dan transaksi aman</p>
                </div>
                <div class="glassmorphism p-6 rounded-2xl">
                    <i class="fas fa-graduation-cap text-3xl text-white mb-4"></i>
                    <h3 class="text-xl font-bold text-white mb-2">Pelatihan Gratis</h3>
                    <p class="text-white/80">Program pengembangan skill</p>
                </div>
            </div>
        </div>
    </section>
 
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="h-12 w-12 bg-gradient-to-br from-purple-600 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <i class="fas fa-briefcase text-white text-xl"></i>
                        </div>
                        <span class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">Yuk Kerja</span>
                    </div>
                    <p class="text-gray-300 mb-6 max-w-md leading-relaxed">
                        Platform terdepan yang menghubungkan pencari dan penyedia jasa informal dengan teknologi yang inklusif dan berkelanjutan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <i class="fab fa-facebook-f text-gray-300 hover:text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <i class="fab fa-twitter text-gray-300 hover:text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <i class="fab fa-instagram text-gray-300 hover:text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition duration-300">
                            <i class="fab fa-linkedin-in text-gray-300 hover:text-white"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Tautan Cepat</h3>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Beranda</a></li>
                        <li><a href="#" class="text-purple-400 font-semibold">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Layanan</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Karir</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition duration-300">Blog</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Kontak</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-purple-400 mt-1"></i>
                            <span class="text-gray-300">Jl. Teknologi No. 123<br>Jakarta Selatan, 12345</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-purple-400"></i>
                            <span class="text-gray-300">+62 21 1234 5678</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-purple-400"></i>
                            <span class="text-gray-300">info@yukkerja.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © 2025 Yuk Kerja. Seluruh hak cipta dilindungi.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Syarat & Ketentuan</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </footer>
 
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black/50" id="mobile-menu-overlay"></div>
        <div class="fixed top-0 right-0 w-64 h-full bg-white transform translate-x-full transition-transform duration-300" id="mobile-menu-panel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <span class="text-2xl font-bold gradient-text">Yuk Kerja</span>
                    <button id="mobile-menu-close" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav class="space-y-6">
                    <a href="#" class="block text-gray-700 hover:text-purple-600 font-medium transition duration-300">Beranda</a>
                    <a href="#" class="block text-purple-600 font-semibold">Tentang</a>
                    <a href="#" class="block text-gray-700 hover:text-purple-600 font-medium transition duration-300">Layanan</a>
                    <a href="#" class="block text-gray-700 hover:text-purple-600 font-medium transition duration-300">Kontak</a>
                    <button class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition duration-300">
                        Daftar Mitra
                    </button>
                </nav>
            </div>
        </div>
    </div>
 
    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuPanel = document.getElementById('mobile-menu-panel');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
 
        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileMenuPanel.classList.remove('translate-x-full');
            }, 10);
        }
 
        function closeMobileMenu() {
            mobileMenuPanel.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        }
 
        mobileMenuBtn.addEventListener('click', openMobileMenu);
        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
 
        // Smooth Scroll for Anchor Links
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
 
        // Navbar Background on Scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('bg-white/95');
                nav.classList.remove('bg-white/80');
            } else {
                nav.classList.remove('bg-white/95');
                nav.classList.add('bg-white/80');
            }
        });
 
        // Intersection Observer for Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
 
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);
 
        // Observe elements for animation
        document.querySelectorAll('.slide-in-left, .slide-in-right, .card-hover').forEach(el => {
            observer.observe(el);
        });
 
        // Add fade-in animation class
        const style = document.createElement('style');
        style.textContent = `
            .animate-fade-in {
                animation: fadeIn 0.8s ease-out forwards;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
 
        // Counter Animation
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current).toLocaleString() + (target >= 1000 ? 'K+' : target >= 100 ? '+' : '');
            }, 20);
        }
 
        // Trigger counter animation when stats section is visible
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.gradient-text');
                    counters[0] && animateCounter(counters[0], 10);
                    counters[1] && animateCounter(counters[1], 50);
                    counters[2] && animateCounter(counters[2], 25);
                    counters[3] && (counters[3].textContent = '4.8');
                    statsObserver.unobserve(entry.target);
                }
            });
        });
 
        const statsSection = document.querySelector('.bg-gradient-to-br.from-gray-50.to-blue-50');
        if (statsSection) {
            statsObserver.observe(statsSection);
        }
    </script>
 </body>
 </html>