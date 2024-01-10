<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::all()->map(function($user){
            return $user['id'];
        });
        $response = Http::get('https://genplusmedia.online/manager/tags/json/1.json?api_key=0906429283&get_meta=1');
        $tags = collect($response['data'])->map(function ($tag) use($userId) {
            return [
                'id' => $tag['id'],
                'name' => $tag['name'],
                'slug' => $tag['slug'],
                'description' => $tag['description'],
                'body' => $tag['body'],
                'image' => $tag['image'],
                'status_name' => $tag['status_name'],
                'status_code' => $tag['status_code'],
                'status' => 1,
                'publish' => $tag['publish'],
                'tag_wp_id' => $tag['tag_wp_id'],
                'company_id' => $tag['company']['id'] != 0 ? $tag['company']['id'] : null,
                'creater_id' => $userId[array_rand($userId->toArray())],
                'updater_id' => $userId[array_rand($userId->toArray())],
                'parent_id' => $tag['parent']['id'] != 0 ? $tag['parent']['id'] : null,
                'website_id' => 88,
                'meta' => json_encode($tag['meta']),
                'yoast-seo' => json_encode($tag['yoast-seo']),
            ];
        });

        try {
            foreach ($tags as $tag) {
                Tag::create($tag);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
