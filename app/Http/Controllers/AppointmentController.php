<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::all();
        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'reason_for_visit' => 'required|string|min:10',
            'notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);

        return redirect()->route('patients.show', $appointment->patient)
            ->with('success', 'Appointment updated successfully!');
    }

    public function destroy(Appointment $appointment)
    {
        $patient = $appointment->patient;
        $appointment->delete();

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Appointment cancelled successfully!');
    }
}