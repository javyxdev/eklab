<div class="form-group">
    <label for="categoria_examen_id">NOMBRE CATEGORÍA / AREA:</label>
    <select name="categoria_examen_id" id="categoria_examen_id" class="form-control">
        <option value="">Seleccione una Categoría / Area</option>
        @foreach($cat_examens as $id => $nombre)
            <option value="{{ $id }}" {{ old('categoria_examen_id', $examen->categoria_examen_id ?? '') == $id ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
    @error('categoria_examen_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="descripcion">NOMBRE DEL EXAMEN:</label>
    <input type="text" name="descripcion" id="descripcion" class="form-control"
           placeholder="Ingrese el nombre del examen"
           value="{{ old('descripcion', $examen->descripcion ?? '') }}">
    @error('descripcion')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="precio">PRECIO $:</label>
    <input type="number" step="0.01" name="precio" id="precio" class="form-control"
           placeholder="Ingrese el precio del nuevo examen"
           value="{{ old('precio', $examen->precio ?? '') }}">
    @error('precio')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="plantilla">PLANTILLA DEL EXAMEN:</label>
    <select name="plantilla" id="plantilla" class="form-control">
        <option value="">Seleccione una Plantilla</option>
        @foreach($plantillas as $key => $nombre)
            <option value="{{ $key }}" {{ old('plantilla', $examen->plantilla ?? '') == $key ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
    @error('plantilla')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="unidad_med">UNIDAD DE MEDIDA:</label>
    <input type="text" name="unidad_med" id="unidad_med" class="form-control"
           placeholder="Ingrese la unidad de medida"
           value="{{ old('unidad_med', $examen->unidad_med ?? '') }}">
    @error('unidad_med')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="rango_ref">RANGO DE REFERENCIA:</label>
    <input type="text" name="rango_ref" id="rango_ref" class="form-control"
           placeholder="Ingrese el rango de referencia"
           value="{{ old('rango_ref', $examen->rango_ref ?? '') }}">
    @error('rango_ref')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
