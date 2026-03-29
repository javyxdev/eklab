<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\DetaFactura;
use App\Models\Orden;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::with('ordens')->orderBy('id', 'desc')->get();
        return view('admin.facturas.index', compact('facturas'));
    }

    public function getOrdensAjax(Request $request)
    {
        $term = $request->get('q');
        
        $cleanId = preg_replace('/[^0-9]/', '', $term);
        $cleanId = ltrim($cleanId, '0');

        $ordens = Orden::with('paciente')
            ->where('facturado', 'NO') 
            ->where('estado', '!=', 'ANULADO') 
            ->where(function($query) use ($term, $cleanId) {
                if (!empty($cleanId)) {
                    $query->where('id', $cleanId);
                }
                $query->orWhere(DB::raw('CAST(id AS CHAR)'), 'LIKE', "%$term%")
                      ->orWhereHas('paciente', function($q) use ($term) {
                          $q->where('nombre', 'LIKE', "%$term%")
                            ->orWhere('apellido', 'LIKE', "%$term%");
                      });
            })
            ->limit(10)
            ->get();

        $results = [];
        foreach ($ordens as $orden) {
            $results[] = [
                'id' => $orden->id,
                'text' => "Orden #000{$orden->id} [{$orden->estado}] - {$orden->paciente->apellido}, {$orden->paciente->nombre} ($" . number_format($orden->total, 2) . ")",
                'total' => $orden->total
            ];
        }

        return response()->json($results);
    }

    public function show($id)
    {
        $factura = Factura::with('ordens.paciente')->findOrFail($id);
        
        $formattedOrdens = $factura->ordens->map(function($o) {
            return [
                'id' => $o->id,
                'text' => "Orden #000{$o->id} [{$o->estado}] - {$o->paciente->apellido}, {$o->paciente->nombre} ($" . number_format($o->total, 2) . ")",
                'total' => $o->total
            ];
        });

        return response()->json([
            'factura' => $factura,
            'formattedOrdens' => $formattedOrdens
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'orden_ids' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $total = Orden::whereIn('id', $request->orden_ids)->sum('total');

            $factura = Factura::create([
                'nombre_cliente' => $request->nombre_cliente,
                'telefono' => $request->telefono,
                'fecha' => $request->fecha,
                'total' => $total,
                'estado' => 'EMITIDA'
            ]);

            foreach ($request->orden_ids as $orden_id) {
                DetaFactura::create([
                    'factura_id' => $factura->id,
                    'orden_id' => $orden_id
                ]);

                $orden = Orden::find($orden_id);
                $orden->facturado = 'SI';
                $orden->save();
            }

            DB::commit();
            return redirect()->route('admin.facturas.index')->with('info', 'Factura creada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear la factura: ' . $e->getMessage()])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'orden_ids' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $factura = Factura::findOrFail($id);
            $currentOrdenIds = $factura->ordens->pluck('id')->toArray();
            $newOrdenIds = $request->orden_ids;

            $toRemove = array_diff($currentOrdenIds, $newOrdenIds);
            foreach ($toRemove as $oid) {
                $orden = Orden::find($oid);
                if($orden) {
                    $orden->facturado = 'NO'; 
                    $orden->save();
                }
            }

            $toAdd = array_diff($newOrdenIds, $currentOrdenIds);
            foreach ($toAdd as $oid) {
                $orden = Orden::find($oid);
                if($orden) {
                    $orden->facturado = 'SI';
                    $orden->save();
                }
            }

            $factura->ordens()->sync($newOrdenIds);
            $newTotal = Orden::whereIn('id', $newOrdenIds)->sum('total');
            
            $factura->update([
                'nombre_cliente' => $request->nombre_cliente,
                'telefono' => $request->telefono,
                'fecha' => $request->fecha,
                'total' => $newTotal
            ]);

            DB::commit();
            return redirect()->route('admin.facturas.index')->with('info', 'Factura actualizada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar la factura: ' . $e->getMessage()]);
        }
    }

    public function anular($id)
    {
        try {
            DB::beginTransaction();

            $factura = Factura::findOrFail($id);
            $factura->estado = 'ANULADO';
            $factura->save();

            foreach ($factura->ordens as $orden) {
                $orden->facturado = 'NO'; 
                $orden->save();
            }

            DB::commit();
            return response()->json('Factura anulada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('Error al anular la factura: ' . $e->getMessage(), 500);
        }
    }

    public function ajaxDelete($id)
    {
        return $this->anular($id);
    }

    public function imprimir($id)
    {
        $factura = Factura::with(['ordens.paciente', 'ordens.deta_ordens.examen'])->findOrFail($id);
        
        $logoBase64 = null;
        $logoPath = public_path('vendor/adminlte/dist/img/eklogo_report.png');
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoBase64 = 'data:image/png;base64,' . $logoData;
        }

        $pdf = Pdf::loadView('admin.facturas.reporte_factura', compact('factura', 'logoBase64'));
        return $pdf->stream('factura_'.$factura->id.'.pdf');
    }
}
