<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'specialization', 'email', 'phone', 'bio'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }

    public function getFullNameAttribute()
    {
        return "Dr. {$this->first_name} {$this->last_name}";
    }
}