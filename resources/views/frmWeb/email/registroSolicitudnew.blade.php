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
             background-color: #003e65;
                border-color:#003e65;
                color: white;
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
    <img src="/imagen/logo5.png" alt="Logo Personer??a de Bogot??" class="logo">
</div>
<div class='saludo'>
    <p>Cordial saludo <strong>{{$nombrecompleto}}</strong></p>
    <p>
        La Personer??a de Bogot??, D.C., le informa que se utiliz?? esta direcci??n de correo electr??nico, se ingresaron datos personales a su nombre el d??a {{$fechaRegistro}}. Esos datos son inmodificables. 
    </p>
    <p>
        Lo anterior, significa que a su nombre se accedi?? al M??dulo de Solicitud de Conciliaci??n via web que la Personer??a de Bogot??, D.C.
    </p>
    <p> En consecuencia, para que se pueda continuar con el proceso se requiere <strong>ADJUNTAR LOS DOCUMENTOS CORRESPONDIENTES</strong> que son los siguientes:</p>
    <div class="row">
        <ul>
            @foreach ($asuntos as $info)
            <li style="text-justify">{!! $info->descripcion->nombre !!}</li> 
            @endforeach
          </ul>  
    </div>
    <p> Sus datos de ingreso asignados son:</p>
    <div class='datosBasicos'>
        <p>
            Dentro de los datos requeridos deber?? incluir la direcci??n de <strong>ESTE CORREO ELECTR??NICO</strong>: <span style="font-size: 20px;font-weight: bold; color:red;">{{$email}}</span> , el siguiente <strong>PIN o CONTRASE??A</strong>: <span style="font-size: 20px;font-weight: bold; color:red;"> {{$llaveingreso}}</span> y el <strong>NUMERO DE SU SOLICITUD</strong>: <span style="font-size: 20px;font-weight: bold; color:red;">{{$numSolicitud}}</span>
            
        </p>
        <center>
        <button class="btn btn-perso"><a class="btn btn-info" href="{{ route('search') }} ">Adjuntar Documentos</a></button>
     </center>
    </div>
</div>

<div class='noRespuesta'>El presente mensaje es EXCLUSIVAMENTE informativo, y no deber&aacute; ser respondido.</div>
</body>

</html>