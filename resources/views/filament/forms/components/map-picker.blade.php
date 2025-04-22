<div>
    <div id="map" style="height: 400px; width: 100%;" class="mb-2 rounded-lg border border-gray-300"></div>
    <div class="text-sm text-gray-500 ml-1">Klik pada peta untuk memilih lokasi</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi peta setelah halaman dimuat
        initializeMap();
    });

    function initializeMap() {
        // Periksa apakah elemen peta ada
        const mapElement = document.getElementById('map');
        if (!mapElement) return;
        
        // Periksa apakah Leaflet sudah dimuat
        if (typeof L === 'undefined') {
            // Muat Leaflet jika belum tersedia
            loadLeafletResources().then(() => {
                setupMap();
            });
        } else {
            setupMap();
        }
    }

    function loadLeafletResources() {
        return new Promise((resolve) => {
            // Muat CSS Leaflet
            const cssLink = document.createElement('link');
            cssLink.rel = 'stylesheet';
            cssLink.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
            document.head.appendChild(cssLink);
            
            // Muat JavaScript Leaflet
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
            script.onload = () => resolve();
            document.head.appendChild(script);
        });
    }

    function setupMap() {
        // Default lokasi (pusat Indonesia jika tidak ada nilai yang tersimpan)
        let lat = -2.5489;
        let lng = 118.0149;
        
        // Cek jika ada nilai latitude & longitude yang sudah ada
        const latInput = document.querySelector('[name="latitude"]');
        const lngInput = document.querySelector('[name="longitude"]');
        
        if (latInput && latInput.value && lngInput && lngInput.value) {
            lat = parseFloat(latInput.value);
            lng = parseFloat(lngInput.value);
        }
        
        // Inisialisasi peta
        const map = L.map('map').setView([lat, lng], 5);
        
        // Tambahkan layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Tambahkan marker jika sudah ada nilai
        let marker;
        if (latInput && latInput.value && lngInput && lngInput.value) {
            marker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 13); // Zoom lebih dekat
        }
        
        // Event ketika peta diklik
        map.on('click', function(e) {
            const { lat, lng } = e.latlng;
            
            // Update input fields
            if (latInput) latInput.value = lat;
            if (lngInput) lngInput.value = lng;
            
            // Perbarui atau tambahkan marker
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }
            
            // Dispatch event untuk Livewire
            if (latInput) {
                latInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            if (lngInput) {
                lngInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        });

        // Sesuaikan ukuran peta ketika panel parent berubah atau tab diaktifkan
        const observer = new MutationObserver(() => {
            map.invalidateSize();
        });
        
        // Amati perubahan pada elemen parent
        const tabPanels = document.querySelectorAll('.fi-tab-panel');
        tabPanels.forEach(panel => {
            observer.observe(panel, { attributes: true, attributeFilter: ['class'] });
        });
        
        // Tambahkan ke event tab diklik
        document.querySelectorAll('.fi-tabs button').forEach(tab => {
            tab.addEventListener('click', () => {
                setTimeout(() => map.invalidateSize(), 100);
            });
        });
    }
</script>