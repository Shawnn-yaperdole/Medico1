<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Symptom;
use App\Models\TestResult;
use Illuminate\Http\Request;

class PatientDashboardController extends Controller
{
    // Show all patients
    public function index()
    {
        $patients = Patient::with(['appointments', 'medicalRecords', 'symptoms', 'testResults'])->paginate(10);
        return view('patients.index', compact('patients'));
    }
    
    // Show single patient dashboard
    public function show(Patient $patient)
    {
        $appointments = $patient->appointments()->with('doctor')->orderBy('appointment_date', 'desc')->get();
        $medicalRecords = $patient->medicalRecords()->with('doctor')->latest()->get();
        $symptoms = $patient->symptoms()->latest()->get();
        $testResults = $patient->testResults()->with('doctor')->latest()->get();
        
        return view('patients.dashboard', compact('patient', 'appointments', 'medicalRecords', 'symptoms', 'testResults'));
    }
    
    // Show appointment creation form
    public function createAppointment(Patient $patient)
    {
        $doctors = Doctor::all();
        return view('appointments.create', compact('patient', 'doctors'));
    }
    
    // Store appointment
    public function storeAppointment(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:now',
            'reason_for_visit' => 'required|string|min:10',
            'notes' => 'nullable|string',
        ]);
        
        $appointment = new Appointment($validated);
        $appointment->patient_id = $patient->id;
        $appointment->status = 'pending';
        $appointment->save();
        
        return redirect()->route('patients.show', $patient)
            ->with('success', 'Appointment created successfully!');
    }
    
    // Show all appointments
    public function appointments()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
            ->orderBy('appointment_date', 'desc')
            ->paginate(15);
        return view('appointments.index', compact('appointments'));
    }
    
    // Show all medical records
    public function medicalRecords()
    {
        $medicalRecords = MedicalRecord::with(['patient', 'doctor'])
            ->latest()
            ->paginate(15);
        return view('medical-records.index', compact('medicalRecords'));
    }
    
    // Show all symptoms
    public function symptoms()
    {
        $symptoms = Symptom::with('patient')
            ->orderBy('start_date', 'desc')
            ->paginate(15);
        return view('symptoms.index', compact('symptoms'));
    }
    
    // Show all test results
    public function testResults()
    {
        $testResults = TestResult::with(['patient', 'doctor'])
            ->orderBy('test_date', 'desc')
            ->paginate(15);
        return view('test-results.index', compact('testResults'));
    }
}