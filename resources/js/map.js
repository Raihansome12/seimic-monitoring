// Ambil elemen peta
var mapElement = document.getElementById('map');

//Baca data posisi dari maps.blade.php
var latitude = parseFloat(mapElement.dataset.lat);
var longitude = parseFloat(mapElement.dataset.lng);
var station = mapElement.dataset.stat;

// Inisialisasi peta
var map = L.map('map').setView([latitude, longitude], 10);

// Tambahkan tile layer OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Placeholder marker awal
var marker = L.marker([latitude, longitude]).addTo(map)
    .bindPopup('IA.STMKG..SHZ')
    .openPopup();

// Fungsi untuk update marker berdasarkan data GPS real-time
function updateMarker(lat, lng) {
    marker.setLatLng([lat, lng])
          .bindPopup('Lokasi Terbaru')
          .openPopup();
    map.setView([lat, lng], 12);
}
