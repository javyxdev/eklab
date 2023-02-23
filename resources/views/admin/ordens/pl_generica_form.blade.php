<div class="modal-body">
    {!! Form::open(['route' => 'admin.exm_generica_plantillas.store']) !!}
    <div class="row">
        <div class="col-2">
            <label for="id_exm_quimica">ID EXAMEN</label>
            <input type="text" id="id_exm_generico" name="examen_id" class="form-control" readonly>
        </div>
        <div class="col-2">
            <label for="id_deta_prueba_quimica">No. PRUEBA</label>
            <input type="text" id="id_deta_prueba_generico" name="deta_orden_id" class="form-control" readonly>
        </div>
        <div class="col-4">
            <label for="prueba_generico">PRUEBA:</label>
            <input type="text" id="prueba_generico" name="prueba" class="form-control" readonly>
            @error('prueba')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <label for="param_1">PARAMETRO 1:</label>
            <input type="text" id="param_1" name="param_1" class="form-control">
            @error('param_1')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            <label for="param_1">RESULTADO 1:</label>
            <input type="text" id="resultado_1" name="resultado_1" class="form-control">
            @error('resultado_1')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">UNIDAD DE MEDIDA:</label>
            <input type="text" id="unidad_med_1" name="unidad_med_1" class="form-control">
            @error('unidad_med_1')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">RANGO REFERENCIA:</label>
            <input type="text" id="rango_ref_1" name="rango_ref_1" class="form-control">
            @error('rango_ref_1')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="param_1">PARAMETRO 2:</label>
            <input type="text" id="param_2" name="param_2" class="form-control">
            @error('param_2')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            <label for="param_1">RESULTADO 2:</label>
            <input type="text" id="resultado_2" name="resultado_2" class="form-control">
            @error('resultado_2')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">UNIDAD DE MEDIDA:</label>
            <input type="text" id="unidad_med_2" name="unidad_med_2" class="form-control">
            @error('unidad_med_2')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">RANGO REFERENCIA:</label>
            <input type="text" id="rango_ref_2" name="rango_ref_2" class="form-control">
            @error('rango_ref_2')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="param_1">PARAMETRO 3:</label>
            <input type="text" id="param_3" name="param_3" class="form-control">
            @error('param_3')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            <label for="param_1">RESULTADO 3:</label>
            <input type="text" id="resultado_3" name="resultado_3" class="form-control">
            @error('resultado_3')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">UNIDAD DE MEDIDA:</label>
            <input type="text" id="unidad_med_3" name="unidad_med_3" class="form-control">
            @error('unidad_med_3')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">RANGO REFERENCIA:</label>
            <input type="text" id="rango_ref_3" name="rango_ref_3" class="form-control">
            @error('rango_ref_3')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="param_1">PARAMETRO 4:</label>
            <input type="text" id="param_4" name="param_4" class="form-control">
            @error('param_4')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            <label for="param_1">RESULTADO 4:</label>
            <input type="text" id="resultado_4" name="resultado_4" class="form-control">
            @error('resultado_4')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">UNIDAD DE MEDIDA:</label>
            <input type="text" id="unidad_med_4" name="unidad_med_4" class="form-control">
            @error('unidad_med_4')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">RANGO REFERENCIA:</label>
            <input type="text" id="rango_ref_4" name="rango_ref_4" class="form-control">
            @error('rango_ref_4')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <label for="param_1">PARAMETRO 5:</label>
            <input type="text" id="param_5" name="param_5" class="form-control">
            @error('param_5')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            <label for="param_1">RESULTADO 5:</label>
            <input type="text" id="resultado_5" name="resultado_5" class="form-control">
            @error('resultado_5')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">UNIDAD DE MEDIDA:</label>
            <input type="text" id="unidad_med_5" name="unidad_med_5" class="form-control">
            @error('unidad_med_5')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-2">
            <label for="param_">RANGO REFERENCIA:</label>
            <input type="text" id="rango_ref_5" name="rango_ref_5" class="form-control">
            @error('rango_ref_5')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {!! Form::label('observaciones','OBSERVACIONES:') !!}
            {!! Form::textArea('observaciones', null, ['class' => 'form-control', 'rows' => 3]) !!}
            @error('observaciones')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
</div>
<div class="modal-footer">
    {!! Form::submit('GUARDAR RESULTADOS', ['class' => 'btn btn-success']) !!}
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    {!! Form::close([]) !!}
</div>
