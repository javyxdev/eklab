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
    <h1><i class="fa fa-clipboard-list"></i> Generar una Orden de Examenes</h1>
    <p>*Ingrese todos los datos requeridos para guardar una nueva orden.</p>
    <a href="{{ route('admin.ordens.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i>  Regresar a listado
    </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <input type="hidden" id="orden_id" value="">
            
            <div class="form-group row col-12">
                <label for="paciente_id">PACIENTE:</label>
                <select name="paciente_id" id="paciente_id" class="form-control select2bs4">
                    <option value="" disabled selected>Seleccione un Paciente</option>
                    @foreach($pacientes as $id => $nombre)
                        <option value="{{ $id }}" {{ old('paciente_id') == $id ? 'selected' : '' }}>
                            {{ $nombre }}
                        </option>
                    @endforeach
                </select>
                @error('paciente_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                <div class="form-group col-3">
                    <label for="genero">GENERO:</label>
                    <input type="text" class="form-control" id="genero" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="fechaNac">FECHA NACIMIENTO:</label>
                    <input type="text" class="form-control" id="fechaNac" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="dui">DUI:</label>
                    <input type="text" class="form-control" id="dui" disabled>
                </div>
                <div class="form-group col-3">
                    <label for="telefono">TELEFONO:</label>
                    <input type="text" class="form-control" id="telefono" disabled>
                </div>
            </div>

            <small>
                ¿No encuentra el Paciente? Puede ingresar un nuevo paciente aqui:&nbsp;&nbsp;
                <a href="{{ route('admin.pacientes.create') }}" class="btn btn-success btn-xs">
                    <i class="fa fa-plus-circle"></i> Nuevo Paciente
                </a>
                &nbsp;
                ¿Desea actualizar los datos del paciente?
                &nbsp;
                <button type="button" class="btn btn-success btn-xs" onclick="editarPaciente()">
                    <i class="fa fa-user-edit"></i> Editar Paciente
                </button>
            </small>
            <br><br>

            <div class="form-group col-12">
                <label for="examen_id">LISTADO DE EXAMENES:</label><br>
                <small>Seleccione uno o varios exámenes</small>
                <select name="examen_id[]" id="examen_id" class="form-control" multiple>
                    @foreach($examenes as $examen)
                        <option value="{{ $examen->id }}" data-precio="{{ $examen->precio }}" {{ (collect(old('examen_id'))->contains($examen->id)) ? 'selected' : '' }}>
                            {{ $examen->examen_precio }}
                        </option>
                    @endforeach
                </select>
                @error('examen_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-12">
                <label for="total">TOTAL ORDEN $:</label>
                <input type="text" name="total" id="total" class="form-control col-4" value="0.00" readonly>
            </div>

            <div class="col-12 text-center">
                <button type="button" id="btnProcesar" class="btn btn-success" onclick="procesarOrden()" disabled>
                    <i class="fa fa-check-circle fa-fw"></i> PROCESAR ORDEN
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

        // Recopilador de datos del Paciente
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
                    validarProcesar();
                },
                error: function (x, e, thrownError) {
                    swal.fire("Error", x.responseText, "error");
                }
            });
        });

        // Totalización automática cada vez que cambia la selección de exámenes
        $('#examen_id').on('change', function() {
            let total = 0;
            $('#examen_id option:selected').each(function() {
                let precio = parseFloat($(this).data('precio')) || 0;
                total += precio;
            });
            $('#total').val(total.toFixed(2));
            validarProcesar();
        });

        function validarProcesar() {
            let idPaciente = $('#paciente_id').val();
            let total = parseFloat($('#total').val()) || 0;
            if (idPaciente && total > 0) {
                $('#btnProcesar').prop('disabled', false);
            } else {
                $('#btnProcesar').prop('disabled', true);
            }
        }

        // Editar paciente
        function editarPaciente(){
            var url = '{{ route('admin.pacientes.edit', ':id') }}';
            url = url.replace(':id', $('#paciente_id').val());
            window.open(url);
        }

        function procesarOrden(){
            var idPaciente = $('#paciente_id').val();
            var idExamens = $('#examen_id').val();
            var total = $('#total').val();

            if (!idPaciente) {
                swal.fire("Error", "Debe seleccionar un paciente", "warning");
                return;
            }

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
                url: '{{ url("admin/ordens/procesarOrden") }}',
                type: 'post',
                data: {idPaciente:idPaciente, idExamens:idExamens, total:total},
                beforeSend: function() {
                    $('#btnProcesar').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> PROCESANDO...');
                },
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
                    $('#btnProcesar').prop('disabled', false).html('<i class="fa fa-check-circle fa-fw"></i> PROCESAR ORDEN');
                    swal.fire("Error", x.responseText + e + thrownError, "error");
                }
            });
        }
    </script>
@stop
