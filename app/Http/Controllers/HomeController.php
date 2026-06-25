<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('is_active', true)->get();

        return view('home.index', compact('doctors'));
    }
}
