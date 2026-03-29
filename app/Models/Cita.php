<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relación con el Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    // Relación con los detalles de la cita (exámenes)
    public function detalles()
    {
        return $this->hasMany(DetaCita::class);
    }
}
