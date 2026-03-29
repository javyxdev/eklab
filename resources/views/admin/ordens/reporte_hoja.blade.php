<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hoja de Trabajo - Orden #{{ $orden->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .header {
            width: 100%;
            border-bottom: 2px solid #101931;
            margin-bottom: 12px;
            padding-bottom: 5px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #101931;
        }
        .patient-info {
            width: 100%;
            margin-bottom: 12px;
        }
        .patient-info td {
            padding: 2px;
        }
        .exam-section {
            margin-bottom: 12px;
            border: 1px solid #ccc;
            padding: 6px;
        }
        .exam-title {
            font-weight: bold;
            font-size: 11px;
            background-color: #101931;
            color: white;
            padding: 3px 10px;
            margin-bottom: 6px;
        }
        .qmv-section {
            margin-top: 8px;
            border: 1px solid #101931;
        }
        .qmv-title {
            background-color: #101931;
            color: white;
            padding: 4px;
            font-weight: bold;
            text-align: center;
            font-size: 11px;
        }
        .qmv-table {
            width: 100%;
            border-collapse: collapse;
        }
        .qmv-table td {
            border: 1px solid #ddd;
            padding: 6px 4px;
            width: 33.33%;
            vertical-align: top;
        }
        .qmv-box {
            display: inline-block;
            width: 50px;
            height: 14px;
            border: 1px solid #000;
            vertical-align: middle;
            margin-left: 3px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            border-top: 1px solid #ccc;
            padding-top: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<div class="header">
    <table style="width: 100%;">
        <tr>
            <td width="30%">
                <img src="{{ $logoBase64 }}" style="width: 150px;">
            </td>
            <td width="70%" style="text-align: right;">
                <h1 style="margin: 0; font-size: 18px;">HOJA DE TRABAJO</h1>
                <div style="font-size: 10px;">Orden #: 000{{ $orden->id }} | Fecha: {{ $orden->created_at->format('d/m/Y H:i') }}</div>
            </td>
        </tr>
    </table>
</div>

<div class="patient-info">
    <table>
        <tr>
            <td width="15%"><strong>PACIENTE:</strong></td>
            <td width="50%" style="border-bottom: 1px solid #000;">{{ $orden->paciente->apellido }}, {{ $orden->paciente->nombre }}</td>
            <td width="10%"><strong>EDAD:</strong></td>
            <td width="25%" style="border-bottom: 1px solid #000;">{{ $orden->paciente->edad ?? 'N/A' }} Años</td>
        </tr>
        <tr>
            <td><strong>GÉNERO:</strong></td>
            <td style="border-bottom: 1px solid #000;">{{ $orden->paciente->genero == 'M' ? 'MASCULINO' : 'FEMENINO' }}</td>
            <td><strong>DUI:</strong></td>
            <td style="border-bottom: 1px solid #000;">{{ $orden->paciente->dui ?? 'N/A' }}</td>
        </tr>
    </table>
</div>

<div class="content">
    @php
        $complexExams = $orden->deta_ordens->filter(fn($d) => $d->examen->plantilla != 'QMV');
        $qmvExams = $orden->deta_ordens->filter(fn($d) => $d->examen->plantilla == 'QMV');
    @endphp

    @foreach($complexExams as $deta)
        <div class="exam-section">
            <div class="exam-title">
                {{ $deta->examen->descripcion }} ({{ $deta->examen->plantilla }})
            </div>

            @if($deta->examen->plantilla == 'HMG')
                <table>
                    <tr>
                        <td>GLOBU. ROJOS: __________</td>
                        <td>HEMOGLOBINA: __________</td>
                        <td>HEMATOCRITO: __________</td>
                    </tr>
                    <tr>
                        <td>VCM: __________</td>
                        <td>HCM: __________</td>
                        <td>CHCM: __________</td>
                    </tr>
                    <tr>
                        <td>LEUCOCITOS: __________</td>
                        <td>HEMATIES: __________</td>
                        <td>NEUTRO. BANDA: __________</td>
                    </tr>
                    <tr>
                        <td>LINFOCITOS: __________</td>
                        <td>MONOCITOS: __________</td>
                        <td>EOSINOFILOS: __________</td>
                    </tr>
                    <tr>
                        <td>BASOFILOS: __________</td>
                        <td>PLAQUETAS: __________</td>
                        <td></td>
                    </tr>
                </table>
                <div style="margin-top: 4px;">OBS: __________________________________________________________________________</div>
            @elseif($deta->examen->plantilla == 'EGH')
                <table>
                    <tr>
                        <td>COLOR: __________</td>
                        <td>CONSISTENCIA: __________</td>
                        <td>MUCUS: __________</td>
                    </tr>
                    <tr>
                        <td>REST. ALIM. MAC: __________</td>
                        <td>SANGRE: __________</td>
                        <td>LEUCOCITOS: __________</td>
                    </tr>
                    <tr>
                        <td>HEMATIES: __________</td>
                        <td>LEVADURA: __________</td>
                        <td>REST. ALIM. MIC: __________</td>
                    </tr>
                </table>
                <div style="margin-top: 4px;">PARÁSITOS: ____________________________________________________________________</div>
                <div style="margin-top: 4px;">OBS: __________________________________________________________________________</div>
            @elseif($deta->examen->plantilla == 'EGO')
                <table style="font-size: 9px;">
                    <tr>
                        <td>COLOR: __________</td>
                        <td>ASPECTO: __________</td>
                        <td>DENSIDAD: __________</td>
                        <td>PH: __________</td>
                    </tr>
                    <tr>
                        <td>PROTEINAS: __________</td>
                        <td>GLUCOSA: __________</td>
                        <td>S. OCULTA: __________</td>
                        <td>C. CETON: __________</td>
                    </tr>
                    <tr>
                        <td>UROBILIN: __________</td>
                        <td>BILIRRU: __________</td>
                        <td>NITRITOS: __________</td>
                        <td>HEMOGLO: __________</td>
                    </tr>
                    <tr>
                        <td>EST. LEU: __________</td>
                        <td>HEMATIES: __________</td>
                        <td>LEUCOCI: __________</td>
                        <td>CEL. EPIT: __________</td>
                    </tr>
                    <tr>
                        <td>F. MUCOI: __________</td>
                        <td>BACTERI: __________</td>
                        <td>C. GRANU: __________</td>
                        <td>C. LEUCO: __________</td>
                    </tr>
                </table>
                <div style="margin-top: 4px;">OBS: __________________________________________________________________________</div>
            @else
                <div style="margin-top: 4px;">Resultado: __________________________________________________________________________</div>
                <div style="margin-top: 4px;">Obs: ________________________________________________________________________________</div>
            @endif
        </div>
    @endforeach

    @if($qmvExams->count() > 0)
        <div class="qmv-section">
            <div class="qmv-title">PRUEBAS QUÍMICAS / VARIAS (QMV)</div>
            <table class="qmv-table">
                @foreach($qmvExams->chunk(3) as $chunk)
                    <tr>
                        @foreach($chunk as $deta)
                            <td>
                                <div style="font-weight: bold; margin-bottom: 6px; border-bottom: 1px solid #eee;">{{ $deta->examen->descripcion }}</div>
                                <div>Res: <div class="qmv-box"></div></div>
                                <div style="font-size: 8px; color: #666; margin-top: 3px;">{{ $deta->examen->unidad_med }} ({{ $deta->examen->rango_ref }})</div>
                            </td>
                        @endforeach
                        @for($i = $chunk->count(); $i < 3; $i++)
                            <td></td>
                        @endfor
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
</div>

<div class="footer">
    Impreso por sistema EKLAB - {{ date('d/m/Y H:i') }}
</div>

</body>
</html>
