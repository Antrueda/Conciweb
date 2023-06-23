
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

  @csrf
  @if ($msg = Session::get('success'))
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
@endif
  
  <div>
  <div class="card" style="padding-top: 3px; padding-bottom: 3px;">
    <div class="card-header">
        <center>
        <b>DATOS DE LA SOLICITUD</b>
    </center>
    </div>
    <div class="container">
    {{-- <div class="row align-items-start">
      <div class="col" style="border: 2px">
        <b>Solicitante: <br> </b> {{$nombrecompleto}}
      </div>
  
        <div class="col">
          <b>Fecha de Solicitud: <br> </b> {{$dato->fec_solicitud_tramite}}
        </div>

          <div class="col">
            <b>Asunto: <br> </b> {{$dato->asuntos->nombre}}
          </div>
          <div class="col">
            <b>Sub Asunto: <br> </b> {{$dato->subasuntos->nombre}}
          </div>
          <div class="col">
            <b>Cuantia: <br> </b> {{$dato->cuantia}}
          </div>
        </div>
        <div class="row align-items-start">
          <div class="col-12">
            <b>Resumen de la pretensión o conflicto: <br> </b> {{$dato->detalle}}
          </div>
      </div> --}}
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr style=" text-align: center;">
              <th scope="col">Numero de Documento</th>
              <th scope="col">Solicitante</th>
              <th scope="col">Fecha de Solicitud</th>
              <th scope="col">Asunto</th>
              <th scope="col">Sub Asunto</th>
              <th scope="col">Cuantia</th>
            </tr>
          </thead>
          <tbody>
            <tr style=" text-align: center;">
              <th>{{$dato->id_usuario_reg}}</th>
              <th style="text-transform: uppercase"> {{$nombrecompleto}}</th>
              <td>{{$dato->fec_solicitud_tramite}}</td>
              <td>{{$dato->asuntos->nombre}}</td>
              <td>{{$dato->subasuntos->nombre}}</td>
              <td>{{$numero}}</td>
            </tr>
          </tbody>
        </table>
      </div>


{{--       
    <ul class="list-group list-group-horizontal">
      
      <li class="list-group-item"><b>Solicitante: <br> </b> {{$nombrecompleto}} </li>
      <li class="list-group-item"><b>Fecha de Solicitud:</b><br> {{$dato->fec_solicitud_tramite}} </li>
      <li class="list-group-item"><b>Asunto:</b> <br>{{$dato->asuntos->nombre}} </li>
      <li class="list-group-item"><b>Sub Asunto:</b><br> {{$dato->subasuntos->nombre}}</li>
      <li class="list-group-item"><b>Cuantia:</b> <br> {{$dato->cuantia}}</li>
    </ul> --}}
      <ul class="list-group list-group-flush">
      <li class="list-group-item"><b>Resumen de la pretensión o conflicto:</b><p> {{$dato->detalle}}</p></li>
    </ul>
  </div>
</div>
<br>
<div class="card">
  <div class="card-body">
   

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



  

      @foreach ($data['detalleAbc'] as $info)
          <div class="row input-file">
            
          
            <div class="col-md-6">
            <span style="text-justify">{!! $info->descripcion->nombre !!} *</span>
                <div style="display:none">
                <input type="text" class="form-control" name="descripcion[]" id="descripcion"/> 
              </div>
            </div>
            <div class="col-md-6">
          <div class="input-group">
            <input type="file" class="form-control" name="document1[]" id="document1" aria-label="Upload" required accept=".pdf"/>
            <button class="btn btn-danger btn-reset" id="limpia" type="button"> <i class="fas fa-trash"></i></button>
            @if($errors->has('document1'))
            <div class="invalid-feedback d-block">
              {{ $errors->first('document1') }}
            </div>
            @endif
          </div>
        </div>
        </div>

      
         
     
         

 
  <br>

      @endforeach
   

          <div class="row">
            <div class="col-md-6">
            <span style="text-justify">Documentos que complementen su solicitud </span>
       
          <div style="display:none">
          <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="Documentos que complementen su solicitud"/> 
          </div>
        </div>
          <div class="col-md-6">
            <div class="input-group">
           <input type="file" class="validate[required] form-control" name="document1[]"   accept=".pdf"/>
           <button class="btn btn-danger btn-reset" id="limpia" type="button"> <i class="fas fa-trash"></i></button>
          </div>
        </div>
      </div>
   
       
 
      
  
<br>
    @if($tiposolicitud==1)
        
 

        <div class="row">
          <div class="col-md-6">
            <span style="text-justify">Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C. *</span>
      
        <div style="display:none">
          <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C"/> 
        </div>
      </div>
        <div class="col-md-6">
          <div class="input-group">
         <input type="file" class="validate[required] form-control" name="document1[]"   accept=".pdf"/>
         <button class="btn btn-danger btn-reset" id="limpia" type="button"> <i class="fas fa-trash"></i></button>
        </div>
      </div>
    </div>
     

    
      

        @endif

   

  </div>
</div>


<div class="row">
  <div class="col-md-4" style="padding-left: 10%;margin-top:10px;margin-left:30%">
    <button type="button" class="btn btn-outline-success btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal"> <span class="fas fa-upload"> </span> Registrar Adjuntos</button>
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

        <button type="submit" class="btn btn-outline-success" id="submits"><span class="fas fa-upload"> </span> Si</button>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> No</button>
 
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
  $(this).parents(".input-file").find('input').val('');
    toastr.warning("Se ha limpiado el documento");
    });

$("input").change(function() {
    console.log(this.files[0].size);
    if(this.files[0].size>10289594){
    toastr.error("El tamaño permitido es de 10MB");
    this.value = "";
    }
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