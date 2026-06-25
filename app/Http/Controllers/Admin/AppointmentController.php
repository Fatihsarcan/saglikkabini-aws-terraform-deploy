<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['user', 'doctor', 'timeSlot'])
            ->orderByDesc('created_at');

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        if ($request->filled('date')) {
            $query->whereHas('timeSlot', fn($q) => $q->whereDate('slot_date', $request->date));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->paginate(20)->withQueryString();
        $doctors = Doctor::all();

        return view('admin.appointments.index', compact('appointments', 'doctors'));
    }
}
