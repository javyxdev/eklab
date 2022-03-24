@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-vials"></i> Editar Categoría</h1>
    <p>* Editar los datos de la Categoría.</p>
    <a href="{{route('admin.categoria_examens.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($categoria_examen,['route' => ['admin.categoria_examens.update', $categoria_examen], 'method' => 'put']) !!}
                @include('admin.categoria_examens.form')
            {!! Form::submit('ACTUALIZAR CATEGORIA', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>

@stop
