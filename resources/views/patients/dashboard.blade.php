@extends('layouts.app')

@section('title', 'Patient Dashboard - ' . $patient->full_name)

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
                <div class="space-x-3">
                    <a href="{{ route('medical-records.create', $patient) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                        + New Medical Record
                    </a>
                    <a href="{{ route('appointments.create', $patient) }}" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
                        + New Appointment
                    </a>
                </div>
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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">📅 Appointments</h2>
                <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:text-blue-900 text-sm">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Date & Time</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments->take(5) as $appointment)
                        <tr class="border-b hover:bg-gray-50">
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
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('appointments.edit', $appointment) }}" 
                                       class="text-green-600 hover:text-green-900 text-sm">Edit</a>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Cancel this appointment?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Cancel</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No appointments found</td>
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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">📋 Medical Records</h2>
                <a href="{{ route('medical-records.create', $patient) }}" class="text-blue-600 hover:text-blue-900 text-sm">+ Add New</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Diagnosis</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Prescription</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicalRecords->take(5) as $record)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $record->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ $record->doctor->full_name }}</td>
                            <td class="px-6 py-4">{{ Str::limit($record->diagnosis, 50) }}</td>
                            <td class="px-6 py-4">{{ Str::limit($record->prescription ?? 'N/A', 50) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('medical-records.show', $record) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    <a href="{{ route('medical-records.edit', $record) }}" 
                                       class="text-green-600 hover:text-green-900 text-sm">Edit</a>
                                    <form action="{{ route('medical-records.destroy', $record) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this medical record?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No medical records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($medicalRecords->count() > 5)
            <div class="mt-4 text-center">
                <a href="{{ route('medical-records.index') }}?patient={{ $patient->id }}" class="text-blue-600 hover:text-blue-900">View all {{ $medicalRecords->count() }} records →</a>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Symptoms Section -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">🤒 Symptoms Tracker</h2>
                <a href="{{ route('symptoms.create', $patient) }}" class="text-blue-600 hover:text-blue-900 text-sm">+ Add Symptom</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Symptom</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Severity</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Start Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($symptoms->take(5) as $symptom)
                        <tr class="border-b hover:bg-gray-50">
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
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    @if($symptom->status == 'active') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($symptom->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('symptoms.show', $symptom) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    <a href="{{ route('symptoms.edit', $symptom) }}" 
                                       class="text-green-600 hover:text-green-900 text-sm">Edit</a>
                                    <form action="{{ route('symptoms.destroy', $symptom) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this symptom?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </div>
                             </td>
                         </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No symptoms recorded</td>
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
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">🔬 Test Results</h2>
                <a href="{{ route('test-results.create', $patient) }}" class="text-blue-600 hover:text-blue-900 text-sm">+ Add Test Result</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Test Name</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Test Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Results</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Doctor's Notes</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testResults->take(5) as $test)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">{{ $test->test_name }}</td>
                            <td class="px-6 py-4">{{ $test->test_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">{{ Str::limit($test->results, 50) }}</td>
                            <td class="px-6 py-4">{{ Str::limit($test->doctor_interpretation ?? 'N/A', 50) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('test-results.show', $test) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-sm">View</a>
                                    <a href="{{ route('test-results.edit', $test) }}" 
                                       class="text-green-600 hover:text-green-900 text-sm">Edit</a>
                                    <form action="{{ route('test-results.destroy', $test) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this test result?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </div>
                             </td>
                         </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No test results available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection