<div class="bg-gray-50 rounded-lg p-6 shadow">
    <div class="flex items-center space-x-1 mb-3">
        <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-blink"></span>
        <span class="font-semibold text-gray-900">Location: </span>
        <span class="text-gray-900"> Tangerang, Banten| <span id="time"></span> </span>
    </div> 
    <script src="{{ asset('js/time.js') }}"></script>

    <!-- Container Peta -->
    <div id="map" class="w-full h-48 rounded-lg"></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener("livewire:load", () => {
            var map = L.map('map').setView([@this.latitude, @this.longitude], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([@this.latitude, @this.longitude]).addTo(map)
                .bindPopup('Lokasi Terbaru')
                .openPopup();

            Livewire.on('updateGpsLocation', (lat, lng) => {
                marker.setLatLng([lat, lng]).bindPopup('Lokasi Terbaru').openPopup();
                map.setView([lat, lng], 12);
            });
        });
    </script>
    
    <!-- Leaflet JS -->
    {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var map = L.map('map').setView([{{ $location['latitude'] }}, {{ $location['longitude'] }}], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([{{ $location['latitude'] }}, {{ $location['longitude'] }}]).addTo(map)
                .bindPopup("Current Location: {{ $city }}").openPopup();

            Livewire.on('gps-location-updated', (newLocation) => {
                marker.setLatLng([newLocation.latitude, newLocation.longitude])
                    .bindPopup("Updated Location")
                    .openPopup();
                map.setView([newLocation.latitude, newLocation.longitude], 12);
            });
        });
    </script> --}}
</div>
