<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Paciente extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relaciones One to Many

    public function ordens(){
        return $this->hasMany(Orden::class);
    }

    //Relaciones Many To One
    public function Departamento(){
        return $this->belongsTo(Departamento::class);
    }

    public function Municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function Barrio(){
        return $this->belongsTo(Barrio::class);
    }

    /** Accesor para obtener el nombre completo en un solo atributo */
    public function getNombreCompletoAttribute(){
        return $this->nombre . ' ' . $this->apellido;
    }
}
