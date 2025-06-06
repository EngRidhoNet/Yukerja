<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mitra Sign In</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="{{asset('images/illustration.png') }}" alt="Illustration" />
    </div>
    <div class="right">
      <div class="form-box">
        <h2><span class="brand">Mitra</span> Sign in</h2>
        <p>If you don't have an account register<br>
          You can <a href="mitra_signup.html">Register here !</a>
        </p>
        <form>
          <label for="email">Email</label>
          <div class="input-box">
            <i class="fa-solid fa-envelope icon"></i>
            <input type="email" id="email" placeholder="Enter your email address" required>
          </div>

          <label for="password">Kata Sandi</label>
          <div class="input-box">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" id="password" placeholder="Enter your Password" required>
            <span class="toggle-password" id="toggle-password"><i class="fa-solid fa-eye-slash" style="color: black;"></i></span>
          </div>

          <div class="options">
            <label><input type="checkbox"> Remember me</label>
            <a href="forgot_password.html">Forgot your Password?</a>
          </div>

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

    togglePassword.addEventListener('click', function() {
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