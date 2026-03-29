<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas - {{ $desde }} a {{ $hasta }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 0; padding: 0; color: #333; }
        .header { width: 100%; border-bottom: 2px solid #101931; margin-bottom: 15px; padding-bottom: 5px; }
        .header h1 { margin: 0; font-size: 20px; color: #101931; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th { background-color: #101931; color: white; padding: 8px; text-align: left; font-size: 10px; }
        .table td { padding: 8px; border-bottom: 1px solid #ddd; font-size: 10px; }
        .total-row { background-color: #eee; font-weight: bold; font-size: 13px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 8px; border-top: 1px solid #ccc; padding-top: 4px; }
    </style>
</head>
<body>

<div class="header">
    <table style="width: 100%;">
        <tr>
            <td width="30%">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" style="width: 140px;">
                @else
                    <h1 style="margin: 0;">EKLabs</h1>
                @endif
            </td>
            <td width="70%" style="text-align: right;">
                <h1 style="margin: 0;">REPORTE GENERAL DE VENTAS</h1>
                <div style="font-size: 10px;">
                    Periodo: {{ \Carbon\Carbon::parse($desde)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($hasta)->format('d/m/Y') }}
                </div>
            </td>
        </tr>
    </table>
</div>

<table class="table">
    <thead>
        <tr>
            <th width="15%" class="text-center">Factura #</th>
            <th width="15%" class="text-center">Fecha</th>
            <th width="50%">Cliente</th>
            <th width="20%" style="text-align: right;">Total</th>
        </tr>
    </thead>
    <tbody>
        @php $totalG = 0; @endphp
        @forelse($facturas as $factura)
            <tr>
                <td align="center">{{ $factura->id }}</td>
                <td align="center">{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                <td>{{ $factura->nombre_cliente }}</td>
                <td style="text-align: right;">${{ number_format($factura->total, 2) }}</td>
            </tr>
            @php $totalG += $factura->total; @endphp
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">No se registraron ventas en este periodo.</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr class="total-row">
            <td colspan="3" style="text-align: right;">TOTAL DEL PERIODO:</td>
            <td style="text-align: right;">${{ number_format($totalG, 2) }}</td>
        </tr>
    </tfoot>
</table>

<div class="footer">
    Reporte generado automáticamente por el sistema EKDiagnóstico - {{ date('d/m/Y H:i:s') }}
</div>

</body>
</html>
