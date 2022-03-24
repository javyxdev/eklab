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
                            <td width="10px"><a class="btn btn-success btn-sm" href="{{route('admin.pacientes.edit', $paciente)}}">EDITAR</a></td>
                            <td width="10px">
                                <form action="{{route('admin.pacientes.destroy', $paciente)}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                                </form>
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
        $('#pacientesTable').DataTable();
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        )
    </script>
@stop
