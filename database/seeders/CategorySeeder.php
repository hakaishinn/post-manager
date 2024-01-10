<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::all()->map(function ($user) {
            return $user['id'];
        });

        $colorId = Color::all()->map(function ($color) {
            return $color['id'];
        });
        $response = Http::get('https://genplusmedia.online/manager/categories/json/1.json?api_key=0906429283&get_meta=1');

        $categories = collect($response['data'])->map(function ($category) use ($userId, $colorId) {
            return [
                'id' => $category['id'],
                'name' => $category['name'],
                'layout_name' => 'section-flex-horizontal',
                'quantity_post' => random_int(3,4),
                'slug' => $category['slug'],
                'description' => $category['description'],
                'body' => $category['body'],
                'image' => $category['image'],
                'status_name' => $category['status_name'],
                'status_code' => $category['status_code'],
                'status' => 1,
                'publish' => $category['publish'],
                'cate_wp_id' => $category['cate_wp_id'],
                'company_id' => $category['company']['id'] != 0 ?  $category['company']['id'] : null,
                'creater_id' => $userId[array_rand($userId->toArray())],
                'updater_id' => $userId[array_rand($userId->toArray())],
                'parent_id' =>  ($category['parent']['id'] != 0 && $category['parent']['id'] != 100 && $category['parent']['id'] != 136) ?  $category['parent']['id'] : null,
                'website_id' => 88,
                'display_home_id' => $category['display_home']['id'] != 0 ?  $category['display_home']['id'] : null,
                'color_id' => $colorId[array_rand($colorId->toArray())],
                'meta' => json_encode($category['meta']),
                'yoast-seo' => json_encode($category['yoast-seo']),
            ];
        });

        try {
            foreach ($categories as $category) {
                Category::create($category);
            }
            $categoriesDB = Category::where('name', 'NBA')->get();

            foreach ($categoriesDB as $category) {
                $category->layout_name = 'section-grid-quad';
                $category->quantity_post = 4;
                $category->save();
            }
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
