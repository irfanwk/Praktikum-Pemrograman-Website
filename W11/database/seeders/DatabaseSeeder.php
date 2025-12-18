<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 
     * TODO (OPTIONAL): Aktifkan RestoranSeeder agar data restoran otomatis terisi
     * saat menjalankan: php artisan db:seed
     */
    public function run(): void
    {
        // TODO: Uncomment baris di bawah untuk menjalankan RestoranSeeder
        $this->call([
            RestoranSeeder::class,
        ]);
    }
}
