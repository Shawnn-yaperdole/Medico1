<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function create(Patient $patient)
    {
        return view('symptoms.create', compact('patient'));
    }

    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'symptom_name' => 'required|string|max:255',
            'severity' => 'required|in:mild,moderate,severe',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'status' => 'required|in:active,resolved',
        ]);

        $validated['patient_id'] = $patient->id;
        Symptom::create($validated);

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Symptom recorded successfully!');
    }

    public function show(Symptom $symptom)
    {
        return view('symptoms.show', compact('symptom'));
    }

    public function edit(Symptom $symptom)
    {
        return view('symptoms.edit', compact('symptom'));
    }

    public function update(Request $request, Symptom $symptom)
    {
        $validated = $request->validate([
            'symptom_name' => 'required|string|max:255',
            'severity' => 'required|in:mild,moderate,severe',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'status' => 'required|in:active,resolved',
        ]);

        $symptom->update($validated);

        return redirect()->route('patients.show', $symptom->patient)
            ->with('success', 'Symptom updated successfully!');
    }

    public function destroy(Symptom $symptom)
    {
        $patient = $symptom->patient;
        $symptom->delete();

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Symptom deleted successfully!');
    }
}