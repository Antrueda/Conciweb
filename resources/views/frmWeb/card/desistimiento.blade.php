
@extends('../Modal')

@section('title','ADJUNTAR ARCHIVOS')

@section('AddScritpHeader')

@endsection

@section('content')
{!! Form::open(['route' => ['cambioestado',$dato->num_solicitud],'class' => 'form-horizontal']) !!}

<div class="row">
  <div class="col-md-12">
    <div class="card" role="alert">
      <small class="text-justify">
        <div class="card-body">
        <div class="row">
          <div class="col-md-11">
            <b>¿Desea realizar el desistimiento de la solicitud de concilación?</b>
          </div>
          <div class="col-md-1">
          </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
        
              <select class="form-control form-control-sm custom-select" name="desistir" id="desistir" required>
                <option value=" ">- Seleccione una opcion -</option>
                <option value="Cancelado">Si</option>
                <option value="Remitido">No</option>
            </select>
      
          </div>
        </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                  <div class="form-floating mb-3">
                      <textarea class="form-control form-control-sm validate[required, maxSize[1000]]" name="observaciones" id="observaciones" placeholder="Resumen" required></textarea>
                      <label for="detalle"> Observaciones*</label>
                      <span id="chars"> </span>
                      </div>
   
              </div>
          </div>
          <center>
            <div class="row">
              <div style="align-content: center;">
                {{ Form::submit('Actualizar', ['class' => 'btn btn-outline-success' ]) }}
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