<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'name' => 'class',
                'number' => 1,
                'repeat_content_number' => 0,
            ],
        ];

        try {
            foreach ($classes as $class) {
                Classes::create($class);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
