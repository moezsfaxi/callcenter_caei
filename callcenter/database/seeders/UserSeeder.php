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

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'image_de_profil' => 'profile_pictures/QEoGoTZhfqJuxU4a9R4uNzgQ4PuKynd4zNcUJLRg.png',
            'password' => \Illuminate\Support\Facades\Hash::make('adminpassword'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'agent User 1',
            'email' => 'agent1@example.com',
            'role' => 'agent',
            'image_de_profil' => 'profile_pictures/VXNrHG1Q4vl20DCtEJkGsqY9JFB3Lwin6BfDIsgw.png',
            'password' => \Illuminate\Support\Facades\Hash::make('agent123'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'agent User 2',
            'email' => 'agent2@example.com',
            'role' => 'agent',
            'image_de_profil' => 'profile_pictures/VXNrHG1Q4vl20DCtEJkGsqY9JFB3Lwin6BfDIsgw.png',
            'password' => \Illuminate\Support\Facades\Hash::make('agent123'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'agent User 3',
            'email' => 'agent3@example.com',
            'role' => 'agent',
            'image_de_profil' => 'profile_pictures/VXNrHG1Q4vl20DCtEJkGsqY9JFB3Lwin6BfDIsgw.png',
            'password' => \Illuminate\Support\Facades\Hash::make('agent123'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'agent User 4',
            'email' => 'agent4@example.com',
            'role' => 'agent',
            'image_de_profil' => 'profile_pictures/VXNrHG1Q4vl20DCtEJkGsqY9JFB3Lwin6BfDIsgw.png',
            'password' => \Illuminate\Support\Facades\Hash::make('agent123'), // Custom password for the admin
        ]);

        User::factory()->create([
            'name' => 'partenaire User 1',
            'email' => 'partenaire1@example.com',
            'role' => 'partenaire',
            'image_de_profil' => 'avatars/9bP9JSN5B32GpKoMyvVwLA8LQA0kblQmBF8ajyIT.jpg',
            'password' => \Illuminate\Support\Facades\Hash::make('partenaire123'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'partenaire User 2',
            'email' => 'partenaire2@example.com',
            'role' => 'partenaire',
            'image_de_profil' => 'avatars/9bP9JSN5B32GpKoMyvVwLA8LQA0kblQmBF8ajyIT.jpg',
            'password' => \Illuminate\Support\Facades\Hash::make('partenaire123'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'partenaire User 3',
            'email' => 'partenaire3@example.com',
            'role' => 'partenaire',
            'image_de_profil' => 'avatars/9bP9JSN5B32GpKoMyvVwLA8LQA0kblQmBF8ajyIT.jpg',
            'password' => \Illuminate\Support\Facades\Hash::make('partenaire123'), // Custom password for the admin
        ]);
        User::factory()->create([
            'name' => 'partenaire User 4',
            'email' => 'partenaire4@example.com',
            'role' => 'partenaire',
            'image_de_profil' => 'avatars/9bP9JSN5B32GpKoMyvVwLA8LQA0kblQmBF8ajyIT.jpg',
            'password' => \Illuminate\Support\Facades\Hash::make('partenaire123'), // Custom password for the admin
        ]);

        User::factory()->create([
            'name' => 'superviseur User ',
            'email' => 'superviseur@example.com',
            'role' => 'superviseur',
            'image_de_profil' => 'avatars/sERi2CXD9kEH6buGR3fqPkr7RrC7ULkGT5cGdJOB.png',
            'password' => \Illuminate\Support\Facades\Hash::make('superviseur123'), // Custom password for the admin
        ]);






    }
}