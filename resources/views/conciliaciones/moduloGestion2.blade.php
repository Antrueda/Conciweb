
<link rel="stylesheet" href="{{ base_path() }}/public/css/bootstrap.css" />
<link rel="stylesheet" href="{{URL::asset('https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css')}}" />



    <div class="card">
        <div class="card-header text-left" id="headingOne">
            <img src="{{ base_path() }}/public/imagen/logo.png" style="width: 15%">
        </div>
    </div>
    <br>

        <div class="container" style="background-color: white">
            <br>
            <?php $i=1; ?>
            <center>
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-3">
                            <i class="fas fa-user-check fa-9x"></i>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title">CC:{!! $datosCiudadano[0]->cedula !!}</h5>
                                <p class="card-text"><strong>
                                    Nombre del ciudadano:{!! $datosCiudadano[0]->nombre !!} {!! $datosCiudadano[0]->apellido !!}<br>
                                    Fecha y hora de la impresion de la Consulta: {!! date('Y-m-d H:i:s'); !!}
                                </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
            </div>


            <table class="table table-striped table-bordered small">
                <thead>
                <tr>
                    <th>Nº</th>
                    <th>SINPROC</th>
                    <th>FECHA CREACION</th>
                    <th>VIGENCIA</th>
                    <th>TIPO TRAMITE</th>
                    <th>OBJETO / MOTIVO</th>
                    <th>ESTADO</th>
                </tr>
                </thead>
                <tbody>
                @foreach($registrosCiudadano as $datosRespuesta)
                    <tr class="text-left" >
                        <td><?php echo $i; $i++; ?></td>
                        <td class="text-justify">{!! $datosRespuesta->num_solicitud !!}</td>
                        <td class="text-center">{!! date("d/m/Y", strtotime($datosRespuesta->fec_solicitud_tramite))  !!}</td>
                        <td class="text-center">{!! $datosRespuesta->vigencia !!}</td>
                        <td>{!! $datosRespuesta->nom_tramite !!}</td>
                        <td>{!! $datosRespuesta->texto08 !!}</td>
                        <td class="text-center">{!! $datosRespuesta->estado_tramite !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        <br>


