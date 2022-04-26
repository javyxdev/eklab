<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relaciones One To Many
    public function deta_ordens(){
        return $this->hasMany(Deta_orden::class);
    }

    //Relaciones Many To One
    public function Categoria_Examen(){
        return $this->belongsTo(Categoria_Examen::class);
    }

    /** Accesor para concatenar nombre y precio al examen */
    public function getExamenPrecioAttribute(){
        return $this->descripcion . ' - $' . $this->precio;
    }


}
