<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    protected $table = 'ecs';
    protected $fillable = ['code', 'nom', 'coefficient', 'ue_id','responsable_id'];
    public function ue()
    {
        return $this->belongsTo(UE::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function responsable()
    {
        return $this->belongsTo(Enseignant::class, 'responsable_id');
    }
    
}
