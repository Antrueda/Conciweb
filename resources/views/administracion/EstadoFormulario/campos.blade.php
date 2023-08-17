<div class="form-group row{{ $errors->first('nombre') ? ' is-invalid' : '' }}">
	{{ Form::label('Estado', 'Estado:', ['class' => 'col-sm-2 col-form-label']) }}
	<div class="col-sm-10">
		@if($accion == 'Ver')
			{{ Form::select('sis_esta_id', $estado, null, ['class' => $errors->first('sis_esta_id') ?
			'form-control select2 form-control-sm is-invalid cargos' : 'form-control select2 form-control-sm cargos',
			'data-placeholder' => 'Seleccione un estado']) }}
		@else
		{{ Form::select('sis_esta_id', $estado, null, ['class' => $errors->first('sis_esta_id') ?
		'form-control select2 form-control-sm is-invalid cargos' : 'form-control select2 form-control-sm cargos',
		'data-placeholder' => 'Seleccione un estado']) }}
		@endif
	</div>
	@if($errors->has('nombre'))
		<div class="invalid-feedback d-block">
        	{{ $errors->first('estado') }}
      	</div>
    @endif
</div>
<br>
<div class="form-group col-md-12">
	{{ Form::label('texto', 'Descripción:', ['class' => 'control-label col-form-label-sm']) }}
	{{ Form::textarea('texto', $dato->texto->texto, ['class' => $errors->first('texto') ? 'form-control form-control-sm is-invalid contarcaracteres' :'form-control form-control-sm contarcaracteres ckeditor']) }}
	@if($errors->has('texto'))
	<div class="invalid-feedback d-block">
		{{ $errors->first('texto') }}
	</div>
	@endif
</div>
<br>
<div class="row">
	@if($accion == 'Nuevo')
		@can('permiso-crear')
			{{ Form::submit('Guardar', ['class' => 'btn btn-success','style'=>'width: 120px']) }}
		@endcan
	@endif
	@if($accion == 'Editar')

		<center>
			{{ Form::submit('Modificar', ['class' => 'btn btn-success', 'style'=>'width: 120px']) }}
		</center>

	@endif
	@if($accion == 'Ver')
		@can('permiso-borrar')
			{!! Form::open(['route' => ['estadoform.ver', $dato->id], 'method' => 'DELETE']) !!}
            	@if($dato->sis_esta_id == 1)
            		<button class="btn btn-danger">Inactivar</button>
            	@else
            		<button class="btn btn-success">Activar</button>
            	@endif
        	{!! Form::close() !!}
		@endcan
	@endif

</div>