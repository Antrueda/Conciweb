
@extends('../Modal')

@section('title','ADJUNTAR ARCHIVOS')

@section('AddScritpHeader')

@endsection

@section('content')
{!! Form::open(['route' => ['cambioestado',$dato->num_solicitud],'class' => 'form-horizontal']) !!}

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" role="alert">
      <small class="text-justify">
        <div class="card-body">
        <div class="row">
          <div class="col-md-11">
            <b>¿Desea realizar el desistimiento de la solicitud de concilación?</b>
          </div>
          <div class="col-md-1">
          </div>
        </div>
        <hr>
            <div class="col-md-12">
              <select class="form-control form-control-sm custom-select" name="desistir" id="desistir" required>
                <option value=" ">- Seleccione una opcion -</option>
                <option value="Cancelado">Si</option>
                <option value="Remitido">No</option>
            </select>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4" style="align-content: center;">
                {{ Form::submit('Actualizar', ['class' => 'btn btn-primary' ]) }}
              </div>

            </div>
            
      </div>
      </small>
    </div>
  </div>
</div>

{!! Form::close() !!}
<br>
@endsection

@section('AddScriptFooter')