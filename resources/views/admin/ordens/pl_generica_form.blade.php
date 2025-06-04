<div class="modal-body">
    <form action="{{ route('admin.exm_generica_plantillas.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-2">
                <label for="id_exm_generico">ID EXAMEN</label>
                <input type="text" id="id_exm_generico" name="examen_id" class="form-control" readonly>
            </div>
            <div class="col-2">
                <label for="id_deta_prueba_generico">No. PRUEBA</label>
                <input type="text" id="id_deta_prueba_generico" name="deta_orden_id" class="form-control" readonly>
            </div>
            <div class="col-4">
                <label for="prueba_generico">PRUEBA:</label>
                <input type="text" id="prueba_generico" name="prueba" class="form-control" readonly>
                @error('prueba')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <br>

        @for ($i = 1; $i <= 5; $i++)
            <div class="row">
                <div class="col-4">
                    <label for="param_{{ $i }}">PARAMETRO {{ $i }}:</label>
                    <input type="text" id="param_{{ $i }}" name="param_{{ $i }}" class="form-control" value="{{ old('param_' . $i) }}">
                    @error('param_' . $i)
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="resultado_{{ $i }}">RESULTADO {{ $i }}:</label>
                    <input type="text" id="resultado_{{ $i }}" name="resultado_{{ $i }}" class="form-control" value="{{ old('resultado_' . $i) }}">
                    @error('resultado_' . $i)
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-2">
                    <label for="unidad_med_{{ $i }}">UNIDAD DE MEDIDA:</label>
                    <input type="text" id="unidad_med_{{ $i }}" name="unidad_med_{{ $i }}" class="form-control" value="{{ old('unidad_med_' . $i) }}">
                    @error('unidad_med_' . $i)
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-2">
                    <label for="rango_ref_{{ $i }}">RANGO REFERENCIA:</label>
                    <input type="text" id="rango_ref_{{ $i }}" name="rango_ref_{{ $i }}" class="form-control" value="{{ old('rango_ref_' . $i) }}">
                    @error('rango_ref_' . $i)
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endfor

        <div class="row mt-3">
            <div class="col-12">
                <label for="observaciones">OBSERVACIONES:</label>
                <textarea id="observaciones" name="observaciones" rows="3" class="form-control">{{ old('observaciones') }}</textarea>
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
