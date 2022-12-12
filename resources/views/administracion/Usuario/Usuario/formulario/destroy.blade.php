<div class="form-group row">
    <div class="form-group col-md-12">
        {{ Form::label('estusuario_id','OBSERVACIÓN DE INACTIVACIÓN') }}
        {{ Form::select('estusuario_id',$todoxxxx['observac'], null,['class'=>'form-control form-control-sm select2']) }}
        @if($errors->has('estusuario_id'))
        <div class="invalid-feedback d-block">
            {{ $errors->first('estusuario_id') }}
        </div>
        @endif
    </div>
    @include('layouts.registro')
</div>
