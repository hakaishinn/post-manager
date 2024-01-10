<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::all()->map(function($user){
            return $user['id'];
        });
        $response = Http::get('https://genplusmedia.online/menus/links/json/1.json?api_key=0906429283');
        $menus = collect($response['data'])->map(function ($menu) use($userId){
            return [
                'id' => $menu['id'],
                'name' => $menu['name'],
                'url' => $menu['url'],
                'target' => $menu['target'],
                'icon' => $menu['icon'],
                'class_name' => $menu['class_name'],
                'status_id' => random_int(1,2),
                'type_id' => $menu['type']['id'] != 0 ? $menu['type']['id'] : null,
                'website_id' => 88,
                'parent_id' => $menu['parent']['id'] != 0 ? $menu['parent']['id'] : null,
                'brand_id' => $menu['brand']['id'] != 0 ? $menu['brand']['id'] : null,
                'creater_id' => $userId[array_rand($userId->toArray())],
                'updater_id' => $userId[array_rand($userId->toArray())],
                'status' => 1
            ];

        });

        try {
            foreach ($menus as $menu) {
                Menu::create($menu);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
