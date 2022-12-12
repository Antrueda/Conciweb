<div class="form-group row">
<div class="form-group col-md-6">
        {{ Form::label('name', 'Rol:', ['class' => 'control-label col-form-label-sm']) }}
        {{ Form::text('name', null, ['class' => 'form-control form-control','onkeyup' => 'javascript:this.value=this.value.toUpperCase();', 'style' => 'text-transform:uppercase;']) }}
        @if($errors->has('name'))
        <div class="invalid-feedback d-block">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>
    <?php $anchoxxx =12?>
    

</div>

