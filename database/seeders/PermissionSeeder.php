<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'Hiển thị tất cả các bài viết',
                'slug' => 'show-all-post'
            ],
            [
                'name' => 'Hiển thị tất cả các thể loại',
                'slug' => 'show-all-category'
            ],
            [
                'name' => 'Hiển thị tất cả các tag',
                'slug' => 'show-all-tag'
            ],
            [
                'name' => 'Hiển thị tất cả các tác giả',
                'slug' => 'show-all-author'
            ],
            [
                'name' => 'Hiển thị tất cả các quảng cáo',
                'slug' => 'show-all-advertise'
            ],
            [
                'name' => 'Hiển thị tất cả các website',
                'slug' => 'show-all-website'
            ],
            [
                'name' => 'Hiển thị tất cả các menu',
                'slug' => 'show-all-menu'
            ],
            [
                'name' => 'Hiển thị tất cả các trang',
                'slug' => 'show-all-page'
            ],
            [
                'name' => 'Hiển thị tất cả các màu',
                'slug' => 'show-all-color'
            ],
        ];

        try {
            foreach ($permissions as $permission) {
                Permission::create($permission);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
