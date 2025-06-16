<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Yuk Kerja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
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
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
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
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .chat-pulse {
            animation: chatPulse 2s infinite;
        }

        @keyframes chatPulse {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 215, 0, 0.7);
            }

            50% {
                box-shadow: 0 0 0 20px rgba(255, 215, 0, 0);
            }
        }

        .service-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .service-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        @media (prefers-reduced-motion: reduce) {

            .floating,
            .pulse,
            .fade-in,
            .hover-lift,
            .chat-pulse {
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
            <div class="text-center fade-in">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-blue-900 mb-6 text-shadow">
                    <span class="block">Tentang</span>
                    <span class="block mt-2 text-yellow-500 pulse">Yuk Kerja</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Kami adalah platform digital yang menghubungkan pekerja informal dengan pelanggan yang membutuhkan
                    jasa berkualitas di seluruh Indonesia.
                </p>
            </div>
        </div>
    </section>

    <!-- About Story Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-6 text-shadow">Cerita Kami</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Yuk Kerja lahir dari keprihatinan kami terhadap kesenjangan yang terjadi antara pekerja informal
                        dengan peluang pekerjaan yang tersedia. Banyak talenta lokal yang memiliki keterampilan tinggi
                        namun kesulitan mendapatkan akses ke pasar yang lebih luas.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Dengan memanfaatkan teknologi digital, kami menciptakan ekosistem yang memungkinkan pekerja
                        informal untuk terhubung langsung dengan pelanggan, menciptakan peluang ekonomi yang
                        berkelanjutan dan inklusif.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Visi kami adalah menjadi platform terdepan yang memberdayakan ekonomi rakyat melalui teknologi,
                        menciptakan lapangan kerja yang berkelanjutan, dan meningkatkan kesejahteraan masyarakat
                        Indonesia.
                    </p>
                </div>
                <div class="fade-in">
                    <div class="relative overflow-hidden rounded-xl shadow-2xl image-overlay">
                        <img src="{{ asset('images/about-story.jpg') }}" alt="Tim Yuk Kerja"
                            class="w-full h-96 object-cover object-center transition-transform duration-500 hover:scale-105"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/30 to-transparent rounded-xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Misi & Visi</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Komitmen kami untuk membangun
                    Indonesia yang lebih baik</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Vision -->
                <div
                    class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-center mb-6">
                        <div
                            class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-500 mb-4">
                            <i class="fas fa-eye text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-900">Visi</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed text-center">
                        Menjadi platform teknologi terdepan yang memberdayakan pekerja informal dan UMKM di Indonesia,
                        menciptakan ekosistem ekonomi digital yang inklusif dan berkelanjutan.
                    </p>
                </div>

                <!-- Mission -->
                <div
                    class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-center mb-6">
                        <div
                            class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 text-yellow-500 mb-4">
                            <i class="fas fa-bullseye text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-900">Misi</h3>
                    </div>
                    <ul class="text-gray-600 leading-relaxed space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-500 mt-1 mr-3 flex-shrink-0"></i>
                            Menghubungkan pekerja informal dengan peluang kerja berkualitas
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-500 mt-1 mr-3 flex-shrink-0"></i>
                            Memberikan akses teknologi yang mudah dan terjangkau
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-500 mt-1 mr-3 flex-shrink-0"></i>
                            Meningkatkan kesejahteraan ekonomi masyarakat
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Nilai-Nilai Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Prinsip yang memandu setiap langkah
                    perjalanan kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="text-center fade-in hover-lift">
                    <div
                        class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-blue-100 text-blue-500 mb-6">
                        <i class="fas fa-handshake text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Kepercayaan</h3>
                    <p class="text-gray-600 leading-relaxed">Membangun kepercayaan melalui transparansi dan kualitas
                        layanan yang konsisten</p>
                </div>

                <!-- Value 2 -->
                <div class="text-center fade-in hover-lift">
                    <div
                        class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                        <i class="fas fa-lightbulb text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Inovasi</h3>
                    <p class="text-gray-600 leading-relaxed">Terus berinovasi dengan teknologi terdepan untuk memberikan
                        solusi terbaik</p>
                </div>

                <!-- Value 3 -->
                <div class="text-center fade-in hover-lift">
                    <div
                        class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-blue-100 text-blue-500 mb-6">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Inklusivitas</h3>
                    <p class="text-gray-600 leading-relaxed">Memberikan kesempatan yang sama untuk semua lapisan
                        masyarakat</p>
                </div>

                <!-- Value 4 -->
                <div class="text-center fade-in hover-lift">
                    <div
                        class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 text-yellow-500 mb-6">
                        <i class="fas fa-heart text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-3">Empati</h3>
                    <p class="text-gray-600 leading-relaxed">Memahami kebutuhan dan tantangan yang dihadapi mitra dan
                        pelanggan</p>
                </div>
            </div>
        </div>
    </section>

<!-- Team Section with Slider -->
<section class="py-24 bg-gradient-to-b from-blue-50 to-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-20 animate-fade-in">
            <h2 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-6 tracking-tight">Tim Kami</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed font-light">Temui para profesional berbakat di balik kesuksesan Yuk Kerja</p>
        </div>

        <!-- Team Slider -->
        <div class="relative">
            <!-- Slider Container -->
            <div class="team-slider-container relative overflow-hidden">
                <div class="team-slider flex transition-transform duration-700 ease-in-out" id="teamSlider">
                    <!-- Slide 1 -->
                    <div class="team-slide flex-shrink-0 w-full px-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Project Manager -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/ridho.jpeg') }}" alt="Ridho Aulia Rahman" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Ridho Aulia Rahman</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Project Manager</p>
                                <p class="text-gray-600 text-base leading-relaxed">Memimpin proyek dengan presisi, memastikan setiap detail terkoordinasi untuk hasil terbaik.</p>
                            </div>

                            <!-- System Analyst -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/faqih.jpg') }}" alt="Muhammad Faqih" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Muhammad Faqih</h4>
                                <p class="text-yellow-600 font-semibold mb-4">System Analyst</p>
                                <p class="text-gray-600 text-base leading-relaxed">Merancang solusi teknologi inovatif berdasarkan analisis mendalam.</p>
                            </div>

                            <!-- UI/UX Designer 1 -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/silvi.jpeg') }}" alt="Lailatul Ilmi Silviana" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Lailatul Ilmi Silviana</h4>
                                <p class="text-yellow-600 font-semibold mb-4">UI/UX Designer</p>
                                <p class="text-gray-600 text-base leading-relaxed">Menciptakan desain antarmuka yang intuitif dan estetis.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="team-slide flex-shrink-0 w-full px-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- UI/UX Designer 2 -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/nizam.jpeg') }}" alt="Nizam Hukmul Kautsar" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Nizam Hukmul Kautsar</h4>
                                <p class="text-yellow-600 font-semibold mb-4">UI/UX Designer</p>
                                <p class="text-gray-600 text-base leading-relaxed">Mengoptimalkan pengalaman pengguna melalui penelitian mendalam.</p>
                            </div>

                            <!-- Administrasi 1 -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/dina.jpeg') }}" alt="Rizqy Nur Mauliddinah" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Rizqy Nur Mauliddinah</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Administrasi</p>
                                <p class="text-gray-600 text-base leading-relaxed">Mendukung operasional dengan pengelolaan administrasi yang efisien.</p>
                            </div>

                            <!-- Administrasi 2 -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/nana.jpeg') }}" alt="Umi Farzah Nadliroh" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Umi Farzah Nadliroh</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Administrasi</p>
                                <p class="text-gray-600 text-base leading-relaxed">Memastikan kelancaran proses administratif dan pengelolaan data.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="team-slide flex-shrink-0 w-full px-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Team Lead/Tech Lead -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/ivan.jpeg') }}" alt="Radifan Roihanul Fiqri" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Radifan Roihanul Fiqri</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Team Lead/Tech Lead</p>
                                <p class="text-gray-600 text-base leading-relaxed">Memimpin tim teknis dengan visi arsitektur yang kuat.</p>
                            </div>

                            <!-- Front End Engineer -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/hilmy.jpeg') }}" alt="Ahmad Hilmy Zainuddin" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Ahmad Hilmy Zainuddin</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Front End Engineer</p>
                                <p class="text-gray-600 text-base leading-relaxed">Membangun antarmuka responsif dengan performa tinggi.</p>
                            </div>

                            <!-- Back End Engineer 1 -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/yudha.jpeg') }}" alt="Yudha Pramana Putra" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Yudha Pramana Putra</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Back End Engineer</p>
                                <p class="text-gray-600 text-base leading-relaxed">Mengoptimalkan logika server dan pengelolaan database.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="team-slide flex-shrink-0 w-full px-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Back End Engineer 2 -->
                            <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-fade-in text-center mx-auto max-w-sm">
                                <div class="mb-6">
                                    <img src="{{ asset('images/team/yazid.jpeg') }}" alt="Yazid Shidqi R" class="h-32 w-32 rounded-full mx-auto object-cover border-4 border-blue-200 shadow-md">
                                </div>
                                <h4 class="font-bold text-blue-900 text-xl mb-2">Yazid Shidqi R</h4>
                                <p class="text-yellow-600 font-semibold mb-4">Back End Engineer</p>
                                <p class="text-gray-600 text-base leading-relaxed">Ahli dalam pengembangan API dan integrasi sistem backend.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Arrows -->
            <button id="prevSlide" class="absolute left-6 top-1/2 transform -translate-y-1/2 bg-white shadow-lg rounded-full p-4 text-blue-900 hover:bg-blue-100 transition-all duration-300 z-20 hover:scale-110">
                <i class="fas fa-chevron-left text-2xl"></i>
            </button>
            <button id="nextSlide" class="absolute right-6 top-1/2 transform -translate-y-1/2 bg-white shadow-lg rounded-full p-4 text-blue-900 hover:bg-blue-100 transition-all duration-300 z-20 hover:scale-110">
                <i class="fas fa-chevron-right text-2xl"></i>
            </button>
        </div>

        <!-- Slider Dots -->
        <div class="flex justify-center mt-10 space-x-3" id="sliderDots">
            <button class="slider-dot w-4 h-4 rounded-full bg-blue-300 hover:bg-blue-600 transition-all duration-300 active" data-slide="0"></button>
            <button class="slider-dot w-4 h-4 rounded-full bg-blue-300 hover:bg-blue-600 transition-all duration-300" data-slide="1"></button>
            <button class="slider-dot w-4 h-4 rounded-full bg-blue-300 hover:bg-blue-600 transition-all duration-300" data-slide="2"></button>
            <button class="slider-dot w-4 h-4 rounded-full bg-blue-300 hover:bg-blue-600 transition-all duration-300" data-slide="3"></button>
        </div>
    </div>

    <style>
        /* Slider Dot Styling */
        .slider-dot.active {
            background-color: #1e40af;
            transform: scale(1.2);
        }

        /* Slider Container */
        .team-slider-container {
            overflow: hidden;
            border-radius: 1rem;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #prevSlide, #nextSlide {
                display: none;
            }

            .team-slide {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Card Hover Effect */
        .hover\:shadow-2xl:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slider = document.getElementById('teamSlider');
            const prevBtn = document.getElementById('prevSlide');
            const nextBtn = document.getElementById('nextSlide');
            const dots = document.querySelectorAll('.slider-dot');

            let currentSlide = 0;
            const totalSlides = 4;

            function updateSlider() {
                const translateX = -currentSlide * 100;
                slider.style.transform = `translateX(${translateX}%)`;
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentSlide);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateSlider();
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateSlider();
            }

            // Event Listeners
            nextBtn.addEventListener('click', nextSlide);
            prevBtn.addEventListener('click', prevSlide);

            // Dot Navigation
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    updateSlider();
                });
            });

            // Auto-Play Slider
            let autoPlayInterval = setInterval(nextSlide, 6000);

            // Pause on Hover
            const sliderContainer = document.querySelector('.team-slider-container');
            sliderContainer.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
            sliderContainer.addEventListener('mouseleave', () => {
                autoPlayInterval = setInterval(nextSlide, 6000);
            });

            // Touch/Swipe Support
            let startX = 0;
            let currentX = 0;
            let isDragging = false;

            sliderContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                isDragging = true;
                clearInterval(autoPlayInterval);
            });

            sliderContainer.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                currentX = e.touches[0].clientX;
            });

            sliderContainer.addEventListener('touchend', () => {
                if (!isDragging) return;
                isDragging = false;
                const deltaX = startX - currentX;
                if (Math.abs(deltaX) > 50) {
                    if (deltaX > 0) nextSlide();
                    else prevSlide();
                }
                autoPlayInterval = setInterval(nextSlide, 6000);
            });
        });
    </script>
</section>
    <!-- Impact Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4 text-shadow">Dampak Kami</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Kontribusi nyata untuk masyarakat
                    Indonesia</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div
                    class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="1000">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">Mitra Terdaftar</p>
                </div>

                <div
                    class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-briefcase text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="5000">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">Pekerjaan Diselesaikan</p>
                </div>

                <div
                    class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-map-marker-alt text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900 counter" data-target="25">0</h3>
                    <p class="text-gray-600 mt-2 font-medium">Kota Terjangkau</p>
                </div>

                <div
                    class="p-6 bg-blue-50 rounded-xl shadow-md hover:shadow-lg transition duration-300 hover-lift fade-in">
                    <div class="text-blue-500 mb-4">
                        <i class="fas fa-star text-4xl"></i>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-900">4.8</h3>
                    <p class="text-gray-600 mt-2 font-medium">Rating Kepuasan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-800"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-shadow">Bergabunglah dengan Revolusi Digital</h2>
                <p class="text-blue-100 text-xl mb-8 leading-relaxed max-w-3xl mx-auto">
                    Mari bersama-sama membangun ekosistem ekonomi digital yang inklusif dan berkelanjutan untuk
                    Indonesia yang lebih baik.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#"
                        class="cta-gradient text-blue-900 font-bold px-8 py-4 rounded-lg shadow-lg text-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1 hover-lift">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sebagai Pengguna
                    </a>
                    <a href="#"
                        class="bg-transparent text-white font-medium border-2 border-white px-8 py-4 rounded-lg text-center hover:bg-white hover:text-blue-900 transition duration-300 hover-lift">
                        <i class="fas fa-handshake mr-2"></i>
                        Daftar Sebagai Mitra
                    </a>
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
                    <p class="text-blue-200 mb-6 leading-relaxed">Solusi digital untuk kebutuhan tenaga kerja informal
                        dan UMKM di Indonesia</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift"
                            aria-label="Facebook">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift"
                            aria-label="Twitter">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift"
                            aria-label="Instagram">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition duration-300 hover-lift"
                            aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="fade-in">
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('main') }}"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Home</a>
                        </li>
                        <li><a href="{{ route('about') }}"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Services</a>
                        </li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Blog</a>
                        </li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="fade-in">
                    <h4 class="text-lg font-bold mb-6">Services</h4>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa
                                Rumah Tangga</a></li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa
                                Otomotif</a></li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa
                                Pengiriman</a></li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa
                                Teknisi</a></li>
                        <li><a href="#"
                                class="text-blue-200 hover:text-white transition duration-300 hover:translate-x-1 inline-block">Jasa
                                Lainnya</a></li>
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
                            <a href="tel:+622112345678"
                                class="text-blue-200 hover:text-white transition duration-300">+62 21 1234 5678</a>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3 text-yellow-500 flex-shrink-0"></i>
                            <a href="mailto:info@yukkerja.id"
                                class="text-blue-200 hover:text-white transition duration-300">info@yukkerja.id</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="border-blue-800 mb-8">

            <div class="flex flex-col md:flex-row items-center justify-between">
                <p class="text-blue-200 text-sm mb-4 md:mb-0">&copy; 2025 Yuk Kerja. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-blue-200 hover:text-white text-sm transition duration-300">Privacy
                        Policy</a>
                    <a href="#" class="text-blue-200 hover:text-white text-sm transition duration-300">Terms of
                        Service</a>
                    <a href="#" class="text-blue-200 hover:text-white text-sm transition duration-300">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Chat Button -->
    <div class="fixed bottom-8 right-8 z-50">
        <button
            class="bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold w-16 h-16 rounded-full shadow-lg flex items-center justify-center hover:shadow-xl transition duration-300 transform hover:-translate-y-1 chat-pulse"
            aria-label="Chat Support">
            <i class="fas fa-comments text-2xl"></i>
        </button>
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop"
        class="fixed bottom-8 left-8 bg-blue-900 hover:bg-blue-800 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition duration-300 transform hover:-translate-y-1 opacity-0 invisible z-50"
        aria-label="Back to Top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                        element.textContent = target + (target > 100 ? '+' : '');
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

            // Back to top button functionality
            const backToTopButton = document.getElementById('backToTop');

            window.addEventListener('scroll', function () {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.add('opacity-0', 'invisible');
                    backToTopButton.classList.remove('opacity-100', 'visible');
                }
            });

            backToTopButton.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
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
        });
    </script>
</body>

</html>