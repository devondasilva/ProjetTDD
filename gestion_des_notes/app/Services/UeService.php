<?php

namespace App\Services;
use App\Models\UE;

class UEService
{
    /**
     * Calculer la moyenne d'un semestre
     *
     * @param array $ue_notes
     * @return float
     *  @param Ue $ue
     * @param float $note
     * @return int
     */
    public function calculerMoyenneSemestre(array $ue_notes)
    {
        $totalNotes = 0;
        $nombreUEs = count($ue_notes);

        foreach ($ue_notes as $note) {
            $totalNotes += $note;
        }

        return $totalNotes / $nombreUEs;
    }

    /**
     * Vérifier si la moyenne d'un semestre est compensée (>= 10)
     *
     * @param float $moyenne
     * @return bool
     */
    public function estCompensee(float $moyenne)
    {
        return $moyenne >= 10;
    }

    public function calculerCreditsECTS(Ue $ue, float $note)
    {
        // Si l'UE est validée, retourner les crédits
        if ($ue->estValidee($note)) {
            return $ue->credits; // On suppose que l'UE a une colonne 'credits'
        }
        return 0;  // Aucun crédit acquis si l'UE n'est pas validée
    }

    
}