<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $factura->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 0; padding: 0; color: #333; }
        .header { width: 100%; border-bottom: 2px solid #101931; margin-bottom: 15px; padding-bottom: 5px; }
        .header h1 { margin: 0; font-size: 18px; color: #101931; }
        .info-table { width: 100%; margin-bottom: 15px; }
        .info-table td { padding: 3px; border-bottom: 1px solid #eee; }
        .items-table { width: 100%; border-collapse: collapse; margin-top: 5px; }
        .items-table th { background-color: #101931; color: white; padding: 6px; text-align: left; font-size: 10px; }
        .items-table td { padding: 6px; border-bottom: 1px solid #ddd; font-size: 10px; }
        .orden-header { background-color: #f1f1f1; font-weight: bold; padding: 4px; border-left: 4px solid #101931; margin-top: 10px; font-size: 10px; }
        .total-section { margin-top: 20px; text-align: right; }
        .total-box { display: inline-block; padding: 8px 15px; background-color: #101931; color: white; font-size: 14px; border-radius: 4px; }
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
                <h1 style="margin: 0;">COMPROBANTE DE PAGO</h1>
                <div style="font-size: 10px;">Factura #: 00{{ $factura->id }} | Fecha: {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</div>
            </td>
        </tr>
    </table>
</div>

<table class="info-table">
    <tr>
        <td width="20%"><strong>CLIENTE:</strong></td>
        <td width="80%" style="border-bottom: 1px solid #000;">{{ strtoupper($factura->nombre_cliente) }}</td>
    </tr>
    <tr>
        <td><strong>TELÉFONO:</strong></td>
        <td style="border-bottom: 1px solid #000;">{{ $factura->telefono ?? 'N/A' }}</td>
    </tr>
    <tr>
        <td><strong>ESTADO:</strong></td>
        <td style="border-bottom: 1px solid #000;">{{ $factura->estado }}</td>
    </tr>
</table>

<h4 style="margin-bottom: 5px; color: #101931;">DETALLE DE SERVICIOS</h4>

@foreach($factura->ordens as $orden)
    <div class="orden-header">
        ORDEN #000{{ $orden->id }} - PACIENTE: {{ $orden->paciente->apellido }}, {{ $orden->paciente->nombre }}
    </div>
    <table class="items-table">
        <thead>
            <tr>
                <th width="75%">Examen / Servicio</th>
                <th width="25%" style="text-align: right;">Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orden->deta_ordens as $deta)
                <tr>
                    <td>{{ $deta->examen->descripcion }}</td>
                    <td style="text-align: right;">${{ number_format($deta->examen->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td style="text-align: right; font-weight: bold; font-size: 9px;">SUBTOTAL ORDEN:</td>
                <td style="text-align: right; font-weight: bold; font-size: 9px;">${{ number_format($orden->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>
@endforeach

<div class="total-section">
    <div class="total-box">
        TOTAL A PAGAR: ${{ number_format($factura->total, 2) }}
    </div>
</div>

<div class="footer">
    Este documento es un comprobante interno de servicios de EKLabs. <br>
    Impreso el {{ date('d/m/Y H:i:s') }}
</div>

</body>
</html>
