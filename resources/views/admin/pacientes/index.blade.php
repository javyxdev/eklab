@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-list"></i> Listado de Pacientes</h1>
    <p>Base de datos de pacientes registrados.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-warning">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{route('admin.pacientes.create')}}"><i class="fa fa-user-plus fa-fw"></i> NUEVO PACIENTE</a>
        </div>
        <div class="card-body">
            <table id="pacientesTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>DUI</th>
                        <th>FECHA NAC.</th>
                        <th>EMAIL</th>
                        <th>TELEFONO</th>
                        <th>BARRIO</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{$paciente->id}}</td>
                            <td>{{$paciente->nombre}}</td>
                            <td>{{$paciente->apellido}}</td>
                            <td>{{$paciente->dui}}</td>
                            <td width="20px">{{$paciente->fecha_nacimiento}}</td>
                            <td>{{$paciente->email}}</td>
                            <td>{{$paciente->telefono}}</td>
                            <td>{{$paciente->barrio->descripcion}}</td>
                            <td>
                                <a class="btn btn-success btn-sm" href="{{route('admin.pacientes.edit', $paciente)}}">
                                    <i class="fa fa-pen fa-sm fa-fw"></i>
                                    <small>EDITAR</small>
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="eliminarRegistro({{$paciente->id}})">
                                    <i class="fa fa-trash-alt fa-sm fa-fw"></i>
                                    <small>ELIMINAR</small>
                                </button>
                            </td>
                            <!--<td width="10px">
                                <form action="{{route('admin.pacientes.destroy', $paciente)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                                </form>
                            </td>-->
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
        $('#pacientesTable').DataTable();
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
                        url:'pacientesDelete/'+id,
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
