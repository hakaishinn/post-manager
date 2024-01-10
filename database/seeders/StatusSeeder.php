<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Yes',
            ],
            [
                'name' => 'No',
            ],
        ];

        try {
            foreach ($statuses as $status) {
                Status::create($status);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
