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
            width: 88%;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-perso{
             background-color: #0d6efd;
                border-color:#0d6efd;
                color: white;
                border-radius: 5px;
                font-family: 'Public Sans', sans-serif;
                font-size: .875rem;
                padding: 6px 18px;
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
            font-family: 'Public Sans', sans-serif;
        }

        .datosBasicos {
            text-align: justify;
            width: 92%;
            margin-left: auto;
            margin-right: auto;
            font-size: 100%;
            font-family: 'Public Sans', sans-serif;
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
            font-family: 'Public Sans', sans-serif;
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
            font-family: 'Public Sans', sans-serif;
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
    {{-- <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAnAAAACrCAMAAADRq1FUAAAA5FBMVEVMaXEdcLcdcLc1qOAdcLcd
    cLcdcLcdcLcdcLc1qOAdcLcdcLcdcLcdcLftHCQdcLcdcLftHCQdcLcdcLftHCQdcLcdcLcdcLcd
    cLcdcLcdcLcdcLcdcLc1qOAdcLcdcLc1qOAdcLc1qOA1qOA1qOA1qOA1qOA1qOA1qOAdcLc1qOA1
    qOAdcLftHCQdcLc1qODtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTt
    HCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCTtHCQdcLc1qODtHCStuRcqAAAASXRSTlMAwBBm
    RN3wgHd3MGC70EQiEcDuoEBAqmYz4CBVzDOQiLuZVaru3ZkiEVCIzHC7sER37hDw4CLdEdCAkCCg
    YDCZqlAzzFVwiGawWy4ojAAAAAlwSFlzAAALEgAACxIB0t1+/AAAGexJREFUeJztXWtb2zjTdlIg
    CYFCk4ZDOJYChQIFSs/tbrvt7j5v8P//P+9lybJmpNHBiR28dO4PuzS25XF0Z86SEwaDwWAwGAwG
    g8FgMBgMBoPBYDAYDAaDwWAwGAwGg8FgMBgMBoPBYDAYDAaDwWAwGAwGg8FgMBgMBoPBYDAYDAaD
    wWAwGAwGg1EH1rs5thr89a53dyeTyWSj+9CCbGXf1TxuNL4ctnK86XTOR/O4Z+3Y6m5MEDa6C40U
    dKcQcvFBfxZbu1KKjdrvNF6aGNhudUbt2u9bI7a65iNJHDSPc1tAvMX1h5NjbaCkWKn7Vh16clY7
    y3XfuSYsrNBPJOZ0s2HCIlkf0KoCe1D3V9Ryzs72/n+Qc1seugnKNUrLrSPZ6jdnMXLULYWbcBnn
    Lv9jttVhTCEe3DsHWEOS1W7NnECWveZ7CcINR6PR6LzTGba2zfkZjmsWoEKsB9SbxE5zBN5Cgu0+
    mBwL8yZcB3ww6u9jrdf6r1jWtcUYvtX+jZZAU0zqgxJO4HwfqLqlftlBx5nGnLdqjOTbZLI2Z8E8
    aEjQ8PCES5JkGXCuTHJuuVMoyNb++ZRSjUejy06ns68yhJ0we6P5NmlQ3NCQtEgjCJdZ1ze5ENvR
    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
    BoMRjyRJ/h+GoUfSgT6GhQAAAABJRU5ErkJggg==" alt="img" /> --}}

    <img  src="{{asset('imagen/PropuestalogoConciweb1.png')}}" alt="ConciwebLogo">
    
</div>
<div class='saludo'>
    <p>Cordial saludo <strong>{{$nombrecompleto}}</strong></p>
    <p>
        La Personería de Bogotá D.C., informa que el día {{$fechaRegistro}} se inició el proceso de registro de una Solicitud de Conciliación a través de nuestro sistema de información CONCIWEB.   
    </p>
    <p>
        Su cuenta de correo electrónico ha sido autorizada para recibir la información necesaria para continuar con su requerimiento, 
        por ello para el trámite solicitado debe  <strong>ADJUNTAR LOS SIGUIENTES DOCUMENTOS:</strong>
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
    <p> Para finalizar, debe tener presente los siguientes datos y dar clic en el botón adjuntar documentos: </p>
    <div class='datosBasicos'>
        <ul>

            <li style="text-justify">Correo electrónico registrado:<span style="font-size: 20px;font-weight: bold; color:red;"> {{$email}}</span></li> 
            <li style="text-justify">Pin o Contraseña:<span style="font-size: 20px;font-weight: bold; color:red;"> {{$llaveingreso}}</span></li> 
            <li style="text-justify">Numero de solicitud:<span style="font-size: 20px;font-weight: bold; color:red;"> {{$numSolicitud}}</span></li> 
  
          </ul>  
       
        <center>
       
       <br>
       {{-- <a class="btn-perso"  type="button" href="https://conciwebv2.personeriabogota.gov.co/search">Adjuntar Documentos</a> --}}
       <a class="btn-perso"  type="button" href="https://conciweb2-dev.personeriabogota.gov.co/search">Adjuntar Documentos</a>
     
   
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