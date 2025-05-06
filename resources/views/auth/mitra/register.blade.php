<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mitra Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css')}}" />
</head>
<body>
  <div class="container">
    <!-- Bagian Kiri -->
    <div class="left">
      <img src="{{asset('images/illustration.png.png')}}" alt="Illustration" />
    </div>

    <!-- Bagian Kanan -->
    <div class="right">
      <div class="form-box">
        <h2><span class="brand">Mitra</span> Sign up</h2>
        <p>If you already have an account register <br> You can <a href="mitra_signin.html">Login here !</a></p>

        {{-- Show errors --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('mitra.register') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Email -->
          <label for="email">Email</label>
          <div class="input-box">
            <span class="icon material-icons">mail</span>
            <input type="email" name="email" id="email" placeholder="Enter your email address('email') }}" required />" value="{{ old
          </div>

          <!-- Name -->
          <label for="name">Full Name</label>
          <div class="input-box">
            <span class="icon material-icons">person</span>
            <input type="text" name="name" id="name" placeholder="Enter your name" value="{{ old('name') }}" required />
          </div>

          <!-- Business Name -->
          <label for="business_name">Company Name</label>
          <div class="input-box">
            <span class="icon material-icons">business</span>
            <input type="text" name="business_name" id="business_name" placeholder="Enter your company name" value="{{ old('business_name') }}" required />
          </div>

          <!-- Password -->
          <label for="password">Password</label>
          <div class="input-box">
            <span class="icon material-icons">lock</span>
            <input type="password" name="password" id="password" placeholder="Enter your password" required />
            <span class="toggle-password material-icons hidden" onclick="togglePassword('password', this)">visibility_off</span>
          </div>

          <!-- Confirm Password -->
          <label for="password_confirmation">Confirm Password</label>
          <div class="input-box">
            <span class="icon material-icons">lock</span>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required />
            <span class="toggle-password material-icons hidden" onclick="togglePassword('password_confirmation', this)">visibility_off</span>
          </div>

          <!-- File Uploads -->
          <label for="identity_card_photo">Identity Card Photo</label>
          <input type="file" name="identity_card_photo" id="identity_card_photo" accept="image/*" required />

          <label for="business_license_photo">Business License Photo</label>
          <input type="file" name="business_license_photo" id="business_license_photo" accept="image/*" required />

          <label for="profile_photo">Profile Photo</label>
          <input type="file" name="profile_photo" id="profile_photo" accept="image/*" />

          <label for="cover_photo">Cover Photo</label>
          <input type="file" name="cover_photo" id="cover_photo" accept="image/*" />

          <!-- Tombol -->
          <button class="btn" type="submit">Register</button>
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
        iconElement.classList.remove("hidden");
      } else {
        passwordField.type = "password";
        iconElement.textContent = "visibility_off";
        iconElement.classList.add("hidden");
      }
    }
  </script>
</body>
</html>