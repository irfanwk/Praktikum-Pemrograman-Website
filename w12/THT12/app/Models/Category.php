<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function tickets()
    {
        // Penjelasan: Satu Kategori punya banyak Ticket laporan
        return $this->hasMany(Ticket::class);
    }
}
