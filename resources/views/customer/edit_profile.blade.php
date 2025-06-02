<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Profil - Yuk Kerja</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/homepage_style.css') }}">
</head>
<body>
  <!-- Sidebar -->
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
        <img src="{{ asset('icons/order-history.png') }}" alt="Order History Icon" class="icon" />
        <span class="menu-label">Order History</span>
      </a>
    </nav>
    <!-- Tombol Toggle Sidebar -->
    <button id="toggleSidebar" class="toggle-sidebar-btn">
      &#9776;
      <span class="menu-label">Minimize</span>
    </button>
  </aside>

  <!-- Navbar -->
  <header class="navbar">
    <div class="left-menu">
      <img src="{{ asset('images/Logo Yuk Kerja.png') }}" alt="Logo" class="logo" />
    </div>
    <form id="searchForm" action="{{ route('customer.homepage') }}" method="GET" class="search-bar">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchInput" name="q" placeholder="Cari jasa" value="{{ request('q') }}" />
    </form>
    <div class="right-menu">
      <div class="user-menu-container" onclick="toggleNotificationMenu()">
        <img src="{{ asset('icons/notifbell.png') }}" alt="Notifikasi" class="custom-icon" />
        <span class="notif-badge">4</span>
      </div>
      <div class="user-menu-container" onclick="toggleMenu()">
        <img src="{{ asset('icons/usericon.png') }}" alt="User" class="custom-icon" />
        <i id="arrowIcon" class="fa-solid fa-chevron-down"></i>
        <div id="dropdownMenu" class="dropdown hidden">
          <div class="profile-info">
            <img src="{{ $user->profile_photo ? asset('storage/'.$user->profile_photo) : asset('icons/usericon.png') }}" alt="Profile Picture" class="custom-icon" />
            <div>
              <div class="profile-name">{{ $user->name }}</div>
              <div class="profile-email">{{ $user->email }}</div>
            </div>
          </div>
          <a href="{{ route('customer.edit_profile') }}">
            <button class="edit-button">Edit Profil</button>
          </a>
          <div class="menu-item">
            <img src="{{ asset('icons/favorit.png') }}" alt="Mitra Favorit" class="icon-img" />
            <span>Mitra Favorit</span>
          </div>
          <div class="menu-item">
            <img src="{{ asset('icons/money.png') }}" alt="Riwayat Transaksi" class="icon-img" />
            <span>Riwayat Transaksi</span>
          </div>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="menu-item logout" id="logoutButton" style="border:none; background:none; cursor:pointer;">
              <img src="{{ asset('icons/logout.png') }}" alt="Keluar" class="icon-img" />
              <span>Keluar</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <div class="edit-profile-container">
    <div class="nav-tabs">
      <span class="tab active" data-tab="profil">Profil Pribadi</span>
      <span class="tab" data-tab="favorit">Mitra Favorit</span>
      <span class="tab" data-tab="riwayat">Riwayat Transaksi</span>
    </div>

    <!-- TAB 1: Profil -->
    <div class="tab-content active" id="profil">
      <div class="edit-profile-box">
        <div class="profile-section">
          <div class="profile-picture">
          </div>
          <button class="btn-ganti-gambar">Ganti Gambar</button>
        </div>

        <form method="POST" action="{{ route('profile.update') }}">
          @csrf
          @method('PUT')

          <div class="form-section">
            <div class="form-group">
              <label for="username">Username</label>
              <div class="input-container">
                <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" required>
              </div>
              @error('username')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="nama">Nama</label>
              <div class="input-container">
                <input type="text" id="nama" name="name" value="{{ old('name', $user->name) }}" required>
              </div>
              @error('name')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <div class="input-container">
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
              </div>
              @error('email')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">Kata Sandi <small>(biarkan kosong jika tidak ingin mengubah)</small></label>
              <div class="input-container">
                <input type="password" id="password" name="password" placeholder="********">
              </div>
              @error('password')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label for="nohp">No. Hp</label>
              <div class="input-container">
                <input type="text" id="nohp" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
              </div>
              @error('phone')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn-save">Save</button>
          </div>
        </form>
      </div>
    </div>

    <!-- TAB 2: Mitra Favorit -->
    <div class="tab-content" id="favorit" style="display:none;">
      <div class="card-container">
        @forelse($mitras as $mitra)
          <div class="card-job">
            <div class="card-header">
              <div class="img-placeholder">
                <img src="{{ $mitra->profile_photo ? asset('storage/' . $mitra->profile_photo) : asset('default-photo.png') }}" alt="{{ $mitra->business_name }}">
              </div>
              <div class="text-info">
                <div class="title">{{ $mitra->business_name }}</div>
                <div class="rating-row">
                  <span class="star">★</span><span>{{ number_format($mitra->avg_rating, 1) }}</span>
                  <span class="distance">{{ $mitra->service_area ?? '-' }}</span>
                </div>
              </div>
            </div>
            <div class="price">Mulai dari Rp 25.000</div> {{-- Dinamis jika ada --}}
            <div class="card-footer">
              <button class="button-chat">Chat</button>
              <button class="button-order">Pesan Sekarang</button>
            </div>
          </div>
        @empty
          <p>Tidak ada mitra favorit.</p>
        @endforelse
      </div>
    </div>

    <!-- TAB 3: Riwayat Transaksi -->
    <div class="tab-content" id="riwayat" style="display:none;">
      <div class="riwayat-container">
        @forelse ($riwayatTransaksi as $transaksi)
          <div class="riwayat-card">
            <div class="riwayat-header">
              <div class="left-header">
                <i class="fa-solid fa-briefcase"></i>
                <span class="riwayat-title">Riwayat Transaksi</span>
              </div>
              <span class="riwayat-date">{{ $transaksi->created_at->format('d F Y') }}</span>
              <div class="riwayat-status {{ strtolower($transaksi->payment_status) }}">{{ $transaksi->payment_status }}</div>
            </div>

            <div class="riwayat-footer">
              <p>{{ $transaksi->note ?? '' }}</p>
              <a href="{{ route('transaksi.detail', $transaksi->id) }}" class="lihat-detail-link">Lihat Detail Transaksi</a>
            </div>

            <div class="riwayat-content">
              <div>
                <div class="riwayat-nama">{{ $transaksi->service_name ?? '-' }}</div>
                <div class="riwayat-layanan-harga">
                  <div class="riwayat-layanan">{{ $transaksi->service_detail ?? '-' }}</div>
                  <div class="riwayat-harga">Rp. {{ number_format($transaksi->amount, 0, ',', '.') }}</div>
                </div>
              </div>
              <div class="riwayat-image-container">
                <img src="{{ $transaksi->service_image ? asset('storage/' . $transaksi->service_image) : asset('images/image14.png') }}" class="riwayat-image" />
              </div>
              <div class="riwayat-total-container-{{ $transaksi->payment_status == 'Selesai' ? 2 : 1 }}">
                <span class="label">Total Belanja</span>
                <strong class="harga">Rp. {{ number_format($transaksi->amount, 0, ',', '.') }}</strong>
              </div>
              <div class="menu-titik-tiga">
                <div class="ellipse"></div>
                <div class="ellipse"></div>
                <div class="ellipse"></div>
              </div>
            </div>
          </div>
        @empty
          <p>Tidak ada riwayat transaksi.</p>
        @endforelse
      </div>
    </div>
  </div>

  <script>
    const tabButtons = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        tabButtons.forEach(b => b.classList.remove('active'));
        tabContents.forEach(c => {
          c.classList.remove('active');
          c.style.display = 'none';
        });

        btn.classList.add('active');
        const tabId = btn.getAttribute('data-tab');
        const activeTab = document.getElementById(tabId);
        activeTab.classList.add('active');
        activeTab.style.display = 'block';
      });
    });

    function toggleMenu() {
      const menu = document.getElementById("dropdownMenu");
      const arrow = document.getElementById("arrowIcon");
      menu.classList.toggle("hidden");
      arrow.classList.toggle("fa-chevron-down");
      arrow.classList.toggle("fa-chevron-up");
    }

    document.getElementById("logoutButton")?.addEventListener("click", function () {
      window.location.href = "{{ route('logout') }}";
    });

    const toggleSidebar = document.getElementById("toggleSidebar");
    const sidebar = document.getElementById("sidebar");

    toggleSidebar?.addEventListener("click", () => {
      sidebar.classList.toggle("minimized");
    });

    function toggleNotificationMenu() {
      const popup = document.getElementById('notificationPopup');
      popup.classList.toggle('hidden');
    }
  </script>
</body>
</html>
