<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="yaaREfGcLmZOmPDBEgXcePCGt2c8w6QuUm1Oap5i">
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;400&display=swap' rel='stylesheet'>
    <!-- css -->

    <style>
        .cabecera {
            margin-top: 1rem;
            padding: 0.7rem;
            text-align: center;
            width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-perso{
             background-color: #198754;
                border-color:#198754;
                color: white;
                border-radius: 5px;
                line-height:15px;
                font-family: Arial; 
                font-weight: regular;
                font-size: .875rem;
                padding: 8px 30px;
            }

 


        .saludo {
            background-color: #fafafa;
            margin-bottom: 1rem;
            padding: 1rem;
            border: 1px solid #ccc;
            text-align: justify;
            width: 85%;
            margin-left: auto;
            margin-right: auto;
            line-height:20px;
            font-family: Arial; 
            font-weight: regular;
        }

        .importante {
            background-color: #fafafa;
            margin-bottom: 1rem;
            padding: 1rem;
            border: 1px solid #ccc;
            text-align: justify;
            width: 85%;
            margin-left: auto;
            margin-right: auto;
            line-height:20px;
            font-family: Arial; 
            font-weight: regular;
        }

        .p {
            line-height:150%;

        }

        .datosBasicos {
            text-align: justify;
            width: 92%;
            margin-left: auto;
            margin-right: auto;
            font-size: 100%;
            line-height:20px;
            font-family: Arial; 
            font-weight: regular;
        }

        .linkModulo {
            text-align: center;
            font-size: 120%;
            font-weight: bold;
            border-style: none;
            padding: 12px;
            width: 320px;
            margin: 0 auto;
            background-color: #8CC63F;
            color: #FFFFFF;
            border-radius: 20px;
            line-height:15px;
            font-family: Arial; 
            font-weight: regular;
        }

        .linkModulo:hover {
            background-color: #69952F;
        }

        a:link,
        a:visited,
        a:active {
            text-decoration: none;
            color: #FFFFFF;
        }

        .codSeguridad {
            text-align: center;
            font-size: 130%;
            font-weight: bold;
            color: #FF0004;
        }

        .noRespuesta {
            text-align: center;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            font-size: 90%;
            color: #0071BC;
            font-style: oblique;
            font-weight: bold;
            line-height:15px;
            font-family: Arial; 
            font-weight: regular;
        }

        .cabecera img {
            max-width: 40%;
        }

        .tarjetonid {
            border: solid 2px;
            padding-left: 2px;
            padding-right: 2px;
        }

        /** estilo para el boton file */
    </style>
    <!-- end css -->
</head>
<div class="cabecera">
  

    <img  style="height: 25%;" src="{{asset('imagen/logoConciweb1.png')}}" alt="ConciwebLogo">
    
</div>
<div class='saludo'>
    <p>Cordial saludo 
        <br><b><strong class="px-2" style="text-transform: uppercase;color:#0171BD" class="px-2">{{$nombrecompleto}}</strong></b>
        <br>
        @if (isset($emailApoderado) && !empty($emailApoderado)) 
        <b><strong style="text-transform: uppercase;color:#0171BD" class="px-2">{{$apoderado}}</strong></b>
        <br>
        @endif
    </p>
    <p>
        El Centro de Conciliación de la Personería de Bogotá D.C., informa que el día {{$fechaRegistro}} se inició el proceso de registro de una Solicitud de Conciliación a través de nuestro sistema de información CONCIWEB.   
    </p>
    <p>
        Su cuenta de correo electrónico ha sido autorizada para recibir la información necesaria para continuar con su requerimiento, 
        por ello para el trámite solicitado debe  <strong>ADJUNTAR LOS SIGUIENTES DOCUMENTOS EN EL TÉRMINO MÁXIMO DE CINCO (5) DIAS HÁBILES:</strong>
    </p>
    
    <div class="row">
        <ul>
            @foreach ($asuntos as $info)
            <li style="text-justify">{!! $info->descripcion->nombre !!}</li> 
            @endforeach
            @if($tiposolicitud==1)
            <li style="text-justify">Poder especial para conciliar dirigido al centro de conciliación de la personería de Bogota D.C. *</li> 
            @endif
          </ul>  
    </div>
</div>
<br>
<div class="importante">
<p><span><b>***IMPORTANTE: Si no se envían los documentos en este término, se entenderá que el solicitante ha perdido el interés en la solicitud y, en consecuencia, se tendrá por no presentada y se procederá a su archivo.  (Artículo 53, Ley 2220 de 2022)*** </b></span></p>
    
    <p> Para finalizar, debe tener presente los siguientes datos y dar clic en el botón adjuntar documentos: </p>
    <div class='datosBasicos'>
        <ul>

            <li style="text-justify">Correo electrónico registrado:<b style="font-size: 20px;font-weight: bold; color:#0171BD;"> {{$email}}</b></li> 
            <li style="text-justify">Pin:<b style="font-size: 20px;font-weight: bold; color:#0171BD;"> {{$llaveingreso}}</b></li> 
            <li style="text-justify">Número de solicitud:<b style="font-size: 20px;font-weight: bold; color:#0171BD;"> {{$numSolicitud}}</b></li> 
  
          </ul>  
       
        <center>
       
       <br>
       {{-- <a class="btn-perso"  type="button" href="https://conciwebv2.personeriabogota.gov.co/search">Adjuntar Documentos</a> --}}
       <div>
       {{-- <a class="btn-perso" style="vertical-align: bottom;" type="button" href="https://conciweb2-dev.personeriabogota.gov.co/search">Adjuntar Documentos <img style="    vertical-align: middle;
        padding-top: 2px;
        padding-bottom: -23px;
        padding-bottom: 4px;" width="25" height="25" src="https://img.icons8.com/windows/32/FFFFFF/file-upload.png" alt="file-upload"/></a> --}}
               <a class="btn-perso" style="vertical-align: bottom;" type="button" href="https://conciwebv2.personeriabogota.gov.co/search">Adjuntar Documentos <img style="    vertical-align: middle;
                padding-top: 2px;
                padding-bottom: -23px;
                padding-bottom: 4px;" width="25" height="25" src="https://img.icons8.com/windows/32/FFFFFF/file-upload.png" alt="file-upload"/></a>
    </div>
   
        <div></div>
     </center>
    </div>
    <br>
    <br>
    <div class='noRespuesta'>El presente mensaje es EXCLUSIVAMENTE informativo, y no deber&aacute; ser respondido.
    <p> <strong> IMPORTANTE.</strong> Si usted desconoce el trámite que mediante el presente correo la Personería de Bogotá D.C., le está dando a conocer, le solicitamos reportarlo al correo <strong> conciliaciones@personeriabogota.gov.co</strong> 
        para adelantar el procedimiento correspondiente y proceder a la eliminación de sus datos del sistema <strong> CONCIWEB.</strong> </p>
    </div>
</div>

</body>

</html>