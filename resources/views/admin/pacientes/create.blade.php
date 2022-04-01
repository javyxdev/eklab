@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-user-plus"></i> Crear nuevo Paciente</h1>
    <p>*Ingrese todos los datos requeridos para guardar un nuevo paciente.</p>
    <a href="{{route('admin.pacientes.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.pacientes.store']) !!}
                    @include('admin.pacientes.form')
                {!! Form::submit('GUARDAR PACIENTE', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#departamento_id').change(function(){
            var id = $("#departamento_id option:selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'getMunicipiosByDepartamento/'+id,
                type:'get',
                success: function (response) {
                    $("#municipio_id").empty();
                    $("#barrio_id").empty();
                    $("#municipio_id").append(new Option('Seleccione un Municipio','')).attr('selected',true);
                    $("#barrio_id").append(new Option('Seleccione un Barrio','')).attr('selected',true);
                    $.each(response.municipios, function () {
                        $("#municipio_id").append(new Option(this.descripcion, this.id));
                    });

                },
                error: function (xhr, status) {
                    swal.fire("Error", xhr.responseText, "error");
                }
            });
        });

        $('#municipio_id').change(function(){
            var id = $("#municipio_id option:selected").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'getBarriosByMunicipio/'+id,
                type:'get',
                success: function (response) {
                    $("#barrio_id").empty();
                    $("#barrio_id").append(new Option('Seleccione un Barrio','')).attr('selected',true);
                    $.each(response.barrios, function () {
                        $("#barrio_id").append(new Option(this.descripcion, this.id));
                    });

                },
                error: function (xhr, status) {
                    swal.fire("Error", xhr.responseText, "error");
                }
            });
        })
    </script>
@stop


