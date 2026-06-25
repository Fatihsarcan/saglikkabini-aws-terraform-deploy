<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::create([

            'name' => 'Fatih',
            'slug' => 'fatih',
            'image' => 'img/team/b1.jpg',
            'content' => 'Fatih Sarcan Yazılım Mühendisi',
            'short_content' => 'Fatih Sarcan Yazılım Mühendisi',
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#',
            'linkedin' => '#',
        ]);


        Team::create([

            'name' => 'kadir yılmaz',
            'slug' => 'kadir-yılmaz',
            'image' => 'img/team/b2.jpg',
            'content' => 'Kadir Yılmaz ',
            'short_content' => 'Kadir Yılma',
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#',
            'linkedin' => '#',
        ]);

        Team::create([

            'name' => 'Mehmet Yılmaz',
            'slug' => 'mehmet-yilmaz',
            'image' => 'img/team/b3.jpg',
            'content' => 'Mehmet Yılmaz',
            'short_content' => 'Mehmet Yılmaz ',
            'facebook' => '#',
            'twitter' => '#',
            'instagram' => '#',
            'linkedin' => '#',
        ]);
    }
}
