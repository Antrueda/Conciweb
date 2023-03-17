@extends('../mainUsrWeb')

@section('content')
<div class="content-header">
	<h1>Salario Minimo</h1>
	<hr>
</div>
@if(!isset($accion))
  	@include('administracion.salario.datos')
@else
	@include('administracion.salario.formulario')
@endif
@endsection