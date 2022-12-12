<?php
    $numSinproc=$data['numSolicitud'];
    $tipo=$data['tipo'];
?>
<style>
    .contenedoresPasos{
        padding :0 0 0 0;
    }
</style>
@foreach ($data['datosEstadoEtapas'] as $info)
    <div class="alert alert-primary text-center " role="alert" style="color: white; background-color:#003E65">
        <h6 style="margin-bottom:-13px">CONSULTADO EL PROCESO DE CONCILIACION: [ SINPROC <u>{{ $numSinproc }}</u> - CASO <u>{{$info->sicnumeroregistroconciliacion }}</u> ]</h6><br>
        <strong>ETAPAS DEL PROCESO :<small>
                &nbsp;Recuerde... toda etapa finalizada se verá reflejada con el siguiente icono <i class="fas fa-check fa-3x" ></i>
                Si la etapa no posee el icono indicado esta no tiene información registrada.</small>
        </strong>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 container-border" data-toggle="tooltip" data-html="true" title="CONVOCANTE">
                    <span class="btn btn-primary btn-block contenedoresPasos" onclick="modalConvcaConvocan('{{ $numSinproc }}','CONVOCANTE')">
                        <?php  if($info->paso2==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?>   CONVOCANTE
                    </span>
                </div>
                <div class="col-md-4 container-border" data-toggle="tooltip" data-html="true" title="CONVOCADOS">
                    <span class="btn btn-primary btn-block contenedoresPasos" onclick="modalConvcaConvocan('{{ $numSinproc }}','CONVOCADO')">
                            <?php  if($info->paso3==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?>  CONVOCADOS
                    </span>
                </div>
                <div class="col-md-4 container-border" data-toggle="tooltip" data-html="true" title="HECHOS DEL CASO">
                    <span class="btn btn-primary btn-block contenedoresPasos"  onclick="modalGenerico('{{ $numSinproc }}','modalInfoHechos')">
                        <?php  if($info->paso4==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?>  HECHOS
                    </span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 container-border" data-toggle="tooltip" data-html="true" title="CONCILIADOR DEL CASO">
                        <span class="btn btn-primary btn-block contenedoresPasos" onclick="modalGenerico('{{ $numSinproc }}','modalInfoConciliador')">
                            <?php  if($info->paso5==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?>  CONCILIADOR
                        </span>
                </div>
                <div class="col-md-4 container-border" data-toggle="tooltip" data-html="true" title="INFORMACIÓN DE LA AUDIENCIA">
                        <span type="button" class="btn btn-primary btn-block contenedoresPasos" style="white-space: normal;" onclick="modalGenerico('{{ $numSinproc  }}','modalInfoAudiencia')">
                            <?php  if($info->paso6==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?>  INFORMACIÓN AUDIENCIA
                        </span>
                </div>
                <div class="col-md-4 container-border" data-toggle="tooltip" data-html="true" title="MANEJO DEL CONFLICTO">
                        <span class="btn btn-primary btn-block contenedoresPasos"  onclick="modalGenerico('{{ $numSinproc }}','modalInfoConflicto')">
                            <?php  if($info->paso7==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?> MANEJO DE CONFLICTO
                        </span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 container-border" data-toggle="tooltip" data-html="true" title="CIERRE DE LA AUDIENCIA">
                        <span class="btn btn-primary btn-block " onclick="modalGenerico('{{$numSinproc }}','modalCierreCaso')">
                            <?php  if($info->paso8==1) { ?> <i class="fas fa-check fa-3x" ></i> <?php } ?>  CIERRE DE LA AUDIENCIA
                        </span>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header text-left">
                    SECCIÓN DE CONVOCANTES
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="btn btn-primary btn-block " onclick="modalGestionEsp('{{ $numSinproc }}','CONVOCANTE','actualesUsuario','GENERAL')">ACTUALES CONVOCANTES</span>
                        </div>
                        <div class="col-md-4 ">
                            <span class="btn btn-primary btn-block " onclick="modalGestionEsp('{{ $numSinproc }}','CONVOCANTE','seccionApodeardoRepLegal','APODERADO')">{!! $data['textoApoderadoConvocante']  !!}</span>
                        </div>
                        <div class="col-md-4">
                            <span class="btn btn-primary btn-block " onclick="modalGestionEsp('{{ $numSinproc }}','CONVOCANTE','seccionApodeardoRepLegal','REPLEGAL')">REP. LEGAL</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="card">
                <div class="card-header text-left">
                    SECCIÓN DE CONVOCADOS
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <span class="btn btn-primary btn-block " onclick="modalGestionEsp('{{ $numSinproc }}','CONVOCADO','actualesUsuario','GENERAL')">ACTUALES CONVOCADOS</span>
                        </div>
                        <div class="col-md-4 ">
                            <span class="btn btn-primary btn-block " onclick="modalGestionEsp('{{ $numSinproc }}','CONVOCADO','seccionApodeardoRepLegal','APODERADO')">{!! $data['textoApdoeradoConvocado']  !!}</span>
                        </div>
                        <div class="col-md-4">
                            <span class="btn btn-primary btn-block " onclick="modalGestionEsp('{{ $numSinproc }}','CONVOCADO','seccionApodeardoRepLegal','REPLEGAL')">REP. LEGAL</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="card">
            <div class="card-header text-left">
                IMPRESION DE CONSTANCIAS Y FORMATOS
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 container-border" data-toggle="tooltip" data-html="true" title="CITACIONES PARA CONVOCADOS">
                        <span class="btn btn-primary btn-block"  onclick="modalPrintConsConvocados('{{ $numSinproc }}')">
                            <i class="fas fa-file-pdf fa-1x" ></i> CITACIONES
                        </span>
                    </div>
                    <div class="col-md-3 container-border" data-toggle="tooltip" data-html="true" title="CARATULA INICIA">
                        <a href="{{ url("conciliaciones/pdf/printActas/printActaIncial/{$numSinproc}")}}">
                            <span class="btn btn-primary btn-block">
                                <i class="fas fa-file-invoice fa-1x" ></i> CARATULA INICIAL
                            </span>
                        </a>
                    </div>
                    <div class="col-md-3 container-border" data-toggle="tooltip" data-html="true" title="REGISTRO DEL CASO">
                        <a href="{{ url("conciliaciones/pdf/printActas/printActaFinal/{$numSinproc}")}}">
                        <span class="btn btn-primary btn-block">
                            <i class="fas fa-file-signature fa-1x" ></i> ACTA DE REGISTRO
                        </span>
                        </a>
                    </div>
                    @if ( $data['carpeta'] != 'NULL' &&  $data['archivo'] != 'NULL')
                        @if ( $tipo==0 ||$tipo==1 || $tipo==2 || $tipo==3 || $tipo==4 || $tipo==5 || $tipo==6 )
                            <div class="col-md-3 container-border" data-toggle="tooltip" data-html="true" title="ACTA DE CIERRE">
                                <a href="{{ url("conciliaciones/word/{$numSinproc}/{$tipo}")}}">
                                <span class="btn btn-primary btn-block">
                                 <i class="fas fa-file-word fa-1x" ></i> ACTA DE CIERRE
                                </span>
                                </a>
                            </div>
                        @else
                            <div class="col-md-3 container-border" data-toggle="tooltip" data-html="true" title="ACTA DE CIERRE">

                                <span class="btn btn-danger btn-block">
                                 <i class="far fa-times-circle fa-1x" ></i> ACTA NO DISPONIBLE
                                </span>

                            </div>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>


@endforeach

<script>

    var type='info';
    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p>Modulo Listo para su uso</center>";
    var layout='topRight';

    function modalGenerico(sinproc,url){
        $.ajax({
            url:url,
            type:"POST",
            data:{sinproc:sinproc},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () { llamarNotyCarga(); },
            success:function(respuesta){
                llamarNotyTime(type,msg,layout,500);
                $("#modalRespuesta").html(respuesta); },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

    function modalConvcaConvocan(sinproc,rol){
        $.ajax({
            url:'modalConvcaConvocan',
            type:"POST",
            data:{sinproc:sinproc,rol:rol},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () { llamarNotyCarga(); },
            success:function(respuesta){
                llamarNotyTime(type,msg,layout,500);
                $("#modalRespuesta").html(respuesta);
                },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

    function modalGestionEsp(sinproc,rol,url,tipo){
        $.ajax({
            url:url,
            type:"POST",
            data:{sinproc:sinproc,rol:rol,tipo:tipo},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () { llamarNotyCarga(); },
            success:function(respuesta){
                llamarNotyTime(type,msg,layout,500);
                $("#modalRespuesta").html(respuesta);
                },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

    function  modalPrintConsConvocados(sinproc){
        $.ajax({
            url:"modalPrintconstancias",
            type:"POST",
            data:{sinproc:sinproc},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () { llamarNotyCarga(); },
            success:function(respuesta){
                llamarNotyTime(type,msg,layout,500);
                $("#modalRespuesta").html(respuesta);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Algo anda mal'+ textStatus); console.log(XMLHttpRequest);
            }
        })
    }

</script>