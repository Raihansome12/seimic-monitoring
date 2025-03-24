<?php

declare(strict_types=1);

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Repositories\MemoryRepository;

return [
    'default_connection' => 'default',
    'connections' => [
        'default' => [
            'host' => env('MQTT_HOST'),
            'port' => env('MQTT_PORT', 8883),
            'protocol' => MqttClient::MQTT_3_1_1,
            'client_id' => env('MQTT_CLIENT_ID'),
            'use_clean_session' => true,
            'enable_logging' => true,
            'log_channel' => 'stack',
            'repository' => MemoryRepository::class,
            'connection_settings' => [
                'tls' => [
                    'enabled' => true,
                    'verify_peer' => true,
                    'verify_peer_name' => true,
                    'ca_path' => env('MQTT_TLS_CA_FILE'),
                ],
                'auth' => [
                    'username' => env('MQTT_AUTH_USERNAME'),
                    'password' => env('MQTT_AUTH_PASSWORD'),
                ],
                'connect_timeout' => 60,
                'socket_timeout' => 60,
                'keep_alive_interval' => 10,
            ],
        ],
    ],
];
