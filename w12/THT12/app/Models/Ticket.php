<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'location', 'image_path', 'status'];

    public function user()
    {
        // Tiket ini milik siapa? (Relasi balik ke User)
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        // Tiket ini masuk kategori apa?
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        // Satu tiket bisa punya banyak komentar/diskusi
        return $this->hasMany(Comment::class);
    }
}
