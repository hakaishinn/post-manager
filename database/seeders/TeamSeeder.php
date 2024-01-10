<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/teams/json/1.json?api_key=0906429283');
        $teams = collect($response['data'])->map(function ($team) {
            return [
                'id' => $team['id'],
                'name' => $team['name']
            ];
        });
        try {
            foreach ($teams as $team) {
                Team::create($team);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
