@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('css')
    <style>
        /* Reducción del font general de la tabla en un 20% */
        #ordensTable {
            font-size: 0.8rem !important;
        }
        #ordensTable td, #ordensTable th {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }
        /* Ajuste de badges */
        .badge {
            font-size: 0.75rem !important;
            display: inline-block;
            min-width: 85px; /* Para que todos tengan un ancho similar y se vean alineados */
        }
        .text-center-badges {
            text-align: center !important;
        }
    </style>
@stop

@section('content_header')
    <h1><i class="fa fa-clipboard-list"></i> Gesti&oacute;n de Ordenes de Examenes</h1>
    <p>Listado diario de ordenes de examenes.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{session('info')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <a class="btn btn-primary" href="{{route('admin.ordens.create')}}"><i class="fa fa-plus-circle fa-fw"></i> GENERAR NUEVA ORDEN</a>
                
                <div class="btn-group">
                    <a href="{{ route('admin.ordens.index', ['filter' => 'today']) }}" 
                       class="btn {{ $filter != 'all' ? 'btn-info' : 'btn-outline-info' }}">
                        <i class="fa fa-calendar-day"></i> Órdenes de Hoy
                    </a>
                    <a href="{{ route('admin.ordens.index', ['filter' => 'all']) }}" 
                       class="btn {{ $filter == 'all' ? 'btn-info' : 'btn-outline-info' }}">
                        <i class="fa fa-list"></i> Todas las Órdenes
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($filter == 'all')
                <small>Mostrando: <strong>Todas las órdenes registradas</strong></small>
            @else
                <small>Órdenes para este día: <strong>{{$todayStr}}</strong></small>
            @endif
            <br>
            <br>
            <table id="ordensTable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th># DIARIO</th>
                    <th>NUM. ORDEN</th>
                    <th>NOMBRE PACIENTE</th>
                    <th>FECHA ORDEN</th>
                    <th class="text-center">ESTADO</th>
                    <th class="text-center">FACTURADO</th>
                    <th>TOTAL</th>
                    <th class="text-center">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ordens as $orden)
                    <tr>
                        <td></td>
                        <td>{{$orden->id}}</td>
                        <td>{{$orden->paciente->nombre}}, {{$orden->paciente->apellido}}</td>
                        <td>{{$orden->created_at}}</td>
                        <td class="text-center">
                            @php
                                $badgeClass = 'secondary';
                                if($orden->estado == 'EN PROCESO') $badgeClass = 'info';
                                if($orden->estado == 'COMPLETADO') $badgeClass = 'success';
                                if($orden->estado == 'ANULADO') $badgeClass = 'danger';
                            @endphp
                            <span class="badge badge-{{$badgeClass}}">{{$orden->estado}}</span>
                        </td>
                        <td class="text-center">
                            @if($orden->facturado == 'SI')
                                <span class="badge badge-success">SI</span>
                            @else
                                <span class="badge badge-secondary">NO</span>
                            @endif
                        </td>
                        <td>${{$orden->total}}</td>
                        <td width="150px" class="text-center">
                            <div class="btn-group" role="group">
                                {{-- Botón de Resultados (Cambiado a fa-print) --}}
                                @if($orden->estado == 'COMPLETADO')
                                    <a class="btn btn-info btn-sm" href="{{route('admin.ordens.imprimirResultados', $orden)}}" target="_blank" title="Imprimir Resultados">
                                        <i class="fa fa-print"></i>
                                    </a>
                                @endif

                                {{-- Botón de Editar Orden --}}
                                @if($orden->estado == 'EN PROCESO')
                                    <a class="btn btn-success btn-sm" href="{{route('admin.ordens.modificarOrden', $orden)}}" title="Editar Datos de Orden">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endif

                                {{-- Botón de Completar/Consultar --}}
                                <a class="btn btn-dark btn-sm" href="{{route('admin.ordens.edit', $orden)}}" title="{{ $orden->estado == 'EN PROCESO' ? 'Completar Exámenes' : 'Consultar Resultados' }}">
                                    <i class="fa {{ $orden->estado == 'EN PROCESO' ? 'fa-check-circle' : 'fa-search' }}"></i>
                                </a>

                                {{-- Botón de Anular --}}
                                @if($orden->estado != 'ANULADO')
                                    <button class="btn btn-danger btn-sm" onclick="anularOrden({{$orden->id}})" title="Anular Registro">
                                        <i class="fa fa-window-close"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var t = $('#ordensTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
            //Para crear columna de correlativo (no ID) en la tabla.
            t.on( 'order.dt search.dt', function () {
                let i = 1;
                t.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
                    this.data(i++);
                } );
            } ).draw();
        });

        function anularOrden(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: '¿Esta seguro que desea anular el registro?',
                text: "¡No es posible revertir esta operación!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, anular!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'anularOrden/'+id,
                        type:'post',
                        success: function (response) {
                            let responseParts = response.split("|");
                            let responseTittle = responseParts[1];
                            let responseMsg = responseParts[2];
                            let responseType = responseParts[0] === "0" ? 'success' : 'error';
                            
                            Swal.fire({
                                title: responseTittle,
                                text: responseMsg,
                                icon: responseType,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            }).then((result) => { location.reload(); });
                        },
                        error: function (x, e,  thrownError) {
                            Swal.fire("Error", x.responseText, "error");
                        }
                    });
                }
            })
        }

    </script>
@stop
