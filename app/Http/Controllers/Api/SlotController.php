<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function available(Request $request, int $doctorId)
    {
        $request->validate([
            'date' => 'nullable|date|after_or_equal:today',
            'week' => 'nullable|boolean',
        ]);

        $query = TimeSlot::forDoctor($doctorId)->available();

        if ($request->boolean('week')) {
            $from = $request->filled('from') ? Carbon::parse($request->from) : Carbon::tomorrow();
            $query->whereBetween('slot_date', [$from->toDateString(), $from->copy()->addDays(6)->toDateString()]);
        } elseif ($request->filled('date')) {
            $query->forDate($request->date);
        } else {
            $query->forDate(Carbon::tomorrow()->toDateString());
        }

        $slots = $query->orderBy('slot_date')->orderBy('slot_time')
            ->select(['id', 'slot_date', 'slot_time'])
            ->get();

        return response()->json(['data' => $slots]);
    }
}
