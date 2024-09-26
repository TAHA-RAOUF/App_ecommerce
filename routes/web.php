<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commande;
use App\Models\commane;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [commande::class, 'showWelcome'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/user/{id}/commands', [commande::class, 'showUserCommands'])->name('user.commands');
Route::post('/commands/add', [commande::class, 'store'])->name('commands.store');
Route::delete('/commands/{id}', [commande::class, 'destroy'])->name('commands.destroy');
Route::get('/user/{userId}/commands', [commande::class, 'showCommands'])->name('commands.index');
Route::get('/commands', action: [commande::class, 'index'])->name('commands.index');


Route::resource('commands', commande::class);


require __DIR__.'/auth.php';
