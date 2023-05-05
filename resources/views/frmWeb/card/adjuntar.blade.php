
@extends('../mainUsrWeb')

@section('title','ADJUNTAR ARCHIVOS')

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
   .archivo{
    display: flex;
    align-items: center;
    justify-content: center;
    
    
   }     

</style>
{{-- 
<form name="adjuntarfomr" enctype="multipart/form-data" id="adjuntarfomr"> --}}

  {{-- {!! Form::open(['route' => ['test',$dato->num_solicitud],'class' => 'form-horizontal','id'=>"adjuntarfomr",'name'=>"adjuntarfomr",'enctype'=>"multipart/form-data"]) !!} --}}
  {!! Form::open(['route' => ['cargararchivos',$dato->num_solicitud],'class' => 'form-horizontal', 'enctype'=>"multipart/form-data" ]) !!}
  
  <div>
  <div class="card" style="padding-top: 3px; padding-bottom: 3px;">
    <div class="card-header">
        <center>
        <b>DATOS DE LA SOLICITUD</b>
    </center>
    </div>
    <ul class="list-group list-group-horizontal">
      
      <li class="list-group-item"><b>Solicitante: <br> </b> {{$nombrecompleto}} </li>
      <li class="list-group-item"><b>Fecha de Solicitud:</b><br> {{$dato->fec_solicitud_tramite}} </li>
      <li class="list-group-item"><b>Asunto:</b> <br>{{$dato->asuntos->nombre}} </li>
      <li class="list-group-item"><b>Sub Asunto:</b><br> {{$dato->subasuntos->nombre}}</li>
      <li class="list-group-item"><b>Cuantia:</b> <br> {{$dato->cuantia}}</li>
    </ul>
      <ul class="list-group list-group-flush">
      <li class="list-group-item"><b>Resumen de la pretensión o conflicto:</b><p> {{$dato->detalle}}</p></li>
    </ul>
  </div>
</div>
<br>

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" role="alert">
      <small class="text-justify">

        <div class="row">
          <div class="col-md-11">
            <b>Documentos necesarios para la solicitud</b>
          </div>
          <div class="col-md-1">
          </div>
        </div>
        <hr>
        <p>
          Señor(a) solicitante,
        
          <br>
          <div class="row">
   
            <div class="col-md-10">
              <p><strong>Tenga en cuenta:</strong></p>
              <ul >
                <li >TODOS los soportes que anexe, debe adjuntarlos en formato PDF y en tamaño oficio.</li>
                <li >El tamaño/peso de cada archivo adjunto NO pude superar DIEZ (10) megas; de lo contrario la solicitud no se podrá registrar.</li>
                <li >El sistema CONCIWEB después de recibir la información registrada por usted, enviará una notificación al correo electrónico; 
                  es importante resaltar que si responde dicha notificación, lo que usted indique, solicite o aclare no será tenido en cuenta en la gestión de su solicitud de conciliación.</li>
                  <li >Es <strong>OBLIGATORIO</strong> diligenciar el formato 05-FR-40, el cual se encuentra a continuación.</li>
              </ul>
            </div>
          
          </div>
          <p>
              <center>
                <a href="/downloadFileWord"><i class="fas fa-file-word fa-4x"></i></a><br>
                <a href="/downloadFileWord">Descargar Formato 05-FR-40</a>
              </center>
          </p>
         
          <!--/*<p>
            Tenga en cuenta que:<br>
			  * TODOS los soportes descritos debe adjuntarlos en un (1) solo archivo, en formato PDF y en tamaño oficio.<br>
			  * <strong>El tamaño/peso del archivo adjunto NO pude superar cinco (5) megas; de lo contrario la solicitud no se podrá registrar.</strong>
			 
          </p>*/-->


		  
        </p>
    
      </small>
    </div>
  </div>
</div>



  
    <ul>
      @foreach ($data['detalleAbc'] as $key => $info)

      <li>
        <div class="container text-left" name="document{{$key}} ">
          <div class="row">
            <div class="col-5 texto">
            <span style="text-justify">{!! $info->descripcion->nombre !!} *</span>
            </div>
          <div style="display:none">
          <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="{!! $info->descripcion->nombre !!}"/> 
          </div>
          <div class="col-5 archivo">
           <input type="file" class="validate[required] form-control" name="document1[]" id="document{{$key}}" required accept=".pdf"/>
           <button class="btn btn-danger btn-reset" style="margin-left: 10px;" id="limpia" type="button"> <i class="fas fa-broom"></i></button>
          </div>

          </div>
            <div id="my_pdf_viewer">
     
            </div>
        </div>
      </li>
  <br>
 
      @endforeach
      <li>
        <div class="container text-left" >
          <div class="row">
            <div class="col-5">
            <span style="text-justify">Documentos que complementen su solicitud </span>
          </div>
          <div style="display:none">
          <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="Documentos que complementen su solicitud"/> 
          </div>
          <div class="col-5 archivo">
           <input type="file" class="validate[required] form-control" name="document1[]"   accept=".pdf"/>
           <button class="btn btn-danger btn-reset" style="margin-left: 10px;" id="limpia" type="button"> <i class="fas fa-broom"></i></button>
          </div>
        </div>
            <div id="my_pdf_viewer">
     
            </div>
       
      </div>
      
    </li>
<br>
    @if($tiposolicitud==1)
        
    <li>
      <div class="container text-left" >
        <div class="row">
          <div class="col-5">
            <span style="text-justify">Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C. *</span>
        </div>
        <div style="display:none">
          <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C"/> 
        </div>
        <div class="col-5 archivo">
         <input type="file" class="validate[required] form-control" name="document1[]"   accept=".pdf"/>
         <button class="btn btn-danger btn-reset" style="margin-left: 10px;" id="limpia" type="button"> <i class="fas fa-broom"></i></button>
        </div>
      </div>
          <div id="my_pdf_viewer">
   
          </div>
     
      </div>
    
      
      </li>
        @endif

    </ul>        



{{-- <div class="container">
  <div class="row">
      <h1>Company Logo</h1>
      <div class="panel panel-primary">
          <div class="panel-heading">
              Create Employee
          </div>
          <div class="panel-body">
              <form class="form-horizontal" id="employeeDetails">
                  <fieldset>
                      <!-- Text input-->
                      <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">Employee Name </label>
                          <div class="col-md-4">
                              <input id="Name" name="Name" type="text" placeholder="Enter Employee Name" class="form-control input-md">

                          </div>
                      </div>
                   
                      <div class="form-group">
                          <label class="col-md-4 control-label" for="prependedtext">Upload Image</label>
                          <div class="col-md-4">
                             <input type="file" name="employeeImage" />
                          </div>
                      </div>


                      <div class="form-group">
                          <label class="col-md-4 control-label" for="button1id"></label>
                          <div class="col-md-8">
                              <button id="btnSubmit" type="submit" name="btnSubmit" class="btn btn-primary">Submit</button>
                              <button id="btnReset" type="button" name="btnReset" class="btn btn-info">Reset</button>
                          </div>
                      </div>
                  </fieldset>
              </form>
          </div>
      </div>
  </div>
</div> --}}
<div class="row">
  <div class="col-md-4" style="padding-left: 10%;margin-top:10px;margin-left:30%">
    <button type="button" class="btn btn-perso btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"> <span class="fas fa-upload"> </span> Registrar Adjuntos</button>
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
        {{ Form::submit('Si', ['class' => 'btn btn-perso' ]) }}
        <button type="submit" class="btn btn-perso" id="submits"><span class="fas fa-upload"> </span> Si</button>
        <button type="button" class="btn btn-info" data-bs-dismiss="modal"><i class="fas fa-times"></i> No</button>
 
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
 $(".btn-danger").click(function() {
  $(this).parents(".archivo").find('input').val('');
  console.log(  $(this).parents(".archivo").find('input').val(''));
    toastr.warning("Se ha limpiado el documento");
    });

    function PreviewImage() {
    pdffile=document.getElementById("document1").files[0];
    pdffile_url=URL.createObjectURL(pdffile);
    $('#viewer').attr('src',pdffile_url);
}
$(document).ready(function() {
// $("#submits").click(function() {

//   alert($(this).val());
//   // registroDatos()
//       });
  });



  // function registroDatos() {
  //       var formData = new FormData(document.getElementById("adjuntarfomr"));
  //       formData.append("dato", "valor");
  //       $.ajax({
  //           type: "POST",
  //           url: "{{ route('cargararchivos',$dato->num_solicitud) }}",
  //           data: formData,
  //           cache: false,
  //           contentType: false,
  //           processData: false,
  //           headers: {
  //               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //           },
  //           success: function(r) {
  //               var datUsr = r.split("|");
  //               var valor = datUsr[1];
  //               var msg = datUsr[2];
  //               if (valor == 0) {
  //                   var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
  //                   llamarNotyTime('error', msg, 'topRight', 3000);
  //                   $("#btnRegistro").show();
  //               } else {
  //                   $("#btnRegistro").hide();
  //                   var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
  //                   new Noty({
  //                       text: msg,
  //                       type: 'success',
  //                       layout: 'center',
  //                       theme: 'bootstrap-v4',
  //                       killer: true,
  //                       progressBar: true,
  //                       timeout: 5000,
  //                       // callbacks: {
  //                       //     afterClose: function() {
  //                       //         window.location.href = "https://www.personeriabogota.gov.co/";
  //                       //     },
  //                       // }
  //                   }).show();
  //               }
  //           },
  //           error: (err) => {
  //               var msg = "<center><p><i class='fas fa-times fa-3x'></i></p></center>" + msg;
  //               llamarNotyTime('error', msg, 'topRight', 3000);
  //               $("#btnRegistro").show();
  //           }
  //       });
  //   }


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