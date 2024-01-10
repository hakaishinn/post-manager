<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/technologies/json/1.json?api_key=0906429283');
        $technologies = collect($response['data'])->map(function($technology){
            return [
                'id' => $technology['id'],
                'name' => $technology['name']
            ];
        });
    
        try {
            foreach($technologies as $technology){
                Technology::create($technology);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
