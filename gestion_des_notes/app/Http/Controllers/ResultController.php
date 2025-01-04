<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Services\EtudiantService;
use App\Services\UEService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $etudiantService;
    protected $ueService;

    public function __construct(EtudiantService $etudiantService, UEService $ueService)
    {
        $this->etudiantService = $etudiantService;
        $this->ueService = $ueService; //
    }

    /**
     * Afficher les résultats de tous les étudiants
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        $resultats = [];

        // Récupérer les résultats et vérifier si chaque étudiant peut passer à l'année suivante
        foreach ($etudiants as $etudiant) {
            $totalCredits = 0;

            // Calculer les crédits pour chaque UE associée à l'étudiant
            foreach ($etudiant->ues as $ue) {
                $note = $ue->pivot->note; // Si les notes sont dans une table pivot
                $totalCredits += $this->ueService->calculerCreditsECTS($ue, $note); // Utiliser l'instance de UEService
            }

            // Vérification du passage à l'année suivante
            $peutPasser = $this->etudiantService->passageAnneeSuivante($etudiant);

            // Ajout des résultats à la liste
            $resultats[] = [
                'etudiant' => $etudiant,
                'totalCredits' => $totalCredits,
                'peutPasser' => $peutPasser
            ];
        }

        // Passer les résultats à la vue
        return view('resultats.index', compact('resultats'));
    }
}
