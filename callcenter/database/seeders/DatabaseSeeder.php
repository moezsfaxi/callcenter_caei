<?php

namespace Database\Seeders;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RdvAuditSeeder::class);        
        $this->call(RdvPanneauxPhotovoltaiqueSeeder::class);
        $this->call(RdvPompeAChaleurSeeder::class);
        $this->call(RdvThermostatSeeder::class);

    }
}
