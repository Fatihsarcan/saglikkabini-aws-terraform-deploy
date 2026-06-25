<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\SlotController;
use Illuminate\Support\Facades\Route;

// Public API (Bedrock agent token ile korunuyor)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/doctors', [DoctorController::class, 'index']);
    Route::get('/doctors/{doctorId}/slots', [SlotController::class, 'available']);

    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
    Route::get('/patient/appointments', [AppointmentController::class, 'patientAppointments']);
});
