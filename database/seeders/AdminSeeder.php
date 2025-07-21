<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\UserRole;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => UserRole::Admin->value,
        ]);

        // Member
        User::create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'password' => Hash::make('member123'),
            'role' => UserRole::Member->value,
        ]);
    }
}
