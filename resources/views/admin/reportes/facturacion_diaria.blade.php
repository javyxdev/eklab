@extends('adminlte::page')

@section('title', 'Reporte de Ventas - EK Diagnóstico')

@section('css')
    <style>
        /* Reducción del font general de la tabla en un 20% */
        .table {
            font-size: 0.8rem !important;
        }
        .table td, .table th {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }
    </style>
@stop

@section('content_header')
    <h1><i class="fas fa-chart-line"></i> Reporte General de Ventas</h1>
    <p>Generador de reportes de venta por rangos de fechas.</p>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form id="formReporte" action="{{ route('admin.reportes.facturacion.diario') }}" method="GET" class="form-inline">
                <div class="form-group mr-2">
                    <label for="fecha_desde" class="mr-2">Desde:</label>
                    <input type="date" name="fecha_desde" id="fecha_desde" class="form-control form-control-sm" value="{{ $desde }}">
                </div>
                <div class="form-group mr-3">
                    <label for="fecha_hasta" class="mr-2">Hasta:</label>
                    <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control form-control-sm" value="{{ $hasta }}">
                </div>
                
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> CONSULTAR
                    </button>
                    <button type="button" id="btnHoy" class="btn btn-info btn-sm">
                        <i class="fas fa-calendar-day"></i> VENTAS DE HOY
                    </button>
                    <a href="{{ route('admin.reportes.facturacion.imprimir', ['fecha_desde' => $desde, 'fecha_hasta' => $hasta]) }}" target="_blank" class="btn btn-dark btn-sm">
                        <i class="fas fa-print"></i> IMPRIMIR PDF
                    </a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-institutional text-white">
                        <tr>
                            <th class="text-center">Factura #</th>
                            <th>Cliente</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($facturas as $factura)
                            <tr>
                                <td class="text-center">{{ $factura->id }}</td>
                                <td>{{ $factura->nombre_cliente }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                                <td class="text-right">${{ number_format($factura->total, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay ventas registradas en el rango seleccionado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold">
                            <td colspan="3" class="text-right">GRAN TOTAL DEL PERIODO:</td>
                            <td class="text-right text-primary" style="font-size: 1.1rem;">${{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#btnHoy').click(function() {
                const hoy = new Date().toISOString().split('T')[0];
                $('#fecha_desde').val(hoy);
                $('#fecha_hasta').val(hoy);
                $('#formReporte').submit();
            });
        });
    </script>
@stop
