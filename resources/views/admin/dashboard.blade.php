@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg">
                    <h3 class="text-lg font-bold text-blue-800">Total Patients</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Patient::count() }}</p>
                </div>
                
                <div class="bg-green-100 p-6 rounded-lg">
                    <h3 class="text-lg font-bold text-green-800">Total Doctors</h3>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\Doctor::count() }}</p>
                </div>
                
                <div class="bg-yellow-100 p-6 rounded-lg">
                    <h3 class="text-lg font-bold text-yellow-800">Appointments Today</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Appointment::whereDate('appointment_date', today())->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection