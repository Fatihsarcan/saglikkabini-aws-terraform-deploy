<?php

namespace Database\Seeders;

use App\Models\MainSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'logo',
                'value' => 'logo.png',
                'type' => 'file',
            ],
            [
                'key' => 'telefon',
                'value' => '0538-768-5754',
                'type' => 'text',
            ],
            [
                'key' => 'email',
                'value' => '@gmail.com',
                'type' => 'text',
            ],
            [
                'key' => 'favicon',
                'value' => 'favicon.png',
                'type' => 'file',
            ],
            [
                'key' => 'facebook',
                'value' => '#',
                'type' => 'text',
            ],
            [
                'key' => 'twitter',
                'value' => '#',
                'type' => 'text',
            ],
            [
                'key' => 'instagram',
                'value' => '#',
                'type' => 'text',
            ],

            [
                'key' => 'home_hero_title_1',
                'value' => 'Serum',
                'type' => 'text',
            ],
            [
                'key' => 'home_hero_description_1',
                'value' => 'Serum hizmeti',
                'type' => 'text',
            ],
            [
                'key' => 'home_hero_image_1',
                'value' => 'fa-solid fa-user-doctor',
                'type' => 'text',
            ],

            [
                'key' => 'home_hero_title_2',
                'value' => 'Serum Hizmetleri',
                'type' => 'text',
            ],
            [
                'key' => 'home_hero_description_2',
                'value' => 'Enjeksiyon Hizmetleri',
                'type' => 'text',
            ],
            [
                'key' => 'home_hero_image_2',
                'value' => 'fa-solid fa-user-doctor',
                'type' => 'text',
            ],

            [
                'key' => 'home_hero_title_3',
                'value' => 'Vitamin Alımı Hizmetleri',
                'type' => 'text',
            ],
            [
                'key' => 'home_hero_description_3',
                'value' => 'Pansuman Hizmetleri',
                'type' => 'text',
            ],
            [
                'key' => 'home_hero_image_3',
                'value' => 'fa-solid fa-user-doctor',
                'type' => 'text',
            ],
            [
                'key' => 'address',
                'value' => 'Mersin, Türkiye',
                'type' => 'text',
            ],
            [
                'key' => 'map',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3194.0019829252137!2d34.6461089!3d36.8184724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1527f3b0896f3cfb%3A0x4f95bde28b6354b7!2sECUMAR%20PERFORMANCE%20MERS%C4%B0N%20ARA%C3%87%20YAZILIM!5e0!3m2!1str!2str!4v1773482286654!5m2!1str!2str',
                'type' => 'text',
            ],
            [
                'key' => 'video_url',
                'value' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'type' => 'text',
            ],
            [
                'key' => 'copyright',
                'value' => 'Tüm Hakları Saklıdır.',
                'type' => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            MainSetting::create($setting);
        }
    }
}
