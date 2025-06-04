@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-plus-circle"></i> Crear nuevo Municipio</h1>
    <p>*Ingrese todos los datos requeridos para guardar un Municipio</p>
    <a href="{{ route('admin.municipios.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a listado
    </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.municipios.store') }}" method="POST">
                @csrf
                @include('admin.municipios.form')
                <button type="submit" class="btn btn-success">GUARDAR MUNICIPIO</button>
            </form>
        </div>
    </div>
@stop
