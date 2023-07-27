@extends('../mainUsrWeb')
@section('title','DATOS INCOMPLETOS')
@section('content')



        
      

        <div class="card text-center shadow rounded-3">
            <div class="card-body">
              <strong><h5 class="card-title fw-bold">LA SOLICITUD DE CONCILIACIÓN <b>NO. {{$dato->num_solicitud}} </b> DE <b>{{$dato->vigencia}} </b> NO HA FINALIZADO EL REGISTRO DE LOS SOPORTES EXIGIDOS POR CONCIWEB V2.</h5></strong>
              
              <hr>
              
            </div>
        </div>
    




@endsection
