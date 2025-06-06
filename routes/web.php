<?php

use App\Http\Controllers\BandeiraController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\GrupoEconomicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;


Route::prefix('grupo-economico')->name('grupo-economico.')->controller(GrupoEconomicoController::class)->group(function () {
    Route::get('/', 'index')
        ->name('index')
    ;

    Route::get('/search', 'search')
        ->name('search')
    ;
});

Route::prefix('bandeira')->name('bandeira.')->controller(BandeiraController::class)->group(function () {
    Route::get('/', 'index')
        ->name('index')
    ;
    Route::get('/search', 'search')
        ->name('search')
    ;
});

Route::prefix('unidade')->name('unidade.')->controller(UnidadeController::class)->group(function () {
    Route::get('/', 'index')
        ->name('index')
    ;
    Route::get('/search', 'search')
        ->name('search')
    ;
});

Route::prefix('colaborador')->name('colaborador.')->controller(ColaboradorController::class)->group(function () {
    Route::get('/', 'index')
        ->name('index')
    ;
    Route::get('/search', 'search')
        ->name('search')
    ;
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
