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
    <img src="/imagen/logo5.png" alt="Logo Personería de Bogotá" class="logo">
</div>
<div class='saludo'>
    <p>Cordial saludo <strong>{{$nombrecompleto}}</strong></p>
    <p>
        La Personería de Bogotá, D.C., le informa que se utilizó esta dirección de correo electrónico, se ingresaron datos personales a su nombre el día {{$fechaRegistro}}. Esos datos son inmodificables. 
    </p>
    <p>
        Lo anterior, significa que a su nombre se accedió al Módulo de Solicitud de Conciliación via web de la Personería de Bogotá, D.C. en donde adjunto los documentos solicitados para continuar con el proceso 
    </p>
    <div class='datosBasicos'>
        <p>
            Por lo cual sera notificado por medio de <strong>ESTE CORREO ELECTRÓNICO</strong>: <span style="font-size: 20px;font-weight: bold; color:red;">{{$email}}</span> , cuando se haya revisado su solicitud
            
        </p>
    </div>
</div>

<div class='noRespuesta'>El presente mensaje es EXCLUSIVAMENTE informativo, y no deber&aacute; ser respondido.</div>
</body>

</html>