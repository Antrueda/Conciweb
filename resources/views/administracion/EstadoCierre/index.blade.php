@extends('../mainUsrWeb')

@section('content')
<div class="content-header">
	<h1>Estado del Formulario</h1>
	<hr>
</div>
@if(!isset($accion))
  	@include('administracion.EstadoCierre.datos')
@else
	@include('administracion.EstadoCierre.formulario')
@endif
@endsection