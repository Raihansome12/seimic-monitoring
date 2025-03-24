<?php

namespace App\Console\Commands;

use App\Services\MqttService;
use PhpMqtt\Client\MqttClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MqttSubscriber extends Command
{
    protected $signature = 'mqtt:subscribe'; // php artisan mqtt:subscribe and php artisan reverb:start --debug
    protected $description = 'Subscribe to MQTT topics and process incoming data';

    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        parent::__construct();
        $this->mqttService = $mqttService;
    }

    public function handle()
    {
        while (true) { // Loop agar terus berlangganan MQTT
            try {
                $this->info("Starting MQTT subscription...");
                app(MqttService::class)->subscribe();
            } catch (\Exception $e) {
                Log::error("MQTT subscriber error: " . $e->getMessage());
                $this->error("MQTT error: " . $e->getMessage());
            }
            
            // Jika terjadi error, tunggu 5 detik sebelum reconnect
            sleep(5);
            $this->info("Reconnecting to MQTT broker...");
        }
    }
}

