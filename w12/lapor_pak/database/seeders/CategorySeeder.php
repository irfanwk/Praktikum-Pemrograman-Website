<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'IT & Jaringan',
            'Kebersihan',
            'Fasilitas Kelas',
            'Sarana Prasarana',
            'Akademik',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
