@extends('adminlte::page')

@section('title', 'EK Diagnóstico Lab')

@section('content_header')
    <div class="card">
        <div class="card-header bg-dark">
            <h1><strong>EK Diagnóstico</strong></h1>
        </div>
        <div class="card-body">
            <p>Bienvenido <strong>{{$loggeduser}}</strong> al sistema administrativo / operativo de laboratorio clínico. </p>
        </div>
    </div>
@stop

@section('content')
    @include('admin.infoboxes')

    <div class="row">
        <!-- 1. Tendencia de Facturación -->
        <div class="col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Facturación Mensual ({{ date('Y') }})</h3>
                </div>
                <div class="card-body">
                    <div style="height: 250px;">
                        <canvas id="facturacionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Top 10 Exámenes -->
        <div class="col-md-5">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-trophy mr-1"></i> Top 10 Exámenes más Solicitados</h3>
                </div>
                <div class="card-body">
                    <div style="height: 250px;">
                        <canvas id="topExamenesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- 3. Distribución por Edad -->
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-users mr-1"></i> Pacientes por Edad</h3>
                </div>
                <div class="card-body">
                    <div style="height: 200px;">
                        <canvas id="edadChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Efectividad de Citas -->
        <div class="col-md-4">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-calendar-check mr-1"></i> Efectividad de Citas</h3>
                </div>
                <div class="card-body">
                    <div style="height: 200px;">
                        <canvas id="citasChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5. Exámenes por Categoría -->
        <div class="col-md-4">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-vials mr-1"></i> Exámenes por Categoría</h3>
                </div>
                <div class="card-body">
                    <div style="height: 200px;">
                        <canvas id="categoriaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            @php
                $nombresMeses = ["", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
                $labelsFacturacion = $facturacionMensual->map(fn($f) => $nombresMeses[$f->mes]);
            @endphp

            // 1. Facturación Mensual
            new Chart(document.getElementById('facturacionChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($labelsFacturacion) !!},
                    datasets: [{
                        label: 'Ingresos ($)',
                        data: {!! json_encode($facturacionMensual->pluck('total')) !!},
                        borderColor: '#101931',
                        backgroundColor: 'rgba(16, 25, 49, 0.1)',
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: { maintainAspectRatio: false }
            });

            // 2. Top Exámenes
            new Chart(document.getElementById('topExamenesChart'), {
                type: 'horizontalBar',
                data: {
                    labels: {!! json_encode($topExamenes->map(fn($t) => $t->examen->descripcion ?? 'Desconocido')) !!},
                    datasets: [{
                        label: 'Solicitudes',
                        data: {!! json_encode($topExamenes->pluck('total')) !!},
                        backgroundColor: '#28a745'
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: { display: false }
                }
            });

            // 3. Pacientes por Edad
            new Chart(document.getElementById('edadChart'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($pacientesPorEdad->pluck('rango')) !!},
                    datasets: [{
                        data: {!! json_encode($pacientesPorEdad->pluck('total')) !!},
                        backgroundColor: ['#17a2b8', '#ffc107', '#28a745', '#dc3545']
                    }]
                },
                options: { maintainAspectRatio: false }
            });

            // 4. Efectividad de Citas
            new Chart(document.getElementById('citasChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($efectividadCitas->pluck('status')) !!},
                    datasets: [{
                        data: {!! json_encode($efectividadCitas->pluck('total')) !!},
                        backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8']
                    }]
                },
                options: { maintainAspectRatio: false }
            });

            // 5. Exámenes por Categoría
            new Chart(document.getElementById('categoriaChart'), {
                type: 'horizontalBar',
                data: {
                    labels: {!! json_encode($examenesPorCategoria->pluck('descripcion')) !!},
                    datasets: [{
                        label: 'Cantidad',
                        data: {!! json_encode($examenesPorCategoria->pluck('total')) !!},
                        backgroundColor: ['#dc3545', '#007bff', '#ffc107', '#28a745', '#6c757d', '#101931', '#17a2b8']
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: { display: false },
                    scales: {
                        xAxes: [{
                            ticks: { beginAtZero: true }
                        }],
                        yAxes: [{
                            ticks: {
                                fontSize: 10,
                                autoSkip: false
                            }
                        }]
                    },
                    layout: {
                        padding: { left: 10 }
                    }
                }
            });
        });
    </script>
@stop
