
@extends('../mainAdmin')

@section('title','VER SOLICITUD')

@section('AddScritpHeader')

@endsection

@section('content')


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
                  <td>{{$dato->fec_solicitud_tramite}}</td>
                  <td>{{$dato->asuntos->nombre}}</td>
                  <td>{{$dato->subasuntos->nombre}}</td>
                  <td>{{$numero}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <hr>
        <div class="row">
         <ul>
          @foreach ($data['adjuntos'] as $info)
          <div class="row input-file">
            
          
            <div class="col-md-6">
            <span style="text-justify">{!! $info->descripcion !!} *</span>
                <div style="display:none">
                <input type="text" class="form-control" name="descripcion[]" id="descripcion"/> 
              </div>
            </div>
            <div class="col-md-6">
          <div class>
            {{-- <a href="{{asset($info->rutafinalfile)}}" target="_blank" class="btn btn-info" > Ver PDF <i class="fas fa-file-pdf"></i></a> --}}
             <a href="{{route('consultac.archivo', ['id'=>$info->id]) }}"  target="_blank"  class="btn btn-info" > Descargar <i class="fas fa-file-pdf"></i></a> 
        
          
          </div>
        </div>
        </div>

      
         
     
         

 
  <br>

      @endforeach
    </ul>
        </div>
            <br>

          <center>
            <div class="row">
              <div style="align-content: center;">
                <a href="{{route('consultac') }}" class="btn btn-success" >Volver</a>
              </div>

            </div>
          </center>
      </div>
      </small>
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