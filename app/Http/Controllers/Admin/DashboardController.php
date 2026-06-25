<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_doctors'      => Doctor::count(),
            'active_doctors'     => Doctor::where('is_active', true)->count(),
            'total_appointments' => Appointment::count(),
            'today_appointments' => Appointment::whereHas('timeSlot', function ($q) {
                $q->whereDate('slot_date', today());
            })->where('status', 'confirmed')->count(),
        ];

        $recentAppointments = Appointment::with(['user', 'doctor', 'timeSlot'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments'));
    }
}
