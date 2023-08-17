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
     <b  style="color:#0171BD">Fecha de Solicitud</b> <b  style="color:#0171BD;font-size:80%">(dd-mm-yyyy)</b></label>
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
      <p style="text-transform: uppercase">{{$dato->email}}</p>
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
       <p style="text-transform: uppercase"> {{$dato->emailapoderado}}</p>
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
          text-align: justify;" >
        <b  style="color:#0171BD">Nombre Convocado (Correo Electrónico)</b></label>
        <p style="text-transform: uppercase">{!! $info->nomconvocante . ' ' . $info->apeconvocante !!} <span style="text-transform: lowercase"> ({!! $info->emailconvocante  !!}) </span></p>
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

    <div class="card">

      <div class="card-body"> 
        <b style="color:#0171BD">Documentos anexados a la solicitud No. {{$dato->num_solicitud}} de {{$dato->vigencia}}</b>
      </center>
        <div class="table-responsive">
          <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
            <thead>
              <tr style=" text-align: center;">
                <th scope="col"></th>
                <th scope="col"></th>
                
              </tr>
            </thead>
            <tbody>
    
       
      
    
          
    
              @foreach($tramite as $archivo)
              <tr style=" text-align: left;" class="input-file">
           
                  <td style="text-justify;width:80%;vertical-align: middle;" >{!! $archivo->descripcion !!}</td>
                <td style="text-justify;width:40%;padding-left: 40px;padding-top: 25px;"><a href="{{ route('documentos.download', $archivo->id) }}"class="btn btn-success mb-3">
               <span class="px-2"> <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filetype-pdf me-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                  </svg> Descargar</span>  </a></td>
                
      
             
          
             
              
              </tr>
              @endforeach 
          
            </tbody>
          </table>
        </div>
      </div>
    </div>
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
  <a href="{{ route('logout', $archivo->id) }}"class="btn btn-outline-danger mb-3">
    
     Cerrar</a>
     {{-- <a href="{{ route('imprimir', $archivo->num_solicitud) }}"class="btn btn-outline-danger mb-3">
    
      Imprimir</a> --}}
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
