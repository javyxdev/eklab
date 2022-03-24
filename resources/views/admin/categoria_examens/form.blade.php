<div class="form-group">
    {!! Form::label('descripcion','NOMBRE CATEGORÍA / AREA:') !!}
    {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoría']) !!}
    @error('descripcion')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>
