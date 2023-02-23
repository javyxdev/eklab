<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examen;
use App\Models\Categoria_examen;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examenes = Examen::all();
        return view('admin.examens.index',compact('examenes'));
        //return $examenes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat_examens = Categoria_examen::all()->pluck("descripcion","id");
        $plantillas = array(
            "EGH" => "EXAMEN GENERAL HECES",
            "EGO" => "EXAMEN GENERAL ORINA",
            "HMG" => "HEMOGRAMA",
            "QMV" => "QUIMICA / VARIOS",
            "GEN" => "PLANTILLA GENERICA"
        );

        return view('admin.examens.create',compact('cat_examens','plantillas'));
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
            'categoria_examen_id' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'plantilla' => 'required'
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $examen = Examen::create($request->all());
        return redirect()->route('admin.examens.edit',compact('examen'))->with('info',$mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Examen $examen)
    {
        return view('admin.examens.show',compact('examen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Examen $examen)
    {
        $cat_examens = Categoria_examen::all()->pluck("descripcion","id");
        $plantillas = array(
            "EGH" => "EXAMEN GENERAL HECES",
            "EGO" => "EXAMEN GENERAL ORINA",
            "HMG" => "HEMOGRAMA",
            "QMV" => "QUIMICA / VARIOS",
            "GEN" => "PLANTILLA GENERICA"
        );

        return view('admin.examens.edit',compact('cat_examens','plantillas','examen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examen $examen)
    {
        $request->validate([
            'categoria_examen_id' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'plantilla' => 'required',
        ]);
        $mensaje = 'El registro se actualizó con éxito.';
        $examen->update($request->all());
        return redirect()->route('admin.examens.edit',$examen)->with('info',$mensaje);
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

    public function ajaxDelete($id){
        $examen = Examen::Find($id);
        $examen->delete();
        return  "Se ha eliminado correctamente el registro número: ".$id;
    }
}
