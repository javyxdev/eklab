@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-pen-alt"></i> Editar </h1>
    <p>* Editar los datos del Barrio/Colonia.</p>
    <a href="{{route('admin.barrios.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($barrio,['route' => ['admin.barrios.update', $barrio], 'method' => 'put']) !!}
            <div class="form-group">
                <div class="form-group">
                    {!! Form::label('municipio_id','MUNICIPIO:') !!}
                    {!! Form::select('municipio_id',$municipios, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Municipio']) !!}
                </div>
                @error('municipio_id')
                <small class="text-danger">{{$message}}</small>
                @enderror

                {!! Form::label('descripcion','NOMBRE CATEGORÍA / AREA:') !!}
                {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Barrio/Colonia']) !!}
                @error('descripcion')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            {!! Form::submit('ACTUALIZAR REGISTRO', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>
@stop
@section('js')
    <script>
        $('#municipio_id').select2();
    </script>
@stop
