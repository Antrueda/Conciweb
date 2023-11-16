
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .contenedor {
           
            overflow: hidden;
            min-height: 100vh;
        }

        #header{
            position: fixed;
            top: -2.3cm;
            left: 0cm;
            width: 100%;
            margin-top: 10px;
            height: 80px;
            
        }

        @page{
            margin-top: 3.5cm;
            
        }

        table {
            width: 100%; /* Ancho total de la tabla */
            border-collapse: collapse; /* Borra los bordes entre las celdas */
        }
        th, td {
            width: 50%; /* Ancho de las celdas (50% para dos columnas iguales) */
            
            padding: 10px; /* Espacio interno de las celdas (ajusta según tus necesidades) */
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
        .columnss {
            column-count: 2; /* Número de columnas deseado */
            column-gap: 5px; /* Espacio entre columnas (ajusta según tus necesidades) */
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


       .columnas {       
        display: flex;       
        flex-wrap: wrap;     
    }     
    


            .columna {    
          width: 50%;
          float: left;      
          box-sizing: border-box;      
          padding: 10px;   
          }    
         .clear {     
        clear: both;   
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
    <header class="header" id="header">
        <a href="http://personeriabogota.gov.co/" class="column column__uno">
            <img src="{{URL::asset('imagen/logoConciweb1.png')}}" class="rounded mx-auto d-block"  style="width: 2.27in; height: auto;">
        </a>
        <div class="column column__dos">
            <div>
                <span class="header_span"
                    style="font-style:normal;font-weight:bold;font-size:10pt;font-family:Helvetica;color:#564D4D">
                    Bogotá D.C., {{$data['fechaactual']}}  
                </span><br>
     
            </div>
        </div>
    </header>

    <div class="contenedor">
   

        <div class="caja_subtitulo">
            <span class="caja_titulo__span" >
                SOLICITUD DE CONCILIACIÓN No. {{$data['dato']->num_solicitud}}  DE {{$data['dato']->vigencia}}</b> 
            </span><br>

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
                <th scope="col" style="color:#35A8E4;width:218px">Cuantía</th>
                <th scope="col" style="color:#35A8E4;width:90%">Correo Electrónico</th>
                
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
                    <li class="list-group-item"><p style="color:#35A8E4">Resumen de la pretensión o conflicto:</p><p> {{$data['dato']->detalle}}</p></li>
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
                                     <th scope="col" style="color:#35A8E4;width:218px">Teléfono Fijo</th>
                            <th scope="col" style="color:#35A8E4;width:90%">Correo Electrónico</th>
                            
                          </tr>
                          <tr>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->segundotelefonoapoderado}}</td>
                            <td scope="col" style="text-transform: uppercase">{{$data['dato']->emailapoderado}}</td>
                          </tr>
                        </thead>
                    </table>    <br>
                    <hr noshade="noshade" align="center" style="border-top: none; border-color: #35A8E4; border-style:solid; color: #35A8E4; height: 0.5px; margin-top: -5px; text-align: center;" />
                
            @endif
      
            <div class="caja_subtitulo">
                <span class="caja_titulo__span" style="color:#35A8E4">
                    DATOS DE CONVOCADOS
                </span><br>
            </div>
            <br>
       
            <div class="columna">
                @foreach ($data['convocates'] as $key => $item)
                    @if ($key % 2 == 0)
                    <p style="color:#35A8E4">Nombre Convocado (Correo Electrónico)</p>
                    <p>{!! $item->nomconvocante . ' ' . $item->apeconvocante . ' ' .  $item->emailconvocante  !!}</p>
                    @endif
                @endforeach
            </div>
            <div class="columna">
                @foreach ($data['convocates'] as $key => $item)
                    @if ($key % 2 == 1)
                    <p style="color:#35A8E4">Nombre Convocado (Correo Electrónico)</p>
                    <p>{!! $item->nomconvocante . ' ' . $item->apeconvocante . ' ' .  $item->emailconvocante  !!}</p>
                    @endif
                @endforeach
            </div>
            <br>
            
        <div    class="clear">

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

  


   
    </div>
   

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 10;
                    $pageText = "Hoja " . $PAGE_NUM . " de " . $PAGE_COUNT;
                    $y = 62;
                    $x = 515;
                    $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>

</html>