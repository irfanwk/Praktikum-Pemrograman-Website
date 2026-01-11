<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Sarpras',
            'email' => 'admin@kampus.ac.id',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create Regular Student User
        User::create([
            'name' => 'Mahasiswa Test',
            'email' => 'mahasiswa@kampus.ac.id',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create another student
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@kampus.ac.id',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
