<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
public function run(): void
    {
        $elektronik = \App\Models\Category::where('name', 'Elektronik')->first()->id;
        $alatTulis = \App\Models\Category::where('name', 'Alat Tulis')->first()->id;

        $items = [
            [
                'name' => 'Mikroskop',
                'stock' => 5,
                'description' => 'Mikroskop digital untuk penelitian mikrobiologi',
                'category_id' => $elektronik
            ],
            [
                'name' => 'Beaker Glass 250ml',
                'stock' => 10,
                'description' => 'Gelas ukur untuk percobaan kimia',
                'category_id' => $alatTulis
            ],
            [
                'name' => 'Laptop Dell',
                'stock' => 3,
                'description' => 'Laptop untuk praktikum pemrograman',
                'category_id' => $elektronik
            ],
            [
                'name' => 'Proyektor',
                'stock' => 1,
                'description' => 'Proyektor untuk presentasi',
                'category_id' => $elektronik
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }       
    }
}
