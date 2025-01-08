<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée.
     *
     * @var string
     */
    protected $table = 'etudiants';

    /**
     * Les attributs pouvant être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'numero_etudiant',
        'nom',
        'prenom',
        'niveau',
    ];

    /**
     * Relation : Un étudiant peut être inscrit à plusieurs UEs.
     */
    public function ues()
    {
        return $this->belongsToMany(UE::class, 'inscriptions', 'etudiant_id', 'ue_id')
                    ->withPivot('semestre', 'validated')
                    ->withTimestamps();
    }
    
    /**
     * Relation : Un étudiant a plusieurs notes (par EC).
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
