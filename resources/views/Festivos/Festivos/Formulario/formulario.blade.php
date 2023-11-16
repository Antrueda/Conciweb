
<div class="form-row align-items-end">
    <div class="form-group col-md-6">
        {{ Form::label('email', 'Correo Electronico:', ['class' => 'control-label col-form-label-sm']) }}
        {{ Form::text('email', null, ['class' => $errors->first('email') ? 'form-control form-control-sm is-invalid' :'form-control form-control-sm']) }}
        @if($errors->has('email'))
        <div class="invalid-feedback d-block">
            {{ $errors->first('email') }}
        </div>
        @endif
    </div>

</div>
<br>