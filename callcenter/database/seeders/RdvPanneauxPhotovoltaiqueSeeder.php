<?php

namespace Database\Seeders;

use App\Models\RdvPanneauxPhotovoltaique;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RdvPanneauxPhotovoltaiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RdvPanneauxPhotovoltaique::factory()->count(10)->create();
    }
}
