<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 random users
        //User::factory()->count(10)->create();

        // Optionally, create a specific admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('adminpassword'), // Custom password for the admin
        ]);
    }
}