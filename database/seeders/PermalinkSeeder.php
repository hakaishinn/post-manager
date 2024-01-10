<?php

namespace Database\Seeders;

use App\Models\Permalink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermalinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permalink::create([
            'name' => 'ID'
        ]);
    }
}
