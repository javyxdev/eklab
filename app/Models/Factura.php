<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function detalles()
    {
        return $this->hasMany(DetaFactura::class);
    }

    public function ordens()
    {
        return $this->belongsToMany(Orden::class, 'deta_facturas', 'factura_id', 'orden_id');
    }
}
