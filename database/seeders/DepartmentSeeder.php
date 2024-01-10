<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('https://genplusmedia.online/manager/departments/json/1.json?api_key=0906429283');
        $departments = collect($response['data'])->map(function ($department) {
            return [
                'id' => $department['id'],
                'name' => $department['name']
            ];
        });
        try {
            foreach ($departments as $department) {
                Department::create($department);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
