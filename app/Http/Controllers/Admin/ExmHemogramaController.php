<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deta_orden;
use App\Models\Exm_hemograma_plantilla;
use Illuminate\Http\Request;

class ExmHemogramaController extends Controller
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
            'globulos_rojos' => 'required|string|max:25',
            'hemoglobina' => 'required|string|max:25',
            'hematocrito' => 'required|string|max:25',
            'vcm' => 'required|string|max:25',
            'hcm' => 'required|string|max:25',
            'chcm' => 'required|string|max:25',
            'leucocitos' => 'required|string|max:25',
            'neutrofilos_segmentados' => 'required|string|max:25',
            'neutrofilos_en_banda' => 'required|string|max:25',
            'linfocitos' => 'required|string|max:25',
            'monocitos' => 'required|string|max:25',
            'eosinofilos' => 'required|string|max:25',
            'basofilos' => 'required|string|max:25',
            'recuento_plaquetas' => 'required|string|max:25',
            'observaciones' => 'nullable|string|max:300',
        ]);

        $resultado = Exm_hemograma_plantilla::updateOrCreate(
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
