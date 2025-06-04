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
                <label for="globulos_rojos">GLOBULOS ROJOS:</label>
                <input type="text" name="globulos_rojos" id="globulos_rojos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('globulos_rojos') }}">
                @error('globulos_rojos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hemoglobina">HEMOGLOBINA:</label>
                <input type="text" name="hemoglobina" id="hemoglobina" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hemoglobina') }}">
                @error('hemoglobina')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hematocrito">HEMATOCRITO:</label>
                <input type="text" name="hematocrito" id="hematocrito" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hematocrito') }}">
                @error('hematocrito')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="vcm">VCM:</label>
                <input type="text" name="vcm" id="vcm" class="form-control" placeholder="Ingrese el resultado" value="{{ old('vcm') }}">
                @error('vcm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="hcm">HCM:</label>
                <input type="text" name="hcm" id="hcm" class="form-control" placeholder="Ingrese el resultado" value="{{ old('hcm') }}">
                @error('hcm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <label for="chcm">CHCM:</label>
                <input type="text" name="chcm" id="chcm" class="form-control" placeholder="Ingrese el resultado" value="{{ old('chcm') }}">
                @error('chcm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="leucocitos">LEUCOCITOS:</label>
                <input type="text" name="leucocitos" id="leucocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('leucocitos') }}">
                @error('leucocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="neutrofilos_segmentados">HEMATIES:</label>
                <input type="text" name="neutrofilos_segmentados" id="neutrofilos_segmentados" class="form-control" placeholder="Ingrese el resultado" value="{{ old('neutrofilos_segmentados') }}">
                @error('neutrofilos_segmentados')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="neutrofilos_en_banda">NEUTROFILOS EN BANDA:</label>
                <input type="text" name="neutrofilos_en_banda" id="neutrofilos_en_banda" class="form-control" placeholder="Ingrese el resultado" value="{{ old('neutrofilos_en_banda') }}">
                @error('neutrofilos_en_banda')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="linfocitos">LINFOCITOS:</label>
                <input type="text" name="linfocitos" id="linfocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('linfocitos') }}">
                @error('linfocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-4">
                <label for="monocitos">MONOCITOS:</label>
                <input type="text" name="monocitos" id="monocitos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('monocitos') }}">
                @error('monocitos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="eosinofilos">EOSINOFILOS:</label>
                <input type="text" name="eosinofilos" id="eosinofilos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('eosinofilos') }}">
                @error('eosinofilos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="basofilos">BASOFILOS:</label>
                <input type="text" name="basofilos" id="basofilos" class="form-control" placeholder="Ingrese el resultado" value="{{ old('basofilos') }}">
                @error('basofilos')
                <small class="text-danger">{{ $message }}</small>
                @enderror
                <br>
                <label for="recuento_plaquetas">RECUENTO DE PLAQUETAS:</label>
                <input type="text" name="recuento_plaquetas" id="recuento_plaquetas" class="form-control" placeholder="Ingrese el resultado" value="{{ old('recuento_plaquetas') }}">
                @error('recuento_plaquetas')
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
