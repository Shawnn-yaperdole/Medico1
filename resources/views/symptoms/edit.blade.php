@extends('layouts.app')

@section('title', 'Edit Symptom')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Symptom</h1>
                <a href="{{ route('patients.show', $symptom->patient) }}" class="text-gray-600 hover:text-gray-900">← Back to Patient</a>
            </div>

            <form action="{{ route('symptoms.update', $symptom) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Symptom Name -->
                    <div>
                        <label for="symptom_name" class="block text-sm font-medium text-gray-700">Symptom Name *</label>
                        <input type="text" name="symptom_name" id="symptom_name" required value="{{ old('symptom_name', $symptom->symptom_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('symptom_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Severity -->
                    <div>
                        <label for="severity" class="block text-sm font-medium text-gray-700">Severity *</label>
                        <select name="severity" id="severity" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="mild" {{ old('severity', $symptom->severity) == 'mild' ? 'selected' : '' }}>Mild</option>
                            <option value="moderate" {{ old('severity', $symptom->severity) == 'moderate' ? 'selected' : '' }}>Moderate</option>
                            <option value="severe" {{ old('severity', $symptom->severity) == 'severe' ? 'selected' : '' }}>Severe</option>
                        </select>
                        @error('severity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date *</label>
                        <input type="date" name="start_date" id="start_date" required value="{{ old('start_date', $symptom->start_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $symptom->end_date ? $symptom->end_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="mt-1 text-xs text-gray-500">Leave empty if symptom is ongoing</p>
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="active" {{ old('status', $symptom->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="resolved" {{ old('status', $symptom->status) == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $symptom->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('patients.show', $symptom->patient) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                            Update Symptom
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection