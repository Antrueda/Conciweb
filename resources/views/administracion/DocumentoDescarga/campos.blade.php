
<div class="input-group mb-3">
	<input type="file" class="form-control" name="document1" id="document1" aria-label="Upload" />
</div>
<br>
<div class="row">
	@if($accion == 'Nuevo')
		@can('permiso-crear')
		<center>
			{{ Form::submit('Guardar', ['class' => 'btn btn-success','style'=>'width: 120px']) }}
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
			{!! Form::open(['route' => ['documentd.ver', $dato->id], 'method' => 'DELETE']) !!}
            	@if($dato->sis_esta_id == 1)
            		<button class="btn btn-danger">Inactivar</button>
            	@else
            		<button class="btn btn-success">Activar</button>
            	@endif
        	{!! Form::close() !!}
		@endcan
	@endif

</div>