@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-clipboard-list"></i> Monitor de Ordenes de Examenes</h1>
    <p>Listado global de ordenes de examenes.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-warning">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{route('admin.ordens.create')}}"><i class="fa fa-plus-circle fa-fw"></i> GENERAR NUEVA ORDEN</a>
        </div>
        <div class="card-body">
            <table id="ordensTable" class="table table-striped">
                <thead>
                <tr>
                    <th># DIARIO</th>
                    <th>NUM. ORDEN</th>
                    <th>NOMBRE PACIENTE</th>
                    <th>FECHA ORDEN</th>
                    <th>ESTADO ORDEN</th>
                    <th>TOTAL</th>
                    <th>CONSULTAR</th>
                    <th>ANULAR</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ordens as $orden)
                    <tr>
                        <td></td>
                        <td>{{$orden->id}}</td>
                        <td>{{$orden->paciente->nombre}}, {{$orden->paciente->apellido}}</td>
                        <td>{{$orden->created_at}}</td>
                        <td>{{$orden->estado}}</td>
                        <td>${{$orden->total}}</td>
                        <td width="75px">
                            <a class="btn btn-dark btn-sm" href="{{route('admin.ordens.edit', $orden)}}">
                                <i class="fa fa-check-circle fa-sm fa-fw"></i>
                                <small>COMPLETAR</small>
                            </a>
                        </td>
                        <td width="95px">
                            <button class="btn btn-danger btn-sm" onclick="anularOrden({{$orden->id}})">
                                <i class="fa fa-window-close fa-sm fa-fw"></i>
                                <small>ANULAR</small>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="#">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var t = $('#ordensTable').DataTable();

            t.on( 'order.dt search.dt', function () {
                let i = 1;
                t.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
                    this.data(i++);
                } );
            } ).draw();
        });

        function anularOrden(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: '¿Esta seguro que desea anular el registro?',
                text: "¡No es posible revertir esta operación!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Anular registro!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value === true) {
                    $.ajax({
                        url:'anularOrden/'+id,
                        type:'post',
                        success: function (response) {
                            let responseParts = response.split("|");
                            let responseTittle = responseParts[1];
                            let responseMsg = responseParts[2];
                            let responseType;
                            if(responseParts[0] === "0"){
                                responseType = 'success';
                            }else if(responseParts[0] === "1"){
                                responseType = 'error';
                            }
                            swal.fire({
                                title: responseTittle,
                                text: responseMsg,
                                type: responseType,
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK',
                            }).then((result) => { location.reload(); });
                        },
                        error: function (x, e,  thrownError) {
                            swal.fire("Error", x.responseText, "error");
                        }
                    });
                }
            })
        }

    </script>
@stop


