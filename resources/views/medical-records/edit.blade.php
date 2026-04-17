@extends('layouts.app')

@section('title', 'Edit Medical Record')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Medical Record</h1>
                <a href="{{ route('patients.show', $medicalRecord->patient) }}" class="text-gray-600 hover:text-gray-900">← Back to Patient</a>
            </div>

            <form action="{{ route('medical-records.update', $medicalRecord) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Doctor -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Doctor *</label>
                        <select name="doctor_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ $medicalRecord->doctor_id == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->full_name }} - {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Diagnosis -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Diagnosis *</label>
                        <textarea name="diagnosis" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('diagnosis', $medicalRecord->diagnosis) }}</textarea>
                        @error('diagnosis') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Prescription -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Prescription</label>
                        <textarea name="prescription" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('prescription', $medicalRecord->prescription) }}</textarea>
                        @error('prescription') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Doctor Notes -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Doctor Notes</label>
                        <textarea name="doctor_notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('doctor_notes', $medicalRecord->doctor_notes) }}</textarea>
                        @error('doctor_notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Vitals Section -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Vital Signs</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Blood Pressure</label>
                                <input type="text" name="blood_pressure" value="{{ old('blood_pressure', $medicalRecord->blood_pressure) }}" placeholder="120/80" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Heart Rate (bpm)</label>
                                <input type="number" name="heart_rate" value="{{ old('heart_rate', $medicalRecord->heart_rate) }}" placeholder="60-100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Temperature (°C)</label>
                                <input type="number" step="0.1" name="temperature" value="{{ old('temperature', $medicalRecord->temperature) }}" placeholder="36.5-37.5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" step="0.1" name="weight" value="{{ old('weight', $medicalRecord->weight) }}" placeholder="Weight in kg" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('patients.show', $medicalRecord->patient) }}" 
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Update Medical Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection