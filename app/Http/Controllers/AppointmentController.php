<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentCancelled;
use App\Mail\AppointmentConfirmed;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = auth()->user()
            ->appointments()
            ->with(['doctor', 'timeSlot'])
            ->orderByDesc('created_at')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function create(Doctor $doctor)
    {
        abort_if(! $doctor->is_active, 404);

        return view('appointments.create', compact('doctor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'    => 'required|exists:doctors,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'notes'        => 'nullable|string|max:500',
        ]);

        $appointment = DB::transaction(function () use ($request) {
            $slot = TimeSlot::lockForUpdate()->findOrFail($request->time_slot_id);

            abort_if($slot->status !== 'available', 422, 'Bu slot artık müsait değil.');
            abort_if($slot->doctor_id != $request->doctor_id, 422, 'Geçersiz slot.');

            $slot->update(['status' => 'booked']);

            return Appointment::create([
                'user_id'      => auth()->id(),
                'doctor_id'    => $request->doctor_id,
                'time_slot_id' => $slot->id,
                'status'       => 'confirmed',
                'notes'        => $request->notes,
            ]);
        });

        Mail::to(auth()->user()->email)->queue(
            new AppointmentConfirmed($appointment->load(['doctor', 'timeSlot']))
        );

        return redirect()->route('appointments.index')
            ->with('success', 'Randevunuz başarıyla oluşturuldu!');
    }

    public function cancel(Appointment $appointment)
    {
        abort_if($appointment->user_id !== auth()->id(), 403);
        abort_if($appointment->status === 'cancelled', 422, 'Randevu zaten iptal edilmiş.');

        DB::transaction(function () use ($appointment) {
            $appointment->timeSlot->update(['status' => 'available']);
            $appointment->update(['status' => 'cancelled']);
        });

        Mail::to(auth()->user()->email)->queue(
            new AppointmentCancelled($appointment->load(['doctor', 'timeSlot']))
        );

        return back()->with('success', 'Randevunuz iptal edildi.');
    }
}
