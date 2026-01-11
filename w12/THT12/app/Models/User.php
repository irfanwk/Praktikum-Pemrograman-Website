<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Tambahkan relasi ke Ticket dan Comment
use Illuminate\Database\Eloquent\Relations\HasMany; 

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Bagian 1: Tambahkan 'is_admin' agar bisa diisi secara mass-assignment
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // <--- Tambahkan ini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Bagian 2: Tambahkan casting untuk 'is_admin' agar otomatis menjadi boolean (true/false)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean', // <--- Tambahkan ini
        ];
    }

    /**
     * Bagian 3: Tambahkan Relasi (Letakkan di bagian bawah sebelum kurung kurawal tutup)
     */

    // Relasi: User memiliki banyak Tiket (Laporan)
    public function tickets()
    {
        // Penjelasan: Satu User bisa membuat banyak Ticket
        return $this->hasMany(Ticket::class);
    }

    public function comments()
    {
        // Penjelasan: Satu User bisa menulis banyak Comment
        return $this->hasMany(Comment::class);
    }
}