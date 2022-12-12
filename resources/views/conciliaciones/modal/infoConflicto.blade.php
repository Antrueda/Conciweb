
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
                            <p class="text-xs-center"><strong>MANEJO DEL CONFLICTO DE LA CONCILIACIÓN &nbsp;&nbsp; <br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                        </div>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[required]" name="idEscaladaConflicto" id="idEscaladaConflicto">
                                    @if(!$data['escaladaConflicto']->isEmpty())
                                        @foreach ($data['escaladaConflicto'] as $info)
                                            <option value="{{$info->sicidescaladaconflictoconcilia}}">{!! $info->sicnombreescaladaconflictoconc !!}</option>
                                        @endforeach
                                    @else
                                        <option value=" ">- Seleccione una opcion -</option>
                                    @endif

                                    @foreach ($data['listaEscaladaClonflicto'] as $info)
                                        <option value="{{$info->sicidescaladaconflictoconcilia}}">{!! $info->sicnombreescaladaconflictoconc !!}</option>
                                    @endforeach
                                </select>
                                <span> 1) Escalada del conflicto *</span>
                            </label>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[optional]" name="idTipoTercero" id="idTipoTercero">
                                     @if(!$data['intervencionTercero']->isEmpty())
                                        @foreach ($data['intervencionTercero'] as $info)
                                            <option value="{{$info->sicidtercero}}">{!! $info->sicnombreterceroconciliacion !!}</option>
                                        @endforeach
                                    @else
                                        <option value=" ">- Seleccione una opcion -</option>
                                    @endif

                                    @foreach ($data['listaIntervenTerceros'] as $info)
                                        <option value="{{$info->sicidtercero}}">{!! $info->sicnombreterceroconciliacion !!}</option>
                                    @endforeach
                                </select>
                                <span> 2) Tipo de tercero </span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                    @if(!$data['fechaIntervencion']->isEmpty())
                                        @foreach ($data['fechaIntervencion'] as $info)
                                            <input type="text" name="fechaIntervencion" id="fechaIntervencion" class="form-control form-control-sm validate[optional]" value="{!! $info->sicfechaintervenciontercerocon !!}">
                                        @endforeach
                                    @else
                                        <input type="text" name="fechaIntervencion" id="fechaIntervencion" class="form-control form-control-sm validate[optional]">
                                    @endif
                                
                                <span> 3) Fecha de intervención</span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[optional]" name="idTipoDocumentoFinal" id="idTipoDocumentoFinal">
                                    @if(!$data['documentoTercero']->isEmpty())
                                        @foreach ($data['documentoTercero'] as $info)
                                            <option value="{{$info->siciddocumentointervencion}}">{!! $info->sicnombredocumentointervencion !!}</option>
                                        @endforeach
                                    @else
                                        <option value=" ">- Seleccione una opcion -</option>
                                    @endif
                                    @foreach ($data['listaDocFirmados'] as $info)
                                        <option value="{{$info->siciddocumentointervencion}}">{!! $info->sicnombredocumentointervencion !!}</option>
                                    @endforeach
                                </select>
                                <span> 4) Documentos Firmado </span>
                            </label>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4" id="btnRegistrar">
                        <button type="submit" class="btn btn-primary btn-block btn-sm" >&nbsp;<span class="fa fa-save"> </span> ACTUALIZAR</button>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-danger btn-block btn-sm" data-dismiss="modal">&nbsp;<span class="fa fa-window-close"> </span> CERRAR</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $("#frmRegistroDatos").validationEngine('attach',{
            onValidationComplete:function(form, status) {
                if (status === true) {
                    registroDatos();
                } else {
                    llamarNotyFaltanDatosFrm();
                    return;
                }
            }
        });
    });

    function registroDatos(){
        $.ajax({
            type: "POST",
            url: "registroManejoConflicto",
            dataType: 'text',
            data: $("#frmRegistroDatos").serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend:function(){llamarNotyCarga();},
            success: function(r){
                cons();
                var datUsr=r.split("|");
                var valor=datUsr[1];
                var msg=datUsr[2];
                if(valor==0) {
                    var msg = "<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" + msg;
                    llamarNotyTime('error',msg,'topRight',2000);
                }else{
                    var msg="<center><p><i class='fas fa-check-circle fa-3x'></i></p></center>" +msg;
                    new Noty({
                        text: msg,
                        type: 'success',
                        layout: 'center',
                        theme: 'bootstrap-v4',
                        killer:true,
                        progressBar:true,
                        timeout:2000,
                        callbacks: {
                            afterClose: function() {
                                $('#modal').modal('toggle');
                            },
                        }
                    }).show();
                }
            }
        });
    }

    $('#fechaIntervencion').datetimepicker({
        startDate:  '+1970/01/01',
        lang:'es',
        format:'d/m/Y', //format:'d/m/Y H:i',
        maxDate:0, // Bloquea días futuros
        timepickerScrollbar:false,
        timepicker:false,
        scrollMonth:false,
        closeOnDateSelect: true,
    });

</script>