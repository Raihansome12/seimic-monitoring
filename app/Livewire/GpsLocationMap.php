<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\GpsLocation;
use Illuminate\Support\Facades\Http;

class GpsLocationMap extends Component
{   
    public $latitude;
    public $longitude;

    protected $listeners = ['echo:gps-data,NewGpsDataReceived' => 'updateGpsLocation'];

    public function mount()
    {
        // Ambil lokasi terbaru dari database saat halaman dimuat
        $latestLocation = GpsLocation::latest()->first();
        if ($latestLocation) {
            $this->latitude = $latestLocation->latitude;
            $this->longitude = $latestLocation->longitude;
        }
    }

    public function updateGpsLocation($event)
    {
        $this->latitude = $event['location']['latitude'];
        $this->longitude = $event['location']['longitude'];
    }

    public function render()
    {
        return view('livewire.gps-location-map');
    }
    
    // public $location;
    // public $currentTime;
    // public $city = 'Unknown';

    // protected $listeners = ['echo:gps-data,NewGpsDataReceived' => 'handleNewLocation'];

    // public function mount()
    // {
    //     // Load most recent location
    //     $latestLocation = GpsLocation::latest('reading_times')->first();
    //     if ($latestLocation) {
    //         $this->location = ['latitude' => $latestLocation->latitude, 'longitude' => $latestLocation->longitude];
    //         $this->fetchCityName($latestLocation->latitude, $latestLocation->longitude);
    //     }

    //     $this->currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i:s');
    // }

    // public function handleNewLocation($payload)
    // {
    //     $this->location = [
    //         'latitude' => $payload['latitude'],
    //         'longitude' => $payload['longitude'],
    //     ];
    //     $this->fetchCityName($payload['latitude'], $payload['longitude']);
    //     $this->currentTime = now()->setTimezone('Asia/Jakarta')->format('H:i:s');

    //     $this->dispatch('gps-location-updated', $this->location);
    // }

    // private function fetchCityName($latitude, $longitude)
    // {
    //     try {
    //         $response = Http::get("https://nominatim.openstreetmap.org/reverse", [
    //             'lat' => $latitude,
    //             'lon' => $longitude,
    //             'format' => 'json'
    //         ]);

    //         if ($response->successful() && isset($response['address'])) {
    //             $this->city = $response['address']['city'] ?? $response['address']['state'] ?? 'Unknown';
    //         }
    //     } catch (\Exception $e) {
    //         $this->city = 'Unknown';
    //     }
    // }

    // public function render()
    // {
    //     return view('livewire.gps-location-map', [
    //         'location' => $this->location,
    //         'city' => $this->city,
    //         'currentTime' => $this->currentTime,
    //     ]);
    // }
    // public function render()
    // {
    //     return view('livewire.gps-location-map');
    // }
}
