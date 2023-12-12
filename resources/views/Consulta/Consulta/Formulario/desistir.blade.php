
@extends('../modal')

@section('title','VER SOLICITUD')

@section('AddScritpHeader')

@endsection

@section('content')

<br><p style="width:90%;margin:auto;" class="alert alert-warning"><i class="fa-solid fa-triangle-exclamation fa-2xl"></i><span style="padding:8px;font-size: 1.2rem;"> Se realizo desistimiento a la Solicitud de Conciliación </span></p>;
<div class="row">
  <div class="col-md-12">
    <div class="card" role="alert">
      <small class="text-justify">
        <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Solicitante</th>
                  <th scope="col">Fecha de Solicitud</th>
                  <th scope="col">Asunto</th>
                  <th scope="col">Sub Asunto</th>
                  <th scope="col">Cuantia</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th style="text-transform: uppercase"> {{$nombrecompleto}}</th>
                  <td>{{$data->fec_solicitud_tramite}}</td>
                  <td>{{$data->asuntos->nombre}}</td>
                  <td>{{$data->subasuntos->nombre}}</td>
                  <td>{{$numero}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <hr>

            <br>


      </div>
      </small>
      <center>
        <a href="{{ route('consultac.verificar',[$data->num_solicitud$vigencia]) }}"class="btn btn-outline-danger mb-3">
          
           Ver Detallado</a>
           {{-- <a href="{{ route('imprimir', $archivo->num_solicitud) }}"class="btn btn-outline-danger mb-3">
          
            Imprimir</a> --}}
          </center>
    </div>
  </div>
</div>


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