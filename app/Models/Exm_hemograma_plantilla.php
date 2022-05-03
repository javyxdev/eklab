<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exm_hemograma_plantilla extends Model
{
    use HasFactory;

    //Relaciones Many To One
    public function Examen(){
        return $this->belongsTo(Examen::class);
    }
}
