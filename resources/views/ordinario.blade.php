
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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

        .columns {
            column-count: 3;
            column-gap: 10px;
        }
        .item {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .texto-capitalizado::first-letter {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <div class="contenedor">
        <header class="header">
            <a href="http://personeriabogota.gov.co/" class="column column__uno">
                <img src="{{URL::asset('imagen/logoConciweb.png')}}" class="rounded mx-auto d-block"  style="width: 2.27in; height: auto;">
            </a>
            <div class="column column__dos">
                <div>
                    <span class="header_span"
                        style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">CERTIFICADO
                        ORDINARIO VÍA WEB
                    </span><br>
                    <span class="header_span"
                        style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#000000">
                    </span>
                </div>
            </div>
        </header>
        <div class="caja_fecha">
            <span class="caja_fecha__span">
                Bogotá D.C., {{$data['fechaactual']}}
            </span>
        </div>
        <div class="caja_titulo">
            <span class="caja_titulo__span">
                SOLICITUD DE CONCILIACIÓN No. {{$data['dato']->num_solicitud}}  DE {{$data['dato']->vigencia}}</b> 
            </span><br>
            <span class="caja_titulo__span">
                LA PERSONERÍA DE BOGOTÁ, D.C.
            </span><br><br>
            <span class="caja_titulo__span">
                DATOS DEL SOLICITANTE
            </span>
        </div>
        <div class="card-body" style="margin-bottom: 10px;" >
                  <div class="row">
                    <div class="col-md-3">
                      <b  style="color:#0171BD">Tipo de Documento</b>
                      <p style="text-transform: uppercase">{{$data['tipodedocumento']}}</p>
                    </div>
                    <div class="col-md-3">
                      <b  style="color:#0171BD">Número de Documento</b>
                      <p style="text-transform: uppercase">{{$data['dato']->id_usuario_reg}}</p>
                    </div>
                    <div class="col-md-3">
                     <b  style="color:#0171BD">Solicitante</b>
                      <p style="text-transform: uppercase"> {{$data['nombrecompleto']}}</p>
                    </div>
                    <div class="col-md-3">
                     <b  style="color:#0171BD">Fecha de Solicitud</b> <b  style="color:#0171BD;font-size:80%">(dd-mm-yyyy)</b>
                     <p style="text-transform: uppercase"> {{$data['newDate']}}</p>
                    </div>
                    <div class="col-md-3">
                     <b  style="color:#0171BD">Asuntos</b>
                      <p style="text-transform: uppercase"> {{$data['dato']->asuntos->nombre}}</p>
                    </div>
                    <div class="col-md-3">
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
 
                  @if($data['tiposolicitud']==1)      
                  <div class="caja_titulo">
                      <span class="caja_titulo__span">
                          DATOS DEL APODERADO
                      </span><br>
                  </div>
          
                  <div class="card-body" style="margin-bottom: 10px;" >
                      <div class="row"  >
                        <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">Tipo de Documento</b></label>
                          <p style="text-transform: uppercase">{{$data['tipodedocapoderado']}}</p>
                        </div>
                        <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">Número de Documento</b></label>
                          <p style="text-transform: uppercase">{{$data['dato']->numdocapoderado}}</p>
                        </div>
                        <div class="col-md-4 mt-2">
                         <b  style="color:#0171BD">Nombre Apoderado</b></label>
                          <p style="text-transform: uppercase"> {{$data['apoderado']}}</p>
                        </div>
                        <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">No. Tarjeta Profesional</b></label>
                           <p style="text-transform: uppercase"> {{$data['dato']->tarjetaprofesional}}</p>
                         </div>
                         <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">Dirección</b></label>
                           <p style="text-transform: uppercase"> {{$data['dato']->direccionapoderado}}</p>
                         </div>
                         <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">Teléfono Celular</b></label>
                           <p style="text-transform: uppercase"> {{$data['dato']->primertelefonoapoderado}}</p>
                         </div>
                         <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">Teléfono Fijo</b></label>
                           <p style="text-transform: uppercase"> {{$data['dato']->segundotelefonoapoderado}}</p>
                         </div>
                         <div class="col-md-4 mt-2">
                          <b  style="color:#0171BD">Correo Electrónico</b></label>
                           <p style="text-transform: uppercase"> {{$data['dato']->emailapoderado}}</p>
                         </div>
                    
                    
                    
                      </div>
                    
                    
                      </div>
                 
            @endif
            <div class="caja_titulo">
                <span class="caja_titulo__span">
                    DATOS DE CONVOCADOS
                </span><br>
            </div>
         

                <div class="row"  >
                  @foreach ($data['convocates'] as $info)
                  
                  
                  <div class="col-md-3 mt-2 pt-10" style="
               
                      text-align: justify;" >
                    <b  style="color:#0171BD">Nombre Convocado (Correo Electrónico)</b></label>
                    <p style="text-transform: uppercase">{!! $info->nomconvocante . ' ' . $info->apeconvocante !!} <span style="text-transform: lowercase"> ({!! $info->emailconvocante  !!}) </span></p>
                  </div>
             
                  @endforeach 
              </div>
      

        <div class="caja_certifica">
            <span class="caja_titulo__span">REGISTRA LOS SIGUENTES DOCUMENTOS</span>
        </div>
        @foreach ($data['tramite'] as $archivos)
            <div class="caja_sancion">
                <ul>
                <li style="text-justify;width:80%;vertical-align: middle;" >{!! $archivos->descripcion !!}</li>
            </ul>
            </div>
        @endforeach






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