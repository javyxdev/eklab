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

    public function exm_heces_plantillas(){
        return $this->hasMany(Exm_heces_plantilla::class);
    }

    public function exm_hemograma_plantillas(){
        return $this->hasMany(Exm_hemograma_plantilla::class);
    }

    public function exm_orina_plantillas(){
        return $this->hasMany(Exm_orina_plantilla::class);
    }

    public function exm_quimica_plantillas(){
        return $this->hasMany(Exm_quimica_plantilla::class);
    }

    //Relaciones Many To One
    public function Categoria_examen(){
        return $this->belongsTo(Categoria_examen::class);
    }

    /** Accesor para concatenar nombre y precio al examen */
    public function getExamenPrecioAttribute(){
        return $this->descripcion . ' - $' . $this->precio;
    }


}
