<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Sign In</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    .brand {
      color: #1a237e;
      /* Dark blue color */
    }

    .toggle-password {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="left">
      <img src="{{asset('images/illustration.png.png')}}" alt="Illustration" />
    </div>
    <div class="right">
      <div class="form-box">
        <h2><span class="brand"></span> Sign in</h2>
        <p>If you don't have an account register<br>
          You can <a href="{{ route('customer.register') }}">Register here !</a>
        </p>
        <form method="POST" action="{{ route('auth.login') }}">
          @csrf

          {{-- Email --}}
          <label for="email">Email</label>
          <div class="input-box">
            <i class="fa-solid fa-envelope icon"></i>
            <input type="email" name="email" id="email" placeholder="Enter your email address"
              value="{{ old('email') }}" required>
          </div>
          @error('email')
        <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror

          {{-- Password --}}
          <label for="password">Kata Sandi</label>
          <div class="input-box">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" name="password" id="password" placeholder="Enter your Password" required>
            <span class="toggle-password" id="toggle-password">
              <i class="fa-solid fa-eye-slash" style="color: black;"></i>
            </span>
          </div>
          @error('password')
        <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror

          {{-- Opsional: Remember Me --}}
          <div class="options">
            <label><input type="checkbox" name="remember"> Remember me</label>
            {{-- <a href="{{ route('password.request') }}">Forgot your Password?</a> --}}
          </div>

          {{-- Submit --}}
          <button type="submit" class="btn">Login</button>
        </form>


        <!-- Added section for social login -->
        <div class="social-login">
          <p>or continue with</p>
          <div class="social-icons">
            <a href="#" class="social-icon facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="#" class="social-icon apple"><i class="fa-brands fa-apple"></i></a>
            <a href="#" class="social-icon google"><i class="fa-brands fa-google"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      // Toggle the type of the password field
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;

      // Toggle the eye icon
      const icon = togglePassword.querySelector('i');
      if (type === 'password') {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });
  </script>
</body>

</html>