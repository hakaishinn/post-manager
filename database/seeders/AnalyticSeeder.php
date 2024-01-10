<?php

namespace Database\Seeders;

use App\Models\Analytic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class AnalyticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/analytics/json/1.json?api_key=0906429283');
        $analytics = collect($response['data'])->map(function ($analytic) {
            return [
                'id' => $analytic['id'],
                'tracking' => $analytic['tracking'],
                'google_id' => $analytic['google_id'],
                'ga4_property_id' => $analytic['ga4_property_id'],
                'measurement_id' => $analytic['measurement_id'],
            ];
        });
        try {
            foreach ($analytics as $analytic) {
                Analytic::create($analytic);
            }
        } catch (\Throwable $th) {
           dd($th);
        }
    }
}
