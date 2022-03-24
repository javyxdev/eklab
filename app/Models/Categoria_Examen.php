<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_Examen extends Model
{
    use HasFactory;

    public $table = "categoria_examens";

    protected $guarded = [];

    //Relaciones One to Many

    public function examens(){
        return $this->hasMany(Examen::class);
    }
}
