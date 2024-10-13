<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a user
        User::create([
            'id' => 1,
            'name' => 'Amosaleksiatoziliwu',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'), // Use bcrypt to hash password
            'role' => 'Admin',
        ]);
    }
}
