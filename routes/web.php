<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Patient routes using your existing controller
Route::get('/patients', [PatientDashboardController::class, 'index'])->name('patients.index');
Route::get('/patients/{patient}', [PatientDashboardController::class, 'show'])->name('patients.show');

// Appointment routes
Route::get('/patients/{patient}/appointments/create', [PatientDashboardController::class, 'createAppointment'])->name('appointments.create');
Route::post('/patients/{patient}/appointments', [PatientDashboardController::class, 'storeAppointment'])->name('appointments.store');
Route::get('/appointments', [PatientDashboardController::class, 'appointments'])->name('appointments.index');

// Other resource routes
Route::get('/medical-records', [PatientDashboardController::class, 'medicalRecords'])->name('medical-records.index');
Route::get('/symptoms', [PatientDashboardController::class, 'symptoms'])->name('symptoms.index');
Route::get('/test-results', [PatientDashboardController::class, 'testResults'])->name('test-results.index');