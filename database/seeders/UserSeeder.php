<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/authors/json/1.json?api_key=0906429283&get_meta=1');
        $users = collect($response['data'])->map(function ($user) {
            return [
                'id' => $user['id'],
                'name' => $user['username'],
                'username' => $user['username'],
                'password' => '$2a$12$AA.MKHHB5Q8aQpbMoVhN/Oa66xUtWwYD4gqOfuG0PqL1QcLtAtnXq',
                'meta' => response()->json($user['meta']),
                'yoast-seo' => response()->json($user['yoast-seo']),
                'status' => 1,
            ];
        });

        try {
            foreach ($users as $user) {
                User::create($user);
            }
        } catch (\Throwable $th) {
            dd($th);
        }

        $usersDB = User::all();
        for ($i=0; $i < $usersDB->count(); $i++) { 
            if($i == 0){
                $usersDB[$i]->roles()->attach(1);
            } else {
                $usersDB[$i]->roles()->attach(2);
            }
        }
    }
}
