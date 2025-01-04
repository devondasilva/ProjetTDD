<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UEController;
use App\Http\Controllers\ECController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\ResultController;


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


Route::prefix('etudiants')->group(function () {
    Route::get('/', [EtudiantController::class, 'index'])->name('etudiants.index');

    Route::get('/create', [EtudiantController::class, 'create'])->name('etudiants.create');

    
    Route::post('/', [EtudiantController::class, 'store'])->name('etudiants.store');

    Route::get('/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');

    Route::get('/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');

    Route::put('/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');

    Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
});

Route::prefix('notes')->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('notes.index');

    Route::get('/create', [NoteController::class, 'create'])->name('notes.create');

    Route::post('/', [NoteController::class, 'store'])->name('notes.store');

    Route::get('/{note}', [NoteController::class, 'show'])->name('notes.show');

    Route::get('/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit');

    Route::put('/{note}', [NoteController::class, 'update'])->name('notes.update');

    Route::delete('/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
});

Route::prefix('enseignants')->group(function () {
    Route::get('/', [EnseignantController::class, 'index'])->name('enseignants.index'); // Liste des enseignants
    Route::get('/create', [EnseignantController::class, 'create'])->name('enseignants.create'); // Formulaire de création
    Route::post('/', [EnseignantController::class, 'store'])->name('enseignants.store'); // Enregistrer un nouvel enseignant
    Route::get('/{enseignant}/edit', [EnseignantController::class, 'edit'])->name('enseignants.edit'); // Formulaire de modification
    Route::put('/{enseignant}', [EnseignantController::class, 'update'])->name('enseignants.update'); // Mettre à jour un enseignant
    Route::delete('/{enseignant}', [EnseignantController::class, 'destroy'])->name('enseignants.destroy'); // Supprimer un enseignant
});


Route::prefix('resultats')->group(function () {
    Route::get('/', [ResultController::class, 'index'])->name('resultats.index'); // Liste des résultats des étudiants
});







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('ues', UEController::class);
Route::get('/results', [ResultController::class, 'index'])->name('results.index');


Route::get('/', function () {
    return view('home');
})->name('home');



require __DIR__.'/auth.php';
