<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('is_active', true)
            ->select(['id', 'name', 'specialty', 'bio', 'photo'])
            ->get()
            ->map(fn($d) => array_merge($d->toArray(), ['photo_url' => $d->photo_url]));

        return response()->json(['data' => $doctors]);
    }
}
