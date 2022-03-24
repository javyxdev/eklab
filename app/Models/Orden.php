<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relaciones One to Many

    public function deta_ordens(){
        return $this->hasMany(Deta_orden::class);
    }

    //Relaciones Many To One
    public function Paciente(){
        return $this->belongsTo(Paciente::class);
    }
}
