
@extends('../mainUsrWeb')

@section('title','DATOS DEL DE CIUDADANO')

@section('AddScritpHeader')

@endsection

@section('content')

<form name="frmRegistroDatos"  enctype="multipart/form-data" id="frmRegistroDatos">
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-6 text-center"><h5><b style="text-justify">ACTUALIZACIÓN/ACLARACIÓN DE DATOS CONCILIACIÓN VÍA WEB</b></h5></div>
        <div class="col-md-1"> </div>
        <div class="col-md-4 text-right"><img src="{{URL::asset('imagen/logo-personeria-azul.png')}}" width="80%" class="img-fluid img-responsive img-center"></div>
    </div>

    <input type="hidden" name="numSolicitud" value="{{$data['numSolicitud']}}">
    <hr>
    <!-- INICIO CAMPO CON SOLICITUS DEL FUNCIONARIO -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-success mb-3">
                <div class="card-header text-success text-justify">
                    <b>El funcionario(a) de la Personería de Bogotá D.C., que actualmente esta a cargo de su solicitud de conciliación, encuentra necesario que realice la(s) siguiente(s) aclaraciones</b>
                </div>
                <div class="card-body text-success">
                    <p class="card-text">
                        {!! $data['nombreDocumento'] !!} 
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN CAMPO CON SOLICITUS DEL FUNCIONARIO -->
    <hr>
    <!-- CAMPO PARA ACTUALZIAR DATO SOLICITADO -->
    <div class="row">
        <div class="col-md-12">
            <label class="form-group has-float-label">
                <textarea class="form-control form-control-sm validate[optional, maxSize[2000]]" name="detalle" id="detalle"></textarea>
                <span> 1. Observación * </span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label class="form-group has-float-label">
                <div class="input-group input-file" name="document1">
                    <span class="input-group-btn">
                        <button class="btn btn-dark btn-choose" type="button">Seleccionar</button>
                    </span>
                    <input type="text" class="validate[optional] form-control" name="document1" id="document1" placeholder=' 15) Adjuntar Soporte *' />
                    <span class="input-group-btn">
                        <button class="btn btn-danger btn-reset" type="button">Limpiar</button>
                    </span>
                </div>
                <span style="margin-top: 11px;"> 2. Adjuntar Soporte *</span>
            </label>
        </div>
    </div>
    <!-- FIN CAMPO PARA ACTUALZIAR DATO SOLICITADO -->

    <hr>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" id="btnRegistrar">
            <button type="submit" class="btn btn-primary btn-block btn-sm" ><span class="fa fa-save"> </span>&nbsp;&nbsp;&nbsp; Registrar información solicitada </button>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>
</form>


@endsection

@section('AddScriptFooter')

<script>
    //Cargar modal con mensaje de bienvenida
    $( document ).ready(function() {
        $("#frmRegistroDatos").validationEngine('attach',{
            onValidationComplete:function(form, status) {
                if (status === true) {
                    let detalle = $('#detalle').val();
                    let documento = $('#document1').val();
                    if(detalle.length == 0 && documento.length == 0){
                        var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center> Es necesario que diligencie la observación o adjunte un documento. <br>Según sean la indicacion del funcionario.";
                        llamarNotyTime('error',msg,'topRight',3000);
                    }else{
                        registroDatos();
                    }
                   // registroDatos();
                } else {
                    llamarNotyFaltanDatosFrm();
                    return;
                }
            }
        });
    });
    //Registro de informacion en backend
    function registroDatos(){
        var formData=new FormData(document.getElementById("frmRegistroDatos"));
        formData.append("dato","valor");
        $.ajax({
            type: "POST",
            url: "registroActualizacionDatos",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
                var datUsr=r.split("|");
                var valor=datUsr[1];
                var msg=datUsr[2];
                if(valor==0) {
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error',msg,'topRight',3000);
                }else{
                    var msg="<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" +msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer:true,
                        progressBar:true,
                        timeout:5000,
                        callbacks: {
                            afterClose: function() {
                                window.close();
                            },
                        }
                    }).show();
                }
            }
        });
    }
    //Funcionalidad de seleccionar o borrar documento
    function bs_input_file() {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0' id='Fichier1'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                        processSelectedFiles(this);
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-danger").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    }
    $(function() {
        bs_input_file();
    });
    //Verificar extencion del documento adjuntado
    function processSelectedFiles(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            var extension = files[i].name.split('.').pop(); // Obtengo la extensión
            var peso = (files[i].size)/1024;
            if(peso >= 22001){
                $(".input-file").val(''); //Aquí evluar cual es el input que hay que limpiar
                $(".input-file").find('input').val('');
                $("#document1").find('input').val('');
                var msg='El tipo del archivo seleccionado NO es valido.<br><br>Unicamente pueden adjuntar archivos con un peso mayor a 20 MG: ';
                var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                llamarNotyTime('error',msg,'topRight',5000);
            }
            //var nomFile = files[i].name;
            //var logitudNombre = nomFile.length - extension.length;
            if(extension != "pdf"){
                $(".input-file").val(''); //Aquí evluar cual es el input que hay que limpiar
                $(".input-file").find('input').val('');
                $("#document1").find('input').val('');
                var msg='El tipo del archivo seleccionado NO es valido.<br><br>Unicamente pueden adjuntar los siguientes tipos de archivo: ';
                msg=msg + ' [.pdf]';
                var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                llamarNotyTime('error',msg,'topRight',5000);
            }
        }
    }

    
</script>
@endsection