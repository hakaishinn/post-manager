<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'id' => 1,
                'name' => 'Before Post',
            ],
            [
                'id' => 2,
                'name' => 'Before Content',
            ],
            [
                'id' => 3,
                'name' => 'Before Paragraph',
            ],
            [
                'id' => 4,
                'name' => 'After Paragraph',
            ],
            [
                'id' => 7,
                'name' => 'After Content',
            ],
            [
                'id' => 8,
                'name' => 'After Post',
            ],
            [
                'id' => 18,
                'name' => 'Header',
            ],
            [
                'id' => 19,
                'name' => 'Footer',
            ],
            [
                'id' => 21,
                'name' => 'Auto Head',
            ],
        ];

        try {
            foreach ($positions as $position) {
                Position::create($position);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
