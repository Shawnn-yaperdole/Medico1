<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestResult>
 */
class TestResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $testNames = [
            'Complete Blood Count (CBC)',
            'Basic Metabolic Panel',
            'Lipid Panel',
            'Thyroid Function Test',
            'Vitamin D Test',
            'Liver Function Test',
            'Urinalysis',
            'Hemoglobin A1c',
            'Chest X-Ray',
            'ECG/EKG',
            'MRI Brain',
            'CT Scan Abdomen',
            'Ultrasound Abdomen',
            'Stress Test',
            'Allergy Test'
        ];
        
        $normalRanges = [
            'WBC: 4.5-11.0 K/uL',
            'RBC: 4.5-5.9 M/uL',
            'Hemoglobin: 13.5-17.5 g/dL',
            'Glucose: 70-99 mg/dL',
            'Cholesterol: <200 mg/dL',
            'TSH: 0.4-4.0 mIU/L',
            'Vitamin D: 30-100 ng/mL',
            'ALT: 10-40 U/L',
            'AST: 10-40 U/L',
            'Negative for abnormalities'
        ];
        
        $testDate = $this->faker->dateTimeBetween('-6 months', 'now');
        
        return [
            'patient_id' => Patient::factory(),
            'doctor_id' => Doctor::factory(),
            'test_name' => $this->faker->randomElement($testNames),
            'test_date' => $testDate,
            'results' => $this->faker->paragraph(2),
            'normal_range' => $this->faker->randomElement($normalRanges),
            'doctor_interpretation' => $this->faker->optional(0.8)->paragraph(),
            'file_path' => $this->faker->optional(0.3)->filePath(),
        ];
    }
}