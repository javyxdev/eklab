<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetaFactura extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function orden()
    {
        return $this->belongsTo(Orden::class);
    }
}
