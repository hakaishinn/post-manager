<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/colors/json/1.json?api_key=0906429283');
        $colors = collect($response['data'])->map(function ($color) {
            return [
                'id' => $color['id'],
                'background' => $color['background_color'],
                'text' => $color['text_color'],
                'status_id' => random_int(1,2),
                'website_id' => 88,
                'menu_id' =>  $color['menu']['id'] != 0 ? $color['menu']['id'] : null,
                'creater_id' => 2,
                'updater_id' => 2,
                'status' => 1
            ];
        });

        try {
            foreach ($colors as $color) {
                Color::create($color);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
