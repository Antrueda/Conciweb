

<div class=" row">
	<div class="col-sm-2">
	{{ Form::label('horainicio', 'Hora Inicio:', ['class' => 'control-label col-form-label-sm']) }}
	{{ Form::time('horainicio', $dato->horainicio, ['class' => $errors->first('horainicio') ? 'form-control form-control-sm is-invalid ' :'form-control form-control-sm ']) }}
	@if($errors->has('horainicio'))
	<div class="invalid-feedback d-block">
		{{ $errors->first('horainicio') }}
	</div>
	@endif
</div>

	<div class="col-md-2">
		{{ Form::label('horacierre', 'Hora Cierre:', ['class' => 'control-label col-form-label-sm']) }}
		{{ Form::time('horacierre', $dato->horacierre, ['class' => $errors->first('horacierre') ? 'form-control form-control-sm is-invalid ' :'form-control form-control-sm ']) }}
		@if($errors->has('horacierre'))
		<div class="invalid-feedback d-block">
			{{ $errors->first('horacierre') }}
		</div>
		@endif
	</div>
	{{-- <div class="col-md-4">
	<label class="form-check-label" >
		@if(!isset($todoxxxx['modeloxx']))
		<input class="form-check-input" type="checkbox" name="cierrese" value=""> Horario de cierre
		@else
		<input type="checkbox" name="cierrese" id="cierrese" value="{{ $dato->cierrese }}" {{ in_array($dato->cierrese,$todoxxxx['planesxx']) ? 'checked' : '' }}> Horario de cierre
		@endif
	</label>
	</div> --}}

	<div class="col-md-3">
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" id="checks" style="margin-left: 30px;"  >
		  <label style="padding-top: 5px;" class="form-check-label" for="checks">Horario de cierre</label>
		  <div style="display: none">
			<input type="text" class="form-control form-control-sm validate"  name="cierrese" id="cierrese" autocomplete="off" placeholder="0" required value=0>
		  </div>
		</div>
	  </div>
</div>



<div class="form-group col-md-12">
	{{ Form::label('texto', 'Descripción:', ['class' => 'control-label col-form-label-sm']) }}
	{{ Form::textarea('texto', $mensaje->texto, ['class' => $errors->first('texto') ? 'form-control form-control-sm is-invalid contarcaracteres' :'form-control form-control-sm contarcaracteres ckeditor']) }}
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
	@if($accion == 'Editarcierre')

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
<script>
	 $("#cierrese").change(function() {
        if ($("#cierrese").is(':checked')) {
		
            $("#cierrese").val(1);
          
            
        } else {
            $("#cierrese").val(0);
        
        }
          });
</script>