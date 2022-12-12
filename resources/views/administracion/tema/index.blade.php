@extends('../mainUsrWeb')

@section('content')
<div class="content-header">
	<h1>Temas</h1>
	<hr>
</div>
@if(!isset($accion))
  	@include('administracion.tema.datos')
@else
	@include('administracion.tema.formulario')
@endif
@endsection