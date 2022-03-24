@extends('adminlte::page')

@section('title', 'EK Diagnóstico Lab')

@section('content_header')
    <div class="card">
        <div class="card-header bg-dark">
            <h1><strong>EK</strong> Diagnóstico</h1>
        </div>
        <div class="card-body">
            <p>Bienvenido <strong>{{$loggeduser}}</strong> al sistema administrativo de laboratorio clínico. </p>
        </div>
    </div>
@stop

@section('content')
    @include('admin.infoboxes')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
