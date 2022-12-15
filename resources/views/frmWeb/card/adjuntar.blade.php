
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

</style>
  {!! Form::open(['route' => ['adjunta',$dato->num_solicitud],'class' => 'form-horizontal','id'=>"adjuntarfomr",'name'=>"adjuntarfomr",'enctype'=>"multipart/form-data"]) !!}
  
  <div>
  <div class="card" style="padding-top: 3px; padding-bottom: 3px;">
    <div class="card-header">
        <center>
        <b>DATOS DE LA SOLICITUD</b>
    </center>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><Strong>Nombre:</Strong> {{$nombrecompleto}} </li>
      <li class="list-group-item"><Strong>Fecha de Solicitud:</Strong> {{$dato->fec_solicitud_tramite}} </li>
      <li class="list-group-item"><Strong>Asunto:</Strong> {{$dato->asunto->nombre}} </li>
      <li class="list-group-item"><Strong>SubAsunto:</Strong> {{$dato->subasunto->nombre}}</li>
      <li class="list-group-item"><Strong>Cuantia:</Strong>  {{$dato->numero07}}</li>
      <li class="list-group-item"><Strong>Resumen de la pretensión o conflicto:</Strong><p> {{$dato->texto21}}</p></li>
    </ul>
  </div>
</div>


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
          Señor(a) solicitante,<br>
          Para el registro de su solicitud de conciliación es OBLIGATORIO diligenciar el formato 05-FR-40
          <br>
          <p>
              <center>
                <a href="/downloadFileWord"><i class="fas fa-file-word fa-4x"></i></a><br>
                <a href="/downloadFileWord">Descargar Formato 05-FR-40</a>
              </center>
          </p>
          <p>
            Adicional al Formato 05-FR-40, debe anexar los siguientes documentos:
          </p>
          <ul>
            @foreach ($data['detalleAbc'] as $info)
            <li style="text-justify">{!! $info->descripcion->nombre !!}</li> 
            @endforeach
          </ul>  
          <!--/*<p>
            Tenga en cuenta que:<br>
			  * TODOS los soportes descritos debe adjuntarlos en un (1) solo archivo, en formato PDF y en tamaño oficio.<br>
			  * <strong>El tamaño/peso del archivo adjunto NO pude superar cinco (5) megas; de lo contrario la solicitud no se podrá registrar.</strong>
			 
          </p>*/-->

			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<p><strong>Tenga en cuenta:</strong></p>
					<ul class="list-group">
					  <li class="list-group-item">TODOS los soportes antes descritos, debe adjuntarlos en un (1) solo archivo en formato PDF y en tamaño oficio.</li>
					  <li class="list-group-item">El tamaño/peso del archivo adjunto NO pude superar DIEZ (10) megas; de lo contrario la solicitud no se podrá registrar.</li>
					  <li class="list-group-item">El sistema CONCIWEB después de recibir la información registrada por usted, enviará una notificación al correo electrónico; es importante resaltar que si responde dicha notificación, lo que usted indique, solicite o aclare no será tenido en cuenta en la gestión de su solicitud de conciliación.</li>
					</ul>
				</div>
			
		  </div>
		  
        </p>
    
      </small>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <ul>
      @foreach ($data['detalleAbc'] as $info)
      <span style="text-justify">{!! $info->descripcion->nombre !!} (Máximo 10Mb) *</span>
      <label class="form-group has-float-label">
        <div class="input-group input-file" name="document1">
          <div style="display:none">
          <input type="text" class="form-control" name="descripcion[]" id="descripcion" value="{!! $info->descripcion->nombre !!}"/> 
          </div>
           <input type="file" class="validate[required] form-control" name="document1[]" id="document1" required accept="pdf"/>
            <span class="input-group-btn">
                <button class="btn btn-danger btn-reset" id="limpia" type="button">Limpiar</button>
            </span>
        </div>
        @if (count($errors) > 0)
        <div class="alert alert-danger" style="height: 20%">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </label> 
      @endforeach
    </ul>        
  </div>
</div>


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
  <button type="submit" class="btn btn-perso btn-block btn-sm "><span class="fas fa-upload"> </span> Adjuntar Archivos </button>
  </div>
</div>
<br>
{!! Form::close() !!}
<br>
@endsection

@section('AddScriptFooter')

<script>
 $(".btn-danger").click(function() {
  $(this).parents(".input-file").find('input').val('');
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