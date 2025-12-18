<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * TODO: Buat tabel 'restorans' dengan kolom-kolom berikut:
     * - id (Primary Key, BigInt, Auto Increment) -> gunakan $table->id()
     * - nama (String) -> gunakan $table->string('nama')
     * - email (String) -> gunakan $table->string('email')
     * - alamat (Text) -> gunakan $table->text('alamat')
     * - no_telp (String) -> gunakan $table->string('no_telp')
     * - timestamps (created_at, updated_at) -> gunakan $table->timestamps()
     */
    public function up(): void
    {
        Schema::create('restorans', function (Blueprint $table) {
            // TODO: Tulis kode pembuatan kolom di sini
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->text('alamat');
            $table->string('no_telp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restorans');
    }
};
