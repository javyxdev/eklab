@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-pen-alt"></i> Editar Examen </h1>
    <p>* Editar los datos del Examen.</p>
    <a href="{{ route('admin.examens.index') }}" class="btn btn-primary btn-sm">
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
            <form action="{{ route('admin.examens.update', $examen) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.examens.form')
                <button type="submit" class="btn btn-success">ACTUALIZAR EXAMEN</button>
            </form>
        </div>
    </div>
@stop
