<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
