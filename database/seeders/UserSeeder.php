<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat user default.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // Admin
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Kepala Gudang
        User::create([
            'name'     => 'Kepala Gudang',
            'email'    => 'kepala@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'kepala_gudang',
        ]);

        // Teknisi
        User::create([
            'name'     => 'Teknisi 1',
            'email'    => 'teknisi@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'teknisi',
        ]);
        User::create([
            'name'     => 'Teknisi 2',
            'email'    => 'teknisi2@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'teknisi',
        ]);
        User::create([
            'name'     => 'Teknisi 3',
            'email'    => 'teknisi@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'teknisi',
        ]);

        // Helper
        User::create([
            'name'     => 'Helper 1',
            'email'    => 'helper@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'helper',
        ]);
    }
}
