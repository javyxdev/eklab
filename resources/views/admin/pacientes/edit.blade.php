@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-user-edit"></i> Editar Paciente</h1>
    <p>* Editar los datos del paciente.</p>
    <a href="{{route('admin.pacientes.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($paciente,['route' => ['admin.pacientes.update', $paciente], 'method' => 'put']) !!}
                    @include('admin.pacientes.form')
                {!! Form::submit('ACTUALIZAR PACIENTE', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>

@stop
