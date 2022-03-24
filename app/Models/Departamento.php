<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relaciones One to Many

    public function municipios(){
        return $this->hasMany(Municipio::class);
    }
}
