<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exm_generica_plantilla extends Model
{
    use HasFactory;

    protected $table = "exm_generica_plantillas";

    protected $guarded = [];

    // Relaciones Many To One
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }

    public function deta_orden()
    {
        return $this->belongsTo(Deta_orden::class);
    }
}
