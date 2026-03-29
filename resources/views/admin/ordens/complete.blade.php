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

                <div class="form-group col-12 col-md-4">
                    <label>PACIENTE:</label>
                    <input type="text" class="form-control" id="paciente"
                           value="{{ $orden->paciente->apellido }}, {{ $orden->paciente->nombre }}" disabled>
                </div>
                <div class="form-group col-6 col-md-2 col-lg-1">
                    <label>GÉNERO:</label>
                    <input type="text" class="form-control" id="genero" value="{{ $orden->paciente->genero }}" disabled>
                </div>
                <div class="form-group col-6 col-md-3 col-lg-2">
                    <label>FECHA NACIMIENTO:</label>
                    <input type="text" class="form-control" id="fechaNac" value="{{ $orden->paciente->fecha_nacimiento }}"
                           disabled>
                </div>
                <div class="form-group col-6 col-md-2 col-lg-1">
                    <label>EDAD:</label>
                    <input type="text" class="form-control" id="edad" disabled>
                </div>
                <div class="form-group col-6 col-md-3 col-lg-2">
                    <label>DUI:</label>
                    <input type="text" class="form-control" id="dui" value="{{ $orden->paciente->dui }}" disabled>
                </div>
                <div class="form-group col-12 col-md-3 col-lg-2">
                    <label>TELÉFONO:</label>
                    <input type="text" class="form-control" id="telefono" value="{{ $orden->paciente->telefono }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6 col-md-3 col-lg-2">
                    <label>ESTADO:</label>
                    <input type="text" class="form-control" id="estado" value="{{ $orden->estado }}" disabled>
                </div>
                <div class="form-group col-6 col-md-3 col-lg-2">
                    <label>FECHA DE LA ORDEN:</label>
                    <input type="text" class="form-control" id="fechaOrden" value="{{ $orden->created_at }}" disabled>
                </div>
                <div class="form-group col-6 col-md-3 col-lg-2">
                    <label>TOTAL DE ORDEN:</label>
                    <input type="text" class="form-control" id="total" value="${{ $orden->total }}" disabled>
                </div>
                <div class="form-group col-12 col-md-6 col-lg-4">
                    <label>ACCIONES:</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary mb-2 mr-2" onclick="printOrder()">
                            <i class="fa fa-print fa-fw"></i> IMPRIMIR HOJA
                        </button>
                        @if($orden->estado == 'EN PROCESO')
                            <a href="{{ route('admin.ordens.modificarOrden', $orden->id) }}" class="btn btn-success mb-2">
                                <i class="fa fa-edit fa-fw"></i> EDITAR ORDEN
                            </a>
                        @endif
                    </div>
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
                            <th>ACCION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detalleOrdens as $detaOrden)
                            <tr>
                                <td>{{ $detaOrden->id }}</td>
                                <td>{{ $detaOrden->examen->descripcion }}</td>
                                <td>{{ $detaOrden->examen->plantilla }}</td>
                                <td>
                                    @if($orden->estado == 'EN PROCESO')
                                        @if($detaOrden->completado == 0)
                                            <button class="btn btn-dark btn-sm" onclick="desliegaPlantilla({{ $detaOrden->id }}, {{ $detaOrden->examen->id }}, '{{ $detaOrden->examen->plantilla }}', '{{ $detaOrden->examen->descripcion }}', '{{ $detaOrden->examen->unidad_med }}', '{{ $detaOrden->examen->rango_ref }}')">
                                                <i class="fa fa-check-circle fa-sm fa-fw"></i>
                                                COMPLETAR
                                            </button>
                                        @else
                                            <button class="btn btn-success btn-sm" onclick="desliegaPlantilla({{ $detaOrden->id }}, {{ $detaOrden->examen->id }}, '{{ $detaOrden->examen->plantilla }}', '{{ $detaOrden->examen->descripcion }}', '{{ $detaOrden->examen->unidad_med }}', '{{ $detaOrden->examen->rango_ref }}')">
                                                <i class="fa fa-edit fa-sm fa-fw"></i>
                                                EDITAR
                                            </button>
                                        @endif
                                    @else
                                        <button class="btn btn-info btn-sm" onclick="desliegaPlantilla({{ $detaOrden->id }}, {{ $detaOrden->examen->id }}, '{{ $detaOrden->examen->plantilla }}', '{{ $detaOrden->examen->descripcion }}', '{{ $detaOrden->examen->unidad_med }}', '{{ $detaOrden->examen->rango_ref }}')">
                                            <i class="fa fa-search fa-sm fa-fw"></i>
                                            CONSULTAR
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($orden->estado == 'EN PROCESO')
                <div class="col-12 text-center mt-3">
                    <button id="btnProcesar" class="btn btn-success" onclick="finalizarOrden()"><i
                            class="fa fa-check-circle fa-fw"></i> FINALIZAR ORDEN</button>
                </div>
            @endif

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
            } else if ('{{ $orden->estado }}' === 'COMPLETADO') {
                Swal.fire('ORDEN COMPLETADO', 'Esta orden ha sido completado, solo puede consultarla.', 'warning');
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
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Finalizar Orden',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value) {
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
                                type: responseType,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            }).then(() => {
                                if (responseParts[0] === "0") {
                                    window.open("/admin/ordens/" + id + "/imprimirResultados", "_blank");
                                }
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
            let id = $("#orden_id").val();
            window.open("/admin/ordens/" + id + "/imprimirHojaTrabajo", "_blank");
        }

        function desliegaPlantilla(detaOrdenId, examenId, plantilla, nombrePrueba, unidadMed, rangoRef) {
            // Limpiar formularios antes de llenar
            $('form').trigger("reset");
            
            // Si el estado no es EN PROCESO, deshabilitar inputs y ocultar botones de guardar
            if ('{{ $orden->estado }}' !== 'EN PROCESO') {
                $('form input, form select, form textarea').prop('disabled', true);
                $('.modal-footer .btn-success').hide();
            } else {
                $('form input, form select, form textarea').prop('disabled', false);
                $('.modal-footer .btn-success').show();
                // Mantener IDs bloqueados
                $('#id_exm_heces, #id_deta_prueba_heces, #id_exm_orina, #id_deta_prueba_orina, #id_exm_hemograma, #id_deta_prueba_hemograma, #id_exm_quimica, #id_deta_prueba_quimica, #id_exm_generico, #id_deta_prueba_generico, #qmv_prueba, #unidadMedida, #rangoRef, #prueba_generico').prop('readonly', true);
            }

            $.ajax({
                url: '{{ url("admin/ordens/getTemplateData") }}/' + plantilla + '/' + detaOrdenId,
                type: 'get',
                success: function(data) {
                    switch (plantilla) {
                        case 'EGH':
                            $("#exmHeces").modal('toggle');
                            $("#tituloCoprologia").empty().append("Plantilla de Coprología: " + nombrePrueba);
                            $("#id_exm_heces").val(examenId);
                            $("#id_deta_prueba_heces").val(detaOrdenId);
                            if (data) {
                                $("#heces_color").val(data.color);
                                $("#heces_consistencia").val(data.consistencia);
                                $("#heces_mucus").val(data.mucus);
                                $("#heces_restos_alim_mac").val(data.restos_alim_mac);
                                $("#heces_sangre").val(data.sangre);
                                $("#heces_leucocitos").val(data.leucocitos);
                                $("#heces_hematies").val(data.hematies);
                                $("#heces_levadura").val(data.levadura);
                                $("#heces_restos_alim_mic").val(data.restos_alim_mic);
                                $("#heces_parasitos").val(data.parasitos);
                                $("#heces_observaciones").val(data.observaciones);
                            }
                            break;
                        case 'EGO':
                            $("#exmOrina").modal('toggle');
                            $("#tituloUroanalisis").empty().append("Plantilla de Uroanálisis: " + nombrePrueba);
                            $("#id_exm_orina").val(examenId);
                            $("#id_deta_prueba_orina").val(detaOrdenId);
                            if (data) {
                                $("#orina_color").val(data.color);
                                $("#orina_aspecto").val(data.aspecto);
                                $("#orina_densidad").val(data.densidad);
                                $("#orina_ph").val(data.ph);
                                $("#orina_proteinas").val(data.proteinas);
                                $("#orina_glucosa").val(data.glucosa);
                                $("#orina_sangre_oculta").val(data.sangre_oculta);
                                $("#orina_cuerpos_cetonicos").val(data.cuerpos_cetonicos);
                                $("#orina_urobilinogeno").val(data.urobilinogeno);
                                $("#orina_bilirrubina").val(data.bilirrubina);
                                $("#orina_nitritos").val(data.nitritos);
                                $("#orina_hemoglobina").val(data.hemoglobina);
                                $("#orina_esterasa_leucocitaria").val(data.esterasa_leucocitaria);
                                $("#orina_hematies").val(data.hematies);
                                $("#orina_leucocitos").val(data.leucocitos);
                                $("#orina_celulas_epiteliales").val(data.celulas_epiteliales);
                                $("#orina_filamentos_mucoides").val(data.filamentos_mucoides);
                                $("#orina_bacterias").val(data.bacterias);
                                $("#orina_cil_granulosos").val(data.cil_granulosos);
                                $("#orina_cil_leucocitario").val(data.cil_leucocitario);
                                $("#orina_cil_hematicos").val(data.cil_hematicos);
                                $("#orina_cil_hialianos").val(data.cil_hialianos);
                                $("#orina_cil_cereos").val(data.cil_cereos);
                                $("#orina_observaciones").val(data.observaciones);
                            }
                            break;
                        case 'HMG':
                            $("#exmHemograma").modal('toggle');
                            $("#tituloHematologia").empty().append("Plantilla de Hematología: " + nombrePrueba);
                            $("#id_exm_hemograma").val(examenId);
                            $("#id_deta_prueba_hemograma").val(detaOrdenId);
                            if (data) {
                                $("#hmg_globulos_rojos").val(data.globulos_rojos);
                                $("#hmg_hemoglobina").val(data.hemoglobina);
                                $("#hmg_hematocrito").val(data.hematocrito);
                                $("#hmg_vcm").val(data.vcm);
                                $("#hmg_hcm").val(data.hcm);
                                $("#hmg_chcm").val(data.chcm);
                                $("#hmg_leucocitos").val(data.leucocitos);
                                $("#hmg_neutrofilos_segmentados").val(data.neutrofilos_segmentados);
                                $("#hmg_neutrofilos_en_banda").val(data.neutrofilos_en_banda);
                                $("#hmg_linfocitos").val(data.linfocitos);
                                $("#hmg_monocitos").val(data.monocitos);
                                $("#hmg_eosinofilos").val(data.eosinofilos);
                                $("#hmg_basofilos").val(data.basofilos);
                                $("#hmg_recuento_plaquetas").val(data.recuento_plaquetas);
                                $("#hmg_observaciones").val(data.observaciones);
                            }
                            break;
                        case 'QMV':
                            $("#exmQuimica").modal('toggle');
                            $("#tituloQuimica").empty().append("Plantilla de Pruebas Químicas / Varias: " + nombrePrueba);
                            $("#id_exm_quimica").val(examenId);
                            $("#id_deta_prueba_quimica").val(detaOrdenId);
                            $("#qmv_prueba").val(nombrePrueba);
                            $("#unidadMedida").val(unidadMed);
                            $("#rangoRef").val(rangoRef);
                            if (data) {
                                $("#qmv_resultado").val(data.resultado);
                                $("#qmv_observaciones").val(data.observaciones);
                            }
                            break;
                        case 'GEN':
                            $("#exmGenerico").modal('toggle');
                            $("#tituloGenerico").empty().append("Plantilla de Pruebas Genéricas: " + nombrePrueba);
                            $("#id_exm_generico").val(examenId);
                            $("#id_deta_prueba_generico").val(detaOrdenId);
                            $("#prueba_generico").val(nombrePrueba);
                            if (data) {
                                for (let i = 1; i <= 5; i++) {
                                    $("#gen_param_" + i).val(data["param_" + i]);
                                    $("#gen_resultado_" + i).val(data["resultado_" + i]);
                                    $("#gen_unidad_med_" + i).val(data["unidad_med_" + i]);
                                    $("#gen_rango_ref_" + i).val(data["rango_ref_" + i]);
                                }
                                $("#gen_observaciones").val(data.observaciones);
                            }
                            break;
                    }
                },
                error: function (x, e, thrownError) {
                    Swal.fire("Error", "No se pudieron obtener los resultados previos.", "error");
                }
            });
        }
    </script>
@stop
