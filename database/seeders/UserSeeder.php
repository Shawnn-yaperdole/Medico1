<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        
        // Create Doctor user
        $doctorUser = User::firstOrCreate(
            ['email' => 'doctor@example.com'],
            [
                'name' => 'Dr. Sarah Smith',
                'email' => 'doctor@example.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
            ]
        );
        
        // Link to doctors table - Using correct column names
        Doctor::firstOrCreate(
            ['email' => 'doctor@example.com'],
            [
                'user_id' => $doctorUser->id,
                'first_name' => 'Sarah',  // Changed from full_name
                'last_name' => 'Smith',   // Added last_name
                'email' => 'doctor@example.com',
                'phone' => '123-456-7890',
                'specialization' => 'Cardiology',
                'bio' => 'Experienced cardiologist with over 10 years of practice.', // Changed from license_number
            ]
        );
        
        // Create Receptionist user
        User::firstOrCreate(
            ['email' => 'reception@example.com'],
            [
                'name' => 'Jane Receptionist',
                'email' => 'reception@example.com',
                'password' => Hash::make('password'),
                'role' => 'receptionist',
            ]
        );
        
        // Create Patient user
        User::firstOrCreate(
            ['email' => 'patient@example.com'],
            [
                'name' => 'John Patient',
                'email' => 'patient@example.com',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ]
        );
    }
}