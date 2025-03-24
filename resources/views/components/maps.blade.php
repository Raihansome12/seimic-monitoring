@props(['position'])

<div class="bg-gray-50 rounded-lg p-6 shadow">
    <div class="flex items-center space-x-1 mb-3">
        <span class="w-2.5 h-2.5 bg-red-600 rounded-full animate-blink"></span>
        <span class="font-semibold text-gray-900">Location: </span>
        <span id="time" class="text-gray-900">Loading...</span>
    </div> 
    <!-- Tambahkan link ke file time.js -->
    <script src="{{ asset('js/time.js') }}"></script>

    <!-- Container Peta -->
    <div id="map" class="w-full h-48 rounded-lg"
        data-lat="{{ $position['latitude'] }}"
        data-lng="{{ $position['longitude'] }}">
    </div>
    <!-- Leaflet JS + Script Custom -->
    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    @endpush
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>
</div>