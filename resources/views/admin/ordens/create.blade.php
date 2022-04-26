@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-clipboard-list"></i> Generar una Orden de Examenes</h1>
    <p>*Ingrese todos los datos requeridos para guardar una nueva orden.</p>
    <a href="{{route('admin.ordens.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="form-group row col-12">
                {!! Form::label('paciente_id','PACIENTE:') !!}
                {!! Form::select('paciente_id', $pacientes, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Paciente']) !!}
            </div>

            <div class="row">
                <div class="form-group col-3">
                    <label>GENERO:</label>
                    <input type="text" class="form-control" id="genero" disabled>
                </div>
                <div class="form-group col-3">
                    <label>FECHA NACIMIENTO:</label>
                    <input type="text" class="form-control" id="fechaNac" disabled>
                </div>
                <div class="form-group col-3">
                    <label>DUI:</label>
                    <input type="text" class="form-control" id="dui" disabled>
                </div>
                <div class="form-group col-3">
                    <label>TELEFONO:</label>
                    <input type="text" class="form-control" id="telefono" disabled>
                </div>
            </div>

            <small>¿No encuentra el Paciente? Puede ingresar un nuevo paciente aqui: &nbsp; &nbsp;
                <a href="{{route('admin.pacientes.create')}}" class="btn btn-success btn-xs">
                    <i class="fa fa-plus-circle"></i>
                    Nuevo Paciente
                </a>
                &nbsp;
                ¿Desea actualizar los datos del paciente?
                &nbsp;
                <button class="btn btn-success btn-xs" onclick="editarPaciente()"> <i class="fa fa-user-edit"></i> Editar Paciente</button>
            </small>
            </br></br>
            <div class="form-group col-12">
                {!! Form::label('examen_id','LISTADO DE EXAMENES:') !!}
                </br>
                <small>Seleccione uno o varios exámenes</small>
                {!! Form::select('examen_id', $examenes, null, ['class' => 'form-control', 'multiple' => 'multiple' ]) !!}
            </div>

            <div class="form-group col-12">
                {!! Form::label('total','TOTAL ORDEN $:') !!}
                {!! Form::text('total', null, ['class' => 'form-control col-4', 'disabled']) !!}
            </div>

            <div class="form-controlcol-12 text-center">
                <button id="btnTotalizar" class="btn btn-dark" onclick="totalizarOrden()"><i class="fa fa-calculator fa-fw"></i> TOTALIZAR ORDEN</button>
                <button id="btnProcesar" class="btn btn-success" onclick="procesarOrden()" disabled><i class="fa fa-check-circle fa-fw"></i> PROCESAR ORDEN</button>
                <button id="btnModificar" class="btn btn-warning" onclick="modificarOrden()" disabled><i class="fa fa-edit fa-fw"></i> MODIFICAR ORDEN</button>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        $('#paciente_id').select2();
        $('#examen_id').select2();

        /** Recopilador de datos del Paciente */
        $('#paciente_id').change(function(){
            var id = $(this).val();
            $.ajax({
                url:'getPacienteById/'+id,
                type:'get',
                success: function (response) {
                    $("#genero").val(response.paciente.genero);
                    $("#fechaNac").val(response.paciente.fecha_nacimiento);
                    $("#dui").val(response.paciente.dui);
                    $("#telefono").val(response.paciente.telefono);
                },
                error: function (x, e,  thrownError) {
                    swal.fire("Error", x.responseText, "error");
                }
            });
        });

        /** Editar paciente*/
        function editarPaciente(){
            var url = '{{route('admin.pacientes.edit',':id')}}'
            url = url.replace(':id',$('#paciente_id').val());
            window.open(url);
        }

        /** Función para pre-totalizar la orden. */
        function totalizarOrden(){
            var idPaciente = $('#paciente_id').val();
            var idExamens = [];
            $("#examen_id option:selected").each(function(){
                idExamens.push($(this).val());
            });
            if(idPaciente !== ''){
                if(idExamens.length > 0){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'totalizarOrden',
                        type:'post',
                        data: {idExamens : idExamens},
                        success: function (response) {
                            swal.fire("$"+response.total,"Total de Orden","success");
                            $('#total').val(response.total);
                            $('#btnTotalizar').prop('disabled',true);
                            $('#btnModificar').prop('disabled',false);
                            $('#btnProcesar').prop('disabled',false);
                            $('#examen_id').prop('disabled',true);
                            $('#paciente_id').prop('disabled',true);
                        },
                        error: function (x, e,  thrownError) {
                            swal.fire("Error", x.responseText + e + thrownError, "error");
                        }
                    });
                }else{
                    swal.fire("Requerido","Debe seleccionar al menos un examen para poder totalizar.","warning");
                }
            }else{
                swal.fire("Requerido","¡Seleccione un paciente para poder totalizar!","warning");
            }
        };


        function procesarOrden(){
            var idPaciente = $('#paciente_id').val();
            var idExamens = [];
            var total = $('#total').val();
            $("#examen_id option:selected").each(function(){
                idExamens.push($(this).val());
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'procesarOrden',
                type:'post',
                data: {idPaciente:idPaciente, idExamens:idExamens, total:total},
                success: function (response) {
                    swal.fire({
                        title: '¡Procesado!',
                        text: response,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => { window.location.replace('{{route('admin.ordens.index')}}'); });
                },
                error: function (x, e,  thrownError) {
                    swal.fire("Error", x.responseText + e + thrownError, "error");
                }
            });
        }

        function modificarOrden(){
            $('#btnTotalizar').prop('disabled',false);
            $('#btnModificar').prop('disabled',true);
            $('#btnProcesar').prop('disabled',true);
            $('#examen_id').prop('disabled',false);
            $('#paciente_id').prop('disabled',false);
        }

    </script>
@stop
