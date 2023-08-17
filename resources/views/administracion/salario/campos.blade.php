<div class="form-group row{{ $errors->first('nombre') ? ' is-invalid' : '' }}">
	{{ Form::label('nombre', 'Numero:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Ver')
			{{ Form::text('numero', $dato->numero, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::text('numero', null, ['class' => $errors->first('numero') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'numero', 'maxlength' => '120', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('nombre'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('nombre') }}
      	</div>
    @endif
</div>
<br>
<div class="form-group row{{ $errors->first('nombre') ? ' is-invalid' : '' }}">
	{{ Form::label('nombre', 'Maximo:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Ver')
			{{ Form::text('maximo', $dato->maximo, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::text('maximo', null, ['class' => $errors->first('maximo') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'maximo', 'maxlength' => '120', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('nombre'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('maximo') }}
      	</div>
    @endif
</div>
<br>
<div class="row">
	@if($accion == 'Nuevo')
		@can('permiso-crear')
			{{ Form::submit('Guardar', ['class' => 'btn btn-success']) }}
		@endcan
	@endif
	@if($accion == 'Editar')
		@can('permiso-editar')
		<center>
			{{ Form::submit('Modificar', ['class' => 'btn btn-success', 'style'=>'width: 120px']) }}
		</center>
		@endcan
	@endif
	@if($accion == 'Ver')
		@can('permiso-borrar')
			{!! Form::open(['route' => ['salario.ver', $dato->id], 'method' => 'DELETE']) !!}
            	@if($dato->sis_esta_id == 1)
            		<button class="btn btn-danger">Inactivar</button>
            	@else
            		<button class="btn btn-success">Activar</button>
            	@endif
        	{!! Form::close() !!}
		@endcan
	@endif

</div>