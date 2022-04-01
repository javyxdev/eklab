<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Departamento;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barrios = Barrio::all();
        return view('admin.barrios.index',compact('barrios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all();
        return view('admin.barrios.create',compact('departamentos'));
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
            'municipio_id' => 'required',
            'descripcion' => 'required',
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $barrio = Barrio::create($request->all());
        return redirect()->route('admin.barrios.edit',compact('barrio'))->with('info',$mensaje);

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
    public function edit(Barrio $barrio)
    {
        $municipios = Municipio::all()->pluck('descripcion','id');
        return view('admin.barrios.edit',compact('barrio','municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barrio $barrio)
    {
        $request->validate([
            'municipio_id' => 'required',
            'descripcion' => 'required',
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $barrio->update($request->all());
        return redirect()->route('admin.barrios.edit',compact('barrio'))->with('info',$mensaje);
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
        $barrio = Barrio::Find($id);
        $barrio->delete();
        return  "Se ha eliminado correctamente el registro número: ".$id;
    }

    public function getMunicipiosByDepartamento($id){
        $departamento = Departamento::Find($id);
        $municipios = $departamento->municipios()->get();
        return compact('municipios');
    }
}
