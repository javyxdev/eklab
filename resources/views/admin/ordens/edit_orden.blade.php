@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('css')
    <style>
        /* Personalización de Select2 Multiple (Tags) */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff !important;
            border-color: #006fe6 !important;
            color: #fff !important;
            padding: 0 10px !important;
            margin-top: 0.4rem !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: rgba(255,255,255,.7) !important;
            float: right !important;
            margin-left: 5px !important;
            margin-right: -2px !important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #fff !important;
        }

        /* Fix Alineación Vertical Select2 Single (Pacientes) */
        .select2-container .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            padding: 0.375rem 0.75rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding-left: 0 !important;
            color: #495057 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
        }
    </style>
@stop

@section('content_header')
    <h1><i class="fa fa-edit"></i> Editar Orden #: 000{{ $orden->id }}</h1>
    <p>*Actualice los datos de la orden. Solo se pueden modificar exámenes no completados.</p>
    <a href="{{ route('admin.ordens.edit', $orden->id) }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a completar
    </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <input type="hidden" id="orden_id" value="{{ $orden->id }}">
            
            <div class="form-group row col-12">
                <label for="paciente_id">PACIENTE:</label>
                <select name="paciente_id" id="paciente_id" class="form-control select2bs4">
                    <option value="" disabled>Seleccione un Paciente</option>
                    @foreach($pacientes as $id => $nombre)
                        <option value="{{ $id }}" {{ $orden->paciente_id == $id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="form-group col-3">
                    <label for="genero">GENERO:</label>
                    <input type="text" class="form-control" id="genero" value="{{ $orden->paciente->genero }}" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="fechaNac">FECHA NACIMIENTO:</label>
                    <input type="text" class="form-control" id="fechaNac" value="{{ $orden->paciente->fecha_nacimiento }}" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="dui">DUI:</label>
                    <input type="text" class="form-control" id="dui" value="{{ $orden->paciente->dui }}" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="telefono">TELEFONO:</label>
                    <input type="text" class="form-control" id="telefono" value="{{ $orden->paciente->telefono }}" disabled>
                </div>
            </div>

            <br>

            <div class="form-group col-12">
                <label for="examen_id">LISTADO DE EXAMENES:</label><br>
                <small>Seleccione uno o varios exámenes</small>
                <select name="examen_id[]" id="examen_id" class="form-control" multiple>
                    @foreach($examenes as $examen)
                        <option value="{{ $examen->id }}" data-precio="{{ $examen->precio }}" 
                            {{ in_array($examen->id, $exms_seleccionados) ? 'selected' : '' }}>
                            {{ $examen->examen_precio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-12">
                <label for="total">TOTAL ORDEN $:</label>
                <input type="text" name="total" id="total" class="form-control col-4" value="{{ number_format($orden->total, 2) }}" readonly>
            </div>

            <div class="col-12 text-center">
                <button type="button" id="btnActualizar" class="btn btn-success" onclick="actualizarOrden()">
                    <i class="fa fa-save fa-fw"></i> ACTUALIZAR ORDEN
                </button>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#paciente_id').select2();
        $('#examen_id').select2({
            placeholder: "Seleccione uno o varios exámenes"
        });

        $('#paciente_id').change(function(){
            var id = $(this).val();
            $.ajax({
                url: '{{ url("admin/ordens/getPacienteById") }}/' + id,
                type: 'get',
                success: function(response) {
                    $("#genero").val(response.paciente.genero);
                    $("#fechaNac").val(response.paciente.fecha_nacimiento);
                    $("#dui").val(response.paciente.dui);
                    $("#telefono").val(response.paciente.telefono);
                }
            });
        });

        $('#examen_id').on('change', function() {
            let total = 0;
            $('#examen_id option:selected').each(function() {
                let precio = parseFloat($(this).data('precio')) || 0;
                total += precio;
            });
            $('#total').val(total.toFixed(2));
        });

        function actualizarOrden(){
            var idOrden = $('#orden_id').val();
            var idPaciente = $('#paciente_id').val();
            var idExamens = $('#examen_id').val();
            var total = $('#total').val();

            if (!idExamens || idExamens.length === 0) {
                swal.fire("Error", "Debe seleccionar al menos un examen", "warning");
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url("admin/ordens/updateOrden") }}',
                type: 'post',
                data: {
                    orden_id: idOrden,
                    idPaciente: idPaciente, 
                    idExamens: idExamens, 
                    total: total
                },
                beforeSend: function() {
                    $('#btnActualizar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> ACTUALIZANDO...');
                },
                success: function (response) {
                    swal.fire({
                        title: '¡Éxito!',
                        text: response,
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => { 
                        window.location.replace('{{ url("admin/ordens") }}/' + idOrden + '/edit');
                    });
                },
                error: function (x, e,  thrownError) {
                    $('#btnActualizar').prop('disabled', false).html('<i class="fa fa-save fa-fw"></i> ACTUALIZAR ORDEN');
                    swal.fire("Error", x.responseText, "error");
                }
            });
        }
    </script>
@stop
