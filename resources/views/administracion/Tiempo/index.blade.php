@extends('../mainUsrWeb')

@section('content')
<div class="content-header">
	<h1>Documento Soporte</h1>
	<hr>
</div>
@if(!isset($accion))
  	@include('administracion.Tiempo.datos')
@else
	@include('administracion.Tiempo.formulario')
@endif
@endsection