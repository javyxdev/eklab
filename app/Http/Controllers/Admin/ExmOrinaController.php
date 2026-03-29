<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deta_orden;
use App\Models\Exm_orina_plantilla;
use Illuminate\Http\Request;

class ExmOrinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'examen_id' => 'required',
            'deta_orden_id' => 'required',
            'color' => 'required|string|max:25',
            'aspecto' => 'required|string|max:25',
            'densidad' => 'required|string|max:25',
            'ph' => 'required|string|max:25',
            'proteinas' => 'required|string|max:25',
            'glucosa' => 'required|string|max:25',
            'sangre_oculta' => 'required|string|max:25',
            'cuerpos_cetonicos' => 'required|string|max:25',
            'urobilinogeno' => 'required|string|max:25',
            'bilirrubina' => 'required|string|max:25',
            'nitritos' => 'required|string|max:25',
            'hemoglobina' => 'required|string|max:25',
            'esterasa_leucocitaria' => 'required|string|max:25',
            'hematies' => 'required|string|max:25',
            'leucocitos' => 'required|string|max:25',
            'celulas_epiteliales' => 'required|string|max:25',
            'filamentos_mucoides' => 'required|string|max:25',
            'bacterias' => 'required|string|max:25',
            'cil_granulosos' => 'required|string|max:25',
            'cil_leucocitario' => 'required|string|max:25',
            'cil_hematicos' => 'required|string|max:25',
            'cil_hialianos' => 'required|string|max:25',
            'cil_cereos' => 'required|string|max:25',
            'observaciones' => 'nullable|string|max:300',
        ]);

        $resultado = Exm_orina_plantilla::updateOrCreate(
            ['deta_orden_id' => $request->deta_orden_id],
            $request->all()
        );
        $deta_orden = Deta_orden::Find($resultado->deta_orden_id);
        $deta_orden->completado = 1;
        $deta_orden->update();

        $mensaje = 'El examen '.$deta_orden->examen->descripcion.' se guardó con éxito.';

        return redirect()->back()->with('info',$mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
