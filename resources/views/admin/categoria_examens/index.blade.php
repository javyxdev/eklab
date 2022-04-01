@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-vials"></i> Categorias de Examen</h1>
    <p>Listado de clasificaciones de examenes disponibles.</p>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-warning">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary" href="{{route('admin.categoria_examens.create')}}"><i class="fa fa-vial fa-fw"></i> NUEVA CATEGORÍA</a>
        </div>
        <div class="card-body">
            <table id="categoriaExamensTable" class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE DE CATEGORIA</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria_examen)
                    <tr>
                        <td>{{$categoria_examen->id}}</td>
                        <td>{{$categoria_examen->descripcion}}</td>
                        <td width="75px">
                            <a class="btn btn-success btn-sm" href="{{route('admin.categoria_examens.edit', $categoria_examen)}}">
                                <i class="fa fa-pen fa-sm fa-fw"></i>
                                <small>EDITAR</small>
                            </a>
                        </td>
                        <td width="90px">
                            <button class="btn btn-danger btn-sm" onclick="eliminarRegistro({{$categoria_examen->id}})">
                                <i class="fa fa-trash-alt fa-sm fa-fw"></i>
                                <small>ELIMINAR</small>
                            </button>
                        </td>
                        <!--<td width="10px">
                            <form action="{{route('admin.categoria_examens.destroy', $categoria_examen)}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                            </form>
                        </td>-->
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
        $('#categoriaExamensTable').DataTable();

        function eliminarRegistro(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: '¿Esta seguro que desea eliminar el registro?',
                text: "¡No es posible revertir esta operación!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar registro!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.value === true) {
                    $.ajax({
                        url:'categoriaExamensDelete/'+id,
                        type:'post',
                        success: function (response) {
                            swal.fire({
                                title: '¡Eliminado!',
                                text: response,
                                type: 'success',
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
