@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('css')
    <style>
        /* Reducción del font general de la tabla en un 20% */
        #examensTable {
            font-size: 0.8rem !important;
        }
        #examensTable td, #examensTable th {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }
    </style>
@stop

@section('content_header')
    <h1><i class="fa fa-vial"></i> Mantenimiento de Exámenes</h1>
    <p>Listado de exámenes individuales disponibles.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> {{session('info')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{route('admin.examens.create')}}"><i class="fa fa-vial fa-fw"></i> NUEVO EXAMEN</a>
        </div>
        <div class="card-body">
            <table id="examensTable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE DEL EXAMEN</th>
                    <th>CATEGORÍA / ÁREA</th>
                    <th>PRECIO</th>
                    <th>PLANTILLA</th>
                    <th class="text-center">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($examenes as $examen)
                    <tr>
                        <td>{{$examen->id}}</td>
                        <td>{{$examen->descripcion}}</td>
                        <td>{{$examen->categoria_examen->descripcion}}</td>
                        <td>${{$examen->precio}}</td>
                        <td>{{$examen->plantilla}}</td>
                        <td width="100px" class="text-center">
                            <div class="btn-group">
                                <a class="btn btn-success btn-sm" href="{{route('admin.examens.edit', $examen)}}" title="Editar Examen">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="eliminarRegistro({{$examen->id}})" title="Eliminar Examen">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
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
        $('#examensTable').DataTable({
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
                "sSearch":         "Buscar:",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });

        function eliminarRegistro(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: '¿Esta seguro que desea eliminar el registro?',
                text: "¡No es posible revertir esta operación!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borrar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'examensDelete/'+id,
                        type:'post',
                        success: function (response) {
                            swal.fire({
                                title: '¡Eliminado!',
                                text: response,
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            }).then((result) => { location.reload(); });

                        },
                        error: function (x, e,  thrownError) {
                            swal.fire("Error", x.responseText, "error");
                        }
                    });
                }
            })
        }

    </script>
@stop
