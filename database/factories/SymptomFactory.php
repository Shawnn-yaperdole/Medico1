<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Symptom>
 */
class SymptomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $severities = ['mild', 'moderate', 'severe'];
        $statuses = ['active', 'resolved'];
        $symptoms = ['Headache', 'Fever', 'Cough', 'Fatigue', 'Nausea', 'Dizziness', 'Muscle Pain', 'Sore Throat'];
        
        $startDate = $this->faker->dateTimeBetween('-30 days', 'now');
        $endDate = $this->faker->optional(0.7)->dateTimeBetween($startDate, 'now');
        
        return [
            'patient_id' => Patient::factory(),
            'symptom_name' => $this->faker->randomElement($symptoms),
            'severity' => $this->faker->randomElement($severities),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $this->faker->sentence(),
            'status' => $endDate ? 'resolved' : $this->faker->randomElement($statuses),
        ];
    }
}