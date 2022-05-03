@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-vial"></i> Mantenimiento de Examenes</h1>
    <p>Listado de examenes individuales disponibles.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-warning">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{route('admin.examens.create')}}"><i class="fa fa-vial fa-fw"></i> NUEVO EXAMEN</a>
        </div>
        <div class="card-body">
            <table id="examensTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE DEL EXAMEN</th>
                    <th>CATEGORIA / AREA</th>
                    <th>PRECIO</th>
                    <th>PLANTILLA</th>
                    <th>EDITAR</th>
                    <th>ELIMINAR</th>
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
                        <td width="75px">
                            <a class="btn btn-success btn-sm" href="{{route('admin.examens.edit', $examen)}}">
                                <i class="fa fa-pen fa-sm fa-fw"></i>
                                <small>EDITAR</small>
                            </a>
                        </td>
                        <td width="90px">
                            <button class="btn btn-danger btn-sm" onclick="eliminarRegistro({{$examen->id}})">
                                <i class="fa fa-trash-alt fa-sm fa-fw"></i>
                                <small>ELIMINAR</small>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>
        $('#examensTable').DataTable();

        function eliminarRegistro(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: '¿Esta seguro que desea eliminar el registro?',
                text: "¡No es posible revertir esta operación!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar registro!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value === true) {
                    $.ajax({
                        url:'categoriaExamensDelete/'+id,
                        type:'post',
                        success: function (response) {
                            swal.fire({
                                title: '¡Eliminado!',
                                text: response,
                                type: 'success',
                                showCancelButton: false,
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

