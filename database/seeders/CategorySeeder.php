<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['روانشناسی', 'فلسفه و عرفان', 'داستانی', 'تاریخی', 'سیاسی', 'عمومی', 'کودک و نوجوان'];

        foreach ($categories as $category) {
            Category::create([
                'title' => $category,
                'slug' => Str::customSlug($category)
            ]);
        }
    }
}
