@extends('layouts.app')

@section('title', 'All Medical Records')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">All Medical Records</h2>
                </div>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Doctor</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Diagnosis</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medicalRecords as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $record->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                    <a href="{{ route('patients.show', $record->patient) }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $record->patient->full_name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $record->doctor->full_name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ Str::limit($record->diagnosis, 50) }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('medical-records.show', $record) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                            View
                                        </a>
                                        <a href="{{ route('medical-records.edit', $record) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">
                                            Edit
                                        </a>
                                        <form action="{{ route('medical-records.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this medical record?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                Delete
                                            </button>
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
                
                @if($medicalRecords->hasPages())
                    <div class="mt-4">
                        {{ $medicalRecords->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection