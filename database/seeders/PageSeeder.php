<?php

namespace Database\Seeders;

use App\Models\Advertise;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::all()->map(function($user){
            return $user['id'];
        });
        $response = Http::get('https://genplusmedia.online/nodes/nodes/json/1.json?api_key=0906429283&get_meta=1');
        $pages = collect($response['data'])->map(function ($page) use ($userId){
            return [
                'id' => $page['id'],
                'name' => $page['name'],
                'slug' => $page['slug'],
                'description' => $page['description'],
                'body' => $page['body'],
                'image' => $page['image'],
                'status_id' => random_int(1,2),
                'website_id' => 88,
                'creater_id' => $userId[array_rand($userId->toArray())],
                'updater_id' => $userId[array_rand($userId->toArray())],
                'company_id' => $page['company']['id'] != 0 ? $page['company']['id'] : null,
                'meta' => json_encode($page['meta']),
                'yoast-seo' => json_encode($page['yoast-seo']),
            ];
        });

        try {
            foreach ($pages as $page) {
                Page::create($page);
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        $advertiseDBs = Advertise::all();
        $pageId = Page::all()->map(function($page){
            return $page['id'];
        });
        try {
            foreach ($advertiseDBs as $advertiseDB) {
                $advertiseDB->pages()->attach([$pageId[array_rand($pageId->toArray())]]);
            };
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
