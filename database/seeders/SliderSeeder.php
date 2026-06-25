<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'lang' => 'tr',
            'name' => 'Sağlık Hizmeti Almak İçin ',
            'content' => 'Bizimle İletişime Geçin',
            'button_text' => '+90-538-768-57-54',
            'button_link' => 'hizmetler',
            'image' => 'img/slider/1.jpg',
            'status' => 1,
        ]);

        Slider::create([
            'lang' => 'en',
            'name' => 'Sağlık Hizmeti Almak İçin ',
            'content' => 'Bizimle İletişime Geçin',
            'button_text' => '+90-538-768-57-54',
            'button_link' => '+90-538-768-57-54',
            'image' => 'img/slider/1.jpg',
            'status' => 1,
        ]);
    }
}
