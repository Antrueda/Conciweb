  <div class="card text-left">
    <div class="card-header">
      
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>
      {!! Form::model($todoxxxx['modeloxx'],[route($todoxxxx["routxxxx"].'.editar',
      $todoxxxx["parametr"]),'method'=>'PUT','id'=>"formulario"
      ,'enctype'=>"multipart/form-data"]) !!}
        
        @include($todoxxxx["formular"])
        @include($todoxxxx["botonesx"])
      {!! Form::close() !!}
    </div>
  </div>


