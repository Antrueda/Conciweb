  <div class="card text-left">
    <div class="card-header">
      <h1 style="text-align: center"><strong>{{ $todoxxxx["tituloxx"] }}</strong> </h1>
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      {!! Form::model($todoxxxx['modeloxx'],[route($todoxxxx["routxxxx"].'.editar',
      $todoxxxx["parametr"]),'method'=>'PUT','id'=>"formulario"
      ,'enctype'=>"multipart/form-data"]) !!}
        
        @include($todoxxxx["formular"])
        <br>
        @include($todoxxxx["botonesx"])
        <br>
      {!! Form::close() !!}
    </div>
  </div>


