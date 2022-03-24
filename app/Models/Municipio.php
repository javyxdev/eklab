<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relaciones One to Many

    public function barrios(){
        return $this->hasMany(Barrio::class);
    }

    //Relaciones Many To One
    public function Departamento(){
        return $this->belongsTo(Departamento::class);
    }
}
