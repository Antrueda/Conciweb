
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .contenedor {
            padding: 25px;
            overflow: hidden;
            min-height: 100vh;
        }

        .header {
            margin-top: 10px;
            height: 80px;
        }

        header .column {
            width: 50%;
            float: left;
        }

        header .column__uno {
            text-align: left;
        }

        header .column__dos {
            text-align: right;
        }

        .header_span {
            font-weight: bold;
            font-size: 10pt;
            color: #000000;
            font-family: Helvetica, sans-serif;
        }

        .caja_fecha {
            width: 100%;
        }

        .caja_fecha__span {
            font-style: normal;
            font-weight: bold;
            font-size: 7pt;
            font-family: Helvetica, sans-serif;
            color: #000000
        }

        .caja_titulo {
            line-height: 0.16in;
            text-align: center;
            padding-top: 20px;
        }

        .caja_titulo__span {
            font-style: normal;
            font-weight: bold;
            font-size: 9pt;
            font-family: Helvetica;
            color: #000000;
        }

        .caja_certifica {
            line-height: 0.16in;
            padding-top: 8px;
            text-align: center;
        }

        .caja_texto {
            line-height: 0.16in;
            padding-top: 15px;
            text-align: justify;
        }

        .caja_derecha {
            line-height: 0.16in;
            padding-top: 18px;
            text-align: left;
        }

        .caja_firma {
            text-align: center;
        }

        .caja_firma img {
            width: 2.69in;
            height: 0.88in;
        }

        .caja_info {
            line-height: 0.13in;
            text-align: center;
            padding-top: 10px;
        }

        .caja_sancion{
            line-height: 0.16in;
            padding-top: 8px;
            text-align: justify;
        }

        .texto-capitalizado::first-letter {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    
    <div class="contenedor">
        <header class="header">
            <a href="http://personeriabogota.gov.co/" class="column column__uno">
                <img src="{{URL::asset('imagen/Propuesta logo Conciweb-2.png')}}" class="rounded mx-auto d-block"  style="width: 100%; height: auto;">
            </a>
            <div class="column column__dos">
                <div>
                    <span class="header_span"
                        style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">CERTIFICADO
                        ORDINARIO VÍA WEB
                    </span><br>
                    <span class="header_span"
                        style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">No.
                        10142941
                    </span>
                </div>
            </div>
        </header>
        <div class="caja_fecha">
            <span class="caja_fecha__span">
                Bogotá D.C., 27 de Junio de 2023 - 10:47 am
            </span>
        </div>
        <div class="caja_titulo">
            <span class="caja_titulo__span">
                SOLICITUD DE CONCILIACIÓN No. {{$data['dato']->num_solicitud}}  DE {{$data['dato']->vigencia}}</b> 
            </span><br>
            <span class="caja_titulo__span">
                LA PERSONERÍA DE BOGOTÁ, D.C.
            </span>
        </div>

        <div class="caja_texto">
            <div class="container">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <b  style="color:#0171BD">Tipo de Documento</b></label>
                      <p style="text-transform: uppercase">{{$data['tipodedocumento']}}</p>
                    </div>
                    <div class="col-md-3">
                      <b  style="color:#0171BD">Número de Documento</b></label>
                      <p style="text-transform: uppercase">{{$data['dato']->id_usuario_reg}}</p>
                    </div>
                    <div class="col-md-3">
                     <b  style="color:#0171BD">Solicitante</b></label>
                      <p style="text-transform: uppercase"> {{$data['nombrecompleto']}}</p>
                    </div>
                    <div class="col-md-3">
                     <b  style="color:#0171BD">Fecha de Solicitud</b> <b  style="color:#0171BD;font-size:80%">(dd-mm-yyyy)</b></label>
                     <p style="text-transform: uppercase"> {{$data['newDate']}}</p>
                    </div>
                    <div class="col-md-3">
                     <b  style="color:#0171BD">Asuntos</b></label>
                      <p style="text-transform: uppercase"> {{$data['dato']->asuntos->nombre}}</p>
                    </div>
                    <div class="col-md-6">
                    <b  style="color:#0171BD">Sub Asunto</b>
                      <p style="text-transform: uppercase"> {{$data['dato']->subasuntos->nombre}}</p>
                    </div>
                    <div class="col-md-3">
                      <b style="color:#0171BD" >Cuantía</b>
                      <p style="text-transform: uppercase">$ {{$data['numero']}}</p>
                    </div>
                    <div class="col-md-3">
                      <b style="color:#0171BD" >Correo Electrónico</b>
                      <p style="text-transform: uppercase">{{$data['dato']->email}}</p>
                    </div>
                  </div>
                
                
                  </div>
                
                
                
           
                  <hr style="color:#0171BD">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b style="color:#0171BD">Resumen de la pretensión o conflicto:</b><p> {{$data['dato']->detalle}}</p></li>
                  </ul>
                </div>
        </div>
        <table class="table table-striped" cellspadding="5px" cellspacing="5px" border="1">
            <thead>
              <tr style=" text-align: center;">
                <th scope="col">Tipo de Documento</th>
                <td>{{$data['dato']->id_usuario_reg}}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$data['dato']->id_usuario_reg}}</td>
                </tr>
            </tbody>
        </table>
 
        <div class="caja_certifica">
            <span class="caja_titulo__span">{{$data['dato']->id_usuario_reg}}</span>
        </div>
        <div class="caja_certifica">
            <span class="caja_titulo__span">{{count($data['detalleAbc']) > 0 ? 'REGISTRA LAS SIGUIENTES ANOTACIONES DE SANCIONES DISCIPLINARIAS' : 'NO REGISTRA SANCIONES NI INHABILIDADES VIGENTES'}}</span>
        </div>
        @foreach ($data['tramite'] as $archivos)
            <div class="caja_sancion">
                <span style="text-justify;width:80%;vertical-align: middle;" >{!! $archivos->descripcion !!}</span>
            </div>
        @endforeach
        <div class="caja_texto" style="margin-top: 5px">
            <span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">
                {{$data['nombrecompleto']}}
            </span>
        </div>

        <div class="caja_derecha">
            <span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">
                ADVERTENCIAS:
            </span>
        </div>
        <div class="caja_texto">
            <span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000">
                {!! nl2br($data['nombrecompleto'])!!}
            </span>
        </div>

        <div class="caja_firma">
            <img src="{{URL::asset('imagen/Propuesta logo Conciweb-2.png')}}" class="rounded mx-auto d-block"  style="width: 100%; height: auto;">
            <div style="line-height:0.16in;">
                <span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">
                    {{$data['nombrecompleto']}}
                </span><br>
                <span style="font-style:normal;font-weight:normal;font-size:9pt;font-family:Helvetica;color:#000000;text-transform: capitalize;">
                    {{$data['nombrecompleto']}}
                </span>
            </div>
        </div>
        <div class="caja_info" style="margin-top: 5px">
            <span
                style="font-style:normal;font-weight:normal;font-size:7pt;font-family:Helvetica;color:#000000">Certificado
                generado por el sitio web: www.personeriabogota.gov.co. Para verificar su validez comuniquese con la
                Personería de Bogotá D.C.
            </span>
            <div style="line-height:0.16in;">
                <span style="font-style:normal;font-weight:bold;font-size:9pt;font-family:Helvetica;color:#000000">
                    Cra. 7 No. 21 - 24 - Conmutador (601)382 0450/80 - www.personeriabogota.gov.co
                </span>
            </div>
        </div>
        <div class="caja_info" style="margin-top: 10px">
            <span style="font-style:normal;font-weight:bold;font-size:7pt;font-family:Helvetica;color:#000000">
                Código de verificación: 6_BQR44_4710. Link de verificación:
            </span>
            <a href="https://www.personeriabogota.gov.co/antecedentes-disciplinarios">
                <span style="font-style:normal;font-weight:bold;font-size:7pt;font-family:Helvetica;color:#000000">
                    https://www.personeriabogota.gov.co/antecedentes-disciplinarios
                </span>
            </a>
        </div>
    </div>
</body>

</html>