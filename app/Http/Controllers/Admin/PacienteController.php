<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barrio;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all()->sortByDesc('created_at');

        return view('admin.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departamento::all()->pluck('descripcion','id');
        $municipios = array();
        $barrios = array();
        $genero = array(
            "M" => "MASCULINO",
            "F" => "FEMENINO"
        );

        return view('admin.pacientes.create', compact('departamentos','municipios','barrios','genero'));
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
            'nombre' => 'required',
            'apellido' => 'required',
            'genero' => 'required',
            'fecha_nacimiento' => 'required',
            'dui' => 'max:9',
            'telefono' => 'numeric|min:8',
            'departamento_id' => 'required',
        ]);
        $mensaje = 'El registro se guardó con éxito.';
        $paciente = Paciente::create($request->all());
        return redirect()->route('admin.pacientes.edit',compact('paciente'))->with('info',$mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return view('admin.pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        $departamentos = Departamento::all()->pluck('descripcion','id');
        $municipios = Municipio::all()->pluck('descripcion','id');
        $barrios = Barrio::all()->pluck('descripcion','id');
        $genero = array(
            "M" => "MASCULINO",
            "F" => "FEMENINO"
        );
        return view('admin.pacientes.edit', compact('paciente','departamentos','municipios','barrios','genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'dui' => 'max:9',
            'telefono' => 'numeric|min:8',
            'departamento_id' => 'required',

        ]);
        $mensaje = 'El registro se actualizó con éxito.';
        $paciente->update($request->all());
        return redirect()->route('admin.pacientes.edit',$paciente)->with('info',$mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('admin.pacientes.index')->with('info','El paciente se eliminó con éxito.');
    }

    public function ajaxDelete($id){
        $paciente = Paciente::Find($id);
        $paciente->delete();
        return  "Se ha eliminado correctamente el registro número: ".$id;
    }

    public function getMunicipiosByDepartamento($id){
        $departamento = Departamento::Find($id);
        $municipios = $departamento->municipios()->get();
        return compact('municipios');
    }

    public function getBarriosByMunicipio($id){
        $municipio = Municipio::Find($id);
        $barrios = $municipio->barrios()->get();
        return compact('barrios');
    }
}
