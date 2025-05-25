<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Homepage Yuk Kerja</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="homepage_style.css" />
</head>
<body>
  <aside class="sidebar minimized" id="sidebar">
    <div class="logo">
      <img src="icons/loho.png" alt="Yukerja Logo" />
      <div class="logo-text">
        <span class="text-yuk">Yuk</span>
        <span class="text-kerja">Kerja</span>
      </div>
    </div>
    <nav class="nav-menu">
      <a href="#" class="nav-item">
        <img src="icons/postjob.png" alt="Post Job Icon" class="icon" />
        <span class="menu-label">Post Job</span>
      </a>
      <a href="#" class="nav-item">
        <img src="icons/chat.png" alt="Chat Icon" class="icon" />
        <span class="menu-label">Chat</span>
      </a>
      <a href="#" class="nav-item">
        <img src="icons/order-history.png" alt="Order History Icon" class="icon" />
        <span class="menu-label">Order History</span>
      </a>
    </nav>
    <!-- Tombol Toggle Sidebar -->
    <button id="toggleSidebar" class="toggle-sidebar-btn">
      &#9776;
      <span class="menu-label">Minimize</span>
    </button>
  </aside>
  
  

  <header class="navbar">
    <div class="left-menu">
      <img src="images/Logo Yuk Kerja.png" alt="Logo" class="logo" />
    </div>
    <form id="searchForm" action="homepage.html" method="GET" class="search-bar">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" name="q" placeholder="Cari jasa" />
    </form>

    <div class="right-menu">
      <!-- Notifikasi Bell -->
      <div class="user-menu-container" onclick="toggleNotificationMenu()">
        <img src="icons/notifbell.png" alt="Notifikasi" class="custom-icon" />
        <span class="notif-badge">4</span>
      </div>
    
      <!-- Icon User & Dropdown -->
      <div class="user-menu-container" onclick="toggleUserMenu()">
        <img src="icons/usericon.png" alt="User" class="custom-icon" />
        <i id="arrowIcon" class="fa-solid fa-chevron-down"></i>
    
        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="dropdown hidden">
          <div class="profile-info">
            <img src="icons/usericon.png" alt="Profile Picture" class="custom-icon" />
            <div>
              <div class="profile-name">user</div>
              <div class="profile-email">user@gmail.com</div>
            </div>
          </div>
    
          <a href="edit_profile.html">
            <button class="edit-button">Edit Profil</button>
          </a>
    
          <div class="menu-item">
            <img src="icons/favorit.png" alt="Mitra Favorit" class="icon-img" />
            <span>Mitra Favorit</span>
          </div>
    
          <div class="menu-item">
            <img src="icons/money.png" alt="Riwayat Transaksi" class="icon-img" />
            <span>Riwayat Transaksi</span>
          </div>
    
          <div class="menu-item logout" id="logoutButton">
            <img src="icons/logout.png" alt="Keluar" class="icon-img" />
            <span>Keluar</span>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Notifikasi Popup -->
    <div id="notificationPopup" class="notification-popup hidden">
      <div class="popup-box">
        <div class="notif-header">
          <img src="icons/notifbell.png" alt="Icon" class="notif-header-icon" />
          <span>Notification</span>
        </div>
        <hr class="notif-line" />
        <div class="notif-subtitle">Result (0)</div>
        <hr class="notif-line" />
        <div class="notif-icon">
        
          <div class="push-notif-icon">
            <img src="icons/Push Notifications.png" alt="Push Notification Icon" />
          </div>
        <div class="notif-empty">No notifications yet</div>
        <div class="notif-text">Your notification will appear here once you’ve received them</div>
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
        <i class="fa-solid fa-chevron-down arrowIcon" style="margin-left: 5px;"></i>
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
const arrowIcon = toggleBtn.querySelector('.arrowIcon'); // cari panah hanya dalam toggleBtn

toggleBtn.addEventListener('click', () => {
  const currentDisplay = window.getComputedStyle(filterOptions).display;
  const isHidden = currentDisplay === 'none';

  filterOptions.style.display = isHidden ? 'flex' : 'none';
  arrowIcon.classList.remove('fa-chevron-down', 'fa-chevron-up');
  arrowIcon.classList.add(isHidden ? 'fa-chevron-up' : 'fa-chevron-down');
});


  function toggleMenu() {
  const menu = document.getElementById("dropdownMenu");
  const arrow = document.getElementById("arrowIcon");
  menu.classList.toggle("hidden");
  arrow.classList.toggle("fa-chevron-down");
  arrow.classList.toggle("fa-chevron-up");
}
document.getElementById("logoutButton").addEventListener("click", function () {
    // Tambahkan kode logout lain jika diperlukan, misal: hapus session/localStorage

    window.location.href = "customer_signin.html"; // Redirect ke halaman login
  });
  const toggleSidebar = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");

  toggleSidebar.addEventListener("click", () => {
    sidebar.classList.toggle("minimized");
  });
  function toggleNotificationMenu() {
    const popup = document.getElementById('notificationPopup');
    popup.classList.toggle('hidden');
  }

  function toggleUserMenu() {
    const menu = document.getElementById('dropdownMenu');
    menu.classList.toggle('hidden');
  }

  // Opsional: tutup menu saat klik di luar
  document.addEventListener('click', function(event) {
    const notifPopup = document.getElementById('notificationPopup');
    const userMenu = document.getElementById('dropdownMenu');
    const bellIcon = document.querySelector('.right-menu .user-menu-container:nth-child(1)');
    const userIcon = document.querySelector('.right-menu .user-menu-container:nth-child(2)');

    if (!bellIcon.contains(event.target)) {
      notifPopup.classList.add('hidden');
    }

    if (!userIcon.contains(event.target)) {
      userMenu.classList.add('hidden');
    }
  });
  </script>
</body>
</html>
