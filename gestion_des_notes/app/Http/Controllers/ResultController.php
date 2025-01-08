<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    public function index()
    {

            $resultats = Result::all();  // Obtenez les résultats des étudiants depuis la base de données

            return view('resultats.index', compact('resultats'));  // Passez les résultats à la vue

    }

    public function show($etudiantId)
    {
        // Afficher les résultats d'un étudiant spécifique
        $result = Result::where('etudiant_id', $etudiantId)->first();
        return view('resultats.show', compact('result'));
    }

    public function export($etudiantId)
    {
        // Exporter les résultats de l'étudiant
        // Votre logique d'export ici
    }
}
