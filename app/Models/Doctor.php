<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',           
        'first_name', 
        'last_name', 
        'specialization', 
        'email', 
        'phone', 
        'bio'
    ];

   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
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

    
    public function hasUserAccount()
    {
        return $this->user_id !== null;
    }

    
    public function getEmailAttribute($value)
    {
        if ($this->user && $this->user->email) {
            return $this->user->email;
        }
        return $value;
    }

    protected static function booted()
    {
        static::created(function ($doctor) {
            
            if (!$doctor->user_id && $doctor->email) {
                $user = User::create([
                    'name' => $doctor->full_name,
                    'email' => $doctor->email,
                    'password' => bcrypt('password'), 
                    'role' => 'doctor',
                ]);
                $doctor->user_id = $user->id;
                $doctor->save();
            }
        });

        static::deleting(function ($doctor) {
          
            if ($doctor->user_id) {
                $doctor->user->delete();
            }
        });
    }
}