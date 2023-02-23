<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exm_generica_plantilla extends Model
{
    use HasFactory;

    public $table = "exm_generica_plantilla";

    protected $guarded = [];

    //Relaciones Many To One
    public function Examen(){
        return $this->belongsTo(Examen::class);
    }
}
