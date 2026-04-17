@extends('layouts.app')

@section('title', 'Edit Test Result')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Test Result</h1>
                <a href="{{ route('patients.show', $testResult->patient) }}" class="text-gray-600 hover:text-gray-900">← Back to Patient</a>
            </div>

            <form action="{{ route('test-results.update', $testResult) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Doctor -->
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor *</label>
                        <select name="doctor_id" id="doctor_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ old('doctor_id', $testResult->doctor_id) == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->full_name }} - {{ $doctor->specialization }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Test Name -->
                    <div>
                        <label for="test_name" class="block text-sm font-medium text-gray-700">Test Name *</label>
                        <input type="text" name="test_name" id="test_name" required value="{{ old('test_name', $testResult->test_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('test_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Test Date -->
                    <div>
                        <label for="test_date" class="block text-sm font-medium text-gray-700">Test Date *</label>
                        <input type="date" name="test_date" id="test_date" required value="{{ old('test_date', $testResult->test_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('test_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Results -->
                    <div>
                        <label for="results" class="block text-sm font-medium text-gray-700">Results *</label>
                        <textarea name="results" id="results" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('results', $testResult->results) }}</textarea>
                        @error('results')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Normal Range -->
                    <div>
                        <label for="normal_range" class="block text-sm font-medium text-gray-700">Normal Range</label>
                        <input type="text" name="normal_range" id="normal_range" value="{{ old('normal_range', $testResult->normal_range) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('normal_range')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Doctor's Interpretation -->
                    <div>
                        <label for="doctor_interpretation" class="block text-sm font-medium text-gray-700">Doctor's Interpretation</label>
                        <textarea name="doctor_interpretation" id="doctor_interpretation" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('doctor_interpretation', $testResult->doctor_interpretation) }}</textarea>
                        @error('doctor_interpretation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Path -->
                    <div>
                        <label for="file_path" class="block text-sm font-medium text-gray-700">File Path</label>
                        <input type="text" name="file_path" id="file_path" value="{{ old('file_path', $testResult->file_path) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('file_path')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('patients.show', $testResult->patient) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            Update Test Result
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection