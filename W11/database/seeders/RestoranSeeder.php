<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restoran;

class RestoranSeeder extends Seeder
{
    /**
     * PETUNJUK: Seeder ini digunakan untuk mengisi data awal (dummy data) 
     * ke tabel restorans agar praktikan bisa langsung testing API Menu
     * tanpa harus input data restoran manual.
     * 
     * TODO (OPTIONAL): Praktikan bisa menambahkan data restoran lain jika diinginkan
     * 
     * Cara menjalankan seeder:
     * php artisan db:seed --class=RestoranSeeder
     * 
     * ATAU jalankan semua seeder:
     * php artisan db:seed
     */
    public function run(): void
    {
        // Data restoran contoh
        $restorans = [
            [
                'nama' => 'Restoran Padang Sederhana',
                'email' => 'padang@example.com',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta',
                'no_telp' => '081234567890'
            ],
            [
                'nama' => 'Warung Sunda Mak Icih',
                'email' => 'sunda@example.com',
                'alamat' => 'Jl. Gatot Subroto No. 45, Bandung',
                'no_telp' => '081234567891'
            ],
            [
                'nama' => 'Seafood Pak Haji',
                'email' => 'seafood@example.com',
                'alamat' => 'Jl. Malioboro No. 78, Yogyakarta',
                'no_telp' => '081234567892'
            ]
        ];

        // Insert data ke database
        foreach ($restorans as $restoran) {
            Restoran::create($restoran);
        }

        $this->command->info('Data restoran berhasil ditambahkan!');
    }
}
