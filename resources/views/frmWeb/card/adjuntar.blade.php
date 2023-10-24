
@extends('../mainUsrWeb')

@section('title','CONCIWEB')

@section('AddScritpHeader')

@endsection

@section('content')
{{-- 
  Nombre
  Fecha
  Asunto
  SubAsunto
  Cuantia
  Textarea
  
  --}}
  <style>
   .error{
            color:red;
        }
   .texto{
    display: flex;
}     

.scroll {
    max-height: 300px;
    overflow-y: auto;
}

   .archivo{
    display: flex;
    align-items: center;
    justify-content: center;
    
   }  
  .col-md-9 {
    border-right: 2px solid #0171BD;
}

      .trash {
      
       
        padding-right: 0px;
    padding-left: 14.5px;
    padding-bottom: 10px;
    }
    .trash .img-top {
        display: none;


        z-index: 5;
    }
    .trash:hover .img-top {
        display: inline-block;
    }
    .trash:hover .img-bot {
        display: none;
    }
   
</style>


  {{-- {!! Form::open(['route' => ['test',$dato->num_solicitud],'class' => 'form-horizontal','id'=>"adjuntarfomr",'name'=>"adjuntarfomr",'enctype'=>"multipart/form-data"]) !!} --}}
  {!! Form::open(['route' => ['cargararchivos',$dato->num_solicitud],'class' => 'form-horizontal', 'enctype'=>"multipart/form-data", 'id'=>"adjuntarfomr",'name'=>"adjuntarfomr" ]) !!}

  @csrf
  {{-- @if ($msg = Session::get('success'))
  <div class="alert alert-success">
      <strong>{{ $msg }}</strong>
  </div>
@endif

@if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif --}}
  

  <div class="card" style="padding-top: 3px; padding-bottom: 3px;">
    <div class="card-header">
        <center>
          <b> SOLICITUD DE CONCILIACIÓN No. {{$dato->num_solicitud}}  DE {{$dato->vigencia}}</b> 
    </center>
    </div>
    <div class="container">
  <div class="card-body">
    <div class="row">
      <div class="col-md-3">
        <b  style="color:#0171BD">Tipo de Documento</b></label>
        <p style="text-transform: uppercase">{{$tipodedocumento}}</p>
      </div>
      <div class="col-md-3">
      <b style="color:#0171BD">Número de Documento</b></label>
        <p style="text-transform: uppercase">{{$dato->id_usuario_reg}}</p>
      </div>
      <div class="col-md-3">
      <b style="color:#0171BD">Solicitante</b></label>
        <p style="text-transform: uppercase"> {{$nombrecompleto}}</p>
      </div>
      <div class="col-md-3">
        <b  style="color:#0171BD">Fecha de Solicitud</b> <b  style="color:#0171BD;font-size:80%">(dd/mm/yyyy)</b></label>
        <p style="text-transform: uppercase"> {{$newDate}}</p>
      </div>
      <div class="col-md-3">
      <b style="color:#0171BD">Asuntos</b></label>
        <p style="text-transform: uppercase"> {{$dato->asuntos->nombre}}</p>
      </div>
      <div class="col-md-6">
      <b style="color:#0171BD">Sub Asunto</b></label>
        <p style="text-transform: uppercase"> {{$dato->subasuntos->nombre}}</p>
      </div>
      <div class="col-md-3">
      <b style="color:#0171BD">Cuantía</b></label>
        <p style="text-transform: uppercase">$ {{$numero}}</p>
      </div>
      <div class="col-md-3">
        <b style="color:#0171BD" >Correo Electrónico</b>
        <p style="text-transform: lowercase">{{$dato->email}}</p>
      </div>
    </div>

       
    </div>




    <hr style="color:#0171BD">
      <ul class="list-group list-group-flush">
      <li class="list-group-item"><b style="color:#0171BD">Resumen de la pretensión o conflicto:</b><p style="text-transform: uppercase"> {{$dato->detalle}}</p></li>
    </ul>
  </div>
</div>
<br>
@if($tiposolicitud==1)
<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
    <div class="card-header" style="text-align-last: center;">
    <div class="row justify-content-md-center">
   
 

      <div class="form-check form-switch form-check-reverse" >
        <input class="form-check-input" type="checkbox" role="switch" id="apoderado" style="
        margin-right: 1px
        padding-top: 1px;">
        <label class="form-check-label" style="padding-left: 35px;" for="apoderado">     <b>DATOS DEL APODERADO </b></label>
      </div>
    </div>

  </div>
  <div class="container" >
<div class="card-body" id="divapoderado">
  <div class="row">
    <div class="col-md-3">
      <b  style="color:#0171BD">Tipo de Documento</b></label>
      <p style="text-transform: uppercase">{{$tipodedocapoderado}}</p>
    </div>
    <div class="col-md-3">
      <b  style="color:#0171BD">Número de Documento</b></label>
      <p style="text-transform: uppercase">{{$dato->numdocapoderado}}</p>
    </div>
    <div class="col-md-3">
     <b  style="color:#0171BD">Nombre Apoderado</b></label>
      <p style="text-transform: uppercase"> {{$apoderado}}</p>
    </div>
    <div class="col-md-3">
      <b  style="color:#0171BD">No. Tarjeta Profesional</b></label>
       <p style="text-transform: uppercase"> {{$dato->tarjetaprofesional}}</p>
     </div>
     <div class="col-md-3">
      <b  style="color:#0171BD">Dirección</b></label>
       <p style="text-transform: uppercase"> {{$dato->direccionapoderado}}</p>
     </div>
     <div class="col-md-3">
      <b  style="color:#0171BD">Teléfono Celular</b></label>
       <p style="text-transform: uppercase"> {{$dato->primertelefonoapoderado}}</p>
     </div>
     <div class="col-md-3">
      <b  style="color:#0171BD">Teléfono Fijo</b></label>
       <p style="text-transform: uppercase"> {{$dato->segundotelefonoapoderado}}</p>
     </div>
     <div class="col-md-3">
      <b  style="color:#0171BD">Correo Electrónico</b></label>
       <p style="text-transform: lowercase"> {{$dato->emailapoderado}}</p>
     </div>



  </div>


  </div>
</div>
</div>
<br>
@endif

<div class="card" style="padding-top: 3px; padding-bottom: 3px;">
  <div class="card-header" style="text-align-last: center;">
    <div class="row justify-content-md-center">
      <div class="form-check form-switch form-check-reverse" >
        <input class="form-check-input" type="checkbox" role="switch" id="convocado" style="
        margin-right: 1px
        padding-top: 1px;">
        <label class="form-check-label" style="padding-left: 35px;" for="convocado">     <b>DATOS DE CONVOCADOS </b></label>
      </div>
    </div>

  </div>

  <div class="container">
    <div class="card-body scroll" id="divconvocado">

    <div class="row" style="margin-right: 12px;
    margin-left: 23px;" >
      @foreach ($data['convocates'] as $info)
      
      
      <div class="col-md-6 mt-2 pt-10" style="
          border: 1px solid #F0F8FF;
          border-radius: 7px / 7px;
          padding: 8px 30px;
          text-align: left;" >
        <b  style="color:#0171BD">Nombre Convocado (Correo Electrónico)</b></label>
        <p style="text-transform: uppercase">{!! $info->nomconvocante . ' ' . $info->apeconvocante !!} <br> <span style="text-transform: lowercase"> ({!! $info->emailconvocante  !!}) </span></p>
      </div>
 
      @endforeach 
  </div>
  
</div>



</div>
</div>
<br>


<div class="card" style="text-justify;" >

    <div class="card-body" style="padding-right:12px;">
      <div class="row">
        <div class="col-md-11">
          <b style="color:#0171BD">Documentos necesarios para la solicitud</b>
        </div>
      <div class="col-md-9">
      <p>
        Señor(a) solicitante, tengan en cuenta la siguientes indicaciones:
  
        <br>
      <p><strong></strong></p>
              <ul >
                <li >TODOS los soportes que anexe, debe adjuntarlos en formato PDF y en tamaño oficio.</li>
                <li >El tamaño/peso de cada archivo adjunto NO pude superar DIEZ (10) megas; de lo contrario la solicitud no se podrá registrar.</li>
                <li >El sistema CONCIWEB después de recibir la información registrada por usted, enviará una notificación al correo electrónico; 
                  es importante resaltar que si responde dicha notificación, lo que usted indique, solicite o aclare no será tenido en cuenta en la gestión de su solicitud de conciliación.</li>
                  <li >Es <strong>OBLIGATORIO</strong> diligenciar el formato 05-FR-40, el cual se encuentra a continuación.</li>
              </ul>
            </p>
          </div>
       
            <div class="col-md-3" style=" text-align: center; margin-top:60px">
 

              <a href="/downloadFileWord"><img src="{{URL::asset('imagen/icono-descarga-doc.png')}}" alt="Esta es una descripcion alternativa de la imagen para cuando no se pueda mostrar" /> </a><br>
              <a href="/downloadFileWord">Descargar Formato 05-FR-40</a>
            </div>
         
      
      
   
  </div>


</div>
</div>
<br>
<div class="card">

  <div class="card-body"> 
    
      <b style="color:#0171BD;margin-bottom: 2px">Cargue los siguientes Documentos</b>
      <div class="alert alert-warning text-justify" role="alert" style="margin-bottom: -10px;margin-top: 10px;" >
       <i class="fa-solid fa-triangle-exclamation fa-2xl"> </i><span class="px-2"><b>IMPORTANTE.</b><br> Los campos marcados con asterisco (<b style="color: red;font-size:18px">*</b>) son obligatorios.</span><span class="pr-2"> El nombre de los archivos que anexe <b>NO</b> debe contener tildes, ni caracteres especiales.</span>
      </div>
      
    <div class="table-responsive">
      <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
        <thead>
          <tr style=" text-align: center;">
            <th scope="col"></th>
            <th scope="col"></th>
            
          </tr>
        </thead>
        <tbody>

   
  

      

      @foreach ($data['detalleAbc'] as $info)
      <tr style=" text-align: left;" class="input-file">
              @if($info->obligatorio==1)
              <td style="text-justify;width:50%;vertical-align: middle;" >{!! $info->descripcion->nombre !!} <b style="color: red;font-size:18px">*</b></td>
             <div style="display:none">
                <input type="text" class="form-control" name="descripcion[]" id="descripcion"/> 
              </div>
            <td style="text-justify;width:40%;padding-left: 40px;padding-top: 25px;" >
              <div class="input-group mb-3"><input type="file" class="form-control input-file" name="document1[]" id="document1" aria-label="Upload" required accept=".pdf"/>
                <button class="btn btn-outline-danger btn-reset trash" id="limpia" type="button"> 
                  
                   
                  <img src="{{URL::asset('imagen/trash-red.png')}}" class="img-bot" /> 
                  <img src="{{URL::asset('imagen/trash-white.png')}}" class="img-top" alt="Card Front">
             
                
                
                </button></div>
                <div class="alert" id="archivoAlert{{ $loop->index }}" style="display: none; color: red;"></div>
              </div>
              <div class="invalid-feedback nomConvoc">
                Campo obligatorio.
              </div>
              </td>

          @else
          <td style="text-justify;width:50%;vertical-align: middle;" >{!! $info->descripcion->nombre !!} <b style="color: red;font-size:18px"></b></td>
          <div style="display:none">
             <input type="text" class="form-control" name="descripcion[]" id="descripcion"/> 
           </div>
         <td style="text-justify;width:40%;padding-left: 40px;padding-top: 25px;" >
           <div class="input-group mb-3"><input type="file" class="form-control input-file" name="document1[]" id="document1" aria-label="Upload"  accept=".pdf"/>
             <button class="btn btn-outline-danger btn-reset trash" id="limpia" type="button"> 
               
                
               <img src="{{URL::asset('imagen/trash-red.png')}}" class="img-bot" /> 
               <img src="{{URL::asset('imagen/trash-white.png')}}" class="img-top" alt="Card Front">
          
             
             
             </button></div></td>
             @endif
             
          </tr>
         
      


 


      @endforeach
      
        
   
       
 
      
  
<br>
    @if($tiposolicitud==1)
        
    <tr style=" text-align: left;" class="input-file">
            <td style="text-justify;width:50%;vertical-align: middle;" class="input-file">Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C. <b style="color: red;font-size:18px">*</b></td>
            <div style="display:none">
              <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C"/> 
            </div>
            <td style="text-justify;width:40%;padding-left: 40px;padding-top: 25px;" >
              <div class="input-group mb-3">
              <input type="file" class="form-control" name="document1[]" id="document1" aria-label="Upload" required accept=".pdf"/><button class="btn btn-outline-danger btn-reset trash" id="limpia" type="button" > 
        
           
              <img src="{{URL::asset('imagen/trash-red.png')}}" class="img-bot"/> 
              <img src="{{URL::asset('imagen/trash-white.png')}}" class="img-top" alt="Card Front">
         
      
            </button></div></td>
        
      </tr>


     

        @endif
        {{-- <br>
        <tr style=" text-align: left;" class="input-file">
          <td style="text-justify;width:50%;vertical-align: middle;" class="input-file">Documentos que complementen su solicitud</td>
      
          <td style="text-justify;width:40%;padding-left: 40px;padding-top: 25px;" >
          <div class="input-group mb-3">
          <input type="file" class="form-control" name="document1[]" id="document1" aria-label="Upload" accept=".pdf"/><button class="btn btn-outline-danger btn-reset trash" id="limpia" type="button" > 
    
       
          <img src="{{URL::asset('imagen/trash-red.png')}}" class="img-bot"/> 
          <img src="{{URL::asset('imagen/trash-white.png')}}" class="img-top" alt="Card Front">
     
  
        </button></div></td>
        
        
      
     </tr> --}}
      </tbody>
    </table>
  </div>
      </div>
    </div>




<div class="row">
  <div class="col-md-4" style="padding-left: 15%;margin-top:10px;margin-left:30%">
    <button type="button" class="btn btn-outline-success btn-block btn-sm" data-bs-toggle="modal" id="registro" >  Registrar Adjuntos  <span class="fas fa-upload ms-2"> </span></button>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Antes de terminar el proceso ¿Esta seguro de los datos adjuntados?
      </div>
      
      <div class="modal-footer">

        <button type="submit" class="btn btn-outline-success" id="submits"><span class="fas fa-upload ms-2"> </span> Si</button>
        <button type="button" class="btn btn-outline-danger" id="" data-bs-dismiss="modal"><i class="fas fa-times ms-2"></i> No</button>
 
      </div>
    </div>
  </div>
</div>


<br>
{{-- </form> --}}
{!! Form::close() !!}
<br>
@endsection

@section('AddScriptFooter')

<script>
 $(".btn-reset").click(function() {

  $(this).parents(".input-file").find('input').val('');


    toastr.error("Se ha limpiado el documento");
    });

$(".input-file").change(function() {
    console.log(this.files[0].name);
    if(this.files[0].size>10289594){
    toastr.error("El tamaño permitido es de 10MB");
    this.value = "";
    }else{
      var extension = this.value.split('.').pop().toLowerCase();
                if (extension !== 'pdf') {
                  toastr.error("Formato no permitido");
                  this.value = "";
                  event.preventDefault();
                }
            }
            if (/[^a-zA-Z0-9()_ .-]/.test(this.files[0].name)) {
              
                    toastr.error("Estimado usuario, El archivo contiene caracteres especiales no permitidos, por lo tanto se recomienda ajustar el nombre del archivo adjunto");
                    this.value = "";
                  event.preventDefault();
                }
        });


      




    function PreviewImage() {
    pdffile=document.getElementById("document1").files[0];
    pdffile_url=URL.createObjectURL(pdffile);
    $('#viewer').attr('src',pdffile_url);
}







$(document).ready(function() {
  $('#registro').click(function(event) {
    var archivos = $('input[name^="document1"]');
    var missingFiles = [];
      archivos.each(function(index, input) {
          var archivo = $(input).val();
          var alertId = '#archivoAlert' + index;

          if (archivo === '') {
              $(alertId).text('Documento obligatorio.');
              $(alertId).show();
              missingFiles.push(index);
              event.preventDefault();
          }else{
            
            $(alertId).text('');
         
              $(alertId).hide();
              event.preventDefault();
          }
      });
      if (missingFiles.length === 0) {
          $('#exampleModal').modal('show');
        }
      });

      // Ocultar las alertas al cambiar el contenido de los campos
      $('input[name^="archivos"]').change(function() {
      var index = $(this).index('input[name^="archivos"]');
      var alertId = '#archivoAlert' + index;
      $(alertId).hide();
      });

  $("#adjuntarfomr").validationEngine('attach', {
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
        var formData = new FormData(document.getElementById("adjuntarfomr"));
        formData.append("dato", "valor");
        $.ajax({
            type: "POST",
            url: "{{ route('cargararchivos',$dato->num_solicitud) }}",
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
                $('#exampleModal').modal('hide');
            },
            success: function(r) {
                var datUsr = r.split("|");
                var valor = datUsr[1];
                var msg = datUsr[2];
                if (valor == 0) {
                    var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error', msg, 'topRight', 3000);
                    $("#submits").show();
                    $('#exampleModal').modal('hide');
                } else {
                    $("#submits").hide();
                    $('#exampleModal').modal('hide');
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer: true,
                        progressBar: true,
                        timeout: 15000,
                        callbacks: {
                            afterClose: function() {
                                window.location.href = "https://www.personeriabogota.gov.co/";
                            },
                        }
                    }).show();
                }
            },
            error: (err) => {
                var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center> Problema al adjuntar archivos, tamaño maximo del servidor excedido" ;
                llamarNotyTime('error', msg, 'topRight', 3000);
                $("#submits").show();
            }
        });
    }
  
});

$("#divapoderado").hide();
        $("#apoderado").change(function() {
        if ($("#apoderado").is(':checked')) {
            $("#divapoderado").slideDown();
            
        } else {
            $("#divapoderado").slideUp();
        }
          });

          $("#divconvocado").hide();
        $("#convocado").change(function() {
        if ($("#convocado").is(':checked')) {
            $("#divconvocado").slideDown();
            
        } else {
            $("#divconvocado").slideUp();
        }
          });

      // ('#imageFile').on("change", function(){
      //       var test=$('.input[type=file]').val().toString().split('.').pop(); // Obtengo la extensión
      //       alert(test) ;
      //       if(test!='pdf'){
      //         var msg = 'El tipo del archivo seleccionado NO es valido.<br>Unicamente pueden adjuntar los siguientes tipos de archivo: ';
      //            msg = msg + ' [.pdf]';
      //            var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
      //            llamarNotyTime('error', msg, 'topRight', 5000);
      //       }
      //   });

</script>
@endsection