<?php

namespace Database\Seeders;

use App\Models\TypeOfAdvertise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfAdvertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'id' => 1,
                'name' => 'Google',
            ],
            [
                'id' => 2,
                'name' => 'Adkeeper',
            ],
            [
                'id' => 3,
                'name' => 'Ads',
            ],
            [
                'id' => 4,
                'name' => 'Unibot',
            ],
        ];

        try {
            foreach ($types as $type) {
                TypeOfAdvertise::create($type);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
