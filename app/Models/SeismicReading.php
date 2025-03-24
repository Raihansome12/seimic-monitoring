<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeismicReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'adc_counts',
        'acceleration',
        'velocity',
        'displacement',
        'reading_times'
    ];

    protected $casts = [
        'adc_counts' => 'array',
        'reading_times' => 'datetime',
    ];
}
