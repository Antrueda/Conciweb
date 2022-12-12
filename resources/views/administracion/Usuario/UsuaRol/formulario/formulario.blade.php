<div class="form-group row">
    <div class="form-group col-md-6">
        {{ Form::label('model_id', 'Usuario', ['class' => 'control-label col-form-label-sm']) }}
        {{ Form::select('model_id', $todoxxxx["userxxxx"], null, ['class' => 'form-control form-control-sm select2','style'=>'height:38px']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('role_id', 'Rol', ['class' => 'control-label col-form-label-sm']) }}
        {{ Form::select('role_id', $todoxxxx["rolesxxx"], null, ['class' => 'form-control form-control-sm select2','style'=>'height:38px']) }}
    </div>

    @include('layouts.registro')
</div>
