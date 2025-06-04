@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-pen-alt"></i> Editar</h1>
    <p>* Editar los datos del Municipio.</p>
    <a href="{{ route('admin.municipios.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a listado
    </a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.municipios.update', $municipio) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.municipios.form')
                <button type="submit" class="btn btn-success">ACTUALIZAR MUNICIPIO</button>
            </form>
        </div>
    </div>
@stop
