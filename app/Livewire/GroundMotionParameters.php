<?php

namespace App\Livewire;

use App\Models\GroundMotion;
use Livewire\Component;

class GroundMotionParameters extends Component
{
    public $acceleration = 0;
    public $velocity = 0;
    public $displacement = 0;

    protected $listeners = ['echo:seismic-data,NewSeismicDataReceived' => 'handleNewReading'];

    public function mount()
    {
        $this->updateWithMovingAverage();
    }

    public function handleNewReading($payload)
    {
        $this->updateWithMovingAverage();
    }

    private function updateWithMovingAverage()
    {
        // Ambil data dari 1 detik terakhir (50 sampel)
        $recentReadings = GroundMotion::latest('created_at')->limit(1)->get();

        if ($recentReadings->count() > 0) {
            $this->acceleration = $recentReadings->avg('acceleration');
            $this->velocity = $recentReadings->avg('velocity');
            $this->displacement = $recentReadings->avg('displacement');
        }
    }

    public function render()
    {
        return view('livewire.ground-motion-parameters');
    }
}
