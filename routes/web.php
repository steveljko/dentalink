<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PatientAttachmentController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/login', LoginController::class)->name('login');
Route::post('/login', [LoginController::class, 'handle'])->name('login.handle');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::delete('/logout', LogoutController::class)->name('logout');

    Route::resource('patient', PatientController::class);

    Route::get('/patient/{patient}/appointment', [AppointmentController::class, 'create'])->name('patient.create.appointment');
    Route::post('/patient/{patient}/appointment', [AppointmentController::class, 'store'])->name('patient.store.appointment');

    Route::get('/patient/{patient}/attachment', [PatientAttachmentController::class, 'create'])->name('patient.upload');
    Route::post('/patient/{patient}/attachment', [PatientAttachmentController::class, 'store'])->name('patient.attach');

    Route::get('/appointment/{appointment}', [AppointmentController::class, 'show'])->name('appointment.show');
});
