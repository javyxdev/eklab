<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deta_orden;
use App\Models\Exm_generica_plantilla;
use Illuminate\Http\Request;

class ExmGenericaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'examen_id' => 'required',
            'deta_orden_id' => 'required',
            'prueba' => 'required|string|max:150',
            'observaciones' => 'nullable|string',
            // El primer parámetro es siempre obligatorio
            'param_1' => 'required|string|max:100',
            'resultado_1' => 'required|string|max:100',
            'unidad_med_1' => 'required|string|max:50',
            'rango_ref_1' => 'required|string|max:100',
        ];

        for ($i = 2; $i <= 5; $i++) {
            $rules["param_$i"] = 'nullable|string|max:100';
            $rules["resultado_$i"] = 'nullable|string|max:100';
            $rules["unidad_med_$i"] = 'nullable|string|max:50';
            $rules["rango_ref_$i"] = 'nullable|string|max:100';
        }

        $request->validate($rules);

        $resultado = Exm_generica_plantilla::updateOrCreate(
            ['deta_orden_id' => $request->deta_orden_id],
            $request->all()
        );

        $deta_orden = Deta_orden::Find($resultado->deta_orden_id);
        $deta_orden->completado = 1;
        $deta_orden->update();

        $mensaje = 'El examen '.$deta_orden->examen->descripcion.' se guardó con éxito.';

        return redirect()->back()->with('info', $mensaje);
    }
}
