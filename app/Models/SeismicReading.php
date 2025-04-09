<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeismicReading extends Model
{
    use HasFactory;

    protected $fillable = [
        'adc_counts',
        'reading_times'
    ];

    public function details() {
        return $this->hasOne(GroundMotion::class, 'seismic_reading_id');
    }

    protected $casts = [
        'adc_counts' => 'array',
        'reading_times' => 'datetime',
    ];
}
