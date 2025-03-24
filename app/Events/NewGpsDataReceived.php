<?php

namespace App\Events;

use App\Models\GpsLocation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewGpsDataReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $location;

    public function __construct(GpsLocation $location)
    {
        $this->location = $location;
    }

    public function broadcastOn()
    {
        return new Channel('gps-data');
    }

    public function broadcastWith()
    {
        return [
        'longitude' => $this->location->longitude,
        'latitude' => $this->location->latitude,
        'reading_times' => $this->location->reading_times
        ];
    }
}