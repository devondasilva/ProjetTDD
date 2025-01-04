<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UE extends Model
{
    use HasFactory;

    protected $table = 'ues';
    // Définir les champs qui peuvent être remplis (mass assignment)
    protected $fillable = ['code', 'nom', 'credits', 'semestre'];

    // Relation avec les ECs
    public function ecs()
    {
        return $this->hasMany(EC::class);
    }
}
