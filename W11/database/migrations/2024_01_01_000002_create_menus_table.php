<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * TODO: Buat tabel 'menus' dengan kolom-kolom berikut:
     * - id (Primary Key) -> gunakan $table->id()
     * - restoran_id (Foreign Key) -> gunakan $table->foreignId('restoran_id')
     * - nama (String) -> gunakan $table->string('nama')
     * - harga (Integer) -> gunakan $table->integer('harga')
     * - jumlah (Integer) -> gunakan $table->integer('jumlah')
     * - timestamps -> gunakan $table->timestamps()
     * 
     * PENTING: Untuk Foreign Key, pastikan menggunakan onDelete('cascade')
     * Contoh: $table->foreignId('restoran_id')->constrained()->onDelete('cascade');
     * 
     * Penjelasan cascade: Jika restoran dihapus, semua menu yang terkait akan ikut terhapus
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            // TODO: Tulis kode pembuatan kolom di sini
            $table->id();
            $table->foreignId('restoran_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
