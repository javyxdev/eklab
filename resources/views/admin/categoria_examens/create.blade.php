@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-vials"></i> Crear nueva Categoría de Examen</h1>
    <p>*Ingrese todos los datos requeridos para guardar una nueva categoría.</p>
    <a href="{{ route('admin.categoria_examens.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a listado
    </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categoria_examens.store') }}" method="POST">
                @csrf
                @include('admin.categoria_examens.form')

                <button type="submit" class="btn btn-success">GUARDAR CATEGORIA</button>
            </form>
        </div>
    </div>
@stop
