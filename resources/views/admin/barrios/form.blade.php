<div class="form-group">
    <label for="municipio_id">MUNICIPIO:</label>
    <select name="municipio_id" id="municipio_id" class="form-control">
        <option value="">Seleccione un Municipio</option>
        {{-- Las opciones serán llenadas por AJAX --}}
    </select>
    @error('municipio_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="descripcion">NOMBRE CATEGORÍA / AREA:</label>
    <input type="text" name="descripcion" id="descripcion" class="form-control"
           value="{{ old('descripcion', $barrio->descripcion ?? '') }}"
           placeholder="Ingrese el nombre del Barrio/Colonia">
    @error('descripcion')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
