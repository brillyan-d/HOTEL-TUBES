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
        // 1. Akun Admin (role: admin)
        User::create([
            'name' => 'Hotel Admin',
            'email' => 'admin@hotel.com', // Email Login Admin
            'password' => Hash::make('password'), // Password Default: password
            'role' => 'admin',
        ]);

        // 2. Akun User Biasa (role: user)
        User::create([
            'name' => 'Customer Test',
            'email' => 'user@hotel.com', // Email Login User
            'password' => Hash::make('password'), // Password Default: password
            'role' => 'user',
        ]);

        // Default User
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'user', // Tambahkan role default
        ]);
    }
}
