<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
            'role' => 'Admin',
        ]);
        User::factory()->create([
            'name' => 'Fathur Rohman',
            'email' => 'kaprodi@gmail.com',
            'password' => '12345678',
            'role' => 'Kaprodi'
        ]);
    }
}
