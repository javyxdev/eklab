@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-clipboard-list"></i>&nbsp; ORDEN #: 000{{ $orden->id }}</h1>
    <p>*En esta sección se pueden completar todos los exámenes de la orden.</p>
    <a href="{{ route('admin.ordens.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a listado
    </a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <input type="hidden" id="orden_id" value="{{ $orden->id }}">

                <div class="form-group col-4">
                    <label>PACIENTE:</label>
                    <input type="text" class="form-control" id="paciente"
                           value="{{ $orden->paciente->apellido }}, {{ $orden->paciente->nombre }}" disabled>
                </div>
                <div class="form-group col-1">
                    <label>GÉNERO:</label>
                    <input type="text" class="form-control" id="genero" value="{{ $orden->paciente->genero }}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>FECHA NACIMIENTO:</label>
                    <input type="text" class="form-control" id="fechaNac" value="{{ $orden->paciente->fecha_nacimiento }}"
                           disabled>
                </div>
                <div class="form-group col-1">
                    <label>EDAD:</label>
                    <input type="text" class="form-control" id="edad" disabled>
                </div>
                <div class="form-group col-2">
                    <label>DUI:</label>
                    <input type="text" class="form-control" id="dui" value="{{ $orden->paciente->dui }}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>TELÉFONO:</label>
                    <input type="text" class="form-control" id="telefono" value="{{ $orden->paciente->telefono }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-2">
                    <label>ESTADO:</label>
                    <input type="text" class="form-control" id="estado" value="{{ $orden->estado }}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>FECHA DE LA ORDEN:</label>
                    <input type="text" class="form-control" id="fechaOrden" value="{{ $orden->created_at }}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>TOTAL DE ORDEN:</label>
                    <input type="text" class="form-control" id="total" value="${{ $orden->total }}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>ACCIONES:</label>
                    <button class="btn btn-primary" onclick="printOrder()"><i class="fa fa-print fa-fw"></i> IMPRIMIR
                        ORDEN</button>
                </div>
            </div>

            @if(session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-dark">
                    Detalle de Exámenes a realizar:
                </div>
                <div class="card-body">
                    <table id="detaOrdenTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>No.EXM</th>
                            <th>EXAMEN</th>
                            <th>PLANTILLA</th>
                            <th>COMPLETAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detalleOrdens as $detaOrden)
                            <tr>
                                <td>{{ $detaOrden->id }}</td>
                                <td>{{ $detaOrden->examen->descripcion }}</td>
                                <td>{{ $detaOrden->examen->plantilla }}</td>
                                <td>
                                    @if($detaOrden->completado == 0)
                                        <button class="btn btn-dark btn-sm" onclick="desliegaPlantilla({{ $detaOrden->id }}, {{ $detaOrden->examen->id }}, '{{ $detaOrden->examen->plantilla }}', '{{ $detaOrden->examen->descripcion }}', '{{ $detaOrden->examen->unidad_med }}', '{{ $detaOrden->examen->rango_ref }}')">
                                            <i class="fa fa-check-circle fa-sm fa-fw"></i>
                                            COMPLETAR ORDEN
                                        </button>
                                    @else
                                        <i class="fa fa-check-circle fa-sm fa-fw"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-control col-12 text-center mt-3">
                <button id="btnProcesar" class="btn btn-success" onclick="finalizarOrden()"><i
                        class="fa fa-check-circle fa-fw"></i> FINALIZAR ORDEN</button>
            </div>

        </div>
    </div>

    @include('admin.ordens.pl_heces_modal')
    @include('admin.ordens.pl_orina_modal')
    @include('admin.ordens.pl_hemograma_modal')
    @include('admin.ordens.pl_quimica_modal')
    @include('admin.ordens.pl_generica_modal')
@stop

@section('js')
    <script>
        $(document).ready(function () {
            var fechaNacimiento = $('#fechaNac').val();
            if (fechaNacimiento !== '') {
                var edad = getEdad(fechaNacimiento);
                $('#edad').val(edad);
            } else {
                $('#edad').val('');
            }

            if ('{{ $orden->estado }}' === 'ANULADO') {
                Swal.fire('ORDEN ANULADA', 'No es posible completar una orden anulada', 'error');
                $("#btnProcesar").prop('disabled', true);
            } else if ('{{ $orden->estado }}' === 'COMPLETADA') {
                Swal.fire('ORDEN COMPLETADA', 'Esta orden ha sido completada, solo puede consultarla.', 'warning');
                $("#btnProcesar").prop('disabled', true);
            }
        });

        function getEdad(dateString) {
            let hoy = new Date();
            let fechaNacimiento = new Date(dateString);
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            let diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
            if (diferenciaMeses < 0 || (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }
            return edad;
        }

        function finalizarOrden() {
            let id = $("#orden_id").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: '¿Está seguro que desea finalizar la Orden?',
                text: "¡No es posible revertir esta operación!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Finalizar Orden',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'finalizarOrden',
                        type: 'post',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            let responseParts = response.split("|");
                            let responseTitle = responseParts[1];
                            let responseMsg = responseParts[2];
                            let responseType = responseParts[0] === "0" ? 'success' : 'error';
                            Swal.fire({
                                title: responseTitle,
                                text: responseMsg,
                                icon: responseType,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (x, e, thrownError) {
                            Swal.fire("Error", x.responseText, "error");
                        }
                    });
                }
            });
        }

        function printOrder() {
            window.print();
        }

        function desliegaPlantilla(detaOrdenId, examenId, plantilla, nombrePrueba, unidadMed, rangoRef) {
            switch (plantilla) {
                case 'EGH':
                    $("#exmHeces").modal('toggle');
                    $("#tituloCoprologia").empty().append("Plantilla de Coprología: " + nombrePrueba);
                    $("#id_exm_heces").val(examenId);
                    $("#id_deta_prueba_heces").val(detaOrdenId);
                    break;
                case 'EGO':
                    $("#exmOrina").modal('toggle');
                    $("#tituloUroanalisis").empty().append("Plantilla de Uroanálisis: " + nombrePrueba);
                    $("#id_exm_orina").val(examenId);
                    $("#id_deta_prueba_orina").val(detaOrdenId);
                    break;
                case 'HMG':
                    $("#exmHemograma").modal('toggle');
                    $("#tituloHematologia").empty().append("Plantilla de Hematología: " + nombrePrueba);
                    $("#id_exm_hemograma").val(examenId);
                    $("#id_deta_prueba_hemograma").val(detaOrdenId);
                    break;
                case 'QMV':
                    $("#exmQuimica").modal('toggle');
                    $("#tituloQuimica").empty().append("Plantilla de Pruebas Químicas / Varias: " + nombrePrueba);
                    $("#id_exm_quimica").val(examenId);
                    $("#id_deta_prueba_quimica").val(detaOrdenId);
                    $("#prueba").val(nombrePrueba);
                    $("#unidadMedida").val(unidadMed);
                    $("#rangoRef").val(rangoRef);
                    break;
                case 'GEN':
                    $("#exmGenerico").modal('toggle');
                    $("#tituloGenerico").empty().append("Plantilla de Pruebas Genéricas: " + nombrePrueba);
                    $("#id_exm_generico").val(examenId);
                    $("#id_deta_prueba_generico").val(detaOrdenId);
                    $("#prueba_generico").val(nombrePrueba);
                    break;
            }
        }
    </script>
@stop
