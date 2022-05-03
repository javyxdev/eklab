<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use App\Models\Orden;
use App\Models\Paciente;
use App\Models\Deta_orden;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();
        $ordens = Orden::whereDate('created_at',$today)->get();
        $today = $today->format('d-m-Y');
        return view('admin.ordens.index',compact('ordens','today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all()->pluck('nombre_completo','id');
        $examenes = Examen::all()->pluck('examen_precio','id');
        return view('admin.ordens.create',compact('pacientes','examenes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Orden $orden)
    {
        $detalleOrdens = Deta_orden::all()->where('orden_id',$orden->id);
        return view('admin.ordens.complete',compact('orden','detalleOrdens'));
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

    public function getPacienteById($id){
        $paciente = Paciente::Find($id);
        return compact('paciente');
    }

    public function getExamenById($id){
        $examen = Examen::Find($id);
        return compact('examen');
    }

    public function totalizarOrden(Request $request){
        $total = 0;
        $idExamens = (array) $request->idExamens;
        foreach ($idExamens as $item){
           $examen = Examen::Find($item);
           $total += $examen->precio;
        }
        return compact('total');
    }

    public function procesarOrden(Request $request){
        $orden = new Orden();
        $orden->estado = "EN PROCESO";
        $orden->total = $request->total;
        $orden->paciente_id = $request->idPaciente;

        $orden->save();

        $idExamens = (array) $request->idExamens;
        foreach ($idExamens as $item){
            $detaOrden = new Deta_orden();
            $detaOrden->orden_id = $orden->id;
            $detaOrden->examen_id = $item;

            $detaOrden->save();
        }

        return "Su orden ha sido guardada con éxito, el numero de orden es: ".$orden->id;
    }

    public function anularOrden($id){
        $orden = Orden::Find($id);
        $mensaje = "0|¡Anulado!|Se ha anulado correctamente la orden de examen con número: ".$id;
        if($orden->estado === 'EN PROCESO'){
            $orden->estado = "ANULADO";
            $orden->update();
        }else{
            $mensaje = "1|¡Error!|No es posible anular una orden COMPLETADA o ANULADA. ";
        }
        return $mensaje;
    }
}
