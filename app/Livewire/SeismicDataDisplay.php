<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SeismicReading;

class SeismicDataDisplay extends Component
{
    public $readings = [];
    public $maxReadings = 100;

    protected $listeners = ['echo:seismic-data,NewSeismicDataReceived' => 'handleNewReading'];

    public function mount()
    {
        // Load initial data
        $this->readings = SeismicReading::latest('reading_times')
            ->take($this->maxReadings)
            ->orderBy('reading_times')
            ->get()
            ->toArray();
    }

    public function handleNewReading($payload)
    {
        // Add new reading to the array
        $this->readings[] = $payload['reading'];
        
        // Keep only the latest readings
        if (count($this->readings) > $this->maxReadings) {
            array_shift($this->readings);
        }
        
        $this->dispatch('seismic-data-updated', $payload['reading']);
    }

    public function render()
    {
        return view('livewire.seismic-data-display');
    }
}
