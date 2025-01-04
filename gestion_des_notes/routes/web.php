<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEController;
use App\Http\Controllers\ECController;
use App\Http\Controllers\NoteController;

// Routes pour la gestion des ECs
Route::prefix('ecs')->group(function () {
    Route::get('/', [ECController::class, 'index'])->name('ecs.index'); // Liste des ECs
    Route::get('/create', [ECController::class, 'create'])->name('ecs.create'); // Formulaire de création
    Route::post('/', [ECController::class, 'store'])->name('ecs.store'); // Enregistrer un nouvel EC
    Route::get('/{ec}/edit', [ECController::class, 'edit'])->name('ecs.edit'); // Formulaire de modification
    Route::put('/{ec}', [ECController::class, 'update'])->name('ecs.update'); // Mettre à jour un EC
    Route::delete('/{ec}', [ECController::class, 'destroy'])->name('ecs.destroy'); // Supprimer un EC
});



Route::prefix('ues')->group(function () {
    Route::get('/', [UEController::class, 'index'])->name('ues.index'); // Liste des UEs
    Route::get('/create', [UEController::class, 'create'])->name('ues.create'); // Formulaire de création
    Route::post('/', [UEController::class, 'store'])->name('ues.store'); // Enregistrer une nouvelle UE
    Route::get('/{ue}/edit', [UEController::class, 'edit'])->name('ues.edit'); // Formulaire de modification
    Route::put('/{ue}', [UEController::class, 'update'])->name('ues.update'); // Mettre à jour une UE
    Route::delete('/{ue}', [UEController::class, 'destroy'])->name('ues.destroy'); // Supprimer une UE
});





Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('ues', UEController::class);
Route::resource('ecs', ECController::class);
Route::resource('notes', NoteController::class);


require __DIR__.'/auth.php';
