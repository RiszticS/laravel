<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\PlaceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/characters/create', [CharacterController::class, 'create'])->name('characters.create');
    Route::post('/characters', [CharacterController::class, 'store'])->name('characters.store');
    Route::get('/characters', [CharacterController::class, 'index'])->name('characters.index');
    Route::get('/characters/{id}', [CharacterController::class, 'show'])->name('characters.show');
    Route::get('/characters/{id}/edit', [CharacterController::class, 'edit'])->name('characters.edit');
    Route::put('/characters/{id}', [CharacterController::class, 'update'])->name('characters.update');
    Route::delete('/characters/{id}', [CharacterController::class, 'destroy'])->name('characters.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/places', [PlaceController::class, 'index'])->name('places.index');
    Route::get('/places/{id}/edit', [PlaceController::class, 'edit'])->name('places.edit');
    Route::put('/places/{id}', [PlaceController::class, 'update'])->name('places.update');
    Route::delete('/places/{id}', [PlaceController::class, 'destroy'])->name('places.destroy');
    Route::get('/places/create', [PlaceController::class, 'create'])->name('places.create');
    Route::post('/places', [PlaceController::class, 'store'])->name('places.store');
});

require __DIR__ . '/auth.php';
