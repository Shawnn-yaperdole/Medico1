<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\TestResult;
use App\Models\Doctor;
use Illuminate\Http\Request;

class TestResultController extends Controller
{
    public function create(Patient $patient)
    {
        $doctors = Doctor::all();
        return view('test-results.create', compact('patient', 'doctors'));
    }

    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'test_name' => 'required|string|max:255',
            'test_date' => 'required|date',
            'results' => 'required|string',
            'normal_range' => 'nullable|string',
            'doctor_interpretation' => 'nullable|string',
            'file_path' => 'nullable|string',
        ]);

        $validated['patient_id'] = $patient->id;
        TestResult::create($validated);

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Test result added successfully!');
    }

    public function show(TestResult $testResult)
    {
        return view('test-results.show', compact('testResult'));
    }

    public function edit(TestResult $testResult)
    {
        $doctors = Doctor::all();
        return view('test-results.edit', compact('testResult', 'doctors'));
    }

    public function update(Request $request, TestResult $testResult)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'test_name' => 'required|string|max:255',
            'test_date' => 'required|date',
            'results' => 'required|string',
            'normal_range' => 'nullable|string',
            'doctor_interpretation' => 'nullable|string',
            'file_path' => 'nullable|string',
        ]);

        $testResult->update($validated);

        return redirect()->route('patients.show', $testResult->patient)
            ->with('success', 'Test result updated successfully!');
    }

    public function destroy(TestResult $testResult)
    {
        $patient = $testResult->patient;
        $testResult->delete();

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Test result deleted successfully!');
    }
}