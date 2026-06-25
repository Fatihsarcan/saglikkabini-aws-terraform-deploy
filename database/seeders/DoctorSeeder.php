<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            ['name' => 'Dr. Ayşe Kaya',    'specialty' => 'Kardiyoloji',  'bio' => '15 yıllık deneyimli kardiyoloji uzmanı.'],
            ['name' => 'Dr. Mehmet Demir', 'specialty' => 'Dahiliye',     'bio' => 'İç hastalıkları ve genel sağlık alanında uzman.'],
            ['name' => 'Dr. Zeynep Çelik', 'specialty' => 'Ortopedi',     'bio' => 'Kemik ve eklem hastalıkları uzmanı.'],
            ['name' => 'Dr. Ahmet Yıldız', 'specialty' => 'Nöroloji',     'bio' => 'Sinir sistemi hastalıkları alanında uzman.'],
            ['name' => 'Dr. Fatma Arslan', 'specialty' => 'Dermatoloji',  'bio' => 'Cilt hastalıkları ve estetik dermatoloji uzmanı.'],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
