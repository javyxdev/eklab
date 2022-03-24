@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-user-plus"></i> Crear nuevo Paciente</h1>
    <p>*Ingrese todos los datos requeridos para guardar un nuevo paciente.</p>
    <a href="{{route('admin.pacientes.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.pacientes.store']) !!}
                    @include('admin.pacientes.form')
                {!! Form::submit('GUARDAR PACIENTE', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>
@stop


