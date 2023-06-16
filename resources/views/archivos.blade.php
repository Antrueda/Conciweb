@extends('../mainUsrWeb')

@section('content')

<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Solicitante</th>
          <th scope="col">Numero de Solicitud</th>
          <th scope="col">Fecha de Solicitud</th>
          <th scope="col">Asunto</th>
          <th scope="col">Sub Asunto</th>
          <th scope="col">Cuantia</th>
        </tr>
      </thead>
      <tbody>
        <tr>
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

<h1>Lista de Archivos</h1>
<div class="row">
    @foreach($tramite as $archivo)

    <div class="col-12">

      <div class="row">
    
          <div class="col-sm-9">
    
            <p class="mb-0">  {{ $archivo->descripcion }}</p>
    
          </div>
    
          <div class="col-sm-3">
    
            <a href="{{ route('documentos.download', $archivo->id) }}"class="btn btn-success mb-3">
              <i class="fas fa-file-pdf bg-danger"></i> 
               Descargar</a>
          </div>
    
      </div>
    
 
    
    </div>
     
    <hr>
    <br>
    @endforeach
  </div>

      
        


@endsection
