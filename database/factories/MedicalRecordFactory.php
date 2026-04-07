<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    public function definition()
    {
        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => Doctor::factory(),
            'appointment_id' => Appointment::factory(),
            'diagnosis' => $this->faker->sentence(),
            'prescription' => $this->faker->sentence(),
            'doctor_notes' => $this->faker->paragraph(), // Changed from 'notes' to 'doctor_notes'
            'blood_pressure' => $this->faker->randomElement(['120/80', '130/85', '110/70']),
            'heart_rate' => $this->faker->numberBetween(60, 100) . ' bpm',
            'temperature' => $this->faker->randomFloat(1, 36.0, 38.5) . '°C',
            'weight' => $this->faker->randomFloat(2, 50, 100),
        ];
    }
}