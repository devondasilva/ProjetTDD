<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\UE;
use App\Models\Note;

class ResultController extends Controller
{
    /**
     * Affiche les résultats des étudiants.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer tous les étudiants
        $etudiants = Etudiant::all();

        // Préparer les résultats
        $results = [];
        foreach ($etudiants as $etudiant) {
            $ues = UE::with('ecs')->get();
            foreach ($ues as $ue) {
                $notes = Note::whereIn('ec_id', $ue->ecs->pluck('id'))
                             ->where('etudiant_id', $etudiant->id)
                             ->get();

                // Calculer la moyenne par UE
                $totalNotes = 0;
                $totalCoeff = 0;
                foreach ($notes as $note) {
                    $totalNotes += $note->note * $note->ec->coefficient;
                    $totalCoeff += $note->ec->coefficient;
                }
                $moyenne = $totalCoeff > 0 ? $totalNotes / $totalCoeff : 0;

                // Vérifier la validation de l'UE
                $ueValidee = $moyenne >= 10;

                // Calcul des crédits acquis
                $credits = $ueValidee ? $ue->credits_ects : 0;

                // Ajouter les résultats
                $results[] = [
                    'etudiant' => $etudiant->nom,
                    'ue'       => $ue->nom,
                    'moyenne'  => number_format($moyenne, 2),
                    'credits'  => $credits,
                    'valide'   => $ueValidee,
                ];
            }
        }

        // Retourner la vue avec les résultats
        return view('results.index', compact('results'));
    }
}
