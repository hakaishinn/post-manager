<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'text_color' => '#000000',
            'font_size' => '14',
            'font_name' => '',
            'font_name' => '',
            'permalink_id' => 1,
            'logo' => 'https://genplusmedia.online/img/genplus.png',
            'favicon' => 'https://zaly.online/favicon.ico',
            'site_title' => 'Zaly Online',
        ]);
    }
}
