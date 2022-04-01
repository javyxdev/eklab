<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\Municipio;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $municipios = Municipio::all();
       return view('admin.municipios.index',compact('municipios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all()->pluck('descripcion','id');
        return view('admin.municipios.create',compact('departamentos'));
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
            'descripcion' => 'required',
            'departamento_id' => 'required',
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $municipio = Municipio::create($request->all());
        return redirect()->route('admin.municipios.edit',compact('municipio'))->with('info',$mensaje);
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
    public function edit(Municipio $municipio)
    {
        $departamentos = Departamento::all()->pluck('descripcion','id');
        return view('admin.municipios.edit',compact('departamentos','municipio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipio $municipio)
    {
        $request->validate([
            'descripcion' => 'required',
            'departamento_id' => 'required',
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $municipio->update($request->all());
        return redirect()->route('admin.municipios.edit',compact('municipio'))->with('info',$mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Municipio $municipio)
    {
        $municipio->delete();
    }

    public function ajaxDelete($id){
        $municipio = Municipio::Find($id);
        $municipio->delete();
        return  "Se ha eliminado correctamente el registro número: ".$id;
    }
}
