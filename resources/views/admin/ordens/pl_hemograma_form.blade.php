<div class="modal-body">
    <form method="POST" action="{{ route('admin.exm_hemograma_plantillas.store') }}">
        @csrf
        <div class="row">
            <div class="col-2">
                <label for="id_exm_hemograma">ID EXAMEN</label>
                <input type="text" id="id_exm_hemograma" name="examen_id" class="form-control" readonly>
            </div>
            <div class="col-2">
                <label for="id_deta_prueba_hemograma">No. PRUEBA</label>
                <input type="text" id="id_deta_prueba_hemograma" name="deta_orden_id" class="form-control" readonly>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <label for="hmg_globulos_rojos">GLOBULOS ROJOS:</label>
                <input type="text" name="globulos_rojos" id="hmg_globulos_rojos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('globulos_rojos') }}" required>
                @error('globulos_rojos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_hemoglobina">HEMOGLOBINA:</label>
                <input type="text" name="hemoglobina" id="hmg_hemoglobina" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hemoglobina') }}" required>
                @error('hemoglobina')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_hematocrito">HEMATOCRITO:</label>
                <input type="text" name="hematocrito" id="hmg_hematocrito" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hematocrito') }}" required>
                @error('hematocrito')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_vcm">VCM:</label>
                <input type="text" name="vcm" id="hmg_vcm" class="form-control" placeholder="Ingrese el resultado" value="{{ old('vcm') }}" required>
                @error('vcm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_hcm">HCM:</label>
                <input type="text" name="hcm" id="hmg_hcm" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hcm') }}" required>
                @error('hcm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <label for="hmg_chcm">CHCM:</label>
                <input type="text" name="chcm" id="hmg_chcm" class="form-control" placeholder="Ingrese el resultado" value="{{ old('chcm') }}" required>
                @error('chcm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_leucocitos">LEUCOCITOS:</label>
                <input type="text" name="leucocitos" id="hmg_leucocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('leucocitos') }}" required>
                @error('leucocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_neutrofilos_segmentados">SEGMENTADOS:</label>
                <input type="text" name="neutrofilos_segmentados" id="hmg_neutrofilos_segmentados" class="form-control" placeholder="Ingrese el resultado" value="{{ old('neutrofilos_segmentados') }}" required>
                @error('neutrofilos_segmentados')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_neutrofilos_en_banda">NEUTROFILOS EN BANDA:</label>
                <input type="text" name="neutrofilos_en_banda" id="hmg_neutrofilos_en_banda" class="form-control" placeholder="Ingrese el resultado" value="{{ old('neutrofilos_en_banda') }}" required>
                @error('neutrofilos_en_banda')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_linfocitos">LINFOCITOS:</label>
                <input type="text" name="linfocitos" id="hmg_linfocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('linfocitos') }}" required>
                @error('linfocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <label for="hmg_monocitos">MONOCITOS:</label>
                <input type="text" name="monocitos" id="hmg_monocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('monocitos') }}" required>
                @error('monocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_eosinofilos">EOSINOFILOS:</label>
                <input type="text" name="eosinofilos" id="hmg_eosinofilos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('eosinofilos') }}" required>
                @error('eosinofilos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_basofilos">BASOFILOS:</label>
                <input type="text" name="basofilos" id="hmg_basofilos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('basofilos') }}" required>
                @error('basofilos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_recuento_plaquetas">RECUENTO DE PLAQUETAS:</label>
                <input type="text" name="recuento_plaquetas" id="hmg_recuento_plaquetas" class="form-control" placeholder="Ingrese el resultado" value="{{ old('recuento_plaquetas') }}" required>
                @error('recuento_plaquetas')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hmg_observaciones">OBSERVACIONES:</label>
                <textarea name="observaciones" id="hmg_observaciones" class="form-control" rows="3">{{ old('observaciones') }}</textarea>
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
