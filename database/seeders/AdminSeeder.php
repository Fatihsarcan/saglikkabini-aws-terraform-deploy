<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@saglik.test',
            'password' => bcrypt('Admin1234!'),
            'is_admin' => true,
            'phone'    => '05001234567',
        ]);

        User::create([
            'name'     => 'Bedrock Agent',
            'email'    => 'bedrock@internal',
            'password' => bcrypt('bedrock-internal-' . str()->random(32)),
            'is_admin' => false,
        ]);
    }
}
