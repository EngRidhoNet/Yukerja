<!-- Navbar -->
<nav class="bg-white shadow-md fixed w-full z-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="#" class="flex-shrink-0 flex items-center">
                    <img class="h-12 w-auto" src="{{ asset('images/yuk-kerja-logo.png') }}" alt="Yuk Kerja Logo">
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('main') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Home</a>
                <a href="{{ route('about') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">About</a>
<<<<<<< HEAD
=======
                <a href="{{ route('mitra') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Mitra</a>
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
                
                <!-- Dropdown for Registration -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300 flex items-center">
                        Daftar
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200" 
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-75" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-100">
                        <a href="{{ route('customer.register') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-yellow-50 transition duration-300">Daftar sebagai Customer</a>
                        <a href="{{ route('mitra.register') }}" class="block px-4 py-2 text-sm text-blue-900 hover:bg-yellow-50 transition duration-300">Daftar sebagai Mitra</a>
                    </div>
                </div>
                
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="bg-blue-900 hover:bg-blue-800 text-white font-bold px-6 py-3 rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">Masuk</a>
            </div>
            
            <!-- Mobile menu button -->
            <div class="flex md:hidden items-center">
                <button type="button" class="text-gray-600 hover:text-blue-900 focus:outline-none" @click="open = !open">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="open" x-transition:enter="transition ease-out duration-200" 
             x-transition:enter-start="opacity-0 scale-95" 
             x-transition:enter-end="opacity-100 scale-100" 
             x-transition:leave="transition ease-in duration-75" 
             x-transition:leave-start="opacity-100 scale-100" 
             x-transition:leave-end="opacity-0 scale-95"
             style="display: none;">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white shadow-lg">
<<<<<<< HEAD
                <a href="{{ route('main') }}" class="block px-3 py-2 text-blue-900 font-medium hover:text-yellow-500">Home</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 text-blue-900 font-medium hover:text-yellow-500">About</a>
=======
                <a href="{{ route('main') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Home</a>
                <a href="{{ route('about') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">About</a>
                <a href="{{ route('mitra') }}" class="text-blue-900 font-medium hover:text-yellow-500 transition duration-300">Mitra</a>
>>>>>>> 858d9bc7d86d9615eeead35b103e5a9692175ec1
                <div class="px-3 py-2">
                    <button class="text-blue-900 font-medium flex items-center w-full justify-between" @click="registerOpen = !registerOpen">
                        Daftar
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': registerOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="mt-2 pl-4 space-y-2" x-show="registerOpen" x-transition>
                        <a href="{{ route('customer.register') }}" class="block px-3 py-2 text-sm text-blue-900 hover:text-yellow-500">Daftar Customer</a>
                        <a href="{{ route('mitra.register') }}" class="block px-3 py-2 text-sm text-blue-900 hover:text-yellow-500">Daftar Mitra</a>
                    </div>
                </div>
                <a href="{{ route('login') }}" class="block px-3 py-2 text-blue-900 font-medium hover:text-yellow-500">Masuk</a>
            </div>
        </div>
    </div>
</nav>

<!-- Alpine JS -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>