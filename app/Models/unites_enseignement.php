<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unites_enseignement extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'nom', 'credits_ects', 'semestre'];

    // Relation avec les éléments constitutifs (EC)
    public function ecs()
    {
        return $this->hasMany(EC::class, 'ue_id');
    }
}
