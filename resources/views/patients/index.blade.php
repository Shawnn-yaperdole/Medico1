@extends('layouts.app')

@section('title', 'All Patients')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Registered Patients</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Full Name</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Phone</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Blood Type</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $patient->id }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm font-medium">{{ $patient->full_name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $patient->email }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $patient->phone }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $patient->blood_type ?? 'N/A' }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                    <a href="{{ route('patients.show', $patient) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                        View Dashboard
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $patients->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection