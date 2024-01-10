<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ApiKey::create([
            'id' => 1,
            'name' => 'u382t',
            'key' => 'XxD1MB1MtBXYD32nNFFTnVuESBSzxsVjbVQ9fRT1gmV37HBaBK8Hv1ZmSjwEK8wf',
            'active' => 1
        ]);

        $permissionsApiId = Permission::all()->map(function ($permission){
            return $permission['id'];
        });

        ApiKey::find(1)->permissions()->attach($permissionsApiId);
    }
}
