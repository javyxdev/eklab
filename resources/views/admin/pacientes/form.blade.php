<div class="form-group">
    {!! Form::label('name','NOMBRE:') !!}
    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los nombres del Paciente']) !!}
    @error('nombre')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('apellido','APELLIDO:') !!}
    {!! Form::text('apellido', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los apellidos del Paciente']) !!}
    @error('apellido')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('genero','GENERO:') !!}
    {!! Form::select('genero', $genero, null, ['class' => 'form-control col-2', 'placeholder' => 'Seleccione Género']) !!}
    @error('genero')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    <div class="row">
        <div class="col-2">
            {!! Form::label('fecha_nacimiento','FECHA NACIMIENTO:') !!}
            {!! Form::date('fecha_nacimiento', null, ['class' => 'form-control']) !!}
            @error('fecha_nacimiento')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="edad">EDAD:</label>
            <input type="text" id="edad" class="form-control" disabled>
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('dui','DUI (Dejar vacío en caso de ser menor de edad):') !!}
    {!! Form::text('dui', null, ['class' => 'form-control col-2', 'placeholder' => '00000000-0', 'pattern' => '[0-9]+' ,'maxlength' => '9']) !!}
    @error('dui')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('telefono','TELEFONO:') !!}
    {!! Form::text('telefono', null, ['class' => 'form-control col-4', 'placeholder' => 'Ingrese un numero de telefono válido']) !!}
    @error('telefono')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('email','CORREO ELECTRÓNICO:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'name@correo.com']) !!}
</div>

<div class="form-group">
    {!! Form::label('departamento_id','DEPARTAMENTO:') !!}
    {!! Form::select('departamento_id', $departamentos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Departamento']) !!}
    @error('departamento_id')
    <small class="text-danger">{{$message}}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('municipio_id','MUNICIPIO:') !!}
    {!! Form::select('municipio_id',$municipios, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Municipio']) !!}
</div>

<div class="form-group">
    {!! Form::label('barrio_id','BARRIO / COLONIA:') !!}
    {!! Form::select('barrio_id', $barrios, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Barrio']) !!}
</div>
