<?php

namespace App\Services;

use App\Models\SeismicReading;
use PhpMqtt\Client\Facades\MQTT;
use App\Events\NewGpsDataReceived;
use Illuminate\Support\Facades\Log;
use App\Events\NewSeismicDataReceived;
use App\Models\GpsLocation;
use App\Services\SeismicCalculationService;

class MqttService
{
    protected $seismicCalculationService;

    public function __construct(SeismicCalculationService $seismicCalculationService)
    {
        $this->seismicCalculationService = $seismicCalculationService;
    }

    public function subscribe()
    {
        try {
            $mqtt = MQTT::connection();

            Log::info('MQTT subscribtion starting...');
            
            // Subscribe to sensor topics
            // $mqtt->subscribe('sensors/geophone', function ($topic, $message) {
            //     $this->processGeophoneData(json_decode($message, true));
            // }, 0);
            
            $mqtt->subscribe('sensors/gps', function ($topic, $message) {
                $this->processGpsData(json_decode($message, true));
            }, 0);
            
            $mqtt->loop(true);
        } catch (\Exception $e) {
            Log::error('MQTT Subscription error: ' . $e->getMessage());
        }
    }

    // protected function processGeophoneData(array $data)
    // {
    //     try {
    //         if(!isset($data['adc_counts']) || !is_array($data['adc_counts'])) {
    //             throw new \Exception("Data ADC Counts tidak valid.");
    //         }

    //         $adcCounts = array_map('intval', $data['adc_counts']);

    //         // Calculate seismic parameters
    //         $calculations = $this->seismicCalculationService->calculate($adcCounts);
            
    //         // Store data in database
    //         $reading = SeismicReading::create([
    //             'adc_counts' => $data['adc_counts'],
    //             'acceleration' => $calculations['acceleration'],
    //             'velocity' => $calculations['velocity'],
    //             'displacement' => $calculations['displacement'],
    //             'reading_times' => $data['reading_times'],
    //         ]);
            
    //         // Broadcast event to WebSocket
    //         event(new NewSeismicDataReceived($reading));
    //     } catch (\Exception $e) {
    //         Log::error('Error processing geophone data: ' . $e->getMessage());
    //     }
    // }

    protected function processGpsData(array $data)
    {
        Log::info('Processing GPS data: ', [$data]);
        try {
            // Store GPS data in database
            $location = GpsLocation::create([
                'longitude' => isset($data['longitude']) ? floatval($data['longitude']) : null,
                'latitude' => isset($data['latitude']) ? floatval($data['latitude']) : null,
                'reading_times' => $data['reading_times'],
            ]);

            Log::info('GPS location saved with ID: ' . $location->id);
            
            // Broadcast event to WebSocket
            event(new NewGpsDataReceived($location));
            Log::info('NewGpsDataReceived event broadcasted');
        } catch (\Exception $e) {
            Log::error('Error processing GPS data: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}