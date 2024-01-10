<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],
            [
                'name' => 'User',
                'slug' => 'user'
            ]
        ];

        try {
            foreach($roles as $role){
                Role::create($role);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
