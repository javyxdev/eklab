@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-vial"></i> Crear un nuevo Examen</h1>
    <p>*Ingrese todos los datos requeridos para guardar un nuevo examen.</p>
    <a href="{{ route('admin.examens.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a listado
    </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.examens.store') }}" method="POST">
                @csrf
                @include('admin.examens.form')
                <button type="submit" class="btn btn-success">GUARDAR EXAMEN</button>
            </form>
        </div>
    </div>
@stop
