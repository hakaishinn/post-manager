<?php

namespace Database\Seeders;

use App\Models\Keyword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keywords = [
            [
                'name' => '',
            ],
            [
                'name' => 'mu',
            ],
            [
                'name' => 'fifa',
            ],
            [
                'name' => 'pubg',
            ],
            [
                'name' => 'viit',
            ],
        ];

        try {
            foreach ($keywords as $keyword) {
                Keyword::create($keyword);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
