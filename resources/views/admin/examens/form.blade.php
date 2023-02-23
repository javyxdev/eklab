<div class="form-group">
    {!! Form::label('categoria_examen_id','NOMBRE CATEGORÍA / AREA:') !!}
    {!! Form::select('categoria_examen_id', $cat_examens, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Categoría / Area']) !!}
    @error('categoria_examen_id')
        <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('descripcion','NOMBRE DEL EXAMEN:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del examen']) !!}
    @error('descripcion')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('precio','PRECIO $:') !!}
    {!! Form::number('precio', null, ['step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Ingrese el precio del nuevo examen']) !!}
    @error('precio')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('plantilla','PLANTILLA DEL EXAMEN:') !!}
    {!! Form::select('plantilla', $plantillas, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una Plantilla']) !!}
    @error('plantilla')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('unidad_med','UNIDAD DE MEDIDA:') !!}
    {!! Form::text('unidad_med', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la unidad de medida']) !!}
    @error('unidad_med')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('rango_ref','RANGO DE REFERENCIA:') !!}
    {!! Form::text('rango_ref', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el rango de referencia']) !!}
    @error('rango_ref')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
