<?php

namespace Database\Seeders;

use App\Models\Link;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'name' => 'Entertainment',
                'url' => '/category/entertainment/',
                'website_id' => 88,
            ],
            [
                'name' => 'Football',
                'url' => '/category/football/',
                'website_id' => 88,
            ],
            [
                'name' => 'Funny',
                'url' => '/category/tattoo/',
                'website_id' => 88,
            ],
            [
                'name' => 'About Us',
                'url' => '/about-us//',
                'website_id' => 88,
            ],
        ];

        try {
            foreach ($links as $link) {
                Link::create($link);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
