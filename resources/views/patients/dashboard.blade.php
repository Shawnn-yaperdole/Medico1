@extends('layouts.app')

@section('title', "Patient Dashboard - {{ $patient->full_name }}")

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Patient Info Header -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">{{ $patient->full_name }}</h1>
                    <p class="text-blue-100 mt-1">Patient ID: {{ $patient->id }}</p>
                </div>
                <a href="{{ route('appointments.create', $patient) }}" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
                    + New Appointment
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 text-white">
                <div>📧 {{ $patient->email }}</div>
                <div>📞 {{ $patient->phone }}</div>
                <div>🩸 Blood Type: {{ $patient->blood_type ?? 'Not recorded' }}</div>
            </div>
        </div>
    </div>
    
    <!-- Appointments Section -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">📅 Upcoming Appointments</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Date & Time</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $appointment->doctor->full_name }}</td>
                            <td class="px-6 py-4">{{ $appointment->appointment_date->format('M d, Y h:i A') }}</td>
                            <td class="px-6 py-4">{{ Str::limit($appointment->reason_for_visit, 50) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($appointment->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No appointments found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Medical Records Section -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">📋 Medical Records</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Diagnosis</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Prescription</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicalRecords as $record)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $record->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ $record->doctor->full_name }}</td>
                            <td class="px-6 py-4">{{ Str::limit($record->diagnosis, 50) }}</td>
                            <td class="px-6 py-4">{{ Str::limit($record->prescription ?? 'N/A', 50) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No medical records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Symptoms Section -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">🤒 Symptoms Tracker</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Symptom</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Severity</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($symptoms as $symptom)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $symptom->symptom_name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($symptom->severity == 'mild') bg-green-100 text-green-800
                                    @elseif($symptom->severity == 'moderate') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($symptom->severity) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $symptom->start_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ ucfirst($symptom->status) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No symptoms recorded</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Test Results Section -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">🔬 Test Results</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Test Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Test Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Results</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Doctor's Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testResults as $test)
                        <tr class="border-b">
                            <td class="px-6 py-4 font-medium">{{ $test->test_name }}</td>
                            <td class="px-6 py-4">{{ $test->test_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ Str::limit($test->results, 50) }}</td>
                            <td class="px-6 py-4">{{ Str::limit($test->doctor_interpretation ?? 'N/A', 50) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No test results available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection