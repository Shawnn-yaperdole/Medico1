@extends('layouts.app')

@section('title', 'Medical Record Details')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Medical Record Details</h1>
                <div class="space-x-2">
                    <a href="{{ route('medical-records.edit', $medicalRecord) }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Edit
                    </a>
                    <a href="{{ route('patients.show', $medicalRecord->patient) }}" 
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Back to Patient
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Patient</dt>
                        <dd class="text-lg font-semibold">{{ $medicalRecord->patient->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Doctor</dt>
                        <dd class="text-lg font-semibold">{{ $medicalRecord->doctor->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Date</dt>
                        <dd class="text-lg">{{ $medicalRecord->created_at->format('F d, Y h:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                        <dd class="text-lg">{{ $medicalRecord->updated_at->diffForHumans() }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <dt class="text-sm font-medium text-gray-500">Diagnosis</dt>
                    <dd class="mt-1 text-gray-800 bg-gray-50 p-3 rounded">{{ $medicalRecord->diagnosis }}</dd>
                </div>

                @if($medicalRecord->prescription)
                <div class="mt-4">
                    <dt class="text-sm font-medium text-gray-500">Prescription</dt>
                    <dd class="mt-1 text-gray-800 bg-gray-50 p-3 rounded">{{ $medicalRecord->prescription }}</dd>
                </div>
                @endif

                @if($medicalRecord->doctor_notes)
                <div class="mt-4">
                    <dt class="text-sm font-medium text-gray-500">Doctor's Notes</dt>
                    <dd class="mt-1 text-gray-800 bg-gray-50 p-3 rounded">{{ $medicalRecord->doctor_notes }}</dd>
                </div>
                @endif

                <div class="mt-6">
                    <dt class="text-sm font-medium text-gray-500 mb-3">Vital Signs</dt>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @if($medicalRecord->blood_pressure)
                        <div class="bg-blue-50 p-3 rounded">
                            <div class="text-xs text-blue-600">Blood Pressure</div>
                            <div class="font-semibold">{{ $medicalRecord->blood_pressure }}</div>
                        </div>
                        @endif
                        @if($medicalRecord->heart_rate)
                        <div class="bg-green-50 p-3 rounded">
                            <div class="text-xs text-green-600">Heart Rate</div>
                            <div class="font-semibold">{{ $medicalRecord->heart_rate }} bpm</div>
                        </div>
                        @endif
                        @if($medicalRecord->temperature)
                        <div class="bg-yellow-50 p-3 rounded">
                            <div class="text-xs text-yellow-600">Temperature</div>
                            <div class="font-semibold">{{ $medicalRecord->temperature }} °C</div>
                        </div>
                        @endif
                        @if($medicalRecord->weight)
                        <div class="bg-purple-50 p-3 rounded">
                            <div class="text-xs text-purple-600">Weight</div>
                            <div class="font-semibold">{{ $medicalRecord->weight }} kg</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection