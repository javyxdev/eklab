<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deta_orden extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relaciones Many To One

    public function examen(){
        return $this->belongsTo(Examen::class);
    }

    public function orden(){
        return $this->belongsTo(Orden::class);
    }
}
