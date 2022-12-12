
<script type="text/javascript">
    $('#modal').modal({backdrop: 'static', keyboard: false});
    $('#modal').modal('show');
</script>

<div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form name="frmRegistroDatos" id="frmRegistroDatos">
                <input type="hidden" value="{{$numSinproc=$data['numSolicitud']}}" name="numSolicitud" id="numSolicitud">
                <input type="hidden" value="{{$numSinproc=$data['rol']}}" name="rolCiudadano" id="rolCiudadano">
                <div class="alert" role="alert" style="background-color: #003E65; color: white;">
                    <div class="row">
                        <div class="col-md-12 text-md-center">
                            <p class="text-xs-center"><strong>REGISTRO DEL {{$numSinproc=$data['rol']}} DE LA CONCILIACIÓN &nbsp;&nbsp; <br><small>Todos los campos con asterisco (*) son obligatorios</small></strong></p>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-group has-float-label">
                                <select class="form-control form-control-sm custom-select validate[optional]" name="tipo" id="tipo" onchange="llamarTipoRol(this.value)">
                                    <option value=" ">- Seleccione una opcion -</option>
                                    <option value="1">Persona</option>
                                    <option value="2">Organización</option>
                                </select>
                                <span> 0) Tipo del {{$numSinproc=$data['rol']}}</span>
                            </label>
                        </div>
                    </div>
                    <div id="rolFinal"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4" id="btnRegistrar">
                        <button type="submit" class="btn btn-primary btn-block btn-sm" >&nbsp;<span class="fa fa-save"> </span> REGISTRAR</button>
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
        if($('#tipo').val()==1){ var url="registroCiudadano"; } else{ var url="registroOrganizacion"; }
        $.ajax({
            type: "POST",
            url: url,
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

    function llamarTipoRol(dato){
        $.ajax({
            type: "POST",
            dataType: 'text',
            url:'tipoInvolucradoView',
            data:{dato,dato},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(respuesta){
                $("#rolFinal").html(respuesta);
            },
        })
    }

</script>