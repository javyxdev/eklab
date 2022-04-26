@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-user-edit"></i> Editar Paciente</h1>
    <p>* Editar los datos del paciente.</p>
    <a href="{{route('admin.pacientes.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($paciente,['route' => ['admin.pacientes.update', $paciente], 'method' => 'put']) !!}
                    @include('admin.pacientes.form')
                {!! Form::submit('ACTUALIZAR PACIENTE', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            var fechaNacimiento = $('#fecha_nacimiento').val();
            if(fechaNacimiento !== ''){
                var edad = getEdad(fechaNacimiento);
                $('#edad').val(edad);
            }else{
                $('#edad').val('');
            }
        });

        /** Calculo de edad a partir del cambio en la fecha de nacimiento */
        $('#fecha_nacimiento').change(function(){
            var edad = getEdad($(this).val());
            $('#edad').val(edad);
        });

        /** Función para cálculo de edad */
        function getEdad(dateString) {
            let hoy = new Date()
            let fechaNacimiento = new Date(dateString)
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear()
            let diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth()
            if (
                diferenciaMeses < 0 ||
                (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())
            ) {
                edad--
            }
            return edad
        }
    </script>
@stop

