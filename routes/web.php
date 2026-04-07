<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\ProfileController;

require __DIR__.'/auth.php';

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard route - redirect to patients
    Route::get('/dashboard', function () {
        return redirect()->route('patients.index');
    })->name('dashboard');
    
    // Patient routes
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
});

// Admin only routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});