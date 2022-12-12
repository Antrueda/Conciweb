
@extends('../mainUsrWeb')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

<div class="card mb-3">
    <div class="row no-gutters">
      <div class="col-md-4">
          <br><br>
        <img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><b>Error en la solicitud</b></h5><hr>
          <p class="card-text text-justify">El actual número de petición conciliación web. No cuenta con una solicitud pendiente para aclaración de datos.</p>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('AddScriptFooter')

@endsection