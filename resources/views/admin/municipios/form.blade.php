<div class="form-group">
    <label for="departamento_id">DEPARTAMENTO:</label>
    <select name="departamento_id" id="departamento_id" class="form-control">
        <option value="" disabled {{ old('departamento_id', $municipio->departamento_id ?? '') == '' ? 'selected' : '' }}>
            Seleccione un Departamento
        </option>
        @foreach($departamentos as $id => $descripcion)
            <option value="{{ $id }}" {{ old('departamento_id', $municipio->departamento_id ?? '') == $id ? 'selected' : '' }}>
                {{ $descripcion }}
            </option>
        @endforeach
    </select>
    @error('departamento_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="descripcion">NOMBRE:</label>
    <input
        type="text"
        name="descripcion"
        id="descripcion"
        class="form-control"
        placeholder="Ingrese el nombre del municipio"
        value="{{ old('descripcion', $municipio->descripcion ?? '') }}"
    >
    @error('descripcion')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
