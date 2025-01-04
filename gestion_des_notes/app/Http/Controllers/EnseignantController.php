<?php

namespace App\Http\Controllers;
use App\Models\Enseignant;

use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    //
    public function index()
    {
        $enseignants = Enseignant::all();
        return view('enseignants.index', compact('enseignants'));
    }

    public function create()
    {
        return view('enseignants.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
        ]);

        // Création de l'enseignant
        $enseignant = new Enseignant();
        $enseignant->nom = $request->nom;
        $enseignant->prenom = $request->prenom;
        $enseignant->telephone = $request->telephone;
        
        
        $enseignant->save();

        return redirect()->route('enseignants.index')->with('success', 'Enseignant créé avec succès!');
    }

    public function edit($id)
    {
        $enseignant = Enseignant::findOrFail($id);

        
        return view('enseignants.edit', compact('enseignant'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|numeric',
        ]);

        $enseignant = Enseignant::findOrFail($id);

       
        $enseignant->nom = $request->input('nom');
        $enseignant->prenom = $request->input('prenom');
        $enseignant->telephone = $request->input('telephone');

        
        $enseignant->save();
        return redirect()->route('enseignants.index')->with('success', 'Enseignant mis à jour avec succès!');
    }


    public function destroy($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();
        return redirect()->route('enseignants.index')->with('success', 'Enseignant supprimé avec succès!');
    }
}
