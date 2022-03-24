<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relaciones One to Many

    public function pacientes(){
        return $this->hasMany(Paciente::class);
    }

    //Relaciones Many To One
    public function Municipio(){
        return $this->belongsTo(Municipio::class);
    }
}
