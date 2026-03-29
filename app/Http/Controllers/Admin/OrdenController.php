<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Examen;
use App\Models\Orden;
use App\Models\Paciente;
use App\Models\Deta_orden;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Exm_heces_plantilla;
use App\Models\Exm_orina_plantilla;
use App\Models\Exm_hemograma_plantilla;
use App\Models\Exm_quimica_plantilla;
use App\Models\Exm_generica_plantilla;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'today');
        $today = Carbon::today();

        if ($filter == 'all') {
            $ordens = Orden::orderBy('created_at', 'desc')->get();
        } else {
            $ordens = Orden::whereDate('created_at', $today)->orderBy('created_at', 'desc')->get();
        }

        $todayStr = $today->format('d-m-Y');
        return view('admin.ordens.index', compact('ordens', 'todayStr', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all()->pluck('nombre_edad','id');
        $examenes = Examen::all();
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
     * @param  Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        $colores = array(
            "AMARILLO" => "AMARILLO",
            "CAFÉ" => "CAFÉ",
            "NEGRO" => "NEGRO",
            "VERDE" => "VERDE",
        );
        $consistencias = array(
            "PASTOSA" => "PASTOSA",
            "LIQUIDA" => "LIQUIDA",
            "DURA" => "DURA",
        );
        $aspectos = array(
            "TURBIO" => "TURBIO",
            "LIMPIO" => "LIMPIO",
            "ESPESO" => "ESPESO",
        );
        $detalleOrdens = Deta_orden::all()->where('orden_id',$orden->id);
        return view('admin.ordens.complete',compact('orden','detalleOrdens','colores','consistencias','aspectos'));
    }

    public function modificarOrden(Orden $orden)
    {
        if($orden->estado != 'EN PROCESO'){
            return redirect()->route('admin.ordens.index')->with('info', 'No es posible editar una orden que no esté EN PROCESO.');
        }

        $pacientes = Paciente::all()->pluck('nombre_edad','id');
        $examenes = Examen::all();
        $exms_seleccionados = $orden->deta_ordens->pluck('examen_id')->toArray();

        return view('admin.ordens.edit_orden', compact('orden', 'pacientes', 'examenes', 'exms_seleccionados'));
    }

    public function updateOrden(Request $request)
    {
        $orden = Orden::findOrFail($request->orden_id);
        
        if($orden->estado != 'EN PROCESO'){
            return "Error: No es posible editar una orden que no esté EN PROCESO.";
        }

        $orden->total = $request->total;
        $orden->paciente_id = $request->idPaciente;
        $orden->update();

        // Eliminar detalles anteriores que no han sido completados
        // (En este flujo, si se edita la orden, se asume un reset de los detalles no completados)
        $orden->deta_ordens()->where('completado', 0)->delete();

        $idExamens = (array) $request->idExamens;
        foreach ($idExamens as $item){
            // Solo agregar si no existe ya un detalle completado para este examen en esta orden
            $existe = Deta_orden::where('orden_id', $orden->id)->where('examen_id', $item)->where('completado', 1)->first();
            
            if(!$existe){
                $detaOrden = new Deta_orden();
                $detaOrden->completado = 0;
                $detaOrden->orden_id = $orden->id;
                $detaOrden->examen_id = $item;
                $detaOrden->save();
            }
        }

        return "La orden #" . $orden->id . " ha sido actualizada con éxito.";
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
            $detaOrden->completado = 0;
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
            $mensaje = "1|¡Error!|No es posible anular una orden COMPLETADO o ANULADA. ";
        }
        return $mensaje;
    }

    public function finalizarOrden($id){
        $orden = Orden::Find($id);
        $mensaje = "0|¡Finalizada!|Se ha finalizado correctamente la orden de examen con número: ".$id;
        $deta_ordens = $orden->deta_ordens;
        foreach ($deta_ordens as $item){
            if($item->completado == 0){
                return "1|¡Error!|No es posible finalizar una orden con examenes pendientes de completar.";
            }
        }
        $orden->estado = "COMPLETADO";
        $orden->update();
        return $mensaje;
    }

    public function imprimirHojaTrabajo($id)
    {
        ini_set('memory_limit', '256M');
        try {
            $orden = Orden::with('paciente', 'deta_ordens.examen')->findOrFail($id);
            
            $logoBase64 = null;
            $logoPath = public_path('vendor/adminlte/dist/img/eklogo_report.png');
            
            if (file_exists($logoPath)) {
                $logoData = base64_encode(file_get_contents($logoPath));
                $logoBase64 = 'data:image/png;base64,' . $logoData;
            }

            // Datos para los selects de las plantillas (si se necesitan etiquetas)
            $colores = ["AMARILLO", "CAFÉ", "NEGRO", "VERDE"];
            $consistencias = ["PASTOSA", "LIQUIDA", "DURA"];
            $aspectos = ["TURBIO", "LIMPIO", "ESPESO"];

            $pdf = Pdf::loadView('admin.ordens.reporte_hoja', compact('orden', 'colores', 'consistencias', 'aspectos', 'logoBase64'));
            return $pdf->stream('Hoja_Trabajo_Orden_'.$id.'.pdf');
            
        } catch (\Exception $e) {
            return "Error al generar Hoja de Trabajo: " . $e->getMessage();
        }
    }

    public function imprimirResultados($id)
    {
        ini_set('memory_limit', '256M');
        try {
            $orden = Orden::with(['paciente', 'deta_ordens.examen'])->findOrFail($id);
            $detaIds = $orden->deta_ordens->pluck('id')->toArray();
            
            $logoBase64 = null;
            $logoPath = public_path('vendor/adminlte/dist/img/eklogo_report.png');
            if (file_exists($logoPath)) {
                $logoData = base64_encode(file_get_contents($logoPath));
                $logoBase64 = 'data:image/png;base64,' . $logoData;
            }

            // Cargar todos los resultados de una vez por tipo de plantilla
            $resultadosHeces = Exm_heces_plantilla::whereIn('deta_orden_id', $detaIds)->get()->keyBy('deta_orden_id');
            $resultadosOrina = Exm_orina_plantilla::whereIn('deta_orden_id', $detaIds)->get()->keyBy('deta_orden_id');
            $resultadosHemograma = Exm_hemograma_plantilla::whereIn('deta_orden_id', $detaIds)->get()->keyBy('deta_orden_id');
            $resultadosQuimica = Exm_quimica_plantilla::whereIn('deta_orden_id', $detaIds)->get()->keyBy('deta_orden_id');
            $resultadosGenerica = Exm_generica_plantilla::whereIn('deta_orden_id', $detaIds)->get()->keyBy('deta_orden_id');

            // Asignar los resultados precargados
            foreach ($orden->deta_ordens as $deta) {
                switch ($deta->examen->plantilla) {
                    case 'EGH': $deta->resultado = $resultadosHeces[$deta->id] ?? null; break;
                    case 'EGO': $deta->resultado = $resultadosOrina[$deta->id] ?? null; break;
                    case 'HMG': $deta->resultado = $resultadosHemograma[$deta->id] ?? null; break;
                    case 'QMV': $deta->resultado = $resultadosQuimica[$deta->id] ?? null; break;
                    case 'GEN': $deta->resultado = $resultadosGenerica[$deta->id] ?? null; break;
                }
            }

            $pdf = Pdf::loadView('admin.ordens.reporte_resultados', compact('orden', 'logoBase64'));
            return $pdf->stream('Resultados_Orden_'.$id.'.pdf');

        } catch (\Exception $e) {
            return "Error al generar Reporte de Resultados: " . $e->getMessage();
        }
    }

    public function getTemplateData($plantilla, $deta_orden_id)
    {
        $data = null;
        switch ($plantilla) {
            case 'EGH':
                $data = Exm_heces_plantilla::where('deta_orden_id', $deta_orden_id)->first();
                break;
            case 'EGO':
                $data = Exm_orina_plantilla::where('deta_orden_id', $deta_orden_id)->first();
                break;
            case 'HMG':
                $data = Exm_hemograma_plantilla::where('deta_orden_id', $deta_orden_id)->first();
                break;
            case 'QMV':
                $data = Exm_quimica_plantilla::where('deta_orden_id', $deta_orden_id)->first();
                break;
            case 'GEN':
                $data = Exm_generica_plantilla::where('deta_orden_id', $deta_orden_id)->first();
                break;
        }
        return response()->json($data);
    }
}
