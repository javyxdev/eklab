@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-pen-alt"></i> Editar Examen </h1>
    <p>* Editar los datos del Examen.</p>
    <a href="{{route('admin.examens.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($examen,['route' => ['admin.examens.update', $examen], 'method' => 'put']) !!}
            @include('admin.examens.form')
            {!! Form::submit('ACTUALIZAR EXAMEN', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>

@stop
