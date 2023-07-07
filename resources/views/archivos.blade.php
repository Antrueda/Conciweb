@extends('../mainUsrWeb')

@section('title','LISTADO DE DOCUMENTOS')
@section('content')

<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
  <div class="card-header">
      <center>
      <b>DATOS DE LA SOLICITUD</b>
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
      <p style="text-transform: uppercase"> {{$numero}}</p>
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
@if($tiposolicitud==1)
<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
  <div class="card-header">
      <center>
      <b>DATOS DEL APODERADO</b>
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
     <b  style="color:#0171BD">Nombre Apoderado</b></label>
      <p style="text-transform: uppercase"> {{$apoderado}}</p>
    </div>



  </div>


  </div>
</div>
</div>
@endif

<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
  <div class="card-header">
      <center>
      <b>DATOS DE CONVOCADOS</b>
  </center>
  </div>
  <div class="container">
<div class="card-body">
  <div class="row">
    <div class="row">
      @foreach ($data['convocates'] as $info)
      <div class="col-md-3">
        <b  style="color:#0171BD">Nombre Completo</b></label>
        <p style="text-transform: uppercase">{!! $info->nomconvocante . ' ' . $info->apeconvocante !!}</p>
      </div>
        <div class="col-md-3">
          <b  style="color:#0171BD">Correo</b></label>
        <p style="text-transform: uppercase">{!! $info->emailconvocante  !!}</p>
          </div>
     
      @endforeach 



  </div>


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
        <b style="color:#0171BD">Documentos anexados a la solicitud</b>
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
                  <i class="fas fa-file-pdf bg-danger"></i><span class="px-2"> Descargar</span>  </a></td>
                
      
             
          
             
              
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
    </center>


@endsection
