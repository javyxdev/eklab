@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-map-marked-alt"></i> Mantenimiento de Barrios / Colonias </h1>
    <p>Listado de registros disponibles.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-warning">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{route('admin.barrios.create')}}"><i class="fa fa-plus-circle fa-fw"></i> NUEVO REGISTRO</a>
        </div>
        <div class="card-body">
            <table id="barriosTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>DEPARTAMENTO</th>
                    <th>MUNICIPIO</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($barrios as $barrio)
                    <tr>
                        <td>{{$barrio->id}}</td>
                        <td>{{$barrio->descripcion}}</td>
                        <td>{{$barrio->municipio->descripcion}}</td>
                        <td>{{$barrio->municipio->departamento->descripcion}}</td>
                        <td width="75px">
                            <a class="btn btn-success btn-sm" href="{{route('admin.barrios.edit', $barrio)}}">
                                <i class="fa fa-pen fa-sm fa-fw"></i>
                                <small>EDITAR</small>
                            </a>
                        </td>
                        <td width="95px">
                            <button class="btn btn-danger btn-sm" onclick="eliminarRegistro({{$barrio->id}})">
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
        $('#barriosTable').DataTable();

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
                        url:'barriosDelete/'+id,
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
