<div class="form-group">
    <label for="nombre">NOMBRE:</label>
    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese los nombres del Paciente"
           value="{{ old('nombre', $paciente->nombre ?? '') }}">
    @error('nombre')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="apellido">APELLIDO:</label>
    <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese los apellidos del Paciente"
           value="{{ old('apellido', $paciente->apellido ?? '') }}">
    @error('apellido')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="genero">GÉNERO:</label>
    <select name="genero" id="genero" class="form-control col-2">
        <option value="">Seleccione Género</option>
        @foreach($genero as $key => $value)
            <option value="{{ $key }}"
                {{ old('genero', $paciente->genero ?? '') == $key ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    @error('genero')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <div class="row">
        <div class="col-2">
            <label for="fecha_nacimiento">FECHA NACIMIENTO:</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                   value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento ?? '') }}">
            @error('fecha_nacimiento')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="edad">EDAD:</label>
            <input type="text" name="edad" id="edad" class="form-control" value="{{ old('edad', $paciente->edad ?? '') }}" disabled>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="dui">DUI (Dejar vacío en caso de ser menor de edad):</label>
    <div class="input-group col-4 p-0">
        <input type="text" name="dui" id="dui" class="form-control" placeholder="00000000-0"
               pattern="[0-9]+" maxlength="9" value="{{ old('dui', $paciente->dui ?? '') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <input type="checkbox" id="sin_dui" name="sin_dui" {{ old('sin_dui') ? 'checked' : '' }}>
                <label for="sin_dui" class="mb-0 ml-1">Sin DUI / Ingreso manual</label>
            </div>
        </div>
    </div>
    @error('dui')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="telefono">TELÉFONO:</label>
    <input type="text" name="telefono" id="telefono" class="form-control col-4"
           placeholder="Ingrese un número de teléfono válido"
           value="{{ old('telefono', $paciente->telefono ?? '') }}">
    @error('telefono')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="email">CORREO ELECTRÓNICO:</label>
    <input type="email" name="email" id="email" class="form-control"
           placeholder="name@correo.com" value="{{ old('email', $paciente->email ?? '') }}">
</div>

<div class="form-group">
    <label for="departamento_id">DEPARTAMENTO:</label>
    <select name="departamento_id" id="departamento_id" class="form-control">
        <option value="">Seleccione un Departamento</option>
        @foreach($departamentos as $id => $desc)
            <option value="{{ $id }}"
                {{ old('departamento_id', $paciente->departamento_id ?? '') == $id ? 'selected' : '' }}>
                {{ $desc }}
            </option>
        @endforeach
    </select>
    @error('departamento_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="municipio_id">MUNICIPIO:</label>
    <select name="municipio_id" id="municipio_id" class="form-control">
        <option value="">Seleccione un Municipio</option>
        @foreach($municipios as $id => $desc)
            <option value="{{ $id }}"
                {{ old('municipio_id', $paciente->municipio_id ?? '') == $id ? 'selected' : '' }}>
                {{ $desc }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="barrio_id">BARRIO / COLONIA:</label>
    <select name="barrio_id" id="barrio_id" class="form-control">
        <option value="">Seleccione un Barrio</option>
        @foreach($barrios as $id => $desc)
            <option value="{{ $id }}"
                {{ old('barrio_id', $paciente->barrio_id ?? '') == $id ? 'selected' : '' }}>
                {{ $desc }}
            </option>
        @endforeach
    </select>
</div>
