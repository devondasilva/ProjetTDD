<?php

namespace App\Http\Controllers;

use App\Models\Ec;
use App\Models\Ue;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class ECController extends Controller
{
    // Afficher la liste des ECs
    public function index()
    {
        $ecs = Ec::with('ue')->get();  // Récupérer tous les ECs avec leur UE associée
        return view('ecs.index', compact('ecs'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $ues = Ue::all();  // Récupérer toutes les UEs pour les afficher dans le formulaire
        $enseignants = Enseignant::all();  // Récupérer tous les enseignants
        return view('ecs.create', compact('ues', 'enseignants'));
    }

    // Enregistrer un nouvel EC
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'code' => 'required|unique:ecs|string|max:255',
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|integer|min:1',
            'ue_id' => 'required|exists:ues,id',
            'responsable_id' => 'nullable|exists:enseignants,id',
        ]);

        Ec::create($request->all());

        return redirect()->route('ecs.index')->with('success', 'EC créé avec succès');
    }

    // Afficher le formulaire d'édition
    public function edit(Ec $ec)
    {
        $ues = Ue::all();
        $enseignants = Enseignant::all();
        return view('ecs.edit', compact('ec', 'ues', 'enseignants'));
    }

    // Mettre à jour un EC existant
    public function update(Request $request, Ec $ec)
    {
        // Validation des données du formulaire
        $request->validate([
            'code' => 'required|string|max:255|unique:ecs,code,' . $ec->id,
            'nom' => 'required|string|max:255',
            'coefficient' => 'required|integer|min:1',
            'ue_id' => 'required|exists:ues,id',
            'responsable_id' => 'nullable|exists:enseignants,id',
        ]);

        $ec->update($request->all());

        return redirect()->route('ecs.index')->with('success', 'EC mis à jour avec succès');
    }

    // Supprimer un EC
    public function destroy(Ec $ec)
    {
        $ec->delete();
        return redirect()->route('ecs.index')->with('success', 'EC supprimé avec succès');
    }
}
