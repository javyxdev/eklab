<div class="modal-body">
    <form action="{{ route('admin.exm_orina_plantillas.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-2">
                <label for="id_exm_orina">ID EXAMEN</label>
                <input type="text" id="id_exm_orina" name="examen_id" class="form-control" readonly>
            </div>
            <div class="col-2">
                <label for="id_deta_prueba_orina">No. PRUEBA</label>
                <input type="text" id="id_deta_prueba_orina" name="deta_orden_id" class="form-control" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-3">
                <label for="orina_color">COLOR:</label>
                <select name="color" id="orina_color" class="form-control" required>
                    <option value="" disabled selected>Seleccione un Color</option>
                    @foreach ($colores as $key => $value)
                        <option value="{{ $key }}" {{ old('color') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('color')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_aspecto">ASPECTO:</label>
                <select name="aspecto" id="orina_aspecto" class="form-control" required>
                    <option value="" disabled selected>Seleccione el aspecto</option>
                    @foreach ($aspectos as $key => $value)
                        <option value="{{ $key }}" {{ old('aspecto') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('aspecto')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_densidad">DENSIDAD:</label>
                <input type="text" name="densidad" id="orina_densidad" class="form-control" placeholder="Ingrese el resultado" value="{{ old('densidad') }}" required>
                @error('densidad')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_ph">PH:</label>
                <input type="text" name="ph" id="orina_ph" class="form-control" placeholder="Ingrese el resultado" value="{{ old('ph') }}" required>
                @error('ph')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_proteinas">PROTEINAS:</label>
                <input type="text" name="proteinas" id="orina_proteinas" class="form-control" placeholder="Ingrese el resultado" value="{{ old('proteinas') }}" required>
                @error('proteinas')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_glucosa">GLUCOSA:</label>
                <input type="text" name="glucosa" id="orina_glucosa" class="form-control" placeholder="Ingrese el resultado" value="{{ old('glucosa') }}" required>
                @error('glucosa')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-3">
                <label for="orina_sangre_oculta">SANGRE OCULTA:</label>
                <input type="text" name="sangre_oculta" id="orina_sangre_oculta" class="form-control" placeholder="Ingrese el resultado" value="{{ old('sangre_oculta') }}" required>
                @error('sangre_oculta')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_cuerpos_cetonicos">CUERPOS CETONICOS:</label>
                <input type="text" name="cuerpos_cetonicos" id="orina_cuerpos_cetonicos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cuerpos_cetonicos') }}" required>
                @error('cuerpos_cetonicos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_urobilinogeno">UROBILINOGENO:</label>
                <input type="text" name="urobilinogeno" id="orina_urobilinogeno" class="form-control" placeholder="Ingrese el resultado" value="{{ old('urobilinogeno') }}" required>
                @error('urobilinogeno')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_bilirrubina">BILIRRUBINA:</label>
                <input type="text" name="bilirrubina" id="orina_bilirrubina" class="form-control" placeholder="Ingrese el resultado" value="{{ old('bilirrubina') }}" required>
                @error('bilirrubina')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_nitritos">NITRITOS:</label>
                <input type="text" name="nitritos" id="orina_nitritos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('nitritos') }}" required>
                @error('nitritos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_hemoglobina">HEMOGLOBINA:</label>
                <input type="text" name="hemoglobina" id="orina_hemoglobina" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hemoglobina') }}" required>
                @error('hemoglobina')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-3">
                <label for="orina_esterasa_leucocitaria">ESTERASA LEUCOCITARIA:</label>
                <input type="text" name="esterasa_leucocitaria" id="orina_esterasa_leucocitaria" class="form-control" placeholder="Ingrese el resultado" value="{{ old('esterasa_leucocitaria') }}" required>
                @error('esterasa_leucocitaria')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_hematies">HEMATIES:</label>
                <input type="text" name="hematies" id="orina_hematies" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hematies') }}" required>
                @error('hematies')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_leucocitos">LEUCOCITOS:</label>
                <input type="text" name="leucocitos" id="orina_leucocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('leucocitos') }}" required>
                @error('leucocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_celulas_epiteliales">CELULAS EPITELIALES:</label>
                <input type="text" name="celulas_epiteliales" id="orina_celulas_epiteliales" class="form-control" placeholder="Ingrese el resultado" value="{{ old('celulas_epiteliales') }}" required>
                @error('celulas_epiteliales')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_filamentos_mucoides">FILAMENTOS MUCOIDES:</label>
                <input type="text" name="filamentos_mucoides" id="orina_filamentos_mucoides" class="form-control" placeholder="Ingrese el resultado" value="{{ old('filamentos_mucoides') }}" required>
                @error('filamentos_mucoides')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_bacterias">BACTERIAS:</label>
                <input type="text" name="bacterias" id="orina_bacterias" class="form-control" placeholder="Ingrese el resultado" value="{{ old('bacterias') }}" required>
                @error('bacterias')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-3">
                <label for="orina_cil_granulosos">CILINDROS GRANULOSOS:</label>
                <input type="text" name="cil_granulosos" id="orina_cil_granulosos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_granulosos') }}" required>
                @error('cil_granulosos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_cil_leucocitario">CILINDROS LEUCOCITARIOS:</label>
                <input type="text" name="cil_leucocitario" id="orina_cil_leucocitario" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_leucocitario') }}" required>
                @error('cil_leucocitario')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_cil_hematicos">CILINDROS HEMÁTICOS:</label>
                <input type="text" name="cil_hematicos" id="orina_cil_hematicos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_hematicos') }}" required>
                @error('cil_hematicos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_cil_hialianos">CILINDROS HILIANOS:</label>
                <input type="text" name="cil_hialianos" id="orina_cil_hialianos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_hialianos') }}" required>
                @error('cil_hialianos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_cil_cereos">CILINDROS CEREOS:</label>
                <input type="text" name="cil_cereos" id="orina_cil_cereos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_cereos') }}" required>
                @error('cil_cereos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="orina_observaciones">OBSERVACIONES:</label>
                <textarea name="observaciones" id="orina_observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
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
