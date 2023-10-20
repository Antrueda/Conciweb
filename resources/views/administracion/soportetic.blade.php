@extends('../mainUsrWeb')
@section('title','DATOS INCOMPLETOS')
@section('content')



        
      

        <div class="card text-center shadow rounded-3">
            <div class="card-body">
              <strong><h5 class="card-title fw-bold">EL ARCHIVO <b style="text-transform: uppercase">{{$documento->descripcion}}</b> DE LA SOLICITUD NO. <B>{{$documento->num_solicitud}}</b></B> PRESENTA DIFICULTADES PARA SU DESCARGA, POR FAVOR COMUNICARSE CON LA DIRECCIÓN DE TICS.</h5></strong>
              
              <hr>
              
            </div>
        </div>
    




@endsection
