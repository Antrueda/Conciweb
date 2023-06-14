@extends('../mainUsrWeb')

@section('content')
<h1>Lista de Archivos</h1>
<ul>
    @foreach($tramite as $archivo)
        <li>
            {{ $archivo->descripcion }}
            
            <a href="{{asset($archivo->rutafinalfile)}}"  class="btn btn-info" > Ver PDF <i class="fas fa-file-pdf"></i></a>
            <a href="{{ route('documentos.download', $archivo->id) }}"   class="btn btn-info" > Descargar <i class="fas fa-file-pdf"></i></a> 
        </li>
        <br>
    @endforeach
</ul>
@endsection
