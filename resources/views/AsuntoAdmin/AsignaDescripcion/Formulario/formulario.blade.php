<div>
    <div class="form-group row">
        <div class="form-group col-md-3">
            {{ Form::label('asunto_id', 'Asunto:', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('asunto_id', $todoxxxx['asuntoxx'], null, ['class' => $errors->first('nombre') ? 'form-control is-invalid select2' : 'form-control select2']) }}
            @if($errors->has('asunto_id'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('asunto_id') }}
            </div>
            @endif
        </div>
    
        <div class="form-group col-md-3">
            {{ Form::label('subasu_id', 'Subasunto:', ['class' => 'control-label col-form-label-sm']) }}
            {{ Form::select('subasu_id', $todoxxxx['subasunt'], null, ['class' => $errors->first('nombre') ? 'form-control is-invalid select2' : 'form-control select2','id'=>'subtipo']) }}
            @if($errors->has('subasu_id'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('subasu_id') }}
            </div>
            @endif
        </div>
    
        <div class="form-group col-md-3">
            {{ Form::label('sis_esta_id', 'Estado', ['class' => 'control-label']) }}
            {{ Form::select('sis_esta_id', $todoxxxx['estadoxx'], null, ['class' => $errors->first('sis_esta_id') ?
        'form-control select2 form-control-sm is-invalid cargos' : 'form-control select2 form-control-sm cargos',
        'data-placeholder' => 'Seleccione un estado']) }}
            @if($errors->has('sis_esta_id'))
            <div class="invalid-feedback d-block">
                {{ $errors->first('sis_esta_id') }}
            </div>
            @endif
        </div>
    </div>
    
    </div>