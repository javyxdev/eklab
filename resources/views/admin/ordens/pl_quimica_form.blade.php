<div class="modal-body">
    {!! Form::open(['route' => 'admin.exm_quimica_plantillas.store']) !!}
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
            {!! Form::label('prueba','PRUEBA:') !!}
            {!! Form::text('prueba', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la prueba']) !!}
            @error('prueba')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('resultado','RESULTADO:') !!}
            {!! Form::text('resultado', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('resultado')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
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
