@extends('adminlte::page')

@section('title', 'Facturación - EK Diagnóstico')

@section('css')
    <style>
        /* Reducción del font general de la tabla en un 20% */
        #facturasTable {
            font-size: 0.8rem !important;
        }
        #facturasTable td, #facturasTable th {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }

        /* Corrección de visibilidad Select2 dentro de Modales */
        .select2-container {
            width: 100% !important;
        }
        
        /* Estilo base para simular Bootstrap 4 */
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da !important;
            min-height: calc(2.25rem + 2px) !important;
            border-radius: .25rem !important;
        }

        /* Estilos Select2 Institucionales */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #101931 !important;
            border: 1px solid #101931 !important;
            color: #fff !important;
            padding: 0 12px !important;
            margin-top: 0.35rem !important;
            font-size: 0.9rem !important;
            border-radius: 4px !important;
        }
        
        /* La "X" de eliminar mejorada */
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ff4d4d !important;
            float: right !important;
            margin-left: 10px !important;
            margin-right: -4px !important;
            font-weight: bold !important;
            font-size: 1.2rem !important;
            opacity: 1 !important;
            cursor: pointer !important;
        }
        
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ffffff !important;
            background-color: #ff0000 !important;
        }

        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            border: 1px solid #ced4da !important;
        }

        .badge {
            font-size: 0.75rem !important;
            display: inline-block;
            min-width: 85px;
        }

        /* Badge específico para órdenes en la tabla */
        .badge-orden {
            min-width: auto !important;
            font-size: 0.65rem !important;
            padding: 0.2rem 0.5rem !important;
            background-color: #101931 !important;
            color: white !important;
        }
    </style>
@stop

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1><i class="fas fa-file-invoice-dollar"></i> Gestión de Facturación</h1>
            <p>Listado general de facturas emitidas por el laboratorio.</p>
        </div>
    </div>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fas fa-check-circle"></i> {{session('info')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateFactura">
                <i class="fa fa-plus-circle fa-fw"></i> NUEVA FACTURA
            </button>
        </div>
        <div class="card-body">
            <table id="facturasTable" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Órdenes</th>
                        <th>Teléfono</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->nombre_cliente }}</td>
                            <td>
                                @foreach($factura->ordens as $orden)
                                    <span class="badge badge-orden">#{{ str_pad($orden->id, 4, '0', STR_PAD_LEFT) }}</span>
                                @endforeach
                            </td>
                            <td>{{ $factura->telefono ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</td>
                            <td>${{ number_format($factura->total, 2) }}</td>
                            <td class="text-center">
                                @if($factura->estado == 'EMITIDA')
                                    <span class="badge badge-success">EMITIDA</span>
                                @else
                                    <span class="badge badge-danger">ANULADO</span>
                                @endif
                            </td>
                            <td width="120px" class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.facturas.imprimir', $factura->id) }}" target="_blank" class="btn btn-sm btn-info" title="Imprimir">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    @if($factura->estado == 'EMITIDA')
                                        <button class="btn btn-sm btn-warning btn-edit" data-id="{{ $factura->id }}" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger btn-anular" data-id="{{ $factura->id }}" title="Anular">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear Factura -->
    <div class="modal fade" id="modalCreateFactura" tabindex="-1" role="dialog" aria-labelledby="modalCreateFacturaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-institutional">
                    <h5 class="modal-title text-white" id="modalCreateFacturaLabel"><i class="fas fa-file-invoice-dollar"></i> Nueva Factura</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.facturas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nombre_cliente">Nombre del Cliente <span class="text-danger">*</span></label>
                                    <input type="text" name="nombre_cliente" class="form-control" placeholder="Ej: Juan Pérez" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="7777-7777">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha">Fecha de Emisión <span class="text-danger">*</span></label>
                                    <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="orden_ids">Seleccionar Órdenes <span class="text-danger">*</span></label>
                            <select name="orden_ids[]" id="orden_ids_create" class="form-control select2-ajax" multiple="multiple" data-placeholder="Escriba # de orden o nombre del paciente..." style="width: 100%" required>
                            </select>
                            <small class="form-text text-muted text-italic">Búsqueda en tiempo real por número de orden o nombre del paciente.</small>
                        </div>

                        <div class="alert alert-info mt-4 py-2">
                            <h4 class="mb-0 text-right">TOTAL A PAGAR: <span id="labelTotalCreate">$0.00</span></h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary bg-institutional">
                            <i class="fas fa-save"></i> GENERAR FACTURA
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Factura -->
    <div class="modal fade" id="modalEditFactura" tabindex="-1" role="dialog" aria-labelledby="modalEditFacturaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-institutional">
                    <h5 class="modal-title text-white" id="modalEditFacturaLabel"><i class="fas fa-edit"></i> Editar Factura #<span id="edit_id_label"></span></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formEditFactura" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="edit_nombre_cliente">Nombre del Cliente <span class="text-danger">*</span></label>
                                    <input type="text" name="nombre_cliente" id="edit_nombre_cliente" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="edit_telefono">Teléfono</label>
                                    <input type="text" name="telefono" id="edit_telefono" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit_fecha">Fecha de Emisión <span class="text-danger">*</span></label>
                                    <input type="date" name="fecha" id="edit_fecha" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="orden_ids_edit">Órdenes Facturadas <span class="text-danger">*</span></label>
                            <select name="orden_ids[]" id="orden_ids_edit" class="form-control select2-ajax" multiple="multiple" data-placeholder="Añadir o quitar órdenes..." style="width: 100%" required>
                            </select>
                            <small class="form-text text-muted">Puede añadir nuevas órdenes o quitar las actuales. El total se recalculará automáticamente.</small>
                        </div>
                        <div class="alert alert-info mt-4 py-2 text-right">
                            <h4 class="mb-0">TOTAL FACTURADO: <span id="labelTotalEdit">$0.00</span></h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary bg-institutional">
                            <i class="fas fa-save"></i> GUARDAR CAMBIOS
                        </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            // Función genérica para inicializar Select2 Ajax
            function initSelect2Ajax(selector, modalParent) {
                if ($(selector).hasClass("select2-hidden-accessible")) {
                    $(selector).select2('destroy');
                }

                $(selector).select2({
                    dropdownParent: $(modalParent),
                    ajax: {
                        url: "{{ url('admin/facturas/getOrdensAjax') }}",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return { q: params.term };
                        },
                        processResults: function (data) {
                            return { results: data };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,
                    width: '100%',
                    language: {
                        inputTooShort: function() { return "Por favor ingrese 1 o más caracteres"; },
                        searching: function() { return "Buscando..."; },
                        noResults: function() { return "No se encontraron resultados"; }
                    }
                });
            }

            // Inicializar al abrir modales
            $('#modalCreateFactura').on('shown.bs.modal', function () {
                initSelect2Ajax('#orden_ids_create', '#modalCreateFactura');
                $('#labelTotalCreate').text('$0.00');
            });

            // Datatable
            $("#facturasTable").DataTable({
                "responsive": true, "autoWidth": false, "order": [[0, "desc"]],
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "oPaginate": { "sFirst": "Primero", "sLast": "Último", "sNext": "Siguiente", "sPrevious": "Anterior" }
                }
            });

            // Función unificada para actualizar etiquetas de total
            function updateTotalLabel(selectId, labelId) {
                let total = 0;
                if ($(selectId).hasClass("select2-hidden-accessible")) {
                    let selectedData = $(selectId).select2('data');
                    selectedData.forEach(function(item) {
                        let itemTotal = 0;
                        if (item.total !== undefined) {
                            itemTotal = item.total;
                        } else if (item.element !== undefined) {
                            itemTotal = $(item.element).data('total');
                        }
                        total += parseFloat(itemTotal || 0);
                    });
                }
                $(labelId).text('$' + total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2}));
            }

            // Eventos de cambio en los Select2
            $(document).on('change', '#orden_ids_create', function() {
                updateTotalLabel('#orden_ids_create', '#labelTotalCreate');
            });

            $(document).on('change', '#orden_ids_edit', function() {
                updateTotalLabel('#orden_ids_edit', '#labelTotalEdit');
            });

            // Editar Factura (Cargar datos)
            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');
                $.get("{{ url('admin/facturas') }}/" + id, function(response) {
                    let data = response.factura;
                    let formatted = response.formattedOrdens;

                    $('#edit_id_label').text(data.id);
                    $('#edit_nombre_cliente').val(data.nombre_cliente);
                    $('#edit_telefono').val(data.telefono);
                    $('#edit_fecha').val(data.fecha);
                    
                    $('#formEditFactura').attr('action', "{{ url('admin/facturas') }}/" + id);
                    
                    // Inicializar Select2 antes de poblar
                    initSelect2Ajax('#orden_ids_edit', '#modalEditFactura');

                    let selectEdit = $('#orden_ids_edit');
                    selectEdit.empty();
                    formatted.forEach(function(o) {
                        let option = new Option(o.text, o.id, true, true);
                        $(option).attr('data-total', o.total); // Importante para updateTotalLabel
                        selectEdit.append(option);
                    });
                    
                    // Sincronizar Select2 con las nuevas opciones y calcular total
                    selectEdit.trigger('change');
                    
                    $('#modalEditFactura').modal('show');
                });
            });

            // Anulación
            $(document).on('click', '.btn-anular', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: '¿Estás seguro de anular la factura?',
                    text: "¡Esta acción liberará las órdenes asociadas!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, anular',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $.post("{{ url('admin/facturas') }}/" + id + "/anular", { _token: '{{ csrf_token() }}' }, function(response) {
                            Swal.fire('Anulado', response, 'success').then(() => { location.reload(); });
                        }).fail(function() { Swal.fire('Error', 'No se pudo anular', 'error'); });
                    }
                });
            });
        });
    </script>
@stop
