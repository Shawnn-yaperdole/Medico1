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
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // Create Doctor user
        $doctorUser = User::create([
            'name' => 'Dr. Sarah Smith',
            'email' => 'doctor@example.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);
        
        // Link to doctors table
        Doctor::create([
            'user_id' => $doctorUser->id,
            'full_name' => 'Dr. Sarah Smith',
            'email' => 'doctor@example.com',
            'phone' => '123-456-7890',
            'specialization' => 'Cardiology',
            'license_number' => 'DOC123456',
        ]);
        
        // Create Receptionist user
        User::create([
            'name' => 'Jane Receptionist',
            'email' => 'reception@example.com',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);
        
        // Create Patient user
        User::create([
            'name' => 'John Patient',
            'email' => 'patient@example.com',
            'password' => Hash::make('password'),
            'role' => 'patient',
        ]);
    }
}