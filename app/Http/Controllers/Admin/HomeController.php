<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria_examen;
use App\Models\Cita;
use App\Models\Deta_orden;
use App\Models\Examen;
use App\Models\Factura;
use App\Models\Orden;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $loggeduser = Auth::user()->name;
        $pacientesCount = Paciente::count();
        $ordensCount = Orden::count();
        $detaOrdenCount = Deta_orden::count();
        $citasPendientesCount = Cita::where('status', 'Programada')->count();

        // 1. Tendencia de Facturación Mensual (Año actual)
        $facturacionMensual = Factura::selectRaw('MONTH(created_at) as mes, SUM(total) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // 2. Top 10 Exámenes más Solicitados
        $topExamenes = Deta_orden::select('examen_id', DB::raw('count(*) as total'))
            ->with('examen:id,descripcion')
            ->groupBy('examen_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // 3. Distribución de Pacientes por Rango de Edad
        $pacientesPorEdad = Paciente::selectRaw('
                CASE 
                    WHEN edad < 12 THEN "Niños"
                    WHEN edad < 18 THEN "Jóvenes"
                    WHEN edad < 60 THEN "Adultos"
                    ELSE "Adultos Mayores"
                END as rango, 
                count(*) as total
            ')
            ->groupBy('rango')
            ->get();

        // 4. Efectividad de Citas (Citas totales vs Atendidas)
        $efectividadCitas = Cita::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();

        // 5. Volumen de Exámenes por Categoría
        $examenesPorCategoria = Deta_orden::join('examens', 'deta_ordens.examen_id', '=', 'examens.id')
            ->join('categoria_examens', 'examens.categoria_examen_id', '=', 'categoria_examens.id')
            ->select('categoria_examens.descripcion', DB::raw('count(*) as total'))
            ->groupBy('categoria_examens.descripcion')
            ->get();

        return view('admin.index', compact(
            'loggeduser', 
            'pacientesCount', 
            'ordensCount', 
            'detaOrdenCount', 
            'citasPendientesCount',
            'facturacionMensual',
            'topExamenes',
            'pacientesPorEdad',
            'efectividadCitas',
            'examenesPorCategoria'
        ));
    }
}
