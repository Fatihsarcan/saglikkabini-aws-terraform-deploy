<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentCancelled;
use App\Mail\AppointmentConfirmed;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id'      => 'required|exists:doctors,id',
            'slot_id'        => 'required|exists:time_slots,id',
            'patient_name'   => 'required|string|max:100',
            'patient_email'  => 'required|email',
            'notes'          => 'nullable|string|max:500',
        ]);

        // Bedrock agent için hasta kaydı bul ya da oluştur
        $user = User::firstOrCreate(
            ['email' => $data['patient_email']],
            ['name' => $data['patient_name'], 'password' => bcrypt(str()->random(16))]
        );

        $appointment = DB::transaction(function () use ($data, $user) {
            $slot = TimeSlot::lockForUpdate()->findOrFail($data['slot_id']);

            if ($slot->status !== 'available' || $slot->doctor_id != $data['doctor_id']) {
                abort(422, 'Bu slot müsait değil.');
            }

            $slot->update(['status' => 'booked']);

            return Appointment::create([
                'user_id'      => $user->id,
                'doctor_id'    => $data['doctor_id'],
                'time_slot_id' => $slot->id,
                'status'       => 'confirmed',
                'notes'        => $data['notes'] ?? null,
            ]);
        });

        Mail::to($user->email)->queue(
            new AppointmentConfirmed($appointment->load(['doctor', 'timeSlot']))
        );

        return response()->json([
            'message'        => 'Randevu başarıyla oluşturuldu.',
            'appointment_id' => $appointment->id,
            'doctor'         => $appointment->doctor->name,
            'date'           => $appointment->timeSlot->slot_date->format('d.m.Y'),
            'time'           => substr($appointment->timeSlot->slot_time, 0, 5),
        ], 201);
    }

    public function cancel(Request $request, int $id)
    {
        $appointment = Appointment::with(['doctor', 'timeSlot', 'user'])->findOrFail($id);

        if ($appointment->status === 'cancelled') {
            return response()->json(['message' => 'Randevu zaten iptal edilmiş.'], 422);
        }

        DB::transaction(function () use ($appointment) {
            $appointment->timeSlot->update(['status' => 'available']);
            $appointment->update(['status' => 'cancelled']);
        });

        Mail::to($appointment->user->email)->queue(
            new AppointmentCancelled($appointment)
        );

        return response()->json(['message' => 'Randevu iptal edildi.', 'appointment_id' => $appointment->id]);
    }

    public function show(int $id)
    {
        $appointment = Appointment::with(['doctor', 'timeSlot', 'user'])->findOrFail($id);

        return response()->json([
            'id'     => $appointment->id,
            'status' => $appointment->status,
            'doctor' => $appointment->doctor->name,
            'date'   => $appointment->timeSlot->slot_date->format('d.m.Y'),
            'time'   => substr($appointment->timeSlot->slot_time, 0, 5),
            'patient' => $appointment->user->name,
        ]);
    }

    public function patientAppointments(Request $request)
    {
        $appointments = $request->user()
            ->appointments()
            ->with(['doctor', 'timeSlot'])
            ->orderByDesc('created_at')
            ->get()
            ->map(fn($a) => [
                'id'     => $a->id,
                'status' => $a->status,
                'doctor' => $a->doctor->name,
                'date'   => $a->timeSlot->slot_date->format('d.m.Y'),
                'time'   => substr($a->timeSlot->slot_time, 0, 5),
            ]);

        return response()->json(['data' => $appointments]);
    }
}
