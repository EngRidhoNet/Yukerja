<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    ul, li {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .success-box {
      text-align: center;
      padding: 40px;
      display: none; 
    }

    .success-box img {
      width: 120px;
      margin: 20px 0;
    }

    .success-box h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .success-box p {
      color: #666;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="left">
      <img src="{{asset('images/illustration.png') }}.png') }}')}}" alt="Illustration" />
    </div>
    
    <div class="right">
      <div class="form-box">
        <h2>Reset Password</h2>
        <p>Please enter your new password.</p>

        <form>
          <label for="new-password">New Password</label>
          <div class="input-box">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" id="new-password" placeholder="Enter new password" required>
            <span class="toggle-password" id="toggle-new-password">
              <i class="fa-solid fa-eye-slash" style="color: black;"></i>
            </span>
          </div>

          <label for="confirm-password">Re-enter New Password</label>
          <div class="input-box">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" id="confirm-password" placeholder="Re-enter new password" required>
            <span class="toggle-password" id="toggle-confirm-password">
              <i class="fa-solid fa-eye-slash" style="color: black;"></i>
            </span>
          </div>

          <button type="button" class="btn" id="continue-btn">Continue</button>
        </form>

        <br>
        <div class="password-rules">
          <strong>Your new password must follow these rules</strong>
          <ul class="rules-list">
            <li><i class="fa-solid fa-circle-check" style="color: green;"></i> Having at least 8 characters</li>
            <li><i class="fa-solid fa-circle-check" style="color: green;"></i> Includes at least one digit (0-9)</li>
            <li><i class="fa-solid fa-circle-check" style="color: green;"></i> Includes at least one lowercase letter (a-z)</li>
            <li><i class="fa-solid fa-circle-check" style="color: green;"></i> Includes at least one uppercase letter (A-Z)</li>
            <li><i class="fa-solid fa-circle-check" style="color: green;"></i> Includes at least one special character (e.g. !, $, #, %, *)</li>
            <li><i class="fa-solid fa-circle-check" style="color: green;"></i> Match your re-entered password</li>
          </ul>
        </div>
      </div>

      <!-- Success Message -->
      <div class="success-box">
        <h2>Password Updated!</h2>
        <p>Please wait. You will be directed to the homepage</p>
        <img src="{{asset('{{asset('icons/Approval.png') }}')}}" alt="Success"> <!-- Ganti /images/checkmark.png') }} sesuai lokasi icon centang -->
        <br>
        <button class="btn" onclick="window.location.href='mitra_signin.html'">Return to Login</button>
      </div>

    </div>
  </div>

  <script>
    // Toggle untuk new password
    const toggleNewPassword = document.getElementById('toggle-new-password');
    const newPasswordField = document.getElementById('new-password');
    toggleNewPassword.addEventListener('click', function() {
      const type = newPasswordField.type === 'password' ? 'text' : 'password';
      newPasswordField.type = type;
      const icon = toggleNewPassword.querySelector('i');
      if (type === 'password') {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });

    // Toggle untuk confirm password
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    const confirmPasswordField = document.getElementById('confirm-password');
    toggleConfirmPassword.addEventListener('click', function() {
      const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
      confirmPasswordField.type = type;
      const icon = toggleConfirmPassword.querySelector('i');
      if (type === 'password') {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    });

    // Logic untuk Continue
    const continueBtn = document.getElementById('continue-btn');
    const formBox = document.querySelector('.form-box');
    const successBox = document.querySelector('.success-box');

    continueBtn.addEventListener('click', function() {
      formBox.style.display = 'none';
      successBox.style.display = 'block';
    });
  </script>
</body>
</html>