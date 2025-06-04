@extends('adminlte::page')

@section('title', 'EK Diagnostico')

@section('content_header')
    <h1><i class="fa fa-pen-alt"></i> Editar </h1>
    <p>* Editar los datos del Barrio/Colonia.</p>
    <a href="{{ route('admin.barrios.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-arrow-left"></i> Regresar a listado
    </a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.barrios.update', $barrio) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="municipio_id">MUNICIPIO:</label>
                    <select name="municipio_id" id="municipio_id" class="form-control">
                        <option disabled selected>Seleccione un Municipio</option>
                        @foreach($municipios as $id => $descripcion)
                            <option value="{{ $id }}" {{ old('municipio_id', $barrio->municipio_id) == $id ? 'selected' : '' }}>
                                {{ $descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('municipio_id')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="descripcion">NOMBRE CATEGORÍA / AREA:</label>
                    <input type="text" name="descripcion" class="form-control"
                           value="{{ old('descripcion', $barrio->descripcion) }}"
                           placeholder="Ingrese el nombre del Barrio/Colonia">
                    @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">ACTUALIZAR REGISTRO</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    <script>
        $('#municipio_id').select2();
    </script>
@stop
