<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Homepage Yuk Kerja</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/homepage_style.css') }}" />
</head>
<body>
  <aside class="sidebar">
    <i class="fa-solid fa-bars menu-icon" id="menu-toggle"></i>
  </aside>

  <header class="navbar">
    <div class="left-menu">
      <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Logo" class="logo" />
    </div>
    <form id="searchForm" action="homepage.html" method="GET" class="search-bar">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" name="q" placeholder="Cari jasa" />
    </form>

    <div class="right-menu">
      <img src="{{ asset('icons/notifbell.png')}}" alt="Notifikasi" class="custom-icon" />
      <span class="notif-badge">4</span>
      <div class="user-menu-container" onclick="toggleMenu()">
        <img src="{{asset('icons/usericon.png') }}" alt="User" class="custom-icon" />
        <i id="arrowIcon" class="fa-solid fa-chevron-down"></i>
      
        <div id="dropdownMenu" class="dropdown hidden">
          <div class="profile-info">
            <img src="{{ asset('icons/usericon.png') }}') }}" alt="Profile Picture" class="custom-icon" />

            <div>
              <div class="profile-name">user</div>
              <div class="profile-email">user@gmail.com</div>
            </div>
          </div>
          <a href="edit_profile.html">
            <button class="edit-button">Edit Profil</button>
          </a>
          <div class="menu-item">
            <img src="{{asset('icons/favorit.png') }}" alt="Mitra Favorit" class="icon-img" />
            <span>Mitra Favorit</span>
          </div>
          
          <div class="menu-item">
            <img src="{{asset('icons/money.png') }}" alt="Riwayat Transaksi" class="icon-img" />
            <span>Riwayat Transaksi</span>
          </div>
          
          <div class="menu-item logout">
            <img src="{{asset('icons/logout.png') }}" alt="Keluar" class="icon-img" />
            <span>Keluar</span>
          </div>
          
          
        </div>
      </div>
      
    </div>
  </header> 

  <nav class="category-nav">
    <a href="#" class="category-link active">Untuk Kamu</a>
    <a href="#" class="category-link">Layanan Umum</a>
    <a href="#" class="category-link">Bengkel Kendaraan</a>
    <a href="#" class="category-link">Layanan Rumah Tangga</a>
    <a href="#" class="category-link">Pekerjaan Freelance / Digital</a>
    <a href="#" class="category-link">Lain-lain</a>
    <div class="category-filters">
      <div id="toggleFilter" class="filter-toggle">
        <i class="fa-solid fa-sliders" style="margin-right: 5px;"></i>
        Filters
        <i id="arrowIcon" class="fa-solid fa-chevron-down" style="margin-left: 5px;"></i>
      </div>
    <div class="underline-separator"></div>
  </nav>

  <div id="filterOptions" class="filter-options">
    <select id="lokasiFilter">
      <option value="" disabled selected>Lokasi</option>
      <option value="1">1 KM</option>
      <option value="5">5 KM</option>
    </select>
  
    <select id="ratingFilter">
      <option value="" disabled selected>Rating Tertinggi</option>
      <option value="5">Bintang 5</option>
      <option value="4">Bintang 4 Keatas</option>
      <option value="3">Bintang 3 Keatas</option>
    </select>
  
    <select id="hargaFilter">
      <option value="" disabled selected>Termurah</option>
      <option value="range1">Rp. 5.000 - Rp. 10.000</option>
      <option value="range2">Rp. 11.000 - Rp. 15.000</option>
      <option value="range3">Rp. >15.000</option>
    </select>
  
    <button id="filterTerbaru" class="filter-button">Terbaru</button>
  </div>
  

  <!-- Untuk Kamu -->
  <div id="card-untukkamu" class="card-container">
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Makmur Jaya</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Tambal Ban<br>Setia Sukses</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,8</span><span class="distance">1,2 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 25.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <!-- Layanan Umum -->
  <div id="card-layananumum" class="card-container" style="display: none;">
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Checkup <br>Puskesmas</div>
          <div class="rating-row">
            <span class="star">★</span><span>4,6</span><span class="distance">1,4 km</span>
          </div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 15.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
  </div>
  

  <!-- Bengkel Kendaraan -->
  <div id="card-bengkelkendaraan" class="card-container" style="display: none;">
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Servis Motor Bang Jaka</div>
          <div class="rating-row"><span class="star">★</span><span>4,9</span><span class="distance">2,1 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 50.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <!-- Layanan Rumah Tangga -->
  <div id="card-layananrumah" class="card-container" style="display: none;">
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Jasa Bersih Rumah</div>
          <div class="rating-row"><span class="star">★</span><span>4,6</span><span class="distance">1,8 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 75.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <!-- Freelance / Digital -->
  <div id="card-freelance" class="card-container" style="display: none;">
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Desain Logo Digital</div>
          <div class="rating-row"><span class="star">★</span><span>5,0</span><span class="distance">Online</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 100.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <!-- Lain-lain -->
  <div id="card-lainlain" class="card-container" style="display: none;">
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
    <div class="card-job">
      <div class="card-header">
        <div class="img-placeholder"></div>
        <div class="text-info">
          <div class="title">Kasir Minimarket</div>
          <div class="rating-row"><span class="star">★</span><span>4,3</span><span class="distance">3,4 km</span></div>
        </div>
      </div>
      <div class="price">Mulai dari Rp 60.000</div>
      <div class="card-footer">
        <button class="button-chat">Chat</button>
        <button class="button-order">Pesan Sekarang</button>
      </div>
    </div>
  </div>

  <script>
    const categoryLinks = document.querySelectorAll('.category-link');
    const allCardSections = document.querySelectorAll('.card-container');

    const categoryMap = {
      "Untuk Kamu": "card-untukkamu",
      "Layanan Umum": "card-layananumum",
      "Bengkel Kendaraan": "card-bengkelkendaraan",
      "Layanan Rumah Tangga": "card-layananrumah",
      "Pekerjaan Freelance / Digital": "card-freelance",
      "Lain-lain": "card-lainlain"
    };

    categoryLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        categoryLinks.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
        const categoryName = this.innerText.trim();
        const targetId = categoryMap[categoryName];
        allCardSections.forEach(section => section.style.display = 'none');
        document.getElementById(targetId).style.display = 'flex';
      });
    });
    // Cek apakah ada parameter "q" di URL
  const urlParams = new URLSearchParams(window.location.search);
  const query = urlParams.get('q');

  if (query) {
    document.getElementById('searchInput').addEventListener('input', function () {
  const searchValue = this.value.toLowerCase();
  const categories = document.querySelectorAll('.card-container'); // Ambil semua kategori
  const cards = document.querySelectorAll('.card-job'); // Ambil semua kartu

  // Sembunyikan seluruh kategori terlebih dahulu
  categories.forEach(category => {
    category.style.display = 'none';
  });

  // Lakukan pencarian dan sembunyikan kartu yang tidak relevan
  cards.forEach(card => {
    const title = card.querySelector('.title').textContent.toLowerCase(); // Ambil teks dari title kartu
    if (title.includes(searchValue)) {
      card.style.display = 'block'; // Tampilkan kartu jika cocok
    } else {
      card.style.display = 'none'; // Sembunyikan kartu jika tidak cocok
    }
  });

  // Menampilkan kategori yang memiliki kartu yang relevan
  categories.forEach(category => {
    const visibleCards = Array.from(category.querySelectorAll('.card-job'))
      .filter(card => card.style.display !== 'none'); // Filter kartu yang tampil

    if (visibleCards.length > 0) {
      category.style.display = 'flex'; // Menampilkan kategori jika ada kartu yang tampil
    }
  });
});

    // Nonaktifkan kategori aktif agar search tidak bentrok
    const categoryLinks = document.querySelectorAll('.category-link');
    categoryLinks.forEach(link => link.classList.remove('active'));
  }
  const toggleBtn = document.getElementById('toggleFilter');
  const filterOptions = document.getElementById('filterOptions');
  const arrowIcon = document.getElementById('arrowIcon');

  toggleBtn.addEventListener('click', () => {
    const isHidden = filterOptions.style.display === 'none';
    filterOptions.style.display = isHidden ? 'flex' : 'none';
    arrowIcon.classList.remove('fa-chevron-down', 'fa-chevron-up');
    arrowIcon.classList.add(isHidden ? 'fa-chevron-up' : 'fa-chevron-down');
    
  });
  document.getElementById('filterTerbaru').addEventListener('click', function () {
    this.classList.toggle('active');
    
    // Logika filter bisa ditambahkan di sini
    console.log("Filter 'Terbaru' diterapkan");
  });
  function toggleMenu() {
  const menu = document.getElementById("dropdownMenu");
  const arrow = document.getElementById("arrowIcon");
  menu.classList.toggle("hidden");
  arrow.classList.toggle("fa-chevron-down");
  arrow.classList.toggle("fa-chevron-up");
}

  </script>
</body>
</html>