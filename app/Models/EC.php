<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    use HasFactory;

    // Définir explicitement le nom de la table si nécessaire
    protected $table = 'elements_constitutifs'; // Assurez-vous que le nom de la table est correct

    // Vous pouvez également définir les colonnes qui sont autorisées pour l'insertion
    protected $fillable = ['code', 'nom', 'coefficient', 'ue_id'];
}
