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
                <label for="heces_color">COLOR:</label>
                <select name="color" id="heces_color" class="form-control" required>
                    <option value="" disabled selected>Seleccione un Color</option>
                    @foreach($colores as $key => $value)
                        <option value="{{ $key }}" {{ old('color') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('color')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_consistencia">CONSISTENCIA:</label>
                <select name="consistencia" id="heces_consistencia" class="form-control" required>
                    <option value="" disabled selected>Seleccione consistencia</option>
                    @foreach($consistencias as $key => $value)
                        <option value="{{ $key }}" {{ old('consistencia') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('consistencia')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_mucus">MUCUS:</label>
                <input type="text" name="mucus" id="heces_mucus" class="form-control" placeholder="Ingrese el resultado" value="{{ old('mucus') }}" required>
                @error('mucus')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_restos_alim_mac">RESTOS ALIMENTICIOS MACROSCOPICOS:</label>
                <input type="text" name="restos_alim_mac" id="heces_restos_alim_mac" class="form-control" placeholder="Ingrese el resultado" value="{{ old('restos_alim_mac') }}" required>
                @error('restos_alim_mac')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-4">
                <label for="heces_sangre">SANGRE:</label>
                <input type="text" name="sangre" id="heces_sangre" class="form-control" placeholder="Ingrese el resultado" value="{{ old('sangre') }}" required>
                @error('sangre')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_leucocitos">LEUCOCITOS:</label>
                <input type="text" name="leucocitos" id="heces_leucocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('leucocitos') }}" required>
                @error('leucocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_hematies">HEMATIES:</label>
                <input type="text" name="hematies" id="heces_hematies" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hematies') }}" required>
                @error('hematies')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_levadura">LEVADURA:</label>
                <input type="text" name="levadura" id="heces_levadura" class="form-control" placeholder="Ingrese el resultado" value="{{ old('levadura') }}" required>
                @error('levadura')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-4">
                <label for="heces_restos_alim_mic">RESTOS ALIMENTICIOS MICROSCOPICOS:</label>
                <input type="text" name="restos_alim_mic" id="heces_restos_alim_mic" class="form-control" placeholder="Ingrese el resultado" value="{{ old('restos_alim_mic') }}" required>
                @error('restos_alim_mic')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_parasitos">PARASITOS:</label>
                <textarea name="parasitos" id="heces_parasitos" rows="3" class="form-control" required>{{ old('parasitos') }}</textarea>
                @error('parasitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror

                <br>

                <label for="heces_observaciones">OBSERVACIONES:</label>
                <textarea name="observaciones" id="heces_observaciones" rows="3" class="form-control">{{ old('observaciones') }}</textarea>
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
