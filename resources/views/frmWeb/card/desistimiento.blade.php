
@extends('../Modal')

@section('title','ADJUNTAR ARCHIVOS')

@section('AddScritpHeader')

@endsection

@section('content')
<link rel="stylesheet" href="{{URL::asset('css/validationEngine.jquery.css')}}" />
<script src="{{URL::asset('js/jquery.validationEngine.js')}}"></script>
<script src="{{URL::asset('js/jquery.validationEngine-es.js')}}"></script>

{!! Form::open(['route' => ['cambioestado',$dato->num_solicitud],'class' => 'form-horizontal','name' => 'desistimiento','id' => 'desistimiento']) !!}

<div class="row">
  <div class="col-md-12">
    <div class="card" role="alert">
      <small class="text-justify">
        <div class="card-body">
        <div class="row">
          <div class="col-md-11">
      
          </div>
 
        </div>
       
        <div class="row justify-content-md" >
            <div class="col-md-12">
              <p>Confirmo el <b style="text-transform: uppercase">desistimiento</b> de la solicitud de conciliación vía web No. <b>{{$dato->num_solicitud}} </b>   registrada </p> <p> el día {{$newDate}}.</p>
            </div>
            <div class="col-md-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="checks" style="margin-left: 30px;"  >
              <label style="padding-top: 5px;" class="form-check-label" for="checks">Acepto</label>
              <div style="display: none">
                <input type="text" class="form-control form-control-sm validate"  name="desistir" id="desistir" autocomplete="off" placeholder="0" required value="Remitido">
              </div>
            </div>
          </div>
          </div>
    
          
            
      
          
      
        
            <br>
            <div class="row" id="divobserva">
              <div class="col-md-12">
                  <div class="form-floating mb-3">
                      <textarea class="form-control form-control-sm validate[required, maxSize[1000]]" name="observaciones" id="observaciones" placeholder="Resumen"  maxlength="1000"  style="height: 124px;" required></textarea>
                      <label for="detalle"> Observaciones*</label>
                      <span id="chars"> </span>
                      </div>
   
              </div>
          </div>

            <div class="modal-footer" style="justify-content: center;">
          
              <div class="row" id="botondiv">
              <button type="" class="btn btn-success" id="btnRegistro"  > Si, confirmo desistimiento   <i class="far fa-check-circle"></i></button>
            </div>
              {{-- <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> No, confirmo el desistimiento.     <i class="far fa-times-circle"></i></button> --}}
       
            </div>
          </div>
      
      </div>
      </small>
    </div>
  </div>
</div>

{!! Form::close() !!}

@endsection
{{-- <div class="form-check">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="checks"                >
                  <label class="form-check-label" for="checks">Acepto</label>
                  
                  <div style="display: none">
                  <input type="text" class="form-control form-control-sm validate"  name="desistir" id="desistir" autocomplete="off" placeholder="0" required value="Remitido">
                </div>
           
                </div> --}}
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
        $("#divobserva").hide();
        $("#botondiv").hide();

        $("#desistimiento").validationEngine('attach', {
            onValidationComplete: function(form, status) {

                if (status === true) {
                    registroDatos();
                } else {
                    llamarNotyFaltanDatosFrm();
                    return;
                }
            }
        });
    
      

      function registroDatos() {
        var formData = new FormData(document.getElementById("desistimiento"));
        formData.append("dato", "valor");
        $.ajax({
            type: "POST",
            url: "Cambioestado/{{$id}}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                llamarNotyCarga();
                $("#btnRegistro").hide();
                $('#btnRegistro').prop('disabled', false);
            },
            success: function(r) {
                var datUsr = r.split("|");
                var valor = datUsr[1];
                var msg = datUsr[2];
                if (valor == 0) {
                    var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error', msg, 'topRight', 3000);
                    $("#btnRegistro").show();
                    $('#btnRegistro').prop('disabled', false);
                } else {
                    $("#btnRegistro").show();
                    $('#btnRegistro').prop('disabled', false);
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer: true,
                        progressBar: true,
                        timeout: 10000,
                        callbacks: {
                            afterClose: function() {
                                window.location.href = "https://www.personeriabogota.gov.co/";
                            },
                        }
                    }).show();
                }
            },
            error: (err) => {
                var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
                llamarNotyTime('error', msg, 'topRight', 3000);
                $("#btnRegistro").show();
                $('#btnRegistro').prop('disabled', false);
            }
        });
    }



        $("#checks").change(function() {
        if ($("#checks").is(':checked')) {
            $("#desistir").val('Finalizado');
            $("#divobserva").slideDown();
            $("#botondiv").slideDown();
            
        } else {
            $("#desistir").val('Remitido');
            $("#divobserva").slideUp();
            $("#botondiv").slideUp();
        }
          });

</script>
