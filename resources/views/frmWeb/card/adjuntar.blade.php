
@extends('../mainUsrWeb')

@section('title','ADJUNTAR ARCHIVOS')

@section('AddScritpHeader')

@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="alert alert-success" role="alert">
      <small class="text-justify">
        <div class="card-body">
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
				<div class="col-md-1"></div>
		  </div>
		  
        </p>
      </div>
      </small>
    </div>
  </div>
</div>
<div class="card-body">
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
           <input type="file" class="validate[required] form-control" name="document[]" id="document1" placeholder=' 15) Adjuntar Soporte *'/>
            <span class="input-group-btn">
                <button class="btn btn-danger btn-reset" type="button">Limpiar</button>
            </span>
        </div>
    </label> 
      @endforeach
    </ul>        
  </div>
</div>
</div>
<br>
@endsection

@section('AddScriptFooter')