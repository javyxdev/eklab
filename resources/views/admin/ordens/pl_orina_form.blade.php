<div class="modal-body">
    {!! Form::open(['route' => 'admin.exm_orina_plantillas.store']) !!}
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
            {!! Form::label('color','COLOR:') !!}
            {!! Form::select('color', $colores, null, ['class' => 'form-control', 'placeholder' => 'Seleccione un Color']) !!}
            @error('color')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('aspecto','ASPECTO:') !!}
            {!! Form::select('aspecto', $aspectos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione el aspecto']) !!}
            @error('aspecto')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('densidad','DENSIDAD:') !!}
            {!! Form::text('densidad', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('densidad')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('ph','PH:') !!}
            {!! Form::text('ph', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('ph')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('proteinas','PROTEINAS:') !!}
            {!! Form::text('proteinas', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('proteinas')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('glucosa','GLUCOSA:') !!}
            {!! Form::text('glucosa', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('glucosa')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-3">
            {!! Form::label('sangre_oculta','SANGRE OCULTA:') !!}
            {!! Form::text('sangre_oculta', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('sangre_oculta')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('cuerpos_cetonicos','CUERPOS CETONICOS:') !!}
            {!! Form::text('cuerpos_cetonicos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('cuerpos_cetonicos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('urobilinogeo','UROBILINOGENO:') !!}
            {!! Form::text('urobilinogeo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('urobilinogeo')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('bilirrubina','BILIRRUBINA:') !!}
            {!! Form::text('bilirrubina', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('bilirrubina')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('nitritos','NITRITOS:') !!}
            {!! Form::text('nitritos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('nitritos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('hemoglobina','HEMOGLOBINA:') !!}
            {!! Form::text('hemoglobina', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('hemoglobina')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-3">
            {!! Form::label('eterasa_leucocitaria','ESTERASA LEUCOCITARIA:') !!}
            {!! Form::text('eterasa_leucocitaria', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('eterasa_leucocitaria')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('hematies','HEMATIES:') !!}
            {!! Form::text('hematies', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('hematies')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('leucocitos','LEUCOCITOS:') !!}
            {!! Form::text('leucocitos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('leucocitos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('celulas_epiteliales','CELULAS EPITELIALES:') !!}
            {!! Form::text('celulas_epiteliales', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('celulas_epiteliales')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('filamentos_mucoides','FILAMENTOS MUCOIDES:') !!}
            {!! Form::text('filamentos_mucoides', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('filamentos_mucoides')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('bacterias','BACTERIAS:') !!}
            {!! Form::text('bacterias', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('bacterias')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="col-3">
            {!! Form::label('cil_granulosos','CILINDROS GRANULOSOS:') !!}
            {!! Form::text('cil_granulosos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('cil_granulosos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('cil_leucocitario','CILINDROS LEUCOCITARIOS:') !!}
            {!! Form::text('cil_leucocitario', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('cil_leucocitario')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('cil_hematicos','CILINDROS HEMÁTICOS:') !!}
            {!! Form::text('cil_hematicos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('cil_hematicos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('cil_hialianos','CILINDROS HILIANOS:') !!}
            {!! Form::text('cil_hialianos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('cil_hialianos')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <br>
            {!! Form::label('cil_cereos','CILINDROS CEREOS:') !!}
            {!! Form::text('cil_cereos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el resultado']) !!}
            @error('cil_cereos')
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

