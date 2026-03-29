<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\DetaCita;
use App\Models\Examen;
use App\Models\Paciente;
use App\Models\Orden;
use App\Models\Deta_orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::all()->pluck('nombre_completo', 'id');
        $examenes = Examen::all();
        return view('admin.citas.index', compact('pacientes', 'examenes'));
    }

    public function getEvents(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $citas = Cita::with('paciente')
            ->whereBetween('fecha', [$start, $end])
            ->get();

        $events = [];

        foreach ($citas as $cita) {
            $events[] = [
                'id' => $cita->id,
                'title' => $cita->paciente->apellido . ', ' . $cita->paciente->nombre,
                'start' => $cita->fecha . 'T' . $cita->hora,
                'color' => '#101931',
                'extendedProps' => [
                    'paciente' => $cita->paciente->apellido . ', ' . $cita->paciente->nombre,
                    'hora' => $cita->hora,
                    'fecha' => $cita->fecha,
                    'status' => $cita->status,
                    'observaciones' => $cita->observaciones,
                    'examenes' => $cita->detalles->map(function($d) {
                        return $d->examen->descripcion;
                    })
                ]
            ];
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $cita = Cita::create([
                'paciente_id' => $request->paciente_id,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'observaciones' => $request->observaciones,
                'status' => 'Programada'
            ]);

            if ($request->has('examen_id')) {
                foreach ($request->examen_id as $examen_id) {
                    DetaCita::create([
                        'cita_id' => $cita->id,
                        'examen_id' => $examen_id
                    ]);
                }
            }

            DB::commit();
            return response()->json('Cita reservada correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show(Cita $cita)
    {
        $cita->load('paciente', 'detalles.examen');
        return response()->json($cita);
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response()->json('Cita eliminada correctamente.');
    }

    public function convertToOrder(Cita $cita)
    {
        try {
            DB::beginTransaction();

            $total = 0;
            foreach ($cita->detalles as $detalle) {
                $total += $detalle->examen->precio;
            }

            $orden = new Orden();
            $orden->estado = "EN PROCESO";
            $orden->total = $total;
            $orden->paciente_id = $cita->paciente_id;
            $orden->save();

            foreach ($cita->detalles as $detalle) {
                $detaOrden = new Deta_orden();
                $detaOrden->completado = 0;
                $detaOrden->orden_id = $orden->id;
                $detaOrden->examen_id = $detalle->examen_id;
                $detaOrden->save();
            }

            // Actualizamos el estado de la cita
            $cita->update(['status' => 'Atendida']);

            DB::commit();

            return response()->json([
                'message' => 'Cita convertida en orden con éxito.',
                'redirect_url' => route('admin.ordens.index') . '/' . $orden->id . '/edit'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
