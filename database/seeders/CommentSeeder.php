<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'name' => 'Mert Yılmaz',
            'content' => 'Çok iyi bir hizmet, teşşekkürler.',
            'star' => 5,
            'service_id' => 1,
            'status' => 1
        ]);
        Comment::create([
            'name' => 'Ahmet Yılmaz',
            'content' => 'Çok iyi bir hizmet, teşşekkürler.',
            'star' => 5,
            'service_id' => 2,
            'status' => 1
        ]);
    }
}
