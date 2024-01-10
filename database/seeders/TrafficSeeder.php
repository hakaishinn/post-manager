<?php

namespace Database\Seeders;

use App\Models\Traffic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrafficSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Traffic::create([
            'traffics_total' => 0,
            'class' => 'success',
            'width' => '100',
        ]);
    }
}
