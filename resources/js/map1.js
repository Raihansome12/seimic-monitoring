document.addEventListener('DOMContentLoaded', function() {
    // Initialize map
    const map = L.map('map').setView([
        {{ $location->latitude ?? -6.17 }}, 
        {{ $location->longitude ?? 106.82 }}
    ], 13);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // Add marker for station location
    let marker = L.marker([
        {{ $location->latitude ?? -6.17 }}, 
        {{ $location->longitude ?? 106.82 }}
    ]).addTo(map);
    
    // Update on new GPS data
    document.addEventListener('gps-location-updated', function(e) {
        const location = e.detail;
        
        // Update marker position
        marker.setLatLng([location.latitude, location.longitude]);
        
        // Center map on new position
        map.setView([location.latitude, location.longitude], 13);
        
        // Update time display
        document.getElementById('location-time').textContent = 
            'Tangerang, Banten | ' + new Date().toLocaleString() + ' UTC+7';
    });
});