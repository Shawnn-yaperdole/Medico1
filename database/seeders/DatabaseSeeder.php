<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Symptom;
use App\Models\TestResult;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
        $this->call(UserSeeder::class);
        
        // Create 15 patients
        $patients = Patient::factory(15)->create();
        
        // Create 8 doctors
        $doctors = Doctor::factory(8)->create();
        
        // Create appointments for each patient
        $patients->each(function ($patient) use ($doctors) {
            // Create 2-4 appointments per patient
            $appointments = Appointment::factory(rand(2, 4))
                ->create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $doctors->random()->id,
                ]);
            
            // Create medical records for completed appointments
            $appointments->where('status', 'completed')->each(function ($appointment) use ($patient) {
                MedicalRecord::factory()->create([
                    'patient_id' => $patient->id,
                    'doctor_id' => $appointment->doctor_id,
                    'appointment_id' => $appointment->id,
                ]);
            });
            
            // Create symptoms for each patient
            Symptom::factory(rand(1, 3))->create([
                'patient_id' => $patient->id,
            ]);
            
            // Create test results for each patient
            TestResult::factory(rand(1, 2))->create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctors->random()->id,
            ]);
        });
    }
}