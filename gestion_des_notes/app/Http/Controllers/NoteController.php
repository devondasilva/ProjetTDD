<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EC;

class NoteController extends Controller
{
    // Afficher la liste des notes
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }


    // Dans NoteController.php ou un contrôleur similaire

// Dans NoteController.php ou un contrôleur similaire

public function create($ecs_id)
{
    // Récupérer les étudiants associés à l'EC (ou toute autre logique pour déterminer les étudiants)
    $etudiants = Etudiant::all(); // Récupère tous les étudiants, vous pouvez ajuster cette logique

    // Récupérer l'EC correspondant
    $ecs = EC::findOrFail($ecs_id);

    // Passer les données à la vue
    return view('notes.create', compact('etudiants', 'ecs'));
}


    // Afficher le formulaire pour saisir une note
    public function createWithEC(EC $ecs)
    {
        $etudiants = Etudiant::all(); // Récupère tous les étudiants
        return view('notes.create', compact('ecs', 'etudiants'));
    }

    public function store(Request $request, $ecs_id)
    {
        // Validation des notes
        $validated = $request->validate([
            'notes.*' => 'required|numeric|min:0|max:20', // Validation pour chaque note
        ]);

        // Sauvegarder les notes pour chaque étudiant
        foreach ($request->notes as $etudiant_id => $note) {
            // Sauvegardez la note dans la base de données
            Note::create([
                'etudiant_id' => $etudiant_id,
                'ecs_id' => $ecs_id,
                'note' => $note,
            ]);
        }

        return redirect()->route('notes.index')->with('success', 'Notes enregistrées avec succès');
    }

    public function calculerMoyenne(Request $request)
    {
        // Logique pour calculer la moyenne des notes des étudiants
        $notes = Note::where('ecs_id', $request->ecs_id)->get();
        $totalNotes = $notes->sum('note');
        $nombreEtudiants = $notes->count();

        if ($nombreEtudiants > 0) {
            $moyenne = $totalNotes / $nombreEtudiants;
            return response()->json(['moyenne' => $moyenne]);
        }

        return response()->json(['message' => 'Aucune note disponible'], 400);
    }



    // Afficher un formulaire pour modifier une note
    public function edit($id)
{
    // Récupérer la note à modifier
    $note = Note::findOrFail($id);

    // Récupérer tous les étudiants et tous les EC
    $etudiants = Etudiant::all();
    $ecs = Ec::all();

    // Passer les données à la vue
    return view('notes.edit', compact('note', 'etudiants', 'ecs'));
}


    // Mettre à jour une note
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'session' => 'required|in:normale,rattrapage',
            'date_evaluation' => 'required|date',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index');
    }

    // Supprimer une note
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index');
    }

    // Calculer la moyenne pour un étudiant et un EC donné


    // Calculer les résultats des étudiants
    public function resultats()
    {
        $resultats = Etudiant::with('notes')->get()->map(function($etudiant) {
            $totalCredits = 0;
            $peutPasser = true;

            foreach ($etudiant->notes as $note) {
                $totalCredits += $note->ec->credit_ects;
                if ($note->note < 10) {
                    $peutPasser = false;
                }
            }

            return [
                'etudiant' => $etudiant,
                'totalCredits' => $totalCredits,
                'peutPasser' => $peutPasser
            ];
        });

        return view('resultats.index', compact('resultats'));
    }
}
