<?php

namespace Database\Seeders;

use App\Models\Align;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aligns = [
            [
                'name' => 'Center',
            ],
            [
                'name' => 'Left',
            ],
            [
                'name' => 'Right',
            ],
        ];

        try {
            foreach ($aligns as $align) {
                Align::create($align);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
