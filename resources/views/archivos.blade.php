@extends('../mainUsrWeb')

@section('title','LISTADO DE ARCHIVOS')
@section('content')

<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr style=" text-align: center;">
          <th scope="col">Numero de Documento</th>
          <th scope="col">Solicitante</th>
          <th scope="col">Numero de Solicitud</th>
          <th scope="col">Fecha de Solicitud</th>
          <th scope="col">Asunto</th>
          <th scope="col">Sub Asunto</th>
          <th scope="col">Cuantia</th>
        </tr>
      </thead>
      <tbody>
        <tr style=" text-align: center;">
          <th>{{$dato->id_usuario_reg}}</th>
          <th style="text-transform: uppercase"> {{$nombrecompleto}}</th>
          
          <th>{{$dato->num_solicitud}}</th>
          <td>{{$dato->fec_solicitud_tramite}}</td>
          <td>{{$dato->asuntos->nombre}}</td>
          <td>{{$dato->subasuntos->nombre}}</td>
          <td>{{$numero}}</td>
        </tr>
      </tbody>
    </table>
  </div>
<center>
<h1>Lista de Archivos</h1>
</center>
{{-- <center>
  <a href=""class="btn btn-danger mb-3">
    <i class="fas fa-file-pdf bg-danger"></i> 
     Cerrar</a>
    </center> --}}
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
  </div>
<center>
  <a href="{{ route('logout', $archivo->id) }}"class="btn btn-outline-danger mb-3">
    
     Cerrar</a>
    </center>


@endsection
