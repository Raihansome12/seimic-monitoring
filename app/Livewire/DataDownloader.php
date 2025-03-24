<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class DataDownloader extends Component
{
    public $startDate;
    public $endDate;
    
    public function mount()
    {
        $this->startDate = Carbon::today()->format('Y-m-d');
        $this->endDate = Carbon::today()->format('Y-m-d');
    }
    
    public function downloadData()
    {
        return redirect()->route('download.data', [
            'start' => $this->startDate,
            'end' => $this->endDate
        ]);
    }

    public function render()
    {
        return view('livewire.data-downloader');
    }
}
