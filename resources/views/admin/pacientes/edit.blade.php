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
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pacientes.update', $paciente) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pacientes.form')

                <button type="submit" class="btn btn-success">ACTUALIZAR PACIENTE</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function(){
            controlarIngresoManual();

            var fechaNacimiento = $('#fecha_nacimiento').val();
            if(fechaNacimiento !== '' && !$('#sin_dui').is(':checked')){
                var edad = getEdad(fechaNacimiento);
                $('#edad').val(edad);
            }
        });

        /** Control de checkbox Sin DUI */
        $('#sin_dui').change(function(){
            controlarIngresoManual();
        });

        function controlarIngresoManual(){
            if($('#sin_dui').is(':checked')){
                $('#edad').prop('disabled', false);
                $('#dui').val('').prop('disabled', true);
            } else {
                $('#edad').prop('disabled', true);
                $('#dui').prop('disabled', false);
                // Recalcular edad si hay fecha
                var fechaNacimiento = $('#fecha_nacimiento').val();
                if(fechaNacimiento !== ''){
                    $('#edad').val(getEdad(fechaNacimiento));
                }
            }
        }

        /** Habilitar campos disabled antes de enviar el formulario */
        $('form').submit(function() {
            $('#edad').prop('disabled', false);
            $('#dui').prop('disabled', false);
        });

        /** Calculo de edad a partir del cambio en la fecha de nacimiento */
        $('#fecha_nacimiento').change(function(){
            if(!$('#sin_dui').is(':checked')){
                var fecha = $(this).val();
                if(fecha !== ''){
                    var edad = getEdad(fecha);
                    $('#edad').val(edad);
                } else {
                    $('#edad').val('');
                }
            }
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

