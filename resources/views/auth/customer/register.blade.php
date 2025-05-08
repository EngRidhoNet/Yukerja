<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mitra Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f5f7ff;
      color: #333;
      line-height: 1.6;
    }

    .container {
      display: flex;
      min-height: 100vh;
      max-width: 1400px;
      margin: 0 auto;
    }

    .left {
      flex: 1;
      background-color: #1a237e;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    .left img {
      max-width: 90%;
      max-height: 90%;
      object-fit: contain;
      z-index: 2;
    }

    .left::after {
      content: '';
      position: absolute;
      background-color: rgba(255, 255, 255, 0.1);
      width: 500px;
      height: 500px;
      border-radius: 50%;
      top: -200px;
      right: -200px;
      z-index: 1;
    }

    .left::before {
      content: '';
      position: absolute;
      background-color: rgba(255, 255, 255, 0.1);
      width: 400px;
      height: 400px;
      border-radius: 50%;
      bottom: -150px;
      left: -150px;
      z-index: 1;
    }

    .right {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      background-color: white;
    }

    .form-box {
      width: 100%;
      max-width: 500px;
      padding: 2rem;
    }

    .form-box h2 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    .brand {
      color: #1a237e;
      font-weight: 700;
    }

    .form-box p {
      color: #666;
      margin-bottom: 2rem;
      font-size: 0.95rem;
    }

    .form-box a {
      color: #1a237e;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .form-box a:hover {
      text-decoration: underline;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-size: 0.9rem;
      font-weight: 500;
      margin-bottom: 0.5rem;
      color: #444;
    }

    .form-control {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 0.95rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #1a237e;
      box-shadow: 0 0 0 3px rgba(26, 35, 126, 0.2);
      outline: none;
    }

    .form-row {
      display: flex;
      gap: 1rem;
    }

    .form-row .form-group {
      flex: 1;
    }

    .btn {
      width: 100%;
      padding: 0.9rem;
      background-color: #1a237e;
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 1rem;
    }

    .btn:hover {
      background-color: #0e1442;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(26, 35, 126, 0.3);
    }

    .error-text {
      color: #e53935;
      font-size: 0.8rem;
      margin-top: 0.3rem;
    }

    .password-field {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #777;
      user-select: none;
    }

    .file-input-wrapper {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }

    .file-input-label {
      display: block;
      padding: 0.8rem 1rem;
      background-color: #e8eaf6;
      color: #1a237e;
      border-radius: 10px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 500;
      border: 1px dashed #1a237e;
    }

    .file-input-label:hover {
      background-color: #c5cae9;
    }

    .file-input {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }

    .file-name {
      margin-top: 0.5rem;
      font-size: 0.85rem;
      color: #555;
      text-align: center;
    }

    .map-link {
      display: block;
      margin-top: 0.5rem;
      color: #1a237e;
      font-size: 0.85rem;
      text-decoration: none;
    }

    .map-link:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left {
        display: none;
      }

      .right {
        padding: 1rem;
      }

      .form-box {
        padding: 1.5rem;
      }

      .form-row {
        flex-direction: column;
        gap: 0;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Bagian Kiri (Full Image) -->
    <div class="left" style="padding:0;">
      {{-- <img src="{{ asset('images/illustration.png') }}.png') }}') }}" alt="Illustration"
        style="width:100%;height:100%;object-fit:cover;" /> --}}
    </div>

    <!-- Bagian Kanan -->
    <div class="right">
      <div class="form-box">
        <h2><span class="brand">Customer</span> Sign up</h2>
        <p>If you already have an account, <a href="{{ route('login') }}">Login here!</a></p>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
          @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
          </ul>
        </div>
    @endif

        <form method="POST" action="/auth/register/customer" enctype="multipart/form-data">
          @csrf
          <!-- Name -->
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
            @error('name') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
            @error('email') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <div class="password-field">
              <input type="password" name="password" id="password" class="form-control" required>
              <span class="material-icons toggle-password"
                onclick="togglePassword('password', this)">visibility_off</span>
            </div>
            @error('password') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Phone -->
          <div class="form-group">
            <label for="phone">Nomor HP</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" class="form-control"
              placeholder="Contoh: 081234567890">
            @error('phone') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Address -->
          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" rows="3" class="form-control"
              placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
            @error('address') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Location -->
          {{-- <div class="form-group">
            <label>Lokasi</label>
            <div class="form-row">
              <div class="form-group">
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="form-control"
                  placeholder="Latitude">
                @error('latitude') <p class="error-text">{{ $message }}</p> @enderror
              </div>
              <div class="form-group">
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="form-control"
                  placeholder="Longitude">
                @error('longitude') <p class="error-text">{{ $message }}</p> @enderror
              </div>
            </div>
            <a href="https://www.google.com/maps" target="_blank" class="map-link">
              <span class="material-icons" style="font-size: 0.9rem; vertical-align: middle;">place</span>
              Dapatkan koordinat di Google Maps
            </a>
          </div> --}}

          <!-- Identity Card Number -->
          <div class="form-group">
            <label for="identity_card_number">Nomor KTP</label>
            <input type="text" name="identity_card_number" id="identity_card_number"
              value="{{ old('identity_card_number') }}" class="form-control" placeholder="16 digit nomor KTP">
            @error('identity_card_number') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Identity Card Photo -->
          <div class="form-group">
            <label for="identity_card_photo">Foto KTP</label>
            <div class="file-input-wrapper">
              <label for="identity_card_photo" class="file-input-label">
                <span class="material-icons" style="vertical-align: middle; margin-right: 5px;">file_upload</span>
                Pilih File
              </label>
              <input type="file" name="identity_card_photo" id="identity_card_photo" accept="image/*" class="file-input"
                onchange="updateFileName(this)">
            </div>
            <p class="file-name" id="file-name-display">Belum ada file dipilih</p>
            @error('identity_card_photo') <p class="error-text">{{ $message }}</p> @enderror
          </div>

          <!-- Submit -->
          <button type="submit" class="btn">
            Daftar Sekarang
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function togglePassword(fieldId, iconElement) {
      const passwordField = document.getElementById(fieldId);

      if (passwordField.type === "password") {
        passwordField.type = "text";
        iconElement.textContent = "visibility";
      } else {
        passwordField.type = "password";
        iconElement.textContent = "visibility_off";
      }
    }

    function updateFileName(input) {
      const fileNameDisplay = document.getElementById('file-name-display');
      if (input.files && input.files[0]) {
        fileNameDisplay.textContent = input.files[0].name;
      } else {
        fileNameDisplay.textContent = 'Belum ada file dipilih';
      }
    }
  </script>
</body>

</html>