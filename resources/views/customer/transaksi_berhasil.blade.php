<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Homepage Yuk Kerja</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/homepage_style.css') }}">
</head>
<body>
  <aside class="sidebar minimized" id="sidebar">
    <div class="logo">
      <img src="{{ asset('icons/loho.png') }}" alt="Yukerja Logo" />
      <div class="logo-text">
        <span class="text-yuk">Yuk</span>
        <span class="text-kerja">Kerja</span>
      </div>
    </div>
    <nav class="nav-menu">
      <a href="#" class="nav-item">
        <img src="{{ asset('icons/postjob.png') }}" alt="Post Job Icon" class="icon" />
        <span class="menu-label">Post Job</span>
      </a>
      <a href="#" class="nav-item">
        <img src="{{ asset('icons/chat.png') }}" alt="Chat Icon" class="icon" />
        <span class="menu-label">Chat</span>
      </a>
      <a href="#" class="nav-item">
        <img src="{{ asset('icons/order-hitory.png') }}" alt="Order History Icon" class="icon" />
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
      <img src="{{ asset('images/Logo Yuk Kerja.png') }}" alt="Logo" class="logo" />
    </div>
    <form id="searchForm" action="homepage.html" method="GET" class="search-bar">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" name="q" placeholder="Cari jasa" />
    </form>

    <div class="right-menu">
      <img src="{{ asset('icons/notifbell.png') }}" alt="Notifikasi" class="custom-icon" />
      <span class="notif-badge">4</span>
      <div class="user-menu-container" onclick="toggleMenu()">
        <img src="{{ asset('icons/usericon.png') }}" alt="User" class="custom-icon" />
        <i id="arrowIcon" class="fa-solid fa-chevron-down"></i>
        <div id="dropdownMenu" class="dropdown hidden">
          <div class="profile-info">
            <img src="{{ asset('icons/usericon.png') }}" alt="Profile Picture" class="custom-icon" />
            <div>
              <div class="profile-name">user</div>
              <div class="profile-email">user@gmail.com</div>
            </div>
          </div>
          <button class="edit-button">Edit Profil</button>
          <div class="menu-item">
            <img src="{{ asset('icons/favorit.png') }}" alt="Mitra Favorit" class="icon-img" />
            <span>Mitra Favorit</span>
          </div>
          <div class="menu-item">
            <img src="{{ asset('icons/money.png') }}" alt="Riwayat Transaksi" class="icon-img" />
            <span>Riwayat Transaksi</span>
          </div>
          <div class="menu-item logout" onclick="window.location.href='customer_signin.html'">
            <img src="{{ asset('icons/logout.png') }}" alt="Keluar" class="icon-img" />
            <span>Keluar</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <style>
    .nav-tabs {
  display: flex;
  gap: 20px;
  font-weight: 600;
  font-size: 16px;
  padding: 10px 0;
  border-bottom: 2px solid #ccc;
  margin-left: 50px;
}
    .nav-tabs .tab {
      padding: 10px 20px;
      cursor: pointer;
      color: #555;
      border-bottom: 2px solid transparent;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      transition: all 0.3s ease;
      user-select: none;
      text-decoration: none;
    }
  
    .nav-tabs .active {
  border-bottom: 3px solid #0B2F57;
  color: #0B2F57;
}
  </style>
  <div class="edit-profile-container">
  <div class="nav-tabs">
  <a href="edit_profile.html?tab=profil" class="tab">Profil Pribadi</a>
  <a href="edit_profile.html?tab=favorit" class="tab">Mitra Favorit</a>
  <a href="edit_profile.html?tab=riwayat" class="tab active">Riwayat Transaksi</a>
</div>
  
    <div class="tab-content active" id="riwayat">
      <div style="max-width: 600px; margin: 40px auto; border: 2px solid #ccc; border-radius: 10px; padding: 30px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1); font-family: 'Poppins', sans-serif;">
        <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #0B2F57; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
          <i class="fa-solid fa-check" style="color: white; font-size: 24px;"></i>
        </div>
        <h3 style="margin-top: 20px; font-weight: 700; font-size: 18px;">Transaksi Berhasil Dikembalikan</h3>
        <table style="margin: 20px auto; text-align: left; width: 100%; font-size: 15px; line-height: 2.2;">
          <tr>
            <td style="color: grey; font-weight: 500;">Tanggal</td>
            <td style="text-align: right; font-weight: 600;">12 April 2025 | 16:38:55 WIB</td>
          </tr>
          <tr>
            <td style="color: grey; font-weight: 500;">Nomor Refrensi</td>
            <td style="text-align: right; font-weight: 600;">8dgd7392hfdk</td>
          </tr>
        
          <!-- Garis sebelum Sumber Dana -->
          <tr>
            <td colspan="2"><hr style="border: 0; border-top: 1px solid #ccc;" /></td>
          </tr>
        
          <tr>
            <td style="color: grey; font-weight: 500;">Sumber Dana</td>
            <td style="text-align: right; font-weight: 600;">NIZAM HUKMUL KAUTSAR</td>
          </tr>
          <tr>
            <td style="color: grey; font-weight: 500;">Jenis Transakasi</td>
            <td style="text-align: right; font-weight: 600;">Pembayaran QRIS</td>
          </tr>
          <tr>
            <td style="color: grey; font-weight: 500;">Nama Usaha</td>
            <td style="text-align: right; font-weight: 600;">Setia Sukses</td>
          </tr>
          <tr>
            <td style="color: grey; font-weight: 500;">Lokasi Usaha</td>
            <td style="text-align: right; font-weight: 600;">MALANG</td>
          </tr>
        
          <!-- Garis sebelum Total -->
          <tr>
            <td colspan="2"><hr style="border: 0; border-top: 1px solid #ccc;" /></td>
          </tr>
        
          <tr style="font-weight: 700;">
            <td style="font-size: 18px;">Total</td>
            <td style="text-align: right; color: #0B2F57; font-size: 16px;">Rp18.000</td>
          </tr>
        </table>
        
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const tabParam = urlParams.get("tab");
    
        const tabs = document.querySelectorAll(".nav-tabs .tab");
        const contents = document.querySelectorAll(".tab-content");
    
        if (tabParam) {
          tabs.forEach(tab => {
            // Ambil 'tab' dari href-nya
            const hrefTab = tab.getAttribute("href").split('tab=')[1];
            if (hrefTab === tabParam) {
              tab.classList.add("active");
            } else {
              tab.classList.remove("active");
            }
          });
    
          contents.forEach(content => {
            if (content.id === tabParam) {
              content.classList.add("active");
            } else {
              content.classList.remove("active");
            }
          });
        }
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
    </script>
    