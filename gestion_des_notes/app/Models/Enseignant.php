<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enseignant extends Model
{
    //
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'telephone'];

    public function ecs()
    {
        return $this->hasMany(EC::class, 'responsable_id');
    }
}
