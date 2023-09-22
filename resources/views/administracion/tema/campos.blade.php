<div class="form-group row{{ $errors->first('nombre') ? ' is-invalid' : '' }}">
	{{ Form::label('nombre', 'Nombre:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Ver')
			{{ Form::text('nombre', $dato->nombre, ['class' => 'form-control-plaintext']) }}
		@else
			{{ Form::text('nombre', null, ['class' => $errors->first('nombre') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'nombre del tema', 'maxlength' => '120', 'autofocus']) }}
		@endif
	</div>
	@if($errors->has('nombre'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('nombre') }}
      	</div>
    @endif
</div>
<br>
<div class="row justify-content-md-center">
	<div class="col-2" >
	@if($accion == 'Nuevo')
		@can('permiso-crear')
			{{ Form::submit('Guardar', ['class' => 'btn btn-success','style'=>'width: 120px']) }}
		@endcan
	@endif
</div>
<div class="col-2" >
	@if($accion == 'Editar')
		@can('permiso-editar')
			{{ Form::submit('Guardar', ['class' => 'btn btn-success ml-2','style'=>'width: 120px']) }}
		@endcan
	@endif
</div>
	@if($accion == 'Ver')
		@can('permiso-borrar')
			{!! Form::open(['route' => ['tema.ver', $dato->id], 'method' => 'DELETE']) !!}
            	@if($dato->sis_esta_id == 1)
            		<button class="btn btn-danger">Inactivar</button>
            	@else
            		<button class="btn btn-success">Activar</button>
            	@endif
        	{!! Form::close() !!}
		@endcan
	@endif
	<div class="col-2" >
    <a class="btn btn-primary px-2 ml-2"  href="{{ route('tema') }}" style="width: 120px;">Regresar</a>
</div>
</div>