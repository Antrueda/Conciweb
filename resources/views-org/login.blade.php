<?php
 $arrayImagenesFondo = array(
         "1" => "https://www.sony.com.co/image/f6ed466855bcaeda7241430905d89848?fmt=png-alpha&wid=1440",
         "2" => "https://wallpapercave.com/wp/wp2092975.jpg",
         "3" => "https://prodavinci.com/wp-content/uploads/2018/01/bogota_fhd.jpg",
         "4" => "https://wallpapercave.com/wp/wp2093020.jpg",
         "5" => "https://wallpapercave.com/wp/wp2093103.jpg",
         "6" => "https://wallpapercave.com/wp/wp2092987.jpg",
 );
 $random=rand(1,6);
?>

<html>
 <head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Modelo Proceso Disciplinarios</title>
  <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('css/notyJs.css')}}" />
  <link rel="stylesheet" href="{{URL::asset('css/validationEngine.jquery.css')}}" />
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="http://allfont.es/allfont.css?fonts=roboto-light" rel="stylesheet" type="text/css" />

  <style>
   body {
     text-align: center;
     font-family: 'Roboto Light', arial;
     background-size: 100% auto;
     background-image: url({!! $arrayImagenesFondo[$random] !!});
     background-color: #cccccc;
   }
  </style>
 </head>
 <body>
  <div class="row">
   <div class="col-md-4"></div>
   <div class="col-md-4">
    <div class="container" style="padding: 1px 1px 1px 1px;">
     <div class="jumbotron" style="margin:5% 5% 5% 5%;">
      <div class="panel panel-default">

       <div class="panel-heading">
        <div class="panel-title text-center">
         <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
           <img src="{{URL::asset('imagen/users.svg')}}" width="150px" height="50px" class="img-fluid" alt=""><br>
           <strong>SCCPB - SISTEMA DE CONSULTA DE CIUDADANOS EN PERSONERIA DE BOGOTA </strong><hr>
          </div>
          <div class="col-md-2"></div>
         </div>
        </div>
       </div>

       <div class="panel-body">
        <br>
        <div id="frmLoginDiv" >
         <form name="frmRegUsuario" id="frmRegUsuario" method="POST">

          <div class="row">

           <div class="col-md-12">
            <div class="input-group mb-1 mr-sm-1">
             <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user-tie"></i></div>
             </div>
             <input type="email" class="validate[required,custom[email]] form-control" id="correo" name="correo" placeholder="Correo Electrónico" autocomplete="off">
            </div>
           </div>
          </div>
          <div class="row">
           <div class="col-md-12">
            <div class="input-group mb-3 mr-sm-1">
             <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-key"></i></div>
             </div>
             <input type="text" class="validate[required,minSize[6],maxSize[12],custom[onlyLetterNumber]] form-control" id="ccFuncionario" name="ccFuncionario" placeholder="Cedula Funcionario" autocomplete="off">
            </div>
           </div>
          </div>

          <div class="row">
           <div class="col-md-12">
            <div class="input-group mb-3 mr-sm-1">
             <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-key"></i></div>
             </div>
             <input type="text" class="validate[required,minSize[6],maxSize[12],custom[onlyLetterNumber]] form-control" id="ccUsuario" name="ccUsuario" placeholder="Cedula del ciudadano a consultar" autocomplete="off">
            </div>
           </div>
          </div>


          <div class="row">
           <div class="col-md-12">
            <button class="btn btn-primary btn-block" type="submit">Enviar datos a consultar</button>
           </div>
          </div>


         </form>
        </div>

        <div id="frmSemilla" style="display: none">
         <form name="frmCodigoVerificacion" enctype="multipart/form-data" class="form-horizontal" onsubmit="return false;">

          <div class="row">
           <div class="col-md-12">
            <div class="input-group mb-1 mr-sm-1">
             <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-key"></i></div>
             </div>
             <input type="text" class="validate[required] form-control" id="semilla" name="semilla" placeholder="Semilla de Ingreso" autocomplete="off">
            </div>
           </div>
          </div>
          <div class="row">
           <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-lg btn-block pull-right" onclick="datosSemillaFrm()">Verificar Semilla</button>
           </div>
          </div>

         </form>
        </div>

       <br>

       <div class="card-footer">

          <center>
           <img src="{{URL::asset('imagen/logo.png')}}" width="150px" height="50px" class="img-fluid">
          </center>

        </div>

      </div>
     </div>
    </div>
   </div>
   <div class="col-md-4"></div>
  </div>
  </div>
 </body>
</html>

<script src="{{URL::asset('js/popper.min.js')}}"></script>
<script src="{{URL::asset('js/jquery.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.js')}}"></script>
<script src="{{URL::asset('js/notyJs.js')}}"></script>
<script src="{{URL::asset('js/jquery.validationEngine.js')}}"></script>
<script src="{{URL::asset('js/jquery.validationEngine-es.js')}}"></script>
<script src="{{URL::asset('js/local.js')}}"></script>


<script>
 function cambioActualizaClave(){
  $('#correoCambioClave').show();
 }

 $(document).ready(function(){
  $("#frmRegUsuario").validationEngine('attach',{
   onValidationComplete:function(form, status) {
    if (status === true) {
     datosFrm();
    } else {
     llamarNotyFaltanDatosFrm();
     return;
    }
   }
  });
 });


 function datosFrm(){

   var correo=$("#correo").val();
   var ccFuncionario=$("#ccFuncionario").val();
   var ccUsuario=$("#ccUsuario").val();

   if(correo == '' || ccFuncionario== ''|| ccUsuario== ''){
    var msg='<center><i class="fas fa-exclamation-circle fa-w-16 fa-5x"></i><br>Los campos correo, cedula del funcionario y cedula del usuario a consultar son obligatorios</center>';
    var type='info';
    var layout='topRight';
    llamarNotyBasic(type,msg,layout);
    return;
   }

  $.ajax({
   type: "POST",
   url: "/login/validarLogin",
   dataType: 'html',
   headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   data: {ccFuncionario:ccFuncionario,correo:correo,ccUsuario:ccUsuario},
   beforeSend: function() { llamarNotyCarga(); },
   success: function(r){
    var datUsr=r.split("|");
     var valor=datUsr[1];
     var msg=datUsr[2];
     var layout='topRight';
     var timeout=2000;

     if(valor==0) {
      var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
      var type='error';

      llamarNotyTime(type,msg,layout,timeout);
     }else{
      var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
      var type='success';
      llamarNotyTime(type,msg,layout,timeout);
      $("#frmLoginDiv").hide();
      $("#frmSemilla").show();
     }
   }
  });

 }

 function datosSemillaFrm(){
  var semilla=document.getElementById("semilla").value;
  if(semilla == '' ){
   var msg='<center><i class="fas fa-exclamation-circle fa-w-16 fa-5x"></i><br>El número de verificación es obligatorio</center>';
   var type='info';
   var layout='topRight';
   llamarNotyBasic(type,msg,layout);
   return;
  }
  $.ajax({
   type: "POST",
   url: "/login/validarSemillaLogin",
   dataType: 'html',
   data: {semilla:semilla},
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   beforeSend:function(){llamarNotyCarga();},
   success: function(r){
    var datUsr=r.split("|");
    var valor=datUsr[1];
    var msg=datUsr[2];
    var layout='topRight';
    var timeout=2000;

    if(valor==0) {
     var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
     var type='error';
     llamarNotyTime(type,msg,layout,timeout);
    }else{
     location.href ="/system/moduloGestion";
    }
   }
  });
 }

 function recuperarClave(){
  var ccRecuperarPw=$('#idFuncionarioRec').val();
  if(ccRecuperarPw == '' ){
   var msg='<center><i class="fas fa-exclamation-circle fa-w-16 fa-5x"></i><br>El número de identificación es obligatorio</center>';
   var type='info';
   var layout='topRight';
   llamarNotyBasic(type,msg,layout);
   return;
  }
  $.ajax({
   type: "POST",
   url: "/login/recuperarClave",
   dataType: 'html',
   data: {ccRecuperarPw:ccRecuperarPw},
   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
   beforeSend:function(){llamarNotyCarga();},
   success: function(r){
    var datUsr=r.split("|");
    var valor=datUsr[1];
    var msg=datUsr[2];
    var layout='topRight';
    var timeout=2200;
    if(valor==0) {
     var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
     var type='error';
     llamarNotyTime(type,msg,layout,timeout);
    }else{
     var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
     var type='success';
     llamarNotyTime(type,msg,layout,timeout);
    }
   }
  });


 }

</script>