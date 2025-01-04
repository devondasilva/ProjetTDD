<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use App\Models\EC;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index()
    {
        $notes = Note::with(['etudiant', 'ec'])->get();
        return view('notes.index', compact('notes'));
    }
    public function create()
    {
        $etudiants = Etudiant::all();
        $ecs = EC::all();
        return view('notes.create', compact('etudiants', 'ecs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'ec_id' => 'required|exists:ecs,id',
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|in:normale,rattrapage',
            'date_evaluation' => 'required|date',
        ]);

       // Passer uniquement les données validées, excluant le token CSRF
        Note::create($request->except('_token'));

        return redirect()->route('notes.index')->with('success', 'Note créée avec succès.');
    }

    public function edit($id)
{
    // Récupérer la note à modifier
    $note = Note::findOrFail($id);

    // Récupérer tous les étudiants et les ECs
    $etudiants = Etudiant::all();
    $ecs = Ec::all();

    // Retourner la vue d'édition avec les données nécessaires
    return view('notes.edit', compact('note', 'etudiants', 'ecs'));
}

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'ec_id' => 'required|exists:ecs,id',
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|in:normale,rattrapage',
            'date_evaluation' => 'required|date',
        ]);

        $note->update($request->all());

        return redirect()->route('notes.index')->with('success', 'Note mise à jour avec succès.');
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