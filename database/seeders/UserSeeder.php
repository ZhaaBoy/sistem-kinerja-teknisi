<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat user default.
     */
    public function run(): void
    {
        // Bersihkan tabel agar tidak duplikat
        User::truncate();

        // Admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@system.test',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Kepala Gudang
        User::create([
            'name'     => 'Kepala Gudang',
            'email'    => 'kepala@gudang.test',
            'password' => Hash::make('password'),
            'role'     => 'kepala_gudang',
        ]);

        // Teknisi
        User::create([
            'name'     => 'Teknisi 1',
            'email'    => 'teknisi@test.com',
            'password' => Hash::make('password'),
            'role'     => 'teknisi',
        ]);

        // Helper
        User::create([
            'name'     => 'Helper 1',
            'email'    => 'helper@test.com',
            'password' => Hash::make('password'),
            'role'     => 'helper',
        ]);
    }
}
