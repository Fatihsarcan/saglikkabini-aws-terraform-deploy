<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::withCount('appointments')->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'specialty' => 'required|string|max:100',
            'bio'       => 'nullable|string|max:1000',
            'photo'     => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doktor eklendi.');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:100',
            'specialty' => 'required|string|max:100',
            'bio'       => 'nullable|string|max:1000',
            'photo'     => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doktor güncellendi.');
    }

    public function destroy(Doctor $doctor)
    {
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('success', 'Doktor silindi.');
    }
}
