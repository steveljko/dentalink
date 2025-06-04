<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)->name('dashboard');

Route::resource('patient', PatientController::class);

Route::get('/patient/{patient}/appointment', [AppointmentController::class, 'create'])->name('patient.create.appointment');
Route::post('/patient/{patient}/appointment', [AppointmentController::class, 'store'])->name('patient.store.appointment');
