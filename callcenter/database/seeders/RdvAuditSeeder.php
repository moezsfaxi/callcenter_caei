<?php

namespace Database\Seeders;

use App\Models\RdvAudit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RdvAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RdvAudit::factory()->count(150)->create();

    }
}
