@extends('layouts.app')

@section('title', 'All Test Results')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="px-4 py-6 sm:px-0">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">All Test Results</h2>
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
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Patient</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Test Name</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Test Date</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Doctor</th>
                                <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($testResults as $test)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                    <a href="{{ route('patients.show', $test->patient) }}" class="text-blue-600 hover:text-blue-900">
                                        {{ $test->patient->full_name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm font-medium">{{ $test->test_name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $test->test_date->format('M d, Y') }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">{{ $test->doctor->full_name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300 text-sm">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('test-results.show', $test) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs">
                                            View
                                        </a>
                                        <a href="{{ route('test-results.edit', $test) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">
                                            Edit
                                        </a>
                                        <form action="{{ route('test-results.destroy', $test) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this test result?')">
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
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No test results available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($testResults->hasPages())
                    <div class="mt-4">
                        {{ $testResults->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection