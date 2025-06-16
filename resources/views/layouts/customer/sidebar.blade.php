<!-- Sidebar -->
<div id="sidebar" class="text-white w-64 min-h-screen transition-transform duration-300 ease-in-out fixed md:static z-50 -translate-x-full md:translate-x-0 shadow-2xl" style="background: linear-gradient(180deg, #0B2F57 0%, #1a4480 100%);">
    <!-- Header -->
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <!-- Logo dengan ukuran proporsional -->
                    <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="YukKerja Logo" class="h-10 w-auto rounded-lg shadow-lg object-contain">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-lg blur opacity-30 animate-pulse"></div>
                </div>
                <div>
                    <span class="text-xl font-bold tracking-wide text-white animate-fade-in">Yukerja</span>
                    <p class="text-xs text-blue-200 font-medium">Customer Portal</p>
                </div>
            </div>
            <button id="close-sidebar" class="md:hidden text-white/80 hover:text-white focus:outline-none transition-colors p-2 rounded-lg hover:bg-white/10">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
    </div>

    <style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @keyframes slide-in {
        from { opacity: 0; transform: translateX(-20px);}
        to { opacity: 1; transform: translateX(0);}
    }
    .animate-fade-in {
        animation: fade-in 0.8s ease;
    }
    .menu-item {
        animation: slide-in 0.5s ease forwards;
        opacity: 0;
    }
    .menu-item:nth-child(1) { animation-delay: 0.1s; }
    .menu-item:nth-child(2) { animation-delay: 0.2s; }
    .menu-item:nth-child(3) { animation-delay: 0.3s; }
    .menu-item:nth-child(4) { animation-delay: 0.4s; }
    .menu-item:nth-child(5) { animation-delay: 0.5s; }
    </style>

    <!-- Navigation -->
    <nav class="mt-2 px-3">
        <ul class="space-y-1">
            <li class="menu-item">
                <a href="{{ route('customer.dashboard') }}" class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 relative overflow-hidden {{ request()->routeIs('customer.dashboard') ? 'bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border-r-4 border-blue-400 shadow-lg' : '' }}">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg {{ request()->routeIs('customer.dashboard') ? 'bg-blue-400/20 text-blue-300' : 'bg-white/10 text-white/80 group-hover:text-white' }} transition-colors">
                            <i class="fas fa-tachometer-alt text-sm"></i>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('customer.dashboard.post-job') }}" class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 relative overflow-hidden {{ request()->routeIs('customer.dashboard.post-job') ? 'bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border-r-4 border-blue-400 shadow-lg' : '' }}">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg {{ request()->routeIs('customer.dashboard.post-job') ? 'bg-blue-400/20 text-blue-300' : 'bg-white/10 text-white/80 group-hover:text-white' }} transition-colors">
                            <i class="fas fa-briefcase text-sm"></i>
                        </div>
                        <span class="font-medium">Post Job</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('customer.dashboard.penawaran') }}" class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 relative overflow-hidden {{ request()->routeIs('customer.dashboard.penawaran') ? 'bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border-r-4 border-blue-400 shadow-lg' : '' }}">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg {{ request()->routeIs('customer.dashboard.penawaran') ? 'bg-blue-400/20 text-blue-300' : 'bg-white/10 text-white/80 group-hover:text-white' }} transition-colors">
                            <i class="fas fa-gift text-sm"></i>
                        </div>
                        <span class="font-medium">Job Offering</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('customer.dashboard.history') }}" class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 relative overflow-hidden {{ request()->routeIs('customer.dashboard.history') ? 'bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border-r-4 border-blue-400 shadow-lg' : '' }}">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg {{ request()->routeIs('customer.dashboard.history') ? 'bg-blue-400/20 text-blue-300' : 'bg-white/10 text-white/80 group-hover:text-white' }} transition-colors">
                            <i class="fas fa-history text-sm"></i>
                        </div>
                        <span class="font-medium">Order History</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ url('/chatify') }}" class="group flex items-center px-4 py-3 rounded-xl hover:bg-white/10 transition-all duration-300 relative overflow-hidden {{ request()->is('chatify*') ? 'bg-gradient-to-r from-blue-500/20 to-cyan-500/20 border-r-4 border-blue-400 shadow-lg' : '' }}">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg {{ request()->is('chatify*') ? 'bg-blue-400/20 text-blue-300' : 'bg-white/10 text-white/80 group-hover:text-white' }} transition-colors">
                            <i class="fas fa-comments text-sm"></i>
                        </div>
                        <span class="font-medium">Chat</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-white/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout Section -->
    <div class="absolute bottom-0 left-0 right-0 p-3">
        <div class="border-t border-white/10 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="group flex items-center w-full px-4 py-3 rounded-xl hover:bg-red-500/20 text-red-200 hover:text-white transition-all duration-300 relative overflow-hidden">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 rounded-lg bg-red-500/20 text-red-300 group-hover:bg-red-500/30 transition-colors">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </div>
                        <span class="font-medium">Logout</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent to-red-500/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </button>
            </form>
        </div>
    </div>
</div>