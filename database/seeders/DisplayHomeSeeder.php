<?php

namespace Database\Seeders;

use App\Models\DisplayHome;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisplayHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DisplayHome::create([
            'name' => 'Yes'
        ]);
    }
}
