<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Homepage Yuk Kerja</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="homepage_style.css" />
 <link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""
/>


</head>
<style>
    .post-job-container {
  background-color: #ebebeb;
  padding: 2rem;
  border-radius: 20px;
  max-width: 800px;
  margin: 2rem auto;
  font-family: 'Poppins', sans-serif;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.form-title {
  font-size: 36px;
  font-weight: bold;
  color: #0B2F57;
  margin-bottom: 30px;
}

.post-job-form {
  width: 100%;
  max-width: 766px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.post-job-form label {
  font-weight: 600;
  color: #0B2F57;
  margin-top: 5px;
  font-size: 20px;
}

.post-job-form input[type="text"],
.post-job-form textarea {
  box-sizing: border-box;
  width: 100%;
  height: 47px;
  padding: 10px 20px;
  font-size: 16px;
  color: #333;
  background: #D9D9D9;
  border: 1px solid #0B2F57;
  border-radius: 17px;
}
.post-job-form input[type="date"]{
    box-sizing: border-box;
  width: 60%;
  height: 47px;
  padding: 10px 20px;
  font-size: 16px;
  color: #333;
  background: #D9D9D9;
  border: 1px solid #0B2F57;
  border-radius: 17px;
}
.post-job-form label[for="date"] {
  display: inline-block;
  width: 100px; /* sesuaikan */
  font-family: 'Poppins';
  font-weight: 600;
  font-size: 16px;
  color: #0B2F57;
  margin-bottom: 8px;
}
.post-job-form input::placeholder,
.post-job-form textarea::placeholder {
  color: #979797;
}


.map-container img {
  width: 100%;
  height: auto;
  border-radius: 12px;
  border: 1px solid #ccc;
}
.form-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 20px;
  margin-top: 20px;
}
.file-upload-box {
  border: 2px dashed #8c8a8a;
  border-radius: 10px;
  padding: 1rem;
  text-align: center;
  background-color: #dbd9d9;
  position: relative;
}

.file-upload-box input[type="file"] {
  opacity: 0;
  position: absolute;
  width: 100%;
  height: 100%;
  cursor: pointer;
  top: 0;
  left: 0;
}

.file-upload-box .upload-content {
  pointer-events: none; /* supaya klik tetap ke input file yg transparan */
}

.submit-button {
  display: block;            /* agar tombol bisa di margin-auto */
  margin: 1.5rem auto 0;     /* top margin + center horizontal */
  padding: 0.75rem 1.5rem;
  background-color: #002e61;
  color: white;
  border: none;
  border-radius: 25px;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: fit-content;        /* tombol hanya selebar konten + padding */
  min-width: 400px;          /* tombol gak terlalu kecil */
  text-align: center;
  margin-left: 230px;
}

.submit-button:hover {
  background-color: #001f3f;
}
.upload-text {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 16px;
  color: #0B2F57;
  text-align: center;
  line-height: 1.4;
  user-select: none; /* agar teks gak gampang ke-select */
}
#describe {
  font-family: 'Poppins', sans-serif;
}
.map-container {
  height: 100px;
  border: 1px solid #ccc;
  cursor: pointer;
}

/* Modal styling */
.modal-map {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-map-content {
  position: relative;
  margin: 5% auto;
  width: 90%;
  max-width: 800px;
  height: 550px;
  background-color: #fff;
  border-radius: 12px;
  overflow: hidden;
  animation: zoomIn 0.3s ease;
}

#mapPopup {
  width: 100%;
  height: 100%;
}

.close {
  position: absolute;
  top: 8px;
  right: 14px;
  color: red;
  font-size: 28px;
  font-weight: bold;
  z-index: 10000;
  cursor: pointer;
}

@keyframes zoomIn {
  from {
    transform: scale(0.8);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

#map {
  width: 100%;
  height: 85px; /* wajib ada tinggi */
  border: 1px solid #0B2F57; /* contoh border warna navy */
  border-radius: 8px;         /* biar agak rounded */
  transition: height 0.3s ease;
  margin-left: -20px
}
.calendar-popup {
  position: absolute;
  top: 100%;
  left: 0;
  margin-top: 5px;
  background: white;
  border: 1px solid #ccc;
  padding: 1em;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
  z-index: 10;
  width: 250px;
}

.hidden {
  display: none;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5em;
}

.calendar-days, .calendar-dates {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  text-align: center;
  gap: 0.3em;
}

.calendar-dates div {
  padding: 6px;
  cursor: pointer;
  border-radius: 4px;
}

.calendar-dates div:hover {
  background-color: #0B2E57;
  color: white;
}
.calendar-header button#prev-month,
.calendar-header button#next-month {
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  color: #fff;
  background-color: #0B2E57;
  border: none;
  padding: 6px 12px;
  margin: 0 5px;
  border-radius: 6px;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  transition: background-color 0.3s ease;
}

.calendar-header button#prev-month:hover,
.calendar-header button#next-month:hover {
  background-color: #0a264a;
}
.close-btn {
  background: none;
  border: none;
  font-size: 1em;
  cursor: pointer;
  color: red;
}
.calendar-footer {
  display: flex;
  justify-content: flex-end;
  padding: 10px;
}

.done-btn {
  background-color: #0B2E57;
  color: #fff;
  padding: 8px 16px;
  border-radius: 8px;
  font-size: 14px;
  border: none;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

.done-btn:hover {
  background-color: #0a264a;
}
</style>
<!-- Leaflet JS -->
<script
  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""
></script>
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
      <a href="post_job.html" class="nav-item">
        <img src="icons/postjob.png" alt="Post Job Icon" class="icon" />
        <span class="menu-label">Post Job</span>
      </a>
      <a href="#" class="nav-item">
        <img src="icons/chat.png" alt="Chat Icon" class="icon" />
        <span class="menu-label">Chat</span>
      </a>
      <a href="order_history.html" class="nav-item">
        <img src="icons/order-history.png" alt="Order History Icon" class="icon" />
        <span class="menu-label">Order History</span>
      </a>
    </nav>
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
      <div class="user-menu-container" onclick="toggleNotificationMenu()">
        <img src="icons/notifbell.png" alt="Notifikasi" class="custom-icon" />
        <span class="notif-badge">4</span>
      </div>
      <div class="user-menu-container" onclick="toggleUserMenu()">
        <img src="icons/usericon.png" alt="User" class="custom-icon" />
        <i id="arrowIcon" class="fa-solid fa-chevron-down"></i>
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
          <a href="#" class="menu-item" style="text-decoration: none; color: inherit;">
            <img src="icons/favorit.png" alt="Mitra Favorit" class="icon-img" />
            <span>Mitra Favorit</span>
          </a>
          
          <a href="#" class="menu-item" style="text-decoration: none; color: inherit;">
            <img src="icons/money.png" alt="Riwayat Transaksi" class="icon-img" />
            <span>Riwayat Transaksi</span>
          </a>
          
          <a href="post_job.html" class="menu-item" style="text-decoration: none; color: inherit;">
            <img src="icons/Post Job.png" alt="Post Job" class="icon-img" />
            <span>Post Job</span>
          </a>
          
          <a href="#" class="menu-item" style="text-decoration: none; color: inherit;">
            <img src="icons/Vector3.png" alt="Chat" class="icon-img" />
            <span>Chat</span>
          </a>
          
          <a href="order_history.html" class="menu-item" style="text-decoration: none; color: inherit;">
            <img src="icons/Vector1.png" alt="Order History" class="icon-img" />
            <span>Order History</span>
          </a>
          <div class="menu-item logout" id="logoutButton">
            <img src="icons/logout.png" alt="Keluar" class="icon-img" />
            <span>Keluar</span>
          </div>
        </div>
      </div>
    </div>

    <div id="notificationPopup" class="notification-popup hidden">
      <div class="popup-box">
        <div class="notif-header">
          <img src="icons/notifbell.png" alt="Icon" class="notif-header-icon" />
          <span>Notification</span>
        </div>
        <hr class="notif-line" />
        <div class="notif-subtitle" id="notif-count">Result (0)</div>
        <hr class="notif-line" />
        <div class="notif-list hidden" id="notif-list">
          <div class="notif-item">
            <img src="icons/Bell.png" alt="Notif Icon" class="notif-item-icon" />
            <div class="notif-item-content">
              <div class="notif-item-title">Update profil</div>
              <div class="notif-item-desc">Success Update Merubah Profil</div>
            </div>
            <div class="notif-item-time">2 min ago</div>
          </div>
          <div class="notif-item">
            <img src="icons/Bell.png" alt="Notif Icon" class="notif-item-icon" />
            <div class="notif-item-content">
              <div class="notif-item-title">Login Baru</div>
              <div class="notif-item-desc">Login dari perangkat baru berhasil</div>
            </div>
            <div class="notif-item-time">10 min ago</div>
          </div>
          <button id="showAllBtn" class="show-all-btn">Show All Notifications</button>
        </div>
        <div class="notif-icon" id="notif-empty">
          <div class="push-notif-icon">
            <img src="icons/Push Notifications.png" alt="Push Notification Icon" />
          </div>
          <div class="notif-empty">No notifications yet</div>
          <div class="notif-text">Your notification will appear here once you’ve received them</div>
        </div>
      </div>
    </div>
  </header>

  <section class="post-job-container">
    <div class="form-title">Post Job</div>
    <form class="post-job-form" method="POST" action="{{ route('customer.post_job.store') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      @if(auth()->check())
      <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}" />
      @endif
      @if ($errors->any())
        <div class="error-messages" style="color: red; margin-bottom: 1rem;">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter Your Title" />
      </div>

      <div class="form-group">
        <label for="service_category_id">Kategori Layanan</label>
        <select id="service_category_id" name="service_category_id" required>
          <option value="">Pilih Kategori</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>
  
      <div class="form-group">
        <label for="describe">Describe</label>
        <textarea id="describe" name="description" placeholder="Enter Your Describe" rows="3"></textarea>
      </div>
  
      <div class="form-group">
        <label for="location">Location</label>
        <div id="map" class="map-container"></div>
        <input type="hidden" id="latitude" name="latitude" />
        <input type="hidden" id="longitude" name="longitude" />
        <input type="hidden" id="address" name="address" />
      </div>
      <div id="mapModal" class="modal-map">
        <div class="modal-map-content">
          <span class="close" onclick="closeMapModal()">×</span>
          <div id="mapPopup" style="width: 100%; height: 100%;"></div>
        </div>
      </div>
      <div class="form-group">
        <label for="budget">Budget</label>
        <input type="text" id="budget" name="budget" placeholder="Enter Your Budget" />
      </div>
  
      <div class="form-row">
        <div class="form-group">
          <label for="file">Upload File</label>
          <div class="file-upload-box" id="uploadBox">
            <input type="file" id="file" />
            <div class="upload-content">
              <img src="icons/Upload.png" alt="Ikon Upload" style="width: 36px; height: 36px;" /><br />
              <div class="upload-text">
                Drag and Drop Here<br>or
              </div>
              <a href="#">Browse Files</a>
            </div>
            <!-- preview akan muncul di sini -->
          </div>
        </div>
        <div class="form-group small-date" style="position: relative;">
          <label for="custom-date">Date</label>
          <input type="text" id="custom-date" placeholder="YYYY/MM/DD" readonly />
          
          <div id="calendar-container" class="calendar-popup hidden">
            <div class="calendar-header">
              <button type="button" id="prev-month">&lt;</button>
              <span id="month-year">April 2025</span>
              <button type="button" id="next-month">&gt;</button>
              <button type="button" id="close-calendar" class="close-btn">✖</button>
            </div>
        
            <div class="calendar-days">
              <div>Su</div><div>Mo</div><div>Tu</div><div>We</div><div>Th</div><div>Fr</div><div>Sa</div>
            </div>
            <div id="calendar-dates" class="calendar-dates"></div>
        
            <!-- ✅ Tambahan tombol Done -->
            <div class="calendar-footer">
              <button type="button" id="done-calendar" class="done-btn">Done</button>
            </div>
          </div>
        </div>
        
      </div>
  
      <button type="submit" class="submit-button">Post Job</button>
    </form>
  </section>
  </main>
  <script>
  // Peta kecil awal
 // Peta kecil (tidak ada marker)
 const map = L.map('map').setView([-2.5489, 118.0149], 5);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Marker utama di map halaman utama
let mainMarker = null;

// Klik di peta kecil akan buka modal dan update mainMarker
map.on('click', function(e) {
  // Set atau update posisi marker utama
  if (!mainMarker) {
    mainMarker = L.marker(e.latlng).addTo(map).bindPopup('Lokasi dipilih').openPopup();
  } else {
    mainMarker.setLatLng(e.latlng).openPopup();
  }

  // Buka modal dan kirim posisi latlng
  openMapModal(e.latlng);
});

  // Modal map
  let modalMap;
  let modalMarker;

  function openMapModal(latlng) {
    const modal = document.getElementById('mapModal');
    modal.style.display = 'block';

    setTimeout(() => {
      if (!modalMap) {
        modalMap = L.map('mapPopup').setView(latlng, 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(modalMap);

        modalMarker = L.marker(latlng).addTo(modalMap)
          .bindPopup('Lokasi dipilih').openPopup();

        // Klik di modalMap pindah marker & update mainMarker
        modalMap.on('click', function(e) {
          modalMarker.setLatLng(e.latlng).openPopup();

          // Update marker utama di map halaman utama
          if (mainMarker) {
            mainMarker.setLatLng(e.latlng).openPopup();
          } else {
            mainMarker = L.marker(e.latlng).addTo(map).bindPopup('Lokasi dipilih').openPopup();
          }
        });
      } else {
        modalMap.setView(latlng, 13);
        modalMarker.setLatLng(latlng).openPopup();
        modalMap.invalidateSize();
      }
    }, 200); // delay agar div modal muncul dulu sebelum render map
  }

  function closeMapModal() {
    const modal = document.getElementById('mapModal');
    modal.style.display = 'none';
  }

const fileInput = document.getElementById('file');
const uploadBox = document.getElementById('uploadBox');

fileInput.addEventListener('change', function() {
  const file = this.files[0];
  if (!file) return;

  // Sembunyikan konten awal upload
  uploadBox.querySelector('.upload-content').style.display = 'none';

  // Cek apakah file gambar
  if (file.type.startsWith('image/')) {
    const reader = new FileReader();
    reader.onload = function(e) {
      // Tampilkan preview gambar
      let previewImg = uploadBox.querySelector('img.preview');
      if (!previewImg) {
        previewImg = document.createElement('img');
        previewImg.classList.add('preview');
        previewImg.style.maxWidth = '100%';
        previewImg.style.maxHeight = '200px';
        previewImg.style.borderRadius = '10px';
        uploadBox.appendChild(previewImg);
      }
      previewImg.src = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    // Bukan gambar, tampilkan nama file saja
    let previewText = uploadBox.querySelector('.file-name');
    if (!previewText) {
      previewText = document.createElement('div');
      previewText.classList.add('file-name');
      previewText.style.marginTop = '10px';
      previewText.style.fontWeight = 'bold';
      previewText.style.color = '#333';
      uploadBox.appendChild(previewText);
    }
    previewText.textContent = `File: ${file.name}`;
    
    // Hapus preview gambar jika ada
    const previewImg = uploadBox.querySelector('img.preview');
    if (previewImg) previewImg.remove();
  }
});
const input = document.getElementById('custom-date');
const calendar = document.getElementById('calendar-container');
const monthYear = document.getElementById('month-year');
const datesContainer = document.getElementById('calendar-dates');
const closeBtn = document.getElementById('close-calendar');
const prevBtn = document.getElementById('prev-month');
const nextBtn = document.getElementById('next-month');
const doneBtn = document.getElementById('done-calendar');

let selectedDate = null;
let currentMonth = 3; // April (0-based index)
let currentYear = 2025;

input.addEventListener('click', () => {
  calendar.classList.remove('hidden');
  renderCalendar(currentYear, currentMonth);
});
doneBtn.addEventListener('click', () => {
  if (selectedDate) {
    const yyyy = selectedDate.getFullYear();
    const mm = String(selectedDate.getMonth() + 1).padStart(2, '0');
    const dd = String(selectedDate.getDate()).padStart(2, '0');
    input.value = `${yyyy}/${mm}/${dd}`;
  }
  calendar.classList.add('hidden');
});
closeBtn.addEventListener('click', () => {
  calendar.classList.add('hidden');
  if (selectedDate) {
    const yyyy = selectedDate.getFullYear();
    const mm = String(selectedDate.getMonth() + 1).padStart(2, '0');
    const dd = String(selectedDate.getDate()).padStart(2, '0');
    input.value = `${yyyy}/${mm}/${dd}`;
  }
});

prevBtn.addEventListener('click', (e) => {
  e.preventDefault();
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar(currentYear, currentMonth);
});

nextBtn.addEventListener('click', (e) => {
  e.preventDefault();
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar(currentYear, currentMonth);
});

function renderCalendar(year, month) {
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  const startDay = new Date(year, month, 1).getDay();

  monthYear.textContent = `${getMonthName(month)} ${year}`;
  datesContainer.innerHTML = '';

  for (let i = 0; i < startDay; i++) {
    const empty = document.createElement('div');
    datesContainer.appendChild(empty);
  }

  for (let day = 1; day <= daysInMonth; day++) {
    const dateDiv = document.createElement('div');
    dateDiv.textContent = day;
    dateDiv.addEventListener('click', () => {
  selectedDate = new Date(year, month, day);
  const yyyy = selectedDate.getFullYear();
  const mm = String(selectedDate.getMonth() + 1).padStart(2, '0');
  const dd = String(selectedDate.getDate()).padStart(2, '0');
  input.value = `${yyyy}/${mm}/${dd}`;
  calendar.classList.add('hidden');
});

    datesContainer.appendChild(dateDiv);
  }
}

function getMonthName(monthIndex) {
  const months = [
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
  ];
  return months[monthIndex];
}
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
  function toggleNotificationPopup() {
    const popup = document.getElementById("notificationPopup");
    const notifList = document.getElementById("notif-list");
    const notifEmpty = document.getElementById("notif-empty");
    const notifCount = document.getElementById("notif-count");

    // Toggle tampilan popup
    popup.classList.toggle("hidden");

    // Hitung jumlah notifikasi aktif
    const notifItems = notifList.querySelectorAll(".notif-item");
    const totalNotif = notifItems.length;

    if (totalNotif > 0) {
      notifList.classList.remove("hidden");
      notifEmpty.classList.add("hidden");
      notifCount.textContent = `Result (${totalNotif})`;
    } else {
      notifList.classList.add("hidden");
      notifEmpty.classList.remove("hidden");
      notifCount.textContent = "Result (0)";
    }
  }

  // Menutup popup jika klik di luar
  document.addEventListener("click", function (event) {
    const popup = document.getElementById("notificationPopup");
    const icon = document.querySelector(".notification");

    if (!popup.contains(event.target) && !icon.contains(event.target)) {
      popup.classList.add("hidden");
    }
  });
   // Ambil elemen notif-list dan notif-icon
const notifList = document.getElementById('notif-list');
const notifIcon = document.getElementById('notif-empty');  // div notif-icon idnya notif-empty

// Pasang event click pada notifIcon
notifIcon.addEventListener('click', () => {
  // Sembunyikan notif-icon
  notifIcon.classList.add('hidden');
  // Tampilkan notif-list
  notifList.classList.remove('hidden');
});
document.getElementById("showAllBtn").addEventListener("click", function () {
    // Arahkan ke halaman notifikasi penuh
    window.location.href = "notifications.html";
  });
  </script>
  