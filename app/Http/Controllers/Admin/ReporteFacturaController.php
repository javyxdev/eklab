<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReporteFacturaController extends Controller
{
    public function diario(Request $request)
    {
        // Si no vienen fechas, usar el mes actual por defecto
        $desde = $request->get('fecha_desde', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $hasta = $request->get('fecha_hasta', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $facturas = Factura::whereBetween('fecha', [$desde, $hasta])
            ->where('estado', '!=', 'ANULADO')
            ->orderBy('fecha', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        $total = $facturas->sum('total');

        return view('admin.reportes.facturacion_diaria', compact('facturas', 'desde', 'hasta', 'total'));
    }

    public function imprimirDiario(Request $request)
    {
        $desde = $request->get('fecha_desde', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $hasta = $request->get('fecha_hasta', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $facturas = Factura::whereBetween('fecha', [$desde, $hasta])
            ->where('estado', '!=', 'ANULADO')
            ->orderBy('fecha', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        
        $total = $facturas->sum('total');

        $logoBase64 = null;
        $logoPath = public_path('vendor/adminlte/dist/img/eklogo_report.png');
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/png;base64,' . $logoData;
        }

        $pdf = Pdf::loadView('admin.reportes.imprimir_facturacion_diaria', compact('facturas', 'desde', 'hasta', 'total', 'logoBase64'));
        return $pdf->stream('reporte_ventas_'.$desde.'_al_'.$hasta.'.pdf');
    }
}
