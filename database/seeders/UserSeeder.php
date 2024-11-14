<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create Super Admin User
        User::create([
            'id' => 5,
            'name' => 'SuperAdminUser',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('superpassword'),
            'role' => 'Super Admin',
            'is_active' => 1,
        ]);

        // Create a user
        User::create([
            'id' => 1,
            'name' => 'Admin1',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'is_active' => 1,
        ]);

        // Create Admin User 2
        User::create([
            'id' => 2,
            'name' => 'Admin2',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'is_active' => 1,
        ]);

        // Create Regular User 1
        User::create([
            'id' => 3,
            'name' => 'User1',
            'email' => 'user1@user.com',
            'password' => Hash::make('password'),
            'role' => 'User',
            'is_active' => 1,
        ]);

        // Create Regular User 2
        User::create([
            'id' => 4,
            'name' => 'User2',
            'email' => 'user2@user.com',
            'password' => Hash::make('password'),
            'role' => 'User',
            'is_active' => 1,
        ]);
    }
}
