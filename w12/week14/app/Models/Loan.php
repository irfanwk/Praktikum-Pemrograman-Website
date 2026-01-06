<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{  
    protected $fillable = ['user_id', 'item_id', 'return_date', 'status'];

    public function item(){
        return $this->belongsTo(Item::class);
    }
}


//composer global require laravel/installer
