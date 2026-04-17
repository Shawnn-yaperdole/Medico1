<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SymptomController;
use App\Http\Controllers\TestResultController;

require __DIR__.'/auth.php';

// Public routes - Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Protected routes 
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Dashboard route 
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
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    
    // Medical Records Routes 
    Route::get('/medical-records', [PatientDashboardController::class, 'medicalRecords'])->name('medical-records.index');
    Route::get('/patients/{patient}/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('/patients/{patient}/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
    Route::get('/medical-records/{medicalRecord}/edit', [MedicalRecordController::class, 'edit'])->name('medical-records.edit');
    Route::put('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'update'])->name('medical-records.update');
    Route::delete('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
    
    // Symptoms Routes 
    Route::get('/symptoms', [PatientDashboardController::class, 'symptoms'])->name('symptoms.index');
    Route::get('/patients/{patient}/symptoms/create', [SymptomController::class, 'create'])->name('symptoms.create');
    Route::post('/patients/{patient}/symptoms', [SymptomController::class, 'store'])->name('symptoms.store');
    Route::get('/symptoms/{symptom}', [SymptomController::class, 'show'])->name('symptoms.show');
    Route::get('/symptoms/{symptom}/edit', [SymptomController::class, 'edit'])->name('symptoms.edit');
    Route::put('/symptoms/{symptom}', [SymptomController::class, 'update'])->name('symptoms.update');
    Route::delete('/symptoms/{symptom}', [SymptomController::class, 'destroy'])->name('symptoms.destroy');
    
    // Test Results Routes 
    Route::get('/test-results', [PatientDashboardController::class, 'testResults'])->name('test-results.index');
    Route::get('/patients/{patient}/test-results/create', [TestResultController::class, 'create'])->name('test-results.create');
    Route::post('/patients/{patient}/test-results', [TestResultController::class, 'store'])->name('test-results.store');
    Route::get('/test-results/{testResult}', [TestResultController::class, 'show'])->name('test-results.show');
    Route::get('/test-results/{testResult}/edit', [TestResultController::class, 'edit'])->name('test-results.edit');
    Route::put('/test-results/{testResult}', [TestResultController::class, 'update'])->name('test-results.update');
    Route::delete('/test-results/{testResult}', [TestResultController::class, 'destroy'])->name('test-results.destroy');
});

// Admin only routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});