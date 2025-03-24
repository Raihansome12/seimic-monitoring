<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SeismicReading;

class GroundMotionParameters extends Component
{
    public $acceleration;
    public $velocity;
    public $displacement;

    protected $listeners = ['echo:seismic-data,NewSeismicDataReceived' => 'handleNewReading'];

    public function mount()
    {
        // Load most recent parameters
        $latestReading = SeismicReading::latest('reading_times')->first();
        
        if ($latestReading) {
            $this->acceleration = $latestReading->acceleration;
            $this->velocity = $latestReading->velocity;
            $this->displacement = $latestReading->displacement;
        } else {
            $this->acceleration = 0;
            $this->velocity = 0;
            $this->displacement = 0;
        }
    }

    public function handleNewReading($payload)
    {
        $this->acceleration = $payload['reading']['acceleration'];
        $this->velocity = $payload['reading']['velocity'];
        $this->displacement = $payload['reading']['displacement'];
    }

    public function render()
    {
        return view('livewire.ground-motion-parameters');
    }
}
