<div class="bg-gray-50 rounded-lg p-6 shadow">
    <div class="flex items-center space-x-1 mb-3">
        <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-blink"></span>
        <span class="font-semibold text-gray-900">Location: </span>
        <span class="text-gray-900"> {{ $city }} | <span id="time"></span> </span>
    </div> 
    <script src="{{ asset('js/time.js') }}"></script>

    <!-- Container Peta -->
    <div id="map" class="w-full h-48 rounded-lg"></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var locationData = @json($location); 
        var map = L.map('map').setView([locationData.latitude, locationData.longitude], 7);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    
        var marker = L.marker([locationData.latitude, locationData.longitude]).addTo(map)
            .bindPopup("Current Location")
            .openPopup();
    
        // Listen for Livewire event to update the map
        window.addEventListener('gps-location-updated', event => {
            var newLocation = event.detail;
            marker.setLatLng([newLocation.latitude, newLocation.longitude])
                  .bindPopup("Updated Location")
                  .openPopup();
            map.setView([newLocation.latitude, newLocation.longitude], 13);
        });
    </script>

</div>
