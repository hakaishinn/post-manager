<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TypeOfMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cache::flush();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            BrandSeeder::class,
            TypeOfMenuSeeder::class,
            TypeOfAdvertiseSeeder::class,
            StatusSeeder::class,
            TechnologySeeder::class,
            AnalyticSeeder::class,
            TeamSeeder::class,
            TrafficSeeder::class,
            DepartmentSeeder::class,
            ServerSeeder::class,
            PermalinkSeeder::class,
            CompanySeeder::class,
            SettingSeeder::class,
            WebsiteSeeder::class,
            MenuSeeder::class,
            KeywordSeeder::class,
            PositionSeeder::class,
            AlignSeeder::class,
            ClassSeeder::class,
            DisplayHomeSeeder::class,
            ColorSeeder::class,
            TagSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            AdvertiseSeeder::class,
            PageSeeder::class,
            ApiKeySeeder::class
        ]);
    }
}
