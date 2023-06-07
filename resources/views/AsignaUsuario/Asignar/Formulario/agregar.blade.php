
@extends('../Modal')

@section('title','ADJUNTAR ARCHIVOS')

@section('AddScritpHeader')

@endsection

@section('content')
{!! Form::open(['route' => ['asignafun.asignar',$dato->cedula],'class' => 'form-horizontal']) !!}

<div class="row">
  <div class="col-md-12">
    <div class="card" role="alert">
      <small class="text-justify">
        <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <b>Agregar usuario</b>
          </div>
    
        </div>
        <hr>
        <div class="row">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Cedula</th>
                  <th scope="col"> {{$dato->cedula}}</th>
                </tr>
                <tr>
                <th scope="col">Nombre Completo</th>
                <th scope="col">{{$dato->nombre}} {{$dato->apellido}}</th>
              </tr>
              <tr>
              <th scope="col">Correo</th>
              <th scope="col">{{$dato->email}}</th>
            </tr>
              <tr>
              <th scope="col">Estado</th>
              <th scope="col">{{$dato->estado}}</th>
            </tr>
              </thead>
            
            </table>
          </div>
            <div class="col-md-12">
              <b>¿Desea recibir correo?</b>
                <select class="form-control form-control-sm custom-select" name="correo" id="correo" required>
                <option value=" ">- Seleccione una opcion -</option>
                <option value=1>Si</option>
                <option value=0>No</option>
            </select>
      
          </div>
        </div>
            <br>

          <center>
            <div class="row">
              <div style="align-content: center;">
                {{ Form::submit('Agregar', ['class' => 'btn btn-success' ]) }}
              </div>

            </div>
          </center>
      </div>
      </small>
    </div>
  </div>
</div>

{!! Form::close() !!}
<br>
@endsection

@section('AddScriptFooter')
<script>

(function($) {
            $.fn.extend( {
                limiter: function(limit, elem) {
                    $(this).on("keyup focus", function() {
                        setCount(this, elem);
                    });
                    function setCount(src, elem) {
                        var chars = src.value.length;
                        if (chars > limit) {
                            src.value = src.value.substr(0, limit);
                            chars = limit;
                        }
                        elem.html( chars+"/1000" );
                    }
                    setCount($(this)[0], elem);
                }
            });
        })(jQuery);
        var elem = $("#chars");
        $("#observaciones").limiter(1000, elem);
</script>