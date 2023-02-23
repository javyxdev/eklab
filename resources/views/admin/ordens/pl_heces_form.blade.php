<div class="modal-body">
    {!! Form::open(['route' => 'admin.exm_heces_plantillas.store']) !!}
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
                {!! Form::label('color','COLOR:') !!}
                {!! Form::select('color', $colores, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Color']) !!}
                @error('color')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('consistencia','CONSISTENCIA:') !!}
                {!! Form::select('consistencia', $consistencias, null, ['class' => 'form-control', 'placeholder' => 'Seleccione consistencia']) !!}
                @error('consistencia')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('mucus','MUCUS:') !!}
                {!! Form::text('mucus', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('mucus')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('restos_alim_mac','RESTOS ALIMENTICIOS MACROSCOPICOS:') !!}
                {!! Form::text('restos_alim_mac', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('restos_alim_mac')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-4">
                {!! Form::label('sangre','SANGRE:') !!}
                {!! Form::text('sangre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('sangre')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('leucocitos','LEUCOCITOS:') !!}
                {!! Form::text('leucocitos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('leucocitos')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('hematies','HEMATIES:') !!}
                {!! Form::text('hematies', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('hematies')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('levadura','LEVADURA:') !!}
                {!! Form::text('levadura', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('levadura')
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="col-4">
                {!! Form::label('restos_alim_mic','RESTOS ALIMENTICIOS MICROSCOPICOS:') !!}
                {!! Form::text('restos_alim_mic', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
                @error('restos_alim_mac')
                <small class="text-danger">{{$message}}</small>
                @enderror
                <br>
                {!! Form::label('parasitos','PARASITOS:') !!}
                {!! Form::textArea('parasitos', null, ['class' => 'form-control', 'rows' => 3]) !!}
                @error('parasitos')
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
