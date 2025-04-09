<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroundMotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'seismic_reading_id',
        'acceleration',
        'velocity',
        'displacement'
    ];

    public function seismicReading()
    {
        return $this->belongsTo(SeismicReading::class, 'seismic_reading_id');
    }
}
