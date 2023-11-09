
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

        .caja_subtitulo {
            line-height: 10pt;
            text-align: left;
            padding-top: 20px;
        }

        .caja_titulo__span {
            font-style: normal;
            text-align: left;
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
                <img src="{{URL::asset('imagen/logoConciweb1.png')}}" class="rounded mx-auto d-block"  style="width: 2.27in; height: auto;">
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
            <span class="caja_titulo__span" >
                SOLICITUD DE CONCILIACIÓN No. {{$data['dato']->num_solicitud}}  DE {{$data['dato']->vigencia}}</b> 
            </span><br>
            <span class="caja_titulo__span">
                LA PERSONERÍA DE BOGOTÁ, D.C.
            </span><br><br>

        </div>
    
        <div class="caja_subtitulo">
            <span class="caja_titulo__span"style="color:#35A8E4">
                DATOS DEL SOLICITANTE
            </span><br>
        </div>
        <br>
        <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
            <thead>
              <tr style="">
                <th scope="col" style="color:#35A8E4">Tipo de Documento</th>
                <th scope="col" style="color:#35A8E4">Número de Documento</th>
                <th scope="col" style="color:#35A8E4">Solicitante</th>
                
              </tr>
              <tr>
                <td scope="col" style="text-transform: uppercase">{{$data['tipodedocumento']}}</td>
                <td scope="col" style="text-transform: uppercase">{{$data['dato']->id_usuario_reg}}</td>
                <td scope="col" style="text-transform: uppercase">{{$data['nombrecompleto']}}</td>
              </tr>
          
            </thead>
     
          </table>
          <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
            <thead>
              <tr style="">
                <th scope="col" style="color:#35A8E4">Fecha de Solicitud<b  style="color:#35A8E4;font-size:80%">(dd/mm/yyyy)</b></th>
                <th scope="col" style="color:#35A8E4">Asuntos</th>
                <th scope="col" style="color:#35A8E4">Sub Asunto</th>
                
              </tr>
              <tr>
                <td scope="col" style="text-transform: uppercase">{{$data['newDate']}}</td>
                <td scope="col" style="text-transform: uppercase">{{$data['dato']->asuntos->nombre}}</td>
                <td scope="col" style="text-transform: uppercase">{{$data['dato']->subasuntos->nombre}}</td>
              </tr>
             
            </thead>
     
          </table>
          <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
            <thead>
              <tr style="">
                <th scope="col" style="color:#35A8E4">Cuantía</th>
                <th scope="col" style="color:#35A8E4">Correo Electrónico</th>
                
              </tr>
              <tr>
                <td scope="col" style="text-transform: uppercase">{{$data['numero']}}</td>
                <td scope="col" style="text-transform: uppercase">{{$data['dato']->email}}</td>
              </tr>
      
         
            </thead>
     
          </table>
                
     
                
<br>
          <hr noshade="noshade" align="center" style="border-top: none; border-color: #35A8E4; border-style:solid; color: #35A8E4; height: 1px; margin-top: -5px; text-align: center;" />
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b style="color:#35A8E4">Resumen de la pretensión o conflicto:</b><p> {{$data['dato']->detalle}}</p></li>
                  </ul><br>
                  <hr noshade="noshade" align="center" style="border-top: none; border-color: #35A8E4; border-style:solid; color: #35A8E4; height: 1px; margin-top: -5px; text-align: center;" />
                  @if($data['tiposolicitud']==1)      
                  <div class="caja_subtitulo">
                      <span class="caja_titulo__span"style="color:#35A8E4">
                          DATOS DEL APODERADO
                      </span>
                  </div>
          <br>
 

                      <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
                        <thead>
                          <tr style="">
                            <th scope="col" style="color:#35A8E4">Tipo de Documento</th>
                            <th scope="col" style="color:#35A8E4">Número de Documento</th>
                            <th scope="col" style="color:#35A8E4">Nombre Apoderado</th>
                            
                          </tr>
                          <tr>
                            <td scope="col" style="text-transform: uppercase">{{$data['tipodedocapoderado']}}</td>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->numdocapoderado}}</td>
                            <td scope="col" style="text-transform: uppercase">{{$data['apoderado']}}</td>
                          </tr>
                      
                        </thead>
                 
                      </table>
                      <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
                        <thead>
                          <tr style="">
                            <th scope="col" style="color:#35A8E4">No. Tarjeta Profesional</th>
                            <th scope="col" style="color:#35A8E4">Dirección</th>
                            <th scope="col" style="color:#35A8E4">Teléfono Celular</th>
                            
                          </tr>
                          <tr>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->tarjetaprofesional}}</td>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->direccionapoderado}}</td>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->primertelefonoapoderado}}</td>
                          </tr>
                        </thead>
                    </table>
                    <table class="table table-striped" style="--bs-table-striped-bg:#F5F9FC">
                        <thead>
                          <tr style="">
                            <th scope="col" style="color:#35A8E4">Teléfono Fijo</th>
                            <th scope="col" style="color:#35A8E4">Correo Electrónico</th>
                            
                          </tr>
                          <tr>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->segundotelefonoapoderado}}</td>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->emailapoderado}}</td>
                          </tr>
                        </thead>
                    </table>    <br>
                    <hr noshade="noshade" align="center" style="border-top: none; border-color: #35A8E4; border-style:solid; color: #35A8E4; height: 1px; margin-top: -5px; text-align: center;" />
                
            @endif
      
            <div class="caja_subtitulo">
                <span class="caja_titulo__span" style="color:#35A8E4">
                    DATOS DE CONVOCADOS
                </span><br>
            </div>
            <br>

                <div class="row"  >
                  @foreach ($data['convocates'] as $info)
                  
              
                    <thead>
                      <tr style="">
                        <th scope="col" style="color:#35A8E4">Nombre Convocado (Correo Electrónico)</th>
                      </tr>
                      <tr>
                        <td scope="col" style="text-transform: uppercase">{!! $info->nomconvocante . ' ' . $info->apeconvocante !!}<span style="text-transform: lowercase"> ({!! $info->emailconvocante  !!}) </span></td>
                        
                      </tr>
                    </thead>
                </table>
         
             
                  @endforeach 
              </div>
              <hr noshade="noshade" align="center" style="border-top: none; border-color: #35A8E4; border-style:solid; color: #35A8E4; height: 1px; margin-top: -5px; text-align: center;" />


        <div class="caja_subtitulo">
            <span class="caja_titulo__span" style="color:#35A8E4;text-align: left">DOCUMENTOS ADJUNTOS</span>
        </div>
        <br>
        @foreach ($data['tramite'] as $archivos)
            <div class="caja_sancion">
                <ul >
                <li style="text-justify;width:80%;vertical-align: middle;color:#35A8E4" ></li><span>{!! $archivos->descripcion !!}</span>
            </ul>
            </div>
        @endforeach
        <hr noshade="noshade" align="center" style="border-top: none; border-color: #35A8E4; border-style:solid; color: #35A8E4; height: 1px; margin-top: -5px; text-align: center;" />





        {{-- <div class="caja_info" style="margin-top: 5px">
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
        </div> --}}
        {{-- <div class="caja_info" style="margin-top: 10px">
            <span style="font-style:normal;font-weight:bold;font-size:7pt;font-family:Helvetica;color:#000000">
                Código de verificación: 6_BQR44_4710. Link de verificación:
            </span>
            <a href="https://www.personeriabogota.gov.co/antecedentes-disciplinarios">
                <span style="font-style:normal;font-weight:bold;font-size:7pt;font-family:Helvetica;color:#000000">
                    https://www.personeriabogota.gov.co/antecedentes-disciplinarios
                </span>
            </a>
        </div> --}}
    </div>
</body>

</html>