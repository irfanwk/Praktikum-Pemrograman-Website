<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    // Halaman daftar tiket
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    
    // Halaman form tambah tiket
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    
    // Proses simpan tiket ke database
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    
    // Detail tiket (untuk diskusi)
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    // Route untuk simpan komentar
    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Route khusus Admin untuk update status tiket
    Route::patch('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
});

require __DIR__.'/auth.php';