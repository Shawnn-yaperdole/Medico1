<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'specialization' => $this->faker->randomElement([
                'Cardiology', 'Neurology', 'Pediatrics', 'Dermatology', 
                'Orthopedics', 'Ophthalmology', 'Psychiatry', 'Radiology'
            ]),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'bio' => $this->faker->paragraph(),
        ];
    }
}