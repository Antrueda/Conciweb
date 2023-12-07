<div class="card text-left">
  <div class="card-header">
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('reportes.general') }}" >General</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('reportes.finalizado') }}" >Finalizados</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('reportes.dias') }}" >Días</a>
      </li>

    </ul>
  </div>
  <div class="card-body">
    
    <h5 class="card-title"></h5>
    <form method = "POST" id="formulario" action= "{{route($todoxxxx['routxxxx'].'.generate-excel', $todoxxxx['parametr'])}}"
    enctype="multipart/form-data">
      @csrf
        @include($todoxxxx["formular"])
    {!!Form::close()!!}
  </div>
</div>
