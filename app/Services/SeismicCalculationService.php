<?php

namespace App\Services;

class SeismicCalculationService
{
    public function __construct() {
        
    }

    // Konstanta untuk konversi ADC counts ke parameter ground motion
    const ADC_RESOLUTION = 16777216; // 24-bit ADC (2^24)
    const V_REF = 2.5; // Tegangan referensi ADC dalam Volt
    const GEOPHONE_SENSITIVITY = 28.8; // Sensitivitas geophone dalam V/(m/s)
    const SAMPLE_RATE = 50; // SPS (Hz)
    const DT = 1 / self::SAMPLE_RATE; // Interval waktu antar sampel

    public function calculate(array $adcCounts): array
    {
        // Konversi ADC counts ke tegangan (Volt)
        $voltages = array_map([$this, 'adcToVoltage'], $adcCounts);

        // Konversi tegangan ke kecepatan (m/s)
        $velocities = array_map([$this, 'voltageToVelocity'], $voltages);

        // Hitung percepatan (turunan kecepatan)
        $accelerations = $this->differentiate($velocities, self::DT);

        // Hitung displacement (integrasi kecepatan)
        $displacements = $this->integrate($velocities, self::DT);

        // Hitung rata-rata
        $avgAcceleration = $this->calculateAverage($accelerations);
        $avgVelocity = $this->calculateAverage($velocities);
        $avgDisplacement = $this->calculateAverage($displacements);

    return [
        'acceleration' => $accelerations,
        'velocity' => $velocities,
        'displacement' => $displacements,
        'avg_acceleration' => $avgAcceleration,
        'avg_velocity' => $avgVelocity,
        'avg_displacement' => $avgDisplacement
        ];
    }

    private function calculateAverage(array $values): float
    {
        return count($values) > 0 ? array_sum($values) / count($values) : 0;
    }

    private function adcToVoltage(int $adcCount): float
    {
        return ($adcCount / self::ADC_RESOLUTION) * (2 * self::V_REF);
    }

    private function voltageToVelocity(float $voltage): float
    {
        return $voltage / self::GEOPHONE_SENSITIVITY;
    }

    private function differentiate(array $values, float $dt): array
    {
        $derivative = [];
        $n = count($values);

        for ($i = 0; $i < $n; $i++) {
            if ($i == 0) {
                $derivative[] = ($values[$i + 1] - $values[$i]) / $dt;
            } elseif ($i == $n - 1) {
                $derivative[] = ($values[$i] - $values[$i - 1]) / $dt;
            } else {
                $derivative[] = ($values[$i + 1] - $values[$i - 1]) / (2 * $dt);
            }
        }

        return $derivative;
    }

    private function integrate(array $values, float $dt): array
    {
        $integral = [];
        $sum = 0;

        foreach ($values as $value) {
            $sum += $value * $dt;
            $integral[] = $sum;
        }

        return $integral;
    }
}
