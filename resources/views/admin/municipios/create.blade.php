@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-plus-circle"></i> Crear nuevo Municipio</h1>
    <p>*Ingrese todos los datos requeridos para guardar un Municipio</p>
    <a href="{{route('admin.municipios.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.municipios.store']) !!}
            @include('admin.municipios.form')
            {!! Form::submit('GUARDAR MUNICIPIO', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>
@stop
