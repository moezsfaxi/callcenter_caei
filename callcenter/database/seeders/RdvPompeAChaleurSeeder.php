<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RdvPompeAChaleur;

class RdvPompeAChaleurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RdvPompeAChaleur::factory()->count(10)->create();
    }
}
