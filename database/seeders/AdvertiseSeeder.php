<?php

namespace Database\Seeders;

use App\Models\Advertise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AdvertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/advertises/json/1.json?api_key=0906429283');
        $advertises = collect($response['data'])->map(function ($advertise) {
            return [
                'id' => $advertise['id'],
                'name' => $advertise['name'],
                'body' => $advertise['body'],
                'delay_time' => $advertise['delay_time'],
                'position_id' => $advertise['position']['id'] != 0 ? $advertise['position']['id'] : null,
                'align_id' => $advertise['align']['id'] != 0 ? $advertise['align']['id'] : null,
                'class_id' => 1,
                'website_id' => 88,
                'status_id' => random_int(1,2),
                'type_id' => $advertise['type']['id'] != 0 ? $advertise['type']['id'] : null,
                'company_id' => $advertise['company']['id'] != 0 ? $advertise['company']['id'] : null,
                'status' => 1
            ];
        });

        try {
            foreach ($advertises as $advertise) {
                Advertise::create($advertise);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
