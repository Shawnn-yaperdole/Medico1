@extends('layouts.app')

@section('title', 'Create Appointment')

@section('content')
<div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Schedule New Appointment</h2>
            <h3 class="text-lg text-gray-600 mb-4">Patient: {{ $patient->full_name }}</h3>
            
            <form action="{{ route('appointments.store', $patient) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="doctor_id">
                        Select Doctor
                    </label>
                    <select name="doctor_id" id="doctor_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                        <option value="">Choose a doctor...</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->full_name }} - {{ $doctor->specialization }}</option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <