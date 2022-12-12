
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
                            <p class="text-xs-center"><strong>DETALLE DE LA CONCILIACIÓN &nbsp;&nbsp; <br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                        </div>
                    </div>
                </div>

                <div class="modal-body">
                    @if(!$data['detalleAudiencia']->isEmpty())
                        @foreach ($data['detalleAudiencia'] as $info)
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-group has-float-label">
                                        <input class="form-control form-control-sm validate[required]" type="text" name="fechaSesion" id="fechaSesion" value="{{$info->sicfechasesionaudienciaconcili}}"  autocomplete="off">
                                        <span> 1) Fecha de la sesión *</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-group has-float-label">
                                        <textarea class="form-control form-control-sm validate[required]" name="detalleSesion" id="detalleSesion"> {!! $info->sicdetallessesionaudienciaconc !!} </textarea>
                                        <span> 2) Detalles de la sesión *</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row">
                                <div class="col-md-12">
                                    <label class="form-group has-float-label">
                                        <input class="form-control form-control-sm validate[required]" type="text" name="fechaSesion" id="fechaSesion"   autocomplete="off">
                                        <span> 1) Fecha de la sesión *</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-group has-float-label">
                                        <textarea class="form-control form-control-sm validate[required]" name="detalleSesion" id="detalleSesion">  </textarea>
                                        <span> 2) Detalles de la sesións *</span>
                                    </label>
                                </div>
                            </div>                
                    @endif
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
            url: "registroAudiencia",
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

    $('#fechaSesion').datetimepicker({
        value:'',
        format: 'd/m/Y H:i',
        lang:'es',
        closeOnTimeSelect: true,
        allowTimes:['07:00','07:30','08:00','08:30','09:00','09:30','10:00',
            '10:30','11:00','11:30','13:00','13:30','14:00','15:00','15:30']
    });

</script>