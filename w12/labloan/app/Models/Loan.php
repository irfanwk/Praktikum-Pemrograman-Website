<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id', 'item_id', 'loan_date'];
}
