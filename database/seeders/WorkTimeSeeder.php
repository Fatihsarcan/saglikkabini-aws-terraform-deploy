<?php

namespace Database\Seeders;

use App\Models\WorkTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkTime::create([
            'day_name' => 'Pazartesi',
            'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 1,
        ]);

        WorkTime::create([
            'day_name' => 'Salı',
              'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 1,
        ]);

        WorkTime::create([
            'day_name' => 'Çarşamba',
              'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 1,
        ]);

        WorkTime::create([
            'day_name' => 'Perşembe',
              'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 1,
        ]);

        WorkTime::create([
            'day_name' => 'Cuma',
              'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 1,
        ]);

        WorkTime::create([
            'day_name' => 'Cumartesi',
              'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 1,
        ]);

        WorkTime::create([
            'day_name' => 'Pazar',
              'open_time' => '00:00',
            'close_time' => '24:00',
            'status' => 0,
        ]);
    }
}
