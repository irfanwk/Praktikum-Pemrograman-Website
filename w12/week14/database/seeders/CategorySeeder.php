<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Elektronik']);
        \App\Models\Category::create(['name' => 'Pakaian']);
        \App\Models\Category::create(['name' => 'Alat Tulis']);
        \App\Models\Category::create(['name' => 'Perabotan']);
    }
}
