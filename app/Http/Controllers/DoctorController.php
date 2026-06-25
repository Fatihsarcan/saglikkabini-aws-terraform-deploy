<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class DoctorController extends Controller
{
    public function show(Doctor $doctor)
    {
        abort_if(! $doctor->is_active, 404);

        return view('doctors.show', compact('doctor'));
    }
}
