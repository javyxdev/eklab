<div class="form-group">
    <div class="form-group">
        {!! Form::label('departamento_id','DEPARTAMENTO:') !!}
        {!! Form::select('departamento_id', $departamentos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Departamento']) !!}
        @error('departamento_id')
        <small class="text-danger">{{$message}}</small>
        @enderror
    </div>

    {!! Form::label('descripcion','NOMBRE:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del municipio']) !!}
    @error('descripcion')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

