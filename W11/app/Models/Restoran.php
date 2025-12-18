<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    use HasFactory;

    /**
     * TODO 1: Atur properti $fillable atau $guarded
     * 
     * Pilih salah satu:
     * - protected $fillable = ['nama', 'email', 'alamat', 'no_telp'];
     *   ATAU
     * - protected $guarded = [];
     * 
     * Hint: $fillable digunakan untuk whitelist kolom yang boleh di-mass assign
     *       $guarded digunakan untuk blacklist kolom yang tidak boleh di-mass assign
     */
    
    // TODO: Tulis kode di sini
    protected $fillable = ['nama', 'email', 'alamat', 'no_telp'];

    /**
     * TODO 2: Definisikan Relasi One-to-Many
     * 
     * Satu Restoran memiliki banyak Menu
     * 
     * Gunakan fungsi hasMany() dari Eloquent
     * Contoh: return $this->hasMany(NamaModel::class);
     * 
     * Hint: Nama fungsi harus menus() (jamak)
     */
    
    public function menus()
    {
        // TODO: Tulis kode relasi di sini
        return $this->hasMany(Menu::class);
    }
}
