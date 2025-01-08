<?php
namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    // Afficher la liste des enseignants
    public function index()
    {
        $enseignants = Enseignant::all();
        return view('enseignants.index', compact('enseignants'));
    }

    // Afficher le formulaire pour ajouter un nouvel enseignant
    public function create()
    {
        return view('enseignants.create');
    }

    // Enregistrer un nouvel enseignant
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email',
            'telephone' => 'nullable|string|max:15',
        ]);

        Enseignant::create($validatedData);

        return redirect()->route('enseignants.index')->with('success', 'Enseignant créé avec succès.');
    }

    // Afficher le formulaire de modification d'un enseignant
    public function edit(Enseignant $enseignant)
    {
        return view('enseignants.edit', compact('enseignant'));
    }

    // Mettre à jour les informations d'un enseignant
    public function update(Request $request, Enseignant $enseignant)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:enseignants,email,' . $enseignant->id,
            'telephone' => 'nullable|string|max:15',
        ]);

        $enseignant->update($validatedData);

        return redirect()->route('enseignants.index')->with('success', 'Enseignant mis à jour avec succès.');
    }

    // Supprimer un enseignant
    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();
        return redirect()->route('enseignants.index')->with('success', 'Enseignant supprimé avec succès.');
    }
}
