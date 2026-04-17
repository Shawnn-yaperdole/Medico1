@extends('layouts.app')

@section('title', 'Test Result Details')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Test Result Details</h1>
                <div class="space-x-2">
                    <a href="{{ route('test-results.edit', $testResult) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Edit
                    </a>
                    <a href="{{ route('patients.show', $testResult->patient) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Back to Patient
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Patient</dt>
                        <dd class="text-lg font-semibold">{{ $testResult->patient->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Doctor</dt>
                        <dd class="text-lg font-semibold">{{ $testResult->doctor->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Test Name</dt>
                        <dd class="text-lg">{{ $testResult->test_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Test Date</dt>
                        <dd class="text-lg">{{ $testResult->test_date->format('F d, Y') }}</dd>
                    </div>
                    @if($testResult->normal_range)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Normal Range</dt>
                        <dd>{{ $testResult->normal_range }}</dd>
                    </div>
                    @endif
                </dl>

                <div class="mt-6">
                    <dt class="text-sm font-medium text-gray-500">Results</dt>
                    <dd class="mt-1 text-gray-800 bg-gray-50 p-3 rounded">{{ $testResult->results }}</dd>
                </div>

                @if($testResult->doctor_interpretation)
                <div class="mt-4">
                    <dt class="text-sm font-medium text-gray-500">Doctor's Interpretation</dt>
                    <dd class="mt-1 text-gray-800 bg-gray-50 p-3 rounded">{{ $testResult->doctor_interpretation }}</dd>
                </div>
                @endif

                @if($testResult->file_path)
                <div class="mt-4">
                    <dt class="text-sm font-medium text-gray-500">Attached File</dt>
                    <dd class="mt-1">
                        <a href="{{ $testResult->file_path }}" target="_blank" class="text-blue-600 hover:text-blue-900">View File →</a>
                    </dd>
                </div>
                @endif

                <div class="mt-6 text-sm text-gray-500">
                    <p>Recorded: {{ $testResult->created_at->format('F d, Y h:i A') }}</p>
                    <p>Last Updated: {{ $testResult->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection