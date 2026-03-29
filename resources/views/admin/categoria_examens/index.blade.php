@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('css')
    <style>
        /* Reducción del font general de la tabla en un 20% */
        #categoriaExamensTable {
            font-size: 0.8rem !important;
        }
        #categoriaExamensTable td, #categoriaExamensTable th {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }
    </style>
@stop

@section('content_header')
    <h1><i class="fa fa-vials"></i> Categorías de Examen</h1>
    <p>Listado de clasificaciones de exámenes disponibles.</p>
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
            <a class="btn btn-primary" href="{{route('admin.categoria_examens.create')}}"><i class="fa fa-plus-circle fa-fw"></i> NUEVA CATEGORÍA</a>
        </div>
        <div class="card-body">
            <table id="categoriaExamensTable" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE DE CATEGORÍA</th>
                    <th class="text-center">ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria_examen)
                    <tr>
                        <td>{{$categoria_examen->id}}</td>
                        <td>{{$categoria_examen->descripcion}}</td>
                        <td width="100px" class="text-center">
                            <div class="btn-group">
                                <a class="btn btn-success btn-sm" href="{{route('admin.categoria_examens.edit', $categoria_examen)}}" title="Editar Categoría">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="eliminarRegistro({{$categoria_examen->id}})" title="Eliminar Categoría">
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
        $('#categoriaExamensTable').DataTable({
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
                        url:'categoriaExamensDelete/'+id,
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
