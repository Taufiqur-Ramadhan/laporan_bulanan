<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Admin
        \App\Models\User::create([
            'name' => 'Admin Verifikator',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Buat Anggota
        \App\Models\User::create([
            'name' => 'Anggota Inputer',
            'email' => 'anggota@test.com',
            'password' => bcrypt('password'),
            'role' => 'anggota',
        ]);
    }
}
