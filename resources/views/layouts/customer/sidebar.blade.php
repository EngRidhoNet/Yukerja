<!-- Sidebar -->
<div id="sidebar" class="text-white w-64 min-h-screen transition-transform duration-300 ease-in-out fixed md:static z-50 -translate-x-full md:translate-x-0" style="background-color: #0B2F57;">
    <div class="p-4" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="flex items-center justify-between">
            <img src="{{ asset('images/yuk-kerja-logo.png') }}" alt="YukKerja Logo" class="h-10">
            <button id="close-sidebar" class="md:hidden text-white focus:outline-none hover:text-gray-300">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
    </div>
    <nav class="mt-4">
        <ul>
            <li>
                <a href="{{ route('customer.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-opacity-10 hover:bg-white transition-colors duration-200 {{ request()->routeIs('customer.dashboard') ? 'border-r-4 border-blue-400 bg-white bg-opacity-10' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('customer.dashboard.post-job') }}" class="flex items-center px-4 py-3 hover:bg-opacity-10 hover:bg-white transition-colors duration-200 {{ request()->routeIs('customer.dashboard.post-job') ? 'border-r-4 border-blue-400 bg-white bg-opacity-10' : '' }}">
                    <i class="fas fa-briefcase mr-3"></i> Post Job
                </a>
            </li>
            <li>
                <a href="{{ route('customer.dashboard.penawaran') }}" class="flex items-center px-4 py-3 hover:bg-opacity-10 hover:bg-white transition-colors duration-200 {{ request()->routeIs('customer.dashboard.penawaran') ? 'border-r-4 border-blue-400 bg-white bg-opacity-10' : '' }}">
                    <i class="fas fa-gift mr-3"></i> Job Offering
                </a>
            </li>
            <li>
                <a href="{{ route('customer.dashboard.history') }}" class="flex items-center px-4 py-3 hover:bg-opacity-10 hover:bg-white transition-colors duration-200 {{ request()->routeIs('customer.dashboard.history') ? 'border-r-4 border-blue-400 bg-white bg-opacity-10' : '' }}">
                    <i class="fas fa-history mr-3"></i> Order History
                </a>
            </li>
            <li class="mt-8 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left px-4 py-3 hover:bg-red-600 text-red-200 hover:text-white transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </li>
            
        </ul>
    </nav>
</div>