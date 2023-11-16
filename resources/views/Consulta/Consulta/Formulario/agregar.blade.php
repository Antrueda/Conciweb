@extends('../mainUsrWeb')

@section('title','LISTADO DE DOCUMENTOS')
@section('content')

<style>

.scroll {
    max-height: 300px;
    overflow-y: auto;
}

</style>


<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
  <div class="card-header">
      <center>
        <b> SOLICITUD DE CONCILIACIÓN No. {{$dato->num_solicitud}}  DE {{$dato->vigencia}}</b> 
  </center>
  </div>
  <div class="container">
<div class="card-body">
  <div class="row">
    <div class="col-md-3">
      <b  style="color:#0171BD">Tipo de Documento</b></label>
      <p style="text-transform: uppercase">{{$tipodedocumento}}</p>
    </div>
    <div class="col-md-3">
      <b  style="color:#0171BD">Número de Documento</b></label>
      <p style="text-transform: uppercase">{{$dato->id_usuario_reg}}</p>
    </div>
    <div class="col-md-3">
     <b  style="color:#0171BD">Solicitante</b></label>
      <p style="text-transform: uppercase"> {{$nombrecompleto}}</p>
    </div>
    <div class="col-md-3">
     <b  style="color:#0171BD">Fecha de Solicitud</b> <b  style="color:#0171BD;font-size:80%">(dd/mm/yyyy)</b></label>
     <p style="text-transform: uppercase"> {{$newDate}}</p>
    </div>
    <div class="col-md-3">
     <b  style="color:#0171BD">Asuntos</b></label>
      <p style="text-transform: uppercase"> {{$dato->asuntos->nombre}}</p>
    </div>
    <div class="col-md-6">
    <b  style="color:#0171BD">Sub Asunto</b>
      <p style="text-transform: uppercase"> {{$dato->subasuntos->nombre}}</p>
    </div>
    <div class="col-md-3">
      <b style="color:#0171BD" >Cuantía</b>
      <p style="text-transform: uppercase">$ {{$numero}}</p>
    </div>
    <div class="col-md-3">
      <b style="color:#0171BD" >Correo Electrónico</b>
      <p style="text-transform: lowercase">{{$dato->email}}</p>
    </div>
  </div>


  </div>



{{--       
  <ul class="list-group list-group-horizontal">
    
    <li class="list-group-item"><b>Solicitante: <br> </b> {{$nombrecompleto}} </li>
    <li class="list-group-item"><b>Fecha de Solicitud:</b><br> {{$dato->fec_solicitud_tramite}} </li>
    <li class="list-group-item"><b>Asunto:</b> <br>{{$dato->asuntos->nombre}} </li>
    <li class="list-group-item"><b>Sub Asunto:</b><br> {{$dato->subasuntos->nombre}}</li>
    <li class="list-group-item"><b>Cuantia:</b> <br> {{$dato->cuantia}}</li>
  </ul> --}}
  <hr style="color:#0171BD">
    <ul class="list-group list-group-flush">
    <li class="list-group-item"><b style="color:#0171BD">Resumen de la pretensión o conflicto:</b><p> {{$dato->detalle}}</p></li>
  </ul>
</div>
</div>
<br>
@if($tiposolicitud==1)
<div class="card " style="padding-top: 3px; padding-bottom: 3px;">

  <div class="card-header" style="text-align-last: center;">
    <div class="row justify-content-md-center">
   
 

      <div class="form-check form-switch form-check-reverse" >
        <input class="form-check-input" type="checkbox" role="switch" id="apoderado" style="
        margin-right: 1px
        padding-top: 1px;">
        <label class="form-check-label" style="padding-left: 35px;" for="apoderado">     <b>DATOS DEL APODERADO </b></label>
      </div>
    </div>

  </div>
  <div class="container" >
<div class="card-body" id="divapoderado">
  <div class="row"  >
    <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">Tipo de Documento</b></label>
      <p style="text-transform: uppercase">{{$tipodedocapoderado}}</p>
    </div>
    <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">Número de Documento</b></label>
      <p style="text-transform: uppercase">{{$dato->numdocapoderado}}</p>
    </div>
    <div class="col-md-4 mt-2">
     <b  style="color:#0171BD">Nombre Apoderado</b></label>
      <p style="text-transform: uppercase"> {{$apoderado}}</p>
    </div>
    <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">No. Tarjeta Profesional</b></label>
       <p style="text-transform: uppercase"> {{$dato->tarjetaprofesional}}</p>
     </div>
     <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">Dirección</b></label>
       <p style="text-transform: uppercase"> {{$dato->direccionapoderado}}</p>
     </div>
     <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">Teléfono Celular</b></label>
       <p style="text-transform: uppercase"> {{$dato->primertelefonoapoderado}}</p>
     </div>
     <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">Teléfono Fijo</b></label>
       <p style="text-transform: uppercase"> {{$dato->segundotelefonoapoderado}}</p>
     </div>
     <div class="col-md-4 mt-2">
      <b  style="color:#0171BD">Correo Electrónico</b></label>
       <p style="text-transform: lowercase"> {{$dato->emailapoderado}}</p>
     </div>



  </div>


  </div>
</div>
</div>
@endif
<br>
<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
  <div class="card-header" style="text-align-last: center;">
    <div class="row justify-content-md-center">
      <div class="form-check form-switch form-check-reverse" >
        <input class="form-check-input" type="checkbox" role="switch" id="convocado" style="
        margin-right: 1px
        padding-top: 1px;">
        <label class="form-check-label" style="padding-left: 35px;" for="convocado">     <b>DATOS DE CONVOCADOS </b></label>
      </div>
    </div>

  </div>

  <div class="container">
    <div class="card-body scroll" id="divconvocado">

    <div class="row" style="margin-right: 12px;
    margin-left: 23px;" >
      @foreach ($data['convocates'] as $info)
      
      
      <div class="col-md-6 mt-2 pt-10" style="
          border: 1px solid #F0F8FF;
          border-radius: 7px / 7px;
          padding: 8px 30px;
          text-align: left;" >
        <b  style="color:#0171BD">Nombre Convocado (Correo Electrónico)</b></label>
        <p style="text-transform: uppercase">{!! $info->nomconvocante . ' ' . $info->apeconvocante !!} <br><span style="text-transform: lowercase"> ({!! $info->emailconvocante  !!}) </span></p>
      </div>
 
      @endforeach 
  </div>
  
</div>



</div>
</div>





<br>

{{-- <center>
  <a href=""class="btn btn-danger mb-3">
    <i class="fas fa-file-pdf bg-danger"></i> 
     Cerrar</a>
    </center> --}}

  
<br>


{{-- 
<div class="row">
    @foreach($tramite as $archivo)

    <div class="col-12">

      <div class="row">
    
          <div class="col-sm-9">
    
            <p class="mb-0">  {{ $archivo->descripcion }}</p>
    
          </div>
    
          <div class="col-sm-3">
    
            <a href="{{ route('documentos.download', $archivo->id) }}"class="btn btn-outline-success mb-3">
              <i class="fas fa-file-pdf bg-danger"></i> 
               Descargar</a>
          </div>
    
      </div>
    
 
    
    </div>
     
    <hr>
    <br>
    @endforeach
  </div> --}}
<center>
  <a href="{{route('consultac') }}" class="btn btn-success" >Volver</a>
    </center>

<script>
            
            $("#divapoderado").hide();
        $("#apoderado").change(function() {
        if ($("#apoderado").is(':checked')) {
            $("#divapoderado").slideDown();
            
        } else {
            $("#divapoderado").slideUp();
        }
          });
            $("#divconvocado").hide();
        $("#convocado").change(function() {
        if ($("#convocado").is(':checked')) {
            $("#divconvocado").slideDown();
            
        } else {
            $("#divconvocado").slideUp();
        }
          });

</script>
@endsection
