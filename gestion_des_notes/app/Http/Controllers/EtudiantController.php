<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Services\EtudiantService;

class EtudiantController extends Controller
{

    protected $etudiantService;

    public function __construct(EtudiantService $etudiantService)
    {
        $this->etudiantService = $etudiantService;
    }

    public function results($etudiantId)
    {
        $etudiant = Etudiant::findOrFail($etudiantId);

        // Vérifier si l'étudiant peut passer à l'année suivante
        $peutPasser = $this->etudiantService->passageAnneeSuivante($etudiant);

        return view('etudiants.results', compact('etudiant', 'peutPasser'));
    }
    /**
     * Affiche une liste des étudiants.
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return view('etudiants.index', compact('etudiants'));
    }

    /**
     * Affiche le formulaire pour créer un nouvel étudiant.
     */
    public function create()
    {
        return view('etudiants.create');
    }

    /**
     * Enregistre un nouvel étudiant dans la base de données.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero_etudiant' => 'required|string|unique:etudiants,numero_etudiant|max:20',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'niveau' => 'required|in:L1,L2,L3',
        ]);

        Etudiant::create($validatedData);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Affiche les détails d'un étudiant spécifique.
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiants.show', compact('etudiant'));
    }

    /**
     * Affiche le formulaire pour modifier un étudiant.
     */
    public function edit(Etudiant $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Met à jour les informations d'un étudiant dans la base de données.
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $validatedData = $request->validate([
            'numero_etudiant' => 'required|string|max:20|unique:etudiants,numero_etudiant,' . $etudiant->id,
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'niveau' => 'required|in:L1,L2,L3',
        ]);

        $etudiant->update($validatedData);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès.');
    }

    /**
     * Supprime un étudiant de la base de données.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }
}
