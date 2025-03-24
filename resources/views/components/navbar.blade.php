<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <img src="img/earthquake.png" alt="Seismic Icon" class="h-10">
            <div class="text-xl font-bold">
                <span class="text-gray-900">STMKG</span>
                <span class="text-red-600">SEISMIC</span>
                <span class="text-gray-900">INSTRUMENT</span>
                <span class="text-gray-500 mx-2">|</span>
                <span class="text-red-600">Data <span class="text-gray-900">{{ $slot }}</span></span>
            </div>
        </div>
        <div class="flex space-x-4">
            <img src="img/BMKG.png" alt="Logo BMKG" class="h-10">
            <img src="img/logostmkg.png" alt="Logo STMKG" class="h-10">
        </div>
    </div>
</nav>