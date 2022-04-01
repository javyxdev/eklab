@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-plus-circle"></i> Crear nuevo Barrio/Colonia</h1>
    <p>*Ingrese todos los datos requeridos para guardar un nuevo registro.</p>
    <a href="{{route('admin.barrios.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Dropdown fuera del form, unicamente para filtrar los municipios-->
            <div class="form-group">
                <label class="control-label">DEPARTAMENTO:</label>
                <select id="departamento_id" class="form-control">
                    <option disabled selected>Seleccione un Departamento</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{$departamento->id}}">{{$departamento->descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <!-- Inicio Formulario -->
            {!! Form::open(['route' => 'admin.barrios.store']) !!}
            @include('admin.barrios.form')
            {!! Form::submit('GUARDAR REGISTRO', ['class' => 'btn btn-success']) !!}
            {!! Form::close([]) !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#departamento_id').select2();
        $('#municipio_id').select2();

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
    </script>
@stop
