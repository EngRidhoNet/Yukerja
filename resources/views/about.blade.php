<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Kerja - Tentang Kami</title>
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
    @include('layouts.front.navbar')

    <!-- Page Header -->
    <header class="hero-gradient pt-32 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-blue-900 mb-6">Tentang Yuk Kerja</h1>
                <p class="text-lg md:text-xl text-gray-700 mb-6">Menghubungkan kebutuhan dan peluang kerja informal dengan teknologi yang inklusif</p>
                <div class="flex justify-center">
                    <div class="h-1 w-24 bg-yellow-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </header>

    <!-- Our Story Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-12">
                    <h2 class="text-3xl font-bold text-blue-900 mb-6">Cerita Kami</h2>
                    <p class="text-gray-700 mb-6">Yuk Kerja lahir dari kesadaran akan pentingnya memberdayakan tenaga kerja informal dan pelaku UMKM di Indonesia. Berdiri pada tahun 2025, kami memulai perjalanan untuk menciptakan platform digital yang menghubungkan masyarakat dengan jasa dan layanan yang mereka butuhkan sehari-hari.</p>
                    <p class="text-gray-700 mb-6">Dengan fokus pada inklusivitas dan kemudahan akses, Yuk Kerja hadir sebagai jembatan antara pencari jasa dan penyedia layanan yang memungkinkan transaksi yang adil, transparan, dan menguntungkan bagi kedua belah pihak.</p>
                    <p class="text-gray-700">Perjalanan kami baru dimulai, namun kami berkomitmen untuk terus berinovasi dan mengembangkan platform yang mampu memberikan dampak positif bagi ekonomi lokal dan kesejahteraan masyarakat Indonesia.</p>
                </div>
                <div class="md:w-1/2">
                    <div class="relative">
                        <div class="bg-blue-100 absolute inset-0 rounded-3xl transform rotate-3"></div>
                        <img src="/api/placeholder/600/400" alt="Team Meeting" class="relative z-10 rounded-3xl shadow-xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-blue-900 mb-4">Misi & Visi</h2>
                    <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Mission -->
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 mb-4">
                                <i class="fas fa-bullseye text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-900">Misi Kami</h3>
                        </div>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <span>Menyediakan platform digital yang menghubungkan pencari dan penyedia jasa informal</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <span>Memberdayakan tenaga kerja informal dengan akses ke pekerjaan yang adil dan berkelanjutan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <span>Meningkatkan kualitas dan standar layanan sektor informal melalui pelatihan dan sertifikasi</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <span>Membantu UMKM bertumbuh dengan akses ke sumber daya manusia yang terampil</span>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Vision -->
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                        <div class="text-center mb-6">
                            <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 mb-4">
                                <i class="fas fa-eye text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-900">Visi Kami</h3>
                        </div>
                        <p class="text-gray-700 mb-6">Menjadi platform terdepan yang mentransformasi sektor kerja informal di Indonesia melalui teknologi yang inklusif dan terintegrasi.</p>
                        <p class="text-gray-700 mb-6">Kami membayangkan masa depan di mana setiap tenaga kerja informal memiliki akses ke peluang ekonomi yang adil, berkelanjutan, dan memberikan penghidupan yang layak.</p>
                        <p class="text-gray-700">Dengan teknologi yang kami kembangkan, kami berharap dapat berkontribusi pada pembangunan ekonomi yang lebih merata dan inklusif di seluruh Indonesia.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-blue-900 mb-4">Nilai-Nilai Kami</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Prinsip yang memandu setiap langkah dan keputusan kami dalam mengembangkan Yuk Kerja</p>
                <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto mt-6"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="text-center p-6 bg-blue-50 rounded-xl hover:shadow-md transition duration-300">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                        <i class="fas fa-handshake text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Inklusivitas</h3>
                    <p class="text-gray-700">Kami percaya bahwa setiap orang berhak mendapatkan akses ke peluang ekonomi tanpa memandang latar belakang.</p>
                </div>
                
                <!-- Value 2 -->
                <div class="text-center p-6 bg-blue-50 rounded-xl hover:shadow-md transition duration-300">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Kepercayaan</h3>
                    <p class="text-gray-700">Kami membangun platform berdasarkan kepercayaan dan transparansi antara semua pihak yang terlibat.</p>
                </div>
                
                <!-- Value 3 -->
                <div class="text-center p-6 bg-blue-50 rounded-xl hover:shadow-md transition duration-300">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                        <i class="fas fa-lightbulb text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Inovasi</h3>
                    <p class="text-gray-700">Kami terus berinovasi untuk menciptakan solusi teknologi yang sesuai dengan kebutuhan lokal.</p>
                </div>
                
                <!-- Value 4 -->
                <div class="text-center p-6 bg-blue-50 rounded-xl hover:shadow-md transition duration-300">
                    <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                        <i class="fas fa-heart text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Keberlanjutan</h3>
                    <p class="text-gray-700">Kami berkomitmen untuk menciptakan dampak jangka panjang yang positif bagi masyarakat dan ekonomi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-blue-900 mb-4">Tim Kami</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Bertemu dengan orang-orang hebat di balik Yuk Kerja yang berdedikasi untuk membuat perubahan</p>
                <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto mt-6"></div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/api/placeholder/300/300" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-blue-900 mb-1">Ahmad Fadillah</h3>
                        <p class="text-yellow-500 font-medium mb-4">CEO & Co-Founder</p>
                        <p class="text-gray-600 mb-4">Memiliki pengalaman 10+ tahun di bidang teknologi dan startup</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/api/placeholder/300/300" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-blue-900 mb-1">Dewi Anggraini</h3>
                        <p class="text-yellow-500 font-medium mb-4">CTO & Co-Founder</p>
                        <p class="text-gray-600 mb-4">Ahli teknologi dengan fokus pada pengembangan platform berbasis mobile</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/api/placeholder/300/300" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-blue-900 mb-1">Budi Santoso</h3>
                        <p class="text-yellow-500 font-medium mb-4">COO</p>
                        <p class="text-gray-600 mb-4">Pakar operasional dengan pengalaman di perusahaan multinasional</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="h-64 overflow-hidden">
                        <img src="/api/placeholder/300/300" alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-blue-900 mb-1">Siti Rahayu</h3>
                        <p class="text-yellow-500 font-medium mb-4">Head of Marketing</p>
                        <p class="text-gray-600 mb-4">Spesialis marketing digital dengan fokus pada pertumbuhan berbasis komunitas</p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-blue-900 hover:text-yellow-500 transition duration-300">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Achievements -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-blue-900 mb-4">Pencapaian Kami</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Perjalanan kami dalam memberdayakan tenaga kerja informal Indonesia</p>
                <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto mt-6"></div>
            </div>
            
            <div class="relative">
                <!-- Timeline -->
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-blue-200"></div>
                
                <!-- Milestone 1 -->
                <div class="relative mb-16">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-8 md:mb-0 md:pr-12 md:text-right">
                            <h3 class="text-2xl font-bold text-blue-900 mb-2">Diinisiasi</h3>
                            <p class="text-yellow-500 font-medium mb-4">Januari 2023</p>
                            <p class="text-gray-700">Ide Yuk Kerja lahir sebagai solusi untuk menghubungkan tenaga kerja informal dengan peluang pekerjaan</p>
                        </div>
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-yellow-500 border-4 border-white z-10 flex items-center justify-center">
                            <i class="fas fa-flag text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12">
                            <div class="bg-blue-50 p-6 rounded-xl shadow-md">
                                <img src="/api/placeholder/400/200" alt="Milestone" class="w-full rounded-lg mb-4">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Milestone 2 -->
                <div class="relative mb-16">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-8 md:mb-0 md:pr-12 order-1 md:order-2 md:text-left">
                            <h3 class="text-2xl font-bold text-blue-900 mb-2">Beta Launch</h3>
                            <p class="text-yellow-500 font-medium mb-4">Juli 2023</p>
                            <p class="text-gray-700">Peluncuran versi beta platform Yuk Kerja dengan fokus di Jakarta dan sekitarnya</p>
                        </div>
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-yellow-500 border-4 border-white z-10 flex items-center justify-center">
                            <i class="fas fa-rocket text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12 order-2 md:order-1">
                            <div class="bg-blue-50 p-6 rounded-xl shadow-md">
                                <img src="/api/placeholder/400/200" alt="Milestone" class="w-full rounded-lg mb-4">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Milestone 3 -->
                <div class="relative mb-16">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-8 md:mb-0 md:pr-12 md:text-right">
                            <h3 class="text-2xl font-bold text-blue-900 mb-2">Pendanaan Seed</h3>
                            <p class="text-yellow-500 font-medium mb-4">Desember 2023</p>
                            <p class="text-gray-700">Mendapatkan pendanaan seed round untuk memperluas jangkauan dan meningkatkan fitur platform</p>
                        </div>
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-yellow-500 border-4 border-white z-10 flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12">
                            <div class="bg-blue-50 p-6 rounded-xl shadow-md">
                                <img src="/api/placeholder/400/200" alt="Milestone" class="w-full rounded-lg mb-4">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Milestone 4 -->
                <div class="relative">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-8 md:mb-0 md:pr-12 order-1 md:order-2 md:text-left">
                            <h3 class="text-2xl font-bold text-blue-900 mb-2">Ekspansi Nasional</h3>
                            <p class="text-yellow-500 font-medium mb-4">April 2024</p>
                            <p class="text-gray-700">Ekspansi ke 5 kota besar di Indonesia dan mencapai 1000+ mitra terdaftar</p>
                        </div>
                        <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-12 h-12 rounded-full bg-yellow-500 border-4 border-white z-10 flex items-center justify-center">
                            <i class="fas fa-globe-asia text-white"></i>
                        </div>
                        <div class="md:w-1/2 md:pl-12 order-2 md:order-1">
                            <div class="bg-blue-50 p-6 rounded-xl shadow-md">
                                <img src="/api/placeholder/400/200" alt="Milestone" class="w-full rounded-lg mb-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Partners -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-blue-900 mb-4">Mitra & Kolaborator</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Bergabung dengan berbagai organisasi untuk menciptakan ekosistem yang mendukung</p>
                <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto mt-6"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 flex items-center justify-center">
                    <img src="/api/placeholder/150/80" alt="Partner Logo" class="max-h-16">
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-blue-900 rounded-3xl overflow-hidden shadow-2xl">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-3/5 p-8 md:p-12">
                        <h2 class="text-3xl font-bold text-white mb-6">Jadilah Bagian dari Perubahan</h2>
                        <p class="text-blue-100 mb-8">Bergabunglah dengan Yuk Kerja sebagai mitra atau pengguna dan jadilah bagian dari transformasi ekonomi digital yang inklusif di Indonesia.</p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <a href="#" class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 text-center">Daftar Sekarang</a>
                            <a href="#" class="bg-transparent border-2 border-white text-white font-bold px-8 py-4 rounded-lg hover:bg-white hover:text-blue-900 transition duration-300 text-center">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                    <div class="md:w-2/5 bg-blue-800 flex items-center justify-center p-8">
                        <img src="/api/placeholder/300/300" alt="Join Us" class="w-full max-w-xs floating">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-blue-900 mb-4">Apa Kata Mereka</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Pengalaman dari mitra dan pengguna yang telah bergabung dengan Yuk Kerja</p>
                <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto mt-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 relative">
                    <div class="absolute top-0 right-0 transform translate-x-4 -translate-y-4 text-yellow-500 text-6xl opacity-20">"</div>
                    <div class="flex items-center mb-6">
                        <img src="/api/placeholder/60/60" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h3 class="text-lg font-bold text-blue-900">Rudi Hartono</h3>
                            <p class="text-gray-600">Tukang Bangunan</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">Sebelum bergabung dengan Yuk Kerja, saya sering kesulitan mendapatkan pelanggan. Sekarang, saya bisa mendapatkan pekerjaan secara reguler dan pendapatan saya meningkat hampir dua kali lipat.</p>
                    <div class="flex text-yellow-500">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 relative">
                    <div class="absolute top-0 right-0 transform translate-x-4 -translate-y-4 text-yellow-500 text-6xl opacity-20">"</div>
                    <div class="flex items-center mb-6">
                        <img src="/api/placeholder/60/60" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h3 class="text-lg font-bold text-blue-900">Maya Pratiwi</h3>
                            <p class="text-gray-600">Pemilik Warung Makan</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">Aplikasi Yuk Kerja sangat membantu bisnis saya. Saya bisa menemukan karyawan paruh waktu dengan cepat saat saya membutuhkannya, terutama di saat-saat puncak pesanan.</p>
                    <div class="flex text-yellow-500">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 relative">
                    <div class="absolute top-0 right-0 transform translate-x-4 -translate-y-4 text-yellow-500 text-6xl opacity-20">"</div>
                    <div class="flex items-center mb-6">
                        <img src="/api/placeholder/60/60" alt="Testimonial" class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h3 class="text-lg font-bold text-blue-900">Andi Wijaya</h3>
                            <p class="text-gray-600">Pengguna</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">Saya sangat puas dengan pelayanan di Yuk Kerja. Prosesnya mudah dan cepat untuk menemukan jasa yang dibutuhkan, dan kualitas layanan yang diberikan juga sangat baik.</p>
                    <div class="flex text-yellow-500">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Press Mentions -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-blue-900 mb-4">Liputan Media</h2>
                <p class="text-lg text-gray-700 max-w-3xl mx-auto">Yuk Kerja di mata media</p>
                <div class="h-1 w-24 bg-yellow-500 rounded-full mx-auto mt-6"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Press 1 -->
                <a href="#" class="bg-blue-50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <img src="/api/placeholder/400/200" alt="Press Coverage" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Yuk Kerja: Menjembatani Kesenjangan Digital di Sektor Informal</h3>
                        <p class="text-gray-500 mb-4">TechDaily Indonesia</p>
                        <p class="text-gray-700">Platform digital Yuk Kerja muncul sebagai solusi inovatif untuk memberdayakan tenaga kerja informal di Indonesia.</p>
                    </div>
                </a>
                
                <!-- Press 2 -->
                <a href="#" class="bg-blue-50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <img src="/api/placeholder/400/200" alt="Press Coverage" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Startup Yuk Kerja Raih Pendanaan Seed Round</h3>
                        <p class="text-gray-500 mb-4">Bisnis Indonesia</p>
                        <p class="text-gray-700">Yuk Kerja berhasil mendapatkan pendanaan untuk memperluas jangkauan layanan ke berbagai kota di Indonesia.</p>
                    </div>
                </a>
                
                <!-- Press 3 -->
                <a href="#" class="bg-blue-50 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                    <img src="/api/placeholder/400/200" alt="Press Coverage" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-blue-900 mb-2">Transformasi Digital di Sektor Informal Indonesia</h3>
                        <p class="text-gray-500 mb-4">Ekonomi Outlook</p>
                        <p class="text-gray-700">Bagaimana Yuk Kerja mengubah lanskap ekonomi informal di Indonesia melalui inovasi teknologi.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Us -->
    <section class="py-16 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2 bg-blue-900 text-white p-8 md:p-12">
                        <h2 class="text-3xl font-bold mb-6">Hubungi Kami</h2>
                        <p class="text-blue-100 mb-8">Kami senang mendengar dari Anda! Jangan ragu untuk menghubungi kami jika memiliki pertanyaan, saran, atau ingin berkolaborasi.</p>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-500 flex items-center justify-center mr-4">
                                    <i class="fas fa-map-marker-alt text-blue-900"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold mb-1">Alamat</h3>
                                    <p class="text-blue-100">Jl. Sudirman No. 123, Jakarta Pusat, Indonesia</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-500 flex items-center justify-center mr-4">
                                    <i class="fas fa-envelope text-blue-900"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold mb-1">Email</h3>
                                    <p class="text-blue-100">info@yukkerja.id</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-yellow-500 flex items-center justify-center mr-4">
                                    <i class="fas fa-phone text-blue-900"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold mb-1">Telepon</h3>
                                    <p class="text-blue-100">+62 21 9876 5432</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-12">
                            <h3 class="text-lg font-bold mb-4">Ikuti Kami</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="h-10 w-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                                    <i class="fab fa-facebook-f text-white"></i>
                                </a>
                                <a href="#" class="h-10 w-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                                    <i class="fab fa-twitter text-white"></i>
                                </a>
                                <a href="#" class="h-10 w-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                                    <i class="fab fa-instagram text-white"></i>
                                </a>
                                <a href="#" class="h-10 w-10 rounded-full bg-blue-800 flex items-center justify-center hover:bg-yellow-500 transition duration-300">
                                    <i class="fab fa-linkedin-in text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 p-8 md:p-12">
                        <form>
                            <div class="mb-6">
                                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                <input type="text" id="name" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="mb-6">
                                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                                <input type="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="mb-6">
                                <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                                <input type="text" id="subject" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div class="mb-6">
                                <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                                <textarea id="message" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div>
                    <img class="h-10 mb-6" src="/api/placeholder/120/40" alt="Yuk Kerja Logo">
                    <p class="text-blue-100 mb-6">Menghubungkan kebutuhan dan peluang kerja informal dengan teknologi yang inklusif untuk menciptakan ekonomi yang lebih adil dan berkelanjutan.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Beranda</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Layanan</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Karir</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Kontak</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Blog</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Layanan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Jasa Pembersihan</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Jasa Perbaikan</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Jasa Pengiriman</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Jasa Konstruksi</a></li>
                        <li><a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Tenaga Paruh Waktu</a></li>
                    </ul>
                </div>
                
                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-bold mb-6">Berlangganan</h3>
                    <p class="text-blue-100 mb-6">Dapatkan informasi terbaru dan penawaran spesial dari Yuk Kerja</p>
                    <form>
                        <div class="flex">
                            <input type="email" placeholder="Email Anda" class="bg-blue-800 text-white rounded-l-lg px-4 py-3 w-full focus:outline-none focus:ring-2 focus:ring-yellow-500 border-none">
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold px-4 py-3 rounded-r-lg transition duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-blue-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-blue-100 mb-4 md:mb-0">© 2023-2024 Yuk Kerja. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Kebijakan Privasi</a>
                    <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">Syarat & Ketentuan</a>
                    <a href="#" class="text-blue-100 hover:text-yellow-500 transition duration-300">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu (Hidden by default) -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" id="mobile-menu-overlay">
        <div class="bg-white h-full w-4/5 max-w-sm p-6 overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <img class="h-8" src="/api/placeholder/120/48" alt="Yuk Kerja Logo">
                <button id="close-mobile-menu" class="text-gray-500 hover:text-blue-900">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <nav>
                <ul class="space-y-4">
                    <li><a href="#" class="text-gray-700 hover:text-yellow-500 block py-2 text-lg">Home</a></li>
                    <li><a href="#" class="text-yellow-500 font-medium block py-2 text-lg">About</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-yellow-500 block py-2 text-lg">Daftar</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-yellow-500 block py-2 text-lg">Masuk</a></li>
                    <li class="pt-4">
                        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 block text-center">Daftar Mitra</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-yellow-500 text-blue-900 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-yellow-600 transition duration-300 transform hover:-translate-y-1 z-20 hidden">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Simple JavaScript for Mobile Menu and Back to Top Button -->
    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.querySelector('button[type="button"]');
            const closeMobileMenuBtn = document.getElementById('close-mobile-menu');
            const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
            
            if (mobileMenuBtn && closeMobileMenuBtn && mobileMenuOverlay) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenuOverlay.classList.remove('hidden');
                });
                
                closeMobileMenuBtn.addEventListener('click', function() {
                    mobileMenuOverlay.classList.add('hidden');
                });
            }
            
            // Back to Top Button
            const backToTopBtn = document.getElementById('back-to-top');
            
            if (backToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTopBtn.classList.remove('hidden');
                    } else {
                        backToTopBtn.classList.add('hidden');
                    }
                });
                
                backToTopBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
</body>
</html>