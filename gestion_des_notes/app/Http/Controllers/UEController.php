<?php


namespace App\Http\Controllers;

use App\Models\UE;
use Illuminate\Http\Request;

class UEController extends Controller
{
    // Afficher la liste des UEs
    public function index()
    {
        $ues = UE::all();
        return view('ues.index', compact('ues'));
    }

    // Afficher le formulaire de création d'une UE
    public function create()
    {
        return view('ues.create');
    }

    // Enregistrer une UE dans la base de données
   // App\Http\Controllers\UEController.php

public function store(Request $request)
{
    $request->validate([
        'code' => 'required|unique:ues,code',
        'nom' => 'required',
        'description' => 'nullable',
    ]);

    // Exclure le champ _token de la requête avant l'assignation massive
    $ue = UE::create($request->except('_token'));

    return redirect()->route('ues.index')->with('success', 'UE créée avec succès!');
}

public function update(Request $request, UE $ue)
{
    $request->validate([
        'code' => 'required|unique:ues,code,' . $ue->id,
        'nom' => 'required',
        'description' => 'nullable',
    ]);

    // Exclure le champ _token de la requête avant l'assignation massive
    $ue->update($request->except('_token'));

    return redirect()->route('ues.index')->with('success', 'UE mise à jour avec succès!');
}


    // Afficher le formulaire de modification d'une UE
    public function edit(UE $ue)
    {
        return view('ues.edit', compact('ue'));
    }



    // Supprimer une UE
    public function destroy(UE $ue)
    {
        $ue->delete();
        return redirect()->route('ues.index')->with('success', 'UE supprimée avec succès!');
    }
}
