<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');

Auth::routes(['verify' => false]);

Route::middleware('auth')->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/book/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

    // AJAX slot sorgulama (web session auth — API token gerektirmez)
    Route::get('/slots/{doctorId}', function ($doctorId, \Illuminate\Http\Request $request) {
        $request->validate(['date' => 'required|date']);
        $slots = \App\Models\TimeSlot::forDoctor($doctorId)
            ->available()
            ->forDate($request->date)
            ->orderBy('slot_time')
            ->select(['id', 'slot_time', 'slot_date'])
            ->get();
        return response()->json(['data' => $slots]);
    })->name('slots.available');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('doctors', Admin\DoctorController::class)->except(['show']);

    Route::get('/slots/generate', [Admin\SlotController::class, 'form'])->name('slots.form');
    Route::post('/slots/generate', [Admin\SlotController::class, 'generate'])->name('slots.generate');

    Route::get('/appointments', [Admin\AppointmentController::class, 'index'])->name('appointments.index');
});
