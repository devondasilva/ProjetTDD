<?php
namespace App\Services;
use App\Models\Etudiant;
use App\Models\UE;


class EtudiantService
{
    /**
     * Déterminer si un étudiant peut passer à l'année suivante
     *
     * @param Etudiant $etudiant
     * @return bool
     */
    public function passageAnneeSuivante(Etudiant $etudiant)
    {
        $totalCredits = 0;

        // Récupérer toutes les UEs de l'étudiant et calculer les crédits ECTS
        foreach ($etudiant->ues as $ue) {
            $note = $ue->pivot->note; // Si les notes sont dans une table pivot
            $totalCredits += app(UEService::class)->calculerCreditsECTS($ue, $note);
        }

        // Vérifier si l'étudiant a 60 crédits ECTS ou plus
        if ($totalCredits >= 60) {
            return true;  // L'étudiant peut passer à l'année suivante
        }

        return false;  // L'étudiant ne peut pas passer
    }
}