<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                "name" => "Post"
            ],
            [
                "name" => "Page"
            ],
            [
                "name" => "Category"
            ],
            [
                "name" => "Tag"
            ],
            [
                "name" => "Other"
            ],
        ];

        try {
            foreach($brands as $brand){
                Brand::create($brand);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
