<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

/**
 * ============================================================================
 * PETUNJUK PENGERJAAN ROUTING API
 * ============================================================================
 * 
 * TODO: Daftarkan semua route untuk endpoint API Menu
 * 
 * Route yang harus dibuat:
 * 
 * 1. GET    /api/menus          -> MenuController@index    (Menampilkan semua menu)
 * 2. GET    /api/menus/{id}     -> MenuController@show     (Menampilkan 1 menu)
 * 3. POST   /api/menus          -> MenuController@store    (Menambah menu baru)
 * 4. PUT    /api/menus/{id}     -> MenuController@update   (Update menu)
 * 5. DELETE /api/menus/{id}     -> MenuController@destroy  (Hapus menu)
 * 
 * ============================================================================
 * CARA MEMBUAT ROUTE:
 * ============================================================================
 * 
 * Cara 1 (Manual - Satu per satu):
 * Route::get('/menus', [MenuController::class, 'index']);
 * Route::post('/menus', [MenuController::class, 'store']);
 * Route::get('/menus/{id}', [MenuController::class, 'show']);
 * Route::put('/menus/{id}', [MenuController::class, 'update']);
 * Route::delete('/menus/{id}', [MenuController::class, 'destroy']);
 * 
 * Cara 2 (Otomatis - Resource Route):
 * Route::apiResource('menus', MenuController::class);
 * 
 * Keduanya menghasilkan hasil yang sama!
 * ============================================================================
 */

// TODO: Tulis kode route di bawah ini
// Pilih salah satu cara (Manual atau Resource)

// Cara 1: Manual
Route::get('/menus', [MenuController::class, 'index']);
Route::post('/menus', [MenuController::class, 'store']);
Route::get('/menus/{id}', [MenuController::class, 'show']);
Route::put('/menus/{id}', [MenuController::class, 'update']);
Route::delete('/menus/{id}', [MenuController::class, 'destroy']);

// ATAU

// Cara 2: Resource Route (Uncomment baris di bawah dan comment baris di atas)
// Route::apiResource('menus', MenuController::class);
