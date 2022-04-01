<div class="form-group">
    <div class="form-group">
        {!! Form::label('municipio_id','MUNICIPIO:') !!}
        {!! Form::select('municipio_id',[], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Municipio']) !!}
    </div>
    @error('municipio_id')
    <small class="text-danger">{{$message}}</small>
    @enderror

    {!! Form::label('descripcion','NOMBRE CATEGORÍA / AREA:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Barrio/Colonia']) !!}
    @error('descripcion')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
