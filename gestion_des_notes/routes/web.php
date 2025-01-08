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
    Route::get('/', [ECController::class, 'index'])->name('ecs.index');
    Route::get('/create', [ECController::class, 'create'])->name('ecs.create');
    Route::post('/', [ECController::class, 'store'])->name('ecs.store');
    Route::get('/{ec}/edit', [ECController::class, 'edit'])->name('ecs.edit');
    Route::put('/{ec}', [ECController::class, 'update'])->name('ecs.update');
    Route::delete('/{ec}', [ECController::class, 'destroy'])->name('ecs.destroy');
    Route::get('/{ec}/etudiants', [ECController::class, 'etudiants'])->name('ecs.etudiants');
});

// Routes pour les UEs
Route::prefix('ues')->group(function () {
    Route::get('/', [UEController::class, 'index'])->name('ues.index');
    Route::get('/create', [UEController::class, 'create'])->name('ues.create');
    Route::post('/', [UEController::class, 'store'])->name('ues.store');
    Route::get('/{ue}/edit', [UEController::class, 'edit'])->name('ues.edit');
    Route::put('/{ue}', [UEController::class, 'update'])->name('ues.update');
    Route::delete('/{ue}', [UEController::class, 'destroy'])->name('ues.destroy');
    Route::get('/{ue}/enseignants', [UEController::class, 'enseignants'])->name('ues.enseignants');
});

// Routes pour les étudiants
Route::prefix('etudiants')->group(function () {
    Route::get('/', [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/create', [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::post('/', [EtudiantController::class, 'store'])->name('etudiants.store');
    Route::get('/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
    Route::get('/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
    Route::get('/{etudiant}/resultats', [EtudiantController::class, 'resultats'])->name('etudiants.resultats');
});

// Routes pour les notes
// Routes pour les notes
Route::prefix('notes')->name('notes.')->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('index');
    Route::get('/create', [NoteController::class, 'create'])->name('create');
    Route::post('/', [NoteController::class, 'store'])->name('store');
    Route::get('/{note}/edit', [NoteController::class, 'edit'])->name('edit');
    Route::put('/{note}', [NoteController::class, 'update'])->name('update');
    Route::delete('/{note}', [NoteController::class, 'destroy'])->name('destroy');
    Route::post('/calculer-moyenne', [NoteController::class, 'calculerMoyenne'])->name('calculer-moyenne');
    Route::get('/resultats', [NoteController::class, 'resultats'])->name('resultats');
});


// Routes pour les enseignants
Route::prefix('enseignants')->group(function () {
    Route::get('/', [EnseignantController::class, 'index'])->name('enseignants.index');
    Route::get('/create', [EnseignantController::class, 'create'])->name('enseignants.create');
    Route::post('/', [EnseignantController::class, 'store'])->name('enseignants.store');
    Route::get('/{enseignant}/edit', [EnseignantController::class, 'edit'])->name('enseignants.edit');
    Route::put('/{enseignant}', [EnseignantController::class, 'update'])->name('enseignants.update');
    Route::delete('/{enseignant}', [EnseignantController::class, 'destroy'])->name('enseignants.destroy');
    Route::get('/{enseignant}/resultats', [EnseignantController::class, 'resultats'])->name('enseignants.resultats');
});

// Routes pour les résultats
Route::prefix('resultats')->group(function () {
    Route::get('/', [ResultController::class, 'index'])->name('resultats.index');
});

// Routes pour le profil de l'utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route pour la page d'accueil
Route::get('/', function () {
    return view('home');
})->name('home');

// Routes d'authentification
require __DIR__.'/auth.php';
