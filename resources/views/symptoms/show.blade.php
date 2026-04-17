@extends('layouts.app')

@section('title', 'Symptom Details')

@section('content')
<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Symptom Details</h1>
                <div class="space-x-2">
                    <a href="{{ route('symptoms.edit', $symptom) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        Edit
                    </a>
                    <a href="{{ route('patients.show', $symptom->patient) }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Back to Patient
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Patient</dt>
                        <dd class="text-lg font-semibold">{{ $symptom->patient->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Symptom</dt>
                        <dd class="text-lg font-semibold">{{ $symptom->symptom_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Severity</dt>
                        <dd>
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($symptom->severity == 'mild') bg-green-100 text-green-800
                                @elseif($symptom->severity == 'moderate') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($symptom->severity) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd>
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($symptom->status == 'active') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ ucfirst($symptom->status) }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                        <dd>{{ $symptom->start_date->format('F d, Y') }}</dd>
                    </div>
                    @if($symptom->end_date)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">End Date</dt>
                        <dd>{{ $symptom->end_date->format('F d, Y') }}</dd>
                    </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Duration</dt>
                        <dd>
                            @if($symptom->end_date)
                                {{ $symptom->start_date->diffInDays($symptom->end_date) }} days
                            @else
                                Ongoing ({{ $symptom->start_date->diffInDays(now()) }} days so far)
                            @endif
                        </dd>
                    </div>
                </dl>

                @if($symptom->description)
                <div class="mt-6">
                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                    <dd class="mt-1 text-gray-800 bg-gray-50 p-3 rounded">{{ $symptom->description }}</dd>
                </div>
                @endif

                <div class="mt-6">
                    <dt class="text-sm font-medium text-gray-500">Recorded</dt>
                    <dd class="text-sm text-gray-600">{{ $symptom->created_at->format('F d, Y h:i A') }}</dd>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection