<?php

namespace Database\Seeders;

use App\Models\TypeOfMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'id' => 3,
                'name' => 'Main Menu',
                'level' => 1,
                'background_color' => '#000',
                'text_color' => '#fff',
            ],
            [
                'id' => 4,
                'name' => 'Footer',
                'level' => 1,
                'background_color' => '#000',
                'text_color' => '#fff',
            ],
        ];

        try {
            foreach ($types as $type) {
                TypeOfMenu::create($type);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
