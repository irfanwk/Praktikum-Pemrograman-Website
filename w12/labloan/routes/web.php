<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/items', [LoanController::class, 'index'])->name('items.index');
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
