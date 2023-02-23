<div class="modal-body">
    {!! Form::open(['route' => 'admin.exm_hemograma_plantillas.store']) !!}
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
            {!! Form::label('globulos_rojos','GLOBULOS ROJOS:') !!}
            {!! Form::text('globulos_rojos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('globulos_rojos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>{!! Form::label('hemoglobina','HEMOGLOBINA:') !!}
            {!! Form::text('hemoglobina', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('hemoglobina')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('hematocrito','HEMATOCRITO:') !!}
            {!! Form::text('hematocrito', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('hematocrito')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('vcm','VCM:') !!}
            {!! Form::text('vcm', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('vcm')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('hcm','HCM:') !!}
            {!! Form::text('hcm', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('hcm')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            {!! Form::label('chcm','CHCM:') !!}
            {!! Form::text('chcm', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('chcm')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('leucocitos','LEUCOCITOS:') !!}
            {!! Form::text('leucocitos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('leucocitos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('neutrofilos_segmentados','HEMATIES:') !!}
            {!! Form::text('neutrofilos_segmentados', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('neutrofilos_segmentados')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('neutrofilos_en_banda','NEUTROFILOS EN BANDA:') !!}
            {!! Form::text('neutrofilos_en_banda', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('neutrofilos_en_banda')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('linfocitos','LINFOCITOS:') !!}
            {!! Form::text('linfocitos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('linfocitos')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-4">
            {!! Form::label('monocitos','MONOCITOS:') !!}
            {!! Form::text('monocitos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('monocitos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('eosinofilos','EOSINOFILOS:') !!}
            {!! Form::text('eosinofilos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('eosinofilos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>{!! Form::label('basofilos','BASOFILOS:') !!}
            {!! Form::text('basofilos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('basofilos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>{!! Form::label('recuento_plaquetas','RECUENTO DE PLAQUETAS:') !!}
            {!! Form::text('recuento_plaquetas', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('recuento_plaquetas')
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

