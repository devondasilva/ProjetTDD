<?php
namespace App\Http\Controllers;

use App\Models\EC;
use App\Models\UE;
use Illuminate\Http\Request;

class ECController extends Controller
{
    public function index()
    {
        $ecs = EC::with('ue')->get(); // Récupère tous les ECs avec leurs UE associées
        return view('ecs.index', compact('ecs'));
    }

    public function create()
    {
        $ues = UE::all(); // Récupère toutes les UEs pour le formulaire
        return view('ecs.create', compact('ues'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:ecs,code',
            'nom' => 'required',
            'coefficient' => 'required|integer',
            'ue_id' => 'required|exists:ues,id',
        ]);

        EC::create($request->all());
        return redirect()->route('ecs.index')->with('success', 'EC créé avec succès.');
    }

    public function edit(EC $ec)
    {
        $ues = UE::all();
        return view('ecs.edit', compact('ec', 'ues'));
    }

    public function update(Request $request, EC $ec)
    {
        $request->validate([
            'code' => 'required|unique:ecs,code,' . $ec->id,
            'nom' => 'required',
            'coefficient' => 'required|integer',
            'ue_id' => 'required|exists:ues,id',
        ]);

        $ec->update($request->all());
        return redirect()->route('ecs.index')->with('success', 'EC mis à jour avec succès.');
    }

    public function destroy(EC $ec)
    {
        $ec->delete();
        return redirect()->route('ecs.index')->with('success', 'EC supprimé avec succès.');
    }
}
