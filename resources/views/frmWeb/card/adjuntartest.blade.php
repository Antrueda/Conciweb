
@extends('../Modal')

@section('title','ADJUNTAR ARCHIVOS')

@section('AddScritpHeader')

@endsection

@section('content')
{!! Form::open(['route' => ['cargararchivos',$dato->num_solicitud],'class' => 'form-horizontal', 'enctype'=>"multipart/form-data"]) !!}
<div>
  <div class="card" style="padding-top: 3px; padding-bottom: 3px;">
    <div class="card-header">
        <center>
        <b>DATOS DE LA SOLICITUD</b>
    </center>
    </div>
    <ul class="list-group list-group-horizontal">
      
      <li class="list-group-item"><b>Solicitante: <br> </b> {{$nombrecompleto}} </li>
      <li class="list-group-item"><b>Fecha de Solicitud:</b><br> {{$dato->fec_solicitud_tramite}} </li>
      <li class="list-group-item"><b>Asunto:</b> <br>{{$dato->asuntos->nombre}} </li>
      <li class="list-group-item"><b>Sub Asunto:</b><br> {{$dato->subasuntos->nombre}}</li>
      <li class="list-group-item"><b>Cuantia:</b> <br> {{$dato->cuantia}}</li>
    </ul>
      <ul class="list-group list-group-flush">
      <li class="list-group-item"><b>Resumen de la pretensión o conflicto:</b><p> {{$dato->detalle}}</p></li>
    </ul>
  </div>
</div>
<br>

@foreach ($data['detalleAbc'] as $info)

<li>
  <div class="container text-left">
    <div class="row">
      <div class="col-5 texto">
      <span style="text-justify">{!! $info->descripcion->nombre !!} *</span>
      </div>
    <div style="display:none">
    <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="{!! $info->descripcion->nombre !!}"/> 
    </div>
    <div class="col-5 archivo">
      <input type="file" class="validate[required] form-control" name="document1[]"   accept=".pdf"/>
      <button class="btn btn-danger btn-reset" style="margin-left: 10px;" id="limpia" type="button"> <i class="fas fa-broom"></i></button>
    </div>

    </div>
      <div id="my_pdf_viewer">

      </div>
  </div>
</li>
<br>

@endforeach

<li>
  <div class="container text-left" >
    <div class="row">
      <div class="col-5">
      <span style="text-justify">Documentos que complementen su solicitud </span>
    </div>
    <div style="display:none">
    <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="Documentos que complementen su solicitud"/> 
    </div>
    <div class="col-5 archivo">
     <input type="file" class="validate[required] form-control" name="document1[]"   accept=".pdf"/>
     <button class="btn btn-danger btn-reset" style="margin-left: 10px;" id="limpia" type="button"> <i class="fas fa-broom"></i></button>
    </div>
  </div>
      <div id="my_pdf_viewer">

      </div>
 
</div>

</li>
<div class="row">
  
  
            <div class="row">
              <div class="col-md-4" style="align-content: center;">
                {{ Form::submit('Actualizar', ['class' => 'btn btn-primary' ]) }}
              </div>

            </div>
            
      </div>
 

{!! Form::close() !!}
<br>
@endsection

@section('AddScriptFooter')
<script>


</script>