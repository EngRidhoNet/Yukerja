<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Sign Up</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @layer utilities {
      .font-poppins {
        font-family: 'Poppins', sans-serif;
      }
    }
  </style>
</head>

<body class="font-poppins bg-white text-gray-800">
  <div class="min-h-screen flex">
    <!-- Left Section (Full-height Image) -->
    <div class="hidden md:flex w-1/2">
      <img src="{{ asset('images/illustration.png') }}" alt="Illustration" class="w-full h-full object-cover" />
    </div>

    <!-- Right Section (Form) -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-4 md:p-8">
      <div class="w-full max-w-md">
        <h2 class="text-3xl font-semibold text-gray-900 mb-2">Customer Sign up</h2>
        <p class="text-gray-600 mb-8 text-sm md:text-base">
          If you already have an account, 
          <a href="{{ route('login') }}" class="text-indigo-900 font-semibold hover:underline">Login here!</a>
        </p>

        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
          <ul class="text-red-700">
            @foreach ($errors->all() as $error)
            <li class="text-sm">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form method="POST" action="/auth/register/customer" enctype="multipart/form-data" class="space-y-6">
          @csrf
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-900 focus:border-indigo-900 transition">
            @error('name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-900 focus:border-indigo-900 transition">
            @error('email') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>

          <!-- Password -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="relative">
              <input type="password" name="password" id="password" 
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-900 focus:border-indigo-900 transition pr-10">
              <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-500 material-icons toggle-password"
                onclick="togglePassword('password', this)">visibility_off</span>
            </div>
            @error('password') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>

          <!-- Phone -->
          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" 
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-900 focus:border-indigo-900 transition"
              placeholder="Contoh: 081234567890">
            @error('phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>

          <!-- Address -->
          <div>
            <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
            <textarea name="address" id="address" rows="3" 
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-900 focus:border-indigo-900 transition"
              placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
            @error('address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
          </div>

          <!-- Submit -->
          <button type="submit" 
            class="w-full bg-indigo-900 text-white py-3 px-4 rounded-lg font-semibold hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-900 focus:ring-offset-2 transition-all hover:shadow-lg hover:-translate-y-1">
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
  </script>
</body>

</html>