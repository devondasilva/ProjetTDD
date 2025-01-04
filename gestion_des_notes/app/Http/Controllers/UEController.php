<?php

namespace App\Http\Controllers;

use App\Models\UE;
use Illuminate\Http\Request;

class UEController extends Controller
{
    // Afficher la liste des UEs
    public function index()
    {
        $ues = UE::all();  // Récupère toutes les UEs
        return view('ues.index', compact('ues'));
    }

    // Afficher le formulaire pour créer une nouvelle UE
    public function create()
    {
        return view('ues.create');
    }

    // Enregistrer une nouvelle UE dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'regex:/^UE[0-9]{2}$/', 'unique:ues,code'],
            'nom' => 'required',
            'credits' => 'required|integer',
            'semestre' => 'required|integer|min:1|max:6',
        ]);

        UE::create($request->all());

        return redirect()->route('ues.index')->with('success', 'UE créée avec succès!');
    }

    // Afficher le formulaire pour modifier une UE existante
    public function edit(UE $ue)
    {
        return view('ues.edit', compact('ue'));
    }

    // Mettre à jour une UE existante
    public function update(Request $request, UE $ue)
    {
        $request->validate([
            'code' => ['required', 'regex:/^UE[0-9]{2}$/', 'unique:ues,code,' . $ue->id],
            'nom' => 'required',
            'credits' => 'required|integer',
            'semestre' => 'required|integer|min:1|max:6',
        ]);

        $ue->update($request->all());

        return redirect()->route('ues.index')->with('success', 'UE mise à jour avec succès!');
    }

    // Supprimer une UE
    public function destroy(UE $ue)
    {
        $ue->delete();
        return redirect()->route('ues.index')->with('success', 'UE supprimée avec succès!');
    }
}