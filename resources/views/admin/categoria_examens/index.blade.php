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
            <a class="btn btn-primary" href="{{route('admin.categoria_examens.create')}}"><i class="fa fa-user-plus fa-fw"></i> NUEVA CATEGORÍA</a>
            <button class="btn btn-dark" onclick="eliminarRegistro()">PRUEBA AJAX</button>
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
                        <td width="10px"><a class="btn btn-success btn-sm" href="{{route('admin.categoria_examens.edit', $categoria_examen)}}">EDITAR</a></td>
                        <td width="10px">
                            <form action="{{route('admin.categoria_examens.destroy', $categoria_examen)}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                            </form>
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
        $('#categoriaExamensTable').DataTable();

        function eliminarRegistro(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:'ajaxDelete',
                data:{'id' : id},
                type:'post',
                success: function (response) {
                    alert(response);
                },
                statusCode: {
                    404: function() {
                        alert('web not found');
                    }
                },
                error:function(x,xs,xt){
                    //nos dara el error si es que hay alguno
                    window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }

    </script>
@stop
