<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

    
    public function ec()
    {
        return $this->belongsTo(EC::class);
    }
}
