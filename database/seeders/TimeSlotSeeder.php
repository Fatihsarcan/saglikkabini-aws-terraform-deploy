<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = Doctor::all();
        $startHour = 9;
        $endHour = 17;
        $intervalMinutes = 30;

        foreach ($doctors as $doctor) {
            for ($day = 1; $day <= 30; $day++) {
                $date = Carbon::today()->addDays($day);

                // Hafta sonunu atla
                if ($date->isWeekend()) {
                    continue;
                }

                $current = Carbon::today()->addDays($day)->setHour($startHour)->setMinute(0)->setSecond(0);
                $end = Carbon::today()->addDays($day)->setHour($endHour)->setMinute(0)->setSecond(0);

                while ($current->lt($end)) {
                    TimeSlot::create([
                        'doctor_id' => $doctor->id,
                        'slot_date' => $date->toDateString(),
                        'slot_time' => $current->format('H:i:s'),
                        'status'    => 'available',
                    ]);
                    $current->addMinutes($intervalMinutes);
                }
            }
        }
    }
}
