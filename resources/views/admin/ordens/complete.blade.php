@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-clipboard-list"></i>&nbsp; ORDEN #: 000{{$orden->id}}</h1>
    <p>*En esta seccion se pueden completar todos los examenes de la orden.</p>
    <a href="{{route('admin.ordens.index')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i>  Regresar a listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-4">
                    <label>PACIENTE:</label>
                    <input type="text" class="form-control" id="paciente" value="{{$orden->paciente->apellido}}, {{$orden->paciente->nombre}}" disabled>
                </div>
                <div class="form-group col-1">
                    <label>GENERO:</label>
                    <input type="text" class="form-control" id="genero" value="{{$orden->paciente->genero}}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>FECHA NACIMIENTO:</label>
                    <input type="text" class="form-control" id="fechaNac" value="{{$orden->paciente->fecha_nacimiento}}" disabled>
                </div>
                <div class="form-group col-1">
                    <label>EDAD:</label>
                    <input type="text" class="form-control" id="edad" disabled>
                </div>
                <div class="form-group col-2">
                    <label>DUI:</label>
                    <input type="text" class="form-control" id="dui" value="{{$orden->paciente->dui}}" disabled>
                </div>
                <div class="form-group col-2">
                    <label>TELEFONO:</label>
                    <input type="text" class="form-control" id="telefono" value="{{$orden->paciente->telefono}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-2">
                    <label>ESTADO:</label>
                    <input type="text" class="form-control" id="total" value="{{$orden->estado}}"disabled>
                </div>
                <div class="form-group col-2">
                    <label>FECHA DE LA ORDEN:</label>
                    <input type="text" class="form-control" id="total" value="{{$orden->created_at}}"disabled>
                </div>
                <div class="form-group col-2">
                    <label>TOTAL DE ORDEN:</label>
                    <input type="text" class="form-control" id="total" value="${{$orden->total}}"disabled>
                </div>
                <div class="form-group col-2">
                    <label>ACCIONES:</label>
                    <button class="btn btn-primary" onclick="printOrder()"><i class="fa fa-print fa-fw"></i>IMPRIMIR ORDEN</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-dark">
                    Detalle de Examenes a realizar:
                </div>
                <div class="card-body">
                    <table id="detaOrdenTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>EXAMEN</th>
                            <th>COMPLETAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detalleOrdens as $detaOrden)
                            <tr>
                                <td>{{$detaOrden->id}}</td>
                                <td>{{$detaOrden->examen->descripcion}}</td>
                                <td>
                                    <a class="btn btn-dark btn-sm" href="{{route('admin.ordens.edit', $orden)}}">
                                        <i class="fa fa-check-circle fa-sm fa-fw"></i>
                                        <small>COMPLETAR</small>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="form-controlcol-12 text-center">
                <button id="btnProcesar" class="btn btn-success" onclick="finalizarOrden()"><i class="fa fa-check-circle fa-fw"></i> FINALIZAR ORDEN</button>
            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        /** Calculo automático de edad al cargar la pagina */
        $(document).ready(function(){
            var fechaNacimiento = $('#fechaNac').val();
            if(fechaNacimiento !== ''){
                var edad = getEdad(fechaNacimiento);
                $('#edad').val(edad);
            }else{
                $('#edad').val('');
            }
            /** Funcion Valida estado */
            if('{{$orden->estado}}' === 'ANULADO'){
                swal.fire('ORDEN ANULADA','No es posible completar una orden anulada','error');
                $("#btnProcesar").prop('disabled',true);
            }else if('{{$orden->estado}}' === 'COMPLETADA'){
                swal.fire('ORDEN COMPLETADA','Esta orden ha sido completada, solo puede consultarla.','warning');
                $("#btnProcesar").prop('disabled',true);
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
        /** Funcion finalizar Orden */
        function finalizarOrden(){
            swal.fire('Aviso',"Desarrollo Pendiente","warning");
        }

        function printOrder(){
            window.print();
        }
    </script>
@stop
