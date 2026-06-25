<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function form()
    {
        $doctors = Doctor::where('is_active', true)->get();

        return view('admin.slots.generate', compact('doctors'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'doctor_id'          => 'required|exists:doctors,id',
            'date_from'          => 'required|date|after_or_equal:today',
            'date_to'            => 'required|date|after_or_equal:date_from',
            'start_time'         => 'required|date_format:H:i',
            'end_time'           => 'required|date_format:H:i|after:start_time',
            'interval_minutes'   => 'required|integer|in:15,30,60',
        ]);

        $from = Carbon::parse($request->date_from);
        $to = Carbon::parse($request->date_to);
        $created = 0;

        while ($from->lte($to)) {
            if (! $from->isWeekend()) {
                $current = Carbon::parse($from->toDateString() . ' ' . $request->start_time);
                $end = Carbon::parse($from->toDateString() . ' ' . $request->end_time);

                while ($current->lt($end)) {
                    TimeSlot::firstOrCreate([
                        'doctor_id' => $request->doctor_id,
                        'slot_date' => $from->toDateString(),
                        'slot_time' => $current->format('H:i:s'),
                    ], ['status' => 'available']);

                    $created++;
                    $current->addMinutes($request->interval_minutes);
                }
            }
            $from->addDay();
        }

        return redirect()->route('admin.slots.form')
            ->with('success', "$created slot oluşturuldu.");
    }
}
