<div class="form-group">
    <label for="descripcion">NOMBRE CATEGORÍA / AREA:</label>
    <input
        type="text"
        name="descripcion"
        id="descripcion"
        class="form-control"
        placeholder="Ingrese el nombre de la categoría"
        value="{{ old('descripcion', $categoria_examen->descripcion ?? '') }}"
    >
    @error('descripcion')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
