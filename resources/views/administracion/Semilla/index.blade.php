@extends('../mainUsrWeb')

@section('content')
<div class="content-header">
	<h1>Semilla</h1>
	<hr>
</div>
@if(!isset($accion))
  	@include('administracion.Semilla.datos')
@else
	@include('administracion.Semilla.formulario')
@endif
@endsection