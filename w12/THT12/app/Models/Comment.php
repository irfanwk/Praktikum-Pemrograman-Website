<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'message'];

    public function ticket()
    {
        //  Komentar ini ada di tiket yang mana?
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        //  Siapa yang menulis komentar ini?
        return $this->belongsTo(User::class);
    }
}
