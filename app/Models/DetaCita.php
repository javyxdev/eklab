<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetaCita extends Model
{
    use HasFactory;

    protected $table = 'deta_citas';
    protected $guarded = [];

    // Relación con la Cita
    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    // Relación con el Examen
    public function examen()
    {
        return $this->belongsTo(Examen::class);
    }
}
