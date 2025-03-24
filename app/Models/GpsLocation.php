<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GpsLocation extends Model
{

    protected $fillable = [
        'longitude',
        'latitude',
        'reading_times'
    ];

    protected $casts = [
        'reading_times' => 'timestamp',
    ];
}
