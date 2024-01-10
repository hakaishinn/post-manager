<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::all()->map(function ($user) {
            return $user['id'];
        });
        $response = Http::get('https://genplusmedia.online/manager/websites/json/1.json?api_key=0906429283&get_meta=1');
        $websites = collect($response['data'])->map(function ($website) use ($userId) {
            return [
                'id' => $website['id'],
                'name' => $website['name'],
                'body' => $website['body'],
                'domain' => $website['domain'],
                'status_code' => $website['status_code'],
                'status_name' => $website['status_name'],
                'technology_id' => $website['technology']['id'] != 0 ? $website['technology']['id'] : null,
                'manager_id' => $userId[array_rand($userId->toArray())],
                'company_id' => $website['company']['id'] != 0 ? $website['company']['id'] : null,
                'creater_id' => $userId[array_rand($userId->toArray())],
                'updater_id' => $userId[array_rand($userId->toArray())],
                'analytic_id' => 4,
                'team_id' => $website['team']['id'] != 0 ? $website['team']['id'] : null,
                'traffic_id' => 1,
                'department_id' => $website['department']['id'] != 0 ? $website['department']['id'] : null,
                'analytic_code' => $website['analytic_code'],
                'server_id' => $website['server']['id'] != 0 ? $website['server']['id'] : null,
                'setting_id' => 1,
                'meta' => json_encode($website['meta']),
                'yoast-seo' => json_encode($website['yoast-seo']),
                'status' => 1
            ];
        });
        try {
            foreach ($websites as $website) {
                if($website['id'] == 136){
                    if(!Website::find(136)){
                        Website::create($website);
                    }
                } else {
                    Website::create($website);
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
