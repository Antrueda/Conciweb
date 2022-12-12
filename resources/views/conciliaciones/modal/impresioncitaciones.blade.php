
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form name="frmRegistroDatos" id="frmRegistroDatos">
                <input type="hidden" value="{{$numSinproc=$data['numSolicitud']}}" name="numSolicitud" id="numSolicitud">
                <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                    <div class="row">
                        <div class="col-md-12 text-md-center">
                            <p class="text-xs-center"><strong>IMPRESIÓN DE CITACIONES POR CONVOCADO <br> SINPROC: {{$numSinproc}} </strong></p>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    @foreach ($data['convocadosNatural'] as $info)
                        <div class="row">
                            <div class="col-md-6">
                                <span class="btn btn-secondary btn-block" style="white-space: normal;">{{$info->sicprimernombre}} {{$info->sicsegundoapellido}}</span>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url("conciliaciones/pdf/printActas/ActaEntrega/1/{$numSinproc}/{$info->sicidentificacion}")}}">
                                    <button type="button" class="btn btn-primary btn-block">
                                        <span class="fas fa-print"></span> &nbsp;
                                        @if($data['apoderadoConvocante']==1)
                                            IMPRESIÓN CON APODERADO
                                        @else
                                            IMPRESIÓN SIN APODERADO
                                        @endif
                                    </button>
                                </a>
                            </div>
                        </div><br>
                    @endforeach
                    @foreach ($data['convocadosOrganizacion'] as $info)
                        <div class="row">
                            <div class="col-md-6">
                                <span class="btn btn-secondary btn-block" style="white-space: normal;">{{$info->sicnombre}} </span>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url("conciliaciones/pdf/printActas/ActaEntrega/2/{$numSinproc}/{$info->sicidentificacion}")}}">
                                    <button type="button" class="btn btn-primary btn-block">
                                        <span class="fas fa-print"></span> &nbsp;
                                        @if($data['apoderadoConvocante']==1)
                                            IMPRESIÓN CON APODERADO
                                        @else
                                            IMPRESIÓN SIN APODERADO
                                        @endif
                                    </button>
                                </a>
                            </div>
                        </div><br>
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-danger btn-block btn-sm" data-dismiss="modal">&nbsp;<span class="fa fa-window-close"> </span> CERRAR</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>
