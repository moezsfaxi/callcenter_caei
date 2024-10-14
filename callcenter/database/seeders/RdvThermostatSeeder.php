<?php

namespace Database\Seeders;

use App\Models\RdvThermostat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RdvThermostatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RdvThermostat::factory()->count(10)->create();
    }
}
