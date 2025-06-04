<div class="modal-body">
    <form method="POST" action="{{ route('admin.exm_quimica_plantillas.store') }}">
        @csrf
        <div class="row">
            <div class="col-2">
                <label for="id_exm_quimica">ID EXAMEN</label>
                <input type="text" id="id_exm_quimica" name="examen_id" class="form-control" readonly>
            </div>
            <div class="col-2">
                <label for="id_deta_prueba_quimica">No. PRUEBA</label>
                <input type="text" id="id_deta_prueba_quimica" name="deta_orden_id" class="form-control" readonly>
            </div>
            <div class="col-4">
                <label for="unidadMedida">Unidad de Medida</label>
                <input type="text" id="unidadMedida" class="form-control" readonly>
            </div>
            <div class="col-4">
                <label for="rangoRef">Rango de referencia</label>
                <input type="text" id="rangoRef" class="form-control" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="prueba">PRUEBA:</label>
                <input type="text" name="prueba" id="prueba" class="form-control" placeholder="Ingrese el nombre de la prueba" value="{{ old('prueba') }}">
                @error('prueba')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="resultado">RESULTADO:</label>
                <input type="text" name="resultado" id="resultado" class="form-control" placeholder="Ingrese el resultado" value="{{ old('resultado') }}">
                @error('resultado')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="observaciones">OBSERVACIONES:</label>
                <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
                @error('observaciones')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success">GUARDAR RESULTADOS</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    </form>
</div>
