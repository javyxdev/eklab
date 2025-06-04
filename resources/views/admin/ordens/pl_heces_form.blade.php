<div class="modal-body">
    <form action="{{ route('admin.exm_heces_plantillas.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-2">
                <label for="id_exm_heces">ID EXAMEN</label>
                <input type="text" id="id_exm_heces" name="examen_id" class="form-control" readonly>
            </div>
            <div class="col-2">
                <label for="id_deta_prueba_heces">No. PRUEBA</label>
                <input type="text" id="id_deta_prueba_heces" name="deta_orden_id" class="form-control" readonly>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-4">
                <label for="color">COLOR:</label>
                <select name="color" id="color" class="form-control" >
                    <option value="" disabled selected>Seleccione un Color</option>
                    @foreach($colores as $key => $value)
                        <option value="{{ $key }}" {{ old('color') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('color')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="consistencia">CONSISTENCIA:</label>
                <select name="consistencia" id="consistencia" class="form-control">
                    <option value="" disabled selected>Seleccione consistencia</option>
                    @foreach($consistencias as $key => $value)
                        <option value="{{ $key }}" {{ old('consistencia') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('consistencia')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="mucus">MUCUS:</label>
                <input type="text" name="mucus" id="mucus" class="form-control" placeholder="Ingrese el resultado" value="{{ old('mucus') }}">
                @error('mucus')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="restos_alim_mac">RESTOS ALIMENTICIOS MACROSCOPICOS:</label>
                <input type="text" name="restos_alim_mac" id="restos_alim_mac" class="form-control" placeholder="Ingrese el resultado" value="{{ old('restos_alim_mac') }}">
                @error('restos_alim_mac')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-4">
                <label for="sangre">SANGRE:</label>
                <input type="text" name="sangre" id="sangre" class="form-control" placeholder="Ingrese el resultado" value="{{ old('sangre') }}">
                @error('sangre')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="leucocitos">LEUCOCITOS:</label>
                <input type="text" name="leucocitos" id="leucocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('leucocitos') }}">
                @error('leucocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="hematies">HEMATIES:</label>
                <input type="text" name="hematies" id="hematies" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hematies') }}">
                @error('hematies')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="levadura">LEVADURA:</label>
                <input type="text" name="levadura" id="levadura" class="form-control" placeholder="Ingrese el resultado" value="{{ old('levadura') }}">
                @error('levadura')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-4">
                <label for="restos_alim_mic">RESTOS ALIMENTICIOS MICROSCOPICOS:</label>
                <input type="text" name="restos_alim_mic" id="restos_alim_mic" class="form-control" placeholder="Ingrese el resultado" value="{{ old('restos_alim_mic') }}">
                @error('restos_alim_mic')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="parasitos">PARASITOS:</label>
                <textarea name="parasitos" id="parasitos" rows="3" class="form-control">{{ old('parasitos') }}</textarea>
                @error('parasitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="observaciones">OBSERVACIONES:</label>
                <textarea name="observaciones" id="observaciones" rows="3" class="form-control">{{ old('observaciones') }}</textarea>
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
