<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerja - @yield('title')</title>
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand img {
            height: 40px;
        }
        .category-nav {
            border-bottom: 1px solid #e9ecef;
            padding: 10px 0;
            margin-bottom: 20px;
        }
        .category-nav .nav-link {
            color: #495057;
            font-weight: 500;
            padding: 8px 16px;
            position: relative;
        }
        .category-nav .nav-link.active {
            color: #0d6efd;
            font-weight: 600;
        }
        .category-nav .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #0d6efd;
        }
        .service-card {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            transition: transform 0.2s;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .service-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #e9ecef;
            margin-bottom: 10px;
        }
        .service-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .service-rating {
            color: #ffc107;
            margin-right: 5px;
        }
        .service-distance {
            color: #6c757d;
            font-size: 14px;
        }
        .service-price {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }
        .btn-chat {
            background-color: #0d6efd;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            padding: 5px 10px;
        }
        .btn-order {
            background-color: #ffc107;
            color: #000;
            font-size: 14px;
            border-radius: 5px;
            padding: 5px 10px;
        }
        .search-bar {
            border-radius: 25px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
            width: 100%;
            max-width: 600px;
        }
        .search-icon {
            color: #6c757d;
            margin-right: 10px;
        }
        .filters-btn {
            display: flex;
            align-items: center;
            color: #212529;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
            <div class="container">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <a class="navbar-brand ms-lg-0 ms-3" href="#">
                    <img src="{{ asset('images/yuk-kerja-logo.png') }}') }}" alt="YukKerja Logo" onerror="this.src='https://via.placeholder.com/150x40?text=YukKerja'">
                </a>
                
                <div class="d-flex flex-grow-1 justify-content-center mx-lg-5 mx-0 position-relative">
                    <i class="fas fa-search search-icon position-absolute start-0 top-50 translate-middle-y ms-3"></i>
                    <input class="search-bar" type="text" placeholder="Cari jasa">
                </div>
                
                <div class="d-flex align-items-center">
                    <a href="#" class="me-3 position-relative">
                        <i class="fas fa-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            1
                        </span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                            <img src="{{ asset('images/profile.png') }}') }}" alt="Profile" class="rounded-circle" width="32" height="32" onerror="this.src='https://via.placeholder.com/32?text=P'">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li><a class="dropdown-item" href="#">Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        
        <div class="category-nav">
            <div class="container">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('untuk-kamu') ? 'active' : '' }}" href="#">Untuk Kamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('layanan-umum') ? 'active' : '' }}" href="#">Layanan Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bengkel-kendaraan') ? 'active' : '' }}" href="#">Bengkel Kendaraan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('layanan-rumah-tangga') ? 'active' : '' }}" href="#">Layanan Rumah Tangga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pekerjaan-freelance') ? 'active' : '' }}" href="#">Pekerjaan Freelance / Digital</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('lain-lain') ? 'active' : '' }}" href="#">Lain-lain</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>