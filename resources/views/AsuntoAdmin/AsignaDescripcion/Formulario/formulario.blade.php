<div>
    <div class="form-group row">
        <div class="form-group col-md-3">
            {{ Form::label('subasu_id', 'Subasunto:', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('subasu_id', $todoxxxx['subasunt'], null, ['class' => $errors->first('subasu_id') ? 'form-control is-invalid select2' : 'form-control select2','id'=>'subasu_id']) }}
            @if($errors->has('subasu_id'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('subasu_id') }}
            </div>
            @endif
        </div>
    
        <div class="form-group col-md-3">
            {{ Form::label('descri_id', 'Descripcíon de Adjunto:', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('descri_id', $todoxxxx['descripc'], null, ['class' => $errors->first('descri_id') ? 'form-control is-invalid select2' : 'form-control select2','id'=>'descri_id']) }}
            @if($errors->has('descri_id'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('descri_id') }}
            </div>
            @endif
        </div>

        <div class="form-group col-md-3">
            {{ Form::label('obligatorio', 'Obligatorio:', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('obligatorio', $todoxxxx['obligato'], null, ['class' => $errors->first('nombre') ? 'form-control is-invalid select2' : 'form-control select2','id'=>'obligatorio','placeholder'=>'Seleccione']) }}
            @if($errors->has('obligatorio'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('obligatorio') }}
            </div>
            @endif
        </div>
    
        <div class="form-group col-md-3">
            {{ Form::label('sis_esta_id', 'Estado', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('sis_esta_id', $todoxxxx['estadoxx'], null, ['class' =>  $errors->first('sis_esta_id') ? 'form-control is-invalid select2' : 'form-control select2','data-placeholder' => 'Seleccione un estado']) }}
            @if($errors->has('sis_esta_id'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('sis_esta_id') }}
            </div>
            @endif
        </div>
    </div>
    
    </div>
    <br>