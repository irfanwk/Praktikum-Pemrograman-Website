<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * TODO 1: Atur properti $fillable atau $guarded
     * 
     * Kolom yang perlu di-mass assign:
     * - restoran_id
     * - nama
     * - harga
     * - jumlah
     * 
     * Pilih salah satu:
     * - protected $fillable = [...];
     *   ATAU
     * - protected $guarded = [];
     */
    
    // TODO: Tulis kode di sini
    protected $fillable = ['restoran_id', 'nama', 'harga', 'jumlah'];

    /**
     * TODO 2: Definisikan Relasi Many-to-One (Belongs To)
     * 
     * Setiap Menu dimiliki oleh satu Restoran
     * 
     * Gunakan fungsi belongsTo() dari Eloquent
     * Contoh: return $this->belongsTo(NamaModel::class);
     * 
     * Hint: Nama fungsi harus restoran() (tunggal)
     */
    
    public function restoran()
    {
        // TODO: Tulis kode relasi di sini
        return $this->belongsTo(Restoran::class);
    }
}
