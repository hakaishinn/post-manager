<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/companies/json/1.json?api_key=0906429283');
        $companies = collect($response['data'])->map(function ($company) {
            return [
                'id' => $company['id'],
                'name' => $company['name']
            ];
        });
        try {
            foreach ($companies as $company) {
                Company::create($company);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
