<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Resultados - Orden #{{ $orden->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { width: 100%; border-bottom: 2px solid #101931; padding-bottom: 10px; margin-bottom: 20px; }
        .logo { width: 200px; }
        .info-table { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .info-table td { padding: 5px; border-bottom: 1px solid #eee; }
        .section-title { background-color: #101931; color: white; padding: 5px 10px; font-weight: bold; margin-top: 20px; }
        .result-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .result-table th, .result-table td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        .result-table th { background-color: #f2f2f2; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; border-top: 1px solid #ddd; padding-top: 5px; }
        .text-bold { font-weight: bold; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="header">
        <table style="width: 100%;">
            <tr>
                <td>
                    <img src="{{ $logoBase64 }}" class="logo">
                </td>
                <td style="text-align: right;">
                    <h2 style="margin: 0; color: #101931;">REPORTE DE RESULTADOS</h2>
                    <p style="margin: 0;">Orden #: <strong>{{ sprintf('%06d', $orden->id) }}</strong></p>
                    <p style="margin: 0;">Fecha: {{ $orden->created_at->format('d/m/Y H:i') }}</p>
                </td>
            </tr>
        </table>
    </div>

    <table class="info-table">
        <tr>
            <td class="text-bold" width="15%">PACIENTE:</td>
            <td width="50%">{{ $orden->paciente->apellido }}, {{ $orden->paciente->nombre }}</td>
            <td class="text-bold" width="15%">EDAD:</td>
            <td width="20%">{{ $orden->paciente->edad }} años</td>
        </tr>
        <tr>
            <td class="text-bold">GÉNERO:</td>
            <td>{{ $orden->paciente->genero }}</td>
            <td class="text-bold">DUI:</td>
            <td>{{ $orden->paciente->dui }}</td>
        </tr>
        <tr>
            <td class="text-bold">ESTADO:</td>
            <td colspan="3" style="color: green; font-weight: bold;">{{ $orden->estado }}</td>
        </tr>
    </table>

    @foreach($orden->deta_ordens as $deta)
        <div class="section-title">
            {{ $deta->examen->descripcion }}
        </div>

        @if($deta->resultado)
            @php $res = $deta->resultado; @endphp
            
            @if($deta->examen->plantilla == 'EGH') {{-- Heces --}}
                <table class="result-table">
                    <tr><th colspan="2">MACROSCÓPICO</th><th colspan="2">MICROSCÓPICO</th></tr>
                    <tr><td class="text-bold">Color:</td><td>{{ $res->color }}</td><td class="text-bold">Leucocitos:</td><td>{{ $res->leucocitos }}</td></tr>
                    <tr><td class="text-bold">Consistencia:</td><td>{{ $res->consistencia }}</td><td class="text-bold">Hematíes:</td><td>{{ $res->hematies }}</td></tr>
                    <tr><td class="text-bold">Mucus:</td><td>{{ $res->mucus }}</td><td class="text-bold">Levaduras:</td><td>{{ $res->levadura }}</td></tr>
                    <tr><td class="text-bold">Restos Alim. Mac.:</td><td>{{ $res->restos_alim_mac }}</td><td class="text-bold">Restos Alim. Mic.:</td><td>{{ $res->restos_alim_mic }}</td></tr>
                    <tr><td class="text-bold">Sangre:</td><td>{{ $res->sangre }}</td><td class="text-bold">Parásitos:</td><td>{{ $res->parasitos }}</td></tr>
                </table>

            @elseif($deta->examen->plantilla == 'EGO') {{-- Orina --}}
                <table class="result-table">
                    <tr><th colspan="2">FÍSICO-QUÍMICO</th><th colspan="2">SEDIMENTO (MICROSCOPIA)</th></tr>
                    <tr><td class="text-bold" width="25%">Color:</td><td width="25%">{{ $res->color }}</td><td class="text-bold" width="25%">Hematíes:</td><td width="25%">{{ $res->hematies }}</td></tr>
                    <tr><td class="text-bold">Aspecto:</td><td>{{ $res->aspecto }}</td><td class="text-bold">Leucocitos:</td><td>{{ $res->leucocitos }}</td></tr>
                    <tr><td class="text-bold">Densidad:</td><td>{{ $res->densidad }}</td><td class="text-bold">Cél. Epiteliales:</td><td>{{ $res->celulas_epiteliales }}</td></tr>
                    <tr><td class="text-bold">PH:</td><td>{{ $res->ph }}</td><td class="text-bold">Bacterias:</td><td>{{ $res->bacterias }}</td></tr>
                    <tr><td class="text-bold">Proteínas:</td><td>{{ $res->proteinas }}</td><td class="text-bold">Fil. Mucoides:</td><td>{{ $res->filamentos_mucoides }}</td></tr>
                    <tr><td class="text-bold">Glucosa:</td><td>{{ $res->glucosa }}</td><td class="text-bold">Nitritos:</td><td>{{ $res->nitritos }}</td></tr>
                    <tr><td class="text-bold">Sangre Oculta:</td><td>{{ $res->sangre_oculta }}</td><td class="text-bold">Est. Leucocitaria:</td><td>{{ $res->esterasa_leucocitaria }}</td></tr>
                    <tr><td class="text-bold">C. Cetónicos:</td><td>{{ $res->cuerpos_cetonicos }}</td><td class="text-bold">Urobilinógeno:</td><td>{{ $res->urobilinogeno }}</td></tr>
                    <tr><td class="text-bold">Bilirrubina:</td><td>{{ $res->bilirrubina }}</td><td class="text-bold">Hemoglobina:</td><td>{{ $res->hemoglobina }}</td></tr>
                </table>

            @elseif($deta->examen->plantilla == 'HMG') {{-- Hemograma --}}
                <table class="result-table">
                    <tr><th width="40%">PARÁMETRO</th><th width="30%">RESULTADO</th><th width="30%">REF.</th></tr>
                    <tr><td>Glóbulos Rojos</td><td>{{ $res->globulos_rojos }}</td><td>4.5 - 5.5 x10^6</td></tr>
                    <tr><td>Hemoglobina</td><td>{{ $res->hemoglobina }}</td><td>12.0 - 16.0 g/dL</td></tr>
                    <tr><td>Hematocrito</td><td>{{ $res->hematocrito }}</td><td>37 - 47 %</td></tr>
                    <tr><td>VCM / HCM / CHCM</td><td>{{ $res->vcm }} / {{ $res->hcm }} / {{ $res->chcm }}</td><td>-</td></tr>
                    <tr><td>Leucocitos</td><td>{{ $res->leucocitos }}</td><td>5,000 - 10,000</td></tr>
                    <tr><td>Segmentados / Banda</td><td>{{ $res->neutrofilos_segmentados }} / {{ $res->neutrofilos_en_banda }}</td><td>-</td></tr>
                    <tr><td>Linfocitos / Monocitos</td><td>{{ $res->linfocitos }} / {{ $res->monocitos }}</td><td>-</td></tr>
                    <tr><td>Eosinófilos / Basófilos</td><td>{{ $res->eosinofilos }} / {{ $res->basofilos }}</td><td>-</td></tr>
                    <tr><td>Plaquetas</td><td>{{ $res->recuento_plaquetas }}</td><td>150,000 - 450,000</td></tr>
                </table>

            @elseif($deta->examen->plantilla == 'QMV') {{-- Química --}}
                <table class="result-table">
                    <tr><th width="40%">PRUEBA</th><th width="30%">RESULTADO</th><th width="30%">VALORES DE REF.</th></tr>
                    <tr><td>{{ $res->prueba }}</td><td>{{ $res->resultado }}</td><td>{{ $deta->examen->rango_ref }} {{ $deta->examen->unidad_med }}</td></tr>
                </table>

            @elseif($deta->examen->plantilla == 'GEN') {{-- Genérica --}}
                <table class="result-table">
                    <tr><th width="40%">PARÁMETRO</th><th width="20%">RESULTADO</th><th width="20%">UNIDAD</th><th width="20%">REF.</th></tr>
                    @for($i=1; $i<=5; $i++)
                        @php $p = "param_$i"; $r = "resultado_$i"; $u = "unidad_med_$i"; $rf = "rango_ref_$i"; @endphp
                        @if($res->$p)
                            <tr><td>{{ $res->$p }}</td><td>{{ $res->$r }}</td><td>{{ $res->$u }}</td><td>{{ $res->$rf }}</td></tr>
                        @endif
                    @endfor
                </table>
            @endif

            @if($res->observaciones)
                <div style="margin-top: 5px; font-style: italic;">
                    <strong>Observaciones:</strong> {{ $res->observaciones }}
                </div>
            @endif
        @else
            <p style="color: red;">Resultado pendiente.</p>
        @endif
    @endforeach

    <div class="footer">
        EK Diagnóstico - Reporte generado automáticamente por el sistema EKLabs.
    </div>
</body>
</html>
