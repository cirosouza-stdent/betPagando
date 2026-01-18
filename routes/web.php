<?php

use App\Http\Controllers\BetHouseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlotCatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SlotCatalogController::class, 'index'])->name('catalog');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/minha-bet', [BetHouseController::class, 'index'])->name('minha-bet.index');
    Route::post('/minha-bet', [BetHouseController::class, 'store'])->name('minha-bet.store');
    Route::get('/minha-bet/search', [BetHouseController::class, 'search'])->name('minha-bet.search');
    Route::put('/minha-bet/{betHouse}', [BetHouseController::class, 'update'])->name('minha-bet.update');
    Route::delete('/minha-bet/{betHouse}', [BetHouseController::class, 'destroy'])->name('minha-bet.destroy');
});

require __DIR__.'/auth.php';
