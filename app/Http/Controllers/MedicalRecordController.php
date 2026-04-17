<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of medical records for a patient.
     */
    public function index(Patient $patient)
    {
        $medicalRecords = $patient->medicalRecords()->with('doctor')->latest()->get();
        return view('medical-records.index', compact('patient', 'medicalRecords'));
    }

    /**
     * Show the form for creating a new medical record.
     */
    public function create(Patient $patient)
    {
        $doctors = Doctor::all();
        return view('medical-records.create', compact('patient', 'doctors'));
    }

    /**
     * Store a newly created medical record.
     */
    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string|min:3',
            'prescription' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'heart_rate' => 'nullable|integer|min:30|max:200',
            'temperature' => 'nullable|numeric|min:35|max:42',
            'weight' => 'nullable|numeric|min:1|max:300',
        ]);

        $validated['patient_id'] = $patient->id;
        
        MedicalRecord::create($validated);

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Medical record created successfully!');
    }

    /**
     * Display the specified medical record.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['patient', 'doctor']);
        return view('medical-records.show', compact('medicalRecord'));
    }

    /**
     * Show the form for editing the specified medical record.
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        $doctors = Doctor::all();
        return view('medical-records.edit', compact('medicalRecord', 'doctors'));
    }

    /**
     * Update the specified medical record.
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'diagnosis' => 'required|string|min:3',
            'prescription' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
            'blood_pressure' => 'nullable|string',
            'heart_rate' => 'nullable|integer|min:30|max:200',
            'temperature' => 'nullable|numeric|min:35|max:42',
            'weight' => 'nullable|numeric|min:1|max:300',
        ]);

        $medicalRecord->update($validated);

        return redirect()->route('patients.show', $medicalRecord->patient)
            ->with('success', 'Medical record updated successfully!');
    }


    public function destroy(MedicalRecord $medicalRecord)
    {
        $patient = $medicalRecord->patient;
        $medicalRecord->delete();

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Medical record deleted successfully!');
    }
}