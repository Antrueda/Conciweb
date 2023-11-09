<div class="form-group row{{ $errors->first('caracteres') ? ' is-invalid' : '' }}">
	{{ Form::label('caracteres', 'Caracteres Permitidos:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Ver')
			{{ Form::text('caracteres', $dato->caracteres, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::text('caracteres', null, ['class' => $errors->first('caracteres') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'caracteres', 'maxlength' => '120', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('caracteres'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('caracteres') }}
      	</div>
    @endif
</div>
<br>
<div class="form-group row{{ $errors->first('longitud') ? ' is-invalid' : '' }}">
	{{ Form::label('longitud', 'Maximo:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Ver')
			{{ Form::number('longitud', $dato->longitud, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::number('longitud', null, ['class' => $errors->first('longitud') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'longitud', 'maxlength' => '120', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('longitud'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('longitud') }}
      	</div>
    @endif
</div>
<br>
<div class="row justify-content-md-center">
	<div class="col-2" >
	@if($accion == 'Nuevo')
		@can('permiso-crear')
			{{ Form::submit('Guardar', ['class' => 'btn btn-success']) }}
		@endcan
	@endif
</div>
<div class="col-2" >
	@if($accion == 'Editar')
		@can('permiso-editar')
		<center>
			{{ Form::submit('Modificar', ['class' => 'btn btn-success', 'style'=>'width: 120px']) }}
		</center>
		@endcan
	@endif
</div>
	@if($accion == 'Ver')
		@can('permiso-borrar')
			{!! Form::open(['route' => ['semilla.ver', $dato->id], 'method' => 'DELETE']) !!}
            	@if($dato->sis_esta_id == 1)
            		<button class="btn btn-danger">Inactivar</button>
            	@else
            		<button class="btn btn-success">Activar</button>
            	@endif
        	{!! Form::close() !!}
		@endcan
	@endif
	<div class="col-2" >
		<a class="btn btn-success ml-2" href="{{ route('admin') }}">Regresar</a>
	</div>
</div>
