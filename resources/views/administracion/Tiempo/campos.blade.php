
<div class="form-group col-md-12">
	{{ Form::label('tiempo', 'Tiempo:', ['class' => 'control-label col-form-label-sm']) }}
	{{ Form::number('tiempo', $dato->tiempo, ['class' => $errors->first('tiempo') ? 'form-control form-control-sm is-invalid contarcaracteres' :'form-control form-control-sm']) }}
	@if($errors->has('tiempo'))
	<div class="invalid-feedback d-block">
		{{ $errors->first('tiempo') }}
	</div>
	@endif
</div>
<br>
<div class="row">
	@if($accion == 'Nuevo')
		@can('permiso-crear')
		<center>
			{{ Form::submit('Guardar', ['class' => 'btn btn-success']) }}
		</center>
		@endcan
	@endif
	@if($accion == 'Editar')

		<center>
			{{ Form::submit('Modificar', ['class' => 'btn btn-success', 'style'=>'width: 120px']) }}
		</center>

	@endif
	@if($accion == 'Ver')
		@can('permiso-borrar')
			{!! Form::open(['route' => ['tiempod.ver', $dato->id], 'method' => 'DELETE']) !!}
            	@if($dato->sis_esta_id == 1)
            		<button class="btn btn-danger">Inactivar</button>
            	@else
            		<button class="btn btn-success">Activar</button>
            	@endif
        	{!! Form::close() !!}
		@endcan
	@endif

</div>