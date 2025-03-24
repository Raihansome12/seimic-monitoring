<?php

namespace App\Events;

use App\Models\SeismicReading;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewSeismicDataReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reading;

    public function __construct(SeismicReading $reading)
    {
        $this->reading = $reading;
    }

    public function broadcastOn()
    {
        return new Channel('seismic-data');
    }
}
