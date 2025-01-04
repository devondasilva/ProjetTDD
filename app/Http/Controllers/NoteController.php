<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\EC;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create()
{
    $etudiants = Etudiant::all();
    $ecs = EC::all();
    $ecs = EC::with('unites_enseignement')->get();
    return view('notes.create', compact('etudiants', 'ecs'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'ec_id' => 'required|exists:elements_constitutifs,id',
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|in:normale,rattrapage',
            
        ]);

        Note::create($validated);
        return redirect()->route('notes.create')->with('success', 'Note ajoutée avec succès');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $ecs = EC::all();
        return view('notes.edit', compact('note', 'ecs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'ec_id' => 'required|exists:elements_constitutifs,id',
            'session' => 'required|in:normale,rattrapage',
        ]);

        $note = Note::findOrFail($id);
        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès.');
    }

    public function calculerMoyenneUE($etudiantId, $ueId)
    {
        $notes = Note::whereHas('ec', function ($query) use ($ueId) {
            $query->where('ue_id', $ueId);
        })->where('etudiant_id', $etudiantId)->get();

        $sommeNotes = 0;
        $totalCoefficient = 0;

        foreach ($notes as $note) {
            $ec = $note->ec;
            $sommeNotes += $note->note * $ec->coefficient;
            $totalCoefficient += $ec->coefficient;
            
        }

        return $totalCoefficient > 0 ? $sommeNotes / $totalCoefficient : 0;
    }
}
