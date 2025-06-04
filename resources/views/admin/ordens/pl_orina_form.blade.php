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
                <label for="color">COLOR:</label>
                <select name="color" id="color" class="form-control" >
                    <option value="" disabled selected>Seleccione un Color</option>
                    @foreach ($colores as $key => $value)
                        <option value="{{ $key }}" {{ old('color') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('color')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="aspecto">ASPECTO:</label>
                <select name="aspecto" id="aspecto" class="form-control">
                    <option value="" disabled selected>Seleccione el aspecto</option>
                    @foreach ($aspectos as $key => $value)
                        <option value="{{ $key }}" {{ old('aspecto') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('aspecto')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="densidad">DENSIDAD:</label>
                <input type="text" name="densidad" id="densidad" class="form-control" placeholder="Ingrese el resultado" value="{{ old('densidad') }}">
                @error('densidad')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="ph">PH:</label>
                <input type="text" name="ph" id="ph" class="form-control" placeholder="Ingrese el resultado" value="{{ old('ph') }}">
                @error('ph')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="proteinas">PROTEINAS:</label>
                <input type="text" name="proteinas" id="proteinas" class="form-control" placeholder="Ingrese el resultado" value="{{ old('proteinas') }}">
                @error('proteinas')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="glucosa">GLUCOSA:</label>
                <input type="text" name="glucosa" id="glucosa" class="form-control" placeholder="Ingrese el resultado" value="{{ old('glucosa') }}">
                @error('glucosa')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-3">
                <label for="sangre_oculta">SANGRE OCULTA:</label>
                <input type="text" name="sangre_oculta" id="sangre_oculta" class="form-control" placeholder="Ingrese el resultado" value="{{ old('sangre_oculta') }}">
                @error('sangre_oculta')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="cuerpos_cetonicos">CUERPOS CETONICOS:</label>
                <input type="text" name="cuerpos_cetonicos" id="cuerpos_cetonicos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cuerpos_cetonicos') }}">
                @error('cuerpos_cetonicos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="urobilinogeo">UROBILINOGENO:</label>
                <input type="text" name="urobilinogeo" id="urobilinogeo" class="form-control" placeholder="Ingrese el resultado" value="{{ old('urobilinogeo') }}">
                @error('urobilinogeo')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="bilirrubina">BILIRRUBINA:</label>
                <input type="text" name="bilirrubina" id="bilirrubina" class="form-control" placeholder="Ingrese el resultado" value="{{ old('bilirrubina') }}">
                @error('bilirrubina')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="nitritos">NITRITOS:</label>
                <input type="text" name="nitritos" id="nitritos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('nitritos') }}">
                @error('nitritos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="hemoglobina">HEMOGLOBINA:</label>
                <input type="text" name="hemoglobina" id="hemoglobina" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hemoglobina') }}">
                @error('hemoglobina')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-3">
                <label for="eterasa_leucocitaria">ESTERASA LEUCOCITARIA:</label>
                <input type="text" name="eterasa_leucocitaria" id="eterasa_leucocitaria" class="form-control" placeholder="Ingrese el resultado" value="{{ old('eterasa_leucocitaria') }}">
                @error('eterasa_leucocitaria')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="hematies">HEMATIES:</label>
                <input type="text" name="hematies" id="hematies" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hematies') }}">
                @error('hematies')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="leucocitos">LEUCOCITOS:</label>
                <input type="text" name="leucocitos" id="leucocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('leucocitos') }}">
                @error('leucocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="celulas_epiteliales">CELULAS EPITELIALES:</label>
                <input type="text" name="celulas_epiteliales" id="celulas_epiteliales" class="form-control" placeholder="Ingrese el resultado" value="{{ old('celulas_epiteliales') }}">
                @error('celulas_epiteliales')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="filamentos_mucoides">FILAMENTOS MUCOIDES:</label>
                <input type="text" name="filamentos_mucoides" id="filamentos_mucoides" class="form-control" placeholder="Ingrese el resultado" value="{{ old('filamentos_mucoides') }}">
                @error('filamentos_mucoides')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="bacterias">BACTERIAS:</label>
                <input type="text" name="bacterias" id="bacterias" class="form-control" placeholder="Ingrese el resultado" value="{{ old('bacterias') }}">
                @error('bacterias')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-3">
                <label for="cil_granulosos">CILINDROS GRANULOSOS:</label>
                <input type="text" name="cil_granulosos" id="cil_granulosos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_granulosos') }}">
                @error('cil_granulosos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="cil_leucocitario">CILINDROS LEUCOCITARIOS:</label>
                <input type="text" name="cil_leucocitario" id="cil_leucocitario" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_leucocitario') }}">
                @error('cil_leucocitario')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="cil_hematicos">CILINDROS HEMÁTICOS:</label>
                <input type="text" name="cil_hematicos" id="cil_hematicos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_hematicos') }}">
                @error('cil_hematicos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="cil_hialianos">CILINDROS HILIANOS:</label>
                <input type="text" name="cil_hialianos" id="cil_hialianos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_hialianos') }}">
                @error('cil_hialianos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>

                <label for="cil_cereos">CILINDROS CEREOS:</label>
                <input type="text" name="cil_cereos" id="cil_cereos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('cil_cereos') }}">
                @error('cil_cereos')
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
