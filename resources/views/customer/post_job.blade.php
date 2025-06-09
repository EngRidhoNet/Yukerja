<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .fa-spinner {
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body class="font-sans bg-gray-100">
    <div class="flex h-screen">
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>
        
        {{-- Anda bisa menyertakan sidebar Anda di sini. Contoh: --}}
        @include('layouts.customer.sidebar')
        
        


        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm">
                <nav class="px-4 py-3 flex items-center justify-between">
                    <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none hover:text-blue-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <div class="flex-grow mx-2 md:mx-4 max-w-xl relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                        <input type="text" class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm md:text-base" placeholder="Cari jasa">
                    </div>
                    
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <a href="#" class="relative">
                            <i class="fas fa-bell text-lg md:text-xl text-gray-600 hover:text-blue-600"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">1</span>
                        </a>
                        <div class="relative group">
                            <button class="focus:outline-none">
                                <img src="https://via.placeholder.com/32/4B5563/FFFFFF?text={{ Auth::user()->name[0] ?? 'U' }}" alt="Profile" class="rounded-full w-8 h-8">
                            </button>
                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan</a>
                                <hr>
                                <a href="{{-- route('logout') --}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Keluar</a>
                                <form id="logout-form" action="{{-- route('logout') --}}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <main class="flex-1 overflow-y-auto form-container">
                <div class="max-w-4xl mx-auto px-4 py-6 md:py-8">
                    <div class="mb-8">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Post Job</h1>
                        <p class="text-gray-600">Buat posting pekerjaan baru untuk mendapatkan layanan yang Anda butuhkan</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
                        <form id="jobForm" action="{{ route('customer.dashboard.post-job.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="space-y-2">
                                <label for="service_category_id" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-list mr-2 text-blue-600"></i>Service Category
                                </label>
                                <select 
                                    id="service_category_id" 
                                    name="service_category_id"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700"
                                    required
                                >
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('service_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('service_category_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="title" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-heading mr-2 text-blue-600"></i>Title
                                </label>
                                <input 
                                    type="text" 
                                    id="title" 
                                    name="title"
                                    placeholder="Contoh: Perbaikan AC Rusak"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400"
                                    value="{{ old('title') }}"
                                    required
                                >
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-align-left mr-2 text-blue-600"></i>Description
                                </label>
                                <textarea 
                                    id="description" 
                                    name="description"
                                    rows="4"
                                    placeholder="Jelaskan detail pekerjaan yang Anda butuhkan..."
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400 resize-none"
                                    required
                                >{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="location-search" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Location
                                    </label>
                                    <div class="relative">
                                        <input 
                                            type="text" 
                                            id="location-search" 
                                            placeholder="Cari lokasi atau klik pada peta..."
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400"
                                        >
                                        <input type="hidden" id="location" name="location" value="{{ old('location') }}">
                                        <input type="hidden" id="location_name" name="location_name" value="{{ old('location_name') }}">
                                        <button type="button" id="useCurrentLocation" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800" title="Gunakan lokasi saat ini">
                                            <i class="fas fa-crosshairs"></i>
                                        </button>
                                    </div>
                                    <div id="map" class="mt-3 rounded-lg overflow-hidden shadow-md"></div>
                                    @error('location')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    @error('location_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

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
                                            placeholder="Masukkan Anggaran Anda"
                                            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700 placeholder-gray-400"
                                            value="{{ old('budget') }}"
                                            required
                                            min="0"
                                        >
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Masukkan budget dalam Rupiah (IDR)</p>
                                    @error('budget')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-cloud-upload-alt mr-2 text-blue-600"></i>Upload File (Opsional)
                                    </label>
                                    <div class="file-upload-area p-6 rounded-lg text-center cursor-pointer" id="fileUploadArea">
                                        <input type="file" id="fileInput" name="files[]" multiple class="hidden" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                        <div id="uploadContent">
                                            <i class="fas fa-cloud-upload-alt text-4xl text-blue-500 mb-3"></i>
                                            <p class="text-sm font-medium text-gray-700 mb-1">Drag & Drop file di sini</p>
                                            <p class="text-xs text-gray-500 mb-2">atau</p>
                                            <button type="button" class="text-blue-600 font-medium hover:text-blue-800">Cari File</button>
                                            <p class="text-xs text-gray-400 mt-2">PNG, JPG, PDF, DOCX (maks 10MB)</p>
                                        </div>
                                        <div id="fileList" class="hidden text-left"></div>
                                    </div>
                                    @error('files.*')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label for="date" class="block text-sm font-semibold text-gray-700">
                                        <i class="fas fa-calendar-alt mr-2 text-blue-600"></i>Tanggal Pelaksanaan
                                    </label>
                                    <input 
                                        type="date" 
                                        id="date" 
                                        name="date"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-gray-700"
                                        value="{{ old('date') }}"
                                        required
                                    >
                                    <p class="text-xs text-gray-500 mt-1">Pilih tanggal untuk memulai pekerjaan.</p>
                                    @error('date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="pt-6">
                                <button 
                                    type="submit" 
                                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 px-6 rounded-lg transition-all duration-200 transform hover:scale-[1.02] hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 flex items-center justify-center"
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

    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Job Berhasil Diposting!</h3>
                <p class="text-gray-600 mb-6">Postingan pekerjaan Anda telah dibuat dan akan dapat dilihat oleh penyedia jasa.</p>
                <button id="closeModal" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200">
                    OK
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sidebar functionality
            const menuToggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            if (menuToggle) {
                menuToggle.addEventListener('click', () => {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            }
            
            // Set minimum date for date input to today
            document.getElementById('date').min = new Date().toISOString().split('T')[0];

            // --- Map Functionality ---
            let map, marker;
            const locationInput = document.getElementById('location');
            const locationNameInput = document.getElementById('location_name');
            const locationSearchInput = document.getElementById('location-search');

            function initMap() {
                const defaultLat = -7.983908; // Default to Malang
                const defaultLng = 112.621391;
                
                let initialLat = defaultLat;
                let initialLng = defaultLng;

                // Initialize with old values if they exist from form validation failure
                @if(old('location'))
                    const oldLocation = "{{ old('location') }}".split(',');
                    if (oldLocation.length === 2) {
                        const lat = parseFloat(oldLocation[0].trim());
                        const lng = parseFloat(oldLocation[1].trim());
                        if (!isNaN(lat) && !isNaN(lng)) {
                            initialLat = lat;
                            initialLng = lng;
                        }
                    }
                @endif

                map = L.map('map').setView([initialLat, initialLng], 13);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                
                marker = L.marker([initialLat, initialLng], { draggable: true }).addTo(map);

                // Update inputs on initial load
                updateLocationInputs(initialLat, initialLng);
                reverseGeocode(initialLat, initialLng);
                
                map.on('click', function(e) {
                    const { lat, lng } = e.latlng;
                    marker.setLatLng([lat, lng]);
                    updateLocationInputs(lat, lng);
                    reverseGeocode(lat, lng);
                });

                marker.on('dragend', function(e) {
                    const { lat, lng } = e.target.getLatLng();
                    updateLocationInputs(lat, lng);
                    reverseGeocode(lat, lng);
                });
            }

            function updateLocationInputs(lat, lng) {
                locationInput.value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }

            function reverseGeocode(lat, lng) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.display_name) {
                            locationNameInput.value = data.display_name;
                            locationSearchInput.value = data.display_name;
                        }
                    })
                    .catch(error => console.error('Error reverse geocoding:', error));
            }

            function searchLocation(query) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=id`) // Prioritize Indonesia
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const { lat, lon, display_name } = data[0];
                            // *** FIX: Convert string coordinates to numbers ***
                            const numericLat = parseFloat(lat);
                            const numericLng = parseFloat(lon);
                            
                            map.setView([numericLat, numericLng], 15);
                            marker.setLatLng([numericLat, numericLng]);
                            updateLocationInputs(numericLat, numericLng);
                            locationNameInput.value = display_name;
                            locationSearchInput.value = display_name;
                        }
                    })
                    .catch(error => console.error('Error searching location:', error));
            }

            document.getElementById('useCurrentLocation').addEventListener('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        
                        map.setView([lat, lng], 15);
                        marker.setLatLng([lat, lng]);
                        updateLocationInputs(lat, lng);
                        reverseGeocode(lat, lng);
                    }, function(error) {
                        alert('Error: ' + error.message);
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });

            let searchTimeout;
            locationSearchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value;
                if (query.length > 3) {
                    searchTimeout = setTimeout(() => {
                        searchLocation(query);
                    }, 1000); // Wait 1 second after user stops typing
                }
            });

            initMap();

            // --- File Upload Functionality ---
            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileInput = document.getElementById('fileInput');
            const fileList = document.getElementById('fileList');
            const uploadContent = document.getElementById('uploadContent');

            fileUploadArea.addEventListener('click', () => fileInput.click());
            fileUploadArea.querySelector('button').addEventListener('click', (e) => {
                e.stopPropagation(); // prevent triggering the area click
                fileInput.click();
            });

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, e => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            ['dragenter', 'dragover'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => fileUploadArea.classList.add('dragover'));
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => fileUploadArea.classList.remove('dragover'));
            });

            fileUploadArea.addEventListener('drop', (e) => {
                fileInput.files = e.dataTransfer.files;
                handleFiles(fileInput.files);
            });

            fileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
            });

            window.handleFiles = function(files) {
                if (files.length > 0) {
                    fileList.innerHTML = '';
                    uploadContent.classList.add('hidden');
                    fileList.classList.remove('hidden');
                    
                    Array.from(files).forEach((file, index) => {
                        const fileSize = (file.size / (1024 * 1024)).toFixed(2); // MB
                        const fileItem = document.createElement('div');
                        fileItem.className = 'flex items-center justify-between p-2 bg-gray-50 rounded mb-2';
                        fileItem.innerHTML = `
                            <div class="flex items-center overflow-hidden">
                                <i class="fas fa-file-alt text-blue-500 mr-3 flex-shrink-0"></i>
                                <div class="truncate">
                                    <p class="text-sm text-gray-700 truncate">${file.name}</p>
                                    <p class="text-xs text-gray-500">${fileSize} MB</p>
                                </div>
                            </div>
                            <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700 ml-2">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        fileList.appendChild(fileItem);
                    });
                } else {
                    uploadContent.classList.remove('hidden');
                    fileList.classList.add('hidden');
                }
            }

            window.removeFile = function(index) {
                const dataTransfer = new DataTransfer();
                const files = fileInput.files;
                
                for (let i = 0; i < files.length; i++) {
                    if (i !== index) {
                        dataTransfer.items.add(files[i]);
                    }
                }
                
                fileInput.files = dataTransfer.files;
                handleFiles(fileInput.files);
            }

            // --- Form Submission ---
            document.getElementById('jobForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Posting...';
                
                // Clear previous errors
                this.querySelectorAll('.text-red-500').forEach(el => el.remove());

                const formData = new FormData(this);
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    if (status === 422) { // Validation Error
                        console.error('Validation Error:', body.errors);
                        Object.keys(body.errors).forEach(key => {
                            const field = key.split('.')[0]; // Handle array fields like 'files.*'
                            const input = document.querySelector(`[name="${field}"], [name="${field}[]"]`);
                            if (input) {
                                const errorElement = document.createElement('p');
                                errorElement.className = 'text-red-500 text-xs mt-1';
                                errorElement.textContent = body.errors[key][0];
                                const parent = input.closest('.space-y-2');
                                if(parent) parent.appendChild(errorElement);
                            }
                        });
                        alert('Terdapat kesalahan pada input Anda. Silakan periksa kembali.');

                    } else if (status >= 400) { // Other Server Error
                        console.error('Server Error:', body);
                        alert('Gagal memposting job: ' + (body.message || 'Terjadi kesalahan pada server.'));
                    } else { // Success
                        const successModal = document.getElementById('successModal');
                        successModal.classList.remove('hidden');
                        setTimeout(() => successModal.querySelector('.transform').classList.add('scale-100', 'opacity-100'), 10);
                    }
                })
                .catch(error => {
                    console.error('Network Error:', error);
                    alert('Gagal memposting job. Periksa koneksi internet Anda.');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Post Job';
                });
            });

            // Close modal
            document.getElementById('closeModal').addEventListener('click', function() {
                // Redirect after success
                window.location.href = "{{ route('customer.dashboard') }}";
            });
        });
    </script>
</body>
</html>