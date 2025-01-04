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


    // Enregistrer une UE dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:ues,code',
            'nom' => 'required',
            'description' => 'nullable',
        ]);

        // Créer une nouvelle UE et l'enregistrer dans la base de données
        $ue = new UE($request->except('_token'));
        $ue->save();

        return redirect()->route('ues.index')->with('success', 'UE mise à jour avec succès!');
    }

    // Afficher le formulaire de modification d'une UE
    public function edit(UE $ue)
    {
        return view('ues.edit', compact('ue'));
    }
}

