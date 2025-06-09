<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerja - Post Job</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .file-upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }
        .file-upload-area:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }
        .file-upload-area.dragover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
        #map {
            height: 200px;
            width: 100%;
            border-radius: 0.5rem;
        }
        .form-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
    </style>
</head>
<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        <!-- Overlay for mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        
        @include('layouts.customer.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <nav class="px-4 py-3 flex items-center justify-between">
                    <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none hover:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Search Bar -->
                    <div class="flex-grow mx-2 md:mx-4 max-w-xl relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        <input type="text" class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base" placeholder="Cari jasa">
                    </div>
                    
                    <!-- Right Side Icons -->
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">1</span>
                        </a>
                        <div class="relative group">
                            <button class="focus:outline-none">
                                <img src="https://via.placeholder.com/32/4B5563/FFFFFF?text=P" alt="Profile" class="rounded-full w-8 h-8">
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan</a>
                                <hr>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Keluar</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto form-container">
                <div class="max-w-4xl mx-auto px-4 py-6 md:py-8">
                    <!-- Page Title -->
                    <div class="mb-8">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Post Job</h1>
                        <p class="text-gray-600">Buat posting pekerjaan baru untuk mendapatkan layanan yang Anda butuhkan</p>
                    </div>

                    <!-- Form Container -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                        <form id="jobForm" class="space-y-6">
                            <!-- Title -->
                            <div class="space-y-2">
                                <label for="title" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-600"></i>Title
                                </label>
                                <input 
                                    type="text" 
                                    id="title" 
                                    name="title"
                                    placeholder="Enter Your Title"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400"
                                    required
                                >
                            </div>

                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-blue-600"></i>Description
                                </label>
                                <textarea 
                                    id="description" 
                                    name="description"
                                    rows="4"
                                    placeholder="Enter Your Description"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400 resize-none"
                                    required
                                ></textarea>
                            </div>

                            <!-- Location and Budget Row -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Location -->
                                <div class="space-y-2">
                                    <label for="location" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Location
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            id="location" 
                                            name="location"
                                            placeholder="Search location..."
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400"
                                            required
                                        >
                                        <button type="button" id="useCurrentLocation" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-crosshairs"></i>
                                        </button>
                                    </div>
                                    <div id="map" class="mt-3 rounded-lg overflow-hidden shadow-md"></div>
                                </div>

                                <!-- Budget -->
                                <div class="space-y-2">
                                    <label for="budget" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-dollar-sign mr-2 text-blue-600"></i>Budget
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                                        <input 
                                            type="number" 
                                            id="budget" 
                                            name="budget"
                                            placeholder="Enter Your Budget"
                                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400"
                                            required
                                        >
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Masukkan budget dalam Rupiah</p>
                                </div>
                            </div>

                            <!-- Upload File and Date Row -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Upload File -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-cloud-upload-alt mr-2 text-blue-600"></i>Upload File
                                    </label>
                                    <div class="file-upload-area p-6 rounded-lg text-center cursor-pointer" id="fileUploadArea">
                                        <input type="file" id="fileInput" name="files" multiple class="hidden" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        <div id="uploadContent">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-blue-500 mb-3"></i>
                                            <p class="text-sm font-medium text-gray-700 mb-1">Drag & Drop files here</p>
                                            <p class="text-xs text-gray-500 mb-2">or</p>
                                            <button type="button" class="text-blue-600 font-medium hover:text-blue-800">Browse Files</button>
                                            <p class="text-xs text-gray-400 mt-2">PNG, JPG, PDF up to 10MB</p>
                                        </div>
                                        <div id="fileList" class="hidden"></div>
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="space-y-2">
                                    <label for="date" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-calendar-alt mr-2 text-blue-600"></i>Date
                                    </label>
                                    <input 
                                        type="date" 
                                        id="date" 
                                        name="date"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700"
                                        required
                                    >
                                    <p class="text-xs text-gray-500 mt-1">Pilih tanggal untuk memulai pekerjaan</p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-6">
                                <button 
                                    type="submit" 
                                    class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300"
                                    style="background-color: #0B2F57; background-image: linear-gradient(135deg, #0B2F57 0%, #1e3a5f 100%);"
                                >
                                    <i class="fas fa-paper-plane mr-2"></i>Post Job
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 transform transition-all duration-300">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Job Posted Successfully!</h3>
                <p class="text-gray-600 mb-6">Your job posting has been created and will be visible to service providers.</p>
                <button id="closeModal" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200">
                    OK
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar functionality
        const menuToggle = document.getElementById('menu-toggle');
        const closeSidebar = document.getElementById('close-sidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebarFn() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        menuToggle.addEventListener('click', openSidebar);
        closeSidebar.addEventListener('click', closeSidebarFn);
        overlay.addEventListener('click', closeSidebarFn);

        // Map functionality
        let map, marker;
        
        function initMap() {
            // Default to Jakarta coordinates
            const defaultLat = -6.2088;
            const defaultLng = 106.8456;
            
            map = L.map('map').setView([defaultLat, defaultLng], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
            
            marker = L.marker([defaultLat, defaultLng]).addTo(map);
            
            map.on('click', function(e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                
                if (marker) {
                    map.removeLayer(marker);
                }
                
                marker = L.marker([lat, lng]).addTo(map);
                
                // Reverse geocoding (simplified)
                document.getElementById('location').value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            });
        }

        // Current location
        document.getElementById('useCurrentLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    map.setView([lat, lng], 15);
                    
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    
                    marker = L.marker([lat, lng]).addTo(map);
                    document.getElementById('location').value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                });
            }
        });

        // File upload functionality
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('fileInput');
        const fileList = document.getElementById('fileList');
        const uploadContent = document.getElementById('uploadContent');

        fileUploadArea.addEventListener('click', () => fileInput.click());

        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            if (files.length > 0) {
                fileList.innerHTML = '';
                uploadContent.classList.add('hidden');
                fileList.classList.remove('hidden');
                
                Array.from(files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 rounded mb-2';
                    fileItem.innerHTML = `
                        <div class="flex items-center">
                            <i class="fas fa-file text-blue-500 mr-2"></i>
                            <span class="text-sm text-gray-700">${file.name}</span>
                        </div>
                        <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                    fileList.appendChild(fileItem);
                });
            }
        }

        function removeFile(index) {
            // Reset file input and show upload area again
            fileInput.value = '';
            uploadContent.classList.remove('hidden');
            fileList.classList.add('hidden');
        }

        // Form submission
        document.getElementById('jobForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
        });

        // Close modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('successModal').classList.add('hidden');
            // Reset form
            document.getElementById('jobForm').reset();
            removeFile(0);
        });

        // Initialize map when page loads
        window.addEventListener('load', initMap);

        // Set minimum date to today
        document.getElementById('date').min = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>