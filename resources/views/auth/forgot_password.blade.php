<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Mitra</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    /* Additional styles */
    .error-message {
      color: #e53e3e;
      font-size: 12px;
      margin: 10px 0 20px 0;
      display: none;
      text-align: left;
      padding-left: 10px;
    }
    .divider {
      height: 1px;
      background-color: #e0e0e0;
      margin: 20px 0;
    }
    .success-message {
      color: #165097;
      text-align: center;
      margin: 20px 0;
      font-weight: 600;
    }
    .email-confirmation {
      margin-bottom: 30px;
      text-align: center;
    }
    .email-confirmation h3 {
      font-size: 16px;
      margin-bottom: 10px;
      color: #333;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .email-confirmation p {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
    }
    #userEmail {
      font-weight: 600;
      color: #333;
    }
    .email-icon {
      font-size: 60px;
      color: #165097;
      margin: 20px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="{{asset('images/illustration.png.png')}}" alt="Illustration" />
    </div>
    <div class="right">
      <!-- Initial Form (shown by default) -->
      <div class="form-box" id="forgotPasswordFormBox">
        <h2><span class="brand"></span> Reset Your Password</h2>
        <p style="color: #165097;">Please enter your email and we will<br>send an OTP code in the next step to<br>reset your password</p>
        
        <form id="forgotPasswordForm">
          <label for="email">Email</label>
          <div class="input-box">
            <i class="fa-solid fa-envelope icon"></i>
            <input type="email" id="emailInput" placeholder="Enter your email address" required>
          </div>
          <div class="error-message" id="emailError">No user with the entered email address.</div>

          <button type="submit" class="btn">Continue</button>
        </form>
      </div>

      <!-- Success Message (hidden by default) -->
<div class="form-box" id="emailSentBox" style="display: none;">
  <div style="background-color: #DFF6DD; border-radius: 8px; padding: 16px 20px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
    <div style="flex-shrink: 0;">
      <img src="{{asset('icons/Check Mark.png')}}" alt="Success" style="width: 24px; height: 24px;">
    </div>
    <p style="margin: 0; color: #2E7D32; font-family: 'Poppins', sans-serif; font-size: 14px;">
      <strong>Email Sent.</strong> Please check your inbox.
    </p>
  </div>

  <h2><span class="brand"></span> RESET PASSWORD EMAIL SENT</h2>

  <div class="email-confirmation">
    <p>An email containing instructions to reset<br>
    password has been sent to<br>
    '<span id="userEmail"></span>'</p>
    <img src="{{asset('icons/Received.png')}}" alt="Success">
  </div>

  <button class="btn" onclick="window.location.href='reset_password.html'">Continue</button>
</div>


  <script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('emailInput').value;
      const emailError = document.getElementById('emailError');
      
      // Hide error message initially
      emailError.style.display = 'none';
      
      // Simulate email validation (replace with actual API call)
      const validEmails = ['user@example.com', 'registered@mitra.com'];
      
      if (!validEmails.includes(email)) {
        // Show error if email not found
        emailError.style.display = 'block';
      } else {
        // Show success message
        document.getElementById('forgotPasswordFormBox').style.display = 'none';
        document.getElementById('emailSentBox').style.display = 'block';
        document.getElementById('userEmail').textContent = email;
      }
    });
  </script>
</body>
</html>