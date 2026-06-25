<?php

namespace Database\Seeders;

use App\Models\Referance;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReferanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Referance::create([
            'name' => 'Sağlık Kabini',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image' => 'img/clients/5.png',
            'status' => 1,
        ]);

        Referance::create([
            'name' => 'Sağlık Kabini Laravel',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            'image' => 'img/clients/6.png',
            'status' => 1,
        ]);
    }
}
