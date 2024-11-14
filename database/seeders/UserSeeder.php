<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Always hash the password
        ]);

        // Create a regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Optionally, you can create more users
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
