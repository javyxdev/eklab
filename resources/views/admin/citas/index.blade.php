@extends('adminlte::page')

@section('title', 'Citas - EK Diagnóstico')

@section('css')
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        .fc-header-toolbar {
            margin-bottom: 1em !important;
        }
        .fc-toolbar-title {
            text-transform: capitalize !important;
        }
        .fc-event {
            cursor: pointer;
        }
        .fc-daygrid-event {
            white-space: normal !important;
            align-items: normal !important;
            background-color: #101931 !important; /* Color institucional */
            border-color: #101931 !important;
            color: #ffffff !important;
            padding: 2px 5px !important;
            font-size: 0.7rem !important; /* Fuente aún más pequeña */
        }
        /* Botones del calendario con color institucional */
        .fc-button {
            background-color: #101931 !important;
            border-color: #101931 !important;
            color: #ffffff !important;
            text-transform: capitalize !important;
            opacity: 1 !important;
        }
        .fc-button:hover {
            background-color: #1d294d !important;
            border-color: #1d294d !important;
            opacity: 1 !important;
        }
        .fc-button-active {
            background-color: #1d294d !important;
            border-color: #1d294d !important;
            opacity: 1 !important;
        }
        .fc-button:disabled {
            background-color: #101931 !important;
            border-color: #101931 !important;
            opacity: 0.65 !important;
        }
        /* Estilo para encabezados de días de la semana */
        .fc-col-header-cell {
            background-color: #101931 !important;
        }
        .fc-col-header-cell-cushion {
            color: #ffffff !important;
            text-transform: capitalize;
        }
        /* Color de los números de los días */
        .fc-daygrid-day-number {
            color: #101931 !important;
            text-decoration: none !important;
        }

        /* Mejora estilo Select2 (Copiado de Ordenes) */
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

        /* Reducción de scroll del calendario */
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
@stop

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1><i class="fas fa-calendar-alt"></i> Reservación de Citas</h1>
            <p>Calendario mensual para gestión de citas del laboratorio</p>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCita">
                <i class="fa fa-plus-circle fa-fw"></i> NUEVA CITA
            </button>
        </div>
        <div class="card-body p-2">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Modal Crear Cita -->
    <div class="modal fade" id="modalCreateCita" tabindex="-1" role="dialog" aria-labelledby="modalCreateCitaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-institutional">
                    <h5 class="modal-title" id="modalCreateCitaLabel">Nueva Reservación de Cita</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formCreateCita">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="paciente_id">Paciente:</label>
                                <select name="paciente_id" id="paciente_id" class="form-control select2" style="width: 100%" required>
                                    <option value="">Seleccione un paciente</option>
                                    @foreach($pacientes as $id => $nombre)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fecha">Fecha:</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" required value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora">Hora:</label>
                                <input type="time" name="hora" id="hora" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="examen_id">Exámenes a realizar (Opcional):</label>
                                <select name="examen_id[]" id="examen_id" class="form-control select2" multiple="multiple" style="width: 100%">
                                    @foreach($examenes as $examen)
                                        <option value="{{ $examen->id }}">{{ $examen->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="observaciones">Observaciones:</label>
                                <textarea name="observaciones" id="observaciones" class="form-control" rows="3" placeholder="Notas adicionales..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary bg-institutional">Guardar Cita</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Detalle Cita -->
    <div class="modal fade" id="modalShowCita" tabindex="-1" role="dialog" aria-labelledby="modalShowCitaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-institutional">
                    <h5 class="modal-title" id="modalShowCitaLabel">Detalle de la Cita</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Paciente:</strong> <span id="show_paciente"></span></p>
                            <p><strong>Teléfono:</strong> <span id="show_telefono"></span></p>
                            <p><strong>Email:</strong> <span id="show_email"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Fecha:</strong> <span id="show_fecha"></span></p>
                            <p><strong>Hora:</strong> <span id="show_hora"></span></p>
                            <p><strong>Estado:</strong> <span id="show_status" class="badge badge-info"></span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <p><strong>Observaciones:</strong> <span id="show_observaciones"></span></p>
                        </div>
                    </div>
                    <hr>
                    <h6><strong>Exámenes:</strong></h6>
                    <ul id="show_examenes"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnConvertToOrder" class="btn btn-success">
                        <i class="fas fa-file-invoice"></i> Convertir en Orden
                    </button>
                    <button type="button" id="btnDeleteCita" class="btn btn-danger">Eliminar Cita</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/es.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2();

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 650, // Altura fija para reducir scroll
                contentHeight: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route('admin.citas.getEvents') }}',
                eventClick: function(info) {
                    showCitaDetail(info.event.id);
                }
            });
            calendar.render();

            // Guardar Cita
            $('#formCreateCita').on('submit', function(e) {
                e.preventDefault();
                let data = $(this).serialize();

                $.ajax({
                    url: '{{ route('admin.citas.store') }}',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                        $('#modalCreateCita').modal('hide');
                        $('#formCreateCita')[0].reset();
                        $('#paciente_id').val(null).trigger('change');
                        $('#examen_id').val(null).trigger('change');
                        calendar.refetchEvents();
                        Swal.fire('¡Éxito!', response, 'success');
                    },
                    error: function(x) {
                        Swal.fire('Error', 'No se pudo guardar la cita', 'error');
                    }
                });
            });

            function showCitaDetail(id) {
                $.ajax({
                    url: '{{ url("admin/citas") }}/' + id,
                    type: 'GET',
                    success: function(cita) {
                        $('#show_paciente').text(cita.paciente.nombre + ' ' + cita.paciente.apellido);
                        $('#show_telefono').text(cita.paciente.telefono || 'N/A');
                        $('#show_email').text(cita.paciente.email || 'N/A');
                        $('#show_fecha').text(cita.fecha);
                        $('#show_hora').text(cita.hora);
                        $('#show_status').text(cita.status);
                        $('#show_observaciones').text(cita.observaciones || 'Sin observaciones');
                        
                        $('#show_examenes').empty();
                        if (cita.detalles.length > 0) {
                            cita.detalles.forEach(function(d) {
                                $('#show_examenes').append('<li>' + d.examen.descripcion + '</li>');
                            });
                        } else {
                            $('#show_examenes').append('<li>Ningún examen seleccionado</li>');
                        }

                        if (cita.status === 'Atendida') {
                            $('#btnConvertToOrder').hide();
                        } else {
                            $('#btnConvertToOrder').show().off('click').on('click', function() {
                                convertToOrder(cita.id);
                            });
                        }

                        $('#btnDeleteCita').off('click').on('click', function() {
                            deleteCita(cita.id);
                        });

                        $('#modalShowCita').modal('show');
                    }
                });
            }

            function convertToOrder(id) {
                Swal.fire({
                    title: '¿Convertir cita en orden?',
                    text: "Se creará una nueva orden con los datos de esta cita.",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, convertir',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value === true) {
                        $.ajax({
                            url: '{{ url("admin/citas") }}/' + id + '/convert-to-order',
                            type: 'POST',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: response.message,
                                    type: 'success',
                                    confirmButtonText: 'Ver Orden'
                                }).then(() => {
                                    window.location.href = response.redirect_url;
                                });
                            },
                            error: function(x) {
                                Swal.fire('Error', 'No se pudo realizar la conversión: ' + (x.responseJSON ? x.responseJSON.error : x.responseText), 'error');
                            }
                        });
                    }
                });
            }

            function deleteCita(id) {
                Swal.fire({
                    title: '¿Estás seguro que desea eliminar la cita?',
                    text: "¡No es posible revertir esta operación!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value === true) {
                        $.ajax({
                            url: '{{ url("admin/citas") }}/' + id,
                            type: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(response) {
                                $('#modalShowCita').modal('hide');
                                calendar.refetchEvents();
                                Swal.fire('Eliminado', response, 'success');
                            },
                            error: function(x) {
                                Swal.fire('Error', 'No se pudo eliminar la cita: ' + x.responseText, 'error');
                            }
                        });
                    }
                });
            }
        });
    </script>
@stop
